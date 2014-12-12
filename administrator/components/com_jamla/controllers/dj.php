<?php
/**
 * jamla.php
 *
 * @package     jamla
 *
 * @copyright   Copyright (C) 25 oasis fleeting. All rights reserved.
 * @license     wtfpl
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
* DJ controller class.
*/
class JamlaControllerDj extends JControllerForm
{
	function __construct()
	{
		$this->view_list = 'djs';
		parent::__construct();
	}

}