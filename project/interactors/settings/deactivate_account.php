<?php
    $response   = new Response("settings/deactivate_account");
    $settings   = new Settings();

    $validation = ["authorized"];

    if(multiple_isset($validation)){

        $deactivation = $settings->deactivate_account();

        if ($deactivation) {
            $response->message("11");
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>