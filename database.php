<?php

class Database
{
    private static $dbName = 'crud_tutorial';
    private static $dbHost = 'localhost';
    private static $dbPort = '3306';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont = null;

    private function __construct()
    {
        // Private constructor to prevent instantiation
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // One connection throughout the whole application
        if (null == self::$cont) {
            try {
                self::$cont = new PDO(
                    "mysql:host=" . self::$dbHost . ";port=" . self::$dbPort . ";dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbUserPassword
                );
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        // Close the connection
        self::$cont = null;
    }
}
?>
