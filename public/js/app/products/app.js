(function(){
    var app = angular.module('products',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'products.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap',
        'ngProgress',
        'ui.slider'
    ]);
    
    app.run(function($rootScope,ngProgressFactory) {
        var progressbar = ngProgressFactory.createInstance();
        $rootScope.$on('$routeChangeStart', function(ev,data) {
            progressbar.start();
        });
        $rootScope.$on('$routeChangeSuccess', function(ev,data) {
            progressbar.complete();
        });
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
    app.value('trouble', {});
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl', function ($scope, $modalInstance, crudService) {


        $scope.createBrand = function () {
            //$modalInstance.close($scope.selected.item);
            //$scope.atribut.estado = 1;
            if ($scope.brandCreateForm.$valid) {
                var $btn = $('#btn_generateMarca').button('loading');
                crudService.create($scope.brand, 'brands').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        //$location.path('/brands');

                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelBrand = function () {
            $modalInstance.dismiss('cancel');
        };
        $scope.AutogenerateCod=function(nombre){
                    
                    var separador = " ";
                    var aregloSubcadena=new Array();
                    var aregloSubcadena=nombre.split(separador);
                    if(aregloSubcadena.length>1){
                        $scope.brand.shortname=aregloSubcadena[0].substring(0,2)+aregloSubcadena[1].substring(0,1);
                    }else{
                        $scope.brand.shortname=aregloSubcadena[0].substring(0,3); 
                    }
                    
                }
    });
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl2', function ($scope, $modalInstance, crudService) {

        $scope.createLine = function () {
            //$modalInstance.close($scope.selected.item);
            //$scope.atribut.estado = 1;
            if ($scope.TtypeCreateForm.$valid) {
                var $btn = $('#btn_generateLinea').button('loading');
                crudService.create($scope.Ttype, 'types').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        //$location.path('/types');

                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelLine = function () {
            $modalInstance.dismiss('cancel');
        };
        $scope.AutogenerateCod=function(nombre){
                    var separador = " ";
                    var aregloSubcadena=new Array();
                    var aregloSubcadena=nombre.split(separador);
                    if(aregloSubcadena.length>1){
                        $scope.Ttype.shortname=aregloSubcadena[0].substring(0,2)+aregloSubcadena[1].substring(0,1);
                    }else{
                        $scope.Ttype.shortname=aregloSubcadena[0].substring(0,3); 
                    }
                    
                }
    });
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl3', function ($scope, $modalInstance, crudService) {

        $scope.createMaterial = function () {
            if ($scope.materialCreateForm.$valid) {
                crudService.create($scope.material, 'materials').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        //$location.path('/materials');

                    } else {
                        $scope.errors = data;

                    }
                });
            }
        };

        $scope.cancelMaterial = function () {
            $modalInstance.dismiss('cancel');
        };

    });
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl4', function ($scope, $modalInstance, crudService) {

        $scope.createStation = function () {
            if ($scope.stationCreateForm.$valid) {
                var $btn = $('#btn_generateEstacion').button('loading');
                crudService.create($scope.station, 'stations').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente')
                        $modalInstance.dismiss('cancel');
                        //$location.path('/stations');

                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelStation = function () {
            $modalInstance.dismiss('cancel');
        };
        $scope.AutogenerateCod=function(nombre){
                    var separador = " ";
                    var aregloSubcadena=new Array();
                    var aregloSubcadena=nombre.split(separador);
                    if(aregloSubcadena.length>1){
                        $scope.station.shortname=aregloSubcadena[0].substring(0,2)+aregloSubcadena[1].substring(0,1);
                    }else{
                        $scope.station.shortname=aregloSubcadena[0].substring(0,3); 
                    }
                    
                }
    });
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl5', function ($scope, $modalInstance, crudService) {



        $scope.createAttribute = function () {
            //alert('hola');
            //return false;
            if ($scope.atributCreateForm.$valid) {
                crudService.create($scope.atribut, 'atributes').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        //$location.path('/atributes');

                    } else {
                        $scope.errors = data;

                    }
                });
            }
        };
        
        $scope.cancelAttribute = function () {
            $modalInstance.dismiss('cancel');
        };
    });
})(window.angular);
