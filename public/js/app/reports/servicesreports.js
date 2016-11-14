(function(){
    angular.module('crud.reports',[])
        .factory('crudReports',['$http', '$q','$location', function($http, $q,$location){

            function all(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/all')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }

            function paginate(uri,page)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginate/?page='+page).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }

            function create(area,uri)
            {
                var deferred = $q.defer();
                $http.post( '/api/'+uri+'/create', area )
                    .success(function (data)
                    {
                        deferred.resolve(data);
                    }).error(function(data)
                {
                    alert('No se puede Agregar');
                });
                //    .error(function (data) //add for user , error send by 422 status
                //    {
                //        deferred.resolve(data);
                //    })
                ;
                return deferred.promise;
            }

            function update(area,uri)
            {
                var deferred = $q.defer();
                $http.put('/api/'+uri+'/edit', area )
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }

            function destroy(area,uri)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/destroy', area )
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                ).error(function(data)
                {
                    alert('Item en USO');
                });
                return deferred.promise;
            }
            function byforeingKey(uri,fx,id){
               var deferred = $q.defer();
               $http.get('/api/'+uri+'/'+fx+'/'+id)
                .success(function(data){
                     deferred.resolve(data);
                });
                return deferred.promise;
            }

            function byId(id,uri) {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/find/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }

            function search(uri,query,page){
                var deferred = $q.defer();
                var result = $http.get('/api/'+uri+'/search/'+query+'/?page='+page);

                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }

            function searchWarehouses(uri,query,idStore,page){
                var deferred = $q.defer();
                var result = $http.get('/api/'+uri+'/search/'+query+'/'+idStore+'/?page='+page);

                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }

            function searchMes(uri,mes,year,conc,page){
                var deferred = $q.defer();
                var result = $http.get('/api/'+uri+'/search/'+mes+'/'+year+'/'+conc+'/?page='+page);


                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }


            function reportPro(uri,id){
                var deferred = $q.defer();
                var result =$http.post('/api/'+uri+'/'+id);

                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }

            function reportProWare(uri,idStore,idWerehouse){
                var deferred = $q.defer();
                var result = $http.post('/api/'+uri+'/'+idStore+'/'+idWerehouse);

                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }
            function reportTikets(idvar){
                var deferred = $q.defer();
                var result = $http.post('/api/report/tiket/'+idvar);
                                          //api/reports/tiket/
                result.success(function(data){
                        deferred.resolve(data);
                });
                return deferred.promise;
            }

            function select(uri,select)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/'+select)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }

            return {
                all: all,
                paginate: paginate,
                create:create,
                byId:byId,
                update:update,
                destroy:destroy,
                search: search,
                select:select,
                byforeingKey: byforeingKey,
                searchMes,searchMes,
                reportPro,reportPro,
                reportProWare,reportProWare,
                searchWarehouses,searchWarehouses,
                reportTikets: reportTikets
            }
        }])
        .factory('socketService', function ($rootScope) {
            var host = window.location.hostname;
            //var host = '192.168.0.26';
            var socket = io.connect('http://'+host+':3001');
            return {
                on: function (eventName, callback) {
                    socket.on(eventName, function () {
                        var args = arguments;
                        $rootScope.$apply(function () {
                            callback.apply(socket, args);
                        });
                    });
                },
                emit: function (eventName, data, callback) {
                    socket.emit(eventName, data, function () {
                        var args = arguments;
                        $rootScope.$apply(function () {
                            if (callback) {
                                callback.apply(socket, args);
                            }
                        });
                    })
                }
            };
        });
})();
