<?php

namespace Model;

use Entity\Comments;

/**
 * Class CommentManager
 * @package Model
 */
class CommentManager extends Manager
{
    /**
     * @param null $postId
     * @return mixed
     */
    public function countComments($postId = null)
    {
        $db = $this->dbConnect();
        if ($postId != null) {
            $req = $db->prepare('SELECT COUNT(id) FROM comments WHERE postId = ?');
            $req->execute(array($postId));
        } else {
            $req = $db->query('SELECT COUNT(id) FROM comments');
        }

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $req->fetchAll();
        $commentsNb = $data[0];
        foreach ($commentsNb as $key => $value) {
            $nbComments = $commentsNb[$key];
        }
        return $nbComments;
    }

    /**
     * @param $nbComments
     * @param $perPage
     * @return float
     */
    public function countPages($nbComments, $perPage)
    {
        $nbPages = ceil($nbComments / $perPage);

        return $nbPages;
    }

    /**
     * @param $postId
     * @param $currentPage
     * @param $perPage
     * @return array
     */
    public function getComments($postId, $currentPage, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, author, content, reported, DATE_FORMAT(creationDate, \"%d/%m/%Y à %Hh%im%ss\") AS creationDateFr 
            FROM comments 
            WHERE postId = :postId
            ORDER BY creationDate DESC 
            LIMIT " . (($currentPage - 1) * $perPage) . ",$perPage");
        $req->execute(array(':postId' => $postId));

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comments();
            $comment->hydrate($data);
            $comments[] = $comment;
        }
        $req->closeCursor();
        return $comments;
    }

    /**
     * @param $postId
     * @param $postTitle
     * @param $author
     * @param $comment
     * @return bool
     */
    public function postComment($postId, $postTitle, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(postId, postTitle, author, content, creationDate) VALUES(?, ?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $postTitle, $author, $comment));

        return $affectedLines;
    }

    /**
     * @param $commentId
     * @return Comments
     */
    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, author, content, reported, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments WHERE id = ?');
        $req->execute(array($commentId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if ($data != false) {
            $comment = new Comments();
            $comment->hydrate($data);
            return $comment;
        } else {
            return $comment = false;
        }
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param string $param
     * @return array
     */
    public function getAllComments($currentPage, $perPage, $param = '')
    {
        $db = $this->dbConnect();

        if ($param == 'date') {
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY creationDate LIMIT ' . (($currentPage - 1) * $perPage) . ' , ' . $perPage . ' ');
        } elseif ($param == 'posts') {
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY postId LIMIT ' . (($currentPage - 1) * $perPage) . ' , ' . $perPage . ' ');
        } else {
            $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM comments ORDER BY reported DESC LIMIT ' . (($currentPage - 1) * $perPage) . ' , ' . $perPage . ' ');
        }

        $comments = array();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comments();
            $comment->hydrate($data);
            $comments[] = $comment;
        }
        $req->closeCursor();

        return $comments;
    }

    /**
     * @param $comment
     * @param $commentId
     * @return bool
     */
    public function updateComment($comment, $commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET content = ?, creation_date = NOW() WHERE id = ?');
        $affectedComment = $req->execute(array($comment, $commentId));

        return $affectedComment;
    }

    /**
     * @param $comment
     * @param $commentId
     * @param $reported
     * @return bool
     */
    public function changeComment($comment, $commentId, $reported)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET content = ?, reported = ?, creationDate = NOW() WHERE id = ?');
        $affectedComment = $req->execute(array($comment, $reported, $commentId));

        return $affectedComment;
    }

    /**
     * @param $reported
     * @param $commentId
     */
    public function reportComment($reported, $commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET reported = ? WHERE id = ?');
        $affectedComment = $req->execute(array($reported, $commentId));
    }

    /**
     * @param $commentId
     * @return bool
     */
    public function deleteComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $req->execute(array($commentId));

        return $deletedComment;
    }
}