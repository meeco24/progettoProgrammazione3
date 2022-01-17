<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$baseProjectURL = '/Users/Intel/Desktop/FantaRoyale/';

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Valutazione.php';
require_once $baseProjectURL.'server/api/validate_token.php';
$valutazione = new Valutazione();

switch ($_SERVER['REQUEST_METHOD']) {   
    
    case 'POST':

        include_once "create_valutazione.php";
        
        http_response_code(400);
        break;

    case 'GET':
        
        include_once "read_valutazione.php";
        
        http_response_code(400);
        break;

    case 'PUT':
        
        include_once "update_valutazione.php";

        http_response_code(400);
        break;

    case 'DELETE':

        include_once "delete_valutazione.php";

        http_response_code(400);
        break;

    case 'OPTIONS':
        http_response_code(200);
        break;

    default:

        http_response_code(405);
        break;

}