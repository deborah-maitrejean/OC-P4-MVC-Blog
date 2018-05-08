<?php

namespace Services;

use \Controller\Frontend;
use \Controller\Backend;

/**
 * Class Router
 * @package Services
 */
class Router
{
    private $action;
    private $routes = array(
        // frontend:
        '' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        'home' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        'allPostsView' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts'
        ),
        'about' => array(
            'controller' => 'Frontend',
            'method' => 'aboutView'
        ),
        'contact' => array(
            'controller' => 'Frontend',
            'method' => 'contactView'
        ),
        'adminConnexion' => array(
            'controller' => 'Frontend',
            'method' => 'adminView'
        ),
        'listPosts' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts'
        ),
        'post' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments'
        ),
        'addComment' => array(
            'controller' => 'Frontend',
            'method' => 'addComment'
        ),
        'reportComment' => array(
            'controller' => 'Frontend',
            'method' => 'reportComment'
        ),
        'sendMail' => array(
            'controller' => 'Frontend',
            'method' => 'sendMail'
        ),
        'cookies' => array(
            'controller' => 'Frontend',
            'method' => 'cookies'
        ),
        'legalesMentions' => array(
            'controller' => 'Frontend',
            'method' => 'legalesMentions'
        ),
        '404' => array(
            'controller' => 'Frontend',
            'method' => 'page404'
        ),
        // backend:
        'adminInterfaceLogin' => array(
            'controller' => 'Backend',
            'method' => 'loginControl'
        ),
        'adminHomeView' => array(
            'controller' => 'Backend',
            'method' => 'adminHomeView'
        ),
        'postsManager' => array(
            'controller' => 'Backend',
            'method' => 'postsManager'
        ),
        'newPost' => array(
            'controller' => 'Backend',
            'method' => 'newPostView'
        ),
        'publishPost' => array(
            'controller' => 'Backend',
            'method' => 'publishPost'
        ),
        'viewOrChangePost' => array(
            'controller' => 'Backend',
            'method' => 'viewOrChangePost'
        ),
        'updatePost' => array(
            'controller' => 'Backend',
            'method' => 'updatePost'
        ),
        'deletePost' => array(
            'controller' => 'Backend',
            'method' => 'deletePost'
        ),
        'commentsModeration' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration'
        ),
        'moderateComment' => array(
            'controller' => 'Backend',
            'method' => 'commentModeration'
        ),
        'editComment' => array(
            'controller' => 'Backend',
            'method' => 'adminUpdateComment'
        ),
        'deleteComment' => array(
            'controller' => 'Backend',
            'method' => 'deleteComment'
        ),
        'logOut' => array(
            'controller' => 'Backend',
            'method' => 'logOut'
        ),
        'settings' => array(
            'controller' => 'Backend',
            'method' => 'settings'
        ),
        'changePassword' => array(
            'controller' => 'Backend',
            'method' => 'changePassword'
        ),
        'changeLogin' => array(
            'controller' => 'Backend',
            'method' => 'changeLogin'
        )
    );

    public function __construct($uri)
    {
        // explode uri
        $uriParts = explode('?', $uri);
        $par = explode('&', $uri);
        //$path = $uriParts[0];
        //$pathParts = explode("/", $path);

        // get param
        if (isset($uriParts[1]) && $uriParts[1] != "" && isset($par[1]) && $par[1] != null) {
            $this->param = $par[1];
            // get action name
            $actionName = preg_split("/&/", " $uriParts[1]");
            $truc = preg_split("/=/", " $actionName[0]");
            $this->action = $truc[1];
        } elseif (isset($uriParts[1]) && $uriParts[1] != ""){
            // get action name
            $actionName = explode("=", $uriParts[1]);
            $this->action = $actionName[1];
        }
    }

    public function renderController()
    {
        try {
            if (key_exists($this->action, $this->routes)) {
                $controller = $this->routes[$this->action]['controller'];
                $method = $this->routes[$this->action]['method'];
                if ($controller == 'Frontend') {
                    $currentController = new Frontend();
                } else {
                    $currentController = new Backend();
                }
                $currentController->$method();
            } else {
                header('HTTP/1.0 404 Not Found');
                include_once("../view/frontend/404.php");
                exit();
            }
        } catch (Exception $e) {
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }
}