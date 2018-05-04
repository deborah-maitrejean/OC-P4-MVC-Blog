<?php
namespace Controller;
use \Model\CommentManager;
use \Model\LoginManager;
use \Model\PostManager;

class Backend{
    public function loginControl(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
            if (!empty($_POST['email']) && !empty($_POST['password'])){
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                    // hachage du mot de passe
                    $passHach = hash('sha512', htmlspecialchars($_POST['password']));
                    // vérification des identifiants
                    $loginManager = new LoginManager();
                    $login = $loginManager->getLogin($_POST['email'], $passHach);
                    if ($login !== null) {
                        // l'identification a réussi
                        $_SESSION['time']       = time();
                        $_SESSION['email']      = $login->getEmail();
                        $_SESSION['password']   = $login->getPassword();
                        $_SESSION['name']       = substr($login->getEmail(), 0, 11);
                        $_SESSION['connected']  = true;
                        session_write_close();

                        header('location: index.php?action=adminHomeView');
                    } else{
                        $_SESSION['message'] = 'Mauvais identifiants de connexion.';
                        header('location: index.php?action=adminConnexion');
                    }
                } else{
                    $_SESSION['message'] = 'Le format de l\'adresse email est incorrect.';
                    header('location: index.php?action=adminConnexion');
                }
            } else{
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
                header('location: index.php?action=adminConnexion');
            }
        } else{
            $_SESSION['message'] = 'Une erreur est survenue.';
            header('location: index.php?action=adminConnexion');
        }
    }
    public function logOut(){
        if (session_start()){
            session_destroy();
            setcookie('adminSession');
            header('location: index.php');
        }
    }
    public function settings(){
        require('view/backend/settings.php');
    }
    public function changePassword(){
    }
    public function changeLogin(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['newEmail']) && isset($_POST['newEmailVerif'])){
            if (!empty($_POST['email']) && !empty($_POST['newEmail']) && !empty($_POST['newEmailVerif'])){
                $loginManager = new LoginManager();
                $login = $loginManager->checkLogin($_POST['email']);
                if ($login->getEmail() != null && $login->getEmail() == $_POST['email']){
                    if ($_POST['newEmail'] == $_POST['newEmailVerif']){
                        $newEmail = $_POST['newEmail'];
                        $email = $login->getEmail();
                        $loginManager->updateLogin($newEmail, $email);
                        $_SESSION['message'] = 'L\'identifiant a été mis à jour.';
                    } else{
                        $_SESSION['message'] = 'Les nouveaux identifiants saisis ne sont pas identiques.';
                    }
                } else{
                    $_SESSION['message'] = 'L\'identifiant n\'est pas reconnu.';
                }
            } else{
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
            }
        } else{
            $_SESSION['message'] = 'Une erreur est survenue.';
        }
        header('location: index.php?action=settings');
    }
    public function adminHomeView(){
        require('view/backend/adminHomeView.php');
    }
    public function newPostView(){
        require('view/backend/newPostView.php');
    }
    public function commentsModeration(){
        $commentManager = new CommentManager();

        $nbComments = $commentManager->countComments();
        if ($nbComments > 0){
            $perPage = 15;
            $nbPages = $commentManager->countPages($nbComments, $perPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
                $currentPage = $_GET['page'];
            } else{
                $currentPage = 1;
            }
            if (isset($_GET['orderBy']) && $_GET['orderBy'] == 'date'){
                $byDate = $_GET['orderBy'];
                $comments = $commentManager->getAllComments($currentPage, $perPage, $byDate);
            } elseif (isset($_GET['orderBy']) && $_GET['orderBy'] == 'posts'){
                $byPosts = $_GET['orderBy'];
                $comments = $commentManager->getAllComments($currentPage, $perPage, $byPosts);
            } else{
                $comments = $commentManager->getAllComments($currentPage, $perPage);
            }
        } else{
            $comments = false;
        }

        require('view/backend/commentsModeration.php');
    }
    public function commentModeration(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            $commentManager = new CommentManager();
            $comment = $commentManager->getComment($_GET['commentId']);

            require('view/backend/commentModeration.php');
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé !';
            header('location: index.php?action=commentsModeration');
        }
    }
    public function adminUpdateComment(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            if (!empty($_POST['comment'])){
                if (isset($_GET['reported'])){
                    $commentManager = new CommentManager();
                    $commentManager->changeComment($_POST['comment'], $_GET['commentId'], $_GET['reported']);

                    $_SESSION['message'] = 'Le commentaire a été modéré.';
                    header('location: index.php?action=commentsModeration');
                }
            } else{
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=commentsModeration');
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé.';
            header('Location: index.php?action=commentsModeration');
        }
    }
    public function deleteComment(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            $commentManager = new CommentManager();
            $deletedComment = $commentManager->deleteComment($_GET['commentId']);

            $_SESSION['message'] = 'La suppression a réussi.';
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé !';
        }
        header('location: index.php?action=commentsModeration');
    }
    public function postsManager(){
        $postsManager = new PostManager();

        $nbPosts = $postsManager->countPosts();
        if ($nbPosts > 0){
            $perPage = 10;
            $nbPages = $postsManager->countPages($nbPosts, $perPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages){
                $currentPage = $_GET['page'];
            } else{
                $currentPage = 1;
            }
            if (isset($_GET['orderBy']) && $_GET['orderBy'] == 'date'){
                $byDate = $_GET['orderBy'];
                $posts = $postsManager->getAllPostsExcerpt($currentPage, $perPage, $byDate);
            } else{
                $posts = $postsManager->getAllPostsExcerpt($currentPage, $perPage);
            }
        } else{
            $posts = false;
        }

        require('view/backend/postsManager.php');
    }
    public function publishPost(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])){
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])){
                $title = strip_tags($_POST['title']);
                $content  = $_POST['content'];
                $author = strip_tags($_POST['author']);

                $postManager = new PostManager();
                $newPost = $postManager->publishNewPost($title, $content, $author);

                $_SESSION['message'] = 'Le billet a été publié.';

                header('Location: index.php?action=postsManager');
            } else{
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=newPost');
            }
        } else{
            $_SESSION['message'] = 'Une erreur est survenue.';
            header('Location: index.php?action=newPost');
        }
    }
    public function viewOrChangePost(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            $postManager = new PostManager();
            $post = $postManager->getPost($_GET['postId']);

            require('view/backend/postView.php');
        } else{
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé !';
            header('location: index.php?action=postsManager');
        }
    }
    public function deletePost(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            $postManager = new PostManager();
            $post = $postManager->deletePost($_GET['postId']);

            $_SESSION['message'] = 'Le billet a été supprimé.';
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé';
        }
        header('location: index.php?action=postsManager');
    }
    public function updatePost(){
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            if (isset($_POST['title']) && isset($_POST['content'])){
                if (!empty($_POST['title']) && !empty($_POST['content'])){
                    $title = strip_tags($_POST['title']);
                    $content  = $_POST['content'];
                    $author = strip_tags($_POST['author']);

                    $postManager = new PostManager();
                    $post = $postManager->updatePost($title, $content, $author);

                    $_SESSION['message'] = 'Le billet a été mis à jour.';
                } else{
                    $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
                }
            } else{
                $_SESSION['message'] = 'Un problème est survenu.';
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé !';
        }
        header('location: index.php?action=postsManager');
    }
}