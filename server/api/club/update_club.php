<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$club->nome = $data->nome;

//update del club
try {
    
    if(!($club->update($id)))
    {
        echo json_encode(array("message" => "Il club xhe si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "club aggiornato!"));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}