<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 11:42 AM
 */


namespace App\Models;


final class TypesModel extends MainModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'types';
        $this->field_name = 'type_name';

    }

    public function create(array $data_array)
    {
        parent::create($data_array);
    }

}
