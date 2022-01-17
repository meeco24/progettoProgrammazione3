<?php

class Giocatore extends DatabaseManager{

    //attributi
    public $id_giocatore;
    public $nickname;
    public $email;
    public $passwd;
    public $email_paypal;

    //costruttore
    public function __construct()
    {
        parent::__construct();

    }

//metodi

//funzione che verifica se il nickname del giocatore è presente nel db
    public function nickExist($nickname)
    {

        $connection = $this->conn;

        $query = "SELECT * FROM giocatore WHERE nickname = ?";

        //prepare the query
        $stmt = $connection->prepare($query);

        //bind params
        $stmt->bindParam(1, $nickname);

        //execute query
        $stmt->execute();

        //fetch results
        $giocatore = $stmt->fetch(PDO::FETCH_ASSOC); 

        if(!$giocatore) return false;

        return true;

    }

//funzione che verifica se l'email del giocatore è presente nel db
    public function emailExist($email)
    {

        $connection = $this->conn;

        $query = "SELECT * FROM giocatore WHERE email = ?";

        //prepare the query
        $stmt = $connection->prepare($query);

        //bind params
        $stmt->bindParam(1, $email);

        //execute query
        $stmt->execute();

        //fetch results
        $giocatore = $stmt->fetch(PDO::FETCH_ASSOC); 

        if(!$giocatore) return false;

        $this->id = $giocatore['id_giocatore'];
        $this->nickname = $giocatore['nickname'];
        $this->email = $giocatore['email'];
        $this->passwd = $giocatore['passwd'];
        $this->email_paypal = $giocatore['email_paypal'];

        return true;

    }

//funzione che verifica se il giocatore è presente nel db
    public static function giocatoreExist($id, $connection)
    {

        $query = "SELECT * FROM giocatore WHERE id_giocatore = ?";

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

        //insert query
        $query = "INSERT INTO giocatore  
        SET 
        nickname = :nickname, 
        email = :email, 
        passwd = :passwd, 
        email_paypal = :email_paypal";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind params
        $stmt->bindParam(':nickname', $this->nickname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':email_paypal', $this->email_paypal);

        //hashing password
        $password_hash = password_hash($this->passwd, PASSWORD_DEFAULT);
        $stmt->bindParam(':passwd', $password_hash);

        //execute query
        return $stmt->execute();

    }

//READ-SINGLE
    public function read($id=NULL, $nickname=NULL)
    {

        $connection = $this->conn;

        if(empty($id) && !empty($nickname)){

            $query = "SELECT * FROM giocatore WHERE nickname = ?";

        } else {

        //query
        $query = "SELECT * FROM giocatore WHERE id_giocatore = ?;";

        }

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id=htmlspecialchars(strip_tags($id));

        //bind param
        if(empty($id) && !empty($nickname)){
            $stmt->bindParam(1,$nickname);
        }else{
            $stmt->bindParam(1,$id);
        }

        //execute query
        $stmt->execute();

        //fetch records
        $giocatore = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!($giocatore)) return false;

        $this->id_giocatore = $giocatore['id_giocatore'];
        $this->nickname = $giocatore['nickname'];
        $this->email = $giocatore['email'];
        $this->email_paypal= $giocatore['email_paypal'];

        return true;

    }

//READ-ALL + PAGINAZIONE
    public function readAll($lastID, $pageSize)
    {

        $offset = empty($lastID) ? "(SELECT MAX(id_giocatore) from giocatore)" : ":spiazzamento";

        $connection = $this->conn;

        //query
        $query = "SELECT * from giocatore WHERE id_giocatore <= {$offset} ORDER BY id_giocatore DESC LIMIT :pageSize";
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

//UPDATE
    public function update($id)
    {
        $connection = $this->conn;

        if(!$this->giocatoreExist($id, $connection)) return false;

        $new_nick = !empty($this->nickname) ? ":nickname" : "nickname";
        $new_email = !empty($this->email) ? ":email" : "email";
        $new_passwd = !empty($this->passwd) ? ":passwd" : "passwd";
        $new_email_paypal = !empty($this->email_paypal) ? ":email_paypal" : "email_paypal";

        //query
        $query = "UPDATE giocatore SET
                nickname = {$new_nick},
                email = {$new_email},
                passwd = {$new_passwd},
                email_paypal = {$new_email_paypal}
                WHERE id_giocatore = :id;";

        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));
        $this->nickname=htmlspecialchars(strip_tags($this->nickname));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->email_paypal=htmlspecialchars(strip_tags($this->email_paypal));
        $this->passwd=htmlspecialchars(strip_tags($this->passwd));

        //binding parameters
        if(!empty($this->nickname)) $stmt->bindParam(':nickname', $this->nickname);
        if(!empty($this->email)) $stmt->bindParam(':email', $this->email);
        if(!empty($this->email_paypal)) $stmt->bindParam(':email_paypal', $this->email_paypal);
        $stmt->bindParam(':id', $id);

        //hashing password
        if(!empty($this->passwd)){
        $password_hash = password_hash($this->passwd, PASSWORD_DEFAULT);
        $stmt->bindParam(':passwd', $password_hash);
        }
        return $stmt->execute();

    }

//DELETE
    public function delete($id)
    {

        $connection = $this->conn;

        if(!$this->giocatoreExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM giocatore WHERE id_giocatore = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1, $id);

        //execute query
        return $stmt->execute();
    }

}