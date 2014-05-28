<?php

/**
 * User class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class user {

    public function __construct() {
        
    }

    /**
     * Web-Services endpoint for /api/user/signup
     * 
     */
    public static function signup() {

        # sanitize the inputs
        $data = array();
        $data['email'] = _escape($_REQUEST['email']);
        $data['username'] = _escape($_REQUEST['username']);
        $data['password'] = _escape($_REQUEST['password']);
        $data['last_name'] = _escape($_REQUEST['lastName']);
        $data['first_name'] = _escape($_REQUEST['firstName']);
        $data['address'] = _escape($_REQUEST['address']);
        $data['city'] = _escape($_REQUEST['city']);
        $data['state'] = _escape($_REQUEST['state']);
        $data['zipcode'] = _escape($_REQUEST['zipcode']);

        # validation for blank username
        if (trim($data['username']) == '') {
            json_die('502', 'Username cannot be blank');
        }

        # validation for blank password 
        if (trim($data['password']) == '') {
            json_die('502', 'Password cannot be blank');
        }

        # validation for if user exists ?
        if (self::userExists($data['username'])) {
            json_die('502', 'Username already exists');
        }

        # finally insert user into database
        $data['password'] = md5($data['password']);
        try {
            $userId = qi('user', $data);
            json_die("200",  "User signed up successfully",array('userId' => $userId));
        } catch (Exception $e) {
            json_die("502", 'Unable to signup now. Please try again later.');
        }
    }

    /**
     * 
     * @param type $username
     * @return type
     */
    public static function userExists($username) {
        $username = _escape($username);
        $userData = q("select id from user where username = '{$username}'  ");
        return count($userData) > 0 ? true : false;
    }

    public static function login($username,$password){
        $username = _escape($username);
        $password = _escape($password);
        
        $query = "";
    }
}
