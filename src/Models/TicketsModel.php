<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:39 AM
 */


namespace App\Models;


use App\Traits\TicketsModelHelperTrait;
use PDO;
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
     * @param array|string $data
     * @return array|bool
     */
    public function create(array|string $data, string $val_for_check=''):array|bool|int
    {

        if($this->getById($data['Ticket_ID'])){
            return $data;
        }
        /** params prepare */
        $this->setValues($data);
        $markers = [];
        $columns = $this->getTableColumns();
        $data['dif_calculate'] = $this->timeDifCalculate($data['OpenTimestamp'], $data['CloseTimestamp']);
        $counter = 0;
        for ($i = 0; $i<count($data);$i++ ) {
            $markers[$counter] = ':'.strtoupper($columns[$counter]);
            $counter++;
        }
        /**------------------------*/

        /** Insert data */
        $query = "INSERT INTO " . $this->table_name . " ( " . implode(', ', $columns) . " ) VALUES( " . implode(', ', $markers)." )";
        $st = $this->db->prepare($query);

        /** data binding */

            $st->bindParam(":ID", $data['Ticket_ID']);
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

        } catch (PDOException $a) {
//            echo $a->getMessage();
            /** do nothing */
        }
        return true;
    }

    /**
     * @return array|bool
     */
    public function getProfits():array|bool
    {
        $query = "SELECT trading_room, S_YEAR, AVG(PROFIT) AS PROFIT FROM(
                  SELECT trading_room, year(close_time) AS S_YEAR, month(close_time), sum(take_profit) AS PROFIT
                  FROM ".$this->table_name."
                  WHERE close_time IS NOT NULL
                  GROUP BY trading_room, year(close_time), month(close_time)) AS C_SEARCH
                  GROUP BY trading_room, S_YEAR";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
