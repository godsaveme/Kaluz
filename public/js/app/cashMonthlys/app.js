(function(){
    var app = angular.module('cashMonthlys',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'cashMonthlys.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();