<?php
    
    $validation = ["user_id"];

    $response   = new Response("admin/user/permissions/delete");
    $user       = new User();

    $user_id = req_var("user_id");

    if(multiple_isset($validation)){

        if($user->delete($user_id)){
            $response->message("11");
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>