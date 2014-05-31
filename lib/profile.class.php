<?php

/**
 * Neighborhood class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class profile {

    public function __construct() {
        
    }

    public static function ProfileDetailWithPost($userID) {
        if ($userID == '') {
            json_die('502', 'User ID is required');
        }

        $neighbors = "SELECT count(neighborhood_id) as total FROM neighborhood_has_user WHERE user_id = " . $userID;
        $neighbors_count_arr = qs($neighbors);
        $neighbors_count = $neighbors_count_arr['total'];

        $neighborhoods = "SELECT count(user_id_to) as total FROM neighborhood_invite WHERE user_id_to = " . $userID;
        $neighborhoods_count_arr = qs($neighbors);
        $neighborhoods_count = $neighborhoods_count_arr['total'];

        $user_detail = "SELECT * FROM user WHERE id = " . $userID;
        $user_detail_arr = qs($user_detail);

        if (empty($user_detail_arr)) {
            json_die("404", 'No User found!');
        }

        $post_datil = "SELECT * FROM post WHERE user_id = " . $userID;
        $post_datil_arr = q($post_datil);

        $postsCount = count($post_datil_arr);
        $posts = array();
        $i = 0;
        foreach ($post_datil_arr as $each_post) {
            $posts[$i]['postID'] = $each_post['id'];
            $posts[$i]['posterName'] = 'Not Available';
            $posts[$i]['posterPicture'] = $each_post['thumbnail'];
            $posts[$i]['timestamp'] = $each_post['created_at'];
            $posts[$i]['location'] = $user_detail_arr['address'] . " " . $user_detail_arr['city'] . " " . $user_detail_arr['state'] . " " . $user_detail_arr['zipcode'];
            $posts[$i]['postText'] = $each_post['text'];
            $posts[$i]['postContent'] = 'Not Available';
            $posts[$i]['postType'] = $each_post['type'];
            $posts[$i]['likesCount'] = $each_post['likes_count'];
            $posts[$i]['commentsCount'] = $each_post['comments_count'];
            $i++;
        }

        $detail_arg = array('list' => '',
            'neighbors' => $neighbors_count,
            'neighborhoods' => $neighborhoods_count,
            'picture' => 'Not Available',
            'title' => $user_detail_arr['first_name'] . " " . $user_detail_arr['last_name'],
            'location' => $user_detail_arr['address'] . " " . $user_detail_arr['city'] . " " . $user_detail_arr['state'] . " " . $user_detail_arr['zipcode'],
            'description' => 'Not Available',
            'postsCount' => $postsCount,
            'posts' => $posts
        );
        json_die("200", "Profile information retrieved", $detail_arg);
    }

}

?>
