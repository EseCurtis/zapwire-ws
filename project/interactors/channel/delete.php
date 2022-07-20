<?php
    
    $validation = ["ch_id"];

    $response   = new Response("channel/delete");
    $channel    = new Channel();

    if(multiple_isset($validation)){

        $id = req_var("ch_id");
        $creation = 0;

        if ($channel->user_owns_channel($_SESSION["user_id"], $id)) {
            $creation = $channel->delete($id);
        }

        if($creation == 1){
            $response->message("11");
        
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>