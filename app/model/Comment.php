<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 11/02/2019
 * Time: 05:37
 */

namespace App\Model;

class Comment
{
    public $id;
    public $FK_user_id;
    public $FK_post_id;
    public $content;
    public $published;
    public $createdAt;
    public $updatedAt;


    public function __construct($data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFKUserId()
    {
        return $this->FK_user_id;
    }

    /**
     * @param mixed $FK_user_id
     */
    public function setFKUserId($FK_user_id): void
    {
        $this->FK_user_id = $FK_user_id;
    }

    /**
     * @return mixed
     */
    public function getFKPostId()
    {
        return $this->FK_post_id;
    }

    /**
     * @param mixed $FK_post_id
     */
    public function setFKPostId($FK_post_id): void
    {
        $this->FK_post_id = $FK_post_id;
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
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published): void
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


}
