<?php

/**
 * Feeds class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class feeds {

    public function __construct() {
        
    }

    public static function SearchWithUser($type, $search) {
        $query = "SELECT P.*,
                         U.email,
                         U.first_name,
                         U.last_name,
                         U.username,
                         U.address,
                         U.city,
                         U.state,
                         U.zipcode 
                    FROM post P,
                         user U 
                   WHERE (U.username LIKE '%" . $search . "%' OR 
                          U.first_name LIKE '%" . $search . "%' OR 
                          U.last_name LIKE '%" . $search . "%' OR 
                          U.email LIKE '%" . $search . "%') 
                     AND U.id = P.user_id";
        $res = q($query);
        if (empty($res)) {
            json_die("404", 'No feeds found!');
        } else {

            $postsCount = count($res);
            $posts = array();
            $i = 0;
            foreach ($res as $each_post) {
                $posts[$i]['postID'] = $each_post['id'];
                $posts[$i]['posterName'] = 'Not Available';
                $posts[$i]['posterPicture'] = $each_post['thumbnail'];
                $posts[$i]['timestamp'] = $each_post['created_at'];
                $posts[$i]['location'] = $each_post['address'] . " " . $each_post['city'] . " " . $each_post['state'] . " " . $user_detail_arr['zipcode'];
                $posts[$i]['postText'] = $each_post['text'];
                $posts[$i]['postContent'] = 'Not Available';
                $posts[$i]['postType'] = $each_post['type'];
                $posts[$i]['likesCount'] = $each_post['likes_count'];
                $posts[$i]['commentsCount'] = $each_post['comments_count'];
                $i++;
            }

            $detail_arg = array(
                'postsCount' => $postsCount,
                'posts' => $posts
            );
            json_die("200", "Feeds information retrieved", $detail_arg);
        }
    }

    public static function SearchWithNeighbour($type, $search) {
        $query = "SELECT DISTINCT(P.id), 
                         P.*,
                         U.email,
                         U.first_name,
                         U.last_name,
                         U.username,
                         U.address,
                         U.city,
                         U.state,
                         U.zipcode 
                    FROM post P,
                         user U,
                         neighborhood N,
                         neighborhood_has_user NHU 
                   WHERE N.name LIKE '%" . $search . "%' 
                     AND NHU.neighborhood_id = N.id 
                     AND NHU.user_id = P.user_id  
                     AND U.id = P.user_id";
        $res = q($query);
        if (empty($res)) {
            json_die("404", 'No feeds found!');
        } else {

            $postsCount = count($res);
            $posts = array();
            $i = 0;
            foreach ($res as $each_post) {
                $posts[$i]['postID'] = $each_post['id'];
                $posts[$i]['posterName'] = 'Not Available';
                $posts[$i]['posterPicture'] = $each_post['thumbnail'];
                $posts[$i]['timestamp'] = $each_post['created_at'];
                $posts[$i]['location'] = $each_post['address'] . " " . $each_post['city'] . " " . $each_post['state'] . " " . $user_detail_arr['zipcode'];
                $posts[$i]['postText'] = $each_post['text'];
                $posts[$i]['postContent'] = 'Not Available';
                $posts[$i]['postType'] = $each_post['type'];
                $posts[$i]['likesCount'] = $each_post['likes_count'];
                $posts[$i]['commentsCount'] = $each_post['comments_count'];
                $i++;
            }

            $detail_arg = array(
                'postsCount' => $postsCount,
                'posts' => $posts
            );
            json_die("200", "Feeds information retrieved", $detail_arg);
        }
    }

    public static function SearchWithTrends($type, $search) {
        json_die("404", 'No feeds found!');
    }

}

?>
