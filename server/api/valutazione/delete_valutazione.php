<?php

//acquisizione dei dati presenti nel body della richiesta
    $data = json_decode(file_get_contents("php://input"));

    $calciatore = $data->calciatore;
    $giornata = $data->giornata;

    try {
        
        if(!$valutazione->delete($calciatore, $giornata)){
            echo json_encode(array("message" => "La valutazione che si sta tentando di eliminare non esiste!"));
            http_response_code(404);
            die;
        }

        echo json_encode(array("message" => "valutazione cancellata"));
        http_response_code(200);
        die;

    } catch (PDOException $e) {

        echo json_encode(array("message" => "Errore interno al server"));
        http_response_code(500);
        die;

    }