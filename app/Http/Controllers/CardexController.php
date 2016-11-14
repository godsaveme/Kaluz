 <?php
namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class CardexController extends Controller
{
 public function cardexUltimoDia($tipo,$fecha){
     // var_dump("hola commd");die();
        $database = \Config::get('database.connections.mysql');
        $time=time();
        $output = public_path() . '/report/'.$time.'_cardexUltimoDia';        
        $ext = "pdf";
        
        \JasperPHP::process(
            public_path() . '/report/cardexUltimoDia.jasper', 
            $output, 
            array($ext),
            //array(),
            //while($i<=3){};
            ['tipo'=>$tipo,'fecha'=>$fecha],//Parametros
              
            $database,
            false,
            false
        )->execute();
        return '/report/'.$time.'_cardexUltimoDia.'.$ext;
   
    }
}