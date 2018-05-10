<?php

namespace Services;


class Container
{
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
}