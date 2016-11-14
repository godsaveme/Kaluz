(function(){
    var app = angular.module('promotions',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'promotions.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
