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


?>
<p>Please remember to set the Options before enabling Dropbox on your site.</p>
<p>This extension allows you to integrate a Dropbox App with your website. You will need to create an App on the <a href="https://www.dropbox.com/developers/apps" target="_blank">Dropbox Apps site</a> where you will obtain two keys - your App key and the secret key. Once you have saved those details in this components options users can then Authorise their Dropbox account with your App. The App is a Dropbox Sandbox which means that a new App folder will be created in the users Dropbox account. No files outside this App directory will be accessible*.</p>
<p>* There will actually be two folders created: a parent App folder if it doesn't already exist and a folder with the name of your App which exists inside the App folder.</p>