<?php

/**
 * Carregar controller
 * @param string $controller Nome da classe do controller
 * @param string $action Nome da action
 */
function loadController(string $controller, string $action) {

    try {
        $controllerNamespace = "App\\Controllers\\{$controller}";
        
        if(!class_exists($controllerNamespace)) {
            throw new Exception("O controller {$controller} não existe");
        }
    
        $controllerInstace = new $controllerNamespace();
    
        if(!method_exists($controllerInstace, $action)) {
            throw new Exception("O método {$action} não existe no controller {$controller}");
        }
    
        $controllerInstace->$action($_REQUEST);
    
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$routes = [
    'GET' => [
        '/' => fn() => loadController('HomeController', 'index'),
        '/login' => fn() => loadController('LoginController', 'index'),
        '/logout' => fn() => loadController('LoginController', 'logout'),
        '/user/create' => fn() => loadController('UserController', 'render_create'),
        '/user/edit' => fn() => loadController('UserController', 'render_edit')
    ],
    'POST' => [
        '/login' => fn() => loadController('LoginController', 'login'),
        '/user/create' => fn() => loadController('UserController', 'create'),
        '/user/edit' => fn() => loadController('UserController', 'edit'),
        '/user/delete' => fn() => loadController('UserController', 'delete')
    ]
];