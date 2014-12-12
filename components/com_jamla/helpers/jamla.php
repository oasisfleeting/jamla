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
defined('_JEXEC') or die;

class JamlaFrontendHelper {

    /**
     * Get category name using category ID
     * @param integer $category_id Category ID
     * @return mixed category name if the category was found, null otherwise
     */
    public static function getCategoryNameByCategoryId($category_id) {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select('title')
            ->from('#__categories')
            ->where('id = ' . intval($category_id));

        $db->setQuery($query);
        return $db->loadResult();
    }

	public static function parseArt($json)
	{
		$out = json_decode($json,true);

		$musicbrainz['mbid'] = $out['mbid'];

		$imgs = $out['img'];
		$imgs = json_decode($imgs,true);


		$images = $imgs['images'][0];
		$types = $images['types'];

		/*foreach($types as $key=>$val)
		{
			$musicbrainz['images'][] =
		}*/

		/*echo "<pre>";
		print_r($imgs);
		echo "</pre>";	*/

		$thumbs = $images['thumbnails'];
		$musicbrainz['image'] = $images['image'];
		$musicbrainz['thumbs'] = $thumbs;

		return $musicbrainz;


	}


}
