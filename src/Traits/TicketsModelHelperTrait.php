<?php


namespace App\Traits;


use App\Models\InstrumentsModel;
use App\Models\StatusesModel;
use App\Models\TypesModel;

trait TicketsModelHelperTrait
{
    /**
     * @return array
     */
    private function getInstrument():array{
        $model = new InstrumentsModel();
        $res = [];
        foreach ($model->getAll() as $instrument){
          $res[$instrument['instrument_name']] = $instrument['id'];
        }
        return $res;
    }

    private function getTypes():array{
        $model = new TypesModel();
        $res = [];
        foreach ($model->getAll() as $type){
            $res[$type['type_name']] = $type['id'];
        }
        return $res;
    }
    private function getStatuses():array{
        $model = new StatusesModel();
        $res = [];
        foreach ($model->getAll() as $status){
            $res[$status['status_name']] = $status['id'];
        }
        return $res;;
    }

}
