<?php

namespace Model;
use Entity\Posts;

require_once("model/Manager.php");

class PostManager extends Manager {
    public function countPosts(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) FROM posts');

        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $req->fetchAll();
        $postsNb = $data[0];
        foreach($postsNb as $key=>$value) {
            $nbPosts = $postsNb[$key];
        }
        return $nbPosts; // le nombre de posts est retourné
    }
    public function getPosts($currentPage, $nbPosts) {
        $perPage = 5;
        $nbPage = ceil($nbPosts / $perPage);
        $db = $this->dbConnect();
        $req = $db->query("SELECT * , DATE_FORMAT(creationDate, '%d/%m/%Y à %Hh%im%ss') AS creationDateFr FROM posts ORDER BY creationDate DESC LIMIT ".(($currentPage-1)*$perPage).",$perPage");

        $posts = array();
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }
        $req->closeCursor();

        return $posts;
    }
    public function getAllPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * , DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }
    public function getAllPostsExcerpt() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 300) AS postExcerpt, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }
    public function getPostsExcerpt(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 380) AS postExcerpt, author, DATE_FORMAT(creationDate,  \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts ORDER BY creationDate DESC LIMIT 0,5');
        $posts = array();

        while ($data = $req->fetch(\PDO::FETCH_ASSOC)){
            $post = new Posts();
            $post->hydrate($data);
            $posts[] = $post;
        }

        $req->closeCursor();

        return $posts;
    }
    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%im%ss\') AS creationDateFr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $post = new Posts();
        $post->hydrate($data);

        return $post;
    }
    public function publishNewPost($title, $content, $author) {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, author, creationDate) VALUES(?, ?, ?, NOW())');
        // Récupération en paramètres des informations dont on a besoin
        $affectedLines = $post->execute(array($title, $content, $author));

        return $affectedLines;
    }
    public function deletePost($postId){
        $db = $this->dbConnect();
        $post = $db->prepare('DELETE FROM posts WHERE id = ?');
        $affectedLines = $post->execute(array($postId));
    }
    public function updatePost($title, $content, $postId){
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $affectedPost = $req->execute(array($title, $content, $postId));

        return $affectedPost;
    }
}