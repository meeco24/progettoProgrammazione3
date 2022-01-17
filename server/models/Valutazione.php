<?php

include_once '/Users/Intel/Desktop/FantaRoyale/server/models/SchedaTecnica.php';

class Valutazione extends DatabaseManager{

//attributi
    public $calciatore;
    public $giornata;
    public $voto;
    public $fantavoto;
    public $goal;
    public $assist;
    public $clean_sheet;
    public $goal_subiti;
    public $ammonizioni;
    public $espulsioni;
    public $autogoal;
    public $rigore_sbagliato;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi

//funzione che verifica se la valutazione è presente nel db
    public static function valutazioneExist($calciatore, $giornata, $connection)
    {

        $query = "SELECT * FROM valutazione
        WHERE calciatore = :calciatore AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(":calciatore", $calciatore);
        $stmt->bindParam(":giornata", $giornata);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

//funzione che restituisce la media dei voti di un calciatore
    public static function mediaVoto($calciatore, $connection)
    {
        $query = "SELECT calciatore, AVG(voto) as 'media_voto' FROM valutazione WHERE calciatore = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $calciatore);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

//funzione che restituisce la media dei fantavoti di un calciatore
    public static function mediaFantavoto($calciatore, $connection)
    {
        $query = "SELECT calciatore, AVG(fantavoto) as 'media_fantavoto' FROM valutazione WHERE calciatore = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $calciatore);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


//metodi CRUD

//CREATE
    public function create()
    {

        $connection = $this->conn;

        $query = "INSERT INTO valutazione SET
                    calciatore = :calciatore,
                    giornata = :giornata,
                    voto = :voto,
                    fantavoto = :fantavoto,
                    goal = :goal,
                    assist = :assist,
                    clean_sheet = :clean_sheet,
                    goal_subiti = :goal_subiti,
                    ammonizioni = :ammonizioni,
                    espulsioni = :espulsioni,
                    autogoal = :autogoal,
                    rigore_sbagliato = :rigore_sbagliato";

        $stmt = $connection->prepare($query);

        $this->calciatore = htmlspecialchars(strip_tags($this->calciatore));
        $this->giornata = htmlspecialchars(strip_tags($this->giornata));
        $this->voto = htmlspecialchars(strip_tags($this->voto));
        $this->fantavoto = htmlspecialchars(strip_tags($this->fantavoto));
        $this->goal = htmlspecialchars(strip_tags($this->goal));
        $this->assist = htmlspecialchars(strip_tags($this->assist));
        $this->clean_sheet = htmlspecialchars(strip_tags($this->clean_sheet));
        $this->goal_subiti = htmlspecialchars(strip_tags($this->goal_subiti));
        $this->ammonizioni = htmlspecialchars(strip_tags($this->ammonizioni));
        $this->espulsioni = htmlspecialchars(strip_tags($this->espulsioni));
        $this->autogoal = htmlspecialchars(strip_tags($this->autogoal));
        $this->rigore_sbagliato = htmlspecialchars(strip_tags($this->rigore_sbagliato));

        if(Valutazione::valutazioneExist($this->calciatore, $this->giornata, $connection)) return false;

        $stmt->bindParam(":calciatore", $this->calciatore);
        $stmt->bindParam(":giornata", $this->giornata);
        $stmt->bindParam(":voto", $this->voto);
        $stmt->bindParam(":fantavoto", $this->fantavoto);
        $stmt->bindParam(":goal", $this->goal);
        $stmt->bindParam(":assist", $this->assist);
        $stmt->bindParam(":clean_sheet", $this->clean_sheet);
        $stmt->bindParam(":goal_subiti", $this->goal_subiti);
        $stmt->bindParam(":ammonizioni", $this->ammonizioni);
        $stmt->bindParam(":espulsioni", $this->espulsioni);
        $stmt->bindParam(":autogoal", $this->autogoal);
        $stmt->bindParam(":rigore_sbagliato", $this->rigore_sbagliato);

        try {

            $connection->beginTransaction();

            $stmt->execute();
        
            $scheda_tecnica = new SchedaTecnica();

            $scheda_tecnica->goal = $this->goal;
            $scheda_tecnica->assist = $this->assist;
            $scheda_tecnica->clean_sheet = $this->clean_sheet;
            $scheda_tecnica->goal_subiti = $this->goal_subiti;
            $scheda_tecnica->ammonizioni = $this->ammonizioni;
            $scheda_tecnica->espulsioni = $this->espulsioni;
            $scheda_tecnica->autogoal = $this->autogoal;

            $scheda_tecnica->update($this->calciatore);

            return $connection->commit();

        } catch (PDOException $e) {
            
            return $connection->rollBack();

        }

    }

//READ-SINGLE
    public function read($calciatore, $giornata)
    {

        $connection = $this->conn;

        $query = "SELECT v.*, c.nominativo
                    FROM valutazione as v 
                    JOIN calciatore as c ON c.id_calciatore = v.calciatore
                    WHERE calciatore = :calciatore AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(":calciatore", $calciatore);
        $stmt->bindParam(":giornata", $giornata);

        $stmt->execute();

        $result = $stmt->fetch(pdo::FETCH_ASSOC);

        // if(!$result) return false;

        // $this->calciatore = $result["calciatore"];
        // $this->giornata = $result["giornata"];
        // $this->voto = $result["voto"];
        // $this->fantavoto = $result["fantavoto"];
        // $this->goal = $result["goal"];
        // $this->assist = $result["assist"];
        // $this->clean_sheet = $result["clean_sheet"];
        // $this->goal_subiti = $result["goal_subiti"];
        // $this->ammonizioni = $result["ammonizioni"];
        // $this->espulsioni = $result["espulsioni"];
        // $this->autogoal = $result["autogoal"];
        // $this->rigore_sbagliato = $result["rigore_sbagliato"];

        return $result;

    }

//READ-ALL
    public function readAll($giornata)
    {
        $connection = $this->conn;

        $query = "SELECT v.*, c.nominativo
                FROM valutazione as v 
                JOIN calciatore as c ON c.id_calciatore = v.calciatore
                WHERE giornata = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1,$giornata);

        $stmt->execute();

        $result = $stmt->fetchAll(pdo::FETCH_ASSOC);

        return $result;

    }

//UPDATE
    public function update($calciatore, $giornata)
    {

        $connection = $this->conn;

        if(!Valutazione::valutazioneExist($calciatore, $giornata, $connection)) return false;

        $new_voto = !empty($this->voto) ? ":voto" : "voto";
        $new_fantavoto = !empty($this->fantavoto) ? ":fantavoto" : "fantavoto";
        $new_goal = !empty($this->goal) ? ":goal" : "goal";
        $new_assist = !empty($this->assist) ? ":assist" : "assist";
        $new_clean_sheet = !empty($this->clean_sheet) ? ":clean_sheet" : "clean_sheet";
        $new_goal_subiti = !empty($this->goal_subiti) ? ":goal_subiti" : "goal_subiti";
        $new_ammonizioni = !empty($this->ammonizioni) ? ":ammonizioni" : "ammonizioni";
        $new_espulsioni = !empty($this->espulsioni) ? ":espulsioni" : "espulsioni";
        $new_autogoal = !empty($this->autogoal) ? ":autogoal" : "autogoal";
        $new_rigore_sbagliato = !empty($this->rigore_sbagliato) ? ":rigore_sbagliato" : "rigore_sbagliato";

        $query = "UPDATE valutazione SET
                voto = {$new_voto},
                fantavoto = {$new_fantavoto},
                goal = {$new_goal},
                assist = {$new_assist},
                clean_sheet = {$new_clean_sheet},
                goal_subiti = {$new_goal_subiti},
                ammonizioni = {$new_ammonizioni},
                espulsioni = {$new_espulsioni},
                autogoal = {$new_autogoal},
                rigore_sbagliato = {$new_rigore_sbagliato}
                WHERE calciatore = :calciatore AND giornata = :giornata";

        $stmt = $connection->prepare($query);

        //sanitize input
        $this->voto=htmlspecialchars(strip_tags($this->voto));
        $this->fantavoto=htmlspecialchars(strip_tags($this->fantavoto));
        $this->goal=htmlspecialchars(strip_tags($this->goal));
        $this->assist=htmlspecialchars(strip_tags($this->assist));
        $this->clean_sheet=htmlspecialchars(strip_tags($this->clean_sheet));
        $this->goal_subiti=htmlspecialchars(strip_tags($this->goal_subiti));
        $this->ammonizioni=htmlspecialchars(strip_tags($this->ammonizioni));
        $this->espulsioni=htmlspecialchars(strip_tags($this->espulsioni));
        $this->autogoal=htmlspecialchars(strip_tags($this->autogoal));
        $this->rigore_sbagliato=htmlspecialchars(strip_tags($this->rigore_sbagliato));
        $calciatore = htmlspecialchars(strip_tags($calciatore));
        $giornata = htmlspecialchars(strip_tags($giornata));

        //binding parameters
        if(!empty($this->voto)) $stmt->bindParam(':voto', $this->voto);
        if(!empty($this->fantavoto)) $stmt->bindParam(':fantavoto', $this->fantavoto);
        if(!empty($this->goal)) $stmt->bindParam(':goal', $this->goal, PDO::PARAM_INT);
        if(!empty($this->assist)) $stmt->bindParam(':assist', $this->assist, PDO::PARAM_INT);
        if(!empty($this->clean_sheet)) $stmt->bindParam(':clean_sheet', $this->clean_sheet, PDO::PARAM_INT);
        if(!empty($this->goal_subiti)) $stmt->bindParam(':goal_subiti', $this->goal_subiti, PDO::PARAM_INT);
        if(!empty($this->ammonizioni)) $stmt->bindParam(':ammonizioni', $this->ammonizioni, PDO::PARAM_INT);
        if(!empty($this->espulsioni)) $stmt->bindParam(':espulsioni', $this->espulsioni, PDO::PARAM_INT);
        if(!empty($this->autogoal)) $stmt->bindParam(':autogoal', $this->autogoal, PDO::PARAM_INT);
        if(!empty($this->rigore_sbagliato)) $stmt->bindParam(':rigore_sbagliato', $this->rigore_sbagliato, PDO::PARAM_INT);
        $stmt->bindParam(':calciatore', $calciatore);
        $stmt->bindParam(':giornata', $giornata);

        return $stmt->execute();

    }

//DELETE
    public function delete($calciatore, $giornata)
    {
        $connection = $this->conn;

        if(!Valutazione::valutazioneExist($calciatore, $giornata, $connection)) return false;

        //query
        $query = "DELETE FROM valutazione
                    WHERE calciatore = :calciatore AND giornata = :giornata";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(":calciatore",$calciatore);
        $stmt->bindParam(":giornata",$giornata);

        //execute query
        return $stmt->execute();

    }
}