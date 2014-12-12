<?php
/**
 * jamla.php
 *
 * @package     jamla
 *
 * @copyright   Copyright (C) 25 oasis fleeting. All rights reserved.
 * @license     wtfpl
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Jamla helper.
 */
class JamlaHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
            JText::_('COM_JAMLA_TITLE_DJS'),
            'index.php?option=com_jamla',
            $vName
        );
        /*JHtmlSidebar::addEntry(
            JText::_('JCATEGORIES') . ' (' . JText::_('COM_JAMLA_TITLE_DJS') . ')',
            "index.php?option=com_categories&extension=com_jamla",
            $vName == 'categories'
        );*/
        /*if ($vName=='categories') {
            JToolBarHelper::title('Jamla Djs: JCATEGORIES (COM_JAMLA_TITLE_DJS)');
        }*/

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions()
	{
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_jamla';

        $actions = array('core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete');

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }


}
