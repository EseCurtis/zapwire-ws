<?php
    global $app;

    $request_headers = getallheaders();
    $api_authKey = $app->project_info['api-authKey'];

    if(!isset($request_headers['authKey']) || $request_headers['authKey'] !== $api_authKey) {
        die('{"invd" : "'.$request_headers['authKey'].'"}');
    }

?>