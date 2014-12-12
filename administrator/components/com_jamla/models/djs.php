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

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Jamla records.
 */
class JamlaModelDjs extends JModelList
{

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see        JController
     * @since    get users database information and store it.
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'userid', 'a.userid',
				'username','a.username',
				'state','a.state',
				'ordering', 'a.ordering',
				'host', 'a.host',
				'port', 'a.port',
				'dbuser', 'a.dbuser',
				'dbpass','a.dbpass',
				'params','a.params'
            );
        }

        parent::__construct($config);
    }



    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout', 'default', 'cmd')) {
			$this->context .= '.' . $layout;
		}

		// Load the filter state.
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$active = $this->getUserStateFromRequest($this->context . '.filter.active', 'filter_active');
		$this->setState('filter.active', $active);

		$state = $this->getUserStateFromRequest($this->context . '.filter.state', 'filter_state');
		$this->setState('filter.state', $state);

		$groupId = $this->getUserStateFromRequest($this->context . '.filter.group', 'filter_group_id', null, 'int');
		$this->setState('filter.group_id', $groupId);

		$range = $this->getUserStateFromRequest($this->context . '.filter.range', 'filter_range');
		$this->setState('filter.range', $range);

		$groups = json_decode(base64_decode($app->input->get('groups', '', 'BASE64')));
		if (isset($groups)) {
			JArrayHelper::toInteger($groups);
		}

		$this->setState('filter.groups', $groups);
		$excluded = json_decode(base64_decode($app->input->get('excluded', '', 'BASE64')));

		if (isset($excluded)) {
			JArrayHelper::toInteger($excluded);
		}

		$this->setState('filter.excluded', $excluded);
		// Load the parameters.
		$params = JComponentHelper::getParams('com_users');

		$this->setState('params', $params);
		// List state information.
		parent::populateState('a.username', 'asc');
	}

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '')
    {
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.active');
		$id .= ':' . $this->getState('filter.state');
		$id .= ':' . $this->getState('filter.group_id');
		$id .= ':' . $this->getState('filter.userid');
		return parent::getStoreId($id);
    }



    public function getItems()
    {

		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);
		$sql->select('*');
		$sql->from('#__jamla_dj');
		$db->setQuery($sql);
		return $db->loadObjectList();
    }

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return	JDatabaseQuery
	 * @since	1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select($this->getState('list.select', 'DISTINCT a.*'));
		$query->from('`#__jamla_dj` AS a');

		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.block = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.block IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = ' . (int) substr($search, 3));
			} else {
				$search = $db->Quote('%' . $db->escape($search, true) . '%');

			}
		}

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		if ($orderCol && $orderDirn) {
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}
		$query->order('ordering ASC');
		return $query;
	}


	/**
	 * SQL server change
	 *
	 * @param   integer  $user_id  User identifier
	 *
	 * @return  string   Groups titles imploded :$
	 */
	/*function _getUserDisplayedGroups($user_id)
	{
		$db = JFactory::getDbo();
		$query = "SELECT title FROM " . $db->quoteName('#__usergroups') . " ug left join " .
			$db->quoteName('#__user_usergroup_map') . " map on (ug.id = map.group_id)" .
			" WHERE map.user_id=" . (int) $user_id;
		$db->setQuery($query);
		$result = $db->loadColumn();
		return implode("\n", $result);
	}*/

}
