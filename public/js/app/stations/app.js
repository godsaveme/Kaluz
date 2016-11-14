(function(){
    var app = angular.module('stations',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'stations.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();