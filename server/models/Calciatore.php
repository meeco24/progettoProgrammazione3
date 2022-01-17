<?php

require_once '/Users/Intel/Desktop/FantaRoyale/server/models/SchedaTecnica.php';
require_once '/Users/Intel/Desktop/FantaRoyale/server/models/Ruolo.php';
require_once '/Users/Intel/Desktop/FantaRoyale/server/models/Club.php';

class Calciatore extends DatabaseManager{

//attributi
    public $id;
    public $nominativo;
    public $prezzo;
    public $ruolo;
    public $club;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione che verifica se l'articolo è presente nel db
    public static function calciatoreExist($id, $connection)
    {
        $query = "SELECT * FROM calciatore WHERE id_calciatore = ?";

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

        $scheda_tecnica = new SchedaTecnica(); //quando un calciatore viene aggiunto al database, viene creata la sua scheda tecnica associata

        $connection = $this->conn;

        if(!Ruolo::ruoloExist($this->ruolo, $connection)) return false;
        if(!Club::clubExist($this->club, $connection)) return false;

        //insert query
        $query = "INSERT INTO calciatore
        SET
        nominativo = :nominativo,
        prezzo = :prezzo,
        ruolo = :ruolo,
        club = :club";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nominativo=htmlspecialchars(strip_tags($this->nominativo));
        $this->prezzo=htmlspecialchars(strip_tags($this->prezzo));
        $this->ruolo=htmlspecialchars(strip_tags($this->ruolo));
        $this->club=htmlspecialchars(strip_tags($this->club));

        //bind params
        $stmt->bindParam(':nominativo', $this->nominativo);
        $stmt->bindParam(':prezzo', $this->prezzo, PDO::PARAM_INT);
        $stmt->bindParam(':ruolo', $this->ruolo, PDO::PARAM_INT);
        $stmt->bindParam(':club', $this->club, PDO::PARAM_INT);

        //execute query

        try {
            $connection->beginTransaction();

            $stmt->execute();
            
            $id_calciatore = $connection->lastInsertId();
            $scheda_tecnica->create($id_calciatore, $connection);

            return $connection->commit();

        } catch(PDOException $e) {

            return $connection->rollback();
        }

    }

//READ-SINGLE
    public function read($id)
    {
        $connection = $this->conn;

        if(!Calciatore::calciatoreExist($id, $connection)) return false;

        $query = "SELECT * FROM calciatore WHERE id_calciatore = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $calciatore = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$calciatore) return false;

        $this->id = $calciatore['id_calciatore'];
        $this->nominativo = $calciatore['nominativo'];
        $this->prezzo = $calciatore['prezzo'];
        $this->ruolo = $calciatore['ruolo'];
        $this->club = $calciatore['club'];

        return true;

    }

//READ-ALL + PAGINAZIONE + FILTRI
    public function readAll($lastID, $pageSize, $nominativo, $filter, $ruolo, $squadra, $giornata)
    {

        $filtri = ["prezzo","ruolo", "club"];
        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(id_calciatore) from calciatore)" : ":spiazzamento";
        $nome = empty($nominativo) ? "" : "AND (nominativo LIKE :nominativo)";
        $nominativo = empty($nominativo) ? $nominativo : "%$nominativo%";
        $filtro = empty($filter) || !in_array($filter, $filtri) ? "" : "{$filter} DESC,";

        $notIn = "SELECT c.id_calciatore
        FROM formazione 
        JOIN calciatore AS c ON calciatore = c.id_calciatore 
        WHERE squadra = :squadra AND giornata = :giornata";

        $condizione = (empty($squadra) || empty($giornata)) ? "" : "AND id_calciatore NOT IN ({$notIn})";

        $connection = $this->conn;

        //query
        $query = "SELECT calciatore.*, cl.nome
                    FROM calciatore
                    JOIN club as cl ON calciatore.club = cl.id_club
                    WHERE id_calciatore <= {$offset}
                    {$nome} AND ruolo = :ruolo
                    {$condizione}
                    ORDER BY {$filtro} prezzo DESC LIMIT :pageSize";
        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        if(!empty($lastID)) $stmt->bindParam(":spiazzamento", $lastID);
        if(!empty($nominativo)) $stmt->bindParam(":nominativo", $nominativo); 
        if(!empty($ruolo)) $stmt->bindParam(":ruolo", $ruolo, PDO::PARAM_INT);
        if(!empty($pageSize)) $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        if(!empty($squadra))$stmt->bindParam(":squadra", $squadra, PDO::PARAM_INT);
        if(!empty($giornata))$stmt->bindParam(":giornata", $giornata, PDO::PARAM_INT);

        //execute query
        $stmt->execute();

        //fetch records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;


    }

//UPDATE
    public function update($id)
    {

        $connection = $this->conn;

        if(!Calciatore::calciatoreExist($id, $connection)) return false;

        $new_nominativo = !empty($this->nominativo) ? ":nominativo" : "nominativo";
        $new_prezzo = !empty($this->prezzo) ? ":prezzo" : "prezzo";
        $new_ruolo = !empty($this->ruolo) ? ":ruolo" : "ruolo";
        $new_club = !empty($this->club) ? ":club" : "club";

        //query
        $query = "UPDATE calciatore SET
                nominativo = {$new_nominativo},
                prezzo = {$new_prezzo},
                ruolo = {$new_ruolo},
                club = {$new_club}
                WHERE id_calciatore = :id";

        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nominativo=htmlspecialchars(strip_tags($this->nominativo));
        $this->prezzo=htmlspecialchars(strip_tags($this->prezzo));
        $this->ruolo=htmlspecialchars(strip_tags($this->ruolo));
        $this->club=htmlspecialchars(strip_tags($this->club));
        $id = htmlspecialchars(strip_tags($id));

        //binding parameters
        if(!empty($this->nominativo))$stmt->bindParam(':nominativo', $this->nominativo);
        if(!empty($this->prezzo))$stmt->bindParam(':prezzo', $this->prezzo);
        if(!empty($this->ruolo)) $stmt->bindParam(':ruolo', $this->ruolo);
        if(!empty($this->club)) $stmt->bindParam(':club', $this->club);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {

        $connection = $this->conn;

        if(!Calciatore::calciatoreExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM calciatore WHERE id_calciatore = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();

    }

    }