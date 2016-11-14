<?php
namespace Salesfly\Salesfly\Entities;

class DetPromotion extends \Eloquent {

	protected $table = 'detPromotions';
    
    protected $fillable = ['contador',
    						'activatorPromotion_id',
    						'detPre_id'
    						];
}