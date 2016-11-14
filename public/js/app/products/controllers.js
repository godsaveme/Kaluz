(function(){
    angular.module('products.controllers',[])
        .controller('ProductController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log','ngProgressFactory','$rootScope','trouble','$window','$modal',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log,ngProgressFactory,$rootScope,trouble,$window,$modal){
                $scope.progressbar = ngProgressFactory.createInstance();
                /*$rootScope.$on('$routeChangeStart', function(ev,data) {
                    $scope.progressbar.start();
                });
                $rootScope.$on('$routeChangeSuccess', function(ev,data) {
                    $scope.progressbar.complete();
                });*/
               

                $scope.stockVariants = [];

                $scope.stockTemplate = 'stockTemplate.html';
                $scope.dsctoTemplate = 'dsctoTemplate.html';

                $scope.areaDscto = {};

                $scope.areaDscto.DsctoVal = 0;
                $scope.areaDscto.DsctoProId = 0;

                $scope.products = [];
                $scope.product = {};
                $scope.variant = {};
                $scope.product.track = true;
                $scope.variant.track = true;
                $scope.product.autogenerado = true;
                $scope.variant.autogenerado = true;
                //$scope.variant.detAtr = [];
                $scope.product.presentations = [];
                $scope.variant.presentations = [];
                $scope.generos = [{name:'Masculino'},{name:'Femenino'}];
                $scope.errors;
                $scope.success;
                $scope.query = '';
                $scope.brands = {};
                $scope.materials = {};
                $scope.types = {};
                $scope.stations = {};
                $scope.product.estado = true;
                $scope.product.hasVariants = true;
                $scope.temporal=[];

                $scope.presentation = {};
                $scope.presentations = [];
                $scope.preAdd = {};
                $scope.presentation.id = '1';
                //$scope.product.presentations = [];
                $scope.presentation.suppPri = 0;
                $scope.presentation.markup = 0;
                $scope.presentation.price = 0;

                $scope.minNumber = 0;

                //dsctos
                $scope.presentation.dscto = 0;
                $scope.presentation.dsctoCant = 0;
                $scope.presentation.pvp = 0;
                //fin


                $scope.warehouses = [];


                $scope.variants = []; //variantes por product_id;

                //$scope.product.presentation_base = '1';

                $scope.product.presentation_base_object = {};
                $scope.variant.presentation_base_object = {};

                //$scope.product.presentation_base_object = {id:1};
                $scope.enabled_presentation_button = true;
                $scope.enabled_createpresentation_button = false;

                /*
                de variants create
                 */
                $scope.categories=[{id:1,nombre:'Dama'},{id:2,nombre:'Caballero'},{id:3,nombre:'Niño'},{id:4,nombre:'Niña'}];
                $scope.variant.category= 1;
                //$log.log($scope.category);
                $scope.attributes = [];
                /*
                ./ de variants create
                 */
                 $scope.temporal2=[];
                $scope.llenarDatosTemp=function(index,row){
                      //alert($scope.temporal[index].stockReal);
                      if($scope.temporal[index].stockReal!=undefined || $scope.temporal[index].stockReal!='' ){

                      $scope.temporal[index].producto=row.proCodigo+"-("+row.braNombre+"/"+row.typNombre+")";
                      $scope.temporal[index].stock=row.stoStockActual;
                      if($scope.temporal[index].stock>$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Sobran "+($scope.temporal[index].stock-$scope.temporal[index].stockReal);
                      }
                      if($scope.temporal[index].stock<$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Faltan "+($scope.temporal[index].stock-$scope.temporal[index].stockReal);
                      }
                      if($scope.temporal[index].stock==$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Correcto";
                      }
                      }
                }
                $scope.llenarDatosTemp2=function(index,row){
                    $log.log(row);
                      //alert($scope.temporal[index].stockReal);
                      if($scope.temporal[index].stockReal!=undefined || $scope.temporal[index].stockReal!='' ){
                      $scope.temporal[index].codigo=row.codigo;
                      $scope.temporal[index].sku=row.sku;
                      $scope.temporal[index].producto="";
                      var i=0;
                      for (i=0;i<row.det_atr.length;i++) { 
                        $scope.temporal[index].producto=$scope.temporal[index].producto+"/"+row.det_atr[i].descripcion;
                      }
                      $scope.temporal[index].stock=row.stock[0].stockActual;
                      if($scope.temporal[index].stock==$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Correcto";
                      }
                      if($scope.temporal[index].stock>$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Sobran "+($scope.temporal[index].stock-$scope.temporal[index].stockReal);
                      }
                      if($scope.temporal[index].stock<$scope.temporal[index].stockReal)
                      {
                        $scope.temporal[index].cuadre="Faltan "+($scope.temporal[index].stock-$scope.temporal[index].stockReal);
                      }
                      }
                }
                $scope.check50=false;
                $scope.inprimirDatosTemp=function(){
                   //for (i = 0; i < $scope.temporal.length; i++) { 
                   //     alert($scope.temporal[i].stock);
                         $scope.temporal.forEach(ShowResults);
                         $scope.check50=true;
                         $scope.check=false;
                   //}
                }
               function ShowResults(item, index) {
                      $scope.temporal2.push($scope.temporal[index]);
                      //demoP.innerHTML = demoP.innerHTML + "index[" + index + "]: " + item + "<br />";
                }

                $scope.calculateSuppPric = function() {//presentation.markup
                    //alert('holi');alert($scope.presentation.suppPri);
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.price = $scope.presentation.suppPri + $scope.presentation.markup * $scope.presentation.suppPri / 100;
                        //alert('pasa');
                        $scope.calculateDscto();
                    }
                };
                $scope.calculateMarkup = function() {
                    //alert('holi');
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.price = $scope.presentation.suppPri + $scope.presentation.markup * $scope.presentation.suppPri / 100;
                        $scope.calculateDscto();
                    }
                };
                $scope.calculatePrice = function() {
                    //alert('holi');
                    if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                        $scope.presentation.markup = ($scope.presentation.price - $scope.presentation.suppPri) * 100 / $scope.presentation.suppPri;
                        $scope.calculateDscto();
                    }
                };

                $scope.calculateDscto = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                    //if(angular.isNumber($scope.presentation.pvp) && angular.isNumber($scope.presentation.price) && angular.isNumber($scope.presentation.dscto) && angular.isNumber($scope.presentation.dsctoCant)){

                        $scope.presentation.pvp = parseFloat($scope.presentation.price) - parseFloat($scope.presentation.dscto) * parseFloat($scope.presentation.price) / 100;
                        $scope.presentation.pvp = parseFloat($scope.presentation.pvp).toFixed(2);

                        $scope.presentation.dsctoCant = parseFloat($scope.presentation.price) - parseFloat($scope.presentation.pvp);
                        $scope.presentation.dsctoCant = parseFloat($scope.presentation.dsctoCant).toFixed(2);
                    //}
                };
                $scope.calculateDsctoCant = function() {
                    //alert('holi');
                    //if(angular.isNumber($scope.presentation.suppPri) && angular.isNumber($scope.presentation.markup) && angular.isNumber($scope.presentation.price)){
                    //if(angular.isNumber($scope.presentation.pvp) && angular.isNumber($scope.presentation.price) && angular.isNumber($scope.presentation.dscto) && angular.isNumber($scope.presentation.dsctoCant)){

                        $scope.presentation.pvp = parseFloat($scope.presentation.price) - parseFloat($scope.presentation.dsctoCant);
                    $scope.presentation.pvp = parseFloat($scope.presentation.pvp).toFixed(2);

                    $scope.presentation.dscto = (parseFloat($scope.presentation.price) - parseFloat($scope.presentation.pvp)) * 100 / parseFloat($scope.presentation.price);
                    $scope.presentation.dscto = parseFloat($scope.presentation.dscto).toFixed(2);
                    //}
                };
                $scope.calculatePVP = function(){
                    //if(angular.isNumber($scope.presentation.pvp) && angular.isNumber($scope.presentation.price) && angular.isNumber($scope.presentation.dscto) && angular.isNumber($scope.presentation.dsctoCant)) {

                        $scope.presentation.dscto = (parseFloat($scope.presentation.price) - parseFloat($scope.presentation.pvp)) * 100 / parseFloat($scope.presentation.price);
                        $scope.presentation.dscto = parseFloat($scope.presentation.dscto).toFixed(2);

                        $scope.presentation.dsctoCant = parseFloat($scope.presentation.price) - parseFloat($scope.presentation.pvp);
                        $scope.presentation.dsctoCant = parseFloat($scope.presentation.dsctoCant).toFixed(2);
                    //}
                    
                }


                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('products',$scope.query,$scope.currentPage).then(function (data){
                        $scope.products = data.data;
                    });
                    }else{
                        crudService.paginate('products',$scope.currentPage).then(function (data) {
                            $scope.products = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                //$log.log($routeParams);

                if(id)
                {
                    if($location.path() == '/products/edit/'+$routeParams.id) {

                                crudService.paginate('products',1).then(function (data) {
                                    $scope.products = data.data;
                                });
                          //  if(!$scope.product.hasVariants){
                                crudService.byforeingKey('variants','variant',id).then(function(data){
                                    $log.log(data);
                                    $scope.product = data.product;
                                    $scope.product.estado = ( $scope.product.estado == 1 );
                                    $scope.product.hasVariants = ($scope.product.hasVariants == 1 );
                                    $scope.product.track = (data.track == 1 ); //de variants
                                    $scope.product.presentations = data.det_pre;
                                    $scope.product.stock = data.stock;
                                    crudService.all('warehouses').then(function (data){
                                        $scope.warehouses = data;
                                    });
                                    $scope.product.sku = data.sku;
                                    //alert(isEmpty(data.stock));
                                    if(isEmpty(data.stock)){
                                        //alert('holi');
                                        $scope.minNumber = null ;
                                    }
                                    $scope.product.autogenerado = false;
                                    crudService.all('presentations_base').then(function(data){
                                        //alert('holi');
                                        $scope.presentations_base = data;
                                        $log.log( $scope.presentations_base);
                                        $scope.obj = $.grep($scope.presentations_base, function(e){ return e.id == $scope.product.presentation_base; });
                                        $scope.product.presentation_base_object = $scope.obj[0];
                                        if(!isEmpty($scope.obj)) {
                                            //$scope.traerPres($scope.product.presentation_base_object.id);
                                            //$scope.changePreBase();
                                            $scope.enabled_presentation_button = false;
                                        }
                                    });

                                });
                            //}



                        crudService.select('products', 'brands').then(function (data) {
                            $scope.brands = data;
                        });
                        crudService.select('products', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('products', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('products', 'stations').then(function (data) {
                            $scope.stations = data;
                        });



                    };

                    if($location.path() == '/products/show/'+$routeParams.id) {
                        //alert('ok');
                        $scope.ProductoID=$routeParams.id;
                        crudService.byId(id,'products').then(function (data){
                            $scope.product = data;
                            if($scope.product.hasVariants == 0){
                                crudService.byforeingKey('variants','variant',$scope.product.id).then(function(data){
                                    $scope.variant = data;
                                    $log.log('Variants,Variant:');
                                    $log.log($scope.variant);
                                })

                            }
                        });
                        $scope.variants = [];
                        crudService.byforeingKey('variants','variants',id). then(function(data)
                        {
                            $scope.variants = data;
                        })

                    };

                    if($location.path() == '/variants/edit/'+$routeParams.id) {
                        crudService.byId($routeParams.id,'variants').then(function (data)
                        {
                            //if(typeof($scope.variant.detAtr) == 'undefined')

                            //$scope.variant = data;
                            $scope.variant.category = data.category;
                            $scope.variant.codigo = data.codigo;
                            $scope.variant.created_at = data.created_at;

                            //$scope.variant.favorite: data.favorite
                            $scope.variant.id = data.id;
                            $scope.variant.image = data.image;

                            $scope.variant.nota = data.nota;
                            $scope.variant.observado = (data.observado == 1);

                            $scope.variant.product_id = data.product_id;
                            $scope.variant.category = parseInt(data.category);



                            //crudService.byId($scope.variant.product_id, 'products').then(function (data) {
                                //$log.log(data);
                            $scope.product = data.product;
                            //$scope.product.estado = ( $scope.product.estado == 1 );
                            //$scope.product.hasVariants = ($scope.product.hasVariants == 1 );
                            $scope.variant.track = (data.track == 1 ); //de variants
                            $scope.variant.presentations = data.det_pre;
                            $scope.variant.stock = data.stock;

                            crudService.all('warehouses').then(function (data){
                                $scope.warehouses = data;
                            });

                            $scope.variant.sku = data.sku;
                            //$scope.variant.detAtrT = data.det_atr;
                            //for (i = 0; i < data.det_atr.length; i++) {
                                //$scope.variant.detAtr[data.det_atr[i].atribute_id].descripcion = data.det_atr[i].descripcion;
                            //    $log.log('holi');
                            //}
                            //$scope.variant.
                            //alert(isEmpty(data.stock));
                            if(isEmpty(data.stock)){
                                //alert('holi');
                                $scope.minNumber = null ;
                            }
                            $scope.variant.autogenerado = false;
                                //if ($scope.product.type) $scope.variant.codigo = $scope.product.codigo + $scope.product.type.nombre.charAt(0); else {
                                //    $scope.variant.codigo = $scope.product.codigo;
                                //}
                                //espero q se llene product y de ahi agrego Unidades por defecto
                                crudService.all('presentations_base').then(function (data) {
                                    $log.log(data);
                                    $scope.presentations_base = data;
                                    //$scope.product.presentation_base_object
                                    //$log.log( $scope.presentations);
                                    $scope.variant.presentation_base_object = data[0];
                                    $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
                                    $scope.enabled_presentation_button = false;

                                    //$scope.presentationSelect =

                                });

                            //});
                        });


                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            $log.log($scope.attributes);
                        })

                    }


                }else{
                     crudService.cantidadProductos().then(function(data)
                    {
                        $scope.product.canttoalProducts=data.cantidad;
                        $scope.product.stockA=data.stockA;
                    });
                    crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        //$log.log(data.data);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    if($location.path() == '/products/create') {
                        crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        });
                        crudService.select('products', 'brands').then(function (data) {
                            $scope.brands = data;
                        });
                        crudService.select('products', 'materials').then(function (data) {
                            $scope.materials = data;
                        });
                        crudService.select('products', 'types').then(function (data) {
                            $scope.types = data;
                        });
                        crudService.select('products', 'stations').then(function (data) {
                            $scope.stations = data;
                        });
                        crudService.all('warehouses').then(function (data){
                            $scope.warehouses = data;
                            //alert('h');

                        });
                        crudService.all('presentations_base').then(function(data){
                            //alert('holi');
                            $scope.presentations_base = data;
                            //$scope.product.presentation_base_object
                            //$log.log( $scope.presentations);
                            $scope.product.presentation_base_object = data[0];
                            $scope.product.presentation_base = $scope.product.presentation_base_object.id;
                            $scope.enabled_presentation_button = false;

                            //$scope.presentationSelect =

                        });
                    }
                }

                if($routeParams.product_id){
                    if($location.path() == '/variants/create/'+$routeParams.product_id){
                        crudService.byId($routeParams.product_id,'products').then(function (data) {
                            $log.log(data);
                            $scope.product = data;
                            if($scope.product.type) $scope.variant.codigo = $scope.product.codigo+$scope.product.type.nombre.charAt(0); else{$scope.variant.codigo = $scope.product.codigo;}
                                //espero q se llene product y de ahi agrego Unidades por defecto
                            crudService.all('presentations_base').then(function(data){
                                $log.log(data);
                                $scope.presentations_base = data;
                                //$scope.product.presentation_base_object
                                //$log.log( $scope.presentations);
                                $scope.variant.presentation_base_object = data[0];
                                $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
                                $scope.enabled_presentation_button = false;

                                //$scope.presentationSelect =

                            });

                        });

                        crudService.all('warehouses').then(function (data){
                            $scope.warehouses = data;
                        });
                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            $log.log($scope.attributes);
                        })
                    }


                }

                socket.on('product.update', function (data) {
                    $scope.products=JSON.parse(data);
                });

                $scope.searchProduct = function(){
                if ($scope.query.length > 0) {
                    crudService.search('products',$scope.query,1).then(function (data){
                        $scope.products = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.createProduct = function(){

                    if ($scope.productCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('productImage').files[0] ? document.getElementById('productImage').files[0] : null;
                        //alert(f.size); return false;
                        if(f){
                        if(f.size <= 400000) {
                            var r = new FileReader();
                            r.onloadend = function (e) {
                                $scope.product.image = e.target.result;

                                crudService.create($scope.product, 'products').then(function (data) {
                                    if (data['estado'] == true) {
                                        //$scope.success = data['nombres'];
                                        alert('Producto creado con Éxito');
                                        $location.path('/products');

                                    } else {
                                        $scope.errors = data;
                                        $btn.button('reset');
                                        //alert(data);

                                    }
                                });
                            }
                        }else{
                            alert('Peso de imagen mayor a 400Kb.');
                            $btn.button('reset');
                        }}
                        if(!document.getElementById('productImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.product.hasVariants);
                            crudService.create($scope.product,'products').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Producto creado con Éxito');
                                    $location.path('/products');

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('productImage').files[0] && document.getElementById('productImage').files[0].size <= 400000){
                            r.readAsDataURL(f);
                        }

                    }
                }


                $scope.createVariant = function(){

                    $scope.variant.otros=$scope.ArrayTallas;
                    $scope.variant.cantTallas=$scope.variant1;
                            //alert($scope.variant.otros);

                    if ($scope.variantCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var fv = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        if(fv){
                        if(fv.size <= 400000) {
                        var rv = new FileReader();
                        rv.onloadend = function(e) {
                            //alert('con img');
                            $scope.variant.image = e.target.result;

                            $scope.variant.product_id = $scope.product.id;
                            $log.log($scope.variant);

                            crudService.create($scope.variant, 'variants').then(function (data) {
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/products/show/' + $scope.product.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');
                                    //alert(data);

                                }
                            });
                        }
                        }else{
                            alert('Peso de imagen mayor a 400Kb.');
                            $btn.button('reset');
                        }}
                        if(!document.getElementById('variantImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.product.hasVariants);
                            //alert('sin img');
                            $scope.variant.product_id = $scope.product.id;
                            //$log.log($scope.variant);
                            crudService.create($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante creada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('variantImage').files[0] && document.getElementById('variantImage').files[0].size <= 400000){
                            rv.readAsDataURL(fv);
                        }

                    }
                }

                $scope.updateVariant = function(){

                    if ($scope.variantCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('variantImage').files[0] ? document.getElementById('variantImage').files[0] : null;
                        //alert(f);
                        if(f){
                        if(f.size <= 400000) {
                        var r = new FileReader();
                            r.onloadend = function(e) {
                                $scope.product.image = e.target.result;

                                $scope.variant.product_id = $scope.product.id;
                                crudService.update($scope.variant, 'variants').then(function (data) {
                                    if (data['estado'] == true) {
                                        //$scope.success = data['nombres'];
                                        alert('Variante modificada con Éxito');
                                        $location.path('/products/show/'+$scope.product.id);

                                    } else {
                                        $scope.errors = data;
                                        $btn.button('reset');
                                        //alert(data);

                                    }
                                });
                            }
                        }else{
                            alert('Peso de imagen mayor a 400Kb.');
                            $btn.button('reset');
                        }}
                        if(!document.getElementById('variantImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert($scope.product.hasVariants);
                            $scope.variant.product_id = $scope.product.id;
                            crudService.update($scope.variant,'variants').then(function (data){
                                if (data['estado'] == true) {
                                    //$scope.success = data['nombres'];
                                    alert('Variante modificada con Éxito');
                                    $location.path('/products/show/'+$scope.product.id);

                                } else {
                                    $scope.errors = data;
                                    $btn.button('reset');

                                }
                            });
                        }

                        if(document.getElementById('variantImage').files[0] && document.getElementById('variantImage').files[0].size <= 400000){
                            r.readAsDataURL(f);
                        }

                    }
                }

                $scope.editProduct = function(row){
                    $location.path('/products/edit/'+row.proId);
                };

                $scope.editProductShow = function(product){
                    //$log.log(product);
                    $location.path('/products/edit/'+product.id);
                }
                  
                $scope.updateProduct = function(){
                    //alert('ho');
                    if ($scope.productCreateForm.$valid) {
                        var $btn = $('#btn_generate').button('loading');
                        var f = document.getElementById('productImage').files[0] ? document.getElementById('productImage').files[0] : null;
                        //alert(f);
                        if(f){
                        if(f.size <= 400000) {
                        var r = new FileReader();
                                r.onloadend = function(e) {
                                    $scope.product.image = e.target.result;
                                crudService.update($scope.product,'products').then(function(data)
                                {
                                    if(data['estado'] == true){
                                        $scope.success = data['nombres'];
                                        alert('editado correctamente');
                                        $location.path('/products');
                                    }else{
                                        $scope.errors =data;
                                        $btn.button('reset');
                                    }
                                });
                                }
                        }else{
                            alert('Peso de imagen mayor a 400Kb.');
                            $btn.button('reset');
                        }}
                        if(!document.getElementById('productImage').files[0]){
                            var $btn = $('#btn_generate').button('loading');
                            //alert('ho');
                        crudService.update($scope.product,'products').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/products');
                            }else{
                                $scope.errors =data;
                                $btn.button('reset');
                            }
                        });}

                        if(document.getElementById('productImage').files[0] && document.getElementById('productImage').files[0].size <= 400000){
                            r.readAsDataURL(f);
                        }
                    }
                };

                $scope.deleteProduct = function(row){
                    $scope.product = row;
                    //$log.log($scope.product);
                   

                }
               
                $scope.cancelProduct = function(){
                    $scope.product = {};
                }
                $scope.tiketName="Generar Tikets Planta";
                $scope.tiketName2="Generar Tikets Caja";
                $scope.generarTikets=function(){
                    if($scope.ProductoID!=undefined){
                        $scope.tiketName="Generando Tikets Planta...";
                    crudService.Reportes10('TiketReport2',$scope.ProductoID).then(function(data)
                    {
                        if(data != undefined){
                            $scope.tiketName="Generar Tikets Planta";
                           //alert(data);
                           $window.open(data);
                        }else{
                            alert("Error No se a generado Tikets");
                        }
                    });
                  }
                }
                $scope.generarTikets2=function(){
                    if($scope.ProductoID!=undefined){
                        $scope.tiketName2="Generando Tikets Caja...";
                    crudService.Reportes10('TiketReport3',$scope.ProductoID).then(function(data)
                    {
                        if(data != undefined){
                            $scope.tiketName2="Generar Tikets Caja";
                           alert(data);
                           $window.open(data);
                        }else{
                            alert("Error No se a generado Tikets");
                        }
                    });
                  }
                }
                $scope.destroyProduct = function(){
                    alert("si");
                    crudService.destroy($scope.product,'products').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.product = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.deleteVariant = function(row){
                    $scope.variant = row;
                    //$log.log($scope.product);
                }
                $scope.cancelVariant = function(){
                    $scope.variant = {};
                }
                $scope.destroyVariant = function(){
                    crudService.destroy($scope.variant,'variants').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.variant = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.disableProduct = function(row){
                    //$log.log(row);
                    crudService.byforeingKey('products','disableprod',row.proId).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }

                $scope.disableVariant = function(row){
                    crudService.byforeingKey('variants','disablevar',row.id).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }
                /*
                fx de variants
                 */

                $scope.addVariant = function(product_id){
                    $location.path('/variants/create/'+product_id);
                    //$scope.product = {nombre:'holi'};
                }

                $scope.showVariants = function(row){
                    $scope.variants = [];
                    crudService.byforeingKey('variants','variants',row.proId).then(function(data)
                    {
                            $scope.variants = data;
                    })
                    //crudService.
                }
                $scope.agregarenGrupo=function(){
                     if($scope.variant.checkTallas==true){
                        $scope.variant.track=false;
                        $scope.variant.autogenerado=true;
                        $scope.variant.detAtr[1].descripcion='';
                     }else{
                         $scope.variant.track=true;
                         $scope.ArrayTalla={};
                         $scope.ArrayTallas=[];
                         $scope.variant.talla=[];
                         $scope.LlenarRangoTallas();
                     }
                }
                
                $scope.editVariant = function(row){
                    $location.path('/variants/edit/'+row.id);
                };
                $scope.material='';
                var codTemporal='';
                $scope.capAttr10 = function(attr_id){
                    if(attr_id == 1 || attr_id == 4){
                    if(codTemporal==''){
                    codTemporal=$scope.variant.codigo;
                    }
                    $scope.variant.codigo=codTemporal;
                    var codigodes='';
                    var separador = " ";
                    var aregloSubcadena=new Array();
                   if(attr_id == 1) {
                      if($scope.variant.detAtr[0].descripcion!=undefined && $scope.variant.detAtr[3].descripcion!=undefined){
                          var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                          codigodes=codigodes+($scope.variant.detAtr[0].descripcion.substring(0,2)).toUpperCase();
                          if(aregloSubcadena.length>1){
                            codigodes=codigodes+(aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1)).toLowerCase();
                          }else{
                            
                            codigodes=codigodes+(aregloSubcadena[0].substring(0,2)).toLowerCase();
                          }
                      }else{
                           if($scope.variant.detAtr[0].descripcion!=undefined){
                                codigodes=codigodes+($scope.variant.detAtr[0].descripcion.substring(0,2)).toUpperCase();
                           }
                      }
                   }
                   if(attr_id == 4){
                         if($scope.variant.detAtr[0].descripcion!=undefined && $scope.variant.detAtr[3].descripcion!=undefined){
                          var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                          codigodes=codigodes+($scope.variant.detAtr[0].descripcion.substring(0,2)).toUpperCase();
                          if(aregloSubcadena.length>1){
                            codigodes=codigodes+(aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1)).toLowerCase();
                          }else{
                            codigodes=codigodes+(aregloSubcadena[0].substring(0,2)).toLowerCase();
                          }
                      }else{
                           if($scope.variant.detAtr[3].descripcion!=undefined){
                                codigodes=codigodes+($scope.variant.detAtr[3].descripcion.substring(0,2)).toLowerCase();
                           }
                      }
                   }
                   $scope.variant.codigo=$scope.variant.codigo+codigodes;
                  }
                  //$scope.variant.codigo=$scope.variant.codigo.toUpperCase();
                }
                $scope.capAttr1 = function(attr_id){
                   
                    
                    $scope.material='';
                    //alert($scope.variant.detAtr[3].descripcion);
                    var separador = " ";
                    var aregloSubcadena=new Array();
                   if(attr_id == 1 || attr_id == 4) {
                    if($scope.product.type){} else{$scope.product.type = { nombre : ''}}
                         
                          $scope.variant.codigo = $scope.product.codigo + $scope.product.type.nombre.charAt(0);
                     
                     if(attr_id == 4){
                      var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                      $scope.material= aregloSubcadena[0].substring(0,1);
                      
                      if(parseInt(aregloSubcadena.length)>1){
                        
                        $scope.material= aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1);
                      }else{
                        $scope.material= aregloSubcadena[0].substring(0,2);
                      }
                     }
                         /*$scope.material= $scope.material+$scope.variant.detAtr[3].descripcion.substring(0, 1);
                         for(var n=0;n<$scope.variant.detAtr[3].descripcion.length;n++){
                            alert(n);
                            alert($scope.variant.detAtr[3].descripcion.substring(n,1));
                             if($scope.variant.detAtr[3].descripcion.substring(n,1)==' '){
                                //alert(aqui);
                                $scope.material=$scope.material+$scope.variant.detAtr[3].descripcion.substring(n+1,1);
                             }
                         }
                         alert($scope.material);*/
                         if(attr_id == 4 && $scope.variant.detAtr[0].descripcion!=undefined){
                            $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                         }else{

                               if(attr_id == 1 && $scope.variant.detAtr[3].descripcion!=undefined){
                               $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                               }else{
                                   if(attr_id == 1 ){
                                      $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2);
                                   }else{
                                      $scope.variant.codigo=$scope.variant.codigo+ $scope.material.toLowerCase();
                                   }
                               }
                         }
                    }
                 }
                 $scope.editCod=function(attr_id){
                    crudService.byId($scope.product.codigo,'consultCodigo').then(function (data){
                        if(data.nombre!=null){

                               $scope.variant.codigo=data.codigo+data.nombre.substring(0,1);
                               
                               $scope.capAttr10(attr_id);
                           }else{
                               $scope.variant.codigo=data.codigo;
                               $scope.capAttr10(attr_id);
                           }
                        });
                 }
                $scope.capAttr = function(attr_id){
                    //alert(attr_id);

                  alert($scope.product.codigo+"/");
                    var separador = " ";
                    var aregloSubcadena=new Array();
                   if(attr_id == 1 || attr_id == 4) {
                    if($scope.product.type){} else{$scope.product.type = { nombre : ''}}
                         
                          $scope.variant.codigo = $scope.product.codigo + $scope.product.type.nombre.charAt(0);
                     if(attr_id == 4){
                      var aregloSubcadena=$scope.variant.detAtr[3].descripcion.split(separador);
                      $scope.material= aregloSubcadena[0].substring(0,1);
                      
                      if(parseInt(aregloSubcadena.length)>1){
                        
                        $scope.material= aregloSubcadena[0].substring(0,1)+aregloSubcadena[1].substring(0,1);
                      }else{
                        $scope.material= aregloSubcadena[0].substring(0,2);
                      }
                     }
                         /*$scope.material= $scope.material+$scope.variant.detAtr[3].descripcion.substring(0, 1);
                         for(var n=0;n<$scope.variant.detAtr[3].descripcion.length;n++){
                            alert(n);
                            alert($scope.variant.detAtr[3].descripcion.substring(n,1));
                             if($scope.variant.detAtr[3].descripcion.substring(n,1)==' '){
                                //alert(aqui);
                                $scope.material=$scope.material+$scope.variant.detAtr[3].descripcion.substring(n+1,1);
                             }
                         }
                         alert($scope.material);*/
                         if(attr_id == 4 && $scope.variant.detAtr[0].descripcion!=undefined){
                            $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                         }else{

                               if(attr_id == 1 && $scope.variant.detAtr[3].descripcion!=undefined){
                               $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2)+ $scope.material.toLowerCase();
                               }else{
                                   if(attr_id == 1 ){
                                      $scope.variant.codigo=$scope.variant.codigo+$scope.variant.detAtr[0].descripcion.substring(0, 2);
                                   }else{
                                      $scope.variant.codigo=$scope.variant.codigo+ $scope.material.toLowerCase();
                                   }
                               }
                         }
                    }
                 }
                /*----------------------------------------------------------
                ------------------------------------------
                ------------------------------------------------
                -----------------------------------*/

                //var trouble;
                $scope.asignarDescr = function(index){
                    //$log.log($scope.trouble);
                     
                    if(isEmpty(trouble)){
                        //alert('arriba');
                        crudService.byforeingKey('variants','getAttr',$routeParams.id).then(function(data){
                            trouble = data.det_atr;
                            $log.log(trouble);

                            var isCool = $.grep(trouble, function (e) {
                                return e.atribute_id == $scope.variant.detAtr[index].atribute_id;
                            });
                            //$log.log(isCool[0].descripcion);
                            if (isCool.length != 0) {
                                $scope.variant.detAtr[index].descripcion = isCool[0].descripcion;
                            }
                        })
                    }else{
                            //alert('abajo');
                            var isCool = $.grep(trouble, function (e) {
                                return e.atribute_id == $scope.variant.detAtr[index].atribute_id;
                            });
                            //$log.log(isCool[0].descripcion);
                            if (isCool.length != 0) {
                                $scope.variant.detAtr[index].descripcion = isCool[0].descripcion;
                            }
                    }
                }
                $scope.editPresentation=function(row,preBase){
                    //alert(row.id);
                    $log.log(row);
                    $scope.presentation.suppPri=Number(row.suppPri);
                    $scope.presentation.markup=Number(row.markup);
                    $scope.presentation.price=Number(row.price);
                    $scope.presentation.dscto=Number(row.dscto);
                    $scope.presentation.dsctoCant=Number(row.dsctoCant);
                    $scope.presentation.pvp=Number(row.pvp);

                    $scope.traerPres(preBase);
                }
                $scope.traerPres = function(preBase){
                    $log.log(preBase);
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        crudService.byforeingKey('presentations', 'all_by_base', preBase).then(function (data) {
                            $scope.presentations = data;
                            //$log.log( $scope.presentations);
                            //$scope.presentations.push({id:$scope.product.presentation_base.id,nombre:'holi'});
                            $scope.presentations.unshift({
                                id: $scope.product.presentation_base_object.id,
                                nombre: $scope.product.presentation_base_object.nombre,
                                shortname: $scope.product.presentation_base_object.shortname,
                                cant: 'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentations[0];
                        });

                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id){
                        crudService.byforeingKey('presentations','all_by_base',preBase).then(function(data){
                            $scope.presentations = data;
                            //$log.log( $scope.presentations);
                            //$scope.presentations.push({id:$scope.product.presentation_base.id,nombre:'holi'});
                            $scope.presentations.unshift({
                                id:$scope.variant.presentation_base_object.id,
                                nombre:$scope.variant.presentation_base_object.nombre,
                                shortname:$scope.variant.presentation_base_object.shortname,
                                cant:'Pre. base'
                            });
                            $scope.presentationSelect = $scope.presentations[0];
                            //dsctos
                            //$scope.presentation.dscto = 0;
                            //$scope.presentation.dsctoCant = 0;
                            //$scope.presentation.pvp = 0;
                            //fin
                        });
                    }

                }

                $scope.AddPres = function(){
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa = $.grep($scope.product.presentations, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.product.presentations);
                        //alert("hola")
                        //$log.log("isYa");
                        //$log.log(isYa.length);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        if (isYa.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentation.suppPri;
                            $scope.presentationSelect.markup = $scope.presentation.markup;
                            $scope.presentationSelect.price = $scope.presentation.price;
                            $scope.product.presentations.push($scope.presentationSelect);
                            //$log.log($scope.product.presentations);
                            $scope.presentation = {};
                            $scope.presentationSelect = {};
                            $scope.presentation.suppPri = 0;
                            $scope.presentation.markup = 0;
                            $scope.presentation.price = 0;
                        } else {
                            alert('Item duplicado o vacío');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id){

                        if (typeof ($scope.presentationSelect.preFin_id) !== 'undefined') {
                            $scope.presentationSelect.id = $scope.presentationSelect.preFin_id;
                        }

                        var isYa2 = $.grep($scope.variant.presentations, function (e) {
                            return e.id == $scope.presentationSelect.id;
                        });
                        //$log.log($scope.presentationSelect);
                        //$log.log($scope.product.presentations);
                        //$log.log(isYa);
                        //if(isYa.length == 0 && $scope.presentationSelect!==null && $scope.presentationSelect.length!== 0) {
                        //$scope.variant.presentations.splice(0,1);
                        //if (isYa2.length == 0 && !isEmpty($scope.presentationSelect)) {
                            //alert(typeof($scope.presentationSelect.preFin_id));

                            $scope.presentationSelect.suppPri = $scope.presentation.suppPri;
                            $scope.presentationSelect.markup = $scope.presentation.markup;
                            $scope.presentationSelect.price = $scope.presentation.price;
                            $scope.presentationSelect.dscto = $scope.presentation.dscto;
                            $scope.presentationSelect.dsctoCant = $scope.presentation.dsctoCant;
                            $scope.presentationSelect.pvp = $scope.presentation.pvp;
                            $scope.variant.presentations.splice(0,1,$scope.presentationSelect);
                            $log.log($scope.variant.presentations);
                            $scope.presentation = {};
                            $scope.presentationSelect = {};
                            $scope.presentation.suppPri = 0;
                            $scope.presentation.markup = 0;
                            $scope.presentation.price = 0;
                            $scope.presentation.dscto = 0;
                            $scope.presentation.dsctoCant = 0;
                            $scope.presentation.pvp = 0;
                       // } else {
                          //  alert('Item duplicado o vacío');
                        //}
                    }
                }
                 $scope.duplicateCodProveedor=function(){
                    
                    $scope.product.suppCode=$scope.product.codigo;
                 }
                $scope.deletePres = function($index){
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        $scope.product.presentations.splice($index, 1);
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        $scope.variant.presentations.splice($index, 1);
                    }
                }

                $scope.selectPres = function(){
                    $scope.presentation.suppPri = 0;
                    $scope.presentation.markup = 0;
                    $scope.presentation.price = 0;
                    $scope.presentation.dscto = 0;
                    $scope.presentation.dsctoCant = 0;
                    $scope.presentation.pvp = 0;
                }

                $scope.changePreBase = function(){
                    //$log.log($scope.product.presentation_base_object);cartItems.length > 0
                    if($location.path() != '/variants/create/'+$routeParams.product_id && $location.path() != '/variants/edit/'+$routeParams.id) {
                        if ($scope.product.presentation_base_object !== null && !isEmpty($scope.product.presentation_base_object)) {
                            $scope.product.presentation_base = $scope.product.presentation_base_object.id;
                            $scope.product.presentations = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.product.presentation_base = null;
                            $scope.product.presentations = [];
                            //alert('borra else');
                        }
                    }
                    if($location.path() == '/variants/create/'+$routeParams.product_id || $location.path() == '/variants/edit/'+$routeParams.id) {
                        if ($scope.variant.presentation_base_object !== null && !isEmpty($scope.variant.presentation_base_object)) {
                            $scope.variant.presentation_base = $scope.variant.presentation_base_object.id;
                            $scope.variant.presentations = [];
                            //alert('borra if');
                            $scope.enabled_presentation_button = false;
                            $scope.enabled_createpresentation_button = false;
                        } else {
                            $scope.enabled_presentation_button = true;
                            $scope.enabled_createpresentation_button = true;
                            $scope.variant.presentation_base = null;
                            $scope.variant.presentations = [];
                            //alert('borra else');
                        }
                    }

                }

                $scope.createPres = function(unidad_base){
                    $scope.preAdd.preBase_id = unidad_base;
                    //$log.log($scope.preAdd);
                    crudService.create($scope.preAdd, 'presentations').then(function (data) {
                        if (data['estado'] == true) {
                            $scope.presentations.push({
                                id:data['presentation'].id,
                                nombre:data['presentation'].nombre,
                                shortname:data['presentation'].shortname,
                                cant:data['equiv'].cant
                            })
                            $scope.preAdd = {};
                            alert('Presentacion creada con éxito');
                        } else {
                            $scope.errors = data;
                        }
                    });

                }

                $scope.showStock = function(product_id){
                    crudService.byforeingKey('stocks','traerstock',product_id).then(function (data){
                        $scope.stockVariants = data;
                    })
                };

                $scope.showDscto = function(proId,Dscto){
                    //$('.popover').css('display','none');
                    $scope.areaDscto.DsctoVal = Number(Dscto);
                    $scope.areaDscto.DsctoProId = proId;
                };

                $scope.ActualizarDsctoGeneral = function(){
                    crudService.selectPost($scope.areaDscto,'products','actualizarDsctoGeneral').then(function (data){
                      if(data['estado']==true){
                          alert('Se actualizó el Descto con éxito');
                      }else{
                          alert('No se pudo realizar la operación');
                      }
                    })
                    //$log.log($scope.areaDscto);
                }

                $scope.ActualizarDsctoVar = function(){
                    crudService.selectPost($scope.areaDscto,'variants','actualizarDsctoVar').then(function (data){
                        if(data['estado']==true){
                            alert('Se actualizó el Descto con éxito');
                        }else{
                            alert('No se pudo realizar la operación');
                        }
                    })
                    //$log.log($scope.areaDscto);
                }

                /*

                Agregar Marca, Linea, Station, MAterial, Atributo

                 */
                $scope.addBrand = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent.html',
                        controller: 'ModalInstanceCtrl',
                        size: 'sm',
                        /*resolve: {
                            items: function () {
                                return $scope.items;
                            }
                        }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('products', 'brands').then(function (data) {
                            $scope.brands = data;
                        });

                    });
                };
                $scope.addLine = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent2.html',
                        controller: 'ModalInstanceCtrl2',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('products', 'types').then(function (data) {
                            $scope.types = data;
                        });

                    });
                };
                $scope.addMaterial = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent3.html',
                        controller: 'ModalInstanceCtrl3',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('products', 'materials').then(function (data) {
                            $scope.materials = data;
                        });

                    });
                };

                $scope.addStation = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent4.html',
                        controller: 'ModalInstanceCtrl4',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.select('products', 'stations').then(function (data) {
                            $scope.stations = data;
                        });

                    });
                };
                $scope.ArrayTallas =[];
                $scope.ArrayTalla ={};
                $scope.variants1=[];
                $scope.variant1={};
                $scope.variant.checkTallas=false;
                $scope.obcional=0;
                $scope.h=0;
                $scope.LlenarRangoTallas=function(fin,ini){
                   // alert(fin);
                    $scope.ArrayTalla={};
                    $scope.ArrayTallas=[];
                    $scope.variant.talla=[];
                    $scope.obcional=0;
                    ///alert("hola que tal"+$scope.can);
                   // if($scope.obcional==0){
                      //  alert("estoy en cero");
                        $scope.can=parseInt(fin)-parseInt(ini);
                          for(var n=0;n<=$scope.can;n++)
                        {   
                            $scope.obcional=ini+n;
                            $scope.ArrayTalla[n]=$scope.obcional; 
                            $scope.ArrayTallas.push($scope.ArrayTalla);
                            $scope.h++;
                       // alert(n);
                        }

                   /* }else{
                        alert("no estoy en cero"+$scope.obcional+"/"+$scope.h);
                        $scope.can=parseInt(fin)-$scope.obcional;
                         for(var t=0;t<$scope.can;t++)
                        {   
                            
                            $scope.obcional++;
                            $scope.ArrayTalla[$scope.obcional]=$scope.obcional; 
                            $scope.ArrayTallas.push($scope.ArrayTalla);
                            $scope.h++;
                        }
                   }*/
                }
               $scope.generarVariantes=function(cant,index){
                ///alert("hola estoy llenando variantes"+index);
                   $scope.variant1[index]=cant;
                   $scope.variants1.push($scope.variant1);
               }
               $scope.validarNombre=function(){
                   alert("Usted no puede crear dos productos con el mismo nombre");
                   $scope.product.nombre='';
                   crudService.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                   });
               }
               $scope.validaNombre2=function(texto){
                 if(texto!=undefined){
                    //alert(texto);
                  crudService.validar('products',texto).then(function (data){
                        //$scope.products = data;
                        //alert(data.nombre);
                        if(data.nombre!=undefined){
                           alert("Usted no puede crear dos productos con el mismo nombre");
                           $scope.product.nombre=''; 
                        }
                    });
                 }
               }
               $scope.validanomMarca=function(texto){
                alert('hola');
                   var separador = " ";
                    var aregloSubcadena=new Array();
                    if(texto!=undefined){
                        crudService.search('brands',texto,1).then(function (data){
                        $scope.materials = data.data;

                    var aregloSubcadena=texto.split(separador);
                    if(aregloSubcadena.length>1){
                        $scope.brand.shortname=aregloSubcadena[0].substring(0,2)+aregloSubcadena[1].substring(0,1);
                    }else{
                        $scope.brand.shortname=aregloSubcadena[0].substring(0,3); 
                    }
                        if($scope.materials!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.product.nombre=''; 
                        }
                    });
                    }
               }
                $scope.addAttribute = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent5.html',
                        controller: 'ModalInstanceCtrl5',
                        size: 'sm',
                        /*resolve: {
                         items: function () {
                         return $scope.items;
                         }
                         }*/
                    });

                    modalInstance.result.then(function (selectedItem) {
                        //$scope.selected = selectedItem;
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                        crudService.all('atributes').then(function (data){
                            $scope.attributes = data.data;
                            //$log.log($scope.attributes);
                        })

                    });
                };

                $scope.opcAtr = [];
                $scope.opcAtr[1] = ['NEGRO','BLANCO','ROJO','AZUL','MARRÓN','VINO','NUDE','BEIGE','TURQUESA'];
                $scope.opcAtr[2] = ['18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45'];
                $scope.opcAtr[3] = ['3','5','7','9','10','11','12','13','15','18','20','21'];
                $scope.opcAtr[4] = ['CUERO LISO','CUERO GAMUZA','CUERO CHAROL','SINTÉTICO LISO','SINTÉTICO GAMUZA','SINTÉTICO CHAROL','TELA'];

                

                /*
                Fin de add
                 */

                function isEmpty(obj) {
                    return Object.keys(obj).length === 0;
                }
               //============================================================= 
var 
    form = $('.form'),
    cache_width = form.width(),
    a4  =[ 595.28,  841.89];  // for a4 size paper width and height

$('#create_pdf').on('click',function(){
    $('body').scrollTop(0);
    $scope.createPDF();
});
//create pdf
$scope.createPDF=function(){
   
    $scope.getCanvas().then(function(canvas){
        var 
        img = canvas.toDataURL("image/png"),
        doc = new jsPDF({
          unit:'px', 
          format:'a4'
        });     
        doc.addImage(img, 'JPEG', 20, 20);
        doc.save('techumber-html-to-pdf.pdf');
        form.width(cache_width);
    });
}

// create canvas object
$scope.getCanvas=function(){
    form.width((a4[0]*1.33333) -80).css('max-width','none');
    return html2canvas(form,{
        imageTimeout:2000,
        removeContainer:true
    }); 
}



   //======================================================================

            }]);
})();
