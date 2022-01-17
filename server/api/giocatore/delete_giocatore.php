<?php

try {
    
    if(!$giocatore->delete($id)){
        echo json_encode(array("message" => "Il giocatore che si sta tentando di eliminare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "giocatore cancellato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    // echo json_encode(array("message" => "Errore interno al Server."));
    echo json_encode(array("message" => $e->getMessage()));
    http_response_code(500);
    die;


}