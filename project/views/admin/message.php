<?php
    global $app;
    $render = new Render("admin", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $user_id = req_var("u_id");

    $widget->prop("auth");

    $render->prop("header", [
        "title" => "Message",
    ]);
    
    $render->prop("message", [
        "user_id" => $user_id,
    ]);

    $render->prop("footer", [
        "page_script" => "
            
        ",
    ]);
?>
