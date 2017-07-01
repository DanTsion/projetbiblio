<?php
class Database
{
    private static $dbName = 'projetBibliotheque';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $con = null;
    
    public function __construct()
    {
        die('Not allowed');
    }
    
    public static function connect()
    {
        if (null == self::$con)
        {
            try
            { 
                self::$con = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
            catch(PDOException $ex)
            {
                die('Erreur :'.$ex->getMessage()); 
            }
       }
       return self::$con;
    }
     
    public static function disconnect()
    {
        self::$con = null;
    }
}