(function(){
    var app = angular.module('materials',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'materials.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();