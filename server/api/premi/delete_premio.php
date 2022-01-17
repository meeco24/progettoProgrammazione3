<?php

try {
    
    if(!$premio->delete($id)){
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "premio cancellato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    http_response_code(500);
    die;

}