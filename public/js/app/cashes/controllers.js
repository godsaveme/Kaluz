(function(){
    angular.module('cashes.controllers',[])
        .controller('CashesController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$window','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$window,$log){
                $scope.cashes = [];
                $scope.cash={};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.cashHeaders = {};
                $scope.cashHeader={};
                $scope.detCashes={};
                $scope.buscar;
                $scope.date = new Date(); 
                $scope.stores={};
                $scope.bandera=true;
                $scope.banderaAbrirCaja=false;
                $scope.mostrarCajas = function () {

                    crudService.search('searchHeaders',$scope.stores.id,1).then(function (data){
                        $scope.cashHeaders=data;
                    });
                    if ($scope.stores.id==undefined) {
                    crudService.search('cashes',0,1).then(function (data){
                        $scope.cashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $scope.verCaja();
                        });
                        $scope.banderaAbrirCaja=false;
                    }
                    
                };
                $scope.descriReport="Generar Reporte";
                $scope.generarReporteDetCash=function(){
                    
                     $scope.descriReport="Generarando...";
                    crudService.Reportes10('Reportedetcash',$routeParams.id).then(function (data){
                        if(data!=undefined){
                            $window.open(data);
                            $scope.descriReport="Generar Reporte";
                        }else{
                            alert("Error al generar reporte");
                        }
                    });
                 }
                $scope.cargarCajasDiarias = function () {
                    //if (true) {};
                    //alert($scope.cash.cashHeader_id);
                    if ($scope.cash.cashHeader_id!=undefined) {
                   crudService.search('cashes',$scope.cash.cashHeader_id,1).then(function (data){
                        $scope.cashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $scope.verCaja();
                    });
                    $scope.banderaAbrirCaja=true;
                    }else{
                        crudService.search('cashes',$scope.cash.cashHeader_id,1).then(function (data){
                        $scope.cashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $scope.verCaja();
                        });
                        $scope.banderaAbrirCaja=false;   
                    }
                     
                }

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                $scope.rutaMovimiento = function () {
                    $scope.rutaDetCash='/detCashes/create/'+$scope.cash.id; 
                };
                $scope.calculardescuadre = function () {
                    $scope.cash.descuadre=Number($scope.cash.montoReal)-Number($scope.cash.montoBruto);
                };
                $scope.caj_id=1;
                $scope.verCaja = function () {
                    $scope.cash1={};
                    if ($scope.cashes.length==0) {
                        alert("Caja Cerrada");
                        $scope.bandera=true;
                    }else{
                        //var canpag=Math.ceil($scope.totalItems/15);




                       // crudService.search('cashes',$scope.cash.cashHeader_id,canpag).then(function (data){

                            crudService.selectPost($scope.cash.cashHeader_id,'cashes','searchOpenCashxCashHeader').then(function(data){

                            //$scope.cashesedit = data;
                            //$scope.cash1=$scope.cashesedit[$scope.cashesedit.length-1];

                                if (data.length > 0){
                                    $scope.cash1 = data;
                                    alert("Caja Abierta");
                                    $scope.ruta='/cashes/edit/'+$scope.cash1.id;
                                    $scope.caj_id=$scope.cash1.id;
                                    $scope.bandera=false;
                                }
                                else
                                {
                                    alert("Caja Cerrada");
                                    $scope.bandera = true;
                                }

                        });
                    }

                };
                $scope.cerrarCaja = function () {
                    if($scope.cash.montoReal=='0.00'){
                        alert("Ingrese Monto Real");
                    }else{
                        //7alert($scope.date.getDate());
                        $scope.cash.fechaFin=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                            $scope.cash.estado='0';
                            //alert($scope.cash.fechaFin);
                            $log.log($scope.cash);
                        if ($scope.cashCreateForm.$valid) {  
                            
                        crudService.update($scope.cash,'cashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                
                                //$scope.success = data['nombres'];
                                alert('Caja Cerrada');
                                $location.path('/cashes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                        }
                    }
                };
                

                $scope.pageChanged = function() {
                    /*
                    if ($scope.query.length > 0) {
                        crudService.search('cashes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cashes = data.data;
                    });
                    }else{
                        crudService.paginate('cashes',$scope.currentPage).then(function (data) {
                            $scope.cashes = data.data;
                        });
                    }*/

                    if ($scope.cash.cashHeader_id!=null) {
                   crudService.search('cashes',$scope.cash.cashHeader_id,$scope.currentPage).then(function (data){
                        $scope.cashes = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                        //$scope.verCaja();
                    });
                    //$scope.banderaAbrirCaja=true;
                    }else{
                        crudService.paginate('cashes',$scope.currentPage).then(function (data) {
                            $scope.cashes = data.data;
                            $log.log("------------------");
                            $log.log($scope.cashes);
                            $log.log("------------------");
                        });  
                    }
                };
                //---------------------------------------------
                $scope.pageChanged1 = function() {
                    if ($scope.cash.id != 0) {
                        //alert("entre : "+$scope.cash.id)
                        crudService.search('detCashes',$scope.buscar,$scope.currentPage1).then(function (data){
                        $scope.detCashes = data.data;
                    });
                    }else{
                        crudService.paginate('detCashes',$scope.currentPage).then(function (data) {
                            $scope.detCashes = data.data;
                        });
                    }
                    //$log.log($scope.totalItems1);
                };
                //--------------------------------------------------


                
                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cashes').then(function (data) {
                        $scope.cash = data;
                        $scope.buscar=$scope.cash.id;
                        //$log.log($scope.cash);

                        crudService.search('detCashes',$scope.cash.id,1).then(function (data){
                           $scope.detCashes = data.data;
                           $scope.maxSize1 = 5;
                            $scope.totalItems1 = data.total;
                            $scope.currentPage1 = data.current_page;
                            $scope.itemsperPage1 = 15;
                            $log.log($scope.detCashes);

                            //$log.log($scope.detCashes);
                        });
                        
                    });
                    crudService.select('cashHeaders','select').then(function (data) {                        
                        $scope.cashHeaders = data;
                    });
                    //-------------------------------------------------------
                        crudService.paginate('detCashes',1).then(function (data) {
                            $scope.detCashes = data.data;
                            $scope.maxSize1 = 5;
                            $scope.totalItems1 = data.total;
                            $scope.currentPage1 = data.current_page;
                            $scope.itemsperPage1 = 15;
                            //$log.log(data);
                        });

                    //-------------------------------------------------------

                    
                }else{
                    crudService.paginate('cashes',1).then(function (data) {
                        $scope.cashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        //$scope.numPages1 =data.last_page;
                    });
                    //crudService.select('cashHeaders','select').then(function (data) {                        
                      //  $scope.cashHeaders = data;
                    //});
                    crudService.select('stores','select').then(function (data) {                        
                        $scope.stores = data;
                        $log.log($scope.stores);
                    });

                }

                socket.on('cashes.update', function (data) {
                    $scope.cashes=JSON.parse(data);
                });
                


                $scope.searchcash = function(){
                if ($scope.query.length > 0) {
                    //alert($scope.query);
                    crudService.search('cashes',$scope.query,1).then(function (data){
                        $scope.cashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cashes',1).then(function (data) {
                        $scope.cashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createcash = function(){
                    //$log.log($scope.cash.montoInicial);
                    //if ($scope.cashCreateForm.$valid) {
                    //alert('ho');
                    //var $btn = $('#btn_generate').button('loading');
                    if ($scope.cash.montoInicial==undefined) {
                        alert("Ingrese monto Inicio");
                    }else{
                       $scope.cash.fechaInicio=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.cash.estado='1'; 
                        $scope.cash.montoBruto=$scope.cash.montoInicial;
                        crudService.create($scope.cash, 'cashes').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                //$location.path('/cashes');
                                $scope.cargarCajasDiarias();

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                        
                    //}
                }

                $scope.editcash = function(row){
                    $scope.caj_id=row.id;
                 crudService.Comprueba_caj_for_user1(row.id).then(function (data){
              if(data.id!=undefined && data.id!=''){
                    
                       
                        $location.path('/cashes/edit/'+row.id);      
                    
                }else{
                    alert("usted no tiene permisos en esta caja");
                }});
                     //$scope.cash.montoInicial=parseInt($scope.cash.montoInicial);
                };

                $scope.updatecash = function(){
                   if ($scope.cashCreateForm.$valid) {
                        crudService.update($scope.cash,'cashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/cashes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletecash = function(row){
                    $scope.cash = row;
                    alert(row.nombre);
                }

                $scope.cancelcash = function(){
                    $scope.cash = {};
                }
                $scope.decriboton="Generar Reporte";
                $scope.GenReporteCajas=function(){
                    if($scope.fechainicio!=undefined && $scope.fechafin!=undefined){
                    $scope.fechainicio1=$scope.fechainicio.getFullYear()+"-"+($scope.fechainicio.getMonth()+1)+"-"+$scope.fechainicio.getDate();
                    $scope.fechafin2=$scope.fechafin.getFullYear()+"-"+($scope.fechafin.getMonth()+1)+"-"+$scope.fechafin.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decriboton="Generando..";
                     crudService.reporteRangFechas('ReportCashes',$scope.fechainicio1,$scope.fechafin2).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decriboton="Generar Reporte";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }

                $scope.destroycash = function(){
                    crudService.destroy($scope.cash,'cashes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cash = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
