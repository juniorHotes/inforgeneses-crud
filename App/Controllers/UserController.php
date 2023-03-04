<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Libs\FormValidation;

class UserController extends Controller {

    public function render_create(array $params) {
        return $this->view('user-create');
    }

    public function render_edit(array $params) {
        $user_model = new UserModel();
        $user = $user_model->get(isset($_GET['user']) ? $_GET['user'] : '0');
        return $this->view('user-edit', [ 'user' => json_encode($user) ]);
    }

    public function create(array $params) {

        $success = true;
        $fields = [];

        $params['user_name'] = htmlspecialchars($params['user_name']);
        $params['user_email'] = htmlspecialchars($params['user_email']);

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

        if(!FormValidation::is_email($params['user_email'])) {
            $success = false;

            $fields['user_email'] = [
                'value' => $params['user_email'],
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

        if(FormValidation::user_exists($params['user_name'])) {
            $success = false;

            $fields['user_name'] = [
                'value' => $params['user_name'],
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

        if(FormValidation::user_email_exists($params['user_email'])) {
            $success = false;

            $fields['user_email'] = [
                'value' => $params['user_email'],
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
        var_dump($params);
    }

    public function delete(array $params) {
        var_dump($params);
    }
}