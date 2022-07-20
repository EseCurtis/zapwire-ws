<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    $channel = new Channel();

    $widget->prop("auth");

    $render->prop("header", [
        "title" => "Generate Wire Code",
        "current_page" => "gen_w_code",
    ]);

    $render->prop("channels/generate_wire_code", [
        "channel_data" =>  $channel->fetch_row(req_var('ch_id'), true) ?? false,
        "all_channels" =>  $channel->fetch_all_logged_in_user_channels()
    ]);
    
    $widget->prop("reload");
    $render->prop("footer");
?>
