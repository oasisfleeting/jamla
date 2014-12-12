

CREATE TABLE IF NOT EXISTS `m5lrd_jamla_dj` (
  `id` int(10) NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `username` varchar(150) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `host` varchar(250) NOT NULL DEFAULT '',
  `port` varchar(255) NOT NULL DEFAULT '',
  `dbuser` varchar(255) NOT NULL DEFAULT '',
  `dbpass` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ordering` (`ordering`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*
CREATE view admin_music.m5lrd_jamla_adz
AS
  SELECT * FROM  admin_samdb.adz;

CREATE view admin_music.m5lrd_jamla_category
AS
  SELECT * FROM  admin_samdb.category;

CREATE view admin_music.m5lrd_jamla_categorylist
AS
  SELECT * FROM  admin_samdb.categorylist;

CREATE view admin_music.m5lrd_jamla_currentshow
AS
  SELECT * FROM  admin_samdb.currentshow;

CREATE view admin_music.m5lrd_jamla_disk
AS
  SELECT * FROM  admin_samdb.disk;

CREATE view admin_music.m5lrd_jamla_event
AS
  SELECT * FROM  admin_samdb.event;

CREATE view admin_music.m5lrd_jamla_eventtime
AS
  SELECT * FROM  admin_samdb.eventtime;

CREATE view admin_music.m5lrd_jamla_fixedlist
AS
  SELECT * FROM  admin_samdb.fixedlist;

CREATE view admin_music.m5lrd_jamla_fixedlist_item
AS
  SELECT * FROM  admin_samdb.fixedlist_item;

CREATE view admin_music.m5lrd_jamla_historylist
AS
  SELECT * FROM  admin_samdb.historylist;

CREATE view admin_music.m5lrd_jamla_queuelist
AS
  SELECT * FROM  admin_samdb.queuelist;

CREATE view admin_music.m5lrd_jamla_requesthistory
AS
  SELECT * FROM  admin_samdb.requesthistory;

CREATE view admin_music.m5lrd_jamla_requestlist
AS
  SELECT * FROM  admin_samdb.requestlist;

CREATE view admin_music.m5lrd_jamla_song_comments
AS
  SELECT * FROM  admin_samdb.song_comments;

CREATE view admin_music.m5lrd_jamla_song_lyr
AS
  SELECT * FROM  admin_samdb.song_lyr;

CREATE view admin_music.m5lrd_jamla_song_lyr_temp
AS
  SELECT * FROM  admin_samdb.song_lyr_temp;

CREATE view admin_music.m5lrd_jamla_song_pool
AS
  SELECT * FROM  admin_samdb.song_pool;

CREATE view admin_music.m5lrd_jamla_song_rating
AS
  SELECT * FROM  admin_samdb.song_rating;

CREATE view admin_music.m5lrd_jamla_song_votes
AS
  SELECT * FROM  admin_samdb.song_votes;

CREATE view admin_music.m5lrd_jamla_songlist
AS
  SELECT * FROM  admin_samdb.songlist;

CREATE view admin_music.m5lrd_jamla_top_ten_plays_past_7_days
AS
  SELECT * FROM  admin_samdb.top_ten_plays_past_7_days;

CREATE view admin_music.m5lrd_jamla_your_show
AS
  SELECT * FROM  admin_samdb.your_show;
*/