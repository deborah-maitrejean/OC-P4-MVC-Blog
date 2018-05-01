<?php
namespace Controller;
use \Model\CommentManager;
use \Model\LoginManager;
use \Model\PostManager;

class Backend{
    public function loginControl(){
        $loginManager = new LoginManager();
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password'])){
            if (!empty($_POST['email']) && !empty($_POST['password'])){
                if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])){
                    // hachage du mot de passe
                    $passHach = hash('sha512', htmlspecialchars($_POST['password']));
                    // vérification des identifiants
                    $login = $loginManager->getLogin($_POST['email'], $passHach);
                    if ($login !== null) {
                        // l'identification a réussi, la session démarre
                        session_start();
                        $_SESSION['time']       = time();
                        $_SESSION['email']      = $login->getEmail();
                        $_SESSION['password']   = $login->getPassword();
                        $_SESSION['name']       = substr($login->getEmail(), 0, 11);
                        $_SESSION['connected']  = true;
                        session_write_close();

                        header('location: index.php?action=adminHomeView');
                    } else{
                        //throw new Exception('Mauvais identifiants de connexion');
                        header('location: index.php?action=adminConnexion');
                    }
                } else{
                    //throw new Exception('Le format de l\'adresse email est incorrect');
                    header('location: index.php?action=adminConnexion');
                }
            } else{
                //throw new Exception('Tous les champs ne sont pas remplis');
                header('location: index.php?action=adminConnexion');
            }
        }
    }
    public function logOut(){
        if (session_start()){
            session_destroy();
            setcookie('adminSession');
            header('location: index.php');
        }
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
    public function commentsByDate(){
        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByDate();

        require('view/backend/commentsModeration.php');
    }
    public function commentsByPost(){
        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByPost();

        require('view/backend/commentsModeration.php');
    }
    public function commentModeration(){
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0){
            $commentManager = new CommentManager();
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
                    $commentManager = new CommentManager();
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
            $commentManager = new CommentManager();
            $deletedComment = $commentManager->deleteComment($_GET['commentId']);

            header('location: index.php?action=commentsModeration');
        } else {
            throw new Exception('Aucun identifiant de commentaire envoyé !');
        }
    }
    public function postsManager(){
        $postsManager = new PostManager();
        $posts = $postsManager->getAllPostsExcerpt();

        require('view/backend/postsManager.php');
    }
    public function postsManagerByDate(){
        $postsManager = new PostManager();
        $posts = $postsManager->getAllPostsExcerptDesc();

        require('view/backend/postsManager.php');
    }
    public function publishPost(){
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])){
            $postManager = new PostManager();
            $newPost = $postManager->publishNewPost($_POST['title'], $_POST['content'], $_POST['author']);

            header('location: index.php?action=postsManager');
        } else{
            throw new Exception('Tous les champs ne sont pas remplis !');
        }
    }
    public function viewOrChangePost(){
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            $postManager = new PostManager();
            $post = $postManager->getPost($_GET['postId']);

            require('view/backend/postView.php');
        } else{
            throw new Exception('Aucun identifiant de billet envoyé !');
        }
    }
    public function deletePost(){
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            $postManager = new PostManager();
            $post = $postManager->deletePost($_GET['postId']);

            header('location: index.php?action=postsManager');
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }
    public function updatePost(){
        if (isset($_GET['postId']) && $_GET['postId'] > 0){
            if (isset($_POST['title']) && isset($_POST['content'])){
                $postManager = new PostManager();
                $post = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['postId']);

                header('location: index.php?action=postsManager');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé !');
        }
    }
}