<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$squadra->nome = $data->nome;
$squadra->presidente = $dataToken['id_giocatore'];
$squadra->competizione = $data->competizione;

//creazione squadra
try {

    if(Squadra::checkIscrizione($squadra->presidente, $squadra->competizione, $squadra->conn))
    {
        echo json_encode(array("message" => "squadra gia iscritta alla competizione"));
        http_response_code(400);
        die;
    }

    $squadra->create();

    echo json_encode(array("message" => "squadra creata"));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}
