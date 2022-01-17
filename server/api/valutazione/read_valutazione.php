<?php

    $calciatore = $_GET['calciatore']??NULL;
    $giornata = $_GET['giornata']??NULL;

try {

    //se calciatore è null, vengono inviate al client tutte le valutazioni della giornata
    if(empty($calciatore))
    {
        echo json_encode($valutazione->readAll($giornata));
        http_response_code(200);
        die;
    }

    //se giornata è null, vengono inviate al client la medie del calciatore passato come parametro
    if(empty($giornata))
    {
        $mediaVoto = Valutazione::mediaVoto($calciatore, $valutazione->conn);
        $mediaFantavoto = Valutazione::mediaFantavoto($calciatore, $valutazione->conn);

        echo json_encode(array($mediaVoto, $mediaFantavoto));
        http_response_code(200);
        die;
    }

    //se non sono null ne calciatore, ne giornata, viene inviata al client la valutazione del calciatore nella giornata richiesta
    if(!$valutazione->read($calciatore, $giornata))
    {
        echo json_encode(array("message" => "La valutazione non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode($valutazione->read($calciatore, $giornata));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al server"));
    http_response_code(500);
    die;

}