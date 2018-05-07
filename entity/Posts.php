<?php

namespace Entity;

/**
 * Class Posts
 * @package Entity
 */
class Posts extends Table
{
    private $id;
    private $author;
    private $title;
    private $content;
    private $postExcerpt;
    private $creationDate;
    private $creationDateFr;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getPostExcerpt()
    {
        return $this->postExcerpt;
    }

    /**
     * @param mixed $postExcerpt
     */
    public function setPostExcerpt($postExcerpt)
    {
        $this->postExcerpt = $postExcerpt;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreationDateFr()
    {
        return $this->creationDateFr;
    }

    /**
     * @param mixed $creationDateFr
     */
    public function setCreationDateFr($creationDateFr)
    {
        $this->creationDateFr = $creationDateFr;
    }

}