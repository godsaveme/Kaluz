(function(){
    angular.module('crudOPurchases.services',[])
        .factory('crudOPurchase',['$http', '$q','$location', function($http, $q,$location){
             $atributes={};
            function all(uri,estado)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/all/'+estado)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function todos(uri)
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
            function paginateDPedido(id,uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginatep/'+id).success(function (data) {
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
            function getTallas(id,uri,taco,almacen){
                var deferred = $q.defer();
                $http.get('/api/variants/'+uri+'/'+id+'/'+taco+'/'+almacen)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
            function setAtrib(id,almacen){
                var deferred = $q.defer();
                $http.get('/api/variants/selectStocksTallaSinTaco/'+id+'/'+almacen)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
             function select2(uri,select)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/select/'+select)
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
              function autocomplit2(uri)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/autocomplit2/')
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function StockActual(uri,vari,alma)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/verStockActual/'+vari+"/"+alma)
                    .success(function (data) {
                        deferred.resolve(data);
                    });

                return deferred.promise;
            }
              function listaCashes(uri,id)
            {
                var deferred = $q.defer();
                $http.get('/api/cashHeaders/cajasActivas/'+id)
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
            function Reportes(id,uri)
            {
                var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+id).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            function reportesMovFecha(uri,fech1,fech2){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+fech1+'/'+fech2).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            function movimientoFechasTipo(uri,fech1,fech2,tipo){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+fech1+'/'+fech2+'/'+tipo).success(function (data) {
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
            function paginarporfechas(uri,fecha1,fecha2)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginar/'+fecha1+"/"+fecha2).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function paginarportipos(uri,tipo)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginartipos/'+tipo).success(function (data) {
                    deferred.resolve(data);
                });

                return deferred.promise;
            }
            function paginarfechaTipo(uri,fecha1,fecha2,tipo)
            {
                var deferred = $q.defer();
                $http.get('/api/'+uri+'/paginarfechaTipo/'+fecha1+"/"+fecha2+"/"+tipo).success(function (data) {
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
            //'/api/'+uri+'/create/'+id+'/'+can
            //==========================Ruta generar reporte product========================
            function reporteProducts(uri,tipo,fecha,tienda){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/generate/'+tipo+'/'+fecha+'/'+tienda).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            function CardexFechasTipo(uri,fech1,fech2,tipo,tienda){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+fech1+'/'+fech2+'/'+tipo+'/'+tienda).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            function cardexTopPrimero(uri,fecha,tienda,tipo){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/generate/'+fecha+'/'+tienda+'/'+tipo).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
             function reportesCardexFecha(uri,fech1,fech2,tienda,tipo){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+fech1+'/'+fech2+'/'+tienda+'/'+tipo).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            function cardexTopVariantPrimero(uri,tipo,fecha,tienda,variant){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/generate/'+tipo+'/'+fecha+'/'+tienda+'/'+variant).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
             function reportesCardexVariantFecha(uri,fech1,fech2,tipo,tienda,variant){
                   var deferred = $q.defer();
                $http.post('/api/'+uri+'/create/'+fech1+'/'+fech2+'/'+tipo+'/'+tienda+'/'+variant).success(function (data) {
                    deferred.resolve(data);
                });
                return deferred.promise;
            }
            //==================================================
            return {
                all: all,
                paginate: paginate,
                create:create,
                CardexFechasTipo: CardexFechasTipo,
                reportesCardexFecha: reportesCardexFecha,
                reporteProducts: reporteProducts,
                movimientoFechasTipo: movimientoFechasTipo,
                paginarporfechas: paginarporfechas,
                cardexTopPrimero: cardexTopPrimero,
                paginarportipos: paginarportipos,
                paginarfechaTipo: paginarfechaTipo,
                byId:byId,
                cardexTopVariantPrimero:cardexTopVariantPrimero,
                reportesCardexVariantFecha:reportesCardexVariantFecha,
                comprovarCaja: comprovarCaja,
                update:update,
                reportesMovFecha: reportesMovFecha,
                destroy:destroy,
                search: search,
                select:select,
                byforeingKey: byforeingKey,
                bytraervar: bytraervar,
                //traerCodigo: traerCodigo,
                traerEmpresa: traerEmpresa,
                paginateDPedido: paginateDPedido,
                autocomplit: autocomplit,
                autocomplit2: autocomplit2,
                select2: select2,
                StockActual: StockActual,
                listaCashes: listaCashes,
                autocomplitVar: autocomplitVar,
                MostrarAtributos: MostrarAtributos,
                MostrarTallas: MostrarTallas,
               getTallas: getTallas,
               setAtrib: setAtrib,
               Reportes: Reportes,
               paginatVariants: paginatVariants,
               todos: todos
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
