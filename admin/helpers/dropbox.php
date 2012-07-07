<?php
/**
 * @version		0.1 dropbox.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

defined('_JEXEC') or die;

class DropboxHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_DROPBOX_MENU_HOME'),
			'index.php?option=com_dropbox',
			$vName == 'home'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_DROPBOX_MENU_USERS'),
			'index.php?option=com_dropbox&view=users',
			$vName == 'users'
		);

	}


}
