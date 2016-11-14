(function(){
    var app = angular.module('cashes',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'cashes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
     app.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value, 10);
      });
    }
  };
});
})();