<?php

class Club extends DatabaseManager{


//attributi
    public $id;
    public $nome;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione per verificare se il club è presente del db
    public static function clubExist($id, $connection)
    {

        $query = "SELECT * FROM club WHERE id_club = ?";

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

        $query = "INSERT INTO club SET nome = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nome = htmlspecialchars(strip_tags($this->nome));

        //bind param
        $stmt->bindParam(1, $this->nome);

        //execute query
        return $stmt->execute();
    }

//READ-SINGLE
    public function read($id)
    {
        $connection = $this->conn;

        if(!Club::clubExist($id, $connection)) return false;

        $query = "SELECT * FROM club WHERE id_club = ?;";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch row
        $club = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$club) return false;

        $this->id = $club['id_club'];
        $this->nome = $club['nome'];

        return true;

    }

//READ-ALL
    public function readAll()
    {
        $connection = $this->conn;

        $query = "SELECT * FROM club";

        $stmt = $connection->prepare($query);

        $stmt->execute();

        $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $clubs;
    }

//UPDATE
    public function update($id)
    {
        $connection = $this->conn;

        if(!$this->clubExist($id, $connection)) return false;

        $query = "UPDATE club SET :nome WHERE id_club = :id";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nome = htmlspecialchars(strip_tags($this->nome));

        //bind param
        $stmt->bindParam(':nome',$this->nome);
        $stmt->bindParam(':id', $id);

        //execute query
        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {
        $connection = $this->conn;

        if(!$this->clubExist($id, $connection)) return false;

        $query = "DELETE FROM club WHERE id_club = ?";

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