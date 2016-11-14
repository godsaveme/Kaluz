(function(){
    angular.module('stations.controllers',[])
        .controller('StationController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.stations = [];
                $scope.station = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('stations',$scope.query,$scope.currentPage).then(function (data){
                        $scope.stations = data.data;
                    });
                    }else{
                        crudService.paginate('stations',$scope.currentPage).then(function (data) {
                            $scope.stations = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'stations').then(function (data) {
                        $scope.station = data;
                    });
                }else{
                    crudService.paginate('stations',1).then(function (data) {
                        $scope.stations = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('station.update', function (data) {
                    $scope.stations=JSON.parse(data);
                });

                $scope.searchStation = function(){
                if ($scope.query.length > 0) {
                    crudService.search('stations',$scope.query,1).then(function (data){
                        $scope.stations = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('stations',1).then(function (data) {
                        $scope.stations = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createStation = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.stationCreateForm.$valid) {
                        crudService.create($scope.station, 'stations').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/stations');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editStation = function(row){
                    $location.path('/stations/edit/'+row.id);
                };

                $scope.updateStation = function(){

                    if ($scope.stationCreateForm.$valid) {
                        crudService.update($scope.station,'stations').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/stations');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };
                 $scope.validanomStacion=function(texto){
                 alert("hola");
                   if(texto!=undefined){
                        crudService.validar('stations',texto).then(function (data){
                        $scope.station = data;
                        alert($scope.station);
                        if(data!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.station.nombre=''; 
                           $scope.station.shortname=''; 
                        }
                    });
                    }
               }
                $scope.deleteStation = function(row){
                    
                    $scope.station = row;
                }

                $scope.cancelStation = function(){
                    $scope.station = {};
                }

                $scope.destroyStation = function(){
                    crudService.destroy($scope.station,'stations').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.station = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
