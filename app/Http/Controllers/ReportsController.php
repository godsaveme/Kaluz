<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;

use Salesfly\Http\Requests;
use Salesfly\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    public function reportProduct($id)
    {
         return "hola";/*
                //
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_report4';
        
        $ext = "pdf";

        \JasperPHP::process(
            public_path() . '/report/report4.jasper', 
            $output, 
            array($ext),
            //array(),
            ['idProduct' => $id],//Parametros
            $database,
            false,
            false
        )->execute();
     
        /*header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$time.'_report4.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$ext));
        flush();
        
        readfile($output.'.'.$ext);*/
        //return "Hola";
        //return redirect('/report/'.$time.'_report4.'.$ext);
        //return '/report/'.$time.'_report4.'.$ext;
        //return $id;
    }
    public function reportTiket($id){

             //return $id;
        
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_tikets';
        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/tikets.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['idVariante' => $id],//Parametros
              
            $database,
            false,
            false
        )->execute();
    
   
        return '/report/'.$time.'_tikets.'.$ext;
    }
    
    public function reportProductWere($idStore,$idWerehouse)
    {
           return "hola"+$idStore+" "+$idWerehouse;     /*
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_reportProducts';
        
        $ext = "pdf";

        \JasperPHP::process(
            public_path() . '/report/reportProducts.jasper', 
            $output, 
            array($ext),
            //array(),
            ['idStore' => $idStore,'idWerehouse' => $idWerehouse],//Parametros
            $database,
            false,
            false
        )->execute();
     /*
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$time.'_reportProducts.'.$ext);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$ext));
        flush();
        
        readfile($output.'.'.$ext);

        */
       // return '/report/'.$time.'_reportProducts.'.$ext;
        
        //return $id;
    }
    
}
