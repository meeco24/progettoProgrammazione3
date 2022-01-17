<?php

try {
    
    if(!$scheda_tecnica->delete($id)){
        echo json_encode(array("message" => "La scheda tecnica che si sta tentando di eliminare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "scheda tecnica cancellata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}