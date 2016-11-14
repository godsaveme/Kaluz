(function(){
    var app = angular.module('atributes',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'atributes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
