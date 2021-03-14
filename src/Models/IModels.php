<?php


namespace App\Models;


interface IModels
{
   public function create(array|string $data, string $val_for_check=''):array|bool|int;

}
