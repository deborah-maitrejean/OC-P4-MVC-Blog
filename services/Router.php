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
    private $request;
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

    /**
     * Router constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;
        try {
            if (key_exists($request, $this->routes)) {
                $controller = $this->routes[$request]['controller'];
                $method = $this->routes[$request]['method'];
                if ($controller == 'Frontend') {
                    $currentController = new Frontend();
                } else {
                    $currentController = new Backend();
                }
                $currentController->$method();
            } else {
                //$errorMessage = 'Erreur 404: la page demandée n\'existe pas';
                header('Location: index.php?action=404');
            }
        } catch (Exception $e) {
            echo 'Exception reçue : ', $e->getMessage(), "\n";
        }
    }
}