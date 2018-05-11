<?php

namespace Controller;

use \Model\CommentManager;
use \Model\LoginManager;
use \Model\PostManager;

/**
 * Class Backend
 * @package Controller
 */
class Backend
{
    public function settings()
    {
        require('../view/backend/settings.php');
    }

    public function adminHomeView()
    {
        require('../view/backend/adminHomeView.php');
    }

    public function newPostView()
    {
        require('../view/backend/newPostView.php');
    }

    public function commentsModeration()
    {
        $commentManager = new CommentManager();

        $nbComments = $commentManager->countComments();
        if ($nbComments > 0) {
            $perPage = 15;
            $nbPages = $commentManager->countPages($nbComments, $perPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }
            if (isset($_GET['orderBy']) && $_GET['orderBy'] == 'date') {
                $byDate = $_GET['orderBy'];
                $comments = $commentManager->getAllComments($currentPage, $perPage, $byDate);
            } elseif (isset($_GET['orderBy']) && $_GET['orderBy'] == 'posts') {
                $byPosts = $_GET['orderBy'];
                $comments = $commentManager->getAllComments($currentPage, $perPage, $byPosts);
            } else {
                $comments = $commentManager->getAllComments($currentPage, $perPage);
            }
        } else {
            $comments = false;
        }

        require('../view/backend/commentsModeration.php');
    }

    public function commentModeration()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
            $commentManager = new CommentManager();
            $comment = $commentManager->getComment($_GET['commentId']);
            if($comment != false){
                require('../view/backend/commentModeration.php');
            } else {
                $_SESSION['message'] = 'Mauvais identifiant de commentaire envoyé !';
                header('location: index.php?action=commentsModeration');
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé !';
            header('location: index.php?action=commentsModeration');
        }
    }

    public function adminUpdateComment()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
            if (!empty($_POST['comment'])) {
                if (isset($_GET['reported'])) {
                    $commentManager = new CommentManager();
                    $commentManager->changeComment($_POST['comment'], $_GET['commentId'], $_GET['reported']);

                    $_SESSION['message'] = 'Le commentaire a été modéré.';
                    header('location: index.php?action=commentsModeration');
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=commentsModeration');
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé.';
            header('Location: index.php?action=commentsModeration');
        }
    }

    public function deleteComment()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
            $commentManager = new CommentManager();
            $deletedComment = $commentManager->deleteComment($_GET['commentId']);

            if ($deletedComment == true){
                $_SESSION['message'] = 'La suppression a réussi.';
            } else {
                $_SESSION['message'] = 'Mauvais identifiant de commentaire envoyé !';
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de commentaire envoyé !';
        }
        header('location: index.php?action=commentsModeration');
    }

    public function postsManager()
    {
        $postsManager = new PostManager();

        $nbPosts = $postsManager->countPosts();
        if ($nbPosts > 0) {
            $perPage = 10;
            $nbPages = $postsManager->countPages($nbPosts, $perPage);
            if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPages) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }
            if (isset($_GET['orderBy']) && $_GET['orderBy'] == 'date') {
                $byDate = $_GET['orderBy'];
                $posts = $postsManager->getAllPostsExcerpt($currentPage, $perPage, $byDate);
            } else {
                $posts = $postsManager->getAllPostsExcerpt($currentPage, $perPage);
            }
        } else {
            $posts = false;
        }

        require('../view/backend/postsManager.php');
    }

    public function publishPost()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])) {
            if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
                if ($_POST['title'] <= 255) {
                    $title = strip_tags($_POST['title']);
                    $content = $_POST['content'];
                    $author = strip_tags($_POST['author']);

                    $postManager = new PostManager();
                    $newPost = $postManager->publishNewPost($title, $content, $author);

                    $_SESSION['message'] = 'Le billet a été publié.';

                    header('Location: index.php?action=postsManager');
                } else {
                    $_SESSION['message'] = 'Le titre ne doit pas dépasser 255 caractères.';
                }
            } else {
                $_SESSION['message'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=newPost');
            }
        } else {
            $_SESSION['message'] = 'Une erreur est survenue.';
            header('Location: index.php?action=newPost');
        }
    }

    public function viewOrChangePost()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0) {
            $postManager = new PostManager();
            $post = $postManager->getPost($_GET['postId']);

            if ($post != ''){
                require('../view/backend/postView.php');
            } else {
                $_SESSION['message'] = 'Mauvais identifiant de billet envoyé !';
                header('location: index.php?action=postsManager');
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé !';
            header('location: index.php?action=postsManager');
        }
    }

    public function deletePost()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0) {
            $postManager = new PostManager();
            $post = $postManager->getPost($_GET['postId']);
            $post = $postManager->deletePost($post);

            if ($post == true) {
                $_SESSION['message'] = 'Le billet a été supprimé.';
            } else {
                $_SESSION['message'] = 'Mauvais identifiant de billet envoyé !';
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé';
        }
        header('location: index.php?action=postsManager');
    }

    public function updatePost()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_GET['postId']) && $_GET['postId'] > 0) {
            if (isset($_POST['title']) && isset($_POST['content'])) {
                if ($_POST['title'] <= 255) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        $title = strip_tags($_POST['title']);
                        $content = $_POST['content'];
                        $potsId = $_GET['postId'];

                        $postManager = new PostManager();
                        $post = $postManager->updatePost($title, $content, $potsId);

                        $_SESSION['message'] = 'Le billet a été mis à jour.';
                    } else {
                        $_SESSION['message'] = 'Tous les champs ne sont pas remplis.';
                    }
                } else {
                    $_SESSION['message'] = 'Le titre ne doit pas dépasser 255 caractères.';
                }
            } else {
                $_SESSION['message'] = 'Un problème est survenu.';
            }
        } else {
            $_SESSION['message'] = 'Aucun identifiant de billet envoyé !';
        }
        header('location: index.php?action=postsManager');
    }
}