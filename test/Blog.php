<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 21:43
 */

namespace App\Model;

use PDO;


class Blog extends \Core\Model {
    public $errors = [];

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function save() {
        $this->validate();

        if (empty($this->errors)) {
            $this->article_image = "placeholder.png";

            $sql = 'INSERT INTO articles (article_title, article_author, article_content, article_tags, article_date, article_image)
            VALUES (:article_title, :article_author, :article_content, :article_tags, NOW(), :article_image)';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':article_title', $this->article_title, PDO::PARAM_STR);
            $stmt->bindValue(':article_author', $this->article_author, PDO::PARAM_STR);
            $stmt->bindValue(':article_content', $this->article_content, PDO::PARAM_STR);
            $stmt->bindValue(':article_tags', $this->article_tags, PDO::PARAM_STR);
            $stmt->bindValue(':article_image', $this->article_image, PDO::PARAM_STR);

            return $stmt->execute();
        }
        return false;
    }

    public function validate()
    {
        if ($this->article_title == '') {
            $this->errors[] = 'Article Title is Required';
        }

        if ($this->article_content == '') {
            $this->errors[] = 'Article Content is Required';
        }

        if ($this->article_tags == '') {
            $this->errors[] = 'Article Tags are Required';
        }

        if (static::articleExists($this->article_title, $this->article_id ?? null)) {
            $this->errors[] = 'Article Already Exists';
        }
    }

    public static function articleExists($article_title, $ignore_id = null) {
        $blog = static::findByArticleTitle($article_title);

        if ($blog) {
            if ($blog->article_id != $ignore_id) {
                return true;
            }
        }
        return false;
    }

    public static function getAllArticles() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT article_id, article_title, article_author, article_content, article_date, article_image FROM articles ORDER BY article_date DESC LIMIT 3');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllArticlesAdmin() {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT article_id, article_title, article_author, article_content, article_date, article_image FROM articles ORDER BY article_date ASC LIMIT 3');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getArticleTitle($article_title) {
        $sql = 'SELECT * FROM articles WHERE article_title = $article_title';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue('article_title', $article_title, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function findByArticleTitle($article_title) {
        $sql = 'SELECT * FROM articles WHERE article_title = :article_title';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':article_title', $article_title, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public static function findByID($article_id) {
        $sql = 'SELECT * FROM articles WHERE article_id = :article_id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':article_id', $article_id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, get_called_class());

        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateArticle($data) {
        $this->article_title = $data['article_title'];
        $this->article_content = $data['article_content'];
        $this->article_tags = $data['article_tags'];

        $this->validate();

        if(empty($this->errors)) {
            $sql = 'UPDATE articles SET article_title = :article_title, article_content = :article_content, article_tags = :article_tags WHERE article_id = :article_id';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':article_title', $this->article_title, PDO::PARAM_STR);
            $stmt->bindValue(':article_content', $this->article_content, PDO::PARAM_STR);
            $stmt->bindValue(':article_tags', $this->article_tags, PDO::PARAM_STR);
            $stmt->bindValue(':article_id', $this->article_id, PDO::PARAM_INT);

            return $stmt->execute();
        }
        return false;
    }
}