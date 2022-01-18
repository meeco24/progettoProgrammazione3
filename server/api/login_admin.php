<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../../documentRoot.php');
require_once $baseProjectURL.'server/config/core.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/BeforeValidException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/ExpiredException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/SignatureInvalidException.php';
require_once $baseProjectURL.'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Amministratore.php';

$amministratore = new Amministratore();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {    

    //dati ricevuti dal post
    $data = json_decode(file_get_contents("php://input"));

    if(empty($data)){
        http_response_code(400); 
        die;
    }

    //se l'admin non è registrato nel db o la password non è quella salvata nel db => il login fallisce
    if(!$amministratore->read($data->admin_name) || !password_verify($data->password, $amministratore->password))
    {
        echo json_encode(array("message" => "Login fallito!"));
        http_response_code(401);
        die;
    }

    //se il login va a buon fine, viene generato un token contenente i dati dell'admin loggato
    $token = array(
        "iat" => $issued_at,
        "exp" => $expiration_time,
        "iss" => $issuer,
        "data" => array(
            "id_admin" => $amministratore->id,
            "admin_name" => $amministratore->admin_name
        )
    );

    //generazione del jwt
    $jwt = JWT::encode($token, $key);

    //reposne code e messaggio di successo per l'utente
    http_response_code(200);
    echo json_encode(array("message" => "Login effettuato con succeso!", "jwt" => $jwt));

}
?>