<?php

require_once './config.php';

class DataBase {

    private static $_instance;

    public function &pdo_connection(){
        if(!self::$_instance){
            try {
                self::$_instance = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
                self::$_instance->setAttribute(PDO::ATTR_PERSISTENT, true);
                self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$_instance->exec('SET NAMES utf8');
            }
            catch(PDOException $est) {
                die("Error: DB connection error! <br/>". $est->getMessage() ."<br/>");
            }
        }
        return self::$_instance;
    }
	
    private function  __construct() {}
    private function __clone() {}

}

?>