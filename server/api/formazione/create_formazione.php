<?php

$data = json_decode(file_get_contents("php://input"));

try {

    if(!$formazione->create($data->squadra, $data->formazione, $data->giornata)){
        echo json_encode(array("message:" => "impossibile schierare la formazione riprova più tardi"));
        http_response_code(400);
        die;    
    }

    echo json_encode(array("message:" => "formazione schierata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}