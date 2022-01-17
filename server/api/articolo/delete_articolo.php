<?php

try {
    
    if(!$articolo->delete($id)){
        echo json_encode(array("message" => "L'articolo che si sta tentando di eliminare non eiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "Articolo eliminato!"));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al Server"));
    http_response_code(500);
    die;

}