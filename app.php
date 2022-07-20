<?php
//execute all neccessary functions
include 'bin/php/amvc.main.php';
include 'project/__autoload.classes.php';
include 'bin/vendor/autoload.php';

@session_start();

$config = (array) include_json("project.json");
$app    = new AMVC($config);

global $app;

$app->connect_database();
$app->run();

$service = new Service();
$service->start();