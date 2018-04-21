<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
//require_once('model/LoginManager.php');

function loginControl($email, $password){
    $loginManager = new Blog\Model\LoginManager();
    $login = $loginManager->getLogin($email, $password);

    header('location: index.php?action=adminHomeView');
}
function adminHomeView(){
    require('view/backend/adminHomeView.php');
}
function commentsModeration(){
    $commentManager = new Blog\Model\CommentManager();
    $comments = $commentManager->getAllComments();

    require('view/backend/commentsModeration.php');
}