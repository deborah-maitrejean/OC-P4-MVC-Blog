<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts() {
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // création d'un objet
    $posts = $postManager->getPosts(); // appel d'une fonction sur cet objet

    require('view/frontend/listPostsView.php');
}

function post() {
    $postManager = new \OpenClassrooms\Blog\Model\PostManager(); // création d'un objet
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager(); // création d'un objet

    $post = $postManager->getPost($_GET['id']); // appel  d'une fonction sur l'objet PostManager
    $comments = $commentManager->getComments($_GET['id']); // appel  d'une fonction sur l'objet CommentManager

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment) {
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function commentView(){
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['postId']);
    $comment = $commentManager->getComment($_GET['commentId']);

    require('view/frontend/commentEdit.php');
}
function editComment($postId, $comment, $commentId) {
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();
    $newComment = $commentManager->updateComment($comment, $commentId);

    if ($newComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function adminView(){
    require('view/frontend/adminConnexionView.php');
}
function aboutView(){
    require('view/frontend/aboutView.php');
}