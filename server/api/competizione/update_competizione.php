<?php

//acquisizione dei dati presenti nel body della richiesta
    $data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
    $presidente = $data->presidente;
    $nome_squadra = $data->nome_squadra;
    $id_competizione = $data->id_competizione;

//update competizione
    try {

        if(!($competizione->iscrizione($presidente, $nome_squadra, $id_competizione)))
        {
            echo json_encode(array("message" => "La competizione non esiste!"));
            http_response_code(404);
            die;
        }

        http_response_code(200);
        echo json_encode(array("message" => "iscrizione effettuata con successo."));
        die;
        
    } catch (PDOException $e) {

        echo json_encode(array("message" => "Errore interno al Server."));
        http_response_code(500);
        die;

    }

?>