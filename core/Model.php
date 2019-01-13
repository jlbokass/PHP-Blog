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


    protected function select ( $sql, $params = null) {

        $req = $this->sql($sql, $params);
        $data = $req->fetchAll();

        return $data;
    }

    protected function update ($sql, $params = null) {

        $req = $this->sql($sql, $params);
        $updated = $req->rowCount();

        return $updated;
    }


    protected function insert ($sql, $params = []){

        $req = $this->sql($sql, $params);

        $inserted = $req->rowCount();

        return $inserted;
    }

    protected function delete ( $sql, $params = []) {

        $req = $this->sql($sql, $params);

        $deleted = $req->rowCount();

        return $deleted;
    }
}