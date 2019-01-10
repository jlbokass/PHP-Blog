<?php
/**
 * Created by PhpStorm.
 * User: jlbokass
 * Date: 10/01/2019
 * Time: 22:31
 */

namespace Core;

use PDO;
class Model
{
    private $connexion;

    public function getConnection()
    {
        try
        {
            $this->connexion = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'connexion réussi';
            return $this->connexion;
        }

        catch (PDOException $e)
        {
            die('Error : ' . $e->getMessage());
        }
    }


    private function checkConnection()
    {
        if ($this->connexion == null)
        {
            return $this->getConnection();
        }
        return $this->connexion;
    }


    protected function sql($sql, $params = null)
    {
        if ($params)
        {
            $req = $this->checkConnection()->prepare($sql);
            $req->execute($params);
            return $req;
        }
        $req = $this->checkConnection()->query($sql);
        return $req;
    }
}