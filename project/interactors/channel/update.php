<?php
    
    $validation = ["ch_id", "path"];

    $response   = new Response("channel/update");
    $channel       = new Channel();

    if(multiple_isset($validation) && $channel->user_owns_channel($_SESSION["user_id"], req_var("ch_id"))){
        $id = req_var("ch_id");
        $path = req_var("path");
        $authorized_hostnames = req_var("authorized_hostnames");
        $headers = req_var("headers");
        
        $update = 0;

        $channel_row = $channel->fetch_row($id);

        if ($channel_row) {
            if($channel_row['path'] != $path){
                $update++;
                $path_update = $channel->update_single($id, "path", $path);
                $update = $path_update ? $update - 1 : $update;
            }
            if($channel_row['authorized_hostnames'] != $authorized_hostnames){
                $update++;
                $authorized_hostnames_update = $channel->update_single($id, "authorized_hostnames", $authorized_hostnames);
                $update = $authorized_hostnames_update ? $update - 1 : $update;
                
            }
            if($channel_row['headers'] != $headers){
                $update++;
                $headers_update = $channel->update_single($id, "headers", $headers);
                $update = $headers_update ? $update - 1 : $update;
            }
        } else {
            $response->message("0");
        }


        if($update == 0){
            $response->message("11");
        
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>