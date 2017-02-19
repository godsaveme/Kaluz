(function(){
    angular.module('consultas.controllers',[])
        .controller('ConsultaController',['$scope', '$routeParams','$http','uiGridConstants','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$http,uiGridConstants,$location,crudService,socket,$filter,$route,$log){
      $scope.date=new Date();
      $scope.brands = [];
      $scope.types = [];
      $scope.warehouses = [];
      $scope.idwarehouse ='1';
      crudService.all('listaAlmacenesTienda').then(function (data) {
                            $scope.warehouses = data;
                        });
     $scope.fechaConsulta = ''+$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    
      crudService.consultaProductos($scope.idwarehouse).then(function (data) {                        
                        $scope.gridOptions.data = data;
                  });
      crudService.all('paraFiltro').then(function (data) {
                        $scope.brands = data;
                  });
      crudService.all('paraFiltroType').then(function (data) {
                        $scope.types = data;
                  });
    
   $scope.changeStock=function(){
   	  crudService.consultaProductos($scope.idwarehouse).then(function (data) {                        
                        $scope.gridOptions.data = data;
                  });
   }

  $scope.highlightFilteredHeader = function( row, rowRenderIndex, col, colRenderIndex ) {
    if( col.filters[0].term ){
      return 'header-filtered';
    } else {
      return '';
    }
  };

  $scope.gridOptions = {
    enableFiltering: false,
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    },
    columnDefs: [
      // default
      { field: 'Codigo', headerCellClass: $scope.highlightFilteredHeader },
      // pre-populated search field
      { field: 'Sku',enableFiltering: false},
        
      
      // no filter input
      { field: 'Marca', filter: {
          term: '',
          type: uiGridConstants.filter.SELECT,
          selectOptions: $scope.brands
        },field: 'Marca', headerCellClass: $scope.highlightFilteredHeader },
      { field: 'Linea', filter: {
          term: '',
          type: uiGridConstants.filter.SELECT,
          selectOptions: $scope.types
        },field: 'Linea', headerCellClass: $scope.highlightFilteredHeader },
          
       { field: 'stock',enableFiltering: false},
       { field: 'Separados',enableFiltering: false},
       { field: 'Tot_Stock',enableFiltering: false},
       { field: 'Color', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Taco', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Talla', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Material', headerCellClass: $scope.highlightFilteredHeader },    
       { field: 'PrecioVenta',enableFiltering: false},
      
    ]
  };

  /*$http.get('https://cdn.rawgit.com/angular-ui/ui-grid.info/gh-pages/data/500_complex.json')
    .success(function(data) {
      $scope.gridOptions.data = data;
      $scope.gridOptions.data[0].age = -5;

      data.forEach( function addDates( row, index ){
        row.mixedDate = new Date();
        row.mixedDate.setDate(today.getDate() + ( index % 14 ) );
        row.gender = row.gender==='male' ? '1' : '2';
      });
    });*/

  $scope.toggleFiltering = function(){
  	  
                  
    $scope.gridOptions.enableFiltering = !$scope.gridOptions.enableFiltering;
    $scope.gridApi.core.notifyDataChange( uiGridConstants.dataChange.COLUMN );
    $scope.gridOptions = {
    enableFiltering: false,
    onRegisterApi: function(gridApi){
      $scope.gridApi = gridApi;
    },
    columnDefs: [
      // default
      { field: 'Codigo', headerCellClass: $scope.highlightFilteredHeader },
      // pre-populated search field
      { field: 'Sku',enableFiltering: false},
        
      
      // no filter input
      { field: 'Marca', filter: {
          term: '',
          type: uiGridConstants.filter.SELECT,
          selectOptions: $scope.brands
        },field: 'Marca', headerCellClass: $scope.highlightFilteredHeader },
      { field: 'Linea', filter: {
          term: '',
          type: uiGridConstants.filter.SELECT,
          selectOptions: $scope.types
        },field: 'Linea', headerCellClass: $scope.highlightFilteredHeader },
          
       { field: 'stock',enableFiltering: false},
       { field: 'Tot_Stock',enableFiltering: false},
       { field: 'Color', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Taco', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Talla', headerCellClass: $scope.highlightFilteredHeader },
        { field: 'Material', headerCellClass: $scope.highlightFilteredHeader },    
       { field: 'PrecioVenta',enableFiltering: false},
    ]
  }
     
  };
                
        }]);
})();
