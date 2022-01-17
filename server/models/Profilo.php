<?php

require_once '/Users/Intel/Desktop/FantaRoyale/server/models/Squadra.php';

Class Profilo extends DatabaseManager {

    //attributi
    public $nickname;
    public $competizioni_attive;
    public $piazzamenti;

    //costruttore

    public function __construct()
    {
        parent::__construct();
    }

    //metodi
    public function getData($id)
    {

        $connection = $this->conn;

        $squadre = Squadra::getSquadre($id, $connection);

        return json_encode($squadre);
        
    }


}