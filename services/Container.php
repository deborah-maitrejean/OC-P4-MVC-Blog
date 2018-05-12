<?php

namespace Services;
use \Config\Routes;
use \Controller\Frontend;
use \Controller\Login;
use \Controller\Backend;
use \Controller\Contact;

class Container
{
    /**
     * @param $controller
     * @return Backend|Contact|Frontend|Login
     */
    public function getController($controller)
    {
        $this->controller = $controller;

        switch ($controller) {
            case 'Frontend':
                $controller = new Frontend();
                break;
            case 'Login':
                $controller = new Login();
                break;
            case 'Backend':
                $controller = new Backend();
                break;
            case 'Contact':
                $controller = new Contact();
                break;
        }

        return $controller;
    }

    /**
     * @param $routes
     * @return mixed
     */
    public function getRoutes($routes)
    {
        $this->routes = $routes;
        return $routes;
    }
}