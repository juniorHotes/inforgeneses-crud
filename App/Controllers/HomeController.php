<?php
namespace App\Controllers;

class HomeController extends Controller {

    public function index(array $params) {
       return $this->view('home');
    }
}