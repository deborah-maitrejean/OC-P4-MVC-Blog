<?php
require('controller/frontend.php'); // ce fichier appelle le bon controlleur

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']); //call addComment from controller
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
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
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // s'il y a une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}