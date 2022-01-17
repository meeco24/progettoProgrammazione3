<?php

$presidente = $dataToken['id_giocatore']??$_GET['id_giocatore']??"";

try {
    
    $squadre = Squadra::getSquadre($presidente, $competizione->conn);

    if(!$squadre){
        // echo json_encode(array("message" => "Il giocatore non ha ancora iscritto nessuna squadra ad una competizione"));
        http_response_code(404);
        die;
    }

    echo json_encode($squadre);
    http_response_code(200);
    die;

} catch (PDOException $e) {
    
    echo json_encode(array("message" => "Errore interno al Server."));
    http_response_code(500);
    die;

}