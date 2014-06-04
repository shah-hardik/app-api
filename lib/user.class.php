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
        $query = "select id from user where (username = '{$userName}' OR email = '{$userName}') AND password = '{$password}' LIMIT 0,1 ";

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
     * 
     * Facebook Token Login
     * 
     * 
     * @param string $email
     * @param string $facebookToken
     */
    public static function facebookTokenlogin($email, $facebookToken) {
        $email = _escape($email);
        $facebookToken = _escape($facebookToken);


        # validation for blank username
        if (trim($email) == '') {
            json_die('502', 'Email cannot be blank');
        }
        # validation for blank password
        if (trim($facebookToken) == '') {
            json_die('502', 'Facebook Token cannot be blank');
        }

        $facebookToken = trim($facebookToken);
        $query = "select id from user where email = '{$email}' AND facebook_token = '{$facebookToken}' LIMIT 0,1 ";

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
            json_die("502", 'Sorry, Invalid email or facebookToken.');
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

    /**
     * 
     * User Profile Picture
     * 
     * 
     * @param string $userId
     * @param string $photo_stream
     */
    public static function profilePicture($userId, $photo_stream) {
        # validation for blank userId
        if (trim($userId) == '') {
            json_die('502', 'userId cannot be blank');
        }
        # validation for blank photo_stream
        if (trim($photo_stream) == '') {
            json_die('502', 'Photo stream cannot be blank');
        }
        $base = trim($photo_stream);

        $binary = base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
        $chars = rand(0000, 9999) . "_" . time();

        $picture = _PATH . "user_img/" . $chars . ".jpg";
        $picture_img = $chars . ".jpg";
        if ($picture != '') {
            $file = fopen($picture, 'wb');
            fwrite($file, $binary);
            fclose($file);
            $data['user_id'] = $userId;
            $data['picture'] = $picture_img;
            $res = qs("SELECT id from user_profile_picture WHERE user_id = " . $userId);
            if (empty($res)) {
                $photo_id = qi('user_profile_picture', $data);
                json_die("200", "Profile picture saved successfully", array('photo_id' => $photo_id));
            } else {
                $photo_id = $res['id'];
                $data_update['picture'] = $picture_img;
                $res1 = qu('user_profile_picture', $data_update, " user_id = " . $userId);
                json_die("200", "Profile picture saved successfully", array('photo_id' => $photo_id));
            }
        }
    }

    public static function GetProfilePicture($userId) {
        $res = qs("SELECT * FROM user_profile_picture WHERE user_id = " . $userId);
        if (!empty($res)) {
            $img_path = _U . 'user_img/' . $res['picture'];
        } else {
            $img_path = 'Not Available';
        }
        return $img_path;
    }

}
