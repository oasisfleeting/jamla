<?php
/**
 * artist.php
 *
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

class JamlaModelArtist extends JModelLegacy
{
	public function getSong()
	{

		/*$SAMdb->open("SELECT * FROM songlist WHERE ID = '$songID' ");
		$song = $SAMdb->row();*/


		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$songid = $input->getInt('id');

		$sql->select('*');
		$sql->from($db->quoteName('#__jamla_songlist'));
		$sql->where($db->quoteName('ID') . ' = ' . $songid);
		$db->setQuery($sql);
		$song = $db->loadAssoc();

		return $song;
	}

	public function getVotes()
	{
		/*$SAMdb->open("SELECT * FROM song_votes WHERE songID = '$songID' ");
		$votesData = $SAMdb->row();*/

		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$songid = $input->getInt('id');

		$sql->select('*');
		$sql->from($db->quoteName('#__jamla_song_votes'));
		$sql->where($db->quoteName('songID') . ' = ' . $songid);
		$db->setQuery($sql);
		$votesData = $db->loadResult();
	}

	public function getComments()
	{
		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$songid = $input->getInt('id');

		$sql->select('id, comments, create_date, update_date, username, userid');
		$sql->from('#__jamla_song_comments');
		$sql->where('songid = ' . $songid);
		$sql->where('deleted_flag = ' . 0);
		$sql->order('id');
		$db->setQuery($sql);
		$comments = $db->loadRowList();
		return $comments;

		//$SAMdb->open("SELECT id, comments, create_date, update_date, username, userid
		//FROM song_comments
		//WHERE songid = '$songID' AND deleted_flag = 0
		//ORDER BY id DESC");
		//$songComments   = $SAMdb->rows();
		//$commentCounter = -1;
	}

	public function getSongRating()
	{
		//$SAMdb->open("SELECT song_rating.rating FROM song_rating where song_rating.songID = " . $song["songID"] . " AND song_rating.userID = " . $user->id);
		//$the_rating = $SAMdb->row();
		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$songid = $input->getInt('id');
		$user = JFactory::getUser();

		$sql->select('rating');
		$sql->from('#__jamla_song_rating');
		$sql->where('songID = ' . $songid);
		$sql->where('userID = ' . $user->id);
		$db->setQuery($sql);
		return $db->loadRow();
	}

	public function getQeueuedIds()
	{
		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$sql->select('songID');
		$sql->from('#__jamla_queuelist');
		$db->setQuery($sql);
		return $db->loadColumn();
	}

	public function getQueuedArtists()
	{
		$input = JFactory::getApplication()->input;
		$db = JFactory::getDbo();
		$sql = $db->getQuery(true);

		$sql->select('songID');
		$sql->from('#__jamla_queuelist');
		$db->setQuery($sql);
		$ids = $db->loadColumn();

		$sql->clear();
		//var_dump($ids);

		$sql->select('artist');
		$sql->from('#__jamla_songlist');
		$sql->where('ID IN (' . implode(',',$ids) . ')');
		$db->setQuery($sql);
		return $db->loadColumn();
	}
}
