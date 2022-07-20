<?php
/**
 * AMVC
 *
 * A lightweight framework for working with multiple Inter APIs
 *
 *
 * Copyright (c) 2020 - 2021, Esecodes Tech
 *
 * Any owner of this copy of the AMVC package is licenced to make 
 * changes to code and to give feed back about any errors on the
 * package
 *
 *
 * @package	AMVC
 * @author	Ese Curtis .A.
 * @copyright	Copyright (c) 2020 - 2021, Ese Curtis .A.
 * @link	https://amvc-framework.netlify.com
 * @since	Version 1.2.0
 */

    //define header for javascript files
    header("Content-Type: application/javascript");

    //define relative path
    $r_path = (__DIR__)."/../..";

    $config = (array) include_json("$r_path/project.json");

    //initialise amvc class
    $amvc   = new AMVC($config);

    //define the scripts an their paths
    $amvc_scripts = [
        "amvc.onloaded.js"  => [
            "title" => "AMVC Script to handle page on loaded [amvc.onloaded.js]",
            "code"  => file_get_contents("$r_path/bin/js/amvc.onloaded.js")
        ]
    ];

    //printing out the defined scripts
    foreach ($amvc_scripts as $script) {

        if(@!$script['private']){
            if($script["title"]){
                json_format($script["code"]);
            }
            print "//";
            print $script["title"];
            print "\n";
            print $script["code"];
            print "\n";
            print "\n";
        }
    }

?>