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
            'method' => 'postNcomments',
            'param' => 'id'
        ),
        'addComment' => array(
            'controller' => 'Frontend',
            'method' => 'addComment',
            'param' => 'id', 'postTitle',
        ),
        'reportComment' => array(
            'controller' => 'Frontend',
            'method' => 'reportComment',
            'param' => 'commentId','postId'
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
            'method' => 'viewOrChangePost',
            'param' => 'postId'
        ),
        'updatePost' => array(
            'controller' => 'Backend',
            'method' => 'updatePost',
            'param' => 'postId'
        ),
        'deletePost' => array(
            'controller' => 'Backend',
            'method' => 'deletePost',
            'param' => 'postId'
        ),
        'commentsModeration' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration'
        ),
        'moderateComment' => array(
            'controller' => 'Backend',
            'method' => 'commentModeration',
            'param' => 'commentId'
        ),
        'editComment' => array(
            'controller' => 'Backend',
            'method' => 'adminUpdateComment',
            'param' => 'commentId', 'reported'
        ),
        'deleteComment' => array(
            'controller' => 'Backend',
            'method' => 'deleteComment',
            'param' => 'commentId'
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

    /**
     * Router constructor.
     * @param $uri
     */
    public function __construct($uri)
    {
        // explode uri
        $uriParts = explode('?', $uri);
        $par = explode('&', $uri);
        //$path = $uriParts[0];
        //$pathParts = explode("/", $path);

        if (isset($uriParts[1]) && $uriParts[1] != "" && isset($par[1]) && $par[1] != null) {
            // get param name
            $paramName = preg_split("/=/", "$par[1]");
            $this->param = $paramName[0];
            // get action name
            $actionNparam = preg_split("/&/", " $uriParts[1]");
            $actionName = preg_split("/=/", " $actionNparam[0]");
            $this->action = $actionName[1];
        } elseif (isset($uriParts[1]) && $uriParts[1] != "") {
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
                if (isset($this->param) && $this->param != null){
                    if ($this->param == $this->routes[$this->action]['param']){
                        $parameter = $this->routes[$this->action]['param'];
                    } else {
                        header('HTTP/1.0 404 Not Found');
                        include_once("../view/frontend/404.php");
                        exit();
                    }
                }
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