<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 08/08/15
 * Time: 03:15 PM
 */

namespace Salesfly\Salesfly\Entities;


use Illuminate\Database\Eloquent\Model;

class Equiv extends Model{

    protected $table = 'equiv';

    protected $fillable = ['preBase_id','preFin_id','cant'];
} 