(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider
            // ------------------------------------------------------
            .when('/atributes', {
                    templateUrl: '/js/app/atributes/views/index.html',
                    controller: 'AtributController'
                })
                .when('/atributes/create',{
                    templateUrl:'/atributes/form-create',
                    controller: 'AtributController'
                })
                .when('/atributes/edit/:id',{
                    templateUrl:'/atributes/form-edit',
                    controller: 'AtributController'
                })  
                //--------------------------------------------------------
                .when('/reports', {
                    templateUrl: '/js/app/reports/views/index.html',
                    controller: 'ReportController'
                })
                //---------------------------------------------------------
                 .when('/purchases', {
                    templateUrl: '/js/app/purchases/views/index.html',
                    controller: 'PurchaseController'
                })
                .when('/purchases/create',{
                    templateUrl:'/purchases/form-create',
                    controller: 'PurchaseController'
                })
                .when('/purchases/edit/:id',{
                    templateUrl:'/purchases/form-edit',
                    controller: 'PurchaseController'
                })  
                   .when('/purchases/show/:id',{
                    templateUrl:'/purchases/view-show',
                    controller: 'PurchaseController'
                })
                .when('/purchases/showD',{
                    templateUrl:'/purchases/view-showD',
                    controller: 'PurchaseController'
                })
                .when('/purchases/cardex',{
                    templateUrl:'/purchases/view-cardex',
                    controller: 'PurchaseController'
                })
                .when('/purchases/createMov',{
                    templateUrl:'/purchases/form-createMov',
                    controller: 'PurchaseController'
                })
                //---------------------------------------
                 .when('/orderPurchases', {
                    templateUrl: '/js/app/orderPurchases/views/index.html',
                    controller: 'OrderPurchaseController'
                })
                .when('/orderPurchases/create',{
                    templateUrl:'/orderPurchases/form-create',
                    controller: 'OrderPurchaseController'
                })
                .when('/orderPurchases/show/:id',{
                    templateUrl:'/orderPurchases/view-show',
                    controller: 'OrderPurchaseController'
                })
                .when('/orderPurchases/edit/:id',{
                    templateUrl:'/orderPurchases/form-edit',
                    controller: 'OrderPurchaseController'
                }) 
                .when('/orderPurchases/createP',{
                    templateUrl:'/orderPurchases/form-createP',
                    controller: 'OrderPurchaseController'
                }) 
                //----------------------------------------------------
                  .when('/materials', {
                    templateUrl: '/js/app/materials/views/index.html',
                    controller: 'MaterialsController'
                })
                .when('/materials/create',{
                    templateUrl:'/materials/form-create',
                    controller: 'MaterialsController'
                })
                .when('/materials/edit/:id',{
                    templateUrl:'/materials/form-edit',
                    controller: 'MaterialsController'
                }) 
                //---------------------------------------------------
                .when('/stations', {
                    templateUrl: '/js/app/stations/views/index.html',
                    controller: 'StationController'
                })
                .when('/stations/create',{
                    templateUrl:'/stations/form-create',
                    controller: 'StationController'
                })
                .when('/stations/edit/:id',{
                    templateUrl:'/stations/form-edit',
                    controller: 'StationController'
                }) 
           // ------------------------------------------------------
            .when('/types', {
                    templateUrl: '/js/app/types/views/index.html',
                    controller: 'TypeController'
                })
                .when('/types/create',{
                    templateUrl:'/types/form-create',
                    controller: 'TypeController'
                })
                .when('/types/edit/:id',{
                    templateUrl:'/types/form-edit',
                    controller: 'TypeController'
                })    

                //-------------------------------------------------------------        
             .when('/brands', {
                    templateUrl: '/js/app/brands/views/index.html',
                    controller: 'BrandController'
                })
                .when('/brands/create',{
                    templateUrl:'/brands/form-create',
                    controller: 'BrandController'
                })
                .when('/brands/edit/:id',{
                    templateUrl:'/brands/form-edit',
                    controller: 'BrandController'
                })  
                      //----------------------------------------------------------------------
            .when('/suppliers', {
                    templateUrl: '/js/app/suppliers/views/index.html',
                    controller: 'SupplierController'
                })
                .when('/suppliers/create',{
                    templateUrl:'/suppliers/form-create',
                    controller: 'SupplierController'
                })
                
                .when('/suppliers/edit/:id',{
                    templateUrl:'/suppliers/form-edit',
                    controller: 'SupplierController'
                }) 

                //-----------------------------------------------  
                .when('/employeecosts', {
                    templateUrl: '/js/app/employeecosts/views/index.html',
                    controller: 'EmployeecostController'
                })
                .when('/employeecosts/create',{
                    templateUrl:'/employeecosts/form-create',
                    controller: 'EmployeecostController'
                })
                
                .when('/employeecosts/edit/:id',{
                    templateUrl:'/employeecosts/form-edit',
                    controller: 'EmployeecostController'
                }) 
                //-----------------------------------------------  
                //----------------------------------------------------------------------
            .when('/employees', {
                    templateUrl: '/js/app/employees/views/index.html',
                    controller: 'EmployeeController'
                })
                .when('/employees/create',{
                    templateUrl:'/employees/form-create',
                    controller: 'EmployeeController'
                })
                
                .when('/employees/edit/:id',{
                    templateUrl:'/employees/form-edit',
                    controller: 'EmployeeController'
                }) 
                //-----------------------------------------------  
            //----------------------------------------------------------------------
            .when('/warehouses', {
                    templateUrl: '/js/app/warehouses/views/index.html',
                    controller: 'WarehouseController'
                })
                .when('/warehouses/create',{
                    templateUrl:'/warehouses/form-create',
                    controller: 'WarehouseController'
                })
                
                .when('/warehouses/edit/:id',{
                    templateUrl:'/warehouses/form-edit',
                    controller: 'WarehouseController'
                }) 
                //-----------------------------------------------          
                .when('/stores', {
                    templateUrl: '/js/app/stores/views/index.html',
                    controller: 'StoreController'
                })
                .when('/stores/create',{
                    templateUrl:'/stores/form-create',
                    controller: 'StoreController'
                })
                .when('/stores/edit/:id',{
                    templateUrl:'/stores/form-edit',
                    controller: 'StoreController'
                })                
                .when('/persons', {
                    templateUrl: '/js/app/persons/views/index.html',
                    controller: 'PersonController'
                })
                .when('/persons/create',{
                    templateUrl:'/persons/form-create',
                    controller: 'PersonController'
                })
                .when('/persons/edit/:id',{
                    templateUrl:'/persons/form-edit',
                    controller: 'PersonController'
                })
                .when('/users', {
                    templateUrl: '/js/app/users/views/index.html',
                    controller: 'UserController'
                })
                .when('/users/create',{
                    templateUrl:'/users/form-create',
                    controller: 'UserController'
                })
                .when('/users/edit/:id',{
                    templateUrl:'/users/form-edit',
                    controller: 'UserController'
                })
                .when('/customers', {
                    templateUrl: '/js/app/customers/views/index.html',
                    controller: 'CustomerController'
                })
                .when('/customers/create',{
                    templateUrl:'/customers/form-create',
                    controller: 'CustomerController'
                })
                .when('/customers/edit/:id',{
                    templateUrl:'/customers/form-edit',
                    controller: 'CustomerController'
                })
                .when('/employees', {
                    templateUrl: '/js/app/employees/views/index.html',
                    controller: 'EmployeeController'
                })
                .when('/employees/create',{
                    templateUrl:'/employees/form-create',
                    controller: 'EmployeeController'
                })
                .when('/employees/edit/:id',{
                    templateUrl:'/employees/form-edit',
                    controller: 'EmployeeController'
                })
                //-------------------------------------------------
                .when('/products', {
                    templateUrl: '/js/app/products/views/index.html',
                    controller: 'ProductController'
                })
                .when('/products/create',{
                    templateUrl:'/products/form-create',
                    controller: 'ProductController'
                })
                .when('/products/edit/:id',{
                    templateUrl:'/products/form-edit',
                    controller: 'ProductController'
                })
                .when('/products/show/:id',{
                    templateUrl:'/products/view-show',
                    controller: 'ProductController'
                })
                //-----------------------------------------------
                .when('/variants/create/:product_id',{
                    templateUrl: '/variants/form-create',
                    controller: 'ProductController'
                })
                .when('/variants/edit/:id',{
                    templateUrl: '/variants/form-edit',
                    controller: 'ProductController'
                })
                //-----------------------------------------
                .when('/cashMonthlys', {
                    templateUrl: '/js/app/cashMonthlys/views/index.html',
                    controller: 'CashMonthlyController'
                })
                .when('/cashMonthlys/create', {
                    templateUrl: '/cashMonthlys/form-create',
                    controller: 'CashMonthlyController'
                })
                .when('/cashMonthlys/edit/:id',{
                    templateUrl:'/cashMonthlys/form-edit',
                    controller: 'CashMonthlyController'
                })

                //-----------------------------------------


                //-----------------------------------------
                .when('/practicas', {
                    templateUrl: '/js/app/practicas/views/index.html',
                    controller: 'PracticaController'
                })
                .when('/practicas/create', {
                    templateUrl: '/practicas/form-create',
                    controller: 'PracticaController'
                })
                .when('/practicas/edit/:id',{
                    templateUrl:'/practicas/form-edit',
                    controller: 'PracticaController'
                })
                //-------------------------------------------
                //-----------------------------------------
                .when('/promotions', {
                    templateUrl: '/js/app/promotions/views/index.html',
                    controller: 'PromotionController'
                })
                .when('/promotions/create', {
                    templateUrl: '/promotions/form-create',
                    controller: 'PromotionController'
                })
                .when('/promotions/edit/:id',{
                    templateUrl:'/promotions/form-edit',
                    controller: 'PromotionController'
                })
                //-------------------------------------------
                //-----------------------------------------
                .when('/cashHeaders', {
                    templateUrl: '/js/app/cashHeaders/views/index.html',
                    controller: 'CashHeadersController'
                })
                .when('/cashHeaders/create', {
                    templateUrl: '/cashHeaders/form-create',
                    controller: 'CashHeadersController'
                })
                .when('/cashHeaders/edit/:id',{
                    templateUrl:'/cashHeaders/form-edit',
                    controller: 'CashHeadersController'
                })
                //-------------------------------------------
                //-----------------------------------------
                .when('/cashes', {
                    templateUrl: '/js/app/cashes/views/index.html',
                    controller: 'CashesController'
                })

               
                .when('/cashes/create', {
                    templateUrl: '/cashes/form-create',
                    controller: 'CashesController'
                })
                .when('/cashes/edit/:id',{
                    templateUrl:'/cashes/form-edit',
                    controller: 'CashesController'
                })

                //-------------------------------------------
                //-----------------------------------------
                .when('/detCashes', {
                    templateUrl: '/js/app/detCashes/views/index.html',
                    controller: 'DetCashesController'
                })

               
                .when('/detCashes/create/:id', {
                    templateUrl: '/detCashes/form-create',
                    controller: 'DetCashesController'
                })
                .when('/detCashes/edit/:id',{
                    templateUrl:'/detCashes/form-edit',
                    controller: 'DetCashesController'
                })
                //-------------------------------------------
                //-----------------------------------------
                .when('/sales', {
                    templateUrl: '/js/app/sales/views/index.html',
                    controller: 'SaleController'
                })

               
                .when('/sales/create', {
                    templateUrl: '/sales/form-create',
                    controller: 'SaleController'
                })
                .when('/sales/edit/:id',{
                    templateUrl:'/sales/form-edit',
                    controller: 'SaleController'
                })
                //-------------------------------------------
                //-----------------------------------------
                .when('/orderSales', {
                    templateUrl: '/js/app/orderSales/views/index.html',
                    controller: 'OrderSalesController'
                })

               
                .when('/orderSales/create', {
                    templateUrl: '/orderSales/form-create',
                    controller: 'OrderSalesController'
                })
                .when('/orderSales/edit/:id',{
                    templateUrl:'/orderSales/form-edit',
                    controller: 'OrderSalesController'
                })
                //-------------------------------------
                //-------------------------------------------
                .when('/separateSales', {
                    templateUrl: '/js/app/separateSales/views/index.html',
                    controller: 'SeparateSalesController'
                })

               
                .when('/separateSales/create', {
                    templateUrl: '/separateSales/form-create',
                    controller: 'SeparateSalesController'
                })
                .when('/separateSales/edit/:id',{
                    templateUrl:'/separateSales/form-edit',
                    controller: 'SeparateSalesController'
                })
                //-----------------------------------------
                .when('/inventory', {
                    templateUrl: '/js/app/inventory/views/index.html',
                    controller: 'InventoryController'
                })
                //-------------------------------------
                .when('/reports', {
                    templateUrl: '/js/app/reports/views/index.html',
                    controller: 'ReportController'
                })
                .otherwise({
                    redirectTo: '/'
                });
            $locationProvider.html5Mode(true);
        }]);

})();
