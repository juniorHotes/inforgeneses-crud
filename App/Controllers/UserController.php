<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Libs\FormValidation;
use App\Controllers\LoginController;

class UserController extends Controller {

    public function render_create(array $params) {
        return $this->view('user-create');
    }

    public function render_edit(array $params) {

        if(
            (!LoginController::is_logged())
            || (!isset($_GET['user']) || empty($_GET['user']))
            || (LoginController::current_user_id() != $_GET['user'])
        ) {
            header('location: /login');
        }

        $user_model = new UserModel();
        $user = $user_model->get_user_by('id', $_GET['user']);
        return $this->view('user-edit', [ 'user' => json_encode($user) ]);
    }

    public function create(array $params) {

        $success = true;
        $fields = [];

        $params['name'] = htmlspecialchars($params['name']);
        $params['email'] = htmlspecialchars($params['email']);

        foreach ($params as $key => $value) {
            if(empty($value)) {
                $fields[$key] = [
                    'value' => $value,
                    'message' => 'Este campo não pode ser limpo.'
                ];
            }
        }

        if(count($fields) > 0) {
            $success = false;

            return $this->view('user-create',
            [ 
                'data' => json_encode([
                    'params' => $params,
                    'message' => 'Campos não preenchidos corretamente.',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if(!FormValidation::is_email($params['email'])) {
            $success = false;

            $fields['email'] = [
                'value' => $params['email'],
                'message' => 'Este e-mail não corresponde à um e-mail válido.'
            ];

            return $this->view('user-create',
            [ 
                'data' => json_encode([
                    'params' => $params,
                    'message' => 'E-mail inválido',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if(!FormValidation::check_password($params['password'])) {
            $success = false;

            $fields['password'] = [
                'value' => $params['password'],
                'message' => 'Sua senha não atende aos critérios solicitados abaixo.'
            ];

            return $this->view('user-create', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Houve um erro com a sua senha',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if(FormValidation::user_exists($params['name'])) {
            $success = false;

            $fields['name'] = [
                'value' => $params['name'],
                'message' => 'Este usuário já existe.'
            ];

            return $this->view('user-create',
            [ 
                'data' => json_encode([
                    'params' => $params,
                    'message' => 'O nome de usuário já existe.',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if(FormValidation::email_exists($params['email'])) {
            $success = false;

            $fields['email'] = [
                'value' => $params['email'],
                'message' => 'Este e-mail já está cadastrado.'
            ];

            return $this->view('user-create',
            [ 
                'data' => json_encode([
                    'params' => $params,
                    'message' => 'Insira um outro e-mail',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if($params['password'] !== $params['compare_pass'] ) {
            $success = false;

            $fields['compare_pass'] = [
                'value' => $params['compare_pass'],
                'message' => 'As senhas não conferem.'
            ];

            return $this->view('user-create', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Verifique se as senhas são iguais',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if($success) {
            $user_model = new UserModel();
            
            if($user_model->insert($params)) {
                header('location: /login');
            } else {
                return $this->view('user-create', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Houve um erro ao tentar cadastrar seu usuário.',
                        'success' => $success
                    ])
                ]);
            }
        }
    }

    public function edit(array $params) {

        if(!LoginController::is_logged()) {
            header('location: /login');
        }

        if(!isset($_GET['user']) || empty($_GET['user'])) {
            header('location: /');
        }

        if(isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'change_pass':
                    $this->change_pass($params);
                    break;  
                default:
                    $this->edit_user($params);
                    break;
            }
        } else {
            $uri = $_SERVER['REQUEST_URI'];
            header('location: ' . $uri);
        }
    }

    private function edit_user(array $params) {
        $success = true;
        $fields = [];

        $params['name'] = htmlspecialchars($params['name']);
        $params['email'] = htmlspecialchars($params['email']);

        $user_model = new UserModel();
        $user = $user_model->get_user_by('id', $_GET['user']);

        foreach ($params as $key => $value) {
            if(empty($value)) {
                $fields[$key] = [
                    'value' => $value,
                    'message' => 'Este campo não pode ser limpo.'
                ];
            }
        }

        if(count($fields) > 0) {
            $success = false;

            return $this->view('user-edit',
            [ 
                'user' => json_encode($user),
                'data' => json_encode([
                    'params' => $params,
                    'message' => '',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if($params['name'] !== $user['name'] ) {
            if(FormValidation::user_exists($params['name'])) {
                $success = false;
    
                $fields['name'] = [
                    'value' => $params['name'],
                    'message' => 'Este usuário já existe.'
                ];
    
                return $this->view('user-edit',
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
            }            
        }

        if($params['email'] !== $user['email'] ) {
            if(FormValidation::email_exists($params['email'])) {
                $success = false;
    
                $fields['email'] = [
                    'value' => $params['email'],
                    'message' => 'Este e-mail já está cadastrado.'
                ];
    
                return $this->view('user-edit',
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
            }
        }
        
        if(!FormValidation::is_email($params['email'])) {
            $success = false;

            $fields['email'] = [
                'value' => $params['email'],
                'message' => 'Este e-mail não corresponde à um e-mail válido.'
            ];

            return $this->view('user-edit',
            [ 
                'user' => json_encode($user),
                'data' => json_encode([
                    'params' => $params,
                    'message' => '',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if($success) {   
            $params['id'] = LoginController::current_user_id();     
            if($user_model->update($params)) {
                $uri = $_SERVER['REQUEST_URI'];
                header('location: ' . $uri);
            } else {
                return $this->view('user-edit', 
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Houve um erro ao tentar editar seu usuário.',
                        'success' => $success
                    ])
                ]);
            }
        }
    }

    private function change_pass(array $params) {

        $success = true;
        $fields = [];

        $user_model = new UserModel();
        $user = $user_model->get_user_by('id', $_GET['user']);

        $params['name'] = $user['name'];
        $params['email'] = $user['email'];

        foreach ($params as $key => $value) {
            if(empty($value)) {
                $fields[$key] = [
                    'value' => $value,
                    'message' => 'Este campo não pode está em branco.'
                ];
            }
        }

        if(count($fields) > 0) {
            $success = false;

            return $this->view('user-edit',
            [ 
                'user' => json_encode($user),
                'data' => json_encode([
                    'params' => $params,
                    'message' => 'Campos não preenchidos corretamente.',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if(!FormValidation::password_verify($_GET['user'], $params['current_pass'])) {
            $success = false;
    
            $fields['current_pass'] = [
                'value' => $params['current_pass'],
                'message' => 'Sua senha atual está incorreta.'
            ];

            return $this->view('user-edit',
            [ 
                'user' => json_encode($user),
                'data' => json_encode([
                    'params' => $params,
                    'message' => '',
                    'fields' => $fields,
                    'success' => $success
                ])
            ]);
        }

        if(!FormValidation::check_password($params['password'])) {
            $success = false;

            $fields['password'] = [
                'value' => $params['password'],
                'message' => 'Sua senha não atende aos critérios solicitados abaixo.'
            ];

            return $this->view('user-edit', 
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if($params['password'] !== $params['conf_pass'] ) {
            $success = false;

            $fields['conf_pass'] = [
                'value' => $params['conf_pass'],
                'message' => 'As senhas não conferem.'
            ];

            return $this->view('user-edit', 
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if($success) {  
            $params['id'] = LoginController::current_user_id();

            if($user_model->update_pass($params)) {
                $uri = $_SERVER['REQUEST_URI'];
                header('location: ' . $uri);
            } else {
                return $this->view('user-edit', 
                [ 
                    'user' => json_encode($user),
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Houve um erro ao tentar editar sua senha.',
                        'success' => $success
                    ])
                ]);
            }
        }
    }

    public function delete(array $params) {

        if(!LoginController::is_logged()) {
            header('location: /login');
        }

        $params['user_id'] = LoginController::current_user_id();
        
        $user_model = new UserModel();
        if($user_model->delete($params)) {
            $login_controller = new LoginController();
            $login_controller->logout();
        }
    }
}