<?php

/**
 * Neighborhood class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class nei {

    public function __construct() {
        
    }

    /**
     * Web-Services endpoint for /api/nei/list
     * 
     * It finds out near by neis based upon lat/lng
     * 
     * From Lucas as on May 28, 2014
     * instead, we will send a coordinate (latitude and longitude), and the API should return near neighbourhoods
     * when we create a neighbourhood, we will put a zipcode
     * with that zipcode, you can get the location, and using the coordinates in the nei-list service, you can know the location of the user
     * and filter just near neighbourhoods
     * 
     * Near by queries:
     * SELECT ((ACOS(SIN($lat * PI() / 180) * SIN(lat * PI() / 180) + COS($lat * PI() / 180) * COS(lat * PI() / 180) * COS(($lon – lon) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS `distance` FROM `members` HAVING `distance`<=’10′ ORDER BY `distance` ASC
     * 
     */
    public static function doList($userID, $lat, $lon) {
        $user_wherecon = '';
        if ($userID > 0 && $userID != '') {
            $user_wherecon = " AND U.id = " . $userID;
        }
        if ($lat != '' && $lon != '') {

            $lat_lon_calculation = "((ACOS(SIN({$lat} * PI() / 180) * SIN(N.location_latitude * PI() / 180) + COS({$lat} * PI() / 180) * COS(N.location_latitude * PI() / 180) * COS(({$lon} - N.location_longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)";
            $query = "SELECT 
                             N.name as neiName,
                              N.users_count,
                              U.email,
                              U.username,
                              U.first_name,
                              U.last_name,
                              U.address,
                              U.city,
                              U.state,
                              U.zipcode,
                              U.phone_no,
                              " . $lat_lon_calculation . " AS distance 
                              FROM neighborhood N,
                              neighborhood_has_user NHU,
                              user U
                              WHERE N.id = NHU.neighborhood_id 
                              AND " . $lat_lon_calculation . " <= 10 
                              AND NHU.user_id = U.id " . $user_wherecon;
        } else {
            $query = "SELECT N.id as neiId,
                              N.name as neiName,
                              N.users_count,
                              U.email,
                              U.username,
                              U.first_name,
                              U.last_name,
                              U.address,
                              U.city,
                              U.state,
                              U.zipcode,
                              U.phone_no
                              FROM neighborhood N,
                              neighborhood_has_user NHU,
                              user U
                              WHERE N.id = NHU.neighborhood_id
                              AND NHU.user_id = U.id " . $user_wherecon;
        }
        try {
            $res = q($query);
            if (empty($res)) {
                json_die("404", 'No neighborhoods found!');
            } else {
                $total_naiId = count($res);
                $i = 0;
                foreach ($res as $each_res) {
                    $dataList[$i]['neiId'] = $each_res['neiId'];
                    $dataList[$i]['neiName'] = $each_res['neiName'];
                    $dataList[$i]['city'] = $each_res['city'];
                    $dataList[$i]['country'] = $each_res['state'];
                    $dataList[$i]['count'] = ($each_res['users_count'] > 0) ? $each_res['users_count'] : '0';
                    $i++;
                }
                json_die("200", "", array('count' => $total_naiId, 'dataList' => $dataList));
            }
        } catch (Exception $e) {
            d($e);
            die;
            json_die("502", 'Unable retrive');
        }
    }

    /**
     * Web-Services endpoint for /api/nei/create
     * 
     */
    public static function add() {

        # sanitize the inputs
        $data = array();
        $data_user = array();
        $data['name'] = _escape($_REQUEST['name']);
        $data['location'] = _escape($_REQUEST['location']);
        $data['is_public'] = _escape($_REQUEST['visibility']);
        $data['is_join_restricted'] = _escape($_REQUEST['allowOthers']);
        $data_user['user_id'] = _escape($_REQUEST['userID']);

        # validation for blank neighborhood name
        if (trim($data['name']) == '') {
            json_die('502', 'Name is required');
        }

        # validation for blank userID
        if (trim($data_user['user_id']) == '') {
            json_die('502', 'userID is required');
        }

        # validation for visibility allowed value
        if (strtolower(trim($data['is_public'])) != 'public' && strtolower(trim($data['is_public'])) != 'private') {
            json_die('502', 'Visibility allowed only public or private');
        }

        # validation for visibility allowed value
        if (strtolower(trim($data['is_join_restricted'])) != 'yes' && strtolower(trim($data['is_join_restricted'])) != 'no') {
            json_die('502', 'Allow Others allowed Yes or No');
        }

        try {

            if (strtolower(trim($data['is_join_restricted'])) == 'yes') {
                $data['is_join_restricted'] = 1;
            } else {
                $data['is_join_restricted'] = 0;
            }

            if (strtolower(trim($data['is_public'])) == 'public') {
                $data['is_public'] = 1;
            } else {
                $data['is_public'] = 0;
            }

            $neiId = qi('neighborhood', $data);

            $data_user['neighborhood_id'] = $neiId;
            q('SET FOREIGN_KEY_CHECKS=0');
            $neiId_has = qi('neighborhood_has_user', $data_user);
            q('SET FOREIGN_KEY_CHECKS=1');
            json_die("200", "Neighborhood created successfully", array('neiId' => $neiId));
        } catch (Exception $e) {
            json_die("502", 'Unable to create neighborhood.');
        }
    }

    public static function search($name) {

        if ($name == '') {
            json_die('502', 'Search string is required');
        }

        $query = "SELECT N.*,
                         U.username,
                         U.first_name,
                         U.last_name,
                         U.email,
                         U.address,
                         U.city,
                         U.state,
                         U.zipcode 
                    FROM neighborhood N,
                         neighborhood_has_user NHU,
                         user U 
                   WHERE N.name LIKE '%" . $name . "%' 
                     AND N.id = NHU.neighborhood_id 
                     AND U.id = NHU.user_id";

        $res = q($query);
        if (empty($res)) {
            json_die("404", 'No neighborhoods found!');
        } else {
            $total_nel = count($res);
            $i = 0;
            foreach ($res as $each_res) {
                $dataList[$i]['neiId'] = $each_res['id'];
                $dataList[$i]['neiName'] = $each_res['name'];
                $dataList[$i]['city'] = $each_res['city'];
                $dataList[$i]['country'] = $each_res['state'];
                $dataList[$i]['count'] = ($each_res['users_count'] > 0) ? $each_res['users_count'] : '0';
                $i++;
            }
            json_die("200", "", array('count' => $total_nel, 'dataList' => $dataList));
        }

        die;
    }

    public static function detail($neiId) {

        if ($neiId == '') {
            json_die('502', 'Neighborhood id is required');
        }

        $query = "SELECT N.*,
                         U.username,
                         U.first_name,
                         U.last_name,
                         U.email,
                         U.address,
                         U.city,
                         U.state,
                         U.zipcode 
                    FROM neighborhood N,
                         neighborhood_has_user NHU,
                         user U 
                   WHERE N.id = " . $neiId . "  
                     AND N.id = NHU.neighborhood_id 
                     AND U.id = NHU.user_id";
        $res = qs($query);
        if (empty($res)) {
            json_die('502', 'Unable to retrieve detail');
        } else {
            $data['title'] = $res['name'];
            $data['user'] = $res['first_name'] . " " . $res['last_name'];
            $data['location'] = $res['location'];
            $data['neiID'] = $res['id'];
            json_die("200", "", $data);
        }
    }

    public static function blocked($neiID, $userID) {
        if ($neiID == '') {
            json_die('502', 'Neighborhood id is required');
        }
        if ($userID == '') {
            json_die('502', 'User id is required');
        }

        $data = array();
        $data_user = array();
        $data['neighborhood_id'] = _escape($neiID);
        $data['user_id'] = _escape($userID);
        try {
            $nei_block_Id = qi('neighborhood_blocked_user', $data);
            json_die("200", "Neighborhood blocked successfully.");
        } catch (Exception $e) {
            json_die("502", 'Unable to block neighborhood now.');
        }
    }

    public static function IncomingInvite($user_id_to) {
        if ($user_id_to == '') {
            json_die('502', 'user id is required');
        }

        $query = "  SELECT NI.*,
                                U.username,
                                U.email,
                                U.first_name,
                                U.last_name,
                                U.id as UserID  
                           FROM neighborhood_invite NI,
                                user U
                          WHERE NI.user_id_to = '" . $user_id_to . "' 
                            AND NI.user_id_from = U.id";
        $res = q($query);
        if (empty($res)) {
            json_die("404", 'Not any invitation!');
        } else {
            $total_nel = count($res);
            $i = 0;
            foreach ($res as $each_res) {
                $inviteList[$i]['picture'] = User::GetProfilePicture($each_res['UserID']);
                $inviteList[$i]['inviteFrom'] = $each_res['first_name'] . " " . $each_res['last_name'];
                $i++;
            }
            json_die("200", "", array('count' => $total_nel, 'inviteList' => $inviteList));
        }
    }

    public static function InvitationAccept($invite_id, $status) {
        if ($invite_id == '') {
            json_die('502', 'invite id is required');
        }
        if ($status == '') {
            json_die('502', 'Accept value is required');
        }
        if (strtolower($status) != 'yes' && strtolower($status) != 'no') {
            json_die('502', 'Accept value allowed only Yes or No');
        }
        try {
            if (strtolower($status) == 'yes') {
                $msg_status = "accepted";
                $status_db = 1;
            } elseif (strtolower($status) == 'no') {
                $msg_status = "declined";
                $status_db = 2;
            }
            qu("neighborhood_invite", array("invite_status" => $status_db), " id = " . $invite_id);
            json_die("200", "Invitation " . $msg_status);
        } catch (Exception $e) {
            json_die("502", 'Unable to update invitation status');
        }
    }

    public static function delete($neiID) {
        if ($neiID == '') {
            json_die('502', 'neighborhood id is required');
        }
        try {
            qd("neighborhood", " id = '" . $neiID . "'");
            json_die("200", "Neighborhood deleted succesfully");
        } catch (Exception $e) {
            d($e);
            die;
            json_die("502", 'Unable to delete neighborhood');
        }
    }

}
