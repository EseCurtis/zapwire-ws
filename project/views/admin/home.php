<?php
    global $app;

    $year = strlen(req_var('y')) > 3 ? req_var('y') : date('Y');

    $render = new Render("admin", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    

    $widget->prop("auth");
    
    $render->prop("widgets/chart_data", [
        "current_year" => $year
    ]);

    $render->prop("header", [
        "title" => "Overview for the year: $year",
    ]);

    $render->prop("overview", [
        "current_year" => $year
    ]);

    $render->prop("footer", [
        "page_script" => "
            $(document).ready(function() {
                charts.init();
            });
        ",
    ]);
?>
