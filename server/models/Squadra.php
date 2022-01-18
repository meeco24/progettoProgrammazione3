<?php
require_once ('../../../documentRoot.php');
require_once $baseProjectURL."server/models/Giocatore.php";
require_once $baseProjectURL."server/models/Competizione.php";

class Squadra extends DatabaseManager{

//attributi
    public $id;
    public $nome;
    public $presidente;
    public $competizione;

//costruttore
    public function __construct()
    {
        parent::__construct();
    }

//metodi
//funzione che verifica se la squadra è presente nel db
    public static function squadraExist($id, $connection, $nome_squadra=NULL) //ok
    {

        $nome_squadra = !empty($nome_squadra) ? "OR nome_squadra = ?" : "";

        $query = "SELECT * FROM squadra WHERE id_squadra = ? {$nome_squadra}";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id);
        if(!empty($nome_squadra)) $stmt->bindParam(2, $nome_squadra);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result) return false;

        return true;

    }

//funzione che verifica se la squadra è iscritta alla competizione e la restituisce come risulato insieme al nome della competizione a cui è eventualmente iscritta
    public static function checkIscrizione($presidente, $id_competizione, $connection)
    {

        $query = "SELECT s.*, c.nome_competizione
                    FROM squadra as s
                    JOIN competizione as c ON c.id_competizione = s.competizione 
                    WHERE s.presidente = ? AND c.id_competizione = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $presidente);
        $stmt->bindParam(2, $id_competizione);

        $stmt->execute();

        $squadra = $stmt->fetch(PDO::FETCH_ASSOC);

        return $squadra;

    }

//funzione che restituisce tutte le squadre, e il nome della competizione a cui sono iscritte, del giocatore
    public static function getSquadre($presidente, $connection)
    {

        $query = "SELECT s.*, c.nome_competizione
                    FROM squadra as s
                    JOIN competizione as c ON c.id_competizione = s.competizione 
                    WHERE s.presidente = ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $presidente);

        $stmt->execute();

        $squadre = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $squadre;

    }

//funzione che restituisce il fantavoto di un calciatore in panchina (in assenza di uno dei titolari)
    public static function panchina($valutazioni, $calciatore, $giornata)
    {
        foreach ($valutazioni as $val) {

            if(!$val['schierato'] AND ($val['ruolo'] == $calciatore['ruolo']) AND ($val['giornata'] == $giornata))
            {
                return empty($val['fantavoto']) ? 0 : $val['fantavoto'];
            }

        }
    }

//funzione che calcola le classifiche (a seconda se il parametro giornata è passato alla funzione) di una competizione e restituisce un array associativo ['squadra'] => ['punteggio] 
    public function classifica($competizione, $giornata=NULL)
    {

        $connection = $this->conn;
        $dati = [];
        $classifica = [];

        $condizione = !empty($giornata) ? "AND f.giornata = ?" : "";


        $query = "SELECT s.nome_squadra, c.id_calciatore, v.fantavoto, c.nominativo, c.ruolo, f.schierato, f.giornata 
                    FROM squadra as s 
                    JOIN formazione as f ON s.id_squadra = f.squadra 
                    LEFT JOIN valutazione as v ON f.calciatore = v.calciatore 
                    JOIN calciatore as c ON f.calciatore = c.id_calciatore
                    WHERE s.competizione = ? {$condizione}";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $competizione);
        if(strlen($condizione)) $stmt->bindParam(2, $giornata);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $elem) {

            if(!array_key_exists($elem['nome_squadra'], $dati))
            {

                $dati[$elem['nome_squadra']] = [];

            }

                array_push($dati[$elem['nome_squadra']], $elem);

        }

        foreach ($dati as $squadra => $valutazioni) {
            
            $sum = 0;

            foreach ($valutazioni as $calciatore) {

                if($calciatore['schierato'])
                {
                    $sum += empty($calciatore['fantavoto']) ? Squadra::panchina($valutazioni, $calciatore, $calciatore['giornata']) : $calciatore['fantavoto'];
                }

            }

            array_push($classifica, array("squadra" => $squadra, "punteggio" => $sum));

        }

        usort($classifica, function ($a, $b) {

            return $b['punteggio'] <=> $a['punteggio'];

        });

        return $classifica;

    }

//metodi CRUD

//CREATE
    public function create()
    {

        $connection = $this->conn;

        if(!Giocatore::giocatoreExist($this->presidente, $connection)) return false;
        if(!Competizione::competizioneExist($this->competizione, $connection)) return false;

        //query
        $query = "INSERT INTO squadra
        SET
        nome_squadra = :nome_squadra,
        presidente = :presidente,
        competizione = :competizione";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->presidente=htmlspecialchars(strip_tags($this->presidente));
        $this->competizione=htmlspecialchars(strip_tags($this->competizione));

        //bind params
        $stmt->bindParam(':nome_squadra', $this->nome);
        $stmt->bindParam(':presidente', $this->presidente);
        $stmt->bindParam(':competizione', $this->competizione);



        try {

            $connection->beginTransaction();
        
            //execute query
            $stmt->execute();
        
            $competizione = new Competizione();

            $competizione->update($this->competizione, $connection);

            return $connection->commit();

        } catch (PDOException $e) {
            
            return $connection->rollBack();

        }

    }

//READ-SINGLE
    public function read($id)
    {
        $connection = $this->conn;

        if(!Squadra::squadraExist($id, $connection)) return false;

        //query
        $query = "SELECT * FROM squadra WHERE id_squadra = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        $stmt->execute();

        //fetch record
        $squadra = $stmt->fetch(PDO::FETCH_ASSOC);

        //fill object fields
        if(!$squadra) return false;
            
        $this->id = $squadra['id_squadra'];
        $this->nome = $squadra['nome_squadra'];
        $this->presidente = $squadra['presidente'];
        $this->competizione = $squadra['competizione'];

        return true;
    }

//READ-ALL + PAGINAZIONE
    public function readAll($lastID, $pageSize)
    {
        $pageSize = strlen($pageSize) == 0 ? 3 : $pageSize;
        $offset = empty($lastID) ? "(SELECT MAX(id_squadra) from squadra)" : ":spiazzamento";

        $connection = $this->conn;

        //query
        $query = "SELECT s.*, g.nickname, c.nome_competizione 
                    FROM squadra as s 
                    JOIN giocatore as g ON g.id_giocatore=s.presidente 
                    JOIN competizione as c ON c.id_competizione = s.competizione 
                    WHERE id_squadra <= {$offset} 
                    ORDER BY id_squadra DESC LIMIT :pageSize";
        
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

//DELETE
    public function delete($id)
    {

        $connection = $this->conn;

        if(!Squadra::squadraExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM squadra WHERE id_squadra = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();

    }

}