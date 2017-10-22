(function(angular){
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

                $scope.getStores = getStores;


                $scope.pageChanged = function() {
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
                    crudService.byId(id,'employees').then(function (data) {
                        $log.log(data);
                        if(data.fechanac != null) {
                            if (data.fechanac.length > 0) {
                                data.fechanac = new Date(data.fechanac);
                                $log.log(data.fechanac);
                            }
                        }


                        $scope.employee = data;
                        $scope.employee.autogenerado = false;
                    });
                    getStores();
                    
                }else{
                    crudService.paginate('employees',1).then(function (data) {
                        $scope.employees = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    getStores();
                }

                function getStores(){
                    crudService
                        .all('stores')
                        .then(function (data){
                            $scope.stores = data.data;
                            if(!id){
                                $scope.employee.store_id="1";
                            }
                        });
                }
                 
                  $scope.editCostos=function(row){
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
                            $scope.employeecost.comisiones=parseFloat($scope.employeecost.comisiones);

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
                        if(f){
                            if(f.size <= 400000) {
                        var r = new FileReader();
                        r.onloadend = function(e) {
                            $scope.employee.imagen = e.target.result;
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
                    $scope.employeecost.total=(parseFloat($scope.employeecost.SueldoFijo)+parseFloat($scope.employeecost.seguro)+
                                              parseFloat($scope.employeecost.menu)+parseFloat($scope.employeecost.pasajes))
                                              -parseFloat($scope.employeecost.descuento);
                   }
               
                
            }]);
})(angular);