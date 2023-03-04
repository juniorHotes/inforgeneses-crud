<?php
namespace App\Libs;

use App\Config\Database;

class FormValidation {

    public static function is_email(string $email) {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public static function check_password(string $pass) {
        if(preg_match('/^(?=(?:.*[A-Z]))(?=(?:.*[a-z]))(?=(?:.*\d))(?=(?:.*[!@#$%^&*()\-_=+{};:,<.>]))(?!.*(.)\1{2})([A-Za-z0-9!@#$%^&*()\-_=+{};:,<.>]{8,20})$/', $pass) ) {
            return true;
        }

        return false;
    }

    public static function user_exists(string $name) {
        $query = "SELECT name FROM `inforgenenses_crud`.`users` WHERE name='{$name}'";

        $conn = new Database();
        $result = $conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            return true;
        }

        return false;
    }

    public static function email_exists(string $email) {
        $query = "SELECT email FROM `inforgenenses_crud`.`users` WHERE email='{$email}'";

        $conn = new Database();
        $result = $conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            return true;
        }

        return false;
    }

    public static function password_verify(string $user_id, string $password) {
        $query = "SELECT password FROM `inforgenenses_crud`.`users` WHERE id='{$user_id}'";

        $conn = new Database();
        $result = $conn->prepare($query);
        $result->execute();

        if($result and $result->rowCount() !== 0) {
            $user = $result->fetch(\PDO::FETCH_ASSOC);

            return password_verify($password, $user['password']);
        }

        return false;
    }
}