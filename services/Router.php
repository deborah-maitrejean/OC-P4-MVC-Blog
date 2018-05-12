<?php

namespace Services;
use \Config\Routes;

/**
 * Class Router
 * @package Services
 */
class Router
{
    private $uri;
    private $controller;
    private $method;
    private $params;
    private $routes = array();

    /**
     * Router constructor.
     * @param $uri
     */

    public function __construct($uri)
    {
        $this->uri = substr($uri, strpos($uri, "=") + 1);
    }

    public function allRoutes()
    {
        $container = new Container();
        $this->routes = $container->getRoutes(Routes::$routes);
        return $this->routes;
    }

    /**
     * @return array
     */
    public function resolve()
    {
        if (false === array_key_exists('action', $_GET)){
            header('Location: index.php?action=home');
            exit();
        } else {
            $controller = null;
            foreach ($this->routes as $pattern => $controllerMethod) {
                if (preg_match($pattern, $this->uri, $matches)) {
                    $controller = $this->routes[$pattern]['controller'];
                    $method = $this->routes[$pattern]['method'];
                    $this->params = [];
                    foreach ($matches as $key => $value) {
                        if ($key > 0) {
                            $this->params[] = $value;
                        }
                    }
                }
            }
            if (!is_null($controller)) {
                $this->controller = $controller;
                $this->method = $method;
                return [
                    'controller' => $this->controller,
                    'method' => $this->method,
                    'params' => $this->params,
                ];
            } else {
                header('HTTP/1.0 404 Not Found');
                include_once("../view/frontend/404.php");
                exit();
            }
        }
    }
}