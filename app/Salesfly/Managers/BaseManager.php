<?php
namespace Salesfly\Salesfly\Managers;

abstract class BaseManager {

    protected $entity;
    protected $data;

    public function __construct($entity, $data)
    {
        $this->entity = $entity;
        $this->data   = array_only($data, array_keys($this->getRules()));
    }

    abstract public function getRules();

    public function isValid()
    {
        $rules = $this->getRules();
        $validation = \Validator::make($this->data, $rules);
        //print_r($this->data);
        //print_r($rules);
        if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
            //return $validation->messages();
            // print_r('holi'); die();
            //throw new \Exception('División por cero.');
        }
    }

    public function prepareData($data)
    {
        return $data;
    }

    public function save()
    {
        try{
        $this->isValid();
        }catch(ValidationException $e){
            echo $e->getErrors();
            die();
        }
        //print_r($this->entity); die();
        $this->entity->fill($this->prepareData($this->data));

        $transaction = \DB::transaction(function(){
            $this->entity->save();
        });

        if(!is_null($transaction))
        {
            throw new ValidationException('Validation failed', $transaction);
        }

        return true;
    }
}