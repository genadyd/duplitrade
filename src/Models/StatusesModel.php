<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:43 AM
 */


namespace App\Models;


final class StatusesModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->field_name = 'status_name';
        $this->table_name = 'statuses';
    }

//    public function create(array|string $data, string $val_for_check=''):int
//    {
//      return parent::create($data, $val_for_check);
//    }
}
