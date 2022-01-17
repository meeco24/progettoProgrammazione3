<?php

class SchedaTecnica extends DatabaseManager{

//attributi
    public $calciatore;
    public $goal;
    public $assist;
    public $clean_sheet;
    public $goal_subiti;
    public $ammonizioni;
    public $espulsioni;
    public $autogoal;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione che verifica se la scheda tecnica è presente nel db
    public function schedaTecnicaExist($id)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM scheda_tecnica WHERE calciatore = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

//metodi CRUD

//CREATE
    public function create($id_calciatore, $connection)
    {

        //insert query
        $query = "INSERT INTO scheda_tecnica SET calciatore = ?;";

        //prepare query
        $stmt = $connection->prepare($query);

        $stmt->bindParam(1,$id_calciatore);

        return $stmt->execute();

    }

//READ-SINGLE
    public function read($id)
    {
        $connection = $this->conn;

        $query = "SELECT st.*, c.nominativo
                FROM scheda_tecnica as st 
                JOIN calciatore as c ON c.id_calciatore = st.calciatore 
                WHERE calciatore = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $scheda_tecnica = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$scheda_tecnica) return false;

        $this->calciatore = $scheda_tecnica['calciatore'];
        $this->goal = $scheda_tecnica['goal'];
        $this->assist = $scheda_tecnica['assist'];
        $this->clean_sheet = $scheda_tecnica['clean_sheet'];
        $this->goal_subiti = $scheda_tecnica['goal_subiti'];
        $this->ammonizioni = $scheda_tecnica['ammonizioni'];
        $this->espulsioni = $scheda_tecnica['espulsioni'];
        $this->autogoal = $scheda_tecnica['autogoal'];

        return true;
    }

//READ-ALL + PAGINAZIONE + FILTRI
    public function readAll($lastID, $pageSize, $nominativo, $ruolo, $club, $filter)
    {

        $filtri = ["goal", "assist", "clean_sheet", "goal_subiti", "ammonizioni", "espulsioni", "autogoal"];

        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(calciatore) from scheda_tecnica)" : ":spiazzamento";
        $nome = empty($nominativo) ? "" : "AND (c.nominativo LIKE :nominativo)";
        $strRuolo = empty($ruolo) ? "" : "AND (r.descrizione = :ruolo)";
        $strClub = empty($club) ? "" : "AND (cl.nome = :club)";
        $filtro = !empty($filter) && in_array($filter, $filtri) ? "{$filter} DESC," : "";

        $connection = $this->conn;

        //query
        $query = "SELECT st.*, c.nominativo, r.descrizione as ruolo , cl.nome as club 
                    FROM scheda_tecnica as st 
                    JOIN calciatore as c ON c.id_calciatore = st.calciatore
                    JOIN ruolo as r ON r.id_ruolo = c.ruolo
                    JOIN club as cl ON cl.id_club = c.club 
                    WHERE calciatore <= {$offset}
                    {$nome}
                    {$strRuolo}
                    {$strClub}
                    ORDER BY {$filtro} calciatore DESC LIMIT :pageSize";
        
        //prepare query
        $stmt = $connection->prepare($query);



        //bind param
        $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        if(!empty($lastID)) $stmt->bindParam(":spiazzamento", $lastID); 
        if(!empty($nominativo)) $stmt->bindParam(":nominativo", $nominativo); 
        if(!empty($ruolo)) $stmt->bindParam(":ruolo", $ruolo); 
        if(!empty($club)) $stmt->bindParam(":club", $club);
        // if(!empty($filter)) $stmt->bindParam(":filtro", $filter);

        //execute query
        $stmt->execute();

        //fetch records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

//UPDATE
    public function update($id)
    {

        if(!$this->schedaTecnicaExist($id)) return false;

        $new_goal = !empty($this->goal) ? "goal + :goal" : "goal";
        $new_assist = !empty($this->assist) ? "assist + :assist" : "assist";
        $new_clean_sheet = !empty($this->clean_sheet) ? "clean_sheet + :clean_sheet" : "clean_sheet";
        $new_goal_subiti = !empty($this->goal_subiti) ? "goal_subiti + :goal_subiti" : "goal_subiti";
        $new_ammonizioni = !empty($this->ammonizioni) ? "ammonizioni + :ammonizioni" : "ammonizioni";
        $new_espulsioni = !empty($this->espulsioni) ? "espulsioni + :espulsioni" : "espulsioni";
        $new_autogoal = !empty($this->autogoal) ? "autogoal + :autogoal" : "autogoal";       

        $connection = $this->conn;

        //query
        $query = "UPDATE scheda_tecnica SET
                goal = {$new_goal},
                assist = {$new_assist},
                clean_sheet = {$new_clean_sheet},
                goal_subiti = {$new_goal_subiti},
                ammonizioni = {$new_ammonizioni},
                espulsioni = {$new_espulsioni},
                autogoal = {$new_autogoal}
                WHERE calciatore = :id";

        $stmt = $connection->prepare($query);

        //sanitize input
        $this->goal=htmlspecialchars(strip_tags($this->goal));
        $this->assist=htmlspecialchars(strip_tags($this->assist));
        $this->clean_sheet=htmlspecialchars(strip_tags($this->clean_sheet));
        $this->goal_subiti=htmlspecialchars(strip_tags($this->goal_subiti));
        $this->ammonizioni=htmlspecialchars(strip_tags($this->ammonizioni));
        $this->espulsioni=htmlspecialchars(strip_tags($this->espulsioni));
        $this->autogoal=htmlspecialchars(strip_tags($this->autogoal));
        $id = htmlspecialchars(strip_tags($id));

        //binding parameters
        if(!empty($this->goal)) $stmt->bindParam(':goal', $this->goal, PDO::PARAM_INT);
        if(!empty($this->assist)) $stmt->bindParam(':assist', $this->assist, PDO::PARAM_INT);
        if(!empty($this->clean_sheet)) $stmt->bindParam(':clean_sheet', $this->clean_sheet, PDO::PARAM_INT);
        if(!empty($this->goal_subiti)) $stmt->bindParam(':goal_subiti', $this->goal_subiti, PDO::PARAM_INT);
        if(!empty($this->ammonizioni)) $stmt->bindParam(':ammonizioni', $this->ammonizioni, PDO::PARAM_INT);
        if(!empty($this->espulsioni)) $stmt->bindParam(':espulsioni', $this->espulsioni, PDO::PARAM_INT);
        if(!empty($this->autogoal)) $stmt->bindParam(':autogoal', $this->autogoal, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {

        if(!$this->schedaTecnicaExist($id)) return false;

        $connection = $this->conn;

        //query
        $query = "DELETE FROM scheda_tecnica WHERE calciatore = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();

    }

}