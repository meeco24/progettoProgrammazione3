<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$giocatore->nickname = $data->nickname;
$giocatore->email = $data->email;
$giocatore->passwd = $data->passwd;
$giocatore->email_paypal = $data->email_paypal;

$id = $dataToken['id_giocatore'];


try {

    //input validation

    if(strlen($giocatore->nickname) != 0 && strlen($giocatore->nickname) < 5){
        echo json_encode(array("message" => "Inserire un nickname di almeno 5 caratteri."));
        http_response_code(400);
        die;
    }
    
    if($giocatore->nickExist($giocatore->nickname)){
        echo json_encode(array("message" => "Nickname già esistente."));
        http_response_code(400);
        die;
    }
    
    if((strlen($giocatore->passwd) != 0) && (strlen($giocatore->passwd) < 5)){
        echo json_encode(array("message" => "Inserire una password di almeno 5 caratteri."));
        http_response_code(400);
        die;
    }

    if($giocatore->emailExist($giocatore->email)){
        echo json_encode(array("message" => "Utente già registrato con questa email."));
        http_response_code(400);
        die;
    }
    
    if(!$giocatore->update($id)){
        echo json_encode(array("message" => "Il giocatore che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "giocatore aggiornato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al Server."));
    // echo json_encode(array("message" => $e->getMessage()));
    http_response_code(500);
    die;


}