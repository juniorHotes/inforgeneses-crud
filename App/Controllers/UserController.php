<?php
namespace App\Controllers;

class UserController extends Controller {

    public function render_create(array $params) {
        return $this->view('user-create');
    }

    public function render_edit(array $params) {
        return $this->view('user-edit');
    }

    public function create(array $params) {
        var_dump($params);
    }

    public function edit(array $params) {
        var_dump($params);
    }

    public function delete(array $params) {
        var_dump($params);
    }
}