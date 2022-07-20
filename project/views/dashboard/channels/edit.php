<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $channel = new Channel();

    $channel_id = $app->values[3];

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Edit Channel",
        "current_page" => "channels",
    ]);
    if($channel->user_owns_channel($_SESSION['user_id'], $channel_id) && $channel->fetch_row($channel_id)){
        $render->prop("channels/edit", $channel->fetch_row($channel_id));
    } else {
        $widget->prop("content_unavailable");
    }
    $widget->prop("reload");
    $render->prop("footer");
?>
