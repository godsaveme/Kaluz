(function(){
    var app = angular.module('cashHeaders',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'cashHeaders.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();