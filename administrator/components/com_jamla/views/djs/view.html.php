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


jimport('joomla.application.component.view');


class JamlaViewDjs extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}

		JamlaHelper::addSubmenu('Djs');

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}



    /**
     * Add the page title and toolbar.
     *
     * @since	1.6
     */
    protected function addToolbar()
	{
        require_once JPATH_COMPONENT . '/helpers/jamla.php';

        $state = $this->get('State');
        $canDo = JamlaHelper::getActions($state->get('filter.category_id'));

        JToolBarHelper::title(JText::_('COM_JAMLA_TITLE_DJS'), 'djs.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/dj';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
                JToolBarHelper::addNew('dj.add', 'JTOOLBAR_NEW');
            }

            if ($canDo->get('core.edit') && isset($this->items[0])) {
                JToolBarHelper::editList('dj.edit', 'JTOOLBAR_EDIT');
            }
        }

        if ($canDo->get('core.edit.state'))
		{

            if (isset($this->items[0]->state))
			{
                JToolBarHelper::divider();
                JToolBarHelper::custom('djs.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
                JToolBarHelper::custom('djs.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            }
			else if (isset($this->items[0]))
			{
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'djs.delete', 'JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state))
			{
                JToolBarHelper::divider();
                JToolBarHelper::archiveList('djs.archive', 'JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out))
			{
                JToolBarHelper::custom('djs.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
        }

        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state))
		{
            if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
			{
                JToolBarHelper::deleteList('', 'djs.delete', 'JTOOLBAR_EMPTY_TRASH');
                JToolBarHelper::divider();
            }
			else if ($canDo->get('core.edit.state'))
			{
                JToolBarHelper::trash('djs.trash', 'JTOOLBAR_TRASH');
                JToolBarHelper::divider();
            }
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_jamla');
        }

        //Set sidebar action - New in 3.0
        JHtmlSidebar::setAction('index.php?option=com_jamla');

        $this->extra_sidebar = '';

        JHtmlSidebar::addFilter(JText::_('JOPTION_SELECT_PUBLISHED'), 'filter_published', JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true));

    }

    protected function getSortFields()
    {
        return array(
			'a.id' => JText::_('JGRID_HEADING_ID'),
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.checked_out' => JText::_('COM_JAMLA_DJS_CHECKED_OUT'),
			'a.checked_out_time' => JText::_('COM_JAMLA_DJS_CHECKED_OUT_TIME'),
			'a.created_by' => JText::_('COM_JAMLA_DJS_CREATED_BY'),
			'a.host' => JText::_('COM_JAMLA_DJS_HOST'),
			'a.port' => JText::_('COM_JAMLA_DJS_PORT'),
			'a.dbuser' => JText::_('COM_JAMLA_DJS_DBUSER'),
			'a.dbpass' => JText::_('COM_JAMLA_DJS_DBPASS'),
			'a.params' => JText::_('COM_JAMLA_DJS_PARAMS'),
        );
    }

}
