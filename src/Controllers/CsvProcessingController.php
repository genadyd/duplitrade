<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/10/21
 * Time: 5:03 AM
 */


namespace App\Controllers;



use App\CsvReader\CsvReader;
use App\DataSeparator\DataSeparator;

class CsvProcessingController
{
    public function processor(){
        $start = microtime(true);
        $csv_rider = new CsvReader();
        $separator = new DataSeparator( $csv_rider->getFileData());
        var_dump($separator->getInstruments());
        echo  (microtime(true)-$start). "\n";

    }

}
