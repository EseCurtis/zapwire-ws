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
 * @author Ese Curtis .A.
 * @copyright Copyright (c) 2020 - 2021, Ese Curtis .A.
 * @link	https://amvc-framework.netlify.com
 * @since	Version 1.2.0
 */
    global $config;

    if(@req_var("_amvc_live_request_")){
        $response = new Response("amvc/amvc.live");
        $amvc     = new AMVC($config);

        $live_request = json_decode(req_var("_amvc_live_request_"));
        $ch_id = $live_request->channel_id;
        $channel = $amvc->get_channel($ch_id);

        $channel_response = send_request($channel);

        if($channel){
            if(@$live_request->is_confidential){
                $response->set_message([
                    "channel_response"=>$channel_response,
                    "channel_id"=>$ch_id,
                ]);
            }else{
                $response->set_message([
                    "channel_response"=>$channel_response,
                    "channel_id"=>$ch_id,
                    "channel"=>$channel
                ]);
            }
        }else{
            if($live_request->is_confidential){
                $response->error([
                    "channel_response"=>"The channel requested do not exist!",
                    "channel_id"=>$ch_id,
                ]);
            }else{
                $response->error([
                    "channel_response"=>"The channel requested do not exist!",
                    "channel_id"=>$ch_id,
                    "channel"=>$channel
                ]);
            }
        }

        //$response->message({"lol"=>"hey"});
        $response->print("json");

        //echo $channel_response;
    }else{
        $amvc   = new AMVC($amvc_configuration);
        $amvc->insert_js();
        $render = new Render();
        $render->view("404.php");
    }
?>