<?php

/**
 * Service Provider Module
 * 
 * @author Hardik Shah<hardiks059@gmail.com>
 * @since May 2014
 * 
 */
switch ($endPoint) {
    case "search":
        if (isset($_REQUEST['categoryString'])) {
            $categoryString = trim($_REQUEST['categoryString']);
            service_provider::SearchCategoryName($categoryString);
        } else {
            $searchString = trim($_REQUEST['searchString']);
            service_provider::SearchServiceProvider($searchString);
        }
        break;
    case "detail":
        $serviceProId = trim($_REQUEST['serviceProId']);
        service_provider::ServiceProviderDetail($serviceProId);
        break;
    case "verify":
        $serviceProId = trim($_REQUEST['serviceProId']);
        service_provider::ProviderVerify($serviceProId);
        break;
    default:
        json_die('404', 'Page Not Found');
        break;
}

die;
