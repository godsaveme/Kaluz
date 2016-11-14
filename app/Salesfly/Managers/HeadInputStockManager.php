<?php
namespace Salesfly\Salesfly\Managers;
class HeadInputStockManager extends BaseManager {

    public function getRules()
    {
        $rules = [              
            'Fecha'=>'','tipo'=>'','orderPurchase_id'=>'','purchase_id'=>'','warehouses_id'=>'','user_id'=>'','warehouDestino_id'=>''
                  ,'sale_id'=>''];
        return $rules;
    }}