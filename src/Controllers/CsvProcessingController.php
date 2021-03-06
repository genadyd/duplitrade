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
use App\Models\AlertsModel;
use App\Models\IModels;
use App\Models\InstrumentsModel;
use App\Models\StatusesModel;
use App\Models\TicketsModel;
use App\Models\TradingRoomsModel;
use App\Models\TypesModel;


final class CsvProcessingController
{
    private IModels $instruments_model;
    private IModels $statuses_model;
    private IModels $trading_rums_model;
    private IModels $types_model;
    private IModels $tickets_model;
    private IModels $alerts_model;

    public function __construct()
    {
        $this->modelsInit();
    }

    /**
     *
     */
    public function processor():void{
        $start = microtime(true);
        $csv_rider = new CsvReader();
        $separator = new DataSeparator( $csv_rider->getFileData());
        $this->instruments_model->create($separator->getInstruments());
        $this->statuses_model->create($separator->getStatuses());
        $this->trading_rums_model->create($separator->getTradingRooms());
        $this->types_model->create($separator->getTypes());
        $this->tickets_model->create($separator->getTickets());
        $this->alerts_model->create($separator->getAlerts());

        echo  (microtime(true)-$start). "\n";
        echo '<br>';
        $memory_size = memory_get_usage();
        $memory_unit = array('Bytes','KB','MB','GB','TB','PB');
// Display memory size into kb, mb etc.
        echo 'Used Memory : '.round($memory_size/pow(1024,($x=floor(log($memory_size,1024)))),2).' '.$memory_unit[$x]."\n";

    }

    /**
     *
     */
    private function modelsInit():void{
        $this->instruments_model = new InstrumentsModel();
        $this->statuses_model = new StatusesModel();
        $this->trading_rums_model = new TradingRoomsModel();
        $this->types_model = new TypesModel();
        $this->tickets_model = new TicketsModel();
        $this->alerts_model = new AlertsModel();
    }

}
