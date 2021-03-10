<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 2:08 AM
 */


namespace App\CsvReader;


class CsvReader
{
    /**
     * @return array
     */
    public function getFileData():array{
        $resource = fopen("tickets.csv", "r");
        $res = [];
        while (($data = fgetcsv($resource)) !== FALSE) {
            $res[] = $data;
        }
        fclose($resource);
        return $res;
    }

}
