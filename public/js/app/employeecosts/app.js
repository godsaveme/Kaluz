(function(){
    var app = angular.module('employeecosts',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'employeecosts.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
