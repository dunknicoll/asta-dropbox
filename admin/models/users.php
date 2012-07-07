<?php
/**
 * @version		0.1 home.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class DropboxModelUsers extends JModelList
{

	/**
	 * Method to get the Users who have authorised Dropbox.
	 *
	 * @return
	 */
	protected function getListQuery()
	{
		$query	= $this->_db->getQuery(true);
		$query->select('d.id, d.user_id, u.name ');
		$query->from('#__dropbox as d');
		$query->join('LEFT', '#__users AS u ON d.user_id=u.id');
		$query->order($this->_db->escape($this->state->get('filter_order', 'user_id')) . ' ' . $this->_db->escape($this->state->get('filter_order_Dir', 'ASC')));
 		
		return $query;
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	public function populateState() {
		$filter_order = JRequest::getCmd('filter_order', 'user_id');
		$filter_order_Dir = JRequest::getCmd('filter_order_Dir', 'ASC');

		$this->setState('filter_order', $filter_order);
		$this->setState('filter_order_Dir', $filter_order_Dir);

	}

}
