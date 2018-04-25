<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

class Backend{
    public function loginControl($email, $password){
        $loginManager = new Blog\Model\LoginManager();
        $login = $loginManager->getLogin($email, $password);

        header('location: index.php?action=adminHomeView');
    }
    public function adminHomeView(){
        require('view/backend/adminHomeView.php');
    }
    public function commentsModeration(){
        $commentManager = new Blog\Model\CommentManager();
        $comments = $commentManager->getAllComments();

        require('view/backend/commentsModeration.php');
    }
    public function commentModeration($commentId){
        $commentManager = new Blog\Model\CommentManager();
        $comment = $commentManager->getComment($commentId);

        require('view/backend/commentModeration.php');
    }
    public function postsManager(){
        $postsManager = new Blog\Model\PostManager();
        $posts = $postsManager->getAllPostsExcerpt();

        require('view/backend/postsManager.php');
    }
    public function adminUpdateComment($comment, $commentId, $reported){
        $commentManager = new Blog\Model\CommentManager();
        $changedComment = $commentManager->changeComment($comment, $commentId, $reported);

        header('location: index.php?action=commentsModeration');
    }
    public function newPostView(){
        require('view/backend/newPostView.php');
    }
    public function publishPost($title, $content, $author){
        $postManager = new Blog\Model\PostManager();
        $newPost = $postManager->publishNewPost($title, $content, $author);

        header('location: index.php?action=postsManager');
    }
    public function viewOrChangePost($postId){
        $postManager = new Blog\Model\PostManager();
        $post = $postManager->getPost($postId);

        require('view/backend/postView.php');
    }
    public function deletePost($postId)
    {
        $postManager = new Blog\Model\PostManager();
        $post = $postManager->deletePost($postId);

        header('location: index.php?action=postsManager');
    }
    public function updatePost($title, $content, $postId){
        $postManager = new Blog\Model\PostManager();
        $post = $postManager->updatePost($title, $content, $postId);

        header('location: index.php?action=postsManager');
    }
    public function deleteComment($commentId){
        $commentManager = new Blog\Model\CommentManager();
        $deletedComment = $commentManager->deleteComment($commentId);

        header('location: index.php?action=commentsModeration');
    }
}