<?php
/**
 * Created by PhpStorm.
 * UsersManager: jlbokass
 * Date: 15/01/2019
 * Time: 02:46
 */

namespace Core;

use PDO;
use PDOException;
use Config\Config;

/**
 * Class Model
 * @package Core
 */
abstract class Model
{
    /**
     * @return null|PDO
     */


    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {

            try {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

                // Throw an Exception when errror occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }
}

