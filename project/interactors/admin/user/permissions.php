<?php
    
    $validation = ["user_id"];

    $response   = new Response("admin/user/permissions");
    $user       = new User();

    $current_user = $user->fetch_by_id(req_var("user_id"));
    $done = [];
    $failed = [];

    if(multiple_isset($validation) && $current_user){

        $deactivated = req_var("disabled");
        $is_activated = req_var("is_activated");
        $darkmode = req_var("darkmode");
        $have_logged_in = req_var("have_logged_in");
        $user_id = req_var("user_id");

        
        if($current_user['deactivated'] !== $deactivated){
            $message = ["value" => $deactivated, "message" => "disabled"];
            if($user->update($user_id, 'deactivated', $deactivated)){
                array_push($done, $message);
            } else {
                array_push($failed, $message);
            }
        }

        if($current_user['is_activated'] !== $is_activated){
            $message = ["value" => $is_activated, "message" => "is_activated"];
            if($user->update($user_id, 'is_activated', $is_activated)){
                array_push($done, $message);
            } else {
                array_push($failed, $message);
            }
        }

        if($current_user['darkmode'] !== $darkmode){
            $message = ["value" => $darkmode, "message" => "darkmode"];
            if($user->update($user_id, 'darkmode', $darkmode)){
                array_push($done, $message);
            } else {
                array_push($failed, $message);
            }
        }

        if($current_user['have_logged_in'] !== $have_logged_in){
            $message = ["value" => $have_logged_in, "message" => "have_logged_in"];
            if($user->update($user_id, 'have_logged_in', $have_logged_in)){
                array_push($done, $message);
            } else {
                array_push($failed, $message);
            }
        }

        if(count($done) > 0){
            $response->message("11");
        } else {
            if(count($failed) > 0) {
                $response->message("1");
            } else {
                $response->message("0");
            }
        }

        $response->message(["done" => $done, "failed" => $failed]);

    }else{
        $response->message("0");
    }

    $response->print("json");
?>