<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$articolo->titolo = $data->titolo;
$articolo->contenuto = $data->contenuto;
$articolo->tipologia = $data->tipologia;
$articolo->autore = $dataToken['id_admin'];

//inserimento dei dati nel database
try {

    if(!$articolo->create()){
        echo json_encode(array("message" => "errore nella creazione dell'articolo!"));
        http_response_code(400);
        die;
    }

    echo json_encode(array("message" => "articolo creato."));
    http_response_code(200);
    die;
    
} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}