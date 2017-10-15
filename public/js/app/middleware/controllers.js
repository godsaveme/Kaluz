(function(angular){
    angular
        .module('warehouseProductTypeMiddleware.controllers',[])
        .controller('warehouseProductTypeMiddlewareController', warehouseProductTypeMiddlewareController);

        warehouseProductTypeMiddlewareController.$inject = ['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log'];

        function warehouseProductTypeMiddlewareController($scope, $routeParams,$location,crudService,socket,$filter,$route,$log) {

            var vm = this;

            activate();

            function activate(){
                getStores();
                getWarehouses();
            }

            function getStores(){
                crudService
                    .all('stores')
                    .then(function (data){
                        //console.log(data);
                        vm.stores = data.data;
                        vm.store = vm.stores[0];
                    });
            }

            function getWarehouses(){
                crudService
                    .all('warehouses')
                    .then(function (data){
                        //console.log(data);
                        vm.warehouses = data;
                        vm.warehouse = vm.warehouses[0];
                    });
            }

        }
})(angular);