<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;
use Salesfly\Salesfly\Repositories\EquivRepo;

class EquivController extends Controller
{
    protected $equivRepo;

    public function __construct(EquivRepo $equivRepo){
        $this->equivRepo = $equivRepo;
        $this->middleware('auth');
    }
    public function all(){
        return response()->json($this->equivRepo->all());
    }
    public function equivalencias($id){
    	$presentation = Presentation::find($id);
            $equiv = $presentation->equiv->load(['detAtr' => function ($query) {
                $query->orderBy('atribute_id', 'asc');
            },'product']);

    }
    public function find($id){
        $equiv=$this->equivRepo->select($id);
        return response()->json($equiv);
    }
}
