<?php

/**
 * Alert Module
 * 
 * Alert calls for Neighborhoods
 *  
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "stream":
        $userID = trim($_REQUEST['userID']);
        alert::stream($userID);
        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;
?>
