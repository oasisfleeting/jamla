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

// prevent unwanted access
defined('_JEXEC') or die;

require_once JPATH_COMPONENT . '/router.php';
require_once JPATH_COMPONENT . '/helpers/jamla.php';

$controller  = JControllerLegacy::getInstance('Jamla');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();