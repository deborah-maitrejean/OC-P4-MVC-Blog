<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class Frontend{
    public function listPosts() {
        $postManager = new Blog\Model\PostManager(); // création d'un objet
        $posts = $postManager->getPosts(); // appel d'une fonction sur cet objet

        require('view/frontend/allPostsView.php');
    }
    public function listPostsExcerpt() {
        $postManager = new Blog\Model\PostManager();
        $posts = $postManager->getPostsExcerpt();

        require('view/frontend/listPostsView.php');
    }
    public function post() {
        $postManager = new Blog\Model\PostManager();
        $commentManager = new Blog\Model\CommentManager();

        $post = $postManager->getPost($_GET['id']); // appel  d'une fonction sur l'objet PostManager
        $comments = $commentManager->getComments($_GET['id']); // appel  d'une fonction sur l'objet CommentManager

        require('view/frontend/postView.php');
    }
    function addComment($postId, $postTitle, $author, $comment) {
        $commentManager = new Blog\Model\CommentManager();
        $affectedLines = $commentManager->postComment($postId, $postTitle, $author, $comment);

        if ($affectedLines === false) {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    public function commentView(){
        $postManager = new Blog\Model\PostManager();
        $commentManager = new Blog\Model\CommentManager();

        $post = $postManager->getPost($_GET['postId']);
        $comment = $commentManager->getComment($_GET['commentId']);

        require('view/frontend/commentEdit.php');
    }
    public function editComment($postId, $comment, $commentId) {
        $commentManager = new Blog\Model\CommentManager();
        $newComment = $commentManager->updateComment($comment, $commentId);

        if ($newComment === false) {
            throw new Exception('Impossible de modifier le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }
    public function reportComment($commentId, $postId){
        $commentManager = new Blog\Model\CommentManager();
        $reportComment = $commentManager->reportComment($commentId);
        header('Location: index.php?action=post&id=' . $postId);
    }
    public function adminView(){
        require('view/frontend/adminConnexionView.php');
    }
    public function aboutView(){
        require('view/frontend/aboutView.php');
    }
    public function contactView(){
        require('view/frontend/contactView.php');
    }
}