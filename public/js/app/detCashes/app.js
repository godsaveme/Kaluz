(function(){
    var app = angular.module('detCashes',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'detCashes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();