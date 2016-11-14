<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;
use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

use Salesfly\Salesfly\Repositories\PresentationRepo;
use Salesfly\Salesfly\Managers\PresentationManager;

use Salesfly\Salesfly\Repositories\EquivRepo;
use Salesfly\Salesfly\Managers\EquivManager;

class PresentationsController extends Controller
{
    protected $presentationRepo;
    protected $equivRepo;

    public function __construct(PresentationRepo $presentationRepo,EquivRepo $equivRepo)
    {
        $this->presentationRepo = $presentationRepo;
        $this->equivRepo = $equivRepo;
        $this->middleware('auth');
        //$this->middleware('role:admin');
    }

    public function create(Request $request)
    {
        $presentation = $this->presentationRepo->getModel();
        $request->merge(array('base' => '0'));
        $managerPre = new PresentationManager($presentation,$request->except('preBase_id','cant'));
        $managerPre->save();
        $request->merge(array('preFin_id' => $presentation->id));
        $equiv = $this->equivRepo->getModel();
        $managerEquiv = new EquivManager($equiv,$request->except('nombre','shortname','base'));
        $managerEquiv->save();

        return response()->json(['estado'=>true,'presentation' => $presentation,'equiv' => $equiv]);

    }

    public function all()
    {
        $presentations = $this->presentationRepo->all();
        return response()->json($presentations);
        //var_dump($customers);
    }
    public function findVariant($id){
        $presentations = $this->presentationRepo->select($id);
        return response()->json($presentations);
    }

    //todas las presentaciones base.
    public function all_base()
    {
        $presentations = $this->presentationRepo->all_base();
        return response()->json($presentations);
        //var_dump($customers);
    }
    public function all_by_base($id)
    {
        $presentations = $this->presentationRepo->all_by_base($id);
        return response()->json($presentations);
    }

}
