<?php
namespace Salesfly\Salesfly\Managers;
class YearManager extends BaseManager {

    public function getRules()
    {
        $rules = ['year'=> 'required'];
        return $rules;
    }
}