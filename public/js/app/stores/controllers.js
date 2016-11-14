(function(){
    angular.module('stores.controllers',[])
        .controller('StoreController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.stores = [];
                $scope.store;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('stores',$scope.query,$scope.currentPage).then(function (data){
                        $scope.stores = data.data;
                    });
                    }else{
                        crudService.paginate('stores',$scope.currentPage).then(function (data) {
                            $scope.stores = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'stores').then(function (data) {
                        $scope.store = data;
                    });
                }else{
                    crudService.paginate('stores',1).then(function (data) {
                        $scope.stores = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 2;

                    });
                }

                socket.on('stores.update', function (data) {
                    $scope.stores=JSON.parse(data);
                });

                $scope.searchStore = function(){
                if ($scope.query.length > 0) {
                    crudService.search('stores',$scope.query,1).then(function (data){
                        $scope.stores = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('stores',1).then(function (data) {
                        $scope.stores = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createStore = function(){
                    //$scope.store.estado = 1;
                    if ($scope.storeCreateForm.$valid) {
                        crudService.create($scope.store, 'stores').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/stores');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editStore = function(row){
                    $location.path('/stores/edit/'+row.id);
                };

                $scope.updateStore = function(){
                   if ($scope.storeCreateForm.$valid) {
                        crudService.update($scope.store,'stores').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/stores');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteStore = function(row){
                    $scope.store = row;
                }

                $scope.cancelStore = function(){
                    $scope.store = {};
                }

                $scope.destroyStore = function(){
                    crudService.destroy($scope.store,'stores').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.store = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();