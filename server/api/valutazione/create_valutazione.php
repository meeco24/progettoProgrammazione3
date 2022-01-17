<?php

//acquisizione dei dati presenti nel body della richiesta
$data = json_decode(file_get_contents("php://input"));

//inizializzazione dell'oggetto con i dati precedentemente acquisiti
$valutazione->calciatore = $data->calciatore;
$valutazione->giornata = $data->giornata;
$valutazione->voto = $data->voto;
$valutazione->fantavoto = $data->fantavoto;
$valutazione->goal = $data->goal;
$valutazione->assist = $data->assist;
$valutazione->clean_sheet = $data->clean_sheet;
$valutazione->goal_subiti = $data->goal_subiti;
$valutazione->ammonizioni = $data->ammonizioni;
$valutazione->espulsioni = $data->espulsioni;
$valutazione->autogoal = $data->autogoal;
$valutazione->rigore_sbagliato = $data->rigore_sbagliato;

//creazione della valutazione
try {

    if(!$valutazione->create())
    {
        echo json_encode(array("message" => "Valutazione già esistente!"));
        http_response_code(400);
        die;
    }

    echo json_encode(array("message" => "valutazione creata."));
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;
}