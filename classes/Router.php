<?php
namespace Classes;
use \Controller\Frontend;
use \Controller\Backend;

class Router {
    private $request;
    private $routes = [
        // frontend:
        '' => ['controller'=>'Frontend', 'method'=>'listPostsExcerpt'],
        'home' => ['controller'=>'Frontend', 'method'=>'listPostsExcerpt'],
        'allPostsView' => ['controller'=>'Frontend', 'method'=>'listPosts'],
        'about' => ['controller'=>'Frontend', 'method'=>'aboutView'],
        'contact' => ['controller'=>'Frontend', 'method'=>'contactView'],
        'adminConnexion' => ['controller'=>'Frontend', 'method'=>'adminView'],
        'listPosts' => ['controller'=>'Frontend', 'method'=>'listPosts'],
        'post' => ['controller'=>'Frontend', 'method'=>'post'],
        'addComment' => ['controller'=>'Frontend', 'method'=>'addComment'],
        'reportComment' => ['controller'=>'Frontend', 'method'=>'reportComment'],
        'sendMail' => ['controller'=>'Frontend', 'method'=>'sendMail'],
        'cookies' => ['controller'=>'Frontend', 'method'=>'cookies'],
        'legalesMentions' => ['controller'=>'Frontend', 'method'=>'legalesMentions'],
        // backend:
        'adminInterfaceLogin' => ['controller'=>'Backend', 'method'=>'loginControl'],
        'adminHomeView' => ['controller'=>'Backend', 'method'=>'adminHomeView'],
        'postsManager' => ['controller'=>'Backend', 'method'=>'postsManager'],
        'newPost' => ['controller'=>'Backend', 'method'=>'newPostView'],
        'publishPost' => ['controller'=>'Backend', 'method'=>'publishPost'],
        'viewOrChangePost' => ['controller'=>'Backend', 'method'=>'viewOrChangePost'],
        'updatePost' => ['controller'=>'Backend', 'method'=>'updatePost'],
        'deletePost' => ['controller'=>'Backend', 'method'=>'deletePost'],
        'commentsModeration' => ['controller'=>'Backend', 'method'=>'commentsModeration'],
        'commentsByDate' => ['controller'=>'Backend', 'method'=>'commentsByDate'],
        'commentsByPost' => ['controller'=>'Backend', 'method'=>'commentsByPost'],
        'moderateComment' => ['controller'=>'Backend', 'method'=>'commentModeration'],
        'editComment' => ['controller'=>'Backend', 'method'=>'adminUpdateComment'],
        'deleteComment' => ['controller'=>'Backend', 'method'=>'deleteComment'],
        'logOut' => ['controller'=>'Backend', 'method'=>'logOut'],
    ];
    public function __construct($request) {
        $this->request = $request;
    }
    public function renderController(){
        $request = $this->request;
        try {
            if(key_exists($request, $this->routes)) {
                $controller = $this->routes[$request]['controller'];
                $method = $this->routes[$request]['method'];
                if ($controller == 'Frontend'){
                    $currentController = new Frontend();
                } else{
                    $currentController = new Backend();
                }
                $currentController->$method();
            } else {
                throw new Exception('Erreur 404: la page demandée n\'existe pas');
            }
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}