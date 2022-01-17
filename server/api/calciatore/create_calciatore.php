<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$calciatore->nominativo = $data->nominativo;
$calciatore->prezzo = $data->prezzo;
$calciatore->ruolo = $data->ruolo;
$calciatore->club = $data->club;

//creazione giocatore
try {

    if(!$calciatore->create())
    {
        echo json_encode(array("message" => "Errore nella creazione del calciatore."));
        http_response_code(400);
        die;
    }
    
    http_response_code(200);
    echo json_encode(array("message" => "calciatore creato."));
    die;
    
} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}

?>