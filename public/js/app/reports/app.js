(function(){
    var app = angular.module('reports',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'reports.controllers',
        'crud.reports',
        'routes',
        'ui.bootstrap'
    ]);
})();