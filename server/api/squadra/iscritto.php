<?php

    $presidente = $dataToken['id_giocatore'];

try {

    $squadra = Squadra::checkIscrizione($presidente, $id, $competizione->conn);

    if(!$squadra){
        echo json_encode(array("message" => "La squadra non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("iscritto" => $squadra && count($squadra) == 5, "squadra" => $squadra));// 5 perché ci sono 5 campi 
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}