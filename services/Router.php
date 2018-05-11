<?php

namespace Services;

use \Controller\Frontend;
use \Controller\Backend;
use \Controller\Contact;
use \Controller\Login;

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
    //private $action;
    private $routes = array(
        // frontend:
        '#^$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        '#^home$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPostsExcerpt'
        ),
        '#^allPostsView$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts',
        ),
        '#^allPostsView&page=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts',
        ),
        '#^about$#' => array(
            'controller' => 'Frontend',
            'method' => 'aboutView'
        ),
        '#^contact$#' => array(
            'controller' => 'Frontend',
            'method' => 'contactView'
        ),
        '#^adminConnexion$#' => array(
            'controller' => 'Frontend',
            'method' => 'adminView'
        ),
        '#^listPosts$#' => array(
            'controller' => 'Frontend',
            'method' => 'listPosts'
        ),
        '#^post$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^post&id=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^post&id=([0-9]+)&page=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'postNcomments',
        ),
        '#^addComment&id=([0-9]+)&postTitle=([a-zA-Z0-9-_%éèâàôûï]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'addComment',
        ),
        '#^reportComment&commentId=([0-9]+)&reported=1&postId=([0-9]+)$#' => array(
            'controller' => 'Frontend',
            'method' => 'reportComment',
        ),
        '#^cookies$#' => array(
            'controller' => 'Frontend',
            'method' => 'cookies'
        ),
        '#^legalesMentions$#' => array(
            'controller' => 'Frontend',
            'method' => 'legalesMentions'
        ),
        '#^404$#' => array(
            'controller' => 'Frontend',
            'method' => 'page404'
        ),
        // contact:
        '#^sendMail$#' => array(
            'controller' => 'Contact',
            'method' => 'sendMail'
        ),
        // login:
        '#^adminInterfaceLogin$#' => array(
            'controller' => 'Login',
            'method' => 'loginControl'
        ),
        '#^logOut$#' => array(
            'controller' => 'Login',
            'method' => 'logOut'
        ),
        '#^changePassword$#' => array(
            'controller' => 'Login',
            'method' => 'changePassword'
        ),
        '#^changeLogin$#' => array(
            'controller' => 'Login',
            'method' => 'changeLogin'
        ),
        // backend:
        '#^adminHomeView$#' => array(
            'controller' => 'Backend',
            'method' => 'adminHomeView'
        ),
        '#^postsManager$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^postsManager&page=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^postsManager&orderBy=date$#' => array(
            'controller' => 'Backend',
            'method' => 'postsManager',
        ),
        '#^newPost$#' => array(
            'controller' => 'Backend',
            'method' => 'newPostView'
        ),
        '#^publishPost$#' => array(
            'controller' => 'Backend',
            'method' => 'publishPost'
        ),
        '#^viewOrChangePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'viewOrChangePost',
        ),
        '#^updatePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'updatePost',
        ),
        '#^deletePost&postId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'deletePost',
        ),
        '#^commentsModeration$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^commentsModeration&orderBy=(date|posts)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^commentsModeration&page=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentsModeration',
        ),
        '#^moderateComment&commentId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'commentModeration',
        ),
        '#^editComment&commentId=([0-9]+)&reported=0$#' => array(
            'controller' => 'Backend',
            'method' => 'adminUpdateComment',
        ),
        '#^deleteComment&commentId=([0-9]+)$#' => array(
            'controller' => 'Backend',
            'method' => 'deleteComment',
        ),
        '#^settings$#' => array(
            'controller' => 'Backend',
            'method' => 'settings'
        )
    );

    /**
     * Router constructor.
     * @param $uri
     */

    public function __construct($uri)
    {
        $this->uri = substr($uri, strpos($uri, "=") + 1);
        /*
        // explode uri
        $uriParts = explode('?', $uri);
        $par = explode('&', $uri);
        $path = $uriParts[0];
        $pathParts = explode("/", $path);

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
            $actionPath = preg_split("/=/", "$uriParts[1]");

            if (isset($actionName[1])) {
                $this->action = $actionName[1];
            } else {
                header('HTTP/1.0 404 Not Found');
                include_once("../view/frontend/404.php");
                exit();
            }

            if ($actionPath[0] != 'action') {
                header('HTTP/1.0 404 Not Found');
                include_once("../view/frontend/404.php");
                exit();
            }
        } else{
            header('Location: index.php?action=home');
            exit();
        }

        if ($pathParts[2] != 'index.php') {
            header('Location: index.php?action=home');
            exit();
        }
        */
    }

    /**
     * @return array
     */
    public function resolve()
    {
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
/*
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
                } elseif ($controller == 'Backend') {
                    $currentController = new Backend();
                } elseif ($controller == 'Login') {
                    $currentController = new Login();
                } else {
                    $currentController = new Contact();
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
    }*/
}