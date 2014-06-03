<?php

/**
 * User Module
 * 
 * API calls for singup/login
 *  
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "signup":
        user::signup();
        break;
    case "login":
        if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
            $user_name = trim($_REQUEST['username']);
        } else {
            $user_name = trim($_REQUEST['email']);
        }
        if (isset($_REQUEST['password']) && trim($_REQUEST['password']) != '') {
            user::login($user_name, $_REQUEST['password']);
        } elseif (isset($_REQUEST['facebookToken']) && trim($_REQUEST['facebookToken']) != '') {
            user::facebookTokenlogin($user_name, trim($_REQUEST['facebookToken']));
        } else {
            if ($user_name == '') {
                json_die('502', 'Username or Email is required');
            } else {
                json_die('502', 'Password or facebookToken is required');
            }
        }

        break;
    case "profilePicture":
        $userId = trim($_REQUEST['userId']);
        $photo_stream = trim($_REQUEST['photo_stream']);
        user::profilePicture($userId, $photo_stream);
        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;
