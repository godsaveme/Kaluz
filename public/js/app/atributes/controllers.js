(function(){
    angular.module('atributes.controllers',[])
        .controller('AtributController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.atributes = [];
                $scope.atribut;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('atributes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.atributes = data.data;
                    });
                    }else{
                        crudService.paginate('atributes',$scope.currentPage).then(function (data) {
                            $scope.atributes = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'atributes').then(function (data) {
                        $scope.atribut = data;
                    });
                }else{
                    crudService.paginate('atributes',1).then(function (data) {
                        $scope.atributes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('atributes.update', function (data) {
                    $scope.atributes=JSON.parse(data);
                });

                $scope.searchAtribut = function(){
                if ($scope.query.length > 0) {
                    crudService.search('atributes',$scope.query,1).then(function (data){
                        $scope.atributes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('atributes',1).then(function (data) {
                        $scope.atributes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createAtribut = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.atributCreateForm.$valid) {
                        crudService.create($scope.atribut, 'atributes').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/atributes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editAtribut = function(row){
                    $location.path('/atributes/edit/'+row.id);
                };

                $scope.updateAtribut = function(){
                   if ($scope.atributCreateForm.$valid) {
                        crudService.update($scope.atribut,'atributes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/atributes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteAtribut = function(row){
                    $scope.atribut = row;
                }

                $scope.cancelAtribut = function(){
                    $scope.atribut = {};
                }

                $scope.destroyAtribut = function(){
                    crudService.destroy($scope.atribut,'atributes').then(function(data)
                    {
                         if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.atribut = {};
                            
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();