<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../../../documentRoot.php');
require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Amministratore.php';

$parts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if(isset($parts[5])) $id = $parts[5];

$amministratore = new Amministratore();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        
        include_once "create_amministratore.php";
        break;
        
    case 'GET':
        http_response_code(400);
        break;

    case 'PUT':
        http_response_code(400);
        break;

    case 'DELETE':
        http_response_code(400);
        break;

    case 'OPTIONS':
http_response_code(200);        break;
        
    default:
        http_response_code(405);
        break;
}
