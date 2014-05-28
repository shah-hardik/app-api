<?php

/**
 * Service Provider Module
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "search":

        break;
    case "detail":

        break;
    case "verify":

        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;
