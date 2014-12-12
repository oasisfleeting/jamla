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
// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * View to edit
 */
class JamlaViewArtist extends JViewLegacy
{
	/**
	 * Display the view
	 */
	public function display($tpl = 'raw')
	{
		//parent::display($tpl);
	}

}