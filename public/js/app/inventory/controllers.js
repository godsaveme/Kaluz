(function(){
    angular.module('inventory.controllers',[])
        .controller('InventoryController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.stores = [];
                $scope.store = {};
                $scope.warehouses = [];
                $scope.warehouse = {};
                $scope.variants={};
                /*
                $scope.materials = [];
                $scope.material = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';



                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('materials',$scope.query,$scope.currentPage).then(function (data){
                        $scope.materials = data.data;
                    });
                    }else{
                        crudService.paginate('materials',$scope.currentPage).then(function (data) {
                            $scope.materials = data.data;
                        });
                    }
                };

                */
                $scope.cargarvariants = function () {
                    crudService.reportProWare('variantsAllInventary',$scope.store.id, $scope.warehouse.id,'1').then(function (data) {                        
                        $scope.variants = data;
                    });
                    crudService.search('productName',1).then(function (data){
                        $scope.nameProducts = data;
                    });
                    crudService.search('variantname',1).then(function (data){
                        $scope.nameVariants = data;
                    });
                    crudService.search('typeName',1).then(function (data){
                        $scope.nameLineas = data;
                    }); 
                }

                $scope.mostrarAlmacen = function () {
                    crudService.search('warehousesStore',$scope.store.id).then(function (data){
                        $scope.warehouses = data.data;
                    });                       
                };
                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'materials').then(function (data) {
                        $scope.material = data;
                    });
                }else{
                    crudService.select('stores','select').then(function (data) {                        
                        $scope.stores = data;
                    });
                    
                    crudService.reportProWare('variantsAllInventary',0, 0,'1').then(function (data) {                        
                        $scope.variants = data;
                    });
                }
                /*
                socket.on('material.update', function (data) {
                    $scope.materials=JSON.parse(data);
                });

                $scope.searchMaterial = function(){
                if ($scope.query.length > 0) {
                    crudService.search('materials',$scope.query,1).then(function (data){
                        $scope.materials = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('materials',1).then(function (data) {
                        $scope.materials = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createMaterial = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.materialCreateForm.$valid) {
                        crudService.create($scope.material, 'materials').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/materials');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editMaterial = function(row){
                    $location.path('/materials/edit/'+row.id);
                };

                $scope.updateMaterial = function(){

                    if ($scope.materialCreateForm.$valid) {
                        crudService.update($scope.material,'materials').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/materials');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteMaterial = function(row){
                    $scope.material = row;
                }

                $scope.cancelMaterial = function(){
                    $scope.material = {};
                }

                $scope.destroyMaterial = function(){
                    crudService.destroy($scope.material,'materials').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.material = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }*/
            }]);
})();
