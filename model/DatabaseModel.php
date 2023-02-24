<?php
namespace App\model;

use \App\model\ConfigDbModel;

class DatabaseModel{

    private $db_name;

    private $db_user;

    private $db_pass;

    private $db_host;

    public $pdo;

    public function __construct(){
        $this->pdo = self::getPDO();
    }

    private function getPDO(){
        $pdo = new \PDO("mysql:dbname=".self::getDbName().";host=".self::getDbHost(),self::getDbUser(),self::getDbPass());
        $pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
        return $this->pdo;
    }

    private function getDbName(){
        return $this->db_name = ConfigDbModel::getInstance()->get("db_name");
    }

    private function getDbHost(){
        return $this->db_host = ConfigDbModel::getInstance()->get("db_host");
    }

    private function getDbUser(){
        return $this->db_user = ConfigDbModel::getInstance()->get("db_user");
    }
    private function getDbPass(){
        return $this->db_pass = ConfigDbModel::getInstance()->get("db_pass");
    }
}