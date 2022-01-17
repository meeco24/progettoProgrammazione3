<?php

class Ruolo extends DatabaseManager{


//attributi
    public $id;
    public $descrizione;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione che verifica se il ruolo è presente nel db 
    public static function ruoloExist($id, $connection)
    {

        $query = "SELECT * FROM ruolo WHERE id_ruolo = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

//metodi CRUD

//CREATE
    public function create()
    {

        $connection = $this->conn;

        $query = "INSERT INTO ruolo SET descrizione = ?";

        $stmt = $connection->prepare($query);

        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));

        $stmt->bindParam(1,$this->descrizione);

        return $stmt->execute();

    }

//READ-SINGLE
    public function read($id)
    {
        $connection = $this->conn;

        if(!Ruolo::ruoloExist($id, $connection)) return false;

        $query = "SELECT * FROM ruolo WHERE id_ruolo = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch row
        $ruolo = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$ruolo) return false;

        $this->id = $ruolo['id_ruolo'];
        $this->descrizione = $ruolo['descrizione'];

        return true;

    }

//UPDATE
    public function update($id)
    {

        $connection = $this->conn;

        if(!Ruolo::ruoloExist($id, $connection)) return false;

        $query = "UPDATE ruolo SET :descrizione WHERE id_ruolo = :id";

        $stmt = $connection->prepare($query);

        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));
        $id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(':descrizione',$this->descrizione);
        $stmt->bindParam(':id',$id);

        return $stmt->execute();
    }

//DELETE
    public function delete($id)
    {

        $connection = $this->conn;

        if(!Ruolo::ruoloExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM ruolo WHERE id_ruolo = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1, $id);

        //execute query
        return $stmt->execute();

    }

}