(function(){
    var app = angular.module('types',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'types.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
