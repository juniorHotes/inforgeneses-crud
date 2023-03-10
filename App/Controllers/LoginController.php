<?php
namespace App\Controllers;

use App\Libs\FormValidation;
use App\Models\UserModel;

class LoginController extends Controller {

    public function index() {

        $params = [
            'is_logged' => false,
            'user' => ''
        ];

        if(LoginController::is_logged()) {
            $user_model = new UserModel();
            $user = $user_model->get_user_by('id', LoginController::current_user_id());
            $params['is_logged'] = true; 
            $params['user'] = $user['name']; 
        }

        return $this->view('login', $params);
    }

    public function login(array $params) {

        $login = htmlspecialchars($params['login']);
        
        $get_by = 'name';

        $success = true;
        $fields = [];
        
        if(FormValidation::is_email($login)) {
            $get_by = 'email';
        }
        
        $user_model = new UserModel();
        $user = $user_model->get_user_by($get_by, $login);

        if($get_by === 'name' && !FormValidation::user_exists($login)) {
            $success = false;

            $fields['login'] = [
                'value' => $params['login'],
                'message' => 'Este usuário não está cadastrado'
            ];

            return $this->view('login', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if($get_by === 'email' && !FormValidation::email_exists($login)) {
            $success = false;

            $fields['login'] = [
                'value' => $params['login'],
                'message' => 'Este e-mail não está cadastrado.'
            ];

            return $this->view('login', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => 'Verifique se as senhas são iguais',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if(!FormValidation::password_verify($user['id'], $params['pass'])) {
            $success = false;

            $fields['pass'] = [
                'value' => $params['pass'],
                'message' => 'Sua senha está incorreta.'
            ];

            return $this->view('login', 
                [ 
                    'data' => json_encode([
                        'params' => $params,
                        'message' => '',
                        'fields' => $fields,
                        'success' => $success
                    ])
                ]);
        }

        if($success) {
                        
            session_destroy();

            session_start();
            $_SESSION['user'] = $user['id'];

            header('location: /user/edit?user=' . $user['id']);
        }
    }

    public function logout() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        session_destroy();

        header('location: /');
    }   

    /**
     * Retorna o id do usuário logado, se não está logado o redireciona para /login.
     * @return int Retorna o id do usuário logado
     */
    public static function current_user_id() {
        
        if(!isset($_SESSION['user'])) {
            header('location: /login');
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['user'];
    }

    /**
     * Verifica se o usuário está logado.
     * @return boolean true|false
     */
    public static function is_logged() {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']);
    }
}