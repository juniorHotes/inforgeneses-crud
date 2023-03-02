<?php
namespace App\Controllers;

class LoginController extends Controller {

    public function index(array $params) {
        return $this->view('login');
    }

    public function login(array $params) {

        var_dump($params);

        // header('location: /');
    }
}