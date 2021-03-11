<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:39 AM
 */


namespace App\Models;


use App\Traits\TicketsModelHelperTrait;
use JetBrains\PhpStorm\Pure;
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
         $val['Instrument_Name'] = $instruments[$val['Instrument_Name']]??'';
         $val['Type'] = $types[$val['Type']]??'';

             $markers[] = $this->setMarkers(count($val) + 1);
             $values = array_merge($values, $this->setValues($val));

        }
        /**------------------------*/

        /** Insert data */
       $query = "INSERT INTO tickets ( ".implode(', ',$columns)." ) VALUES  ".implode(', ',$markers);
       $st = $this->db->prepare($query);

        try {
            $st->execute($values);

        }catch (PDOException $a){
           echo $a->getMessage();
            /** do nothing */
        }

    }

    /**
     * @param int $num
     * @return string
     */
    #[Pure] private function setMarkers(int $num):string{
        $m = '( ';
        for ($i = 0; $i<$num; $i++ ){
            $m.='?, ';
        }
        $m = rtrim($m, ', ');
        $m.= ' )';
        return $m;
    }

    /**
     * @param array $values_row
     * @return array
     */
    private function setValues(array $values_row):array{
        $v = [];
        $v[] = (int)$values_row['Ticket_ID'];
        $v[] = (int)$values_row['trading_room_ID'];
        $v[] = (int)$values_row['PositionType'];
        $v[] = (int)$values_row['Instrument_Name'];
        $v[] = (int)$values_row['Type'];
        $v[] = floatval($values_row['Amount']);
        $v[] = floatval($values_row['OpenPrice']);
        $v[] = floatval($values_row['ClosePrice']);
        $v[] = floatval($values_row['StopLoss']);
        $v[] = floatval($values_row['TakeProfit']);
        $v[] = floatval($values_row['Current']);
        $v[] = floatval($values_row['PL']);
        $v[] = floatval($values_row['GrossPL']);
        $v[] = floatval($values_row['NetPL']);
        $v[] = floatval($values_row['Swap']);
        $v[] = preg_match('/\d{10}/',$values_row['OpenTimestamp'])?date("Y-m-d H:i:s",$values_row['OpenTimestamp']):NULL;
        $v[] = preg_match('/\d{10}/',$values_row['CloseTimestamp'])?date("Y-m-d H:i:s",(int)$values_row['CloseTimestamp']):NULL;
        $v[] = floatval($values_row['calculatedBalance']);
        $v[] = (int)$values_row['closed_positions_cnt'];
        $v[] = $this->timeDifCalculate($values_row['OpenTimestamp'], $values_row['CloseTimestamp']);
      return $v;
    }

    /**
     * @return array
     */
    private function getTableColumns():array{
        $query = "SHOW COLUMNS FROM ".$this->table_name;
        return  $this->db->query($query)->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * @param string $start
     * @param string $end
     * @return false|int|null
     */
    private function timeDifCalculate(string $start, string $end):bool|int|null{
        if(preg_match('/\d{10}/',$start) && preg_match('/\d{10}/',$end)){
            return strtotime(date("Y-m-d H:i:s",(int)$end))-strtotime(date("Y-m-d H:i:s",(int)$start));
        }
        return NULL;
    }

}
