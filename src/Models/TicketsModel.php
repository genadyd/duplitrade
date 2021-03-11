<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:39 AM
 */


namespace App\Models;


use App\Traits\TicketsModelHelperTrait;
use PDOException;

final class TicketsModel extends MainModel
{
    use TicketsModelHelperTrait;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'tickets';
    }

    /**
     * @param array $data_array
     */
    public function create(array $data_array)
    {
        /** params prepare */
        $statuses = $this->getStatuses();
        $types = $this->getTypes();
        $instruments = $this->getInstrument();
        $markers = [];
        $values = [];
        $columns = $this->getTableColumns();
        foreach($data_array as $key => $val){
         $val['PositionType'] = $statuses[$val['PositionType']]??'';
         $val['Instrument_Name'] = $instruments[$val['Instrument_Name']]?? $instruments['not_defined'];
         $val['Type'] = $types[$val['Type']]??'';

             $markers[] = $this->setMarkers(count($val) + 1);
             $values = array_merge($values, $this->setValues($val));

        }
        /**------------------------*/

        /** Insert data */
       $query = "INSERT INTO ".$this->table_name." ( ".implode(', ',$columns)." ) VALUES  ".implode(', ',$markers);
       $st = $this->db->prepare($query);

        try {
            $st->execute($values);

        }catch (PDOException $a){
           echo $a->getMessage();
            /** do nothing */
        }

    }
}
