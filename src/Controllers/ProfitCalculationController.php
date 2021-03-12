<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 3/12/21
 * Time: 1:08 AM
 */


namespace App\Controllers;



use App\Models\IModels;
use App\Models\ProfitsCalculateTableModel;
use App\Models\TicketsModel;

class ProfitCalculationController
{
    private IModels $tickets_model;
    private IModels $profit_calculate_model;

    public function __construct()
    {
        $this->modelsInit();

    }
    public function index(){
       $this->profit_calculate_model->create($this->tickets_model->getProfits());
    }
    /**
     *
     */
    private function modelsInit():void{
        $this->tickets_model = new TicketsModel();
        $this->profit_calculate_model = new ProfitsCalculateTableModel();
    }


}
