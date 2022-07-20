<?php
    session_destroy();
    global $app;
    header('location: '.$app->url('sign-in'));
?>