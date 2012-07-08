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

?>
<h1><?php echo JText::_('COM_DROPBOX_HOME') ?></h1>

<?php if ($this->guest): ?>
	<p><?php echo JText::_('COM_DROPBOX_LOGGEDOUT') ?></p>
	<p><?php echo $this->params->get('loggedouttext')!='' ? $this->params->get('loggedouttext') : JText::_('COM_DROPBOX_LOGGEDOUT_TEXT') ?></p>

<?php else: ?>

	<?php if (isset($this->files) && is_array($this->files['contents'])):?>
		<div class="dropbox-folders">
		<?php foreach($this->files['contents'] as $file):?>
			<?php if ($file['is_dir'] == 1  ): ?>
				<div>
					<p><a href="<?php echo JRoute::_('index.php?option=com_dropbox&task=browse&amp;browse='.$file['path']); ?>">
					<?php echo array_pop(explode('/', $file['path']));?></a></p>
					<p><?php echo date('d/m/Y', strtotime( $file['modified'] )); ?></p>
				</div>
			<?php endif;?>
		<?php endforeach;?>
		</div>

		<div class="dropbox-files">
		<?php foreach($this->files['contents'] as $file):?>
			<?php if ($file['is_dir'] != 1  ): ?>
				<div>
					<p><a href="<?php echo JRoute::_('index.php?option=com_dropbox&task=getfile&amp;getfile='.$file['path']); ?>">
					<?php if ($file['thumb_exists'] == '1'):?>
						<img src="data:<?php echo $file['mime_type'];?>;base64,<?php echo base64_encode( $this->dropbox->getThumbnail($file['path']) );?>" alt="<?php echo $file['path'];?>" />
					<?php else:?>
						<?php echo array_pop(explode('/', $file['path'])); ?>				
					<?php endif;?>			
					</a>
					</p>
					<p><?php echo date('d/m/Y', strtotime( $file['modified'] )); ?></p>
					<p><?php echo $file['size'];?></p>
				</div>
			<?php endif;?>
		<?php endforeach;?>
		</div>
	<?php endif;?>
<?php endif;?>