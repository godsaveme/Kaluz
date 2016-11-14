(function(){
    var app = angular.module('suppliers',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'suppliers.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
