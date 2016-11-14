(function(){
    angular.module('brands.controllers',[])
        .controller('BrandController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.brands = [];
                $scope.brand = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('brands',$scope.query,$scope.currentPage).then(function (data){
                        $scope.brands = data.data;
                    });
                    }else{
                        crudService.paginate('brands',$scope.currentPage).then(function (data) {
                            $scope.brands = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'brands').then(function (data) {
                        $scope.brand = data;
                    });
                }else{
                    crudService.paginate('brands',1).then(function (data) {
                        $scope.brands = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('brand.update', function (data) {
                    $scope.brands=JSON.parse(data);
                });

                $scope.searchBrand = function(){
                if ($scope.query.length > 0) {
                    crudService.search('brands',$scope.query,1).then(function (data){
                        $scope.brands = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('brands',1).then(function (data) {
                        $scope.brands = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.validanomMarca=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('brands',texto).then(function (data){
                        $scope.brand = data;
                        if($scope.brand!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.brand.nombre=''; 
                           $scope.brand.shortname=''; 
                        }
                    });
                    }
               }

                $scope.createBrand = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.brandCreateForm.$valid) {
                        crudService.create($scope.brand, 'brands').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/brands');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editBrand = function(row){
                    $location.path('/brands/edit/'+row.id);
                };

                $scope.updateBrand = function(){

                    if ($scope.brandCreateForm.$valid) {
                        crudService.update($scope.brand,'brands').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/brands');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteBrand = function(row){
                    $scope.brand = row;
                }

                $scope.cancelBrand = function(){
                    $scope.brand = {};
                }

                $scope.destroyBrand = function(){
                    crudService.destroy($scope.brand,'brands').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.brand = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
