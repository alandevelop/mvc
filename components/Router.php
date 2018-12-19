<?php

class Router
{
    private $routes;
    private $uri;

    public function __construct()
    {
        $this->routes = require_once ROOT . '/config/routes.php';
        $this->uri = trim($_SERVER['REQUEST_URI'], '/');

    }

    public function run()
    {
        foreach ($this->routes as $pattern => $path) {
            if (preg_match("~$pattern~", $this->uri)) {

                $path = preg_replace("~$pattern~", $path, $this->uri);
                $sections = explode('/', $path);

                $controllerName = ucfirst(array_shift($sections)) . 'Controller';
                $actionName = 'action' . ucfirst(array_shift($sections));
                $controllerFile = ROOT . "/controllers/$controllerName.php";

                $param = null;
                if (!empty($sections)) {
                    $param = $sections[0];
                };

                if (is_file($controllerFile)) {

                    try {
                        $controller = new $controllerName;
                        $controller->$actionName($param);
                        break;
                    } catch (Exception $e) {
                        break;
                    }
                } else {
                    die('Страница не найдена');
                }
            }
        }
    }
}