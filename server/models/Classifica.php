<?php

class Classifica extends DatabaseManager{

    //attributi
    public $competizione;
    public $squadra;
    public $punteggio_parziale;
    public $giornata;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi CRUD

//CREATE
    public function create()
    {

        $connection = $this->conn;

        $query = "INSERT INTO classifica SET
                    competizione = :competizione,
                    squadra = :squadra,
                    punteggio_parziale = :punteggio_parziale,
                    giornata = :giornata";

        $stmt = $connection->prepare($query);

        $this->competizione = htmlspecialchars(strip_tags($this->competizione));
        $this->squadra = htmlspecialchars(strip_tags($this->squadra));
        $this->punteggio_parziale = htmlspecialchars(strip_tags($this->punteggio_parziale));
        $this->giornata = htmlspecialchars(strip_tags($this->giornata));

        $stmt->bindParam(":competizione", $this->competizione);
        $stmt->bindParam(":squadra", $this->squadra);
        $stmt->bindParam(":punteggio_parziale", $this->punteggio_parziale);
        $stmt->bindParam(":giornata", $this->giornata);

        return $stmt->execute();

    }

//READ CLASSIFICA GIORNALIERA
    public function readGiornata($competizione, $squadra, $giornata)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM classifica 
                    WHERE competizione = :competizione AND squadra = :squadra AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        $this->competizione = htmlspecialchars(strip_tags($this->competizione));
        $this->squadra = htmlspecialchars(strip_tags($this->squadra));
        $this->giornata = htmlspecialchars(strip_tags($this->giornata));

        $stmt->bindParam(":competizione", $this->competizione);
        $stmt->bindParam(":squadra", $this->squadra);
        $stmt->bindParam(":giornata", $this->giornata);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        $this->competizione = $result['competizione'];
        $this->squadra = $result['squadra'];
        $this->punteggio_parziale = $result['punteggio_parziale'];
        $this->giornata = $result['giornata'];

        return true;

    }

//READ CLASSIFICA GENERALE
    public function readGenerale($competizione)
    {
        $connection = $this->conn;

        $query = "SELECT competizione, squadra, SUM(punteggio_parziale) as tot FROM classifica 
                    WHERE competizione = :competizione
                    ORDER BY tot";

        $stmt = $connection->prepare($query);

        $this->competizione = htmlspecialchars(strip_tags($this->competizione));
        $this->squadra = htmlspecialchars(strip_tags($this->squadra));

        $stmt->bindParam(":competizione", $this->competizione);
        $stmt->bindParam(":squadra", $this->squadra);
        $stmt->bindParam(":giornata", $this->giornata);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }


}