<?php
/*
 * Class Router
 * create routes and find controller
 */

// ces fichiers appellent le bon controlleur
include_once('controller/Frontend.php');
include_once('controller/Backend.php');

class Router {
    private $request;
    private $routes = [ // tableau qui récupère toutes les routes, il fait un lien entre ce qu'on demande, et un autre tbealu qui intègre le controller
        // frontend:
        '' => ['controller'=>'Frontend', 'method'=>'listPostsExcerpt'], // appelle le Frontend controller
        'allPostsView' => ['controller'=>'Frontend', 'method'=>'listPosts'],
        'about' => ['controller'=>'Frontend', 'method'=>'aboutView'],
        'contact' => ['controller'=>'Frontend', 'method'=>'contactView'],
        'adminConnexion' => ['controller'=>'Frontend', 'method'=>'adminView'],
        'listPosts' => ['controller'=>'Frontend', 'method'=>'listPosts'],
        'post' => ['controller'=>'Frontend', 'method'=>'post'],
        'addComment' => ['controller'=>'Frontend', 'method'=>'addComment'],
        'reportComment' => ['controller'=>'Frontend', 'method'=>'reportComment'],
        // backend:
        'adminInterfaceLogin' => ['controller'=>'Backend', 'method'=>'loginControl'],
        'adminHomeView' => ['controller'=>'Backend', 'method'=>'adminHomeView'],
        'postsManager' => ['controller'=>'Backend', 'method'=>'postsManager'],
        'newPost' => ['controller'=>'Backend', 'method'=>'newPostView'],
        'publishPost' => ['controller'=>'Backend', 'method'=>'publishPost'],
        'viewOrChangePost' => ['controller'=>'Backend', 'method'=>'viewOrChangePost'],
        'updatePost' => ['controller'=>'Backend', 'method'=>'updatePost'],
        'commentsModeration' => ['controller'=>'Backend', 'method'=>'commentsModeration'],
        'moderateComment' => ['controller'=>'Backend', 'method'=>'commentModeration'],
        'editComment' => ['controller'=>'Backend', 'method'=>'adminUpdateComment'],
        'deleteComment' => ['controller'=>'Backend', 'method'=>'deleteComment'],
        'logOut' => ['controller'=>'Backend', 'method'=>'logOut'],
    ];
    public function __construct($request) {
        $this->request = $request;
    }
    public function renderController(){ // a chaque fois qu'il va trouver une classe
        $request = $this->request;
        try {
            if(key_exists($request, $this->routes)) {
                $controller = $this->routes[$request]['controller'];
                $method = $this->routes[$request]['method'];

                $currentController = new $controller();
                $currentController->$method();
            } else {
                throw new Exception('Erreur 404: la page demandée n\'existe pas');
            }
        } catch(Exception $e) {
            $messageError = new Frontend();
            $message = $messageError->error($e);
        }
    }
}