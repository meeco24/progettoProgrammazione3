<?php

class Giornata extends DatabaseManager{


//attributi
    public $id_giornata;
    public $inizio_giornata;
    public $termine_giornata;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi CRUD

//READ-SINGLE
    public function read($id_giornata=NULL)
    {

        $connection = $this->conn;

        $condition = empty($id_giornata) ? "CURRENT_DATE BETWEEN inizio_giornata AND termine_giornata || CURRENT_DATE < inizio_giornata" : "id_giornata = ?";

        $query = "SELECT * FROM giornata WHERE {$condition}";

        $stmt = $connection->prepare($query);

        if(!empty($id_giornata)) $stmt->bindParam(1,$id_giornata);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        $this->id_giornata = $result["id_giornata"];
        $this->inizio_giornata = $result["inizio_giornata"];
        $this->termine_giornata = $result["termine_giornata"];

        return true;

    }

//UPDATE
    public function update($id_giornata)
    {

        $connection = $this->conn;

        $new_inizio = empty($this->inizio_giornata) ? "inizio_giornata" : ":inizio_giornata";
        $new_termine = empty($this->termine_giornata) ? "termine_giornata" : ":termine_giornata";

        $query = "UPDATE giornata SET
                    inizio_giornata = {$new_inizio}
                    termine_giornata = {$new_termine}
                    WHERE id_giornata = ?";

        $stmt = $connection->prepare($query);

        if(!empty($this->inizio_giornata)) $stmt->bindParam(":inizio_giornata", $this->inizio_giornata);
        if(!empty($this->termine_giornata)) $stmt->bindParam(":termine_giornata", $this->termine_giornata);

        return $stmt->execute();

    }

//DELETE
    public function delete($id_giornata)
    {
        $connection = $this->conn;

        $query = "DELETE FROM giornata WHERE id_giornata = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1,$id_giornata);

        $stmt->execute();
    }

}

?>