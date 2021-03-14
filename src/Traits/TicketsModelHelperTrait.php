<?php


namespace App\Traits;


use App\Models\InstrumentsModel;
use App\Models\StatusesModel;
use App\Models\TypesModel;


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
     * @param array $values_row
     */
    private function setValues(array &$values_row):void{
        $values_row['Ticket_ID'] = (int)$values_row['Ticket_ID'];
        $values_row['trading_room_ID'] = (int)$values_row['trading_room_ID'];
        $values_row['PositionType'] = (int)$values_row['PositionType'];
        $values_row['Instrument_Name'] = (int)$values_row['Instrument_Name'];
        $values_row['Type'] = (int)$values_row['Type'];
        $values_row['Amount'] = floatval($values_row['Amount']);
        $values_row['OpenPrice'] = floatval($values_row['OpenPrice']);
        $values_row['ClosePrice'] = floatval($values_row['ClosePrice']);
        $values_row['StopLoss'] = floatval($values_row['StopLoss']);
        $values_row['TakeProfit'] = floatval($values_row['TakeProfit']);
        $values_row['Current'] = floatval($values_row['Current']);
        $values_row['PL'] = floatval($values_row['PL']);
        $values_row['GrossPL'] = floatval($values_row['GrossPL']);
        $values_row['NetPL'] = floatval($values_row['NetPL']);
        $values_row['Swap'] = floatval($values_row['Swap']);
        $values_row['OpenTimestamp'] = preg_match('/\d{10}/',$values_row['OpenTimestamp'])?date("Y-m-d H:i:s",$values_row['OpenTimestamp']):NULL;
        $values_row['CloseTimestamp'] = preg_match('/\d{10}/',$values_row['CloseTimestamp'])?date("Y-m-d H:i:s",(int)$values_row['CloseTimestamp']):NULL;
        $values_row['calculatedBalance'] = floatval($values_row['calculatedBalance']);
        $values_row['closed_positions_cnt'] = (int)$values_row['closed_positions_cnt'];
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
    private function timeDifCalculate(string|null $start, string|null $end):bool|int|null{
        if(preg_match('/\d{10}/',$start) && preg_match('/\d{10}/',$end)){
            return strtotime(date("Y-m-d H:i:s",(int)$end))-strtotime(date("Y-m-d H:i:s",(int)$start));
        }
        return NULL;
    }
}
