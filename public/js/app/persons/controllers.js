(function(){
    angular.module('persons.controllers',[])
        .controller('PersonController',['$scope', '$routeParams','$location','crudService','socketService' ,
            function($scope, $routeParams,$location,crudService,socket){
                $scope.persons = [];
                $scope.person;
                $scope.errors = null;
                $scope.success = {};
                $scope.query = '';
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('persons',$scope.query,$scope.currentPage).then(function (data){
                        $scope.persons = data.data;
                    });
                    }else{
                        crudService.paginate('persons',$scope.currentPage).then(function (data) {
                            $scope.persons = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'persons').then(function (data) {
                        $scope.person = data;
                    });
                }else{
                    crudService.paginate('persons',1).then(function (data) {
                        $scope.persons = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('person.update', function (data) {
                    $scope.persons=JSON.parse(data);
                });

                $scope.searchPerson = function(){
                if ($scope.query.length > 0) {
                    crudService.search('persons',$scope.query,1).then(function (data){
                        $scope.persons = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('persons',1).then(function (data) {
                        $scope.persons = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createPerson = function(){
                    //$scope.person.estado = 1;
                    crudService.create($scope.person,'persons').then(function(data){
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $location.path('/persons');
                        }else{
                            $scope.errors =data['error'];
                        }
                    });
                }

                $scope.editPerson = function(row){
                    $location.path('/persons/edit/'+row.id);
                };

                $scope.updatePerson = function(){
                    if ($scope.personCreateForm.$valid) {
                        crudService.update($scope.person,'persons').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombre'];
                                $location.path('/persons');
                                //alert('true');
                            }else{
                                //$scope.errors =data['error'];
                                $scope.errors =data;
                                //alert('not true');
                            }
                        });
                    }
                };

                $scope.deletePerson = function(row){
                    $scope.person = row;
                }

                $scope.cancelPerson = function(){
                    $scope.person = {};
                }

                $scope.destroyPerson = function(){
                    crudService.destroy($scope.person,'persons').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.person = {};
                        }else{
                            $scope.errors =data['error'];
                        }
                    });
                }
            }]);
})();
