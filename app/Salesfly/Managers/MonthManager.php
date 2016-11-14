<?php
namespace Salesfly\Salesfly\Managers;
class MonthManager extends BaseManager {

    public function getRules()
    {
        $rules = ['month'=> 'required'];
        return $rules;
    }
}