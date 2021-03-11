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
 use PDOException;


 abstract class MainModel implements IModels
{
    protected PDO|null $db;
    protected string $table_name;
    protected string $field_name;
   public function __construct()
   {
       $this->db = DbConnection::getConnection();
   }
   public function create(array $data_array){
       $marks = [];
       $values = [];
       foreach($data_array as $key => $val){
           $marks[] = "( ? )";
           $values[] = $key;
       }
       $query = "INSERT INTO ".$this->table_name." (".$this->field_name.") VALUES ".implode(',',$marks);
       $st = $this->db->prepare($query);
       try{
           $st->execute($values);
       }
       catch (PDOException $e)
       {
           /** do nothing*/
       }

   }

   public function getAll(){
       $query = "SELECT * FROM ".$this->table_name;
       return  $this->db->query($query, PDO::FETCH_ASSOC);
   }

 }
