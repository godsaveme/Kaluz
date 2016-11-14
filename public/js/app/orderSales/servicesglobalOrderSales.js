(function(){
    angular.module('crud.services.orderSales',[])
        .factory('crudServiceOrderSales',['$http', '$q','$location','$route', function($http, $q,$location,$route){

            $oPresentacion = {};

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
            function create1(area,uri)
            {
                var deferred = $q.defer();
                $http.post( '/api/'+uri+'/create', area )
                    .success(function (data)
                    {
                        deferred.resolve(data);
                    }).error(function(data)
                {
                    $route.reload(); 
                    alert('No se puede Agregar');
                });
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

            function editFavoritoId(area,uri)
            {
                var deferred = $q.defer();
                $http.put('/api/'+uri+'/editFavorito', area )
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
                $http.get('/api/'+uri+'/'+id);
            }

            function reportProWare(uri,idStore,idWerehouse,val){
                var deferred = $q.defer();
                //alert(val);
                $http.get('/api/'+uri+'/misDatos/'+idStore+'/'+idWerehouse+'/'+val)
                    .success(function (data) {
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

            function getPres()
            {
                return $oPresentacion;
            }

            function setPres(oPres)
            {
                $oPresentacion = oPres;
            }

            return {
                all: all,
                paginate: paginate,
                create:create,
                create1:create1,
                byId:byId,
                update:update,
                destroy:destroy,
                search: search,
                select:select,
                byforeingKey: byforeingKey,
                searchMes,searchMes,
                reportPro,reportPro,
                reportProWare,reportProWare,
                getPres, setPres,
                editFavoritoId,editFavoritoId
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
