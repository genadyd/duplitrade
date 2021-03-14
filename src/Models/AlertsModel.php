<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/11/21
 * Time: 6:20 PM
 */


namespace App\Models;


use App\Traits\TicketsModelHelperTrait;
use PDOException;


final class AlertsModel extends MainModel
{
    use TicketsModelHelperTrait;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'alerts_tickets';
    }
    public function create(array|string $data, string $val_for_check=''):int|bool
    {
        /** params prepare */
       $this->setValues($data);
        $markers = [];
        $columns = $this->getTableColumns();
        array_shift($columns);
        $data['dif_calculate'] = $this->timeDifCalculate($data['OpenTimestamp'], $data['CloseTimestamp']);
        for ($i = 1; $i<count($data);$i++ ) {
            $markers[$i] = ':'.strtoupper($columns[$i]);
        }
        /**------------------------*/

        /** Insert data */
        $query = "INSERT INTO ".$this->table_name." ( ".implode(', ',$columns)." ) VALUES  ".implode(', ',$markers);
        $st = $this->db->prepare($query);
        /** data binding */

        $st->bindParam(":TICKET_ID", $data['Ticket_ID']);
        $st->bindParam(":TRADING_ROOM", $data['trading_room_ID']);
        $st->bindParam(":STATUS", $data["PositionType"]);
        $st->bindParam(":INSTRUMENT", $data['Instrument_Name']);
        $st->bindParam(":TYPE", $data['Type']);
        $st->bindParam(":AMOUNT", $data['Amount']);
        $st->bindParam(":OPEN_PRICE", $data['OpenPrice']);
        $st->bindParam(":CLOSE_PRICE", $data['ClosePrice']);
        $st->bindParam(":STOP_LOSS", $data['StopLoss']);
        $st->bindParam(":TAKE_PROFIT", $data['TakeProfit']);
        $st->bindParam(":CURRENT", $data['Current']);
        $st->bindParam(":PL", $data['PL']);
        $st->bindParam(":GROSS_PL", $data['GrossPL']);
        $st->bindParam(":NET_PL", $data['NetPL']);
        $st->bindParam(":SWAP", $data['Swap']);
        $st->bindParam(":OPEN_TIME", $data['OpenTimestamp']);
        $st->bindParam(":CLOSE_TIME", $data['CloseTimestamp']);
        $st->bindParam(":CALCULATED_BALANCE", $data['calculatedBalance']);
        $st->bindParam(":CLOSED_POSITION_CNT", $data['closed_positions_cnt']);
        $st->bindParam(":OPENED_TIME", $data['dif_calculate']);

        try {
            $st->execute();

        }catch (PDOException $a){
            echo $a->getMessage();
            /** do nothing */
        }
        return 1;
    }



}
