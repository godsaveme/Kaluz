(function(){
    var app = angular.module('warehouses',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'warehouses.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();