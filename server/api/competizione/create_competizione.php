<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$competizione->nome_competizione = $data->nome_competizione;
$competizione->prezzo_iscrizione = $data->prezzo_iscrizione;
$competizione->max_iscritti = $data->max_iscritti;
$competizione->budget = $data->budget;
$competizione->data_termine = $data->data_termine;
$competizione->creatore = $dataToken['id_admin'];

//creazione competizione
try {

    if(!$competizione->create()){
        echo json_encode(array("message" => "Errore nella creazione della competizione"));
        http_response_code(400);
        die;
    }

    echo json_encode(array("message" => "competizione creata."));
    http_response_code(200);
    die;
    
} catch (PDOException $e) {

    echo json_encode(array("message" => $e->getMessage()));
    // echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}

?>