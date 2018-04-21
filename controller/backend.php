<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

function loginControl($mail, $password){
    $loginManager = new Blog\Model\LoginManager();
    $login = $loginManager->getLogin($mail, $password);

    header('location: index.php?action=adminView');
}
function adminView(){
    require('view/backend/adminView.php');
}