<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:38 AM
 */


namespace App\Models;




use PDO;
use PDOException;

final class TradingRoomsModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'trading_rooms';
        $this->field_name = 'id';

    }

    public function create(array|string $data, string $val_for_check=''):int
    {

       if(!$this->getById($data['id'])) {
           $query = "INSERT INTO " . $this->table_name . " (id, some_data) VALUES(:ID, :DATA)";
           $st = $this->db->prepare($query);
           $st->bindParam(":ID", $data['id'], PDO::PARAM_INT);
           $st->bindParam(":DATA", $data['data'], PDO::PARAM_STR);
           try {
               $st->execute();
           }catch (PDOException $e){
               /** do nothing */
           }
       }
       return $data['id']; /** By this method signature i must return @var int $id */
    }
}
