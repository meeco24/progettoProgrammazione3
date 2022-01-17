<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$scheda_tecnica->goal = $data->goal;
$scheda_tecnica->assist = $data->assist;
$scheda_tecnica->clean_sheet = $data->clean_sheet;
$scheda_tecnica->goal_subiti = $data->goal_subiti;
$scheda_tecnica->ammonizioni = $data->ammonizioni;
$scheda_tecnica->espulsioni = $data->espulsioni;
$scheda_tecnica->autogoal = $data->autogoal;

try {
    
    if(!$scheda_tecnica->update($id))
    {
        echo json_encode(array("message" => "La scheda tecnica che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "scheda tecnica aggiornata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}