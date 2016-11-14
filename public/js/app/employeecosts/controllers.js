(function(){
    angular.module('employeecosts.controllers',[])
        .controller('EmployeecostController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.employeecosts = [];
                $scope.employeecost;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('employeecosts',$scope.query,$scope.currentPage).then(function (data){
                        $scope.employeecosts = data.data;
                    });
                    }else{
                        crudService.paginate('employeecosts',$scope.currentPage).then(function (data) {
                            $scope.employeecosts = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'employeecosts').then(function (data) {
                        $scope.employeecost = data;
                    });
                    
                }else{
                    crudService.paginate('employeecosts',1).then(function (data) {
                        $scope.employeecosts = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('employeecosts.update', function (data) {
                    $scope.employeecosts=JSON.parse(data);
                });

                $scope.searchEmployeecost = function(){
                if ($scope.query.length > 0) {
                    crudService.search('employeecosts',$scope.query,1).then(function (data){
                        $scope.employeecosts = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('employeecosts',1).then(function (data) {
                        $scope.employeecosts = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEmployeecost = function(){
                    //$scope.employeecost.estado = 1;
                    if ($scope.employeecostCreateForm.$valid) {
                        crudService.create($scope.employeecost, 'employeecosts').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/employeecosts');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editEmployeecost = function(row){
                    $location.path('/employeecosts/edit/'+row.id);
                };

                $scope.updateEmployeecost = function(){
                   if ($scope.employeecostCreateForm.$valid) {
                        crudService.update($scope.employeecost,'employeecosts').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/employeecosts');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteEmployeecost = function(row){
                    $scope.employeecost = row;
                }

                $scope.cancelEmployeecost = function(){
                    $scope.employeecost = {};
                }

                $scope.destroyEmployeecost = function(){
                    crudService.destroy($scope.employeecost,'employeecosts').then(function(data)
                    {
                         if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.employeecost = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();