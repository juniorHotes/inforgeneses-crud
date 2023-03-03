<?php
namespace App\Models;

use App\Config\Database;

class UserModel {

    private $conn;

    function __construct() {
        $this->conn = new Database();
    }

    public function insert(array $params) {
        
        $query = "INSERT INTO users 
            (
                name, 
                email, 
                password, 
                created_at,
                update_at
            ) 
            values (
                ':name', 
                ':email', 
                ':password', 
                CURRENT_TIMESTAMP,
                CURRENT_TIMESTAMP
                );
        ";

        $prepare = $this->conn->prepare($query);

        $prepare->bindValue(':name', $params['name']);
        $prepare->bindValue(':email', $params['email']);
        $prepare->bindValue(':password', $params['password']);

        return $prepare->execute();
    }
}