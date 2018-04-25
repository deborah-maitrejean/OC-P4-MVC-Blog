<?php
/*
 * Class Router
 * create routes and find controller
 */

include_once('controller/Frontend.php');
include_once('controller/Backend.php');

class Router {
    private $request;
    private $routes = [ // tableau qui récupère toutes les routes, il fait un lien entre ce qu'on demande, et un autre tbealu qui intègre le controller
        '' => ['controller'=>'Frontend', 'method'=>'listPostsExcerpt'],
        'allPostsView' => ['controller'=>'Frontend', 'method'=>'listPosts'], // appelle un controller qui s'appelle Backend
        'about' => ['controller'=>'Frontend', 'method'=>'aboutView'],
        'contact' => ['controller'=>'Frontend', 'method'=>'contactView'],
        'adminConnexion' => ['controller'=>'Frontend', 'method'=>'adminView'],
        'addComment' => ['controller'=>'Frontend', 'method'=>'addComment'],
        'reportComment' => ['controller'=>'Frontend', 'method'=>'reportComment']
        //editComment
    ];
}