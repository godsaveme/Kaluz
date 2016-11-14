(function(){
    angular.module('crudPurchases.services',[])
        .factory('crudPurchase',['$http', '$q','$location', function($http, $q,$location){

            function all(uri,estado)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/all/'+estado)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function eligirNumero(id,id2){

                var deferred = $q.defer();
                $http.get('/api/atributes/selectNumber/'+id+'/'+id2).success(function (data) {
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
            function paginateDPedido(id,uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginatep/'+id).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function MostrarAtributos(id,vari)
            {
                var deferred = $q.defer();
                $http.get('api/variants/paginatep/'+id+'/'+vari).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
             function MostrarTallas(id,taco)
            {
                var deferred = $q.defer();
                $http.get('/api/variants/selectTalla/'+id+'/'+taco).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
             function MostrarTotalDeudas(id)
            {
                var deferred = $q.defer();
                $http.get('/api/pendientAccounts/saldost/'+id).success(function (data) {
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
                    })
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
                );
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
            function bytraervar(id,uri) {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/findVariant/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            function traerEmpresa(id){
                var deferred = $q.defer();
                $http.get('/api/orderPurchases/mostrarEmpresa/'+id)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            /*function traerCodigo() {
                var deferred = $q.defer();
                $http.get('/api/purchases/mostarUltimoagregado')
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }*/
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

            function select(uri,select)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/'+select)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function autocomplit(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit/')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function autocomplitVar(uri,sku)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit/'+sku)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function listaCashes(uri,alm)
            {
                var deferred = $q.defer();
                $http.get('/api/cashHeaders/cajasActivas/'+alm)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function paginatVariants(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/Paginar_por_Variante')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function comprovarCaja(id){
                 var deferred = $q.defer();
                $http.get('api/detCashes/compCajaActiva/'+id).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
             function paginarfechaTipo(uri,fecha1,fecha2,estado)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginarfechaTipo/'+fecha1+"/"+fecha2+"/"+estado).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            

            function paginarporfechas(uri,fecha1,fecha2)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginar/'+fecha1+"/"+fecha2).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function reporteRangoFechasEstado(uri,fecha1,fecha2,estado)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/reporteRangoFechasEstado/'+fecha1+'/'+fecha2+'/'+estado)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            function reporteRangoFechas(uri,fecha1,fecha2)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/reporteRangoFechas/'+fecha1+'/'+fecha2)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
             function reporteEstado(uri,estado)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/reporteEstado/'+estado)
                    .success(function(data)
                    {
                        deferred.resolve(data);
                    }
                );
                return deferred.promise;
            }
            function Reportes(id,uri)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+id).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            return {
                all: all,
                paginate: paginate,
                create:create,
                Reportes: Reportes,
                byId:byId,
                update:update,
                reporteRangoFechas: reporteRangoFechas, 
                reporteEstado: reporteEstado,  
                reporteRangoFechasEstado: reporteRangoFechasEstado,
                paginarfechaTipo: paginarfechaTipo,
                paginarporfechas: paginarporfechas,
                destroy:destroy,
                search: search,
                select:select,
                byforeingKey: byforeingKey,
                bytraervar: bytraervar,
                comprovarCaja: comprovarCaja,
                //traerCodigo: traerCodigo,
                traerEmpresa: traerEmpresa,
                paginateDPedido: paginateDPedido,
                autocomplit: autocomplit,
                autocomplitVar: autocomplitVar,
                eligirNumero: eligirNumero,
                MostrarAtributos: MostrarAtributos,
                MostrarTallas: MostrarTallas,
                MostrarTotalDeudas: MostrarTotalDeudas,
                listaCashes: listaCashes,
                paginatVariants: paginatVariants
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
