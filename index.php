<?php

// ces fichiers appellent le bon controlleur
require('controller/frontend.php');
require('controller/backend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'adminInterfaceLogin') {
            if (isset($_POST['adminId']) AND isset($_POST['adminPassword'])){
                if (!empty($_POST['adminId']) AND !empty($_POST['adminPassword'])){
                    loginControl($_POST['adminId'], $_POST['adminPassword']);
                } else{
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Les variables n\'existent pas');
            }
        } elseif ($_GET['action'] == 'adminHomeView'){
            adminHomeView();
        } elseif ($_GET['action'] == 'commentsModeration'){
            commentsModeration();
        } elseif ($_GET['action'] == 'postsManager') {
            postsManager();
        } elseif ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && $_GET['postTitle']) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_GET['postTitle'], $_POST['author'], $_POST['comment']); //call addComment from controller
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé !');
            }
        } elseif($_GET['action'] == 'reportComment') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if(isset($_GET['reported'])){
                    reportComment($_GET['reported'], $_GET['commentId']);
                }
                else {
                    throw new Exception('Aucun identifiant de commentaire envoyé !');
                }
            }
        } elseif ($_GET['action'] == 'commentView') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                commentView();
            } else {
                throw new Exception('Aucun identifiant de commentaire envoyé !');
            }
        } elseif ($_GET['action'] == 'editComment'){
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0) {
                if (!empty($_POST['comment'])) {
                    editComment($_GET['id'], $_POST['comment'], $_GET['commentId']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'adminConnexion'){
            adminView();
        } elseif ($_GET['action'] == 'about'){
            aboutView();
        } elseif ($_GET['action'] == 'contact'){
            contactView();
        } elseif ($_GET['action'] == 'allPostsView'){
            listPosts();
        }
    }
    else {
        listPostsExcerpt();
    }
}
catch(Exception $e) { // s'il y a une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}