(function(){
    angular.module('cashMonthlys.controllers',[])
        .controller('CashMonthlyController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$window','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$window,$log){
                $scope.cashMonthlys = [];
                $scope.cashMonthly = {};
                $scope.expenseMonthlys = [];
                $scope.expenseMonthly={};
                $scope.years = {};
                $scope.year={};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.cashMonthly.months_id;
                $scope.estado=false;
                $scope.months = [];
                $scope.cashMonthly.years_id;
                $scope.cashMonthly.expenseMonthlys_id;
                $scope.expenses = {};
                $scope.expense = {};
                $scope.year.year=2015;
                //$scope.acumulado=0;

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                /*$scope.calcularAcumulado = function () {
                    //alert($scope.cashMonthlys.length);
                    $scope.acumulado=0;
                    for (var i = $scope.cashMonthlys.length - 1; i >= 0; i--) {
                        $scope.acumulado=$scope.acumulado+Number($scope.cashMonthlys[i].amount);
                    };
                };*/
                $scope.fecha1;
                $scope.fecha2;
                $scope.buscarDetalles = function () {
                    if ($scope.fechaInicio==undefined) {
                        alert("Ingrese Fecha Inicio");
                        $scope.buscarDetallesEcpence();
                    }else if($scope.fechaFin==undefined){
                        alert("Ingrese Fecha Fin");
                        $scope.buscarDetallesEcpence();
                    }else{
                        $scope.fechaInicio=new Date($scope.fechaInicio);
                        $scope.fechaFin=new Date($scope.fechaFin);
                        //$scope.cashMonthly.fecha=$scope.fechap.getFullYear()+'-'+($scope.fechap.getMonth()+1)+'-'+$scope.fechap.getDate()+' '+$scope.fechap.getHours()+':'+$scope.fechap.getMinutes()+':'+$scope.fechap.getSeconds();
                        if($scope.fechaInicio<=$scope.fechaFin){
                            //alert("Entre")
                            if($scope.cashMonthly.expenseMonthlys_id==null){
                                $scope.cashMonthly.expenseMonthlys_id=0;
                            }

                            $scope.fecha1=$scope.fechaInicio.getFullYear()+'-'+($scope.fechaInicio.getMonth()+1)+'-'+$scope.fechaInicio.getDate()+' '+$scope.fechaInicio.getHours()+':'+$scope.fechaInicio.getMinutes()+':'+$scope.fechaInicio.getSeconds();
                            $scope.fecha2=$scope.fechaFin.getFullYear()+'-'+($scope.fechaFin.getMonth()+1)+'-'+$scope.fechaFin.getDate()+' '+'23:59:59';
                            
                            //$scope.fecha2=$scope.fechaFin.getFullYear()+'-'+($scope.fechaFin.getMonth()+1)+'-'+$scope.fechaFin.getDate()+' '+$scope.fechaFin.getHours()+':'+$scope.fechaFin.getMinutes()+':'+$scope.fechaFin.getSeconds();
                            crudService.searchMes('cashMonthlys',$scope.fecha1,$scope.fecha2,$scope.cashMonthly.expenseMonthlys_id,1).then(function (data){
                                //$log.log(data);
                                crudService.searchMes('cashMonthlysMonto',$scope.fecha1,$scope.fecha2,$scope.cashMonthly.expenseMonthlys_id,1).then(function (data){
                                    $log.log("Monto Total");
                                    $log.log(data);
                                    $scope.acumulado=data[0].monto;
                                })
                                $scope.cashMonthlys = data.data;                 
                                $scope.totalItems = data.total;
                                $scope.currentPage = data.current_page;
                                //$scope.calcularAcumulado();
                            });  
                        }else{
                            alert("La fecha de inicio debe ser menor");
                            $scope.fecha1=undefined;
                            $scope.fecha2=undefined;
                             $scope.fechaInicio=undefined;
                             $scope.fechaFin=undefined;
                            $scope.buscarDetallesEcpence();
                        }
                    }
                };
                $scope.buscarDetallesEcpence = function () {
                        if($scope.cashMonthly.fecha1==undefined){
                                $scope.cashMonthly.fecha1=0;
                            }
                        if($scope.cashMonthly.fecha2==undefined){
                            $scope.cashMonthly.fecha2=0;
                        }
                        if($scope.cashMonthly.expenseMonthlys_id==null){
                                $scope.cashMonthly.expenseMonthlys_id=0;
                            }
                    crudService.searchMes('cashMonthlys',$scope.fecha1,$scope.fecha2,$scope.cashMonthly.expenseMonthlys_id,1).then(function (data){
                                //$log.log(data);
                                crudService.searchMes('cashMonthlysMonto',$scope.fecha1,$scope.fecha2,$scope.cashMonthly.expenseMonthlys_id,1).then(function (data){
                                    $log.log("Monto Total");
                                    $log.log(data);
                                    $scope.acumulado=data[0].monto;
                                })
                                $scope.cashMonthlys = data.data;                 
                                $scope.totalItems = data.total;
                                $scope.currentPage = data.current_page;
                                //$scope.calcularAcumulado();
                            });
                }
                $scope.generarReporteCajaMen=function(){
                    if($scope.cashMonthly.expenseMonthlys_id==null ){
                                $scope.cashMonthly.expenseMonthlys_id=0;
                            }
                            $scope.fecha1=$scope.fechaInicio.getFullYear()+'-'+($scope.fechaInicio.getMonth()+1)+'-'+$scope.fechaInicio.getDate();
                            $scope.fecha2=$scope.fechaFin.getFullYear()+'-'+($scope.fechaFin.getMonth()+1)+'-'+$scope.fechaFin.getDate();
                            
                    alert($scope.fecha1+"//"+$scope.fecha2+"-----"+$scope.cashMonthly.expenseMonthlys_id);
                    crudService.reporteCajaMensual('reporteCajaMensual',$scope.fecha1,$scope.fecha2,$scope.cashMonthly.expenseMonthlys_id).then(function (data){
                    if(data != undefined){
                            //$scope.tiketName="Generar Tikets Planta";
                          //alert(data);
                           $window.open(data);
                        }else{
                            alert("Error No se a generado Tikets");
                        }
                    });
                }
                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cashMonthlys',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cashMonthlys = data.data;
                    });
                    }else{
                        crudService.paginate('cashMonthlys',$scope.currentPage).then(function (data) {
                            $scope.cashMonthlys = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cashMonthlys').then(function (data) {
                        $scope.cashMonthly = data;
                    });
                    crudService.select('months','select').then(function (data) {
                        $scope.months = data;
                    });

                    crudService.select('years','select').then(function (data) {                        
                        $scope.years = data;

                    });
                    crudService.select('expenses','select').then(function (data) {
                        $scope.expenses = data;
                    });
                    

                }else{
                    crudService.paginate('cashMonthlys',1).then(function (data) {
                        $scope.cashMonthlys = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                         $scope.buscarDetallesEcpence();
                    }); 
                    crudService.select('months','select').then(function (data) {
                        $scope.months = data;
                    });

                    crudService.select('years','select').then(function (data) {
                        $scope.years = data;
                        if ($scope.years.length>0) {
                            //$scope.cashMonthly.years_id=$scope.years[0].id;    
                        };
                        
                    });
                    crudService.select('expenses','select').then(function (data) {
                        $scope.expenses = data;
                        if ($scope.expenses.length>0) {
                            //$scope.cashMonthly.expenseMonthlys_id=$scope.expenses[0].id;    
                        };
                    });
                   
                }

                socket.on('cashMonthly.update', function (data) {
                    $scope.cashMonthlys=JSON.parse(data);
                });

                $scope.searchcashMonthly = function(){
                if ($scope.query.length > 0) {
                    crudService.search('cashMonthlys',$scope.query,1).then(function (data){
                        $log.log(data);
                        $scope.cashMonthlys = data.data;                 
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cashMonthlys',1).then(function (data) {
                        $scope.cashMonthlys = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.buscarTodo= function(){
                    if($scope.cashMonthly.years_id==null){
                        $scope.cashMonthly.years_id=0;
                    }
                    if($scope.cashMonthly.months_id==null){
                        $scope.cashMonthly.months_id=0;
                    }
                    if($scope.cashMonthly.expenseMonthlys_id==null){
                        $scope.cashMonthly.expenseMonthlys_id=0;
                    }
                    
                    crudService.searchMes('cashMonthlys',$scope.cashMonthly.months_id,$scope.cashMonthly.years_id,$scope.cashMonthly.expenseMonthlys_id,1).then(function (data){
                        //$log.log(data);
                        $scope.cashMonthlys = data.data;                 
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.calcularAcumulado();
                    });     
                }

                $scope.createExpense = function(){
                    /*
                    if(expenseMonthly.name){
                        alert('Ingrese Concepto');    
                    }*/

                    if ($scope.expenseMonthlyCreateForm.$valid) {  
                        crudService.create($scope.expenseMonthly, 'expenseMonthlys').then(function (data) {
                            if (data['estado'] == true) {
                                $('#miventana1').modal('hide');
                                alert('grabado correctamente');
                                
                                  //$scope.expenses.push(data);
                                  crudService.select('expenses','select').then(function (data) {
                                    $scope.expenses = data;

                                });
                                
                                $scope.year.year=2015;

                            } else {
                                
                                $scope.errors = data;
                            }
                        });
                    }

                }

                $scope.createYear = function(){
                     if ($scope.yearCreateForm.$valid) {
                        crudService.create($scope.year, 'years').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $('#miventana2').modal('hide');
                                alert('grabado correctamente');
                               //$scope.year.year="";
                                //$scope.years.push(data);
                                crudService.select('years','select').then(function (data) {                        
                                     $scope.years = data;

                                });
                                

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }
                
                $scope.createcashMonthly = function(){
                    if ($scope.cashMonthlyCreateForm.$valid) {  
                        $scope.fechap=new Date($scope.fechap);
                        //$scope.fechap.getTimezoneOffset();
                        $scope.cashMonthly.fecha=$scope.fechap.getFullYear()+'-'+($scope.fechap.getMonth()+1)+'-'+$scope.fechap.getDate()+' '+$scope.fechap.getHours()+':'+$scope.fechap.getMinutes()+':'+$scope.fechap.getSeconds();
                        $log.log($scope.cashMonthly.fecha);
                        //eee
                        //$scope.cashMonthly.fecha=$scope.fechap;
                        //$log.log($scope.cashMonthly);
                        //'999plasas
                        crudService.create($scope.cashMonthly, 'cashMonthlys').then(function (data) {
                            if (data['estado'] == true) {
                                $scope.success = data['descripcion'];
                                alert('grabado correctamente');
                                $location.path('/cashMonthlys');

                            } else {
                                $scope.errors = data;
                            }
                        });
                    }
                }


                $scope.editcashMonthly = function(row){
                    $location.path('/cashMonthlys/edit/'+row.id);
                };

                $scope.updatecashMonthly = function(){
                    if ($scope.cashMonthlyCreateForm.$valid) {
                        crudService.update($scope.cashMonthly,'cashMonthlys').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['descripcion'];
                                alert('editado correctamente');
                                $location.path('/cashMonthlys');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletecashMonthly = function(row){
                    $log.log(row);
                    $scope.cashMonthly = row;
                }

                $scope.cancelcashMonthly = function(){
                    $scope.cashMonthly = {};
                }

                $scope.destroycashMonthly = function(){
                    crudService.destroy($scope.cashMonthly,'cashMonthlys').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cashMonthly = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.mostrardata=false;

                $scope.verdata=function(){
                   $scope.mostrardata=true;
                   //$scope.expense.name=$scope.cashMonthly.expenseMonthlys_id;
                   //alert($scope.cashMonthly.expenseMonthlys_id);
                   crudService.byId($scope.cashMonthly.expenseMonthlys_id,'expenses').then(function (data) {
                        //$scope.expense = data;
                        
                        $scope.expense.name=data.name;
                    });

                }
                $scope.ocultardata=function(){
                     $scope.mostrardata=false;
                    }



                    $scope.mostrardata1=false;

                $scope.ver=function(){
                   $scope.mostrardata1=true;

                   crudService.byId($scope.cashMonthly.years_id,'years').then(function (data) {
                        $scope.year.year=parseInt(data.year);
                    });

                }

                $scope.ocultar=function(){
                     $scope.mostrardata1=false;
                    }

                $scope.deleteYear=function(){
                    crudService.byId($scope.cashMonthly.years_id,'years').then(function (data) {
                        //alert(data.year);
                        crudService.destroy(data,'years').then(function(data)
                            {  
                                //alert(data.year);
                                if(data['estado'] == true){
                                    $('#miventana2').modal('hide');
                                    alert("Eliminado Correctamente");
                                    
                                    crudService.select('years','select').then(function (data) {
                                $scope.years = data;
                                $scope.cashMonthly.years_id=$scope.years[0].id; 
                            });

                                    //cashMonthly.years_id='1';
                                }else{
                                    $scope.errors = data;
                                }
                            });
                    }); 
       
                }
                $scope.updatecashYear = function(){
                    $scope.year.id=$scope.cashMonthly.years_id;
                    crudService.update($scope.year,'years').then(function(data)
                    {
                        if(data['estado'] == true){
                            $('#miventana2').modal('hide');
                            alert('editado correctamente');
                            

                            crudService.select('years','select').then(function (data) {
                                $scope.years = data;
                                //$scope.cashMonthly.years_id=$scope.years[0].id; 
                            });
                            

                        }else{
                            $scope.errors =data;
                        }
                    });
                    $scope.mostrardata1=false;
                };

                $scope.deleteExpense=function(){
                    crudService.byId($scope.cashMonthly.expenseMonthlys_id,'expenses').then(function (data) {
                        //alert(data.name);
                        crudService.destroy(data,'expenseMonthlys').then(function(data)
                            {  
                                if(data['estado'] == true){
                                    $('#miventana1').modal('hide');
                                    alert("Eliminado Correctamente");
                                    
                                    crudService.select('expenses','select').then(function (data) {
                                        $scope.expenses = data;
                                        $scope.cashMonthly.expenseMonthlys_id=$scope.expenses[0].id; 
                                    });
                                    //cashMonthly.years_id='1';
                                }else{
                                    $scope.errors = data;
                                    //alert("Concepto en USO");
                                }
                            });
                    });   
                }
                $scope.updatecashExpense = function(){
                    $scope.expense.id=$scope.cashMonthly.expenseMonthlys_id;
                    alert($scope.expense.name);
                    
                    crudService.update($scope.expense,'expenseMonthlys').then(function(data)
                    {
                        if(data['estado'] == true){
                            $('#miventana1').modal('hide');
                            alert('editado correctamente');
                            
                            crudService.select('expenses','select').then(function (data) {
                                $scope.expenses = data;
                            });
                        }else{
                            $scope.errors =data;
                        }
                    });
                     $scope.mostrardata=false;
                };

            }]);
})();
