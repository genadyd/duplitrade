<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 2:11 AM
 */


namespace App\Models;



 use App\Db\DbConnection;
 use PDO;


 abstract class MainModel
{
    protected PDO|null $db;
   public function __construct()
   {
       $this->db = DbConnection::getConnection();
   }

 }
