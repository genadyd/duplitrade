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
   public function create(array|string $data, string $val_for_check =''):int|bool|array{
      $check_data = $this->getByFieldName($this->field_name, $val_for_check);
       if($check_data) {
          return $check_data['id'] ;
       }else{
           $query = "INSERT INTO " . $this->table_name . " (" . $this->field_name . ") VALUES (:DATA)";
           $st = $this->db->prepare($query);
           $st->bindParam(":DATA", $data);
           if ($st->execute()) {
               return  $last_id = $this->db->lastInsertId();;
           }
           return false;
       }


   }

   public function getAll(){
       $query = "SELECT * FROM ".$this->table_name;
       return  $this->db->query($query, PDO::FETCH_ASSOC);
   }
   public function getByFieldName(string $field_name, string $value){
       $query = "SELECT * FROM ".$this->table_name." WHERE ".$field_name." = :FIELD";
       $st = $this->db->prepare($query);
       $st->bindParam(":FIELD", $value);
       $st->execute();
       return $st->fetch(PDO::FETCH_ASSOC);
   }

   public function getById( int $id):array|bool{
       $query = "SELECT * FROM ".$this->table_name." WHERE 'id' = :ID";
       $st = $this->db->prepare($query);
       $st->bindParam(":ID", $id);
       $st->execute();
       return $st->fetch(PDO::FETCH_ASSOC);
   }

 }
