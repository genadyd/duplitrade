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
    /** experiences improve performance */

    /**
     * @param string $file
     * @return Generator
     */
    public function getFileData($file = "tickets.csv"): Generator{
        $resource = fopen($file, "r");
        while (feof($resource) === false) {
           yield fgetcsv($resource);
        }
        fclose($resource);

    }

}
