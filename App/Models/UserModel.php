<?php
namespace App\Models;

use App\Config\Database;

class UserModel {

    private $conn;

    function __construct() {
        $this->conn = new Database();
    }

    public function insert(array $params) {
        
        $query = "INSERT INTO `inforgenenses_crud`.`users` 
            (
                name, 
                email, 
                password
            ) 
            values (
                :name, 
                :email, 
                :password
                );
        ";

        $prepare = $this->conn->prepare($query);

        $name = $params['name'];
        $email = $params['email'];
        $password = password_hash($params['password'], PASSWORD_DEFAULT);

        $prepare->bindValue(':name', $name);
        $prepare->bindValue(':email', $email);
        $prepare->bindValue(':password', $password);

        return $prepare->execute();
    }

    public function update(array $params) {
        
        $query = "UPDATE `inforgenenses_crud`.`users` SET 
                    name=:name, 
                    email=:email 
                    WHERE id=:id
                ";

        $prepare = $this->conn->prepare($query);

        $id = $params['id'];
        $name = $params['name'];
        $email = $params['email'];

        $prepare->bindValue(':id', $id, \PDO::PARAM_INT);
        $prepare->bindValue(':name', $name);
        $prepare->bindValue(':email', $email);

        return $prepare->execute();
    }

    public function update_pass(array $params) {
        
        $query = "UPDATE `inforgenenses_crud`.`users` SET 
                    password=:password
                    WHERE id=:id
                ";

        $prepare = $this->conn->prepare($query);

        $id = $params['id'];
        $password = password_hash($params['password'], PASSWORD_DEFAULT);

        $prepare->bindValue(':id', $id, \PDO::PARAM_INT);
        $prepare->bindValue(':password', $password);

        return $prepare->execute();
    }

    public function delete(array $params) {
        
        $query = "DELETE FROM `inforgenenses_crud`.`users` WHERE id=:id";

        $prepare = $this->conn->prepare($query);

        $id = $params['user_id'];

        $prepare->bindValue(':id', $id, \PDO::PARAM_INT);
        return $prepare->execute();
    }

    public function get_all() {

        $query = "SELECT * FROM `inforgenenses_crud`.`users` ORDER BY created_at DESC";

        $result = $this->conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            while($user = $result->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $user;
            }

            return $users;
        }

        return array();
    }

    public function get_user_by(string $key, string $value) {

        $query = "SELECT * FROM `inforgenenses_crud`.`users` WHERE {$key}='{$value}'";

        $result = $this->conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            $user = $result->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }

        return array();
    }
}