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

jimport('joomla.application.component.view');
jimport('joomla.application.component.helper');
 
class DropboxViewHome extends JView
{

	function display($tpl = null) 
	{
		$app =& JFactory::getApplication();
		$document =& JFactory::getDocument();
		$pathway =& $app->getPathway();

		if (JRequest::getVar('browse')=='')
			$pathway->addItem('Home');
		
		$user = JFactory::getUser();
		if ($user->guest)
		{	
			$this->guest = true;

		}
		else
		{
			$model =& $this->getModel();
			$document->addStyleSheet('/components/com_dropbox/css/main.css');
			
			$this->params = JComponentHelper::getParams('com_dropbox');
			if (!$model->checkParams())
			{
				JError::raiseWarning(500, 'Error: Please set the Dropbox keys');
			}
			else
			{	
				$this->dropbox = $model->getDropbox();

				$browse = str_replace("%2F", "/", rawurlencode(JRequest::getVar('browse'))); ;
				if ($browse=='')
					$browse='/';
				
				$this->breadcrumbs = explode('/',$browse);

				$this->files = $this->dropbox->getMetaData( $browse );	//get the file details from dropbox
				if ($this->files['error']!='')
					JError::raiseWarning(100, $this->files['error']);

				array_shift($this->breadcrumbs); //remove the empty root value

				foreach ($this->breadcrumbs as $crumb)
				{
					if ($crumb!='')
						$pathway->addItem($crumb, 'index.php?option=com_dropbox&task=browse&amp;browse='.$path);
				}
			}
		}
		parent::display($tpl);
	}
	
}
