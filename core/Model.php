<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 15/01/2019
 * Time: 02:46
 */

namespace Core;

use PDO;

use App\Config;

abstract class Model
{
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {

            try {
                $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
                $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

                // Throw an Exception when errror occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $db;

            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}