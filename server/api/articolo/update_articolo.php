<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$articolo->titolo = $data->titolo;
$articolo->contenuto = $data->contenuto;
$articolo->tipologia = $data->tipologia;

//update dell'articolo
try {

    if(!$articolo->update($id)){
        echo json_encode(array("message" => "L'articolo che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "articolo aggiornato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => $e->getMessage()));
    http_response_code(500);
    die;

}