(function(){
    var app = angular.module('persons',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'persons.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
