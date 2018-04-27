<?php

namespace Model;

use Entity\Comments;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, content, reported, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments WHERE post_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $postTitle, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, post_title, author, content, creation_date) VALUES(?, ?, ?, ?, NOW())');
        // Récupération en paramètres des informations dont on a besoin
        $affectedLines = $comments->execute(array($postId, $postTitle, $author, $comment));

        return $affectedLines;
    }
    public function getComment($commentId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, reported, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $comment = new Comments();
        $comment->hydrate($data);

        return $comment;
    }
    public function getAllComments() {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT * , DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creationDate FROM comments ORDER BY creation_date');

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
        $req = $db->prepare('UPDATE comments SET content = ?, reported = ?, creation_date = NOW() WHERE id = ?');
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
        $comment = $db->prepare('DELETE FROM comments WHERE id = ?');
        $affectedComment = $comment->execute(array($commentId));
    }
}