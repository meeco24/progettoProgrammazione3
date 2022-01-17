<?php

    $id_giornata = $_GET['id_giornata']??NULL;

    try {
        
        if(!$giornata->read($id_giornata))
        {
            echo json_encode(array("message" => "La giornata non esiste!"));
            http_response_code(404);
            die;
        }

        echo json_encode($giornata);
        http_response_code(200);
        die;

    } catch (PDOException $e) {

        echo json_encode(array("message" => "Errore interno al Server."));
        http_response_code(500);
        die;
    
    }