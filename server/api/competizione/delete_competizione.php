<?php

try {

    if(!$competizione->delete($id)){
        echo json_encode(array("message" => "La competizione che si sta tentando di eliminare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "competizione eliminata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}