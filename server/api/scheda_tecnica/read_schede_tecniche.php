<?php

// echo json_encode(array("nominativo" => $_GET['nominativo'], 
//                 "ruolo" => $_GET['ruolo'],
//                 "club" => $_GET['club'],
//                 "filtro" => $_GET['filtro']));
// http_response_code(200);
// die;

try {
    
    $responseData = $scheda_tecnica->readAll(
            $_GET['id']??NULL,
            $_GET['pageSize']??6,
            $_GET['nominativo']??NULL,
            $_GET['ruolo']??NULL,
            $_GET['club']??NULL,
            $_GET['filtro']??NULL
    );
    
    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    // echo json_encode(array("message" => "Errore interno al Server."));
    echo json_encode(array("message" => $e->getMessage()));
    http_response_code(500);
    die;
}