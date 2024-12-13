<?php

class Sql extends PDO{
    
    private $conn;

    public function __construct(){

        $this->conn = new PDO("mysql:host=127.0.0.1;dbname=dados", "abraaoc", "#wks#1793");

    }

    private function set_params($statment, $parameters = array()){
        
        foreach ($parameters as $key => $value) {
            $statment->bindParam($key, $value);
        }
    }

    private function set_param($statment, $key, $value){

        $statment->bindParam($key, $value);
    }

    public function querys($raw_query, $params = array()){
        
        $stmt = $this->conn->prepare($raw_query);
        $this->set_params($stmt, $params);
        $stmt->execute();
        return $stmt;
        
    }

    public function select($raw_query, $params = array()){

        $stmt = $this->querys($raw_query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete($raw_query, $params = array()){
        $stmt = $this->querys($raw_query, $params);
    }
    public function insert($raw_query, $params = array()){
        $stmt = $this->querys($raw_query, $params);
        return;
    }
}

?>