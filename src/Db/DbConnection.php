<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 1:42 AM
 */


namespace App\Db;


use Exception;
use PDO;

class DbConnection
{
    private function __construct()
    {
    } /*hold static class*/

    private static ?DbConnection $instance = NULL;

    public static function getConnection():?PDO
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance->connection();
    }

    /**
     * @return PDO|null
     */
    private function connection():?PDO
    {
        $db_config = array(
            'host'=>'localhost',
            'db_name'=>'pdac',
            'db_user'=>'root',
            'db_pass'=>'1234'
        );
        try {
            return new PDO('mysql:host=' . $db_config['host'] . ';dbname=' . $db_config['db_name'], $db_config['db_user'], $db_config['db_pass']);
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e;
            return NULL;
        }
    }
}
