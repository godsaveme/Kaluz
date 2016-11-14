(function(){
    var app = angular.module('purchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'purchases.controllers',
        'crudOPurchases.services',
        'routes',
        'ui.bootstrap',
        'ngProgress'
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
})();
