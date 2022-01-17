<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$baseProjectURL = '/Users/Intel/Desktop/FantaRoyale/';

require_once $baseProjectURL.'server/config/core.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/BeforeValidException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/ExpiredException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/SignatureInvalidException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Giocatore.php';

$giocatore = new Giocatore();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    

    //dati ricevuti dal post
    $data = json_decode(file_get_contents("php://input"));

    //controllo se i dati sono stati ricevuti correttamente
    if(empty($data)){
        http_response_code(400);
        die;
    }

    if(!$giocatore->emailExist($data->email) || !password_verify($data->passwd, $giocatore->passwd))
    {
        http_response_code(401);
        echo json_encode(array("message" => "Login fallito! Ricontrollare email e password inseriti"));
        die;
    }

    $token = array(
        "iat" => $issued_at,
        "exp" => $expiration_time,
        "iss" => $issuer,
        "data" => array(
            "id_giocatore" => $giocatore->id,
            "nickname" => $giocatore->nickname,
            "email" => $giocatore->email,
            "email_paypal" => $giocatore->email_paypal
        )
    );

    // generate jwt
    $jwt = JWT::encode($token, $key);

    http_response_code(200);
    echo json_encode(array("message" => "Login effettuato con successo!", "jwt" => $jwt));
    die;

}
?>