<?php

    $squadra = $_GET['squadra'];
    $giornata = $_GET['giornata'];

    try {

        $results = $formazione->read($squadra, $giornata);
        
        if(!($results))
        {
            echo json_encode(array("message" => "formazione non schierata", "schierata" => false));
            die;
        }

        echo json_encode($results);
        http_response_code(200);
        die;

    } catch (PDOException $e) {

        echo json_encode(array("message" => "Errore interno al Server."));
        http_response_code(500);
        die;

    }