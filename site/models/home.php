<?php
/**
 * @version		0.1 view.html.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 Alasdair Stalker - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * Dropbox Model
 */
class DropboxModelHome extends JModelItem
{

	/**
	 * @var string consumerkey
	 */
	protected $consumerkey;
	
	/**
	 * @var string consumersecret
	 */
	protected $consumersecret;
	
	/**
	 * @var string callback url
	 */
	protected $callback;
	
	/**
	 * Constructor. Sets the config for the model
	 */
	public function __construct()
	{
		$this->params = JComponentHelper::getParams('com_dropbox');
		
		$this->_consumerkey = $this->params->get('consumerkey');
		$this->_consumersecret = $this->params->get('consumersecret');
		
		$http_host = JRequest::getString('HTTP_HOST','','SERVER');
		$this->_callback = 'http://'.$http_host.'/index.php?option=com_dropbox';

		parent::__construct();
		
	}

	/**
	 * Save the auth token for the user
	 * 
	 * @param	string	auth token
	 */
	protected function saveAuth($token)
	{
		$user =& JFactory::getUser();
		$query = 'DELETE FROM #__dropbox WHERE user_id='.$this->_db->quote($user->id);
		$this->_db->setQuery($query);
		$this->_db->query();
		
		$query = 'INSERT INTO #__dropbox (user_id, token, token_secret) VALUES('
				.$this->_db->quote($user->id).', '
				.$this->_db->quote($token['token']).', '
				.$this->_db->quote($token['token_secret'])
				.')';
		
		$this->_db->setQuery($query);
		if (!$this->_db->query()) {
			$this->setError($this->_db->getErrorMsg());
		}
	}

	/**
	 * Get the auth token for the user
	 * 
	 * @return	string	auth token
	 */
	protected function getAuth()
	{
		$user =& JFactory::getUser();
		
		$query = $this->_db->getQuery(true);
		
		$query->select('token, token_secret');
		$query->from('#__dropbox');
		$query->where('user_id = ' . (int) $user->id);
		
		$this->_db->setQuery($query);
		return $this->_db->loadObject();
	}
	
	/**
	 * Authorize this App with the users Dropbox account. Get and set the Request
	 * and Access tokens
	 *
	 * @return	object	the Dropbox Object
	 */
	public function getDropbox()
	{

		require_once JPATH_SITE . '/components/com_dropbox/inc/autoload.php';
		$oauth = new Dropbox_OAuth_PEAR($this->_consumerkey, $this->_consumersecret);

		$dropbox = new Dropbox_API($oauth, 'sandbox');	 

		$session = JFactory::getSession();

		$auth =& $this->getAuth();

		if ($auth->token!='' && $auth->token_secret!='')
		{
			$oauth->setToken(array('token'=> $auth->token, 'token_secret'=>$auth->token_secret));
		}
		elseif ($session->get('initial_auth')!='yes')
		{
			$tokens = $oauth->getRequestToken();
			$session->set('oauth_tokens', $tokens);
			$session->set('initial_auth', 'yes');
			$session->set('access_tokens', '');
			header('Location: '.$oauth->getAuthorizeUrl().'&oauth_callback='.$this->_callback);
		}
		elseif($session->get('access_tokens')!='yes')
		{
			$oauth->setToken($session->get('oauth_tokens'));
			$tokens = $oauth->getAccessToken();
			$session->set('oauth_tokens', $tokens);
			$session->set('access_tokens', 'yes');
			$this->saveAuth($tokens);
		}
		else
		{
			$oauth->setToken($session->get('oauth_tokens'));
			
		}

		return $dropbox;
	}
	
}