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
 
// import Joomla view library
jimport('joomla.application.component.view');

class DropboxViewUsers extends JView
{
	protected $users;
	protected $pagination;
	protected $state;

	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 * @since   1.6
	 */
	function display($tpl = null) 
	{
		$this->users 		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

		$this->sortDirection = $this->state->get('filter_order_Dir');
		$this->sortColumn	= $this->state->get('filter_order');
		
		$this->addToolBar();
		
		parent::display($tpl);
	}
 
	/**
	 * Setting the toolbar
	 */
	protected function addToolBar() 
	{
		JToolBarHelper::title(JText::_('COM_DROPBOX_ADMIN').' - '.JText::_('COM_DROPBOX_MENU_USERS'));
		JToolBarHelper::preferences('com_dropbox');
	}
	
}