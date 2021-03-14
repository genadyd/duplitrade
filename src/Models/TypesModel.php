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
//    protected static array $check_array;
    public function __construct()
    {
        parent::__construct();
        $this->table_name = 'types';
        $this->field_name = 'type_name';

    }

//    public function create(array|string $data):int|bool
//    {
//       return parent::create($data);
//    }

}
