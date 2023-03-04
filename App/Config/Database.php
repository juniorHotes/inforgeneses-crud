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
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->create_data_base();
        } catch (\PDOException $exc) {
            echo 'PDO Error: ' . $exc->getMessage();
        }
    }

    private function create_data_base() {

        $query = "CREATE TABLE IF NOT EXISTS `inforgenenses_crud`.`users` (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    password VARCHAR(16) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                )";

        $prepare = $this->conn->prepare($query);

        $prepare->execute();
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}