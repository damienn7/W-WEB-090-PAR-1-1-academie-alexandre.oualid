<?php
namespace App\model;

class ConfigDbModel{

    private $id;
    private static $_instance; 
    private $settings = [];

    public static function getInstance(){
        if (is_null(self::$_instance)) {
            self::$_instance = new ConfigDbModel();
        }
        return self::$_instance;
    }
    public function __construct(){
        $this->id = uniqid();
        $this->settings = require "../config/mysql.php";
    }

    public function get($key){
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}