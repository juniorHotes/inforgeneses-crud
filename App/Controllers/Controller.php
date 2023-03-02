<?php
namespace App\Controllers;

use League\Plates\Engine;

abstract class Controller {

    /**
     * Carrecamento de Views
     * @param string $view Nome da view
     * @param array $params Parâmetros de requisição POST e GET
     */
    public function view(string $view, array $params = []) {

        $viewsPath = dirname(__FILE__, 2) . "/Views";

        if(!file_exists($viewsPath . DIRECTORY_SEPARATOR . $view . '.php')) {
            throw new \Exception("A view {$view} não existe");
        }

        $templates = new Engine($viewsPath);
        echo $templates->render($view, $params);
    }
}