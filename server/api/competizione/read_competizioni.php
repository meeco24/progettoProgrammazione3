<?php

try {
    
    $responseData = $competizione->readAll(
            $_GET['id']??NULL,
            $_GET['pageSize']??3,
            $_GET['nome_competizione']??NULL,
            $_GET['filtro']??NULL
    );
    
    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}