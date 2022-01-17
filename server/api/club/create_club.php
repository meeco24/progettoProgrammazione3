<?php
//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$club->nome = $data->nome;

//creazione del club
try {

    $club->create();

    echo json_encode(array("message" => "club creato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}