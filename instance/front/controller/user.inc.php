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
        user::login($user_name, $_REQUEST['password']);
        break;
    case "profilePicture":
        user::profilePicture();
        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;
