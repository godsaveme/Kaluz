(function(){
    angular.module('types.controllers',[])
        .controller('TypeController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.types = [];
                $scope.Ttype = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('types',$scope.query,$scope.currentPage).then(function (data){
                        $scope.types = data.data;
                    });
                    }else{
                        crudService.paginate('types',$scope.currentPage).then(function (data) {
                            $scope.types = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'types').then(function (data) {
                        $scope.Ttype = data;
                    });
                }else{
                    crudService.paginate('types',1).then(function (data) {
                        $scope.types = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('Ttype.update', function (data) {
                    $scope.types=JSON.parse(data);
                });

                $scope.searchBrand = function(){
                if ($scope.query.length > 0) {
                    crudService.search('types',$scope.query,1).then(function (data){
                        $scope.types = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('types',1).then(function (data) {
                        $scope.types = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createType = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.TtypeCreateForm.$valid) {
                        crudService.create($scope.Ttype, 'types').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/types');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editType = function(row){
                    $location.path('/types/edit/'+row.id);
                };

                $scope.updateType = function(){

                    if ($scope.TtypeCreateForm.$valid) {
                        crudService.update($scope.Ttype,'types').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/types');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteType = function(row){
                    $scope.Ttype = row;
                }

                $scope.cancelType = function(){
                    $scope.Ttype = {};
                }

                $scope.destroyType = function(){
                    crudService.destroy($scope.Ttype,'types').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.Ttype = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
