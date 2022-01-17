<?php

class Amministratore extends DatabaseManager{


    //attributi
    public $id;
    public $admin_name;
    public $password;

    //costruttore
    public function __construct()
    {
        parent::__construct();
    }

    //metodi

//funzione per verificare se l'admin è presente nel database
    public static function adminExist($id_admin, $connection)
    {

        $query = "SELECT * FROM amministratore WHERE id_admin= ?";

        $stmt = $connection->prepare($query);

        $stmt->bindParam(1, $id_admin);

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

        $query = "INSERT INTO amministratore SET
                    admin_name = :admin_name,
                    passwd = :passwd";

        $stmt = $connection->prepare($query);

        $this->admin_name = htmlspecialchars(strip_tags($this->admin_name));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $stmt->bindParam(":admin_name",$this->admin_name);

        //hashing password
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':passwd', $password_hash);

        return $stmt->execute();
    }

//READ
    public function read($admin_name)
    {
        $connection = $this->conn;

        $query = "SELECT * FROM amministratore WHERE admin_name = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //bind param
        $stmt->bindParam(1, $admin_name);

        //execute query
        $stmt->execute();

        //fetch row
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$admin) return false;

        $this->id = $admin['id_admin'];
        $this->admin_name = $admin['admin_name'];
        $this->password = $admin['passwd'];

        return true;

    }

//UPDATE
    public function update($id)
    {
        $new_admin_name = !empty($this->admin_name) ? ":admin_name" : "admin_name";
        $new_password = !empty($this->password) ? ":passwd" : "passwd";

        $connection = $this->conn;

        if(!Amministratore::adminExist($id, $connection)) return false;

        $query = "UPDATE ruolo SET 
                    admin_name = {$new_admin_name},
                    passwd = {$new_password}
                    WHERE id_admin = :id";

        $stmt = $connection->prepare($query);

        $this->admin_name = htmlspecialchars(strip_tags($this->admin_name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(':admin_name', $this->admin_name);
        $stmt->bindParam(':passwd', $this->password);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

//DELETE
    public function delete($id)
    {

        $connection = $this->conn;

        if(!Amministratore::adminExist($id, $connection)) return false;

        //query
        $query = "DELETE FROM amministratore WHERE id_admin = ?";

        //prepare query
        $stmt = $connection->prepare($query);

        //sanitize input
        $id = htmlspecialchars(strip_tags($id));

        //bind param
        $stmt->bindParam(1,$id);

        //execute query
        return $stmt->execute();
    }
}