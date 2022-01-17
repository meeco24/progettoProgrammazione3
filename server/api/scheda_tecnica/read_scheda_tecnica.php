<?php

try {
    
    if(!($scheda_tecnica->read($id)))
    {
        echo json_encode(array("message" => "La scheda tecnica non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode($scheda_tecnica);
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}