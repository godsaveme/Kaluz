(function(){
    angular.module('practicas.controllers',[])
        .controller('PracticaController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.practicas = [];
                $scope.practica = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('practicas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.practicas = data.data;
                    });
                    }else{
                        crudService.paginate('practicas',$scope.currentPage).then(function (data) {
                            $scope.practicas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'practicas').then(function (data) {
                        $scope.practica = data;
                    });
                }else{
                    crudService.paginate('practicas',1).then(function (data) {
                        $scope.practicas = data.data;
                        $scope.maxSize = 2;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = data.per_page;
                        //$scope.itemsperPage = data.per_page;

                    });
                }

                socket.on('practica.update', function (data) {
                    $scope.practicas=JSON.parse(data);
                });

                $scope.searchpracticas = function(){
                if ($scope.query.length > 0) {
                    crudService.search('practicas',$scope.query,1).then(function (data){
                        $scope.practicas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('practicas',1).then(function (data) {
                        $scope.practicas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createpractica = function(){
                    //$scope.atribut.estado = 1;
                    //alert("estoy aca createpractica");
                    if ($scope.practicaCreateForm.$valid) {
                        // alert("estoy aca createpractica 1 : "+practicaCreateForm.nombre.value+" : "+practicaCreateForm.apellidos.value+" : "+practicaCreateForm.edad.value);
                        crudService.create($scope.practica, 'practicas').then(function (data) {
                          
                            if (data['estado'] == true) {
                                //alert("estoy aca createpractica 2");
                                $scope.success = data['nombre'];
                                alert('grabado correctamente');
                                $location.path('/practicas');

                            } else {
                                //alert("estoy aca createpractica 3");
                                $scope.errors = data;


                            }
                        });
                    }
                }


                $scope.editpractica = function(row){
                    $location.path('/practicas/edit/'+row.id);
                };

                $scope.updatepractica = function(){

                    if ($scope.practicaCreateForm.$valid) {
                        crudService.update($scope.practica,'practicas').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/practicas');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletepractica = function(row){
                    $scope.practica = row;
                }

                $scope.cancelpractica = function(){
                    $scope.practica = {};
                }

                $scope.destroypractica = function(){
                    crudService.destroy($scope.practica,'practicas').then(function(data)
                    {
                        if(data['estado'] == true){
                            //$scope.success = data['nombres'];
                            $scope.practica = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
