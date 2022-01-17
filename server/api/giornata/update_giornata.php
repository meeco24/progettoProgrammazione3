<?php

//acquisizione dei dati presenti nel body della richiesta
    $data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
    $giornata->inizio_giornata = $data->inizio_giornata;
    $giornata->termine_giornata = $data->termine_giornata;

//update giornata
    try {
        if(!$giornata->update($id))
        {
            echo json_encode(array("message" => "giornata inesistente"));
            http_response_code(404);
            die;
        }

        echo json_encode(array("message" => "giornata aggiornata"));
        http_response_code(200);
        die;

    } catch (PDOException $e) {
    
        echo json_encode(array("message" => "Errore interno al Server."));
        http_response_code(500);
        die;
    }