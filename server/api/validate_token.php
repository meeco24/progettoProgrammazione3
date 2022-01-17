<?php

    $baseProjectURL = '/Users/Intel/Desktop/FantaRoyale/';

    require_once $baseProjectURL.'server/config/core.php';
    require_once $baseProjectURL.'libs/php-jwt-master/src/BeforeValidException.php';
    require_once $baseProjectURL.'libs/php-jwt-master/src/ExpiredException.php';
    require_once $baseProjectURL.'libs/php-jwt-master/src/SignatureInvalidException.php';
    require_once $baseProjectURL.'libs/php-jwt-master/src/JWT.php';
    use \Firebase\JWT\JWT;

    if($_SERVER['REQUEST_METHOD'] != 'OPTIONS'){ // le CORS-Policy richiedono che le chiamate OPTIONS non necessitino dell'Authorization header 

    $headers = getallheaders(); //array associativo con tutti gli header

    // recuperare jwt
    $jwt = isset($headers["Authorization"]) ? $headers["Authorization"] : "";

    // se jwt non è vuoto
    if($jwt){

        // si usa JWT::decode() per recuperare i dati dell'utente dal token
        try {
            // decode jwt
            $decoded = JWT::decode($jwt, $key, array('HS256'));
            $dataToken = (array)($decoded->data);
        }

            // se JWT::decode non va a buon fine, significa che il token non è valido 
        catch (Exception $e){
        
            // comunicare all'utente che la navigazione non è autorizzata
            http_response_code(401); //Unauthorized
            echo json_encode(array("message" => "Accesso non autorizzato!")); //messaggio d'errore
            die;
        }

    }

    // se jwt è vuoto comunicare all'utente che la sua navigazione non è autorizzata
    else{
        http_response_code(401);
        echo json_encode(array("message" => "Accesso non autorizzato!"));
        die;
    }
}
?>