<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE post_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, content, creation_date) VALUES(?, ?, ?, NOW())');
        // Récupération en paramètres des informations dont on a besoin
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    public function getComment($commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
    }
    public function updateComment($comment, $commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET content = ?, creation_date = NOW() WHERE id = ?');
        $affectedComment = $req->execute(array($comment, $commentId));

        return $affectedComment;
    }
}