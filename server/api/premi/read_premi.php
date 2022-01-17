<?php

try {
    
    if(!($responseData = $premio->readAll($_GET['id']??NULL,$_GET['pageSize'])))
    {
        http_response_code(404);
        die;
    }
    
    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    http_response_code(500);
    die;
}