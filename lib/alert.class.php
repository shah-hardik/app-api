<?php

/**
 * Alert class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class alert {

    public function __construct() {
        
    }

    public static function stream($userID) {
        # validation for blank userID
        if ($userID == '') {
            json_die('502', 'userID is required');
        }

        $query = "SELECT UA.*,
                         U.id as UserID, 
                         U.email,
                         U.username,
                         U.first_name,
                         U.last_name 
                    FROM user_alert UA,
                         user U
                   WHERE user_id = " . $userID . " 
                     AND UA.recipient_id = U.id";

        try {
            $res = q($query);
            if (empty($res)) {
                json_die("404", 'No alerts found!');
            } else {
                $i = 0;
                foreach ($res as $each_res) {
                    $stream[$i]['picture'] = User::GetProfilePicture($each_res['UserID']);
                    $stream[$i]['username'] = $each_res['username'];
                    $stream[$i]['alert'] = $each_res['alert'];
                    $stream[$i]['timestamp'] = $each_res['created_at'];
                    $stream[$i]['userId'] = $each_res['recipient_id'];
                    $stream[$i]['postId'] = $each_res['post_id'];
                    $i++;
                }
                json_die("200", "", array('stream' => $stream));
            }
        } catch (Exception $e) {
            json_die("502", 'Unable to getting alert stream.');
        }
    }

}

?>
