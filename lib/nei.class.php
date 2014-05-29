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
    public static function doList() {
        $query = "SELECT ((ACOS(SIN({$lat} * PI() / 180) * SIN(location_latitude * PI() / 180) + COS({$lat} * PI() / 180) * COS(location_latitude * PI() / 180) * COS(({$lon} – location_longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance FROM  neighborhood HAVING distance<=10 ORDER BY distance ASC";
    }

}
