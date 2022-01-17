<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

try {

    $scheda_tecnica->create($data->calciatore);

    echo json_encode(array("message:" => "scheda tecnica creata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}