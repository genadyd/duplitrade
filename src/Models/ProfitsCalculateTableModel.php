<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/12/21
 * Time: 1:12 AM
 */


namespace App\Models;


use PDO;
use PDOException;

class ProfitsCalculateTableModel extends MainModel implements IModels
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'profit_calculate';
    }

    public function create(array $data_array)
    {
        $query = " INSERT INTO ".$this->table_name ."( traiding_room_id, per_year, monthly_avg_profit ) 
       VALUES (:ROOM, :PER_YEAR, :PROFIT ) ";
        $st = $this->db->prepare($query);
        foreach ($data_array as $value){
            $st->bindParam(":ROOM",$value['trading_room'], PDO::PARAM_INT);
            $st->bindParam(":PER_YEAR",$value['S_YEAR'], PDO::PARAM_INT);
            $st->bindParam(":PROFIT",$value['PROFIT']);
            try {
                $st->execute();
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    }


}
