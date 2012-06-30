<?php
/**
 * @version		0.1 default.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 Alasdair Stalker - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1><?php echo JText::_('COM_DROPBOX_HOME') ?></h1>

<?php if ($this->guest): ?>
	<p>In order to access your Dropbox please login first.</p>
	<p>If this is your first time you will be redirected to dropbox.com and asked to verify your Dropbox account. A new folder will be created in your Dropbox where this App will save and access your files. Asta does not require access to any other directory in your Dropbox.</p>
	<p>Once authorised your access token will be saved - this is only to avoid you having to authorise each time you visit. Your login details are not saved on this website.</p>

<?php else: ?>

	<?php if (isset($this->files) && is_array($this->files['contents'])):?>
		<table class="asta-dropbox">
		<thead>
			<tr>
				<th><?php echo JText::_('COM_DROPBOX_NAME') ?></th>
				<th><?php echo JText::_('COM_DROPBOX_DATE_MODIFIED') ?></th>
				<th><?php echo JText::_('COM_DROPBOX_SIZE') ?></th>
			</tr>			
		</thead>
		<?php $i = 0; ?>
		<?php foreach($this->files['contents'] as $file):?>
			<?php if ($file['is_dir'] == 1  ): ?>
			<tr class="<?php echo ($i%2 == 0 ? '' : 'odd'); ?>">
				<td>
					<a href="<?php echo JRoute::_('index.php?option=com_dropbox&task=browse&amp;browse='.$file['path']);?>"><?php echo array_pop(explode('/', $file['path']));?>/</a>
				</td>
				<td>
					<?php echo date(' F Y h:i:s', strtotime( $file['modified'] )); ?>	
				</td>
				<td>
				</td>
			</tr>
			<?php $i++; ?>
			<?php endif;?>
		<?php endforeach;?>
		<?php foreach($this->files['contents'] as $file):?>
			<?php if ($file['is_dir'] != 1  ): ?>
			<tr class="<?php echo ($i%2 == 0 ? '' : 'odd'); ?>">
				<td>
					<a href="<?php echo JRoute::_('index.php?option=com_dropbox&task=getfile&amp;getfile=' . $file['path']); ?>">
					<?php if ($this->show_image_preview == '1' && $file['thumb_exists'] == '1'):?>
						<img src="data:<?php echo $file['mime_type'];?>;base64,<?php echo base64_encode( $this->dropbox->getThumbnail($file['path']) );?>" alt="<?php echo $file['path'];?>" />
					<?php else:?>
						<?php echo array_pop(explode('/', $file['path'])); ?>				
					<?php endif;?>			
					</a>	
				</td>
				<td>
					<?php echo date(' F Y h:i:s', strtotime( $file['modified'] )); ?>			
				</td>
				<td>
					<?php echo $file['size'];?>
				</td>
			</tr>
			<?php $i++; ?>
			<?php endif;?>
		<?php endforeach;?>
		</table>
		<a href="<?php echo JRoute::_('index.php?option=com_dropbox&task=browse');?>"></a>
	<?php endif;?>
<?php endif;?>