<?php
    global $app;
    $render = new Render("admin", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    $report = new Report();

    $report_id = req_var("r_id");

    if($report_id) {
        $report->read($_data['r_id']);
    }

    $widget->prop("auth");

    $render->prop("header", [
        "title" => "Reports",
    ]);

    if($report_id == "") {
        $render->prop("reports");
    } else {
        $render->prop("report", [
            "report_id" => $report_id,
        ]);
    }

    $render->prop("footer", [
        "page_script" => "
            
        ",
    ]);
?>
