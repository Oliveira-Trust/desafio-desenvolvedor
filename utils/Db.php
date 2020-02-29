<?php
    class Db {
        
        static $host = 'localhost';
        static $db = 'ot_store';
        static $user = 'root';
        static $password = '';

        public static function getConnection() {
            try {

                $conn = new PDO('mysql:host='.self::$host.';dbname='.self::$db, self::$user, self::$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            }
            catch(PDOException $e) {
                return false;
            }
        }
    }
?>