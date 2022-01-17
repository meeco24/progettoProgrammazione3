<?php

try {

    $responseData = $articolo->readAll($_GET['id']??NULL, $_GET['pageSize']??5, $_GET['tipologia']??NULL);

    if(!($responseData)){
        echo json_encode(array("message" => "Errore nel recupero degli articoli!"));
        http_response_code(404);
        die;
    }

    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server"));
    http_response_code(500);
    die;
}



