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
    protected static array $check_array;
   public function __construct()
   {
       $this->db = DbConnection::getConnection();

   }
   public function create(array|string $data):int|bool{
       foreach ($this->getAll() as $val) static::$check_array[$val[$this->field_name]] = $val['id'];
       if(!isset(static::$check_array[$data])) {
           $query = "INSERT INTO " . $this->table_name . " (" . $this->field_name . ") VALUES (:DATA)";
           $st = $this->db->prepare($query);
           $st->bindParam(":DATA", $data);
           if ($st->execute()) {
               $last_id = $this->db->lastInsertId();
               static::$check_array[$data] = $last_id;
               return $last_id;
           }
       }
       return static::$check_array[$data];

   }

   public function getAll(){
       $query = "SELECT * FROM ".$this->table_name;
       return  $this->db->query($query, PDO::FETCH_ASSOC);
   }

   public function getById( int $id):array|bool{
       $query = "SELECT * FROM ".$this->table_name." WHERE 'id' = :ID";
       $st = $this->db->prepare($query);
       $st->bindParam(":ID", $id);
       $st->execute();
       return $st->fetch(PDO::FETCH_ASSOC);
   }

 }
