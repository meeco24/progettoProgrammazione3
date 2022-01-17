<?php

$pageSize = $_GET['pageSize'];
$nickname = $_GET['nickname'];

try {

    if($nickname){ //se il nickname è presente tra i dati della richiesta, allora verrà recuperato il singolo utente corrispondente al quel nickname 

        if(!($giocatore->read(NULL, $_GET['nickname'])))
        {
            echo json_encode(array("message" => "Il giocatore non esiste!"));
            http_response_code(404);
            die;
        }
    
        echo json_encode(array($giocatore));
        http_response_code(200);
        die;

    }

    $responseData = $giocatore->readAll($lastID??NULL, $pageSize??10);

    if(!$responseData)
    {
        echo json_encode(array("message" => "Voce non presente nel database!"));
        http_response_code(404);
        die;
    }

    echo json_encode($responseData);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}