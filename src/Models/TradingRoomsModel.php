<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:38 AM
 */


namespace App\Models;




final class TradingRoomsModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'trading_rooms';
        $this->field_name = 'id';

    }

    public function create(array $data_array)
    {
        parent::create($data_array);
    }
}
