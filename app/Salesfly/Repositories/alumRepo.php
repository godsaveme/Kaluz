<?php
namespace Salesfly\Salesfly\Repositories;
use Salesfly\Salesfly\Entities\Estudiante;
 class alumRepo extends BaseRepo{
 	public function getModel(){
 		return new Estudiante;
 	}
 }