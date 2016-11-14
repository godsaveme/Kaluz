(function(){
    var app = angular.module('brands',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'brands.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();