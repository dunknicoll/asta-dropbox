<?php
/**
 * @version		0.1 controller.php
 * @package		Asta Dropbox
 * @copyright	Copyright 2012 Alasdair Stalker - All rights reserved.
 * @license		GNU/GPL
 * @website		http://www.asta.org.uk
 *
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
jimport('joomla.application.component.helper');

class DropboxController extends JController
{
//	private $params = null;
	
	public function __construct()
	{
		parent::__construct();
	}

	function display()
	{
		JRequest::setVar('view', JRequest::getCmd('view', 'home'));
		parent::display();
	}

	/**
	 * Get the file for download. Sets the headers to force a download
	 *
	 */
	public function getFile()
	{
	 	if (JRequest::getVar('getfile')!='')
	 	{
			$path = str_replace("%2F", "/", rawurlencode(JRequest::getVar('getfile')));
			$model = $this->getModel('home');
			
			$dropbox = $model->getDropbox();
			$filedata = $dropbox->getMetaData( $path );
			if (is_array($filedata) && $filedata['is_dir'] != 1)
			{
				$pathinfo = pathinfo($filedata['path']);
				if (is_array($pathinfo))
				{
					header("Content-Type: application/force-download");
					header("Content-Disposition: attachment; filename=\"".$pathinfo['basename']."\"");
					echo $dropbox->getFile($path);					
				}
				exit();
			}
	 	}
		
	}

}