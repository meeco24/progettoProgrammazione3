<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

$calciatore = $data->calciatore;
$giornata = $data->giornata;

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$valutazione->voto = empty($data->voto) ? NULL : $data->voto;
$valutazione->fantavoto = empty($data->fantavoto) ? NULL : $data->fantavoto;
$valutazione->goal = empty($data->goal) ? NULL : $data->goal;
$valutazione->assist = empty($data->assist) ? NULL : $data->assist;
$valutazione->clean_sheet = empty($data->clean_sheet) ? NULL : $data->clean_sheet;
$valutazione->goal_subiti = empty($data->goal_subiti) ? NULL : $data->goal_subiti;
$valutazione->ammonizioni = empty($data->ammonizioni) ? NULL : $data->ammonizioni;
$valutazione->espulsioni = empty($data->espulsioni) ? NULL : $data->espulsioni;
$valutazione->autogoal = empty($data->autogoal) ? NULL : $data->autogoal;
$valutazione->rigore_sbagliato = empty($data->rigore_sbagliato) ? NULL : $data->rigore_sbagliato;

//update della valutazione
try {
    
    if(!$valutazione->update($calciatore, $giornata))
    {
        echo json_encode(array("message" => "La valutazione che si sta tentando di aggiornare non esiste!"));
        http_response_code(404);
        die;
    }

    echo json_encode(array("message" => "valutazione aggiornata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al server"));
    http_response_code(500);
    die;

}