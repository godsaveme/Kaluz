<?php
namespace Salesfly\Salesfly\Entities;

class ActivatorPromotion extends \Eloquent {

	protected $table = 'activatorPromotions';
    
    protected $fillable = ['fechaPedido',
    						'fechaPrevista',
    						'cantidad',
    						'promotion_id'
    						];
}