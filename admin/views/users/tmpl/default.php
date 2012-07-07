<?php
/**
 * @version		0.1 default.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

?>
<form action="<?php echo JRoute::_('index.php?option=com_dropbox&view=users') ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th width="10%">
					<?php echo JHtml::_('grid.sort',  'User Id', 'd.user_id', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th>
					<?php echo JHtml::_('grid.sort',  'COM_DROPBOX_HEADING_NAME', 'u.name', $this->sortDirection, $this->sortColumn); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php foreach ($this->users as $i => $item): ?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php echo $this->escape($item->user_id); ?>
				</td>
				<td>
					<?php echo $this->escape($item->name); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>