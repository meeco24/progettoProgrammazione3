<?php

try {

    $responseData = $club->readAll();

    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}