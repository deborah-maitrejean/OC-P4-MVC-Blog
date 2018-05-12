<?php

namespace Controller;

use \Model\CommentManager;
use \Model\PostManager;

/**
 * Class Frontend
 * @package Controller
 */
class Frontend
{
    public function listPosts()
    {
        $postManager = new PostManager();
        $nbPosts = $postManager->countPosts();
        $perPage = 3;
        $nbPages = $postManager->countPages($nbPosts, $perPage);
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages) {
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $posts = $postManager->getPosts($currentPage, $perPage);

        require(VIEW.'frontend/allPostsView.php');
    }

    public function listPostsExcerpt()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPostsExcerpt();

        require(VIEW.'frontend/listPostsView.php');
    }

    public function postNcomments()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $postManager = new PostManager();
        $post = $postManager->getPost($_GET['id']);

        if ($post != ''){
            $commentManager = new CommentManager();
            $nbComments = $commentManager->countComments($post->getId());
            if ($nbComments > 0) {
                $perPage = 4;
                $nbPages = $commentManager->countPages($nbComments, $perPage);
                if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages) {
                    $currentPage = $_GET['page'];
                } else {
                    $currentPage = 1;
                }
                $comments = $commentManager->getComments($_GET['id'], $currentPage, $perPage);
            } else {
                $comments = false;
            }
            require(VIEW.'frontend/postView.php');
        } else {
            header('Location: index.php?action=allPostsView');
            $_SESSION['message'] = 'Mauvais identifiant de billet envoyé !';
            exit();
        }
    }

    public function addComment()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['postTitle']) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                if (strlen($_POST['author']) <= 255 && strlen($_POST['comment']) <= 255) {
                    $id = strip_tags($_GET['id']);
                    $postTitle = strip_tags($_GET['postTitle']);
                    $author = strip_tags($_POST['author']);
                    $comment = strip_tags(trim($_POST['comment']));

                    $commentManager = new CommentManager();
                    $affectedLines = $commentManager->postComment($id, $postTitle, $author, $comment);

                    if ($affectedLines === false) {
                        $_SESSION['message'] = 'Impossible d\'ajouter le commentaire !';
                    }
                } else {
                    $_SESSION['message'] = 'Les champs ne doivent pas dépasser 255 caractères.';
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis !';
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé !';
        }
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }

    public function reportComment()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0 && $_GET['postId']) {
            if (isset($_GET['reported'])) {
                $commentManager = new CommentManager();
                $commentManager->reportComment($_GET['reported'], $_GET['commentId'], $_GET['postId']);

                $_SESSION['message'] = 'Le commentaire a été signalé.';
                header('Location: index.php?action=post&id=' . $_GET['postId']);
            } else {
                $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé !';
                header('Location: index.php?action=post');
            }
        }
    }

    public function adminView()
    {
        session_start();
        if (session_status() === 2) {
            if (isset($_SESSION) && isset($_SESSION['connected'])) {
                header('Location: index.php?action=adminHomeView');
            } else {
                session_destroy();
                require(VIEW.'frontend/adminConnexionView.php');
            }
        }
    }

    public function aboutView()
    {
        require(VIEW.'frontend/aboutView.php');
    }

    public function contactView()
    {
        require(VIEW.'frontend/contactView.php');
    }

    public function cookies()
    {
        require(VIEW.'frontend/privacy.php');
    }

    public function legalesMentions()
    {
        require(VIEW.'frontend/legalesMentions.php');
    }

    public function page404()
    {
        require(VIEW.'frontend/404.php');
    }
}