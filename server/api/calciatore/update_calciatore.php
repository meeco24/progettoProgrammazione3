<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$calciatore->nominativo = !empty($data->nominativo) ? $data->nominativo : NULL;
$calciatore->prezzo = !empty($data->prezzo) ? $data->prezzo : NULL;
$calciatore->ruolo = !empty($data->ruolo) ? $data->ruolo : NULL;
$calciatore->club = !empty($data->club) ? $data->club : NULL;

//update calciatore
try {

    if(!($calciatore->update($id)))
    {
        echo json_encode(array("message" => "Il calciatore che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    http_response_code(200);
    echo json_encode(array("message" => "calciatore aggiornato."));
    die;
    
} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}

?>