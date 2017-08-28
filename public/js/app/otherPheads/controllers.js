(function(){
    angular.module('otherPheads.controllers',[])
        .controller('OtherPheadController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.otherPheads = [];
                $scope.otherPhead = {};
                $scope.otherPdetail = {};
                $scope.otherPdetails = [];
                $scope.pagos = {};
                $scope.listpagos ={};
                $scope.errors = null;
                $scope.Cambiarestado=false;
                $scope.success;
                $scope.query = '';
                $scope.otherPhead.tipoDoc="O";
                $scope.otherPhead.fecha=new Date();
                $scope.pagos.fecha= $scope.otherPhead.fecha;
                $scope.tipomodi="Compra"

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                 
                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('otherPheads',$scope.query,$scope.currentPage).then(function (data){
                        $scope.otherPheads = data.data;
                    });
                    }else{
                        crudService.paginate('otherPheads',$scope.currentPage).then(function (data) {
                            $scope.otherPheads = data.data;
                        });
                    }
                };
                $scope.pageChanged1 = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('otherPheads',$scope.query,$scope.currentPage).then(function (data){
                        $scope.otherPheads = data.data;
                    });
                    }else{
                        crudService.paginate('otherPheadsGastos',$scope.currentPage).then(function (data) {
                            $scope.expenses = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                	crudService.byId(id,'otherPdetails').then(function (data) {
                          	    	$scope.otherPdetails=data.data;
                          });
                    crudService.byId(id,'otherPheads').then(function (data) {
                        $scope.otherPhead = data;
                        $scope.otherPhead.fecha=new Date(data.fecha);
                        $scope.otherPhead.descuento=Number(data.descuento);
                        $scope.otherPhead.MontoSubTotal=Number(data.MontoSubTotal);
                        $scope.otherPhead.igv=Number(data.igv);
                        $scope.otherPhead.BaseImponible=Number(data.BaseImponible);
                        $scope.otherPhead.MontoTotal=Number(data.MontoTotal);
                        if($scope.otherPhead.checkIgv==1){$scope.otherPhead.checkIgv=true;}
                        else{
                        	$scope.otherPhead.checkIgv=false;
                        }

                    });

                    
                }else{
                    /*crudService.select('acounts','select').then(function (data) {
                       
                        $scope.cashMotives = data;
                    });*/
                    crudService.paginate('otherPheads',1).then(function (data) {
                        $scope.otherPheads = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                   
                }
                $scope.cargarCompras=function(){
                  crudService.paginate('otherPheads',1).then(function (data) {
                        $scope.otherPheads = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }
                $scope.cargarGastos=function(){
                   crudService.paginate('otherPheadsGastos',1).then(function (data) {
                        $scope.expenses = data.data;
                        $scope.maxSize1 = 5;
                        $scope.totalItems1 = data.total;
                        $scope.currentPage1 = data.current_page;
                        $scope.itemsperPage1 = 15;

                    });
                }
                if($location.path() == '/otherPheads/editGasto/'+id) {
                     $scope.tipomodi="Gasto";
                     crudService.Cuentas(id,'detalleGastos').then(function (data) {
                                  $scope.otherPdetails=data.data;
                          
                     crudService.byId(id,'gastos').then(function (data) {
                        $scope.otherPhead = data;
                        $scope.otherPhead.fecha=new Date(data.fecha);
                        $scope.otherPhead.MontoTotal=Number(data.MontoTotal);
                    });
                    /*crudService.select('acounts','select').then(function (data) {
                       
                        $scope.cashMotives = data;
                    });*/
                    });
                      
                 }
                /*socket.on('otherPhead.update', function (data) {
                    $scope.otherPheads=JSON.parse(data);
                });*/
                 if($location.path() == '/otherPheads/balance') {
                     $scope.pagos.fecha1=new Date();
                      
                 }
                 $scope.consultarBalance=function(){
                  $scope.pagos.fecha10=$scope.pagos.fecha1.getFullYear()+'-'+($scope.pagos.fecha1.getMonth()+1)+'-'+$scope.pagos.fecha1.getDate();
                   $scope.pagos.fecha12=$scope.pagos.fecha2.getFullYear()+'-'+($scope.pagos.fecha2.getMonth()+1)+'-'+$scope.pagos.fecha2.getDate();
                  
                   //alert($scope.pagos.fecha10);
                   //alert($scope.pagos.fecha12);
                      crudService.balance('payments',$scope.pagos.fecha10,$scope.pagos.fecha12).then(function (data) {
                         $scope.Compras=data[0];
                      });
                      crudService.balance('payments3',$scope.pagos.fecha10,$scope.pagos.fecha12).then(function (data) {
                         $scope.OtrasCompras=data[0];
                         crudService.balance('payments2',$scope.pagos.fecha10,$scope.pagos.fecha12).then(function (data) {
                         $scope.CajaMensual=data[0];
                         $scope.CajaMensual.total=Number($scope.CajaMensual.totPagado)+Number($scope.OtrasCompras.montototal);
                         });
                      });
                      
                      crudService.balance('payments5',$scope.pagos.fecha10,$scope.pagos.fecha12).then(function (data) {
                         $scope.CjaDiraria=data[0];
                      });
                      crudService.balance('payments6',$scope.pagos.fecha10,$scope.pagos.fecha12).then(function (data) {
                         $scope.VentasFactu=data[0];
                      });
                 }
               if($location.path() == '/otherPheads/show/'+$routeParams.id) {
               	$scope.pagos.idpago=id;
               	crudService.byId(id,'pagos2').then(function (data) {                	 	 
                   	 	
                   	 $scope.spagado=Number(data);
                   	 crudService.byId(id,'otherPheads').then(function (data) {
                        $scope.otherPhead = data;
                        $scope.otherPhead.fecha=new Date(data.fecha);
                        $scope.otherPhead.descuento=Number(data.descuento);
                        $scope.otherPhead.documento=data.tipoDoc+"-"+data.numeroDocumento;
                        $scope.otherPhead.MontoSubTotal=Number(data.MontoSubTotal);
                        $scope.otherPhead.igv=Number(data.igv);
                        $scope.otherPhead.BaseImponible=Number(data.BaseImponible);
                        $scope.otherPhead.MontoTotal=Number(data.MontoTotal);
                        if($scope.otherPhead.checkIgv==1){$scope.otherPhead.checkIgv=true;}
                        else{
                        	$scope.otherPhead.checkIgv=false;
                        }
                       $scope.otherPhead.saldo=Number($scope.otherPhead.MontoTotal)-Number($scope.spagado);
                    });
                   	 });
                   	  $scope.tot=0
                   	 crudService.byId(id,'pagos').then(function (data) {
                   	 	 $scope.listpagos=data.data;
                   	 });
                   	 
                   	  crudService.listaCashes('cashHeaders',1).then(function (data) {
                                      $scope.cashHeaders = data;
                                      //alert(data.id);
                                  });

                 }
                  if($location.path() == '/otherPheads/show2/'+$routeParams.id) {
                $scope.pagos.idpago=id;
                                 
                      
                     
                     crudService.byId(id,'gastos').then(function (data) {
                        $scope.otherPhead = data;
                        $scope.otherPhead.fecha=new Date(data.fecha);
                        $scope.otherPhead.documento=data.tipoDoc+"-"+data.numeroDocumento;
                        $scope.otherPhead.igv=Number(data.igv);
                        $scope.otherPhead.MontoTotal=Number(data.MontoTotal);
                        $scope.otherPhead.saldo=Number(data.Saldo);
                       
                       //$scope.otherPhead.saldo=Number($scope.otherPhead.MontoTotal)-Number($scope.spagado);
                    });
                     
                      $scope.tot=0
                     crudService.byId(id,'pagos3').then(function (data) {
                       $scope.listpagos=data.data;
                     });
                     
                      crudService.listaCashes('cashHeaders',1).then(function (data) {
                                      $scope.cashHeaders = data;
                                      //alert(data.id);
                                  });

                 }
                 //$scope.tot=0
                 //$scope.otherPhead.saldo=0;
                $scope.validad=function(num){
                     if($scope.pagos.monto<=$scope.otherPhead.saldo){
                     	if($scope.pagos.cashe_id!=null){
                          if($scope.pagos.monto<=Number($scope.pagos.montoUsable)){
                            
                     	   }else{
                     	   	  alert('Monto es superior al saldo de caja');
                     	      $scope.pagos.monto='';
                     	   }
                     	}
                     }else{
                     	alert('Monto es superior al saldo ingrese nuevamente');
                     	$scope.pagos.monto='';
                     }
                }
                $scope.limpiar=function(){
                	$scope.pagos.monto='';
                }
                $scope.TraerSales=function(id){
                  //alert(id);
                          $scope.pagos.monto='';
                          crudService.Comprueba_caj_for_user1(id).then(function (data) {
                                     //alert($scope.otherPhead.cashe_id);
                                      if(data!=null){

                                         $scope.pagos.montoUsable=data.montoBruto;
                                      }else{
                                      	alert("No existe una caja abierta con este usuario!!");
                                      	$scope.otherPhead.cashe_id="";
                                      }
                                  });
                }
                $scope.searchotherPhead = function(){
                if ($scope.query.length > 0) {
                    crudService.search('otherPheads',$scope.query,1).then(function (data){
                        $scope.otherPheads = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('otherPheads',1).then(function (data) {
                        $scope.otherPheads = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.otherPhead.MontoSubTotal=0;
                 $scope.otherPhead.descuento=0;
                $scope.llenarDetalles=function(){  
                	 if ($scope.otherPdetail.cantidad>0 && $scope.otherPdetail.PrecioUnit>0
                	 	&& $scope.otherPdetail.PrecioFinal>0 && $scope.otherPdetail.descripcion.length>0) {
                     $scope.Cambiarestado=true;
                      $scope.otherPhead.MontoSubTotal=$scope.otherPhead.MontoSubTotal+$scope.otherPdetail.PrecioFinal; 
                      $scope.activIgvtotal();
                      $scope.otherPdetails.push($scope.otherPdetail);
                      $scope.otherPdetail = {};
                  }else{
                  	alert("llene todos los campos");
                  }
                }
                $scope.llenarDetalles2=function(){  
                  //alert($scope.otherPdetail.acount_id);
                   if ($scope.otherPdetail.total>0 && $scope.otherPdetail.acount_id>0) {
                       $scope.Cambiarestado=true;
                      crudService.Cuentas($scope.otherPdetail.acount_id,'cashMotives').then(function (data) {
                        
                      $scope.otherPdetail.nomCuenta=data['nombre'];                    
                      $scope.calcularGastosIgv();
                      $scope.otherPdetails.push($scope.otherPdetail);
                      $scope.otherPdetail = {};
                      });
                  }else{
                    alert("llene todos los campos");
                  }
                }
                $scope.calcularGastosIgv=function(){
                  $scope.otherPhead.total=Number(($scope.otherPdetail.total/1.18).toFixed(2));
                  $scope.otherPdetail.igv=Number((Number($scope.otherPdetail.total)-Number($scope.otherPhead.total)).toFixed(2));
                  if($scope.otherPhead.MontoTotal>0){
                  $scope.otherPhead.MontoTotal=Number($scope.otherPhead.MontoTotal)+Number($scope.otherPdetail.total); 
                  $scope.verificar();
                  }else{$scope.otherPhead.MontoTotal=$scope.otherPdetail.total; $scope.verificar();}
                }
                $scope.calcMontosFinales=function(){
                	  //$scope.otherPhead.MontoSubTotal=$scope.otherPhead.MontoSubTotal+$scope.otherPdetail.PrecioFinal; 
                      $scope.activIgvtotal();
                      
                }
                $scope.otherPhead.checkIgv=false;
                $scope.activIgvtotal=function(){
                	if($scope.otherPhead.checkIgv==true){
                      $scope.total=Number(($scope.otherPhead.MontoSubTotal-(($scope.otherPhead.MontoSubTotal*$scope.otherPhead.descuento)/100)).toFixed(2))
                      $scope.otherPhead.igv=Number(($scope.total-($scope.total/1.18)).toFixed(2));
                      $scope.otherPhead.BaseImponible=Number(($scope.total/1.18).toFixed(2));             
                      $scope.otherPhead.MontoTotal=$scope.otherPhead.BaseImponible+$scope.otherPhead.igv;
                	}else{
                	  $scope.total=Number(($scope.otherPhead.MontoSubTotal-(($scope.otherPhead.MontoSubTotal*$scope.otherPhead.descuento)/100)).toFixed(2))
                      $scope.otherPhead.igv=$scope.total*0.18;
                      $scope.otherPhead.BaseImponible=$scope.otherPhead.MontoSubTotal;             
                      $scope.otherPhead.MontoTotal=$scope.otherPhead.BaseImponible+$scope.otherPhead.igv;
                     
                	}
                }
                $scope.calcMontosFinales2=function(){
                	  //$scope.otherPhead.MontoSubTotal=$scope.otherPhead.MontoSubTotal+$scope.otherPdetail.PrecioFinal; 
                	  var tot=$scope.otherPhead.MontoSubTotal-$scope.otherPhead.MontoTotal;
                	  //alert(tot);
                      $scope.otherPhead.descuento=Number(((tot/$scope.otherPhead.MontoSubTotal)*100).toFixed(2));
                     // $scope.total=Number(($scope.otherPhead.MontoSubTotal-(($scope.otherPhead.MontoSubTotal*$scope.otherPhead.descuento)/100)).toFixed(2))
                      $scope.activIgvtotal();            
                      //$scope.otherPhead.MontoTotal=$scope.otherPhead.BaseImponible+$scope.otherPhead.igv;
                      
                }
                $scope.sacarRow2=function(index,monto){
                  
                  $scope.otherPhead.MontoTotal=Number($scope.otherPhead.MontoTotal)-Number(monto);
                  
                  $scope.otherPdetails.splice(index,1);
                }
                $scope.sacarRow=function(index,monto){
                  
                  $scope.otherPhead.MontoSubTotal=Number(($scope.otherPhead.MontoSubTotal-monto).toFixed(2));
                  if($scope.otherPhead.checkIgv==true){
                      $scope.total=Number(($scope.otherPhead.MontoSubTotal-(($scope.otherPhead.MontoSubTotal*$scope.otherPhead.descuento)/100)).toFixed(2))
                      $scope.otherPhead.igv=Number(($scope.total-($scope.total/1.18)).toFixed(2));
                      $scope.otherPhead.BaseImponible=Number(($scope.total/1.18).toFixed(2));             
                      $scope.otherPhead.MontoTotal=$scope.otherPhead.BaseImponible+$scope.otherPhead.igv;
                  }else{
                    $scope.total=Number(($scope.otherPhead.MontoSubTotal-(($scope.otherPhead.MontoSubTotal*$scope.otherPhead.descuento)/100)).toFixed(2))
                      $scope.otherPhead.igv=$scope.total*0.18;
                      $scope.otherPhead.BaseImponible=$scope.otherPhead.MontoSubTotal;             
                      $scope.otherPhead.MontoTotal=$scope.otherPhead.BaseImponible+$scope.otherPhead.igv;
                     
                  }
                  $scope.otherPdetails.splice(index,1);
                }
                $scope.clalcSubtotal=function(){
                	if($scope.otherPdetail.cantidad!=undefined && $scope.otherPdetail.PrecioUnit!=undefined){
                	$scope.otherPdetail.PrecioFinal=Number(($scope.otherPdetail.cantidad*$scope.otherPdetail.PrecioUnit).toFixed(2));
                    }
                }
                 $scope.validanomMarca=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('otherPheads',texto).then(function (data){
                        $scope.otherPhead = data;
                        if($scope.otherPhead!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.otherPhead.nombre=''; 
                           $scope.otherPhead.shortname=''; 
                        }
                    });
                    }
               }

                $scope.createotherPhead = function(){
                    //$scope.atribut.estado = 1;
                    $scope.otherPhead.fecha=$scope.otherPhead.fecha.getFullYear()+'-'+($scope.otherPhead.fecha.getMonth()+1)+'-'+$scope.otherPhead.fecha.getDate()+' '+$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                    $scope.otherPhead.detalles=$scope.otherPdetails;
                    if($scope.tipomodi=="Compra"){
                    //if ($scope.otherPheadCreateForm.$valid) {
                        crudService.create($scope.otherPhead, 'otherPheads').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/otherPheads');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }else{

                         crudService.create($scope.otherPhead, 'gastos').then(function (data) {
                          
                            if (data['estado'] == true) {
                                alert('grabado correctamente');
                                $location.path('/otherPheads');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }
                $scope.cancelCreatePago=function(){
                	$location.path('/otherPheads');
                }
                $scope.createPagos = function(){
                    //$scope.atribut.estado = 1;
                    if($scope.pagos.monto>0){
                    if($scope.pagos.cajamensual==true){
                        $scope.pagos.fecha=$scope.pagos.fecha.getFullYear()+'-'+($scope.pagos.fecha.getMonth()+1)+'-'+$scope.pagos.fecha.getDate()+' '+$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                       
                    }else{
                    	$scope.pagos.fecha=$scope.pagos.fecha.getFullYear()+'-'+($scope.pagos.fecha.getMonth()+1)+'-'+$scope.pagos.fecha.getDate();
                    	$scope.pagos.hora=$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                    }
                    
                    //if ($scope.otherPheadCreateForm.$valid) {
                        crudService.create($scope.pagos, 'pagosVarios').then(function (data) {
                         
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/otherPheads');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    //}
                }else{
                	alert('Por favor ingrese un monto mayor a cero');
                }
                }
                 $scope.createPagos2 = function(){
                    //$scope.atribut.estado = 1;
                    if($scope.pagos.monto>0){
                    if($scope.pagos.cajamensual==true){
                        $scope.pagos.fecha=$scope.pagos.fecha.getFullYear()+'-'+($scope.pagos.fecha.getMonth()+1)+'-'+$scope.pagos.fecha.getDate()+' '+$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                       
                    }else{
                      $scope.pagos.fecha=$scope.pagos.fecha.getFullYear()+'-'+($scope.pagos.fecha.getMonth()+1)+'-'+$scope.pagos.fecha.getDate();
                      $scope.pagos.hora=$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                    }
                    
                    //if ($scope.otherPheadCreateForm.$valid) {
                        crudService.create($scope.pagos, 'gastos5').then(function (data) {
                         
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/otherPheads');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    //}
                }else{
                  alert('Por favor ingrese un monto mayor a cero');
                }
                }
                $scope.editotherGasto = function(row){
                    $location.path('/otherPheads/editGasto/'+row.id);
                };
                $scope.editotherPhead = function(row){
                    $location.path('/otherPheads/edit/'+row.id);
                };
                $scope.pagarVentana = function(row){
                    $location.path('/otherPheads/show/'+row.id);
                };
                $scope.pagarVentana2 = function(row){
                    $location.path('/otherPheads/show2/'+row.id);
                };

                $scope.updateotherPhead = function(){
                    $scope.otherPhead.fecha=$scope.otherPhead.fecha.getFullYear()+'-'+($scope.otherPhead.fecha.getMonth()+1)+'-'+$scope.otherPhead.fecha.getDate()+' '+$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                    $scope.otherPhead.detalles=$scope.otherPdetails;
                    //if ($scope.otherPheadCreateForm.$valid) {
                        crudService.update($scope.otherPhead,'otherPheads').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/otherPheads');
                            }else{
                                $scope.errors =data;
                            }
                        });
                   // }
                };
                $scope.updateGastos = function(){
                    $scope.otherPhead.fecha=$scope.otherPhead.fecha.getFullYear()+'-'+($scope.otherPhead.fecha.getMonth()+1)+'-'+$scope.otherPhead.fecha.getDate()+' '+$scope.otherPhead.fecha.getHours()+':'+$scope.otherPhead.fecha.getMinutes()+':'+$scope.otherPhead.fecha.getSeconds();
                    $scope.otherPhead.detalles=$scope.otherPdetails;
                    //if ($scope.otherPheadCreateForm.$valid) {
                        crudService.update($scope.otherPhead,'gastos').then(function(data)
                        {
                            if(data['estado'] == true){
                                alert('editado correctamente');
                                $location.path('/otherPheads');
                            }else{
                                $scope.errors =data;
                            }
                        });
                   // }
                };

                $scope.deleteotherPhead = function(row){
                    $scope.otherPhead = row;
                }


                $scope.cancelotherPhead = function(){
                    $scope.otherPhead = {};
                }

                $scope.destroyotherPhead = function(){

                    crudService.destroy($scope.otherPhead,'otherPheads').then(function(data)
                    {
                        if(data['estado'] == true){
                            
                            $scope.otherPhead = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.destroyGastos = function(row){

                    crudService.destroy(row,'gastos').then(function(data)
                    {
                        if(data['estado'] == true){
                            
                            $scope.otherPhead = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.verificar=function(){
                  $scope.montoSinIGV=Number(($scope.otherPhead.MontoTotal/1.18).toFixed(2));
                  $scope.igv=Number(($scope.otherPhead.MontoTotal-$scope.montoSinIGV).toFixed(2));
                }
                $scope.destroyPagos2 = function(row){

                    crudService.destroy(row,'pagosGastos').then(function(data)
                    {
                        if(data['estado'] == true){
                            
                            alert(data["nota"]);
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                 $scope.destroyPagos = function(row){

                    crudService.destroy(row,'pagos').then(function(data)
                    {
                        if(data['estado'] == true){
                            
                            alert(data["nota"]);
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
