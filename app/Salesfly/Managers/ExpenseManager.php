<?php
namespace Salesfly\Salesfly\Managers;
class ExpenseManager extends BaseManager {

    public function getRules()
    {
        $rules = [         'fecha'=>'required',
                           'proveedor'=>'required',
                           'ruc'=>'required',
                           'direccion'=>'',
                           'numeroDocumento'=>'required',
                           'serie'=>'',
                           'MontoTotal'=>'',
                           'tipoDoc'=>'',
                           'montoPagado'=>'',
                           'Saldo'=>'',
                           'montoPagado'=>'',
                           'Saldo'=>''];
        return $rules;
    }}