<?php
namespace App\Controllers;

use App\Models\UserModel;

class HomeController extends Controller {

    public function index(array $params) {
       $user_model = new UserModel();

       $users = $user_model->get_all();

       return $this->view('home', [ 'users' => json_encode($users) ]);
    }
}