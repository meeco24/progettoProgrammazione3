<?php

$data = json_decode(file_get_contents("php://input"));

$formazione->squadra = $data->squadra;
$formazione->calciatore = $data->calciatore;
$formazione->schierato = $data->schierato;
$formazione->giornata = $data->giornata;
// $formazione->ora_inserimento = $data->ora_inserimento;

try {
    if(!$formazione->update($formazione->squadra, $formazione->calciatore, $formazione->giornata)){
        echo json_encode(array("message" => "La formazione che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message:" => "formazione aggiornata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}