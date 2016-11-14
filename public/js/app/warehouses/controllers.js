(function(){
    angular.module('warehouses.controllers',[])
        .controller('WarehouseController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.warehouses = [];
                $scope.warehouse = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores;
                $scope.warehouse.store_id='1';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('warehouses',$scope.query,$scope.currentPage).then(function (data){
                        $scope.warehouses = data.data;
                    });
                    }else{
                        crudService.paginate('warehouses',$scope.currentPage).then(function (data) {
                            $scope.warehouses = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'warehouses').then(function (data) {
                        $scope.warehouse = data;
                    });
                    crudService.select('stores','select').then(function(data){
                        $scope.stores = data;

                    })
                }else{
                    crudService.paginate('warehouses',1).then(function (data) {
                        $scope.warehouses = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudService.select('stores','select').then(function(data){
                        $scope.stores = data;
                        //alert($scope.stores);
                        //$log.log($scope.stores);
                    })
                }

                socket.on('warehouse.update', function (data) {
                    $scope.warehouses=JSON.parse(data);
                });

                $scope.searchWarehouse = function(){
                if ($scope.query.length > 0) {
                    crudService.search('warehouses',$scope.query,1).then(function (data){
                        $scope.warehouses = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('warehouses',1).then(function (data) {
                        $scope.warehouses = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createWarehouse = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.warehouseCreateForm.$valid) {
                        crudService.create($scope.warehouse, 'warehouses').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/warehouses');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editWarehouse = function(row){
                    $location.path('/warehouses/edit/'+row.id);
                };

                $scope.updateWarehouse = function(){

                    if ($scope.warehouseCreateForm.$valid) {
                        crudService.update($scope.warehouse,'warehouses').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/warehouses');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteWarehouse = function(row){
                    $scope.warehouse = row;
                }

                $scope.cancelWarehouse = function(){
                    $scope.warehouse = {};
                }

                $scope.destroyWarehouse = function(){
                    crudService.destroy($scope.warehouse,'warehouses').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.warehouse = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
