<?php
/**
 * jamla.php
 *
 * Entry point, loader file for jamla component.
 * @package     jamla
 *
 * @copyright   Copyright (C) 25 oasis fleeting. All rights reserved.
 * @license     wtfpl
 */



// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT . '/controller.php');

class JamlaControllerArtist extends JamlaController
{
	protected $input;

	function display()
	{
		parent::display();
	}

	function request()
	{

		/*
		$document = JDocument::getInstance('raw');  //this new instance is a raw document object
		$viewType = $document->getType();

		$this->getView('artist', $viewType);
		$this->input->set('view', 'artist');
		*/
		$songid = $this->input->getInt('songid');

		echo $songid;
		exit();


		///$this->display();
	}
}
