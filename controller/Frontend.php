<?php
namespace Controller;
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LoginManager.php');

class Frontend{
    public function listPosts() {
        $postManager = new PostManager(); // création d'un objet
        $posts = $postManager->getPosts(); // appel d'une fonction sur cet objet

        require('view/frontend/allPostsView.php');
    }
    public function listPostsExcerpt() {
        $postManager = new PostManager();
        $posts = $postManager->getPostsExcerpt();

        require('view/frontend/listPostsView.php');
    }
    public function post() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']); // appel  d'une fonction sur l'objet PostManager
        $comments = $commentManager->getComments($_GET['id']); // appel  d'une fonction sur l'objet CommentManager

        require('view/frontend/postView.php');
    }
    function addComment() {
        if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['postTitle']) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $commentManager = new CommentManager();
                $affectedLines = $commentManager->postComment($_GET['id'], $_GET['postTitle'], $_POST['author'], $_POST['comment']);

                if ($affectedLines === false) {
                    // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur
                    throw new Exception('Impossible d\'ajouter le commentaire !');
                } else {
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé !');
        }
    }
    public function reportComment(){
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0 && $_GET['postId']) {
            if(isset($_GET['reported'])){
                $commentManager = new CommentManager();
                $commentManager->reportComment($_GET['reported'], $_GET['commentId'], $_GET['postId']);
                header('Location: index.php?action=post&id=' . $_GET['postId']);
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé !');
            }
        }
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