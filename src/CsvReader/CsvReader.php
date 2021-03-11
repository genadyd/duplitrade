<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 2:08 AM
 */


namespace App\CsvReader;


use Generator;

class CsvReader
{
    /**
     * @param string $file
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
//    public function getFileData($file = "tickets.csv"): Generator{
//        $resource = fopen($file, "r");
//        while (feof($resource) === false) {
//           yield fgetcsv($resource);
//        }
//        fclose($resource);
//
//    }
//    public function getFileObject(){
//        $res = [];
//        foreach ($this->getFileData() as $row){
//            $res[]=  $row;
//        }
//        return $res;
//    }

}
