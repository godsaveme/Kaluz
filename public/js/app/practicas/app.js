(function(){
    var app = angular.module('practicas',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'practicas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();