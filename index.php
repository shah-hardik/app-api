<?php

/**
 *
 * @author Hardik Shah <hardiks059@gmail.com>
 * @version 1.0
 * @package Neighboring
 * 
 */
session_start();
error_reporting(0);


# DB informaitons
define('DB_HOST', 'localhost');
define('DB_PASSWORD', '');
define('DB_UNAME', 'root');
define('DB_NAME', 'mydb');

//define('DEV_MODE', false);

include "loader.php";
?>