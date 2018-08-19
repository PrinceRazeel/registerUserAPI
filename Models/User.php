<?php

Class User{

    private $conn;
    private $table = 'users';
    
    public $id;
    public $name;
    public $email;
    public $age;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function view(){
        $query = 'SELECT * FROM '.$this->table ;
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }


    public function create(){
        $query = 'INSERT INTO '.$this->table.' SET name = :name, email = :email, age = :age';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->age = htmlspecialchars(strip_tags($this->age));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':age', $this->age);

        if($stmt->execute()){
            return true;
        }else{
            echo json_encode(array($stmt->error));
            return false;
        }
    }

}