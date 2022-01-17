<?php

class Formazione extends DatabaseManager{

    //attributi
    public $squadra;
    public $calciatore;
    public $schierato;
    public $giornata;
    public $ora_inserimento;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione per verificare se la formazione è presente nel db
    public static function formazioneExist($squadra, $giornata, $connection)
    {

        $query = "SELECT * FROM formazione WHERE
                    squadra = :squadra AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(":squadra", $squadra);
        $stmt->bindParam(":giornata", $giornata);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

//funzione per recuperare l'ultima giornata
    public function getGiornata()
    {
        $connection = $this->conn;

        $query = "SELECT MAX(giornata) as giornata FROM formazione";

        $stmt = $connection->prepare($query);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['giornata'];

    }

//funzione per verificare che la squadra sia iscritta alla competizione
    public function squadraInComp($squadra)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM formazione WHERE squadra = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1,$squadra);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;
    }

//metodi CRUD

//CREATE
    public function create($squadra, $formazione, $giornata)
    {

        $connection = $this->conn;

        //insert query   
        $query = "INSERT INTO formazione SET 
                    squadra = :squadra,
                    calciatore = :calciatore,
                    schierato = :schierato,
                    giornata = :giornata";

        //prepare query
        $stmt = $connection->prepare($query);

        try {

            $connection->beginTransaction();

            //formazione[key = id_calciatore] => [value = schierato(1/0)]

            foreach ($formazione as $key => $value) {

                $this->squadra = htmlspecialchars(strip_tags($squadra));
                $this->calciatore = htmlspecialchars(strip_tags($key));
                $this->schierato = htmlspecialchars(strip_tags($value));
                $this->giornata = htmlspecialchars(strip_tags($giornata));

                $stmt->bindParam(":squadra", $squadra);
                $stmt->bindParam(":calciatore", $this->calciatore);
                $stmt->bindParam(":schierato", $this->schierato);
                $stmt->bindParam(":giornata", $giornata);

                $stmt->execute();

            }

            return $connection->commit();

        } catch(PDOException $e) {

            return $connection->rollback();

        }

    }

//READ-SINGLE
    public function read($squadra, $giornata)
    {

        $connection = $this->conn;

        if(!Formazione::formazioneExist($squadra, $giornata, $connection)) return false;

        $query = "SELECT f.*, c.nominativo, c.prezzo, c.ruolo, r.descrizione, c.club, c.id_calciatore, cl.nome, v.*
                    FROM formazione AS f
                    JOIN calciatore AS c ON f.calciatore = c.id_calciatore
                    JOIN club AS cl ON c.club = cl.id_club
                    JOIN ruolo AS r ON c.ruolo = r.id_ruolo
                    LEFT JOIN valutazione AS v ON f.calciatore = v.calciatore AND f.giornata = v.giornata
                    WHERE squadra = :squadra AND f.giornata = :giornata";

        $stmt = $connection->prepare($query);

        $squadra = htmlspecialchars(strip_tags($squadra));
        $giornata = htmlspecialchars(strip_tags($giornata));

        $stmt->bindParam(":squadra", $squadra);
        $stmt->bindParam(":giornata", $giornata);

        $stmt->execute();

        $formazione = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $formazione;

    }

//UPDATE
    public function update($squadra, $calciatore, $giornata)
    {
        $connection = $this->conn;

        if(!Formazione::formazioneExist($squadra, $calciatore, $giornata, $connection)) return false;

        //query
        $query = "UPDATE formazione SET
                schierato = :schierato
                WHERE squadra = :squadra AND calciatore = :calciatore AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        //sanitize input
        $this->schierato = htmlspecialchars(strip_tags($this->schierato));
        $calciatore = htmlspecialchars(strip_tags($calciatore));
        $squadra = htmlspecialchars(strip_tags($squadra));
        $giornata = htmlspecialchars(strip_tags($giornata));

        //binding parameters
        $stmt->bindParam(":schierato", $this->schierato);
        $stmt->bindParam(":calciatore", $calciatore);
        $stmt->bindParam(":squadra", $squadra);
        $stmt->bindParam(":giornata", $giornata);


        return $stmt->execute();

    }

//DELETE
    public function delete($squadra)
    {

        if(!$this->squadraInComp($squadra)) return false;

        $connection = $this->conn;
        $giornata = $this->getGiornata();

        //query
        $query = "DELETE FROM formazione 
                    WHERE squadra = :squadra AND giornata = :giornata";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(":squadra", $squadra);
        $stmt->bindParam(":giornata", $giornata);

        //execute query
        return $stmt->execute();

    }

}