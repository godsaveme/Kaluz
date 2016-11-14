(function(){
    angular.module('reports.controllers',[])
        .controller('ReportController',['$http','$scope', '$routeParams','$location','crudReports','socketService' ,'$filter','$route','$log',
            function($http, $scope, $routeParams,$location,crudReports,socket,$filter,$route,$log){

                $scope.isCollapsedStore = true;
                $scope.isCollapsedAlmacen = true;

                $scope.productSelected=undefined;
                $scope.warehouseSelected=undefined;
                $scope.storeSelected=undefined;

                $scope.mostrardata=false;
                $scope.mostrardata1=false;
                //----------------------------
                $scope.verdata=function(){
                   $scope.mostrardata=true;

                }
                $scope.ocultardata=function(){
                     $scope.mostrardata=false;
                }                
                $scope.verdata1=function(){
                   $scope.mostrardata1=true;

                }
                $scope.ocultardata1=function(){
                     $scope.mostrardata1=false;
                }                
                 $scope.getProduct = function(val) {
                  return crudReports.search('products',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      return item;
                    });
                  });
                };
                $scope.reportProduct = function () {
                    if ($scope.productSelected!=undefined) {
                    crudReports.reportPro('reports',$scope.productSelected.id).then(function(data){
                        $scope.pdf=data;
                        alert("Reporte generado con Exito");
                    });
                    $scope.verdata();
                    $scope.productSelected=undefined;
                    }else{
                        alert("Elija Producto");
                    }
                };               
                 $scope.getStore = function(val) {
                  return crudReports.search('storeReport',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      return item;
                    });
                  });
                };

                
                 $scope.getWarehouse = function(val) {
                  if ($scope.storeSelected!=undefined) {
                  return crudReports.searchWarehouses('warehouses',val,$scope.storeSelected.id,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      return item;
                    });
                  });
                }else{
                    alert("Elija Tienda");
                };
                };

                $scope.reportProductWarehouse = function () {
                    if ($scope.storeSelected!=undefined && $scope.warehouseSelected!=undefined) {
                    crudReports.reportProWare('reports',$scope.storeSelected.id,$scope.warehouseSelected.id).then(function(data){
                        $scope.pdf1=data;
                        alert("Reporte generado con Exito : ");
                    });
                    $scope.verdata1();
                    $scope.storeSelected=undefined;
                    $scope.warehouseSelected=undefined;
                    }else{
                        alert("Elija Tienda y Almacen");
                    }
                };
                $scope.idVariante;
                $scope.reportTiket = function () {
                  alert($scope.idVariante);
                    if ($scope.idVariante != undefined) {
                    crudReports.reportTikets($scope.idVariante).then(function(data){
                        $scope.pdf1=data;
                        alert("Reporte generado con Exito : ");
                    });
                    //$scope.verdata1();
                    $scope.storeSelected=undefined;
                    $scope.warehouseSelected=undefined;
                    }else{
                        alert("Ingrese un codigo de ");
                    }
                };
                //----------------------------------
                          

            }]);
})();
