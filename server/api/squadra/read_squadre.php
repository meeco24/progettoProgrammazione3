<?php

$presidente = $_GET['id_giocatore'];
$connection = $squadra->conn;

try {

    $squadre = $squadra->getSquadre($presidente, $connection);

    echo json_encode($squadre);
    http_response_code(200);
    die;

} catch (PDOException $e) {

    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}