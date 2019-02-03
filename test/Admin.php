<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 01/02/2019
 * Time: 21:52
 */

namespace App\Model;

use PDO;


class Admin extends \Core\Model
{
    public $errors = [];

    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function getAllCategories()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM categories ORDER BY category_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllPages()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM pages ORDER BY page_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllArticles()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM articles ORDER BY article_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllForumCategories()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forum_categories ORDER BY forum_category_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllForumTopics()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM forum_topics ORDER BY forum_topic_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllUsers()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM users ORDER BY user_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getAllUserGroups()
    {
        try {
            $db = static::getDB();
            $stmt = $db->query('SELECT * FROM user_groups ORDER BY user_group_id ASC');
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}