<?php
namespace Salesfly\Salesfly\Repositories;

use Salesfly\Salesfly\Entities\DetAtr;

class DetAtrRepo extends BaseRepo{

    public function getModel()
    {
        return new DetAtr();
    }


}