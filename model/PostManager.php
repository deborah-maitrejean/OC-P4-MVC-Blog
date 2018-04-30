<?php

namespace Model;
use Entity\Posts;

require_once("model/Manager.php");

class PostManager extends Manager {
    public function countPosts(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(id) as nbPosts FROM posts');
        $req->setFetchMode(\PDO::FETCH_ASSOC);
        $data = $req->fetchAll();
        $nbPosts = $data[0];

        return $nbPosts;
    }
    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%im%ss\') AS creationDate FROM posts ORDER BY creation_date DESC LIMIT 0,5 ");

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
        $req = $db->query('SELECT * , DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%im%ss\') AS creationDate FROM posts ORDER BY creation_date');
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
        $req = $db->query('SELECT  id, title, SUBSTRING(content, 1, 300) AS postExcerpt, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%im%ss\') AS creationDate FROM posts ORDER BY creation_date');
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
        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 380) AS postExcerpt, author, DATE_FORMAT(creation_date,  \'%d/%m/%Y à %Hh%im%ss\') AS creationDate FROM posts ORDER BY creation_date DESC LIMIT 0,5');
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
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%im%ss\') AS creationDate FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $data = $req->fetch(\PDO::FETCH_ASSOC);

        $post = new Posts();
        $post->hydrate($data);

        return $post;
    }
    public function publishNewPost($title, $content, $author) {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, author, creation_date) VALUES(?, ?, ?, NOW())');
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