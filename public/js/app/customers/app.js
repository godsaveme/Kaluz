(function(){
    var app = angular.module('customers',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'customers.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
