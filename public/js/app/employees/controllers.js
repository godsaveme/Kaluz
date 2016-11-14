(function(){
    angular.module('employees.controllers',[])
        .controller('EmployeeController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.employees = [];
                $scope.employee={};
                $scope.errors = null;
                $scope.close;
                $scope.codigo;
                $scope.mostraragregar;
                $scope.mostrarver;
                $scope.estado=false;
                $scope.ngenabled=true;
                $scope.employeecost={};
                $scope.employeecosts;
                $scope.employee.autogenerado = true;
                $scope.query = '';
                $scope.employee.estado=1;
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                     //$scope.employee.estado='1';
                    if ($scope.query.length > 0) {
                        crudService.search('employees',$scope.query,$scope.currentPage).then(function (data){
                        $scope.employees = data.data;
                    });
                    }else{
                        crudService.paginate('employees',$scope.currentPage).then(function (data) {
                            $scope.employees = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    //$scope.employee.estado=1;
                    crudService.byId(id,'employees').then(function (data) {
                        $log.log(data);
                        if(data.fechanac != null) {
                            if (data.fechanac.length > 0) {

                                data.fechanac = new Date(data.fechanac);
                                $log.log(data.fechanac);
                                //data.employee.fechanac = new Date(data.fechanac);
                            }
                        }
                       

                        $scope.employee = data;
                        $scope.employee.autogenerado = false;
                    });
                    
                }else{
                    //$scope.employee.estado='1';
                    crudService.paginate('employees',1).then(function (data) {
                        $scope.employees = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('employees.update', function (data) {
                    $scope.employees=JSON.parse(data);
                });
                 
                  $scope.editCostos=function(row){
                     //  alert(id);
                       crudService.byforeingKey('employeecosts','mostrarCostos',row.id).then(function(data){
                        $scope.employeecost = data;
                        $scope.totalItems=data.total;
                        $scope.estado=true;
                         $scope.mostrarShow=row.nombres;
                        if($scope.employeecost.employee_id>0){
                             $scope.ngenabled=true;
                            $scope.mostraragregar=false;
                            $scope.mostrarver=true;
                            if($scope.employeecost.SueldoFijo!=null)
                                {$scope.employeecost.SueldoFijo=parseFloat($scope.employeecost.SueldoFijo);
                                }else{$scope.employeecost.SueldoFijo=0;}
                            if($scope.employeecost.seguro!=null)
                                {$scope.employeecost.seguro=parseFloat($scope.employeecost.seguro);
                                }else{$scope.employeecost.seguro=0;}
                            if($scope.employeecost.menu!=null)
                                {$scope.employeecost.menu=parseFloat($scope.employeecost.menu);
                                }else{$scope.employeecost.menu=0;}
                            if($scope.employeecost.pasajes!=null)
                                {$scope.employeecost.pasajes=parseFloat($scope.employeecost.pasajes);
                                }else{$scope.employeecost.pasajes=0;}
                            if($scope.employeecost.descuento!=null)
                                {$scope.employeecost.descuento=parseFloat($scope.employeecost.descuento);
                                }else{$scope.employeecost.descuento=0;}
                            if($scope.employeecost.total!=null)
                                {$scope.employeecost.total=parseFloat($scope.employeecost.total);
                                }else{$scope.employeecost.total=0;}
                           // $scope.employeecost.seguro=parseFloat($scope.employeecost.seguro);
                            //$scope.employeecost.menu=parseFloat($scope.employeecost.menu);
                            //$scope.employeecost.pasajes=parseFloat($scope.employeecost.pasajes);
                           // $scope.employeecost.descuento=parseFloat($scope.employeecost.descuento);
                            $scope.employeecost.comisiones=parseFloat($scope.employeecost.comisiones);
                            //$scope.employeecost.total=parseFloat($scope.employeecost.total);

                       }else{
                            $scope.mostraragregar=true;
                            $scope.mostrarver=false;
                            
                            $scope.employeecost.employee_id=row.id;
                            $scope.codigo=row.id;
                            $scope.employeecost.SueldoFijo=0;
                            $scope.employeecost.seguro=0;
                            $scope.employeecost.menu=0;
                            $scope.employeecost.pasajes=0;
                            $scope.employeecost.descuento=0;
                            $scope.employeecost.comisiones=0;
                           
                       }
                    
                    });

                  }
                $scope.searchEmployee = function(){
                if ($scope.query.length > 0) {
                    crudService.search('employees',$scope.query,1).then(function (data){
                        $scope.employees = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('employees',1).then(function (data) {
                        $scope.employees = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
               
                    
                };


                $scope.createEmployee = function(){
                    if ($scope.employeeCreateForm.$valid){
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('employeeImage').files[0] ? document.getElementById('employeeImage').files[0] : null;
                        //alert(f);
                        if(f){
                            if(f.size <= 400000) {
                                var r = new FileReader();
                                r.onloadend = function(e) {
                                    $scope.employee.imagen = e.target.result;
                                    alert("aqui estoy");
                                    crudService.create($scope.employee, 'employees').then(function (data) {

                                        if (data['estado'] == true) {
                                            $scope.success = data['nombres'];
                                            alert('grabado correctamente');
                                            $location.path('/employees');

                                        } else {
                                            $scope.errors = data;
                                            $btn.button('reset');

                                        }
                                    });
                                }
                            }else{
                                alert('Peso de imagen mayor a 400Kb.');
                                $btn.button('reset');
                            }}
                                if(!document.getElementById('employeeImage').files[0]){

                                    crudService.create($scope.employee, 'employees').then(function (data) {

                                        if (data['estado'] == true) {
                                            $scope.success = data['nombres'];
                                            alert('grabado correctamente');
                                            $location.path('/employees');

                                        } else {
                                            $scope.errors = data;
                                            $btn.button('reset');

                                        }
                                    });}

                                if(document.getElementById('employeeImage').files[0] && document.getElementById('employeeImage').files[0].size <= 400000){
                                    r.readAsDataURL(f);
                                }

                            }
                        }
                    ///--------------------------------------------------------------

               

                $scope.editEmployee = function(row){
                    $location.path('/employees/edit/'+row.id);
                };

                $scope.updateEmployee = function(){

                    if ($scope.employeeCreateForm.$valid){
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('employeeImage').files[0] ? document.getElementById('employeeImage').files[0] : null;
                        //alert(f);
                        if(f){
                            if(f.size <= 400000) {
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.employee.imagen = e.target.result;
                           // alert("aqui estoy");
                            crudService.update($scope.employee, 'employees').then(function (data) {

                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/employees');

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }
                            }else{
                                alert('Peso de imagen mayor a 400Kb.');
                                $btn.button('reset');
                            }}
                        if(!document.getElementById('employeeImage').files[0]){

                            crudService.update($scope.employee, 'employees').then(function (data) {

                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Editado correctamente');
                                    $location.path('/employees');

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });}

                        if(document.getElementById('employeeImage').files[0] && document.getElementById('employeeImage').files[0].size <= 400000){
                            r.readAsDataURL(f);
                        }

                    }



                };

                $scope.deleteEmployee = function(row){
                    $scope.employee = row;
                }

                $scope.cancelEmployee = function(){
                    $scope.employee = {};
                }

                $scope.destroyEmployee = function(){
                    crudService.destroy($scope.employee,'employees').then(function(data)
                    {
                         if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.employee = {};
                            
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
               
                $scope.variable2=function(){
                    $scope.estado=false;
                }

                  $scope.createEmployeecost = function(){
                    //$scope.employeecost.estado = 1;
                      

                    if ($scope.employeecostCreateForm.$valid) {
                        crudService.create($scope.employeecost, 'employeecosts').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $scope.close='modal';
                                 $scope.estado=false;
                                $scope.employeecost={};
                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }
                  $scope.updateEmployeecost = function(){
                     crudService.update($scope.employeecost,'employeecosts').then(function(data)
                    {
                         if(data['estado'] == true){
                            alert("editado Correctamente");
                            $scope.success = data['nombre'];
                            $scope.employeecost = {};
                            //$route.reload();
                             $scope.estado=false;
                        }else{
                            $scope.errors = data;
                        }
                    });
                  };
                     /*if ($scope.employeeCreateForm.$valid){
                        var f = document.getElementById('employeeImage').files[0] ? document.getElementById('employeeImage').files[0] : null;
                        //alert(f);

                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.employee.imagen = e.target.result;
                       //alert("aqui estoy");
                           crudService.create($scope.employee, 'employees').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                //$location.path('/employees');

                            } else {
                                $scope.errors = data;

                            }
                        });
                        }
                        if(!document.getElementById('employeeImage').files[0]){
                        crudService.create($scope.employee, 'employees').then(function (data) {
                            //alert("aqui estoy!!");
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                //$location.path('/employees');

                            } else {
                                $scope.errors = data;

                            }
                        });}

                        if(document.getElementById('employeeImage').files[0]){
                            r.readAsDataURL(f);
                        }

                    }
                };*/
                $scope.destroyEmployeecost = function(){
                if(confirm("Esta seguro de querer eliminar este registro de Gastos!!!") == true){
                    crudService.destroy($scope.employeecost,'employeecosts').then(function(data)
                    {
                         if(data['estado'] == true){
                            alert("Eliminado Correctamente");
                            $scope.success = data['nombre'];
                            $scope.employeecost = {};
                            //$route.reload();
                             $scope.estado=false;
                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                }
                $scope.activarDesac=function(){
                    $scope.ngenabled=false;
                }
                $scope.desacAct=function(){
                    $scope.ngenabled=true;
                }
                $scope.CalcCostos=function(){
                    //alert("hola"+$scope.employeecost.SueldoFijo);
                    $scope.employeecost.total=(parseFloat($scope.employeecost.SueldoFijo)+parseFloat($scope.employeecost.seguro)+
                                              parseFloat($scope.employeecost.menu)+parseFloat($scope.employeecost.pasajes))
                                              -parseFloat($scope.employeecost.descuento);
                   /* $scope.employeecost.total=(((parseFloat($scope.employeecost.SueldoFijo)+
                                             parseFloat($scope.employeecost.seguro)+parseFloat($scope.employeecost.menu)+
                                             parseFloat($scope.employeecost.pasajes))-parseFloat($scope.employeecost.descuento)).toFixed(2));
                */}
               
                
            }]);
})();