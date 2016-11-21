(function(){
    var app = angular.module('otherPheads',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'otherPheads.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();