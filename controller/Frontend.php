<?php
namespace Controller;
use \Model\CommentManager;
use \Model\PostManager;

class Frontend{
    public function listPosts() {
        $postManager = new PostManager();
        $nbPosts = $postManager->countPosts();
        $perPage = 3;
        $nbPages = $postManager->countPages($nbPosts, $perPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
            $currentPage = $_GET['page'];
        } else{
            $currentPage = 1;
        }
        $posts = $postManager->getPosts($currentPage, $perPage);

        require('view/frontend/allPostsView.php');
    }
    public function listPostsExcerpt() {
        $postManager = new PostManager();
        $posts = $postManager->getPostsExcerpt();

        require('view/frontend/listPostsView.php');
    }
    public function post() {
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);

        $commentManager = new CommentManager();
        $nbComments = $commentManager->countComments($post->getId());
        if ($nbComments > 0){
            $perPage = 4;
            $nbPages = $commentManager->countPages($nbComments, $perPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
                $currentPage = $_GET['page'];
            } else{
                $currentPage = 1;
            }
            $comments = $commentManager->getComments($_GET['id'], $currentPage, $perPage);
        } else{
            $comments = false;
        }

        require('view/frontend/postView.php');
    }
    public function addComment() {
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
    public function adminView(){;
        session_start();
        if (session_status() === 2){
            if (isset($_SESSION) && isset($_SESSION['connected'])){
                header('Location: index.php?action=adminHomeView');
            } else{
                session_destroy();
                require('view/frontend/adminConnexionView.php');
            }
        }
    }
    public function aboutView(){
        require('view/frontend/aboutView.php');
    }
    public function contactView(){
        require('view/frontend/contactView.php');
    }
    public function sendMail(){
        if (isset($_POST['submit']) && isset($_POST['lastName']) && isset($_POST['firstName']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
            if (!empty($_POST['lastName']) && !empty($_POST['firstName']) && !empty($_POST['tel']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])){
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                    if(preg_match("#^0[1-9]([-. ]?[0-9]{2}){4}$#", $_POST['tel'])){
                        $contactManager = new ContactManager();
                        $contactManager->sendMail(
                            htmlspecialchars($_POST['lastName']),
                            htmlspecialchars($_POST['firstName']),
                            htmlspecialchars($_POST['tel']),
                            htmlspecialchars($_POST['email']),
                            htmlspecialchars($_POST['subject']),
                            htmlspecialchars($_POST['message'])
                        );
                        header('Location: index.php?action=contact');
                    } else{
                        Exception('Le numéro de téléphone n\'est pas au bon format.');
                    }
                } else{
                    throw new Exception('L\'adresse email n\'est pas au bon format.');
                }
            } else{
                throw new Exception('Tous les champs ne sont pas renseignés.');
            }
        }
    }
    public function cookies(){
        require('view/frontend/privacy.php');
    }
    public function legalesMentions(){
        require('view/frontend/legalesMentions.php');
    }
}