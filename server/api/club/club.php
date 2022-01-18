<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once ('../../../documentRoot.php');

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Club.php';

$parts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if(isset($parts[5])) $id = $parts[5];

$club = new Club();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

        include_once "create_club.php";
        break;
        
    case 'GET':

        if(isset($id)) include_once "read_club.php";
        include_once "read_clubs.php";

        http_response_code(400);
        break;

    case 'PUT':

        if(isset($id)) include_once "update_club.php";

        http_response_code(400);
        break;

    case 'DELETE':

        if(isset($id)) include_once "delete_club.php";
        
        http_response_code(400);
        break;

    case 'OPTIONS':
        http_response_code(200);
        break;
        
    default:

        http_response_code(405);
        break;

}