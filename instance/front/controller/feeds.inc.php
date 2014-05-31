<?php

/**
 * Feeds Module
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "list":
        $type = strtolower(trim($_REQUEST['type']));
        $searchString = trim($_REQUEST['searchString']);
        if ($type == '') {
            json_die('502', 'Type is required');
        } elseif ($type != 'user' && $type != 'neighbourhood' && $type != 'trends') {
            json_die('502', 'Type allowed only user,neighbourhood or trends');
        }

        if ($searchString == '') {
            json_die('502', 'Search string is required');
        }

        if ($type == 'user') {
            feeds::SearchWithUser($type, $searchString);
        } elseif ($type == 'neighbourhood') {
            feeds::SearchWithNeighbour($type, $searchString);
        } elseif ($type == 'trends') {
            feeds::SearchWithTrends($type, $searchString);
        }

        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}
die;