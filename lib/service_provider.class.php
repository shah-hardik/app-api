<?php

/**
 * service_provider class
 *
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 */
class service_provider {

    public function __construct() {
        
    }

    public static function SearchServiceProvider($provider_nm) {
        # validation for blank provider
        if ($provider_nm == '') {
            json_die('502', 'Search string is required');
        }

        $query = "SELECT * FROM service_provider WHERE name LIKE '%" . $provider_nm . "%'";
        $res = q($query);
        if (empty($res)) {
            json_die("404", 'No service provider found!');
        } else {
            $count_provider = count($res);
            $i = 0;
            foreach ($res as $each_res) {
                $dataList[$i]['title'] = $each_res['name'];
                $dataList[$i]['location'] = 'Not Available';
                $dataList[$i]['associatedNeis'] = 'Not Available';
                $dataList[$i]['serviceProviderId'] = $each_res['id'];
                $i++;
            }
            json_die("200", "", array('count' => $count_provider, 'dataList' => $dataList));
        }
    }

    public static function SearchCategoryName($categoryString) {
        # validation for blank category name
        if ($categoryString == '') {
            json_die('502', 'Category name is required');
        }

        $query = "SELECT SP.*,
                         SPC.id as cat_id,
                         SPC.name as cat_name 
                    FROM service_provider SP,
                         service_provider_category SPC,
                         service_provider_has_service_provider_category SPH 
                   WHERE SPC.name LIKE '%" . $categoryString . "%' 
                     AND SPC.id = SPH.service_provider_category_id 
                     AND SPH.service_provider_id = SP.id";
        $res = q($query);
        if (empty($res)) {
            json_die("404", 'No category found!');
        } else {
            $count_provider = count($res);
            $i = 0;
            foreach ($res as $each_res) {
                $dataList[$i]['title'] = $each_res['cat_name'];
                $dataList[$i]['location'] = 'Not Available';
                $dataList[$i]['associatedNeis'] = 'Not Available';
                $dataList[$i]['serviceProviderId'] = $each_res['id'];
                $i++;
            }
            json_die("200", "", array('count' => $count_provider, 'dataList' => $dataList));
        }
    }

    public static function ServiceProviderDetail($serviceProId) {
        # validation for blank serviceProId
        if ($serviceProId == '') {
            json_die('502', 'Service provider id is required');
        }

        $query = "SELECT U.id,
                         U.username,
                         U.first_name,
                         U.last_name,
                         U.address,
                         U.city,
                         U.state,
                         U.zipcode,
                         U.phone_no 
                    FROM service_provider SP,
                         user_has_service_provider UHS,
                         user U 
                   WHERE SP.id = '" . $serviceProId . "' 
                     AND SP.id = UHS.service_provider_id 
                     AND UHS.user_id = U.id";
        try {
            $res = qs($query);
            if (empty($res)) {
                json_die("404", 'No service provider found!');
            } else {
                $address = $res['address'] . " " . $res['city'] . " " . $res['state'] . " " . $res['zipcode'];
                $data_arr = array('address' => $address,
                    'geo' => $address,
                    'phone' => $res['phone_no']);
                json_die("200", "", $data_arr);
            }
        } catch (Exception $e) {
            json_die("502", 'Unable to take service provider now');
        }
    }

    public static function ProviderVerify($serviceProId) {
        # validation for blank serviceProId
        if ($serviceProId == '') {
            json_die('502', 'Service provider id is required');
        }

        try {
            qu("service_provider", array('is_verified' => 1), " id = " . $serviceProId);
            json_die("200", 'Request received');
        } catch (Exception $e) {
            json_die("502", 'Unable to take request now');
        }
    }

}

?>
