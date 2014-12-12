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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_jamla'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

jimport('joomla.application.component.controller');

/* Create an instance of JControllerLegacy, and we need to tell this function the name of our component. This name will be used as the prefix for all the classes; for example, FolioViewFolios or FolioHelper. Notice how we are using the JControllerLegacy class because we are using the old MVC. */
$controller  = JControllerLegacy::getInstance('Jamla');
// Since the component has more than a single page, we have a task input that determines what the component is going to do next.
$controller->execute(JFactory::getApplication()->input->get('task'));
//redirect to next URL
$controller->redirect();