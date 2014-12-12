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
// no direct access
defined('_JEXEC') or die;

$user = JFactory::getUser();
$song = $this->song;
$songid = $this->songid;
$songID = $songid;
$votesData = $this->votes;
$songComments = $this->comments;
$the_rating = $this->rating;
$theQueueIDs = $this->queueids;
$theQueueArtists = $this->queuedArtists;
$art = $this->art;

$song['lyrics'] = "";

$songWait = 20;

$disableRequestsForRecentlyPlayedSongs = $this->disableRequestsForRecentlyPlayedSongs;
$disableRequestsForQueuedArtists = $this->disableRequestsForQueuedArtists;
$disableRequestsForQueuedSongs = $this->disableRequestsForQueuedSongs;
$station = $this->station;

?>

<div class="container">
	<div class="row">

	<div style="float: left;">
		<a class="header" href="index.php?option=com_jamla&view=artist&id=<?php echo $songID - 1 ?>"><?php echo JText::_('COM_JAMLA_SONGINFO_PREVIOUS_SONG'); ?></a>
	</div>
	<div style="float: right;">
		<a class="header" href="index.php?option=com_jamla&view=artist&id=<?php echo $songID + 1 ?>"><?php echo JText::_('COM_JAMLA_SONGINFO_NEXT_SONG'); ?></a>
	</div>
	<div style="clear: both;"></div>



	<div style="margin-top: 20px;"></div>

	<?php if ($song["title"] == "") { ?>
		<span style="font-family: Verdana, Arial, Helvetica; font-size: xx-small; "><?php echo JText::_('COM_JAMLA_SONGINFO_NO_SONG'); ?></span>
	<?php } ?>

	<div class="albumcoverSongInfo">
		<img src="<?php echo $art['image']; ?>" title="<?php echo htmlspecialchars($song["album"]); ?> <?php echo JText::_('COM_JAMLA_SONGINFO_BY'); ?> <?php echo htmlspecialchars($song["artist"]); ?>" border="0" width="200" height="200" />
	</div>

	<div class="artistSongInfo">
		<a href="<?php //echo $this->URIHelper->getPlaylistURL($song['artist']{0},$song['artist']); ?>" title="<?php echo JText::_('COM_JAMLA_SONGINFO_ARTIST_LINK_GET_ALBUM_LISTING'); ?> <?php echo htmlspecialchars($song["artist"]); ?>"><?php echo $song["artist"]; ?></a>
	</div>

	<div class="titleSongInfo">
		<a href="index.php?option=com_jamla&view=artist&id=<?php echo $song["songID"]; ?>" title="<?php echo JText::sprintf('COM_JAMLA_SONGINFO_ARTIST_LINK_GET_INFORMATION', htmlspecialchars($results["title"]), htmlspecialchars($results["artist"])); ?>">"<?php echo $song["title"]; ?>"</a>
	</div>

	<div class="albumSongInfo">
		<a href="<?php //echo $this->URIHelper->getPlaylistURL($song['artist']{0},$song['artist'],$song['album']); ?>" title="<?php echo JText::_('COM_JAMLA_SONGINFO_ARTIST_LINK_GET_TRACK_LISTING'); ?> <?php echo htmlspecialchars($song["album"]); ?>"><?php echo $song["album"]; ?></a>
	</div>

	<div class="durationSongInfo">
		<?php echo JText::_('COM_JAMLA_SONGINFO_DURATION'); ?>:<img src="media/jamla/images/spacer.gif" width="15" height="13" /><?php echo date('i:s',$song["duration"]/1000); ?>
	</div>

	<!-- Rating Overall-->
	<div class="overallrating-labelSongInfo">
		<?php echo JText::_('COM_JAMLA_RATING_OVERALL'); ?>:
		<img src="media/jamla/images/spacer.gif" width="15" height="13">
	</div>
	<div class="overallratingSongInfo">
		<div style="font-family: Verdana, Arial, Helvetica;">
			<?php
			if ($song["songtype"] == 'S') {
				if ($song["rating"] == 0) {
					$songtext = "" . JText::_('COM_JAMLA_RATING_NO_VOTES') . "";
				} else {
					if ($song["rating"] < 1) {
						echo " " . JText::_('COM_JAMLA_RATING_ERROR') . "";
					} else if (($song["rating"] >= 1) && ($song["rating"] < 1.9)) {
						$songtext = $ratingtextone;
					} else if (($song["rating"] >= 2) && ($song["rating"] < 2.9)) {
						$songtext = $ratingtexttwo;
					} else if (($song["rating"] >= 3) && ($song["rating"] < 3.9)) {
						$songtext = $ratingtextthree;
					} else if (($song["rating"] >= 4) && ($song["rating"] < 4.9)) {
						$songtext = $ratingtextfour;
					} else if ($song["rating"] == 5) {
						$songtext = $ratingtextfive;
					} else {
						echo " " . JText::_('COM_JAMLA_RATING_ERROR') . "";
					}
				}
			}


			if ($song["songtype"] == 'S') {
				if ($song["rating"] == 0) {
					echo "<img src='" . JURI::base() . "media/jamla/images/not-rated.png' title=\"" . JText::_('COM_JAMLA_RATING_NOT_YET_RATED') . "\" border='0'>";
				} else {
					$songRatingStars = ($song["rating"] * 20);
					?>

					<ul class="star-rating">
						<li class='current-rating' style='width:<?php echo $songRatingStars; ?>px;'><?php echo JText::_('COM_JAMLA_RATING_CURRENT_STARS_1'); ?> <?php echo $song["rating"]; ?> <?php echo JText::_('COM_JAMLA_RATING_CURRENT_STARS_2'); ?>.</li>
						<li><a title="<?php echo $songtext; ?> - (<?php echo $song["rating"]; ?>)" class="one-star">1</a></li>
						<li><a title="<?php echo $songtext; ?> - (<?php echo $song["rating"]; ?>)" class="two-stars">2</a></li>
						<li><a title="<?php echo $songtext; ?> - (<?php echo $song["rating"]; ?>)" class="three-stars">3</a></li>
						<li><a title="<?php echo $songtext; ?> - (<?php echo $song["rating"]; ?>)" class="four-stars">4</a></li>
						<li><a title="<?php echo $songtext; ?> - (<?php echo $song["rating"]; ?>)" class="five-stars">5</a></li>
					</ul>
					<script>
						function VotesOpen() {
							var w = 300;
							var h = 350;
							var winl = (screen.width - w) / 2;
							var wint = (screen.height - h) / 2;
							var winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=yes,resizable';
							var win = window.open('index.php?option=com_jamla&view=votes&id=<?php echo $song['songID']; ?>&tmpl=component', 'VotesOpen', winprops);
							if (parseInt(navigator.appVersion) >= 4)
								win.window.focus();
						}
					</script>
					<?php
					echo "&nbsp;&nbsp;&nbsp;" . JText::_('COM_JAMLA_RATING_OUT OF') . " " . $votesData["votes"];
					if ($votesData["votes"] == 1) {
						echo " <a href='javascript:VotesOpen();'>" . JText::_('COM_JAMLA_RATING_VOTE') . "</a>";
					} else {
						echo " <a href='javascript:VotesOpen();'>" . JText::_('COM_JAMLA_RATING_VOTES') . "</a>";
					}

				}
			} else {
				echo " " . JText::_('COM_JAMLA_RATING_ERROR') . "";
			}

			?>
		</div>
	</div>
	<div style="clear: left;"></div><!-- End Rating Overall -->

	<!-- Your Rating -->
	<?php if (($song["songtype"] == 'S') && !$user->guest) { ?>
	<form name="theForm" method="POST" action="index.php?option=com_jamla&view=ratesong&tmpl=component">
	<input type="hidden" name="songID" value="<?php echo $song["songID"] ?>">
	<input type="hidden" name="page" value="artist">
	<?php } ?>
	<div class="yourrating-labelSongInfo">
		<?php echo JText::_('COM_JAMLA_RATING_YOU'); ?>:
		<img src="media/jamla/images/spacer.gif" width="15" height="13">
	</div>
	<div class="yourratingSongInfo">
		<div style="font-family: Verdana, Arial, Helvetica;">
			<?php
			if ($user->id >= 1) {
				if ($song["songtype"] == 'S') {
					if ($the_rating["rating"] == null) {
						$my_rating = 0;
					} else {
						$my_rating = $the_rating["rating"];
					}

					//InputComboRating("rating",$my_rating,0,'0, 1, 2, 3, 4, 5');

					?>
					<script>
						function rate(rating) {
							var w = 600;
							var h = 350;
							var winl = (screen.width - w) / 2;
							var wint = (screen.height - h) / 2;
							winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars=no,resizable=no'
							win = window.open('/index.php?option=com_jamla&view=ratesong&id=<?php echo $song["songID"]; ?>&tmpl=component&rating=' + rating, 'rating', winprops)
							if (parseInt(navigator.appVersion) >= 4)
								win.window.focus();
						}
					</script>

					<?php

					if ($song["songtype"] == 'S') {
						$userRatingStars = ($my_rating * 20);
					} else {
						echo " " . JText::_('COM_JAMLA_RATING_ERROR') . "";
					}
					?>

					<ul class='star-rating'>
						<li class='current-rating' style='width:<?php echo $userRatingStars; ?>px;'><?php echo JText::_('COM_JAMLA_RATING_CURRENT_STARS_1'); ?> <?php echo $song["rating"]; ?> <?php echo JText::_('COM_JAMLA_RATING_CURRENT_STARS_2'); ?>.</li>
						<li><a href="javascript:void(1);" onClick="rate(1);" title="<?php echo $ratingtextone; ?>" class="one-star">1</a></li>
						<li><a href="javascript:void(2);" onClick="rate(2);" title="<?php echo $ratingtexttwo; ?>" class="two-stars">2</a></li>
						<li><a href="javascript:void(3);" onClick="rate(3);" title="<?php echo $ratingtextthree; ?>" class="three-stars">3</a></li>
						<li><a href="javascript:void(4);" onClick="rate(4);" title="<?php echo $ratingtextfour; ?>" class="four-stars">4</a></li>
						<li><a href="javascript:void(5);" onClick="rate(5);" title="<?php echo $ratingtextfive; ?>" class="five-stars">5</a></li>
					</ul>


				<?php
				} else {
					echo JText::_('COM_JAMLA_RATING_CANNOT_RATE');
				}
			} else {
				echo JText::sprintf('COM_JAMLA_PLAYLIST_REQUEST_LOGIN_2', JRoute::_('index.php?option=com_users&view=login'), JRoute::_('index.php?option=com_users&view=registration'));
			}
			?>
			<?php /* &nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?option=com_jamla&view=playlist&file=rating_costs' onclick='openOther(this.href, 550, 600);return false;'>Rating costs</a> */ ?>
		</div>

	</div>
	<?php
	if (($song["songtype"] == 'S') && !$user->guest) {
		echo "</form>";
	}
	?>
	<div style="clear: both;"></div>
	<!-- End Ratings -->

	<div class="artistBlock">
		<?php echo $song["info"]; ?>
	</div>

	<div class="requestSongInfo">
		<p align="center">

		<div style="font-family: Verdana, Arial, Helvetica;">
			<?php
			if ($user->guest) {
				echo JText::sprintf('COM_JAMLA_PLAYLIST_REQUEST_LOGIN_1', JRoute::_('index.php?option=com_users&view=login'), JRoute::_('index.php?option=com_users&view=registration'));
			}
			if (($user->id >= 1) && ($song["songtype"] == 'S')) {
				if (($disableRequestsForRecentlyPlayedSongs) && ($song["date_played"] > date("Y-m-d H:i:s", time() - $songWait * 60))) {
					$color = "red";
				} else {
					if (($disableRequestsForQueuedSongs) && (in_array($song["ID"], $theQueueIDs))) {
						$color = "yellow";
					} else {
						if (($disableRequestsForQueuedArtists) && (in_array($song["artist"], $theQueueArtists))) {
							$color = "green";
						} else {
							$color = "blue";
						}
					}
				}
				echo "<a href='index.php?option=com_jamla&view=req&id=" . $song["ID"] . "'>";
				echo("<img src='" . JURI::base() . "media/jamla/images/request-$color.gif' title=\"" . JText::sprintf('COM_JAMLA_PLAYLIST_ALBUM_REQUEST_LINK_1', htmlspecialchars($song["title"]), htmlspecialchars($song["artist"])) . "\" border='0'>");
				echo("</a>");
				echo("&nbsp;");
				if (($color == "green") or ($color == "blue")) {
					echo "<a href=\"javascript:dedicateRequest(" . $song["ID"] . ");\">";
					echo("<img src='" . JURI::base() . "media/jamla/images/dedicate-$color.gif' title=\"" . JText::sprintf('COM_JAMLA_PLAYLIST_ALBUM_REQUEST_LINK_2', htmlspecialchars($song["title"]), htmlspecialchars($song["artist"])) . "\" border='0'>");
					echo("</a>");
				}
				?>

				<img src="media/jamla/images/spacer.gif" width="15" height="13" />

				<img src="media/jamla/images/spacer.gif" width="15" height="13" />

				<?php
				if ($user->id >= 2) {
				}
			}
			?>
		</div>
	</div>

	<?php
	if ($song["info"] == "") {
		?>
		<div style="clear: both;"></div>
	<?php
	}
	?>

	<div class="commentsBlock">
		<?php
		$userCommentLink = "";
		//if ($userdata["request_time"] < 60) {
		$itemid = (JRequest::getVar('Itemid')) ? '&Itemid='.JRequest::getVar('Itemid') : '';
		$userCommentLink = "<a href='" . JRoute::_("index.php?option=com_jamla&view=addcomments&mode=add&id=" . $songid) . $itemid . "'>" . JText::_('COM_JAMLA_SONGINFO_ADD_COMMENT') . "</a>";
		//}

		?>


		<div class="addComment">
			<?php if ($user->id >= 1) { ?>
				<?php echo
				$userCommentLink; ?>
			<?php } ?>
		</div>

		<b><?php echo JText::_('COM_JAMLA_SONGINFO_COMMENTS'); ?></b>
		<hr />

		<?php
		if ($song["title"] == "") {
			?>

			<span style="font-family: Verdana, Arial, Helvetica; font-size: xx-small; "><?php echo JText::_('COM_JAMLA_SONGINFO_NO_SONG'); ?></span>

		<?php
		} else {

			while (list($key, $songComment) = each($songComments)) {
				$commentCounter++;
				$bgcolor = "#EFEFEF";
				if (($commentCounter % 2) == 1) {
					$bgcolor = "#DEE3E7";
				}

				$userLinks = "";
				if ($songComment['userid'] == $user->id || $user->groups == 25) {
					$userLinks .= "(<a href='index.php?option=com_jamla&view=addcomments&mode=edit&id=" . $songComment["id"] . "&id=" . $song["songID"] . "'>" . JText::_('COM_JAMLA_SONGINFO_COMMENT_EDIT') . "</a> | <a href='index.php?option=com_jamla&view=addcomments&mode=delete&id=" . $songComment["id"] . "&id=" . $song["songID"] . "'>" . JText::_('COM_JAMLA_SONGINFO_COMMENT_DELETE') . "</a>)";
				}
				?>

				<div class="commentBlock">
					<div class="comment">
						"<?php echo nl2br(html_entity_decode($songComment['comments'])); ?>"
					</div>
					<div class="commentor">
						<?php echo $songComment['username']; ?>&nbsp;&nbsp;<?php echo
						$userLinks; ?><br />

						<?php echo
						date('M d, Y g:i:s A', strtotime($songComment['create_date'])); ?>

						<?php
						if ($songComment['update_date'] > $songComment['create_date']) {
							echo "<br />" . JText::_('COM_JAMLA_SONGINFO_COMMENT_EDITED') . ": " .
								date('M d h:i a', strtotime($songComment['update_date'])) . "";
						}
						?>
					</div>
				</div>
				<div style="clear: right;"></div>

			<?php
			}
		}
		?>
	</div>

	<div class="lyricsBlock">
		<b><?php echo JText::_('COM_JAMLA_SONGINFO_LYRICS'); ?></b>
		<hr />

		<script>
			function addLyric(songID) {
				var w = 700;
				var h = 400;
				var winl = (screen.width - w) / 2;
				var wint = (screen.height - h) / 2;
				winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=no,resizable=no'
				win = window.open('index.php?option=com_jamla&view=addlyrics&id=' + songID + '&tmpl=component', 'addLyric', winprops)
				if (parseInt(navigator.appVersion) >= 4)
					win.window.focus();
			}
		</script>

		<?php if ($user->id >= 1) { ?>
			<?php if ($song["lyrics"] == "") { ?>
				<a href="javascript:addLyric(<?php echo $song["songID"]; ?>);"><?php echo JText::_('COM_JAMLA_SONGINFO_ADD_LYRICS'); ?></a><br>
			<?php
			}
		} ?>

		<?php
		if ($song["title"] == "") {
			?>

			<?php echo JText::_('COM_JAMLA_SONGINFO_NO_SONG'); ?>

		<?php
		} else {
			?>

			<?php
			if ($user->id >= 0) {
				if ($song["lyrics"] == "") {
					?>
					<?php echo JText::_('COM_JAMLA_SONGINFO_NO_LYRICS'); ?>
				<?php
				} else {
					echo "<div class='lyrics'>" . stripslashes(($song["lyrics"])) . "</div>";
				}
			} //else
			//echo "Please <strong>login</strong> or <strong>register</strong> to use this feature.";
			?>
		<?php
		}
		?>
		<div style="font-size: 12px; padding-top: 20px;">
			<?php echo JText::_('COM_JAMLA_SONGINFO_LYRICS_DISCLAIMER'); ?>
			<br>
			<b><?php echo $station; ?> <?php echo JText::_('COM_JAMLA_SONGINFO_LYRICS_DISCLAIMER_2'); ?></b><br><br>
		</div>
	</div>

	</div>
</div>