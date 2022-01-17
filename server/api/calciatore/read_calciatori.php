<?php

try {
    
    $responseData = $calciatore->readAll(
        $_GET['id']??NULL,
        $_GET['pageSize'],
        $_GET['nominativo']??NULL,
        $_GET['filtro']??NULL,
        $_GET['ruolo']??NULL,
        $_GET['squadra']??NULL,
        $_GET['giornata']??NULL
    );

    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}