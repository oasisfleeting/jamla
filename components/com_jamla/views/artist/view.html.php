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
	public function display($tpl = null)
	{
		$doc = JFactory::getDocument();
		$input = JFactory::getApplication()->input;

		$this->addScripts($doc);

		$this->songid = $input->getInt('id');

		$this->song = $this->get('Song');
		$this->votes = $this->get('Votes');
		$this->comments = $this->get('Comments');
		$this->rating = $this->get('SongRating');

		$this->queueids = $this->get('queueids');
		$this->queuedArtists = $this->get('queuedArtists');

		//$comp = JComponentHelper::getComponent('com_jamla');
		$params = JComponentHelper::getParams('com_jamla');
		$this->station = $params['station'];
		$this->disableRequestsForRecentlyPlayedSongs = $params['disableRequestsForRecentlyPlayedSongs'];
		$this->disableRequestsForQueuedArtists = $params['disableRequestsForQueuedArtists'];
		$this->disableRequestsForQueuedSongs = $params['disableRequestsForQueuedSongs'];

		$this->art = JamlaFrontendHelper::parseArt($this->song['lyrics']);


		//theQueueIDs
        //theQueueArtists



		parent::display($tpl);
	}


	public function addScripts($doc)
	{
		$doc->addStyleSheet('media/jamla/css/star.css');
		$doc->addStyleSheet('media/jamla/css/songinfo.css');
		/*$doc->addScriptDeclaration("

								function newWindow(thePage) {
									var w = 550;
									var h = 600;
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open(thePage, 'fhr', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function openOther(thePage, w, h) {
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open(thePage, 'o', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function openPointsHelp(thePage, w, h) {
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open(thePage, 'ph', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function VotesOpen() {
									var w = 300;
									var h = 350;
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open('index.php?option=com_sam2joom&view=votes&songID=<?php echo $songID; ?>&tmpl=component', 'VotesOpen', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function PlaysOpen() {
									var w = 400;
									var h = 450;
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open('index.php?option=com_sam2joom&view=plays&songID=<?php echo $songID; ?>&tmpl=component', 'VotesOpen', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function RequestsOpen() {
									var w = 400;
									var h = 450;
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
									var win = window.open('index.php?option=com_sam2joom&view=requests&songID=<?php echo $songID; ?>&tmpl=component', 'VotesOpen', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}
								function dedicateRequest(songID) {
									var w = 600;
									var h = 350;
									var winl = (screen.width - w) / 2;
									var wint = (screen.height - h) / 2;
									var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=no,resizable=no,status=yes';
									var win = window.open('index.php?option=com_sam2joom&view=req&songID=' + songID + '&dedicate=1&tmpl=component', 'dedicateRequest', winprops);
									if (parseInt(navigator.appVersion) >= 4)
										win.window.focus();
								}

		");*/
	}

}