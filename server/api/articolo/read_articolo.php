<?php

try {
    
    if(!($articolo->read($id))){
        echo json_encode(array("message" => "L'articolo non eiste!"));
        http_response_code(404);
        die;
    }
    
    echo json_encode($articolo);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server"));
    http_response_code(500);
    die;
}



