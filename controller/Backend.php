<?php
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

class Backend{
    public function loginControl(){
        $loginManager = new Blog\Model\LoginManager();
        if (isset($_POST['adminId']) && isset($_POST['password']))
        $login = $loginManager->getLogin($_POST['adminId'], $_POST['password']);

        header('location: index.php?action=adminHomeView');
    }
    public function adminHomeView(){
        require('view/backend/adminHomeView.php');
    }
    public function newPostView(){
        require('view/backend/newPostView.php');
    }
    public function commentsModeration(){
        $commentManager = new Blog\Model\CommentManager();
        $comments = $commentManager->getAllComments();

        require('view/backend/commentsModeration.php');
    }
    public function commentModeration(){
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            $commentManager = new Blog\Model\CommentManager();
            $comment = $commentManager->getComment($_GET['commentId']);
            require('view/backend/commentModeration.php');
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé !');
        }
    }
    public function adminUpdateComment(){
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            if (!empty($_POST['comment'])){
                if (isset($_GET['reported'])){
                    $commentManager = new Blog\Model\CommentManager();
                    $commentManager->changeComment($_POST['comment'], $_GET['commentId'], $_GET['reported']);

                    header('location: index.php?action=commentsModeration');
                }
            } else{
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }
    }
    public function deleteComment(){
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            $commentManager = new Blog\Model\CommentManager();
            $deletedComment = $commentManager->deleteComment($_GET['commentId']);

            header('location: index.php?action=commentsModeration');
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé !');
        }
    }
    public function postsManager(){
        $postsManager = new Blog\Model\PostManager();
        $posts = $postsManager->getAllPostsExcerpt();

        require('view/backend/postsManager.php');
    }
    public function publishPost($title, $content, $author){
        $postManager = new Blog\Model\PostManager();
        $newPost = $postManager->publishNewPost($title, $content, $author);

        header('location: index.php?action=postsManager');
    }
    public function viewOrChangePost(){
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            $postManager = new Blog\Model\PostManager();
            $post = $postManager->getPost($_GET['postId']);

            require('view/backend/postView.php');
        } else{
            throw new Exception('Aucun identifiant de billet envoyé !');
        }
    }
    public function deletePost($postId){
        $postManager = new Blog\Model\PostManager();
        $post = $postManager->deletePost($postId);

        header('location: index.php?action=postsManager');
    }
    public function updatePost(){
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            if (isset($_POST['title']) && isset($_POST['content'])){
                $postManager = new Blog\Model\PostManager();
                $post = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['postId']);

                header('location: index.php?action=postsManager');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé !');
        }
    }
}