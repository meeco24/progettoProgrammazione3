<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$giocatore->nickname = $data->nickname;
$giocatore->email = $data->email;
$giocatore->passwd = $data->passwd;
$giocatore->email_paypal = $data->email_paypal;

//input validation

if(strlen($giocatore->nickname) < 5){
    // set response code
    http_response_code(400);
    // display message: unable to create giocatore
    echo json_encode(array("message" => "Inserire un nickname di almeno 5 caratteri."));
    die;
}

if($giocatore->nickExist($giocatore->nickname)){
    // set response code
    http_response_code(400);
    // display message: unable to create giocatore
    echo json_encode(array("message" => "Nickname già esistente."));
    die;
}

if(strlen($giocatore->passwd) < 5){
    // set response code
    http_response_code(400);
    // display message: unable to create giocatore
    echo json_encode(array("message" => "Inserire una password di almeno 5 caratteri."));
    die;
}

if(empty($giocatore->email)){
    // set response code
    http_response_code(400);
    // display message: unable to create giocatore
    echo json_encode(array("message" => "Inserire un'email valida."));
    die;
}

if($giocatore->emailExist($giocatore->email)){
    // set response code
    http_response_code(400);
    // display message: unable to create giocatore
    echo json_encode(array("message" => "Utente già registrato con questa email."));
    die;
}

try {
    
    $giocatore->create();

    echo json_encode(array("message" => "giocatore creato."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}

?>



