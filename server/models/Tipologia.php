<?php

class Tipologia extends DatabaseManager{


    //attributi
    public $id;
    public $descrizione;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

    //metodi
//funzione che verifica se la tipologia è presente nel db
    public static function tipologiaExist($id, $connection)
    {

        $query = "SELECT * FROM tipologia WHERE id_tipologia = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);

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

        $query = "INSERT INTO tipologia SET descrizione = ?";

        $stmt = $connection->prepare($query);

        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));

        $stmt->bindParam(1, $this->descrizione);

        return $stmt->execute();

    }

//UPDATE
    public function update($id)
    {

        $connection = $this->conn;

        if(!$this->tipologiaExist($id, $connection)) return false;

        $query = "UPDATE tipologia SET :descrizione WHERE id_tipologia = :id";

        $stmt = $connection->prepare($query);

        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));

        $stmt->bindParam(':descrizione', $this->descrizione);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {
        $connection = $this->conn;

        if(!$this->tipologiaExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM tipologia WHERE id_tipologia = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $descrizione = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1, $id);

        //execute query
        return $stmt->execute();

    }
}