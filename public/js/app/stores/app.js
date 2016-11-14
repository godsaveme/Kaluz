(function(){
    var app = angular.module('stores',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'stores.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();