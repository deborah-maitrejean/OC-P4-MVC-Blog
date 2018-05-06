<?php

namespace Model;
use Entity\Comments;

class CommentManager extends Manager
{
    public function countComments($postId = null){
        $db = $this->dbConnect();
        if ($postId != null){
            $req = $db->prepare('SELECT COUNT(id) FROM comments WHERE postId = ?');
            $req->execute(array($postId));
        } else{
            $req = $db->query('SELECT COUNT(id) FROM comments');
        }

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $req->fetchAll();
        $commentsNb = $data[0];
        foreach($commentsNb as $key=>$value) {
            $nbComments = $commentsNb[$key];
        }
        return $nbComments;
    }
    public function countPages($nbComments,  $perPage){
        $nbPages = ceil($nbComments / $perPage);

        return $nbPages;
    }
    public function getComments($postId, $currentPage, $perPage) {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, author, content, reported, DATE_FORMAT(creationDate, \"%d/%m/%Y à %Hh%im%ss\") AS creationDateFr 
            FROM comments 
            WHERE postId = :postId
            ORDER BY creationDate DESC 
            LIMIT ".(($currentPage-1)*$perPage).",$perPage");
        $req->execute(array(':postId' => $postId));

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
    public function getAllComments($currentPage, $perPage, $param = '') {
        $db = $this->dbConnect();

        if ($param == 'date'){
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY creationDate LIMIT '.(($currentPage-1)*$perPage).' , '.$perPage.' ');
        } elseif ($param == 'posts'){
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY postId LIMIT '.(($currentPage-1)*$perPage).' , '.$perPage.' ');
        } else {
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY reported DESC LIMIT '.(($currentPage-1)*$perPage).' , '.$perPage.' ');
        }

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