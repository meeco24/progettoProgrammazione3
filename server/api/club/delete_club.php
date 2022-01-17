<?php

try {

    if(!($club->delete($id)))
    {
        echo json_encode(array("message" => "Il club che si sta tentando di eliminare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "club eliminato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}