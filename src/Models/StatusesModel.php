<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:43 AM
 */


namespace App\Models;


final class StatusesModel extends MainModel implements IModels
{
    public function __construct()
    {
        parent::__construct();
        $this->field_name = 'status_name';
        $this->table_name = 'statuses';
    }

    public function create(array $data_array)
    {
      parent::create($data_array);
    }
}
