(function(){
    angular.module('promotions.controllers',[])
        .controller('PromotionController',['$scope', '$routeParams','$location','crudService','socketService' ,
            function($scope, $routeParams,$location,crudService,socket){
                $scope.promotions = [];
                $scope.promotion={};
                $scope.errors = null;
                $scope.success = {};
                $scope.query = '';

                $scope.cantidadOfre;
                $scope.cantidadCobro;
                $scope.descuento;
                $scope.promotion.descuento;
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                //alert("Hola");

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('promotions',$scope.query,$scope.currentPage).then(function (data){
                        $scope.promotions = data.data;
                    });
                    }else{
                        crudService.paginate('promotions',$scope.currentPage).then(function (data) {
                            $scope.promotions = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'promotions').then(function (data) {
                        $scope.promotion = data;
                    });
                }else{
                    crudService.paginate('promotions',1).then(function (data) {
                        $scope.promotions = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('promotion.update', function (data) {
                    $scope.promotions=JSON.parse(data);
                });

                $scope.searchPromotion = function(){
                if ($scope.query.length > 0) {
                    crudService.search('promotions',$scope.query,1).then(function (data){
                        $scope.promotions = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('promotions',1).then(function (data) {
                        $scope.promotions = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.calculateDescuento=function()
                    {
                        //alert($scope.cantidadCobro);
                        //alert($scope.cantidadOfre);
                        if($scope.cantidadCobro==null){
                            alert("Hola !!");
                        }
                        if($scope.cantidadCobro > 0 && $scope.cantidadOfre>0){
                            $scope.promotion.multiplicador=1-($scope.cantidadCobro/$scope.cantidadOfre);
                            $scope.descuento=$scope.promotion.multiplicador*100;
                            alert($scope.promotion.multiplicador);
                            alert($scope.descuento);
                        }else{
                            $scope.promotion.multiplicador=$scope.descuento/100;  
                            alert($scope.promotion.multiplicador); 
                            alert($scope.cantidadCobro); 
                        }
                    }

                $scope.createPromotion = function(){
                    //$scope.person.estado = 1;
                    if($scope.cantidadOfre==null){
                           $scope.promotion.cantidad=1;
                        }
                        
                    crudService.create($scope.promotion,'promotions').then(function(data){
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $location.path('/promotions');
                        }else{
                            $scope.errors =data['error'];
                        }
                    });
                }

                $scope.editPromotion = function(row){
                    $location.path('/promotions/edit/'+row.id);
                };

                $scope.updatePromotion = function(){
                    if ($scope.personCreateForm.$valid) {
                        crudService.update($scope.promotion,'promotions').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombre'];
                                $location.path('/promotions');
                                //alert('true');
                            }else{
                                //$scope.errors =data['error'];
                                $scope.errors =data;
                                //alert('not true');
                            }
                        });
                    }
                };

                $scope.deletePromotion = function(row){
                    $scope.promotion = row;
                }

                $scope.cancelPromotion = function(){
                    $scope.promotion = {};
                }

                $scope.destroyPromotion = function(){
                    crudService.destroy($scope.promotion,'promotions').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.promotion = {};
                        }else{
                            $scope.errors =data['error'];
                        }
                    });
                }
            }]);
})();
