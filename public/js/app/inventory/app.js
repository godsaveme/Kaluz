(function(){
    var app = angular.module('inventory',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'inventory.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();