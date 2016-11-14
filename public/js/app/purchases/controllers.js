(function(){
    angular.module('purchases.controllers',[])
        .controller('PurchaseController',['$window','ngProgressFactory','$scope','$http' ,'$routeParams','$location','crudOPurchase','socketService' ,'$filter','$route','$window','$log',
            function($window,ngProgressFactory,$scope,$http, $routeParams,$location,crudOPurchase,socket,$filter,$route,$window,$log){
                $scope.progressbar = ngProgressFactory.createInstance();
                $scope.purchases = [];
                $scope.purchase = {};
                $scope.payments=[];
                $scope.payment={};
                $scope.supplier={};
                $scope.methodPayments=[];
                $scope.methodPayment={};
                $scope.detPayment={};
                $scope.inputStocks=[];
                $scope.inputStock={};
                $scope.headInputStocks=[];
                headInputStock={};
                $scope.products=[];
                $scope.product={};
                $scope.pendientAccounts=[];
                $scope.pendientAccount={};
                $scope.cashHeaders=[];
                $scope.cashHeader={};
                $scope.atributes=[];
                $scope.atribute={};
                $scope.almacenes={};
                $scope.date=new Date();
                //$scope.idProvicional;
                $scope.totAnterior;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores=[];
                $scope.store={};
                $scope.purchase.store_id='1';
                $scope.date=new Date();
                $scope.botonReporte = 'Generar Reportes de Ticket';
                 $scope.botonReporteCod = 'Generar Reportes de Sku';
                //------------------------------------------------
             
                //-------------------------------------------------

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                $scope.pagechan4=function(){
                    crudOPurchase.paginate('pendientAccounts',$scope.currentPage).then(function (data) {
                         $scope.pendientAccounts = data.data;
                    }); 
                }
                $scope.pagechan3=function(){
                    //alert(idobcional);
                    crudOPurchase.paginate('detPayments',$scope.currentPage).then(function (data) {
                            $scope.detPayments = data.data;
                        });
                }
                $scope.pagechan2=function(){
                    crudOPurchase.paginate('inputStocks',$scope.currentPage).then(function (data) {
                            $scope.headInputStocks = data.data;
                        });
                }
                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudOPurchase.search('purchases',$scope.query,$scope.currentPage).then(function (data){
                        $scope.purchases = data.data;
                    });
                    }else{
                        crudOPurchase.paginate('purchases',$scope.currentPage).then(function (data) {
                            $scope.purchases = data.data;
                        });
                    }
                };
                var id = $routeParams.id;
                var idobcional;
                if(id)
                {
                    if($location.path() == '/purchases/edit/'+$routeParams.id) {
                    crudOPurchase.byId(id,'purchases').then(function (data) {
                            if(data.fechaEntrega != null) {
                              if (data.fechaEntrega.length > 0) {
                                $scope.purchases.fechaEntrega = new Date(data.fechaEntrega);
                              }
                            }
                             $scope.purchases = data;
                             $scope.purchase.montoBruto=parseFloat(data.montoBruto);
                             $scope.purchase.montoTotal=parseFloat(data.montoTotal);
                             $scope.purchase.descuento=parseFloat(data.descuento); 
                              $scope.purchase.montoBase=parseFloat(data.montoBase);
                               $scope.purchase.igv=parseFloat(data.igv);
                         
                          crudOPurchase.paginateDPedido(data.id,'detailPurchases').then(function (data) {
                             $scope.detailPurchases = data.data;
                             $scope.maxSize = 5;
                             $scope.totalItems = data.total;
                             $scope.currentPage = data.current_page;
                             $scope.itemsperPage = 15;
                       
                           });
                      });
                     };
                    if($location.path() == '/purchases/show/'+$routeParams.id) {
                        crudOPurchase.select2('payments',id).then(function (data){
                               $scope.payment = data;
                               $scope.idProvicional=data.id;
                               $scope.totAnterior=data.Acuenta;
                            if(Number($scope.payment.Acuenta)>0){
                                  $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                            }else{$scope.payment.PorPagado=0;}
                                  $scope.random();
                                  idobcional=data.id;
                        crudOPurchase.byId($scope.payment.id,'detPayments',1).then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                        });
                        crudOPurchase.byId(id,'purchases').then(function (data) {
                            $scope.purchase=data;
                            $scope.alamcenId=data.warehouses_id;
                            $scope.payment.purchase_id=data.id;
                            crudOPurchase.byId(data.supplier_id,'suppliers').then(function (data) {
                                 $scope.supplier=data;
                                $scope.payment.supplier_id=data.id;
                            });
                        crudOPurchase.listaCashes('cashHeaders',$scope.alamcenId).then(function (data) {
                            $scope.cashHeaders = data;
                        
                        });
                });
                        crudOPurchase.paginate('methodPayments',1).then(function (data) {
                        $scope.methodPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                      $scope.detPayment.fecha=new Date();
                    };
                }else{
                    crudOPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    
                   
                }

                socket.on('purchase.update', function (data) {
                    $scope.purchases=JSON.parse(data);
                });
                $scope.estado;

             /*   $scope.searchEstados=function(){
                    alert($scope.estado);
                    crudOPurchase.all('detailOrderPurchases',$scope.estado).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });methodPayments
                }*/

                crudOPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                     });
                if($location.path() == '/purchases/createMov') {
                    $scope.purchase.fecha=new Date();
                     crudOPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                     crudOPurchase.autocomplit('products',1).then(function (data) {
                        $scope.products = data.data;
                    });
                     $scope.purchase.tipo='Entrada';
                }
                $scope.limpiarStocks=function(){
                    $location.path('/purchases/createMov/');
                    
                    //$scope.inputStocks=[];
                  /*  alert("hola");
                    $scope.product.proId="";
                    $scope.mostrarCreate=false;
                    $scope.check=false;
                    $scope.Listo=true;
                    $scope.purchase.tipo="Entrada";
                    $scope.purchase.warehouses_id=''; 
                    $scope.purchase.warehouDestino_id='';
                    $scope.inputStock={};
                    $scope.inputStocks=[];
                    $scope.company={};
                    $scope.companies=[];*/
                }

                $scope.editCompra = function(row){
                    $location.path('/purchases/edit/'+row.id);
                };
                 $scope.verOrden= function(row){
                    $location.path('/orderPurchases/edit/'+row.orderPurchase_id);
                };
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudOPurchase.search('purchases',$scope.query,1).then(function (data){
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                    $scope.purchase.fechaini=null;
                    $scope.purchase.fechafin=null;
                }else{
                    crudOPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                if($location.path() == '/purchases/showD') {
                    crudOPurchase.paginate('pendientAccounts',1).then(function (data) {
                        $scope.pendientAccounts = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudOPurchase.autocomplit2('cashHeaders').then(function (data) {
                        $scope.cashHeaders = data;
                        
                        });
                }
                if($location.path() == '/purchases/create') {
                    crudOPurchase.paginate('inputStocks',1).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudOPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                     crudOPurchase.autocomplit('products',1).then(function (data) {
                        $scope.products = data.data;
                       
                       
                    });
                   /*crudOPurchase.autocomplit2('products',1).then(function (data) {
                        $scope.products = data.data;
                    });*/
                    $scope.purchase.fecha=new Date();
                    $scope.purchase.tipo="Entrada";
               }
               if($location.path() == '/purchases/cardex')
               {
                crudOPurchase.todos("products").then(function (data){
                   $scope.products=data;
                 });
                crudOPurchase.paginatVariants("variants").then(function (data){
                   $scope.variants1=data;
                 });
                crudOPurchase.todos("warehouses").then(function (data){
                   $scope.almacenes=data;
                   $scope.purchase.almacen='1';
                 });
                crudOPurchase.todos("stores").then(function (data){
                   $scope.stores=data.data;
                   $scope.purchase.tienda='1';
                 });
                 $scope.purchase.tipoMov2="Compra";
               }
                $scope.TraerPorSku=function(sku){

                    crudOPurchase.autocomplitVar('variants',sku).then(function (data) {
                       //$scope.product.proId11 = data;
                       $scope.comproStock.producto=data.proCodigo+"-"+data.proNombre+"("+data.BraName+"/"+data.NombreAtributos+")";
                       $scope.comproStock.stockActual=data.stockActual;
                       $scope.comproStock.stockActualID=data.id;
                  });
               }
               /* $scope.Inventario=function(){
              $scope.comproStock.producto=$scope.producto.proId.proCodigo+'-'+$scope.producto.proId.proNombre+
              '('+($scope.producto.proId.BraName==null ? '': $scope.producto.proId.BraName+'/')+($scope.producto.proId.TName==null ? '' : $scope.producto.proId.TName+'/')+($scope.producto.proId.Mnombre==null ? '':$scope.producto.proId.Mnombre+'/')+($scope.producto.proId.NombreAtributos==null ? '':$scope.producto.proId.NombreAtributos)+')';
                 //alert($scope.producto.proId);
                  crudOPurchase.StockActual("stocks",$scope.producto.proId.varid,$scope.purchase.almacen).then(function (data){
                   $scope.comproStock.stockActual=data.stockActual;
                   $scope.comproStock.stockActualID=data.id;
                });
                }*/
               $scope.mostrarCreate=false;
               $scope.ver=function(){
                   if ($scope.inputStocksCreateForm.$valid) {
                   $scope.mostrarCreate=!$scope.mostrarCreate;
                   }else{
                    alert("Complete Todos los Campos");
                   }
               }
                $scope.comproStock={};
                $scope.Inventario=function(){
              $scope.comproStock.producto=$scope.producto.proId100.proCodigo+'-'+$scope.producto.proId100.proNombre+
              '('+($scope.producto.proId100.BraName==null ? '': $scope.producto.proId100.BraName+'/')+($scope.producto.proId100.TName==null ? '' : $scope.producto.proId100.TName+'/')+($scope.producto.proId100.Mnombre==null ? '':$scope.producto.proId100.Mnombre+'/')+($scope.producto.proId100.NombreAtributos==null ? '':$scope.producto.proId100.NombreAtributos)+')';
                 //alert($scope.producto.proId);
                  crudOPurchase.StockActual("stocks",$scope.producto.proId100.varid,$scope.purchase.almacen).then(function (data){
                   $scope.comproStock.stockActual=data.stockActual;
                   $scope.comproStock.stockActualID=data.id;
                });
                }
                $scope.objectto=[];
                $scope.ActualizarStock=function(){
                  if($scope.comproStock.stockActual==$scope.comproStock.stockReal){
                      $scope.limpiarCardex();
                  }else{
                 $scope.objectto.push($scope.comproStock);
                 $scope.comproStock={};
                 if($scope.check==true){
                 $scope.producto.proId100='';
                 }else{
                  $scope.variant.sku='';
                 }
               }
                }
                $scope.limpiarCardex=function(){
                  $scope.comproStock={};
                 $scope.producto.proId="";
                }
                $scope.ListarinputStocks=function(row){
                
                crudOPurchase.byId(row.id,'inputStocks').then(function (data){
                            $scope.inputStocks=data.data;
                });
                }
                $scope.verStockActual1=function(){
                   
                    crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                            $scope.stock=data;
                            $scope.inputStock.CantidaStock=data.stockActual;
                            
                   });
                }
               $scope.verStockActual=function(){
                if($scope.purchase.tipo=="Salida" || $scope.purchase.tipo=="Transferencia"){
                            if($scope.inputStock.CantidaStock<$scope.inputStock.cantidad_llegado || $scope.inputStock.cantidad_llegado<=0){
                                 alert("error esta cantidad es incorrecta no existe en stock");
                                 $scope.inputStock.cantidad_llegado='';
                            }
                }
               }
               //$scope.orderPurchase.eliminar=0;
               $scope.verEdicion=false;
               $scope.canselarEditDeudas=function(){
                $scope.verEdicion=false;
                   $scope.indexPirata=-1;
               }
               $scope.EditarDeudas=function(index){
                    $scope.indexPirata=index;
                    $scope.verEdicion=true;
               }
              $scope.saldoAnterior=0;
               $scope.ActualizarSaldo=function(row,nuevoSaldo){

                    if(Number(row.Saldo) >=nuevoSaldo){
                      if($scope.saldoAnterior==0){$scope.saldoAnterior=Number(row.Saldo);}
                      row.Saldo=parseFloat(($scope.saldoAnterior-nuevoSaldo).toFixed(2));
                      if(row.Saldo==0){
                        row.estado=1;
                      }
                    }else{
                        alert("ERROR: el Monto ingresado no debe superar la deuda");
                    }
               }
               $scope.row={};
               $scope.CuentasAFavor=function(row){
                row.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                row.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                crudOPurchase.update(row, 'pendientAccounts').then(function (data) {
                            if (data['estado'] == true) {
                                alert('Cuenta Editada Correctamente');
                                $scope.verEdicion=false;
                                $scope.indexPirata=-1;
                                $scope.saldoAnterior=0;
                            } else {
                                $scope.errors = data;

                            }
                        });
               }
               $scope.sacarRowStock=function(index){
                   $scope.inputStocks.splice(index,1);
               }
               $scope.companies=[];
               $scope.company={};
               $scope.badera=true;
               $scope.cantidad=[];
               $scope.calCantidad=function(index,stockActual,atributos,sku,varCodigo,can,talla,TieneVariante){
               // alert(can);
                //item.NombreAtributos,item.varSku,item.varCodigo,cantidad,item.valorDetAtr,item.TieneVariante
                       // alert(talla);
                        if(can>0 && $scope.purchase.tipo=='Entrada'){
                    
                         
                         if($scope.companies[0]!=undefined){
                             for(var n=0;n<$scope.companies.length;n++){
                                 if($scope.companies[n].talla==talla){
                                 $scope.companies[n].cantidad_llegado=can;
                                 $scope.badera=false;                      
                               }
                             }
                         }
                     if($scope.badera==true){
                       
                      $scope.company.variant_id=varCodigo;
                     //$scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                      //====================Traendo Presentacion==============================
                      crudOPurchase.select('detpres',varCodigo).then(function (data) {
                                    $scope.company.codigo=data.codigo;
                                    $scope.company.esbase=data.esbase;
                                    if(atributos!=null){
                                       // alert("estoy aqui");
                                    $scope.company.producto=$scope.inputStock.proNombre+"("+atributos+")";
                                   }else{
                                    $scope.company.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.varCodigo+")";
                                   }
                                    $scope.company.detPres_id=data.detpresen_id;
                                    $scope.company.cantidad_llegado=can;
                                    $scope.company.talla=talla;
                                    $scope.companies.push($scope.company);
                                    $scope.company={};
                                    
                                    
                        });
                    }
                
                     }else{
                        if(can>0 && can<=stockActual){
                             $scope.badera=true;
                             if($scope.companies[0]!=undefined){
                             for(var n=0;n<$scope.companies.length;n++){
                                //alert("jsdjdskdsk"+$scope.companies[n].talla+"--->"+talla);
                                 if($scope.companies[n].talla==talla){
                                  $scope.companies[n].cantidad_llegado=can;
                                  $scope.badera=false;                      
                               }
                             }}
                    if($scope.badera==true){
                       // alert("hey ahora jsdkd");
                    $scope.company.variant_id=varCodigo;
                     crudOPurchase.select('detpres',varCodigo).then(function (data) {
                                   $scope.company.codigo=data.codigo;
                                   $scope.company.esbase=data.esbase;
                                   $scope.company.detPres_id=data.detpresen_id;
                                   $scope.company.cantidad_llegado=can;
                                   $scope.company.talla=talla;
                                   if(atributos!=null){
                                       // alert("estoy aqui");
                                    $scope.company.producto=$scope.inputStock.proNombre+"("+atributos+")";
                                   }else{
                                    $scope.company.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.varCodigo+")";
                                   }
                                   $log.log($scope.company);
                                   $scope.companies.push($scope.company);
                                   $scope.company={};
                                    
                                    
                        });
                      //====================Fin========================================
                     //$scope.detailOrderPurchases.push($scope.detailOrderPurchase); 
                     }
                        }else{
                            //$scope.cantidad='';
                             alert("Ingrese Cantidad mayor a cero o Ingrese Cantidad que no supere el Stock Actual!!!!");
                             $scope.cantidad[index]='';
                             if($scope.companies[0]!=undefined){
                             for(var n=0;n<$scope.companies.length;n++){
                                 if($scope.companies[n].talla==talla){
                                   $scope.companies.splice(n,1);
                                   break;
                                 //$scope.companies[n].cantidad_llegado=can;
                                 //$scope.badera=false;                      
                               }
                             }
                         }
                         }
                     }
                  }
                  
                  $scope.noreapeatrow=function(){
                    $scope.num=true;
                  if($scope.check==false){
                    if($scope.inputStocks[0]!=undefined && $scope.purchase.tipo!="Entrada"){
                             for(var n=0;n<$scope.inputStocks.length;n++){
                              //alert("hola1"+$scope.inputStocks[n].producto+$scope.company.producto);
                               if($scope.companies[0]!=undefined){
                                //num++;
                               for(var j=0;j<$scope.companies.length;j++){
                                
                                 if($scope.inputStocks[n].producto==$scope.companies[j].producto){
                                  //alert("hola"+$scope.inputStocks[n].producto+$scope.companies[j].producto);
                                    $scope.company={};
                                    $scope.product.proId='';
                                    $scope.inputStock.cantidad_llegado='';
                                    $scope.Listo=true;
                                    $scope.mostrarPresentacion=true;
                                    $scope.inputStock.descripcion='';
                                    $scope.company={};
                                    $scope.companies=[];
                                    $scope.num=false;
                                    //$scope.verEntradasEstock();
                                   
                                   break;
                                 //$scope.companies[n].cantidad_llegado=can;
                                 //$scope.badera=false;                      
                                 }
                               }

                           }
                         }
                            if($scope.num==true){
                               $scope.verEntradasEstock();
                             }else{
                               alert("Error::El conjunto de datos contiene items repetidos");
                             }

                           
                             
                    }else{
                       $scope.verEntradasEstock();
                    }
                  }else{
                         if($scope.inputStocks[0]!=undefined && $scope.purchase.tipo!="Entrada"){
                              for(var n=0;n<$scope.inputStocks.length;n++){
                                   if($scope.inputStocks[n].producto==$scope.inputStock.producto){
                                    //alert("hola"+$scope.inputStocks[n].producto+$scope.inputStock.producto);
                                    $scope.company={};
                                    $scope.product.proId='';
                                    //$scope.inputStock.cantidad_llegado='';
                                    $scope.Listo=true;
                                    $scope.mostrarPresentacion=true;
                                    $scope.variant.sku='';
                                   // $scope.inputStock.descripcion='';
                                   $scope.inputStock={};
                                    $scope.num=false;
                                     alert("Error::El conjunto de datos contiene items repetidos");
                                  
                                    //$scope.verEntradasEstock();
                                   break;
                                 //$scope.companies[n].cantidad_llegado=can;
                                 //$scope.badera=false;                      
                               }
                               
                              } if($scope.num==true){
                                alert("no puede ser");
                               $scope.verEntradasEstock();
                             }
                         }else{
                          $scope.verEntradasEstock();
                         }
                  }
                  }
                  $scope.desseleccionarMethodP=function(){
                    $scope.detPayment.montoPagado='';
                  }
                   $scope.quitarTalla=function(index,talla,estado){
                   // alert(index);
                    if(estado==false){
                    var t=0;
                    for(var n=0;n<$scope.companies.length;n++){
                        t++;
                        //alert($scope.companies[n].talla+"-->"+talla);
                        if($scope.companies[n].talla==talla){
                           $scope.companies.splice(t-1,1);
                           $scope.cantidad[index]='';
                            break;
                        }
                    }
                    
                }
                   // alert("hola"+t);
                  }
               $scope.codigoVarP;
               $scope.CantidaStock='';
               $scope.obcionales=[];
               $scope.obcional={};
               $scope.mostrarTallas=function(taco){
                    //alert($scope.codigoVarP);
                    //alert(taco);
                    if(taco!=null){
                    crudOPurchase.getTallas($scope.codigoVarP,"selectStocksTalla",taco,$scope.purchase.warehouses_id).then(function (data) {
                          $scope.atributes=data.data;
                    });
                    $scope.mostrarPresentacion=false;
                } else{
                    alert("Selecciones un numero de Taco!!!")
                }
                  }
               $scope.mostrarPresentacion=true;
               $scope.Listo=true;
                $scope.asignarProduc1=function(){
                  $scope.cantidad=[];
                    $scope.inputStock.CantidaStock='';
                    $scope.inputStock={};
                    $scope.companies=[];
                    $scope.company={};
                    $scope.codigoVarP=$scope.product.proId.varCodigo;
                    $scope.inputStock.proNombre=$scope.product.proId.proNombre;
                    if($scope.product.proId.TieneVariante==1){
                           $scope.inputStock.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.NombreAtributos+")";
                       }else{
                           $scope.inputStock.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.varCodigo+")";
                       }
                    //alert($scope.product.proId.varid);
                     crudOPurchase.MostrarAtributos($scope.product.proId.varCodigo,'Taco').then(function (data) {
                              $scope.variants=data.data;
                                //alert("Estoy Buscando Taco");
                              if($scope.variants.length>0){$scope.Listo=true;$scope.inputStock.cantidad_llegado='';}
                              if($scope.variants[0]==null)
                              {
                                       crudOPurchase.setAtrib($scope.product.proId.varCodigo,$scope.purchase.warehouses_id).then(function (data) 
                                       {
                                              //alert("Estoy Buscando Talla");
                                              $scope.atributes=data.data;
                                             // if($scope.atributes.length>1){$scope.Listo=false;}else{$scope.activarCampCantidad=false;}
                                              //alert($scope.atributes.length);
                                              if($scope.atributes[0]==null)
                                              {
                                                 crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                                                        $scope.stock=data;
                                                        $scope.inputStock.CantidaStock=data.stockActual;
                            
                                                 });
                                                $scope.Listo=false;
                                                if($scope.product.proId.NombreAtributos!=null)
                                                   {
                                                   $scope.inputStock.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.NombreAtributos+")";
                                                   }else{
                                                    $scope.inputStock.producto=$scope.inputStock.proNombre+"("+$scope.product.proId.proCodigo+")";
                                                }
                                                $scope.activarCampCantidad=true;
                                                 //---------------------------------------------------------------
                                               }else{
                                                  $scope.Listo=true;
                                                  $scope.inputStock.CantidaStock='';
                                                  $scope.inputStock.cantidad_llegado='';
                                                  //$scope.detailOrderPurchase.taco='';
                                                  $scope.mostrarPresentacion=false;
                                               }
                         
                                  });
                                  
                              
                                  }else{
                                    //$scope.detailOrderPurchase={};
                                  if($scope.detailOrderPurchase!=undefined){
                                    $scope.detailOrderPurchase.taco='';
                                  }
                                  }
                            });
                                
                        
            }


             $scope.verEntradasEstock=function(){
                    $scope.purchase.eliminar=1;
                  if( $scope.mostrarPresentacion==false ){
                    //$log.log("///////////////////////////");
                    //$log.log($scope.companies);
                     if(parseInt($scope.purchase.warehouses_id)!=parseInt($scope.purchase.warehouDestino_id)){
                       if($scope.companies[0]!=null && $scope.inputStock.descripcion!=null){
                        for(var n=0;n<$scope.companies.length;n++){
                            //alert($scope.companies[n].cantidad);
                            $scope.companies[n].descripcion=$scope.inputStock.descripcion;
                            $scope.inputStocks.push($scope.companies[n]);
                         }
                         $scope.mostrarPresentacion=true;
                         $scope.product.proId='';
                         $scope.inputStock.CantidaStock='';
                         $scope.variants=[];
                         $scope.cantidad=[];
                         $scope.inputStock.descripcion='';
                        // alert("hola"+$scope.detailOrderPurchase.taco);
                        // if($scope.detailOrderPurchase.taco!=undefined){
                        // $scope.detailOrderPurchase.taco='';
                        //}
                     }else{
                        alert('Es necesario una cantidad o descripcion');
                     }
                    }else{
                       alert("en una transferencia no debe seleccionar dos almacenes iguales??"); 
                    }
                  }else{
                    //alert(hola);
                    if ($scope.inputStocksBodyCreateForm.$valid) {
                    if($scope.inputStock.descripcion!=null){
                    //alert($scope.purchase.warehouDestino_id);
                    if(parseInt($scope.purchase.warehouses_id)!=parseInt($scope.purchase.warehouDestino_id)){
                    $scope.inputStock.variant_id=$scope.product.proId.varid;
                    $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                    crudOPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    $scope.inputStock.esbase=data.esbase;
                                    $scope.inputStock.detPres_id=data.detpresen_id;
                                    crudOPurchase.byId($scope.purchase.warehouses_id,'warehouses').then(function (data) {
                                        $scope.inputStock.nombre=data.nombre;

                                    }); 
                    $scope.inputStocks.push($scope.inputStock);
                    $scope.inputStock={};
                    $scope.product.proId='';
                    if($scope.check==true){
                        $scope.variant.sku='';
                      }
                    });
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }
             }else{
                alert("Es necesario una descripcion");
             }
                    }else{alert("complete los campos");}
                 }}
                $scope.soloFinta=function(){
                if($scope.check==true){
                    $scope.Listo=true;
                    $scope.mostrarPresentacion=true;
                    $scope.product.proId='';
                    $scope.inputStock.cantidad_llegado='';
                }else{
                  $scope.product.proId='';
                  $scope.inputStock.cantidad_llegado='';
                  $scope.Listo=true;
                  $scope.mostrarPresentacion=true;
                  $scope.variant.sku='';
                }
                }
                $scope.textMovimiento="Generar Reporte";
                $scope.filtrarFechas=function(){
                    //alert('ya estas');
                    $scope.temporalfec='';
                    $scope.temporalfech2='';
            if($scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null){
            if($scope.purchase.fechaini<$scope.purchase.fechafin){
                   if($scope.purchase.fechaini.getDate()<10){
                         $scope.temporalfec="0"+$scope.purchase.fechaini.getDate();
                         if($scope.purchase.fechaini.getMonth()+1<10){
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-0"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                            
                         }else{
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }
                   }else{
                        $scope.temporalfec=$scope.purchase.fechaini.getDate();
                         if($scope.purchase.fechaini.getMonth()+1<10){
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-0"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }else{
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }
                   }
                   if($scope.purchase.fechafin.getDate()<10){
                         $scope.temporalfech2="0"+$scope.purchase.fechafin.getDate();
                         if($scope.purchase.fechafin.getMonth()+1<10){
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-0"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                            
                         }else{
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }
                   }else{
                        $scope.temporalfech2=$scope.purchase.fechafin.getDate();
                         if($scope.purchase.fechafin.getMonth()+1<10){
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-0"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }else{
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }
                   }
                  // alert($scope.purchase.tipoMov);
                   if($scope.check==true){
                    //alert($scope.temporalfec+"////"+$scope.temporalfech2);
                   crudOPurchase.paginarporfechas("inputStocks",$scope.temporalfec,$scope.temporalfech2).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                   });
                   $scope.purchase.tipoMov='';
               }
                   else{
                    if($scope.purchase.tipoMov!=''){
                        crudOPurchase.paginarfechaTipo("inputStocks",$scope.temporalfec,$scope.temporalfech2,$scope.purchase.tipoMov).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                   });
                    
                   }}
                }else{

                   alert("Error La segunda fecha debe ser una fecha mayor a la primera como minimo en un dia!!")
                }
            }
                }
                $scope.filtrarFecharCompras=function(){
                   // alert($scope.estado);
             if($scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null){
                if($scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null && $scope.purchase.fechaini<=$scope.purchase.fechafin){
                     //alert($scope.estado);
                   if($scope.purchase.fechaini.getDate()<10){
                         $scope.temporalfec="0"+$scope.purchase.fechaini.getDate();
                         if($scope.purchase.fechaini.getMonth()+1<10){
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-0"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                            
                         }else{
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }
                   }else{
                        $scope.temporalfec=$scope.purchase.fechaini.getDate();
                         if($scope.purchase.fechaini.getMonth()+1<10){
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-0"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }else{
                            $scope.temporalfec=$scope.purchase.fechaini.getFullYear()+"-"+
                            ($scope.purchase.fechaini.getMonth()+1)+"-"+$scope.temporalfec;
                         }
                   }
                   if($scope.purchase.fechafin.getDate()<10){
                         $scope.temporalfech2="0"+$scope.purchase.fechafin.getDate();
                         if($scope.purchase.fechafin.getMonth()+1<10){
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-0"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                            
                         }else{
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }
                   }else{
                        $scope.temporalfech2=$scope.purchase.fechafin.getDate();
                         if($scope.purchase.fechafin.getMonth()+1<10){
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-0"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }else{
                            $scope.temporalfech2=$scope.purchase.fechafin.getFullYear()+"-"+
                            ($scope.purchase.fechafin.getMonth()+1)+"-"+$scope.temporalfech2;
                         }
                   }
                    crudOPurchase.paginarporfechas("purchases",$scope.temporalfec,$scope.temporalfech2).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                   });
                    $scope.query='';
                }else{
                    $scope.purchase.fechafin=null;
                    alert("Seleccione Fechas Correctas");
                }
            }
                }
                
                $scope.limpiarFiltros=function(){
                    crudOPurchase.paginate('inputStocks',1).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    $scope.purchase.fechaini=null;
                    $scope.purchase.fechafin=null;
                    $scope.purchase.tipoMov='';
                }
                $scope.MovimientoAlmacen=function(){
                    //alert($scope.check);
                    if($scope.check==true)
                    {    
                        if($scope.purchase.tipoMov!=''){
                          //  alert("hola");
                          $scope.textMovimiento="Generando..";
                           crudOPurchase.Reportes($scope.purchase.tipoMov,'movimientoTipo').then(function (data) {
                       // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfMovimiento=data;
                                $scope.textMovimiento="Generar Reporte";
                                alert("Reporte Generado");
                                 //$scope.botonReporte = 'Reporte Completado';
                                 //$scope.verReportTiket1=true;
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });
                     }else{
                        if($scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null && $scope.purchase.fechaini<$scope.purchase.fechafin)
                        {
                            //alert($scope.temporalfec);
                            $scope.textMovimiento="Generando";
                             crudOPurchase.reportesMovFecha('movimientoFechas',$scope.temporalfec,$scope.temporalfech2).then(function (data) {
                       // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfMovimiento=data;
                                $scope.textMovimiento="Generar Reporte";
                                alert("Reporte Generado");
                                 //$scope.botonReporte = 'Reporte Completado';
                                 //$scope.verReportTiket1=true;
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });

                        }
                    }
                        
                    }else{
                      //alert("oyes");
                    if($scope.purchase.tipoMov!=''){
                        $scope.textMovimiento="Generando..";
                       crudOPurchase.movimientoFechasTipo('movimientoFechasTipo',$scope.temporalfec,$scope.temporalfech2,$scope.purchase.tipoMov).then(function (data) {
                       // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfMovimiento=data;
                                $scope.textMovimiento="Generar Reporte";
                                alert("Reporte Generado");
                                 //$scope.botonReporte = 'Reporte Completado';
                                 //$scope.verReportTiket1=true;
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });
                    }else{
                        if($scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null && $scope.purchase.fechaini<$scope.purchase.fechafin)
                        {
                           // alert($scope.temporalfec);
                           $scope.textMovimiento="Generando";
                             crudOPurchase.reportesMovFecha('movimientoFechas',$scope.temporalfec,$scope.temporalfech2).then(function (data) {
                       // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfMovimiento=data;
                                alert("Reporte Generado");
                                $scope.textMovimiento="Generar Reporte";
                                 //$scope.botonReporte = 'Reporte Completado';
                                 //$scope.verReportTiket1=true;
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });

                        }
                    }
                    }
                }
                $scope.searchporTipo=function(){
                  //alert($scope.purchase.tipoMov);
                    crudOPurchase.paginarportipos("inputStocks",$scope.purchase.tipoMov).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                   });
                    $scope.purchase.fechaini=null;
                    $scope.purchase.fechafin=null;

                }
                $scope.searchSkuEstock=function(sku){
                     $scope.purchase.eliminar=1;

                      crudOPurchase.autocomplitVar('variants',sku).then(function (data) {
                        $scope.product.proId = data;
                        if($scope.product.proId.varid==null){
                            alert('No se a Encontrado Producto');
                            $scope.variant.sku='';
                             $scope.inputStock.CantidaStock='';
                             $scope.Listo=true;
                        }else{
                            if($scope.product.proId.NombreAtributos!=null){
                            $scope.inputStock.producto=$scope.product.proId.proNombre+"("+$scope.product.proId.NombreAtributos+")";
                            }else{
                            $scope.inputStock.producto=$scope.product.proId.proNombre+"("+$scope.product.proId.varCodigo+")";
                            }
                            $scope.Listo=false;
                            $scope.inputStock.cantidad='';
                            $scope.inputStock.CantidaStock='';
                            crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                            $scope.stock=data;
                            $scope.inputStock.CantidaStock=data.stockActual;
                            
                     });
                    }
                        //alert(data.varCodigo);
            if($scope.product.proId.varCodigo!=null){
                     if(parseInt($scope.inputStock.warehouses_id)!=parseInt($scope.inputStock.warehouDestino_id)){
                     $scope.inputStock.variant_id=$scope.product.proId.varid;
                     $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                     
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }}
             });
                    
                 }
                 $scope.verReportTiket1=false;
                 $scope.verReportSku1=false;
                 $scope.verReportTiket=function(){
                     $scope.verReportTiket1=false;
                     $scope.botonReporte = 'Generar Reportes de Ticket';
                 }
                 $scope.verReportSku=function(){
                    $scope.verReportSku1=false;
                    $scope.botonReporteCod = 'Generar Reportes de Sku';
                 }
                 $scope.textpurchasefecha="Generar Reporte";
                $scope.GenerarReportComprasRF=function(){
                    if($scope.query!=''){
                        $scope.textpurchasefecha="Generando..";
                        crudOPurchase.Reportes($scope.query,'reporteCompraLike').then(function (data) {
                        // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfreportCompr=data;
                                $scope.textpurchasefecha="Generar Reporte";
                                alert("Reporte Generado");
                                 //$scope.botonReporte = 'Reporte Completado';
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });
                    }else{
                        $scope.textpurchasefecha="Generando..";
                     crudOPurchase.reportesMovFecha('reportePorFechacom',$scope.temporalfec,$scope.temporalfech2).then(function (data) {
                        // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdfreportCompr=data;
                                $scope.textpurchasefecha="Generar Reporte";
                                alert("Reporte Generado");
                                 //$scope.botonReporte = 'Reporte Completado';
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });
                 }
                }
                $scope.GenerrarReport=function(){
                    //$log.log($routeParams.id);
                    $scope.botonReporte = 'Cargando..';
                    var id=$routeParams.id;
                     crudOPurchase.Reportes(id,'TiketReport').then(function (data) {
                        // alert("debajo");
                            if (data!=null) {
                                alert('Reporte Generado');
                                 $scope.botonReporte = 'Reporte Completado';
                                 $scope.verReportTiket1=true;
                                 $scope.pdfTiketsSku=data;
                                //$location.path("http://www.cnn.com");
                            } else {
                                $scope.errors = data;

                            }
                        });
                }
                $scope.cancelarEditPayment=function(){
                    $route.reload();
                }
                $scope.GenerrarReportCod=function(){
                    //$log.log($routeParams.id);
                     $scope.botonReporteCod="Genrando..";
                     crudOPurchase.Reportes($routeParams.id,'CodReport').then(function (data) {
                        // alert("debajo");
                            if (data!= undefined) {
                                $scope.pdf1=data;
                                alert('Reporte Generado');
                                 $scope.botonReporteCod="Reporte Completado";
                                 $scope.verReportSku1=true;
                                //$scope.botonReporteCod = 'Generar Reportes de Sku';
                               // $location.path('/purchases/create');
                            } else {
                                $scope.errors = data;

                            }
                        });
                }
               
                $scope.nuevo=function(){
                    $route.reload();

                   /* $scope.mostrarCreate=false;
                    $scope.check=false;
                    $scope.Listo=true;
                    $scope.purchase.tipo="Entrada";
                    $scope.purchase.warehouses_id=''; 
                    $scope.purchase.warehouDestino_id='';
                    //$scope.inputStock.cantidad_llegado='';
                    //$scope.inputStock.cantidad='';
                    //$scope.inputStock.CantidaStock='';
                    $scope.mostrarPresentacion=true;
                    if($scope.detailOrderPurchase.taco!=null){$scope.detailOrderPurchase.taco='';}
                    $scope.product.proId='';
                    //$scope.inputStock.descripcion='';
                    $scope.inputStock={};
                    $scope.inputStocks=[];
                    $scope.company={};
                    $scope.companies=[];*/
                }
                
                $scope.crearEntradasEstock=function(){
                  if($scope.inputStocks.length>0){
                    $scope.purchase.detailOrderPurchases=$scope.inputStocks;
                    $scope.mostrarCreate=!$scope.mostrarCreate;
                     //alert("sobre");
                    crudOPurchase.create($scope.purchase, 'inputStocks').then(function (data) {
                        // alert("debajo");
                        //alert("jijijiijijij");
                            if (data['estado'] == true) {
                                alert('Movimiento Registrado');
                                $scope.purchase.warehouses_id=''; 
                                $scope.purchase.warehouDestino_id='';  
                                $scope.inputStocks=[];                             
                                $scope.mostrarCreate=false;
                                $scope.Listo=true;
                                $scope
                                $location.path('/purchases/create');
                            } else {
                                $scope.errors = data;

                            }
                        });
                }else{
                    alert("error usted no puede agregar un movimiento sin detalles");
                }
                }
                $scope.traerPayments=function(row){
                    crudOPurchase.byId(row.id,'payments').then(function (data) {
                        $scope.payment=data;
                    });
                    $location.path('/purchases/create');
                }
        ///caja no es mia XD -------------------------------------------------------------------
                $scope.cajas={};
                $scope.cashes={};
                $scope.TraerSales=function(id){
                    //alert(id);
                     crudOPurchase.byId(id,'cashes').then(function (data) {
                        $scope.cashes=data;
                        $scope.payment.cash_id=$scope.cashes.id; 
                        $scope.payment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                        $scope.payment.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.payment.montoCaja=$scope.cashes.montoBruto;
                        $scope.payment.montoMovimientoTarjeta=0;
                        $scope.payment.cashMotive_id=7;
                        $scope.payment.estado=1;
                    });
                }

    ///---------------------------------------------------------------------------------
                $scope.Saldo1=0;
                $scope.recalPayments=function(){
                if($scope.Saldo1==0){$scope.Saldo1=$scope.payment.Saldo;}
                if($scope.payment.cash_id>0){
                    if(Number($scope.cashes.montoBruto)<=Number($scope.detPayment.montoPagado)){
                      $scope.detPayment.montoPagado=-1;
                    }
                    $scope.payment.montoMovimientoEfectivo=Number($scope.detPayment.montoPagado);
                    $scope.payment.montoFinal=Number($scope.payment.montoCaja)-$scope.payment.montoMovimientoEfectivo;
                }     //---------------------------------------------------
                if(Number($scope.Saldo1)>=Number($scope.detPayment.montoPagado) && Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado) && Number($scope.detPayment.montoPagado)>0){
                    if($scope.payment.detpId>0){
                          $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.PagoAnterior);
                          $scope.payment.Acuenta=Number($scope.payment.Acuenta)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                    }else{
                          $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                   }
                   }else{
                    $scope.detPayment.montoPagado='';
                    alert('!!Error Usted Solo Puede Ingresar una cantidad menor o igual al total!!');
                }
                }
               $scope.addMethodPaiment=function(){
                 $scope.detPayment=$scope.idProvicional;
                 $scope.detPayments.push($scope.detPayment);
                 $scope.detPayment={};
               }
                $scope.desscripctiondddd='Generar Ticket';
                $scope.createdetPayment = function(){
                    //$scope.atribut.estado = 1;
                if($scope.detPayment.methodPayment_id!=null || $scope.detPayment.cashe_id!=null || $scope.payment.cajamensual!=null){
                    
                    $scope.detPayment.payment_id=$scope.idProvicional;
                    $scope.payment.detPayments=$scope.detPayment;
                        if ($scope.paymentCreateForm.$valid){
                            crudOPurchase.create($scope.payment, 'detPayments').then(function (data) {
                            if (data['estado'] == true) {
                               $scope.totAnterior=$scope.payment.Acuenta;
                               $scope.detPayment={};
                               $scope.detPayment.fecha=new Date();
                               $scope.payment.cash_id=0; 
                               $scope.Saldo1=0;
                               $scope.payment.cajamensual=false;
                               $scope.paginateDetPay();
                               if(confirm("Desea Generar Comprobante de Pago!!!") == true){
                                $scope.desscripctiondddd='Generando Ticket..';
                                crudOPurchase.Reportes(data['id'],'ReportComprobante').then(function (data) {
                                    $scope.pdf7=data;
                                    if(data!=null){
                                      $scope.desscripctiondddd="Ver Tiket";
                                    }
                                });
                               }else{
                                     alert('grabado correctamente');
                               }
                            }else {
                                $scope.errors = data;

                            }
                        });
                    }else{
                        alert("error");
                    }
                }else{
                    $scope.detPayment.montoPagado='';
                    alert("error debes seleccionar un metodo de pago");
                }
                }
                $scope.paginateDetPay=function(){
                      crudOPurchase.byId($scope.idProvicional,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                }
                $scope.destroyPay = function(row){
                    //alert(row.detCash_id);
                if(row.detCash_id!=null){
                    //alert(row.cashID);
                    crudOPurchase.comprovarCaja(row.detCash_id).then(function(data){
                        //alert(data.estado);
                        if(data.estado==1){
                            if(confirm("Esta segura de querer eliminar este pago!!!") == true){
                                  $scope.payment.detpId=row.id;
                                  $scope.payment.cashMonthly_id=row.cashMonthly_id;
                                  $scope.payment.detCash_id=row.detCash_id;
                                  crudOPurchase.destroy($scope.payment,'payments').then(function(data)
                                  {
                                      if(data['estado'] == true){
                                          $scope.success = data['nombre'];
                                          alert("Elimnado Correctamente");
                                          $route.reload();
              
                                      }else{
                                          $scope.errors = data;
                                      }
                                  });
                              }
                        }else{
                            alert("zorry Usted no puede eliminar un pago de una caja cerrada");
                        }
                    });
                }else{
                
                  if(confirm("Esta segura de querer eliminar este pago!!!") == true){
                    $scope.payment.detpId=row.id;
                    $scope.payment.cashMonthly_id=row.cashMonthly_id;
                    $scope.payment.detCash_id=row.detCash_id;
                    crudOPurchase.destroy($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            alert("Eliminado Correctamente");
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
               }
            }
                $scope.PagoAnterior;
                $scope.mostrarBtnGEd=false;
                 $scope.check=false;
                 $scope.filaenEdicion=false;
                $scope.editDetpayment=function(row){
                 //alert(row.detCash_id);
                 $scope.payment.Acuenta=Number((Number($scope.payment.Acuenta)-Number(row.montoPagado)).toFixed(2));
                 $scope.payment.Saldo=Number((Number($scope.payment.Saldo)+Number(row.montoPagado)).toFixed(2));
                 $scope.payments.splice(1,1,$scope.payment);
                if(row.detCash_id!=null){
                    //alert(row.cashID);
                    crudOPurchase.comprovarCaja(row.detCash_id).then(function(data){
                        //alert(data.estado);
                        if(data.estado==1){
                              $scope.check=true;
                              $scope.filaenEdicion=true;
                              if(row.cashMonthly_id>0){
                                  $scope.payment.cajamensual=true;
                                  $scope.payment.cashMonthly_id=row.cashMonthly_id;
                              }else{
                                  $scope.payment.cajamensual=false;
                              }
                              $scope.payment.detpId=row.id;
                              $scope.detPayment.cashe_id=row.cashID;
                              $scope.payment.cash_id=$scope.detPayment.cashe_id;
                              $scope.payment.detCash_id=row.detCash_id;
                              $scope.detPayment.oldPay=row.montoPagado;
                              $scope.PagoAnterior=row.montoPagado;
                              $scope.detPayment.fecha=new Date(row.fecha);
                              $scope.detPayment.methodPayment_id=row.methodPayment_id;
                              $scope.detPayment.montoPagado=(parseFloat(row.montoPagado));
                              $scope.mostrarBtnGEd=true;
                      }else{
                        alert("Error la caja con que se pago ya esta cerrada por ende no se puede registrar los cambios");
                      }
                    });
                }else{
                    $scope.check=true;
                    $scope.filaenEdicion=true;
                    if(row.cashMonthly_id>0){
                        $scope.payment.cajamensual=true;
                        $scope.payment.cashMonthly_id=row.cashMonthly_id;
                    }else{
                        $scope.payment.cajamensual=false;
                    }
                    $scope.payment.detpId=row.id;
                    $scope.detPayment.cashe_id=row.cashID;
                    $scope.payment.cash_id=$scope.detPayment.cashe_id;
                    $scope.payment.detCash_id=row.detCash_id;
                    $scope.detPayment.oldPay=row.montoPagado;
                    $scope.PagoAnterior=row.montoPagado;
                    $scope.detPayment.fecha=new Date(row.fecha);
                    $scope.detPayment.methodPayment_id=row.methodPayment_id;
                    $scope.detPayment.montoPagado=(parseFloat(row.montoPagado));
                    $scope.mostrarBtnGEd=true;
                 }
                }
                
                $scope.cashmontly=function(){
                    if($scope.payment.cajamensual==true){
                          $scope.payment.months_id=$scope.date.getMonth()+1;
                          $scope.payment.año=$scope.date.getFullYear();
                    }else{
                        $scope.detPayment.montoPagado='';
                    }
                    
                     }
                $scope.editPayment = function(){
                    $scope.payment.detPayments=$scope.detPayment;
                    crudOPurchase.update($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
               // $scope.pdf5;
               $scope.textpagos="Generar Reporte";
                $scope.generarReportePagos=function(){
                    $scope.textpagos="Generando..";
                        crudOPurchase.Reportes($scope.payment.id,'reportPagos2').then(function (data) {
                             if (data!=null) 
                             {
                                //alert(data);
                                $scope.pdfpagosR=data;
                                $scope.textpagos="Reporte Generado";
                                alert('Reporte Generado');
                             }else {
                                $scope.errors = data;
                             }
                        });
                }
                //=======================================Reporte Cardex====================================
                 $scope.fechaPrueba;
                 $scope.fechaPrueba2;
                  $scope.filtrarCardex=function(){
                    //alert("jajajajaj"+$scope.purchase.tiempo);
                        //if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes'){
                           if($scope.purchase.tiempo=='dia'){
                                 $scope.fechaPrueba=$scope.date.getFullYear();
                                 if($scope.date.getMonth()<9){
                                     $scope.fechaPrueba=$scope.fechaPrueba+"-0"+($scope.date.getMonth()+1);
                                 }else{
                                 $scope.fechaPrueba=$scope.fechaPrueba+"-"+($scope.date.getMonth()+1);
                                 }
                                 if($scope.date.getDate()<10){
                                   $scope.fechaPrueba=$scope.fechaPrueba+"-0"+($scope.date.getDate()-1);
                                 }else{
                                      $scope.fechaPrueba=$scope.fechaPrueba+"-"+($scope.date.getDate()-1);
                                }
                                //alert($scope.fechaPrueba);
                            }
                           if($scope.purchase.tiempo=='mes'){
                                  //  alert("hola aqui estoy");
                                     $scope.fechaPrueba=$scope.date.getFullYear();
                                     if($scope.date.getMonth()<10){
                                        $scope.fechaPrueba=$scope.fechaPrueba+"-0"+($scope.date.getMonth());
                                     }else{
                                       $scope.fechaPrueba=$scope.fechaPrueba+"-"+($scope.date.getMonth());
                                    }
                           }
                           if($scope.purchase.tiempo=='año'){
                                    //alert("hola aqui año");
                                     $scope.fechaPrueba=''+$scope.date.getFullYear();
                                     
                           }
                                
                        if($scope.purchase.tiempo=='otro' && $scope.purchase.fechaini!=null && $scope.purchase.fechafin!=null){
                             $scope.fechaPrueba=$scope.purchase.fechaini.getFullYear();
                             if($scope.purchase.fechaini.getMonth()<9)
                             {
                                 $scope.fechaPrueba=$scope.fechaPrueba+"-0"+($scope.purchase.fechaini.getMonth()+1);
                             }else
                             {
                                 $scope.fechaPrueba=$scope.fechaPrueba+"-"+($scope.purchase.fechaini.getMonth()+1);
                             }
                             if($scope.purchase.fechaini.getDate()<10){
                                 $scope.fechaPrueba=$scope.fechaPrueba+"-0"+($scope.purchase.fechaini.getDate());
                             }else{
                                $scope.fechaPrueba=$scope.fechaPrueba+"-"+($scope.purchase.fechaini.getDate());
                             }
                             $scope.fechaPrueba2=$scope.purchase.fechafin.getFullYear();
                             if($scope.purchase.fechafin.getMonth()<9)
                             {
                                 $scope.fechaPrueba2=$scope.fechaPrueba2+"-0"+($scope.purchase.fechafin.getMonth()+1);
                             }else
                             {
                                 $scope.fechaPrueba2=$scope.fechaPrueba2+"-"+($scope.purchase.fechafin.getMonth()+1);
                             }
                             if($scope.purchase.fechafin.getDate()<10){
                                 $scope.fechaPrueba2=$scope.fechaPrueba2+"-0"+($scope.purchase.fechafin.getDate());
                             }else{
                                $scope.fechaPrueba2=$scope.fechaPrueba2+"-"+($scope.purchase.fechafin.getDate());
                             } //alert($scope.fechaPrueba+$scope.fechaPrueba2);
                        }
                                
                            
                           
                       // }
                        
                }
                $scope.product.proId=null;
                $scope.textgeneratecardex="Generar Reporte";
                $scope.GenerateRportCardex=function(){
                    //alert($scope.product.proId.varid);
                if($scope.product.proId!=null){
                if(parseInt($scope.product.proId.varid)>0)
                    {
                    if($scope.purchase.tipoMov=='Entrada' || $scope.purchase.tipoMov=='Venta' || $scope.purchase.tipoMov=='Compra' || $scope.purchase.tipoMov=='Salida' || $scope.purchase.tipoMov=='Transferencia')
                    {
                        if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        //alert("generando reporte por Variante  y dia mes o año");
                        $scope.textgeneratecardex="Generando..";
                        crudOPurchase.cardexTopVariantPrimero('reportMovimientoVarianteDMA',$scope.purchase.tipoMov,$scope.fechaPrueba,$scope.purchase.tienda,$scope.product.proId.varid).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                        }
                    }
                    if($scope.purchase.tiempo=='otro'){
                        if( $scope.purchase.tipoMov=='Entrada' || $scope.purchase.tipoMov=='Venta' || $scope.purchase.tipoMov=='Compra' || $scope.purchase.tipoMov=='Salida' || $scope.purchase.tipoMov=='Transferencia')
                        {
                        //alert('generando reportes productos por tipo y rango de fechas');
                         $scope.textgeneratecardex="Generando..";
                        crudOPurchase.reportesCardexVariantFecha('reportMovimientosVarianteRangoF',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tipoMov,$scope.purchase.tienda,$scope.product.proId.varid).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                      }
                    }

                    }}
                else{
                if($scope.purchase.tipoMov=='Entrada' || $scope.purchase.tipoMov=='Venta' || $scope.purchase.tipoMov=='Compra' || $scope.purchase.tipoMov=='Salida' || $scope.purchase.tipoMov=='Transferencia')
                {
                    if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        //alert("generando reporte por tipo y dia mes o año");
                        $scope.textgeneratecardex="Generando..";
                        crudOPurchase.reporteProducts('cardexUltimoDia',$scope.purchase.tipoMov,$scope.fechaPrueba,$scope.purchase.tienda).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }
                }
                    if($scope.purchase.tiempo=='otro'){
                        if( $scope.purchase.tipoMov=='Entrada' || $scope.purchase.tipoMov=='Venta' || $scope.purchase.tipoMov=='Compra' ||  $scope.purchase.tipoMov=='Salida' || $scope.purchase.tipoMov=='Transferencia')
                        {
                       // alert('generando reportes productos por tipo y rango de fechas');
                         $scope.textgeneratecardex="Generando..";
                        crudOPurchase.CardexFechasTipo('cardexRangoFechas',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tipoMov,$scope.purchase.tienda).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                      }
                    }
                    if($scope.purchase.tipoMov=='masVendido')
                    {
                        if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        
                        //alert("generando producto mas vendido ultimo dia mes o año");
                        $scope.textgeneratecardex="Generando..";
                       crudOPurchase.cardexTopPrimero('cardexTopPrimero',$scope.fechaPrueba,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                           } 
                    }
                    if($scope.purchase.tipoMov=='masVendido' && $scope.purchase.tiempo=='otro')
                    {
                         //alert("generando por mas vendido, otro,rango fechas");
                           $scope.textgeneratecardex="Generando..";
                        crudOPurchase.reportesCardexFecha('cardextopUnoRFechas',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }
                    if($scope.purchase.tipoMov=='menVendido')
                    {
                        if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        $scope.textgeneratecardex="Generando..";
                       //alert("generando producto menos vendido ultimo dia mes o año");
                       crudOPurchase.cardexTopPrimero('cardextopUnomen',$scope.fechaPrueba,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           }); 
                      }
                    }
                    if($scope.purchase.tipoMov=='menVendido' && $scope.purchase.tiempo=='otro')
                    {
                        $scope.textgeneratecardex="Generando..";
                         //alert("generando por menos vendido, otro,rango fechas");
                           $scope.textgeneratecardex="Genrando..";
                        crudOPurchase.reportesCardexFecha('cardextopUnomenRFechas',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }
                    if($scope.purchase.tipoMov=='topMasVendido' )
                    {
                        if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        $scope.textgeneratecardex="Generando..";
                        //alert("generando top 10 mas vendido ultimo dia mes o año");
                       crudOPurchase.cardexTopPrimero('cardextop10mejores',$scope.fechaPrueba,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           }); 
                       }
                    }
                    if($scope.purchase.tipoMov=='topMasVendido' && $scope.purchase.tiempo=='otro')
                    {
                         //alert("generando top 10 mas  vendido, otro,rango fechas");
                           $scope.textgeneratecardex="Genrando..";
                        crudOPurchase.reportesCardexFecha('cardextop10mejoreRFechas',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }
                    if($scope.purchase.tipoMov=='topMenVendido')
                    {
                        if($scope.purchase.tiempo=='dia' || $scope.purchase.tiempo=='mes' || $scope.purchase.tiempo=='año'){
                        //alert("generando top 10 menos vendido ultimo dia mes o año");
                        $scope.textgeneratecardex="Generando..";
                       crudOPurchase.cardexTopPrimero('cardextop10Peores',$scope.fechaPrueba,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           }); 
                        }
                    }
                    if($scope.purchase.tipoMov=='topMenVendido' && $scope.purchase.tiempo=='otro')
                    {
                         //alert("generando top 10 mas  vendido, otro,rango fechas");
                           $scope.textgeneratecardex="Generando..";
                        crudOPurchase.reportesCardexFecha('cardextop10peoresFechas',$scope.fechaPrueba,$scope.fechaPrueba2,$scope.purchase.tienda,$scope.purchase.tipoMov2).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.textgeneratecardex="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }
                  }
              
//reportesCardexVariantFecha
                }
                 $scope.decriboton200="Generar Reporte";
                 $scope.purchase.tipoMov5="Venta";
                $scope.GenerateRportCardex1=function(){

                  $scope.fechainicio1=$scope.purchase.fechaini1.getFullYear()+"-"+($scope.purchase.fechaini1.getMonth()+1)+"-"+$scope.purchase.fechaini1.getDate();
                    $scope.fechafin2=$scope.purchase.fechafin1.getFullYear()+"-"+($scope.purchase.fechafin1.getMonth()+1)+"-"+$scope.purchase.fechafin1.getDate();
                    if($scope.fechainicio1!=null && $scope.fechafin2!=null){
                    if($scope.product.proId1==null){
                          $scope.decriboton200="Generando";
                        if($scope.purchase.tipoMov1=='masVendido')
                        {

    
                             crudOPurchase.reportesCardexFecha('cardextopUnoRFechasProduct',$scope.fechainicio1,$scope.fechafin2,$scope.purchase.tienda,$scope.purchase.tipoMov5).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.decriboton200="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                        }
                        if($scope.purchase.tipoMov1=='menVendido')
                        {
                            crudOPurchase.reportesCardexFecha('cardextopmenRFechasProduct',$scope.fechainicio1,$scope.fechafin2,$scope.purchase.tienda,$scope.purchase.tipoMov5).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.decriboton200="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                        }
                        if($scope.purchase.tipoMov1=='topMasVendido')
                        {
                            crudOPurchase.reportesCardexFecha('cardexto10masFechasProduct',$scope.fechainicio1,$scope.fechafin2,$scope.purchase.tienda,$scope.purchase.tipoMov5).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.decriboton200="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                        }
                        if($scope.purchase.tipoMov1=='topMenVendido')
                        {
                            crudOPurchase.reportesCardexFecha('cardexto10menFechasProduct',$scope.fechainicio1,$scope.fechafin2,$scope.purchase.tienda,$scope.purchase.tipoMov5).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.decriboton200="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });                                                        
                        }
                    }else{
                        $scope.decriboton200="Generando...";
                        crudOPurchase.reportesCardexVariantFecha('cardexProductsTipeMov',$scope.fechainicio1,$scope.fechafin2,$scope.purchase.tipoMov5,$scope.purchase.tienda,$scope.codigoProducto).then(function (data) {
                                   if (data!=null) 
                                   {
                                      $scope.decriboton200="Generar Reporte";
                                      $window.open(data);
                                   }else {
                                      $scope.errors = data;
                                   }
                           });
                    }  
                  }else{
                    alert("Seleccione bien las fechas!!");
                  }
                }
                $scope.codigoProducto="";
                $scope.asignarProduc100=function(){
                  
                    $scope.codigoProducto=$scope.product.proId1.id;
                    //alert($scope.codigoProducto);

                        
            }
            $scope.versiestavacio=function(){
                if($scope.product.proId1==null || $scope.product.proId1==''){
                $scope.product.proId1=null;
              }
            }
  $scope.decriboton20="Generar Reporte Tiket Planta";
                $scope.ReportTiketCompras1=function(){
                    
                    $scope.decriboton20="Generando..";
                     crudOPurchase.Reportes($routeParams.id,'TiketReportCompra2').then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decriboton20="Generar Reporte Tiket Planta";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 
                }
    $scope.decriboton21="Generar Reporte Tiket Caja";
                $scope.ReportTiketCompras2=function(){
                    
                    $scope.decriboton21="Generando..";
                     crudOPurchase.Reportes($routeParams.id,'TiketReportCompra3').then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decriboton21="Generar Reporte Tiket Caja";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 
                }
                
 $scope.decriboton="Generar Reporte Clientes";
                $scope.ReportMejoresCliente=function(){
                    if($scope.fechainicio!=undefined && $scope.fechafin!=undefined){
                    $scope.fechainicio1=$scope.fechainicio.getFullYear()+"-"+($scope.fechainicio.getMonth()+1)+"-"+$scope.fechainicio.getDate();
                    $scope.fechafin2=$scope.fechafin.getFullYear()+"-"+($scope.fechafin.getMonth()+1)+"-"+$scope.fechafin.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decriboton="Generando..";
                     crudOPurchase.movimientoFechasTipo('ReportMejoresCliente',$scope.fechainicio1,$scope.fechafin2,$scope.limit).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decriboton="Generar Reporte Clientes";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }
$scope.decribotonPagos="Generar Reporte Clientes";
                $scope.ReportMejoresClientePagos=function(){
                    if($scope.fechainicioComp!=undefined && $scope.fechafinComp!=undefined){
                    $scope.fechainicio1=$scope.fechainicioComp.getFullYear()+"-"+($scope.fechainicioComp.getMonth()+1)+"-"+$scope.fechainicioComp.getDate();
                    $scope.fechafin2=$scope.fechafinComp.getFullYear()+"-"+($scope.fechafinComp.getMonth()+1)+"-"+$scope.fechafinComp.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decribotonPagos="Generando..";
                     crudOPurchase.reportesMovFecha('cardexPagoProveedores',$scope.fechainicio1,$scope.fechafin2).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decribotonPagos="Generar Reporte Clientes";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }
$scope.decriboton1="Generar Reporte Empleados";
                $scope.ReportMejoresEmpleados=function(){
                    if($scope.fechainicio!=undefined && $scope.fechafin!=undefined){
                    $scope.fechainicio1=$scope.fechainicio.getFullYear()+"-"+($scope.fechainicio.getMonth()+1)+"-"+$scope.fechainicio.getDate();
                    $scope.fechafin2=$scope.fechafin.getFullYear()+"-"+($scope.fechafin.getMonth()+1)+"-"+$scope.fechafin.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decriboton1="Generando..";
                     crudOPurchase.movimientoFechasTipo('ReportMejoresEmpleados',$scope.fechainicio1,$scope.fechafin2,$scope.limit).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decriboton1="Generar Reporte Empleados";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }
$scope.decribotonCaja="Generar Reporte Resumido";
                $scope.ReportDetCajasResumido=function(){
                    if($scope.fechainicioCaja!=undefined && $scope.fechafinCaja!=undefined){
                    $scope.fechainicio1=$scope.fechainicioCaja.getFullYear()+"-"+($scope.fechainicioCaja.getMonth()+1)+"-"+$scope.fechainicioCaja.getDate();
                    $scope.fechafin2=$scope.fechafinCaja.getFullYear()+"-"+($scope.fechafinCaja.getMonth()+1)+"-"+$scope.fechafinCaja.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decribotonCaja="Generando..";
                     crudOPurchase.reportesMovFecha('ReportDetCashes',$scope.fechainicio1,$scope.fechafin2).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decribotonCaja="Generar Reporte Resumido";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }
$scope.decribotonCaja1="Generar Reporte Detallado";
                $scope.ReportDetCajasDetallado=function(){
                    if($scope.fechainicioCaja!=undefined && $scope.fechafinCaja!=undefined){
                    $scope.fechainicio1=$scope.fechainicioCaja.getFullYear()+"-"+($scope.fechainicioCaja.getMonth()+1)+"-"+$scope.fechainicioCaja.getDate();
                    $scope.fechafin2=$scope.fechafinCaja.getFullYear()+"-"+($scope.fechafinCaja.getMonth()+1)+"-"+$scope.fechafinCaja.getDate();
                    //alert($scope.fechainicio+"---"+$scope.fechafin);
                     $scope.decribotonCaja1="Generando..";
                     crudOPurchase.reportesMovFecha('ReportDetCashes2',$scope.fechainicio1,$scope.fechafin2).then(function(data)
                    {
                        if(data!=undefined){
                            $window.open(data);
                            $scope.decribotonCaja1="Generar Reporte Detallado";
                        }else{
                            $scope.errors = data;
                        }
                    });
                 }
                }
                //===========================================fin report Cardex=============================

$scope.random = function() {
    var type;

    if ($scope.payment.PorPagado < 25) {
      type = 'info';
    } else if ($scope.payment.PorPagado < 50) {
      type = 'success';
    } else if ($scope.payment.PorPagado < 75) {
      type = 'warning';
    } else {
      type = 'danger';
    }

    $scope.type = type;
  };

              
            }]);
})();
