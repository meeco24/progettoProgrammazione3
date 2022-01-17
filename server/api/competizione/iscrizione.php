<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$baseProjectURL = '/Users/Intel/Desktop/FantaRoyale/';

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Competizione.php';
require_once $baseProjectURL.'server/models/Squadra.php';
require_once $baseProjectURL.'server/api/validate_token.php';

$parts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if(isset($parts[5])) $id = $parts[5];

$competizione = new Competizione();
$squadra = new Squadra();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

        include_once $baseProjectURL."server/api/squadra/create_squadra.php";

        break;
        
    case 'GET':

        if(isset($id)) include_once $baseProjectURL."server/api/squadra/iscritto.php";
        include_once $baseProjectURL."server/api/squadra/get_squadre_presidente.php";

        http_response_code(400);
        break;

    case 'OPTIONS':
        http_response_code(200);
        break;
        
    default:

        http_response_code(405);
        break;

}