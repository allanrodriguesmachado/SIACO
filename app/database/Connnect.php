<?php

namespace App\database;

use PDO;

class Connnect
{

    CONST HOST = 'localhost';
     CONST USER = 'postgres';
     CONST PASSWORD = '830314';
     CONST DB = 'ecommerce';

     const PARAMS = [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_CASE => PDO::CASE_NATURAL,
     ];

     private static Object $instance;

     public static function getInstance(): Object
     {
         try {
             self::$instance = new PDO("pgsql:host=".self::HOST.";dbname=".self::DB, self::USER, self::PASSWORD, self::PARAMS);
         }catch (\PDOException $exception) {
             echo $exception->getMessage();
         }

         return self::$instance;
     }

    private function __construct()
    {

    }

    private function __clone()
    {
    }
}