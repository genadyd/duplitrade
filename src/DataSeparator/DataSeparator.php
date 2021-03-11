<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 6:43 AM
 */


namespace App\DataSeparator;


class DataSeparator
{
    private array $tickets;
    private array $instruments;
    private array $statuses;
    private array $types;
    private array $trading_rooms;
    private array $alerts_tickets;

    public function __construct(private array $data)
    {
        $this->instruments = [];
        $this->types = [];
        $this->tickets = [];
        $this->alerts_tickets = [];
        $this->statuses = [];
        $this->trading_rooms = [];
        $this->separate();
    }

    /**
     *
     */
    private function separate(): void
    {
        $header = array();

        foreach ($this->data as $key => $row) {
            $row_elem = [];
            foreach ($row as $field_key => $field) {
                if ($key === 0) {
                    /** if first row (headers) */
                    $header[$field_key] = $field;
                } else {
                    /** tickets array row reformat (header_key=>field_value)*/
                    $row_elem[$header[$field_key]] = $field;

                }
            }
            if (count($row_elem)) {
                /** tickets array build */
                if(is_null($this->searchByUniq($this->tickets, 'Ticket_ID', $row_elem['Ticket_ID']))) {
                    $this->tickets[] = $row_elem;
                }
                else{
                    $this->alerts_tickets[] = $row_elem;
                }
                /** instruments array build */
                $this->arrayCreate($row_elem['Instrument_Name'],
                    $this->instruments,
                    fn($val)=> preg_match('/^[A-Z\d_-]{6,}$/i', $val));


                /** types array build */
                $this->arrayCreate($row_elem['Type'],
                    $this->types,
                    fn($val)=> preg_match('/^[a-z]{3,}$/i', $val));

                /** statuses array build */
                $this->arrayCreate($row_elem['PositionType'],
                    $this->statuses,
                    fn($val)=> preg_match('/^[a-z]+$/i', $val));

                /** trading rooms build */
                $this->arrayCreate($row_elem['trading_room_ID'],
                    $this->trading_rooms,
                    fn($val)=> preg_match('/^[\d]+$/i', $val));

            }

        }
    }

    /**
     * @param string $inserted_string
     * @param array $arrayToChange
     * @param callable|bool $callback
     */
    private function arrayCreate( string $inserted_string, array &$arrayToChange=[], callable|bool $callback = false): void
    {
        if(is_callable($callback) ){
            if($callback($inserted_string)){
                $arrayToChange[$inserted_string]=0;
            }
        }
    }

    public function getTickets(): array
    {
        return $this->tickets;
    }
    public function getAlerts(){
        return $this->alerts_tickets;
    }

    public function getInstruments(): array
    {
        $this->instruments['not_defined']=0;
        return $this->instruments;
    }

    public function getStatuses(): array
    {
        return $this->statuses;
    }

    public function getTypes(): array
    {
        return $this->types;
    }
    public function getTradingRooms():array
    {
        return $this->trading_rooms;
    }

    /**
     * @param array $array_for_search
     * @param string $field_name
     * @param int|string $uniq
     * @return int|string|null
     */
    private function searchByUniq(array $array_for_search, string $field_name, int|string $uniq):int|string|null{
        foreach ($array_for_search as $key => $val){
            if($uniq == $val[$field_name]){
                return $key;
            }
        }
        return NULL;

    }
}
