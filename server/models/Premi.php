<?php

class Premio extends DatabaseManager{

    //attributi
    public $id;
    public $giocatore;
    public $amministratore;
    public $importo;
    public $data_erogazione;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

    //metodi

    public function premioExist($id)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM premi WHERE id_premio = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

    public function create()
    {

        $connection = $this->conn;

        //query
        $query = "INSERT INTO premi
        SET
        giocatore = :giocatore,
        amministratore = :amministratore,
        importo = :importo;";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->giocatore=htmlspecialchars(strip_tags($this->giocatore));
        $this->amministratore=htmlspecialchars(strip_tags($this->amministratore));
        $this->importo=htmlspecialchars(strip_tags($this->importo));

        //bind params
        $stmt->bindParam(':giocatore', $this->giocatore);
        $stmt->bindParam(':amministratore', $this->amministratore);
        $stmt->bindParam(':importo', $this->importo);

        //execute query
        return $stmt->execute();

    }

    public function read($id)
    {

        if(!$this->premioExist($id)) return false;

        $connection = $this->conn;

        //query
        $query = "SELECT * FROM premi WHERE id_premio = ?;";


        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch record
        $premio = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$premio) return false;

        //fill object fields
        
            $this->id = $premio['id_premio'];
            $this->giocatore = $premio['giocatore'];
            $this->amministratore = $premio['amministratore'];
            $this->importo = $premio['importo'];
            $this->data_erogazione = $premio['data_erogazione'];

            return true;

    }

    public function readAll($lastID, $pageSize)
    {
        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(id_premio) from premi)" : ":spiazzamento";

        $connection = $this->conn;

        //query
        $query = "SELECT p.*, adm.admin_name, g.nickname
                    FROM premi as p 
                    JOIN amministratore as adm ON adm.id_admin = p.amministratore 
                    JOIN giocatore as g ON g.id_giocatore = p.giocatore 
                    WHERE id_premio <= {$offset}
                    ORDER BY id_premio DESC LIMIT :pageSize";
        
        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        if(!empty($lastID)) $stmt->bindParam(":spiazzamento", $lastID); 
        $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);

        //execute query
        $stmt->execute();

        //fetch records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

    public function delete($id)
    {

        if(!$this->premioExist($id)) return false;

        $connection = $this->conn;

        //query
        $query = "DELETE FROM premi WHERE id_premio= ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();

    }

}