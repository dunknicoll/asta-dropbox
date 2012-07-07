<?php
/**
 * @version		0.1 view.html.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.controller');
 
class DropboxController extends JController
{

	/**
	 * Display task
	 *
	 * @return void
	 */
	function display($cachable = false) 
	{
		require_once JPATH_COMPONENT.'/helpers/dropbox.php';
		
		JRequest::setVar('view', JRequest::getCmd('view', 'home'));
 
		// Load the submenu.
		DropboxHelper::addSubmenu(JRequest::getCmd('view', 'banners'));


		parent::display($cachable);
	}
}