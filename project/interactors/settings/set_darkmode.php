<?php
    $response   = new Response("settings/darkmode");
    $settings   = new Settings();

    $validation = ["darkmode"];

    if(multiple_isset($validation)){

        $darkmode = str_replace('dm_', '', req_var("darkmode"));

        $set_darkmode = $settings->set_darkmode($darkmode);
        if ($set_darkmode) {
            $response->message("11");
        } else {
            $response->message("1");
        }
    }else{
        $response->message("0");
    }

    $response->print("json");
?>