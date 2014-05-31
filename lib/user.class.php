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
        $data['phone_no'] = _escape($_REQUEST['phone_no']);

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
        if (self::emailExists($data['email'])) {
            json_die('502', 'Email address already exists');
        }

        # finally insert user into database
        $data['password'] = md5($data['password']);
        try {
            $userId = qi('user', $data);
            json_die("200", "User signed up successfully", array('userId' => $userId));
        } catch (Exception $e) {
            json_die("502", 'Unable to signup now. Please try again later.');
        }
    }

    /**
     * 
     * @param String $userName
     * @return booolean
     */
    public static function userExists($userName) {
        $userName = _escape($userName);
        $userData = q("select id from user where username = '{$userName}'  ");
        return count($userData) > 0 ? true : false;
    }

    /**
     * 
     * @param String $EmailAddress
     * @return booolean
     */
    public static function emailExists($EmailAddress) {
        $EmailAddress = _escape($EmailAddress);
        $userData = q("select id from user where email = '{$EmailAddress}'  ");
        return count($userData) > 0 ? true : false;
    }

    /**
     * 
     * Login routine
     * 
     * 
     * @param string $userName
     * @param string $password
     */
    public static function login($userName, $password) {
        $userName = _escape($userName);
        $password = (_escape($password));


        # validation for blank username
        if (trim($userName) == '') {
            json_die('502', 'Username cannot be blank');
        }
        # validation for blank password
        if (trim($password) == '') {
            json_die('502', 'Password cannot be blank');
        }

        $password = md5($password);
        $query = "select id from user where username = '{$userName}' AND password = '{$password}' LIMIT 0,1 ";

        try {
            $data = qs($query);
        } catch (Exception $exc) {
            json_die("502", 'Unable to login now. Please try again later.');
        }

        if (!empty($data)) {
            # get user id
            $userId = $data['id'];

            # stop existing session
            user::stopSession();
            # create new session
            $sessionId = user::startSession();

            # send the response
            json_die("200", 'Login Successful', array('sessionId' => $sessionId, 'userId' => $userId));
        } else {
            json_die("502", 'Sorry, Invalid username or password.');
        }
    }

    /**
     * Destroy the session data
     * unset session cookie vars
     */
    public static function stopSession() {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    /**
     * Create a new session
     * @return string
     */
    public static function startSession() {
        session_start();
        return session_id();
    }

}
