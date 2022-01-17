<?php

try {

    if(!$squadra->delete($id)){
        echo json_encode(array("message" => "La squadra che si sta tentando di eliminare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "squadra eliminata"));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al server"));
    http_response_code(500);
    die;

}

