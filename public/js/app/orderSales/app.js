(function(){
    var app = angular.module('orderSales',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'orderSales.controllers',
        'crud.services.orderSales',
        'routes',
        'ui.bootstrap' 
    ]);
    app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
});
    app.directive('stringToNumber', function() {
        return {
            require: 'ngModel',
            link: function(scope, element, attrs, ngModel) {
                ngModel.$parsers.push(function(value) {
                    return '' + value;
                });
                ngModel.$formatters.push(function(value) {
                    return parseFloat(value, 10);
                });
            }
        };
    });
    
    angular.module('orderSales').controller('ModalInstanceCtrl', function ($scope,$log, $modalInstance,presentations,crudServiceOrderSales) {
	$scope.presentations = presentations;
	//$log.log($scope.presentations+"Hola");
/*
  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };
*/
  $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
   $scope.AsignarCompra = function(row){
        //$log.log(row);
        //alert("Equi : "+$scope.atributoSelected.equivalencia);
        //alert("stok : "+$scope.atributoSelected.Stock);
        //if(row.equivalencia<row.Stock || row.equivalencia==row.Stock){
          crudServiceOrderSales.setPres(row);

          crudServiceOrderSales.AsignarCom();
          $scope.cancel();
        //}else{
          //alert("STOK Insuficioente");
        //}
        //$log.log(row);
          //alert($scope.atributoSelected.NombreAtributos);
        //$scope.row1=row;
    };
});

})(); 