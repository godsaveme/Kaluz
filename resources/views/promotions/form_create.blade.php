<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            promotions
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/promotions">promotions</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear promotions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="promotionCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    <div class="row">
                    <div class="col-md-8"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.nombre.$error.required && promotionCreateForm.$submitted || promotionCreateForm.nombre.$dirty && promotionCreateForm.nombre.$invalid]">
                      <label for="nombre">nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="nombre" ng-model="promotion.nombre" required>
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.nombre.$dirty && promotionCreateForm.nombre.$invalid">
                        <span ng-show="promotionCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="row">
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.cantidadOfre.$error.required && promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid]">
                      <label for="cantidadOfre">Cantidad Ofrecida</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidadOfre" id="cantidadOfre" placeholder="0.00" ng-model="cantidadOfre" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid">
                        <span ng-show="promotionCreateForm.cantidadOfre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.cantidadCobro.$error.required && promotionCreateForm.$submitted || promotionCreateForm.cantidadCobro.$dirty && promotionCreateForm.cantidadCobro.$invalid]">
                      <label for="cantidadCobro">Cantidad Cobro</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidadCobro" id="cantidadCobro" placeholder="0.00" ng-model="cantidadCobro" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.cantidadCobro.$dirty && promotionCreateForm.cantidadCobro.$invalid">
                        <span ng-show="promotionCreateForm.cantidadCobro.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.descuento.$error.required && promotionCreateForm.$submitted || promotionCreateForm.descuento.$dirty && promotionCreateForm.descuento.$invalid]">
                      <label for="descuento">Descuento %</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="descuento" id="descuento" placeholder="0.00" ng-model="descuento" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.descuento.$dirty && promotionCreateForm.descuento.$invalid">
                        <span ng-show="promotionCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="row">
                    <div class="col-md-8"> 
                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="promotion.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                     </div>



                     <!--==========================================Agregar Producto====================================-->
      <div class="box box-default" id="box-addPro">
        <div class="box-header with-border">
          <h3 class="box-title">Activar del Promociones</h3>
          <div class="box-tools pull-right">
            <button type="submit" ng-click="createPurchase()" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">

        <form name="detailPurchaseCreateForm" role="form" novalidate> 
          <div class="row"> 
          <!-- --------------------------Fecha Inicio----------------------------- --> 
            <div class="col-md-4">

              <div class="form-group" ng-class="{true: 'has-error'}[ purchaseCreateForm.fechaPedido.$error.required && purchaseCreateForm.$submitted || purchaseCreateForm.fechaPedido.$dirty && purchaseCreateForm.fechaPedido.$invalid]">
                    <label for="fechaPedido">Fecha Inicio</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control"  name="fechaPedido" ng-model="purchase.fechaPedido" >
                      <label ng-show="purchaseCreateForm.$submitted || purchaseCreateForm.fechaPedido.$dirty && purchaseCreateForm.fechaPedido.$invalid">
                                              <span ng-show="purchaseCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                      </div>  
            </div>

            <div class="col-md-4">

              <div class="form-group" ng-class="{true: 'has-error'}[ purchaseCreateForm.fechaPedido.$error.required && purchaseCreateForm.$submitted || purchaseCreateForm.fechaPedido.$dirty && purchaseCreateForm.fechaPedido.$invalid]">
                    <label for="fechaPedido">Fecha Fin</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control"  name="fechaPedido" ng-model="purchase.fechaPedido" >
                      <label ng-show="purchaseCreateForm.$submitted || purchaseCreateForm.fechaPedido.$dirty && purchaseCreateForm.fechaPedido.$invalid">
                                              <span ng-show="purchaseCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                      </div>  
            </div>

            <div class="col-md-5"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.cantidadOfre.$error.required && promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid]">
                      <label for="cantidadOfre">Cantidad Ofertadas</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidadOfre" id="cantidadOfre" placeholder="0.00" ng-model="cantidadOfre" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid">
                        <span ng-show="promotionCreateForm.cantidadOfre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>




          </div>



        
          </form>
        </div><!-- /.box-body -->
      </div>
      <script>
    $("#box-addPro").activateBox();
      </script>
<!--=================================================================================================================-->

<!--==========================================Agregar Producto====================================-->
      <div class="box box-default" id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Seleccion de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
          <div class="row">

            <div class="col-md-4">
              <label>Producto</label>
              <div class="input-group">
                <input type="text" ng-model="product.id"  name="table_search" class="form-control input-sm pull-right" placeholder="Search" />
                <div class="input-group-btn">
                  <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchProduct()" data-target="#miventanaProductos" ><i class="fa fa-search"></i></button>
                </div>
              </div> 
            </div> 
          </div>





          <table class="table table-bordered" id="tabla1">
            <tr>
              <th style="width: 10px">#</th>

              <th>Producto</th>
              <th>Variante </th>
              <th>Cantidad</th>
              <th>Precio Producto</th>
              <th>Precio Compra</th>
              <th>Total Bruto</th>
              <th>Descuento</th>
              <th>Total</th>
                      
            </tr>
            <tr ng-repeat="row in detailPurchases">
                      <td></td>
                      <td>@{{row.nombre}}</td>
                      <td>@{{row.CodigoPCompra}}</td>
                      <td>@{{row.cantidad}}</td>
                      <td>@{{row.preProducto}}</td>
                      <td>@{{row.preCompra}}</td>
                      <td>@{{row.montoBruto}}</td>
                      <td>@{{row.descuento}}</td>
                      <td>@{{row.montoTotal}}</td>
                      <td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                    </tr> 
          </table>


        </div>
      </div>
  <!-- ==========================================================================================-->
                    
                     
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createPromotion()">Crear</button>
                    <a href="/promotions" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->







              <!-- =================================Ventana Elegir Producto=================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventanaProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header"  >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Elija Producto</b></h4>
                   </div>
                   <div class="modal-body">

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Código</th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>Categoría</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in products">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide='true'>@{{row.proId}}</td>
                      <td ng-hide='true'>@{{row.precioProducto}}</td>
                      <td ng-hide='true'>@{{row.TieneVariante}}</td>
                     <td>@{{row.proCodigo}}</td>
                      <td>@{{row.proNombre }}</td>                      
                      <td>@{{row.braNombre +"/"+row.typNombre}}</td>
                      <td>@{{row.varPrice}}</td>
                      <td><a ng-click="asignarProduc(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>
                    
                    
                  </table>
                  
                      
                     </div>
                    
               </div>
             </div>
           </div>
        </div>
        </div>
        <!-- ===================================================================================-->