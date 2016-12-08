(function(){
    var app = angular.module('consultas',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'consultas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap',
        'ngAnimate', 
        'ngTouch', 
        'ui.grid'
    ]);
    
})();