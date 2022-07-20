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


    //root path 
    $path                   = explode('\\', __DIR__);
    $path[count($path)-1]   = "";
    $path                   = implode('/', $path);


    //define constants
    define('_PATH_', "$path/..");
    define('_HOSTNAME_', $_SERVER['HTTP_HOST']);

    //setting the reserved paths.
    $reserved = [
        "amvc.api"=>[
            "source"=>"amvc.api.php"
        ],
        "amvc.live"=>[
            "source"=>"amvc.live.php"
        ],
        "amvc.js"=>[
            "source"=>"amvc.js.php"
        ],
        "amvc.css"=>[
            "source"=>"amvc.css.php"
        ],
        "amvc.onloaded"=>[
            "source"=>"amvc.onloaded.php"
        ],
    ];

    //setting the dom globals.
    $dom_globals = [
       "tab" => "   ",
       "newline"=> "\n",
    ];
?>