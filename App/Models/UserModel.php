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

        $user_name = $params['user_name'];
        $user_email = $params['user_email'];
        $password = password_hash($params['password'], PASSWORD_DEFAULT);

        $prepare->bindValue(':name', $user_name);
        $prepare->bindValue(':email', $user_email);
        $prepare->bindValue(':password', $password);

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

    public function get(string $id) {

        $query = "SELECT * FROM `inforgenenses_crud`.`users` WHERE id='{$id}'";

        $result = $this->conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            $user = $result->fetch(\PDO::FETCH_ASSOC);
            return $user;
        }

        return array();
    }
}