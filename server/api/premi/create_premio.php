<?php

$data = json_decode(file_get_contents("php://input"));

$premio->giocatore = $data->giocatore;
$premio->amministratore = $data->amministratore;
$premio->importo = $data->importo;

try {

    if(!($premio->create()))
    {
        http_response_code(400);
        die;
    }

    http_response_code(200);
    echo json_encode(array("message" => "premio creato."));
    die;
    
} catch (PDOException $e) {

    http_response_code(500);
    die;

}

?>