<?php

try {
    
    if(!($premio->read($id)))
    {
        http_response_code(404);
        die;
    }

    echo json_encode($premio);
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    http_response_code(500);
    die;

}