<?php
    namespace models;

    use PDO;

    class Base{

        public static $pdo = null;

        public function __construct(){

            if(self::$pdo === null){

                self::$pdo = new PDO('mysql:host=127.0.0.1;dbname=blogs','root','');
                self::$pdo->exec('set names utf8');
            }
   
        }

    }

?>