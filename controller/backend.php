<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

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
function commentModeration($commentId){
    $commentManager = new Blog\Model\CommentManager();
    $comment = $commentManager->getComment($commentId);

    require('view/backend/commentModeration.php');
}
function postsManager(){
    $postsManager = new Blog\Model\PostManager();
    $posts = $postsManager->getAllPostsExcerpt();

    require('view/backend/postsManager.php');
}
function adminUpdateComment($comment, $commentId, $reported){
    $commentManager = new Blog\Model\CommentManager();
    $changedComment = $commentManager->changeComment($comment, $commentId, $reported);

    header('location: index.php?action=commentsModeration');
}
function newPostView(){
    require('view/backend/newPostView.php');
}
function publishPost($title, $content, $author){
    $postManager = new Blog\Model\PostManager();
    $newPost = $postManager->publishNewPost($title, $content, $author);

    header('location: index.php?action=postsManager');
}
function viewOrChangePost($postId){
    $postManager = new Blog\Model\PostManager();
    $post = $postManager->getPost($postId);

    require('view/backend/postView.php');
}
function updatePost($title, $content, $postId){
    $postManager = new Blog\Model\PostManager();
    $post = $postManager->updatePost($title, $content, $postId);

    header('location: index.php?action=postsManager');
}