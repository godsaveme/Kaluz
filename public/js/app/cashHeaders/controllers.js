(function(){
    angular.module('cashHeaders.controllers',[])
        .controller('CashHeadersController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.cashHeaders = [];
                $scope.cashHeader;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores = {};
                $scope.store={};
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cashHeaders',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cashHeaders = data.data;
                    });
                    }else{
                        crudService.paginate('cashHeaders',$scope.currentPage).then(function (data) {
                            $scope.cashHeaders = data.data;
                        });
                    }
                };


                
                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cashHeaders').then(function (data) {
                        $scope.cashHeader = data;
                    });
                    crudService.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                }else{
                    crudService.paginate('cashHeaders',1).then(function (data) {
                        $scope.cashHeaders = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 2;
                    });
                    crudService.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                }

                socket.on('cashHeaders.update', function (data) {
                    $scope.cashHeaders=JSON.parse(data);
                });
                


                $scope.searchcashHeader = function(){
                if ($scope.query.length > 0) {
                    //alert($scope.query);
                    crudService.search('cashHeaders',$scope.query,1).then(function (data){
                        $scope.cashHeaders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cashHeaders',1).then(function (data) {
                        $scope.cashHeaders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createcashHeader = function(){
                    //$scope.cashHeader.estado = 1;
                    if ($scope.cashHeaderCreateForm.$valid) {
                        crudService.create($scope.cashHeader, 'cashHeaders').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/cashHeaders');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editcashHeader = function(row){
                    $location.path('/cashHeaders/edit/'+row.id);
                };

                $scope.updatecashHeader = function(){
                   if ($scope.cashHeaderCreateForm.$valid) {
                        crudService.update($scope.cashHeader,'cashHeaders').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/cashHeaders');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletecashHeader = function(row){
                    $scope.cashHeader = row;
                    alert(row.nombre);
                }

                $scope.cancelcashHeader = function(){
                    $scope.cashHeader = {};
                }

                $scope.destroycashHeader = function(){
                    crudService.destroy($scope.cashHeader,'cashHeaders').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cashHeader = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();