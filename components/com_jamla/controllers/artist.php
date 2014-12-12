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



// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');
require_once(JPATH_COMPONENT . '/controller.php');

class JamlaControllerArtist extends JamlaController
{

	function display()
	{
		parent::display();
	}

	function request()
	{
		$input = JFactory::getApplication()->input;
		$songid = $input->getInt('songid');
		$params = JComponentHelper::getParams('com_jamla');
		$samhost = $params['samhost'];
		$samport = $params['samport'];

		/*
 settype($songid,"integer"); //Make sure songID is an integer to avoid SQL injection

 $host = $GLOBALS["REMOTE_ADDR"];

 $request = "GET /req/?songID=$songid&host=".urlencode($host)." HTTP\1.0\r\n\r\n";

$xmldata = "";
$fd = @fsockopen($samhost,$samport, $errno, $errstr, 30);
//$fd = fopen("http://$samhost:$samport/req/?songID=$songID&host=".urlencode($host),"r");
//echo "fd=$fd";
if(!empty($fd))
{
	fputs ($fd, $request);
	$line="";
  	while(!($line=="\r\n"))
  	{
		$line=fgets($fd,128);
	}	// strip out the header
  	while ($buffer = fgets($fd, 4096))
 	{
		$xmldata  .= $buffer;
	}
 	fclose($fd);
}* */
		$songid = 56;


		$request = "GET /req/?songID=$songid&host=".urlencode($samhost)." HTTP\1.0\r\n\r\n";

		$fp = stream_socket_client($samhost . ":" . $samport, $errno, $errstr, 30);
		if (!$fp)
		{
			echo "$errstr ($errno)<br />\n";
		}
		else
		{
			fwrite($fp, $request);
			while (!feof($fp))
			{
				$response = fgets($fp, 4096);
			}
			fclose($fp);
		}



		echo $response;
		exit();


		///$this->display();
	}
}
