<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:40 AM
 */


namespace App\Models;


final class InstrumentsModel extends MainModel implements IModels
{
    public function __construct()
    {
        parent::__construct();
        $this->field_name = 'instrument_name';
        $this->table_name = 'instruments';
    }

    public function create(array|string $data):int
    {
     return parent::create($data);
    }
}
