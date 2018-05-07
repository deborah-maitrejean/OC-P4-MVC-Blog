<?php
namespace Services;
use \Controller\Frontend;
use \Controller\Backend;

/**
 * Class Router
 * @package Services
 */
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
        'post' => ['controller'=>'Frontend', 'method'=>'postNcomments'],
        'addComment' => ['controller'=>'Frontend', 'method'=>'addComment'],
        'reportComment' => ['controller'=>'Frontend', 'method'=>'reportComment'],
        'sendMail' => ['controller'=>'Frontend', 'method'=>'sendMail'],
        'cookies' => ['controller'=>'Frontend', 'method'=>'cookies'],
        'legalesMentions' => ['controller'=>'Frontend', 'method'=>'legalesMentions'],
        '404' => ['controller'=>'Frontend', 'method'=>'page404'],
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
        'moderateComment' => ['controller'=>'Backend', 'method'=>'commentModeration'],
        'editComment' => ['controller'=>'Backend', 'method'=>'adminUpdateComment'],
        'deleteComment' => ['controller'=>'Backend', 'method'=>'deleteComment'],
        'logOut' => ['controller'=>'Backend', 'method'=>'logOut'],
        'settings' => ['controller'=>'Backend', 'method'=>'settings'],
        'changePassword' => ['controller'=>'Backend', 'method'=>'changePassword'],
        'changeLogin' => ['controller'=>'Backend', 'method'=>'changeLogin']
    ];

    /**
     * Router constructor.
     * @param $request
     */
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
                //$errorMessage = 'Erreur 404: la page demandée n\'existe pas';
                header('Location: index.php?action=404');
            }
        } catch(Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
    }
}