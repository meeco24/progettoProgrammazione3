<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$baseProjectURL = '/Users/Intel/Desktop/FantaRoyale/';

require_once $baseProjectURL.'server/config/DatabaseManager.php';
require_once $baseProjectURL.'server/models/Squadra.php';

$squadra = new Squadra();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET':

        $competizione = $_GET['competizione'];
        $giornata = !isset($_GET['giornata']) ? NULL : $_GET['giornata'];

        try {
            
            if(empty($giornata))
            {
                $classificaGenerale = $squadra->classifica($competizione);
    
                echo json_encode($classificaGenerale);
                http_response_code(200);
                die;
            }
    
            $classificaGiornata = $squadra->classifica($competizione, $giornata);
    
            echo json_encode($classificaGiornata);
            http_response_code(200);
            die;
    
        } catch (PDOException $e) {
            
            echo json_encode(array("message" => "Errore interno al Server."));
            http_response_code(500);
            die;
        
        }

        http_response_code(400);
        break;

    case 'OPTIONS':
        http_response_code(200);
        break;

    default:
        http_response_code(405);
        break;
}
