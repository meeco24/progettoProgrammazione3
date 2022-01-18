<?php
require_once ('../../../documentRoot.php');
require_once $baseProjectURL."server/models/Squadra.php";

class Competizione extends DatabaseManager{

    //attributi
    public $id;
    public $nome_competizione;
    public $prezzo_iscrizione;
    public $data_creazione;
    public $data_termine;
    public $numero_iscritti;
    public $max_iscritti;
    public $budget;
    public $creatore;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }


//metodi

//funzione per recuperare l'id_amministratore che ha creato l'articolo
    public function id_creatore($admin_name)
    {
        $connection = $this->conn;

        //query
        $query = "SELECT id_admin FROM amministratore WHERE admin_name = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $admin_name = htmlspecialchars(strip_tags($admin_name));

        //bind Param
        $stmt->bindParam(1,$admin_name);

        //execute query
        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$results) return false;

        $this->creatore = $results['id_admin'];

        return true;

    }

//funzione per verificare che la competizione sia presente nel db
    public static function competizioneExist($id, $connection)
    {

        $query = "SELECT * FROM competizione WHERE id_competizione = ?";

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

        //query
        $query = "INSERT INTO competizione
        SET
        nome_competizione = :nome_competizione,
        prezzo_iscrizione = :prezzo_iscrizione,
        data_termine = cast(:data_termine AS datetime),
        max_iscritti = :max_iscritti,
        budget = :budget,
        creatore = :creatore;";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nome_competizione=htmlspecialchars(strip_tags($this->nome_competizione));
        $this->prezzo_iscrizione=htmlspecialchars(strip_tags($this->prezzo_iscrizione));
        $this->data_termine=htmlspecialchars(strip_tags($this->data_termine));
        $this->max_iscritti=htmlspecialchars(strip_tags($this->max_iscritti));
        $this->budget=htmlspecialchars(strip_tags($this->budget));
        $this->id_creatore($this->creatore);

        //bind params
        $stmt->bindParam(':nome_competizione', $this->nome_competizione);
        $stmt->bindParam(':prezzo_iscrizione', $this->prezzo_iscrizione);
        $stmt->bindParam(':data_termine', $this->data_termine);
        $stmt->bindParam(':max_iscritti', $this->max_iscritti);
        $stmt->bindParam(':budget', $this->budget);
        $stmt->bindParam(':creatore', $this->creatore);

        //execute query
        return $stmt->execute();

    }

//READ-SINGLE
    public function read($id)
    {

        $connection = $this->conn;

        if(!Competizione::competizioneExist($id, $connection)) return false;

        //query
        $query = "SELECT * FROM competizione WHERE id_competizione = ?;";


        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch record
        $competizione = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$competizione) return false;

        //fill object fields
        
            $this->id = $competizione['id_competizione'];
            $this->nome_competizione = $competizione['nome_competizione'];
            $this->data_creazione = $competizione['data_creazione'];
            $this->data_termine = $competizione['data_termine'];
            $this->prezzo_iscrizione = $competizione['prezzo_iscrizione'];
            $this->numero_iscritti = $competizione['numero_iscritti'];
            $this->max_iscritti = $competizione['max_iscritti'];
            $this->budget = $competizione['budget'];
            $this->creatore = $competizione['creatore'];

            return true;

    }

//READ-ALL + PAGINAZIONE + FILTRI
    public function readAll($lastID, $pageSize, $nome_competizione, $filter)
    {

        $filtri = ["data_creazione","budget", "data_termine", "prezzo_iscrizione", "numero_iscritti", "max_iscritti", "budget"];


        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(id_competizione) from competizione)" : ":spiazzamento";
        $nomeCompetizione = empty($nome_competizione) ? "" : "AND (c.nome_competizione LIKE :nome_competizione)";
        $filtro = empty($filter) || !in_array($filter, $filtri) ? "" : "{$filter} DESC,";

        $connection = $this->conn;

        //query
        $query = "SELECT c.*, adm.admin_name
                    FROM competizione as c 
                    JOIN amministratore as adm ON adm.id_admin = c.creatore 
                    WHERE id_competizione <= {$offset}
                    {$nomeCompetizione}
                    ORDER BY {$filtro} id_competizione DESC LIMIT :pageSize";

        //prepare query
        $stmt = $connection->prepare($query);

        // var_dump($stmt);
        // die;

        //bind param
        $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);        
        if(!empty($lastID)) $stmt->bindParam(":spiazzamento", $lastID); 
        if(!empty($nome_competizione)) $stmt->bindParam(":nome_competizione", $nome_competizione);


        //execute query
        $stmt->execute();

        //fetch records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;


    }

//UPDATE
    public static function update($id, $connection)
    {

        if(!Competizione::competizioneExist($id, $connection)) return false;

        //query
        $query = "UPDATE competizione SET
                numero_iscritti = numero_iscritti + 1
                WHERE id_competizione = ?;";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //binding parameters
        $stmt->bindParam(1, $id);

        //execute query
        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {
        $connection = $this->conn;

        if(!Competizione::competizioneExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM competizione WHERE id_competizione = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1, $id);

        //execute query
        return $stmt->execute();

    }

}