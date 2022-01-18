<?php

require_once ('../../../documentRoot.php');
require_once $baseProjectURL."server/models/Tipologia.php";
require_once $baseProjectURL."server/models/Amministratore.php";

class Articolo extends DatabaseManager{

    //attributi
    public $id;
    public $titolo;
    public $contenuto;
    public $data_creazione;
    public $tipologia;
    public $autore;
    public $admin_name;
    public $descrizione;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

    //metodi

//funzione per controllare che l'articolo sia presente nel db
    public function articoloExist($id)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM articolo WHERE id_articolo = ?";

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

        if(!Tipologia::tipologiaExist($this->tipologia, $connection)) return false;
        if(!Amministratore::adminExist($this->autore, $connection)) return false;

        //query
        $query = "INSERT INTO articolo
        SET
        titolo = :titolo,
        contenuto = :contenuto,
        tipologia = :tipologia,
        autore = :autore";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->titolo=htmlspecialchars(strip_tags($this->titolo));
        $this->contenuto=htmlspecialchars(strip_tags($this->contenuto));
        $this->tipologia=htmlspecialchars(strip_tags($this->tipologia));
        $this->autore=htmlspecialchars(strip_tags($this->autore));

        //bind params
        $stmt->bindParam(':titolo', $this->titolo);
        $stmt->bindParam(':contenuto', $this->contenuto);
        $stmt->bindParam(':tipologia', $this->tipologia);
        $stmt->bindParam(':autore', $this->autore);

        //execute query
        return $stmt->execute();

    }

//READ-SINGLE
    public function read($id)
    {

        if(!$this->articoloExist($id)) return false;

        $connection = $this->conn;

        //query
        $query = "SELECT a.*, adm.admin_name, t.descrizione 
                    FROM articolo as a 
                    JOIN tipologia as t ON t.id_tipologia=a.tipologia 
                    JOIN amministratore as adm ON adm.id_admin = a.autore 
                    WHERE id_articolo = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch record
        $articolo = $stmt->fetch(PDO::FETCH_ASSOC);

        //fill object fields
        if(!$articolo) return false;
            
        $this->id = $articolo['id_articolo'];
        $this->titolo = $articolo['titolo'];
        $this->contenuto = $articolo['contenuto'];
        $this->data_creazione = $articolo['data_creazione'];
        $this->tipologia = $articolo['tipologia'];
        $this->autore = $articolo['autore'];
        $this->admin_name = $articolo['admin_name'];
        $this->descrizione = $articolo['descrizione'];

        return true;

    }
//READ-ALL + PAGINAZIONE + FILTRO
    public function readAll($lastID, $pageSize, $tipologia)
    {
        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(id_articolo) from articolo)" : ":spiazzamento";
        $condition = !(empty($tipologia)) ? "AND tipologia = :tipologia " : "";

        $connection = $this->conn;

        //query
        $query = "SELECT a.*, adm.admin_name, t.descrizione 
                    FROM articolo as a 
                    JOIN tipologia as t ON t.id_tipologia=a.tipologia 
                    JOIN amministratore as adm ON adm.id_admin = a.autore 
                    WHERE id_articolo <= {$offset} {$condition} 
                    ORDER BY id_articolo DESC LIMIT :pageSize";
        
        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        if(!empty($lastID)) $stmt->bindParam(":spiazzamento", $lastID); 
        $stmt->bindParam(":pageSize", $pageSize, PDO::PARAM_INT);
        if(strlen($condition) > 0) $stmt->bindParam(":tipologia", $tipologia);

        //execute query
        $stmt->execute();

        //fetch records
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;

    }

//UPDATE
    public function update($id){

        if(!$this->articoloExist($id)) return false;
        
        $new_titolo = !empty($this->titolo) ? ":titolo" : "titolo";
        $new_contenuto = !empty($this->contenuto) ? ":contenuto" : "contenuto";
        $new_tipologia = !empty($this->tipologia) ? ":tipologia" : "tipologia";

        $connection = $this->conn;

        //query
        $query = "UPDATE articolo SET
                titolo = {$new_titolo},
                contenuto = {$new_contenuto},
                tipologia = {$new_tipologia}
                WHERE id_articolo = :id;";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->titolo=htmlspecialchars(strip_tags($this->titolo));
        $this->contenuto=htmlspecialchars(strip_tags($this->contenuto));
        $this->tipologia=htmlspecialchars(strip_tags($this->tipologia));
        $id = htmlspecialchars(strip_tags($id));

        //binding parameters
        if(!empty($this->titolo)) $stmt->bindParam(':titolo', $this->titolo);
        if(!empty($this->contenuto)) $stmt->bindParam(':contenuto', $this->contenuto);
        if(!empty($this->tipologia)) $stmt->bindParam(':tipologia', $this->tipologia);
        $stmt->bindParam(':id', $id);

        //execute query
        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {

        if(!$this->articoloExist($id)) return false;

        $connection = $this->conn;

        //query
        $query = "DELETE FROM articolo WHERE id_articolo = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();

    }

}