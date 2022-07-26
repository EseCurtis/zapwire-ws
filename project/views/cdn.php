
<?php
    global $app;

    $cdn_data = [
        "zapwire-js" => [
            "fallback" => "zapwire-js/v1.0.0.js",
            "content-Type" => "application/javascript",

            "cdn_data" => [
                "api_endpoint" => $app->url("src/amvc.api"),
                "zapwire_socket_server" => $app->project_info["socket_server"],
            ],

            "versions" => [
                "v1.0.0" => "zapwire-js/v1.0.0.js",
            ]
        ]
    ];

    $cdn_package = $app->values["1"];
    $cdn_package_version = $app->values["2"];

    //get match

    $cdn_package_match = $cdn_data[$cdn_package];
    $cdn_package_version_match = $cdn_package_match["versions"][$cdn_package_version];

    //get fallback
    $cdn_package_fallback = $cdn_package_match["fallback"];

    if(isset($cdn_package_version_match)){
        $cdn_package_version_match = $cdn_package_version_match;
    }else{
        $cdn_package_version_match = $cdn_package_fallback;
    }

    if($cdn_package_match["content-Type"]){
        header("Content-Type: ".$cdn_package_match["content-Type"]);
    } else {
        header("Content-Type: application/javascript");
    }

if(isset($cdn_package_version_match)) {
    echo "/**
* Zapwire
*
* A SAAS for simplifying the usage of websockets
*
*
* @package	$cdn_package
* @author	Ese Curtis .A.
* @copyright	Copyright (c) 2020 - 2022, Ese Curtis .A.
* @since	Version $cdn_package_version_match
*/\n\n

const CDN = JSON.parse(`".json_encode($cdn_package_match['cdn_data'])."`, true); \n\n";

}
    
    print get_vault_file('cdn/'.$cdn_package_version_match);
?>