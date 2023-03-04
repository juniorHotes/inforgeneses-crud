<?php
namespace App\Libs;

use App\Models\UserModel;

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

        $user_model = new UserModel();
        $user = $user_model->get_user_by('name', $name);

        if(!empty($user) and count($user)) {
            return true;
        }

        return false;
    }

    public static function email_exists(string $email) {

        $user_model = new UserModel();
        $user = $user_model->get_user_by('email', $email);

        if(!empty($user) and count($user)) {
            return true;
        }

        return false;
    }

    public static function password_verify(string $user_id, string $password) {

        $user_model = new UserModel();
        $user = $user_model->get_user_by('id', $user_id);

        if(!empty($user) and count($user)) {
            return password_verify($password, $user['password']);
        }

        return false;
    }
}