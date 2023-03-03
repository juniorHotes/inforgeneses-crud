<?php
namespace App\Config;

class Database {

    private $hostname = 'localhost:3306';
    private $username = 'root';
    private $userpass = 'junior150692';
    private $dbname = 'inforgenenses_crud';
    private $conn; 

    function __construct() {

        try {
            $this->conn = new \PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->dbname, $this->username, $this->userpass);
        } catch (PDOException $exc) {
            echo 'PDO Error: ' . $exc->getMessage();
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}