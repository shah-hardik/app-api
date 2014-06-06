<?php

/**
 * Nei Module
 * 
 * API calls for Neighborhoods
 *  
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "list":
        $userId = trim($_REQUEST['userId']);
        if ($userId == '') {
            $userId = trim($_REQUEST['userID']);
        }
        $latitude = trim(_escape($_REQUEST['latitude']));
        $longitude = trim(_escape($_REQUEST['longitude']));
        nei::doList($userId, $latitude, $longitude);
        break;
    case "create":
        nei::add();
        break;
    case "search":
        $name = trim($_REQUEST['searchString']);
        nei::search($name);
        break;
    case "detail":
        nei::detail(trim($_REQUEST['neighborhood_id']));
        break;
    case "share":

        break;
    case "block":
        $neiID = trim($_REQUEST['neiId']);
        $userID = trim($_REQUEST['userId']);
        nei::blocked($neiID, $userID);
        break;
    case "incomingInvite":
        $userID = trim($_REQUEST['userId']);
        nei::IncomingInvite($userID);
        break;
    case "inviteStatus":
        $invite_id = trim($_REQUEST['invite_id']);
        $Accept = trim($_REQUEST['Accept']);
        nei::InvitationAccept($invite_id, $Accept);
        break;
    case "delete":
        $neiID = trim($_REQUEST['neiId']);
        nei::delete($neiID);
        break;
    case "stream":

        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;