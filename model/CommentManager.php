<?php

namespace Model;

use Entity\Comments;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments WHERE postId = ? ORDER BY creationDate DESC');
        $req->execute(array($postId));

        $comments = [];

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $comment = new Comments();
            $comment->hydrate($data);
            $comments[] = $comment;
        }
        $req->closeCursor();
        return $comments;
    }

    public function postComment($postId, $postTitle, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(postId, postTitle, author, content, creationDate) VALUES(?, ?, ?, ?, NOW())');
        // Récupération en paramètres des informations dont on a besoin
        $affectedLines = $comments->execute(array($postId, $postTitle, $author, $comment));

        return $affectedLines;
    }
    public function getComment($commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $comment = new Comments();
        $comment->hydrate($data);

        return $comment;
    }
    public function getAllComments() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr, postId, postTitle, reported FROM comments ORDER BY creationDate');

        $comments = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $comment = new Comments();
            $comment->hydrate($data);
            $comments[] = $comment;
        }
        $req->closeCursor();

        return $comments;
    }
    public function updateComment($comment, $commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET content = ?, creation_date = NOW() WHERE id = ?');
        $affectedComment = $req->execute(array($comment, $commentId));

        return $affectedComment;
    }
    public function changeComment($comment, $commentId, $reported) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET content = ?, reported = ?, creationDate = NOW() WHERE id = ?');
        $affectedComment = $req->execute(array($comment, $reported, $commentId));

        return $affectedComment;
    }
    public function reportComment($reported, $commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = ? WHERE id = ?');
        $affectedComment = $req->execute(array($reported, $commentId));
    }
    public function deleteComment($commentId){
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedComment = $req->execute(array($commentId));
    }
}