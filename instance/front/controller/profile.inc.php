<?php

/**
 * Profile Module
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "detail":
        $userID = trim($_REQUEST['userId']);
        profile::ProfileDetailWithPost($userID);
        break;

    default:
        json_die('404', 'Page Not Found');
        break;
}

die;