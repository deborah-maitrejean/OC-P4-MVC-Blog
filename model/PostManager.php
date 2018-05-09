<?php

namespace Model;

use Entity\Posts;

/**
 * Class PostManager
 * @package Model
 */
class PostManager extends Manager
{
    /**
     * @return mixed
     */
    public function countPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM posts');

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $req->fetchAll();
        $postsNb = $data[0];
        foreach ($postsNb as $key => $value) {
            $nbPosts = $postsNb[$key];
        }
        return $nbPosts;
    }

    /**
     * @param $nbPosts
     * @param $perPage
     * @return float
     */
    public function countPages($nbPosts, $perPage)
    {
        $nbPages = ceil($nbPosts / $perPage);

        return $nbPages;
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @return array
     */
    public function getPosts($currentPage, $perPage)
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * , DATE_FORMAT(creationDate, '%d/%m/%Y à %Hh%im%ss') AS creationDateFr FROM posts ORDER BY creationDate DESC LIMIT " . (($currentPage - 1) * $perPage) . ",$perPage");

        $posts = array();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }
        $req->closeCursor();

        return $posts;
    }

    /**
     * @return array
     */
    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param string $params
     * @return array
     */
    public function getAllPostsExcerpt($currentPage, $perPage, $params = '')
    {
        $db = $this->dbConnect();

        if ($params == 'date') {
            $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 300) AS postExcerpt, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate LIMIT ' . (($currentPage - 1) * $perPage) . ', ' . $perPage . ' ');
        } else {
            $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 300) AS postExcerpt, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate DESC LIMIT ' . (($currentPage - 1) * $perPage) . ', ' . $perPage . ' ');
        }
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }

    /**
     * @return array
     */
    public function getAllPostsExcerptDesc()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 300) AS postExcerpt, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate DESC');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }

    /**
     * @return array
     */
    public function getPostsExcerpt()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 380) AS postExcerpt, author, DATE_FORMAT(creationDate,  \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate DESC LIMIT 0,4');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }

    /**
     * @param $postId
     * @return Posts
     */
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        if ($data != false){
            $post = new Posts();
            $post->hydrate($data);
        } else{
            $post = '';
        }

        return $post;
    }

    /**
     * @param $title
     * @param $content
     * @param $author
     * @return bool
     */
    public function publishNewPost($title, $content, $author)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, author, creationDate) VALUES(?, ?, ?, NOW())');
        $affectedLines = $post->execute(array($title, $content, $author));

        return $affectedLines;
    }

    /**
     * @param $postId
     * @return bool
     */
    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $post = $req->execute(array($postId));
        return $post;
    }

    /**
     * @param $title
     * @param $content
     * @param $postId
     * @return bool
     */
    public function updatePost($title, $content, $postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedPost = $req->execute(array($title, $content, $postId));

        return $affectedPost;
    }
}