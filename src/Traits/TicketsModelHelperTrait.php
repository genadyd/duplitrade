<?php


namespace App\Traits;


use App\Models\InstrumentsModel;
use App\Models\StatusesModel;
use App\Models\TypesModel;
use JetBrains\PhpStorm\Pure;

trait TicketsModelHelperTrait
{
    /**
     * @return array
     */
    private function getInstrument():array{
        $model = new InstrumentsModel();
        $res = [];
        foreach ($model->getAll() as $instrument){
          $res[$instrument['instrument_name']] = $instrument['id'];
        }
        return $res;
    }

    private function getTypes():array{
        $model = new TypesModel();
        $res = [];
        foreach ($model->getAll() as $type){
            $res[$type['type_name']] = $type['id'];
        }
        return $res;
    }
    private function getStatuses():array{
        $model = new StatusesModel();
        $res = [];
        foreach ($model->getAll() as $status){
            $res[$status['status_name']] = $status['id'];
        }
        return $res;;
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
