


        <!--================================================================================-->
        <section class="content-header">
          <h1>
            Crear Compra Directa
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
           <li><a href="/orderPurchases"><i class="fa fa-dashboard"></i>Orden de Compras</a></li>
            
          </ol>

          
        </section>
<!--===========================================================================================-->
<section class="content">

<div class="row">
<div class="col-md-12">

<div class="box box-primary" >
                             <div class="box-header with-border">
                                   <h3 class="box-title">Crear Compra Directa</h3>
                             </div><!-- /.box-header -->
                <!-- form start -->
 <form name="orderPurchaseCreateForm" role="form" novalidate>
            <div class="box-body" >
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                 </div>
  <div class="box-body">           
    <div class="row">
          <div class="col-md-1">
          </div>
         <!-- <div class="col-md-4">
              <div class="form-group" ng-class="{true: 'has-error'}[ orderDetPurchaseCreateForm.empresa.$error.required && orderDetPurchaseCreateForm.$submitted || orderDetPurchaseCreateForm.empresa.$dirty && orderDetPurchaseCreateForm.empresa.$invalid]">
                    <label>Proveedor: </label>
                    <div ng-hide="show" class="input-group">
                               <input  type="text" ng-model="orderPurchase.empresa"  name="empresa" class="form-control input-sm pull-right" placeholder="Search" required/>
                                                             
                                <div class="input-group-btn">
                                 <button class="btn btn-sm btn-default" data-toggle="modal" ng-click="searchsupplier()" data-target="#miventana" ><i class="fa fa-search"></i></button>
                               </div>
                   </div>
                   <label ng-show="orderDetPurchaseCreateForm.$submitted || orderDetPurchaseCreateForm.empresa.$dirty && orderDetPurchaseCreateForm.empresa.$invalid">
                                    <span ng-show="orderDetPurchaseCreateForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                </label>
                    <div ng-show="show" class="input-group">
                               <spam ng-show="show">@{{orderPurchase.empresa}}</spam>

                    </div> 
              </div> 
            </div>-->
            
            <div class="col-md-4">
           
          <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.empresa.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.empresa.$dirty && orderPurchaseCreateForm.empresa.$invalid]">
              <label>Proveedor: </label>
              <div class="form-group form-ok" ng-hide="show" style="width: 300px;">
               
               <input typeahead-on-select="asignarEmpresa()" type="text" name="empresa" ng-model="orderPurchase.empresa" placeholder=" por Proveedor" 
                     typeahead="supplier as supplier.empresa for supplier in suppliers | filter:$viewValue | limitTo:8"  
                     typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="is_required validate account_input form-control"
                     tooltip="Ingrese caracteres para busacar Proveedor por Empres" required>
                    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResults">
                            <i class="glyphicon glyphicon-remove"></i> No Results Found
                    </div>
             
                </div> 
                <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.empresa.$dirty && orderPurchaseCreateForm.empresa.$invalid">
                                    <span ng-show="orderPurchaseCreateForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                </label>
                <div ng-show="show" class="input-group">
                      <spam ng-show="show">@{{orderPurchase.empresa}}</spam>
                </div>
        </div>
      </div>

          
                    <!--)=========================================================================-->
           <div class="col-md-3">

                      <div  class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.fechaPedido.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid]">
                                <label for="fechaPedido">Fecha Entrega: </label>
                            <div ng-hide="show" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="date" class="form-control"  name="fechaPedido" ng-model="orderPurchase.fechaPedido" >
                            </div>
                            <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.fechaPedido.$dirty && orderPurchaseCreateForm.fechaPedido.$invalid">
                            <span ng-show="orderPurchaseCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                            </label>
                             
                             <div ng-show="show" class="input-group">
                               <spam >@{{orderPurchase.fechaPedid}}</spam>
                    </div> 
                      </div>  
                      
          </div>
         
     
          <div class="col-md-3">
                   <div class="form-group" ng-class="{true: 'has-error'}[ orderPurchaseCreateForm.warehouse.$error.required && orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid]">
                       <label for="Tienda">Almacen: </label>
                       <select ng-hide="show" class="form-control" name="warehouse" ng-change="seleccionarWarehouse()" ng-model="orderPurchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses" required>
                       <option value="">--Elija warehouses_id--</option>
                       </select>
                       <label ng-show="orderPurchaseCreateForm.$submitted || orderPurchaseCreateForm.warehouse.$dirty && orderPurchaseCreateForm.warehouse.$invalid">
                                <span ng-show="orderPurchaseCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                       <div ng-show="show" class="input-group">
                               <spam>@{{warehouses.nombre}}</spam>
                           </div>
                    </div>
          </div>
     </div>
  </div>
     <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-4">    
      <div class="form-group">
                
                <button ng-hide="show" type="submit" ng-click="Warehouses()" class="btn btn-default btn-xs">Guardar y Continuar</button>
                <a ng-show="show" ng-click="ProvandoEdicion()" class="btn btn-default btn-xs">Editar</a>
     
      </div>
      </div>
    </div>
 
             <!--   <div ng-app>
                         <a ng-click="orderPurchase.$show()" ng-show="!orderPurchase.$visible" ediable-text="userxx.name">@{{ userxx.name }}</a>
                </div>-->
            </div>
  </form>
            <!--===================================================================================-->
 
          <!--==================================================================================-->
  <div ng-show="show"  class="box" name="DetalleOrden">
        <div class="box box-default" id="box-addPro">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Producto</h3>
          <div class="box-tools pull-right">
            <button  type="submit" class="btn btn-box-tool" data-widget="collapse"><i  class="fa fa-minus"></i></button>
          
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">

        <form name="detailOrderPurchaseCreateForm" role="form" novalidate> 
          <div class="row">
             <div class="col-md-1"></div>
            <div class="col-md-4">
          <div class="input-group" style="width: 300px;">
              <label>Producto</label>
               <input ng-disabled="check" ng-hide="check1==true" typeahead-on-select="asignarProduc1()" type="text" ng-model="product.proId" placeholder="Locations loaded via $httpS"
          typeahead="product as product.proCodigo+'-'+product.proNombre+'('+(product.BraName==null ? '': product.BraName+'/')+(product.TName==null ? '' : product.TName+'/')+(product.descripcion==null ? '':product.descripcion+'/')+(product.Mnombre==null ? '':product.Mnombre)+')' for product in products | filter:$viewValue | limitTo:8"
          typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
           tooltip="Ingrese caracteres para busacar producto por codigo unico"
            >
             <input ng-show="check1==true" typeahead-on-select="asignarProduc1()" type="text" ng-model="product.proId" placeholder="Locations loaded via $httpX"
          typeahead="variant as variant.proCodigo+'-'+variant.proNombre+'('+(variant.BraName==null ? '': variant.BraName+'/')+(variant.TName==null ? '' : variant.TName+'/')+(variant.Mnombre==null ? '':variant.Mnombre+'/')+(variant.NombreAtributos==null ? '':variant.NombreAtributos)+')' for variant in variants1 | filter:$viewValue | limitTo:8" 
          typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
           tooltip="Ingrese caracteres para busacar producto por codigo unico"
            >
         
                    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> No Results Found
           </div>
            
        </div> 
            </div>


           <div ng-hide="check || check1" class="col-md-2">
           
              <div class="form-group" >
                <label for="Variante">Taco</label>
                <select class="form-control"   ng-change="mostrarTallas(detailOrderPurchase.taco)" ng-model="detailOrderPurchase.taco" ng-options="item.valorDetAtr as item.nomCortoVar+': '+item.valorDetAtr for item in variants">
                  <option value="">--Elija Num Taco--</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
            </div>
            
            <div ng-show="check" class="col-md-3">
                  <label for="Variante">Busca Por Sku</label>
                  <div class="form-group">
                  <input type="text" ng-enter="TraerPorSku(variant.sku)" class="form-control" ng-model="variant.sku">
                  </div>
            </div>
            <div class="col-md-1">
               <em>¿POR SKU?</em>
                      <div   class="form-group" >                            
                            <input  ng-disabled="check1" ng-click="limpiarDatosAgregate()" type="checkbox"  name="variantes" ng-model="check" />
                            
                        </div>
                </div>
            <div class="col-md-1">
               <em>¿Busca Normal?</em>
                      <div   class="form-group" >                            
                            <input  ng-disabled="check" ng-click="limpiarDatosAgregate()" type="checkbox"   name="variantes" ng-model="check1" />
                            
                        </div>
                </div>
            
           

    <!--
     <div class="col-md-2">
            <div class="form-group">
            <label for="Variante">Numero Talla</label>
                <!-- Split button -
              <div class="btn-group">
              <div class="row">
                     <div class="col-md-1">
                            <button type="button" ng-click="aumentarValor()" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-chevron-up"></span></button>
                            <button type="button" ng-click="bajarValor()" class="btn  btn-primary btn-xs " >
                            <span class="glyphicon glyphicon-chevron-down"></span>
                            </button>
                     </div>
                    <div class="col-md-5">
                            <button type="button" class="btn btn-info btn-lg">Talla
                            <span class="badge">@{{valor}}</span></button>
                    </div>
  
            </div>
            </div>
          </div>
    </div>
    <div class="col-md-1">
        <div class="row">
          <labe>gfhjkm</labe>
        </div>
        <div class="row">
                  <button type="button" ng-click="traerUno()" class="btn btn-primary btn-xs">
                  <span class="glyphicon glyphicon-arrow-right"></span></button>
        </div>
           <div class="row">
                  <button type="button" ng-click="traerTodo()" class="btn btn-primary btn-xs">
                  <span class="glyphicon glyphicon-export"></span></button>
          </div>
  </div>
  <div class="form-group">
     <label>Talla: @{{tallaSelect}}</pre>
  </div>
         <!-- <div class="input-group">
              <label>Variante</label>
               
               <input typeahead-on-select="asignarProduc2()" type="text" ng-model="variant.sku" placeholder="Busca por producto" 
          typeahead="variant as variant.sku for variant in variants | filter:$viewValue | limitTo:8"  
          typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
          tooltip="Ingrese caracteres para busacar producto por sku">
         
                    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> No Results Found
           </div>
             
        </div> 
      </div>-
      <div class="col-md-1">
      <div class="input-group">
      <label></label><br/>
           <input type="checkbox" name="vehicle"  ng-click="llenar()" >Base<br>
      </div>
    </div>-->
           

          </div>
  <div class="row">
  <div class="col-md-1">
       </div>
  <div class="col-md-10">
  <div ng-hide="mostrarPresentacion" class="well well-lg">
  <em>Las Tallas Disponibles Para este Producto Son</em>
  <div class="row">
       <div class="form-group">
       <div class="col-md-1">
       </div>
       <table class="table table-striped">
             <tr >
                <td ng-if="$index<=7" ng-repeat="item in atributes track by $index" style="width:40px;">
                  <div class="input-group" ng-value="item.valorDetAtr">
                 <!-- <input  type="checkbox"  ng-click="quitarTalla(item.numTalla,cheked1)" ng-model="cheked1"  />@{{item.numTalla}}
                  <input ng-show="cheked1" type="number"  style="width:40px"  placeholder="0" ng-model="cantidad" ng-blur="calCantidad(cantidad,item.numTalla)" step="1" rquired>-->
                  <input  type="checkbox"  ng-click="quitarTalla($index,item.valorDetAtr,cheked1)" ng-model="cheked1"  />@{{item.valorDetAtr}}
                  <input ng-show="cheked1" type="number"  min='0'  style="width:40px"  placeholder="0" ng-model="cantidad[$index]" ng-blur="calCantidad(item.NombreAtributos,item.varSku,item.varCodigo,cantidad[$index],item.valorDetAtr,item.TieneVariante)" step="1" rquired>
                  </div>
                 </td>
              </tr> 
              <tr >
                <td ng-if="$index>7 && $index<=14" ng-repeat="item in atributes track by $index" >
                  <div class="input-group" ng-value="item.valorDetAtr">
                 <!-- <input  type="checkbox"  ng-click="quitarTalla(item.numTalla,cheked1)" ng-model="cheked1"  />@{{item.numTalla}}
                  <input ng-show="cheked1" type="number"  style="width:40px"  placeholder="0" ng-model="cantidad" ng-blur="calCantidad(cantidad,item.numTalla)" step="1" rquired>-->
                  <input  type="checkbox"  ng-click="quitarTalla($index,item.valorDetAtr,cheked1)" ng-model="cheked1"  />@{{item.valorDetAtr}}
                  <input ng-show="cheked1" type="number"  min='0'  style="width:40px"  placeholder="0" ng-model="cantidad[$index]" ng-blur="calCantidad(item.NombreAtributos,item.varSku,item.varCodigo,cantidad[$index],item.valorDetAtr,item.TieneVariante)" step="1" rquired>
                  </div>
                 </td>
              </tr>
              <tr >
                <td ng-if="$index>14 && 21" ng-repeat="item in atributes track by $index" >
                  <div class="input-group" ng-value="item.valorDetAtr">
                 <!-- <input  type="checkbox"  ng-click="quitarTalla(item.numTalla,cheked1)" ng-model="cheked1"  />@{{item.numTalla}}
                  <input ng-show="cheked1" type="number"  style="width:40px"  placeholder="0" ng-model="cantidad" ng-blur="calCantidad(cantidad,item.numTalla)" step="1" rquired>-->
                  <input  type="checkbox"  ng-click="quitarTalla($index,item.valorDetAtr,cheked1)" ng-model="cheked1"  />@{{item.valorDetAtr}}
                  <input ng-show="cheked1" type="number"  min='0'  style="width:40px"  placeholder="0" ng-model="cantidad[$index]" ng-blur="calCantidad(item.NombreAtributos,item.varSku,item.varCodigo,cantidad[$index],item.valorDetAtr,item.TieneVariante)" step="1" rquired>
                  </div>
                 </td>
              </tr>
              <tr >
                <td ng-if="$index>21" ng-repeat="item in atributes track by $index" >
                  <div class="input-group" ng-value="item.valorDetAtr">
                 <!-- <input  type="checkbox"  ng-click="quitarTalla(item.numTalla,cheked1)" ng-model="cheked1"  />@{{item.numTalla}}
                  <input ng-show="cheked1" type="number"  style="width:40px"  placeholder="0" ng-model="cantidad" ng-blur="calCantidad(cantidad,item.numTalla)" step="1" rquired>-->
                  <input  type="checkbox"  ng-click="quitarTalla($index,item.valorDetAtr,cheked1)" ng-model="cheked1"  />@{{item.valorDetAtr}}
                  <input ng-show="cheked1" type="number"  min='0'  style="width:40px"  placeholder="0" ng-model="cantidad[$index]" ng-blur="calCantidad(item.NombreAtributos,item.varSku,item.varCodigo,cantidad[$index],item.valorDetAtr,item.TieneVariante)" step="1" rquired>
                  </div>
                 </td>
              </tr>
        </table>  
       </div>
     
      </div>
  </div>  
  </div>
  </div>
</div>           
         
           <!-------------------------------------------------------------------------->
          <div class="row">
           <div class="col-md-1">
           </div>
           <div class="col-md-10">
             <hr>
          
            <div collapse="mostrardetalles">
          <div class="well well-lg">
                 <div align="center"><h3>Seleccione Una Presentacion</h3></div> 

                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Equivalencia</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in detPres">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.nombre}}</td>
                      <td>@{{row.precioCompra}}</td>  
                      <td>@{{row.equivalencia}}</td>
                      <td ng-if="row.base==0"><span class="badge bg-red">NO</span></td> 
                      <td ng-if="row.base!=0"><span class="badge bg-green">SI</span></td> 
                      <td><a ng-click="AsignarP(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>
                    
                    
                  </table>
                  
                     
          </div> 
          </div>
        </div>
        </div>
           <!--=---------------------------------------------------------------------=--> 
          <div class="row">
          <!-- capo de Texto  Cantidad-->
          <div class="col-md-1">
          </div> 
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.cantidad.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.cantidad.$dirty && detailOrderPurchaseCreateForm.cantidad.$invalid]">
                <label for="cantidad">Cantidad</label>
                <input ng-disabled="activarCampCantidad" min='0' type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidad" id="cantidad" placeholder="0.00" ng-model="detailOrderPurchase.cantidad" ng-blur="calculateSuppPric()" step="1" >
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.cantidad.$dirty && detailOrderPurchaseCreateForm.cantidad.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.cantidad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Precio-->
            <div class="col-md-2">
               <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.preCompra.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid]">
                <label for="preCompra">Precio </label>

                <input  type="number" min='0' class="form-control ng-pristine ng-valid ng-touched" name="preCompra" placeholder="0.00" ng-model="detailOrderPurchase.preCompra" ng-blur="CalcPrecio()" step="0.1" >
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.preCompra.$dirty && detailOrderPurchaseCreateForm.preCompra.$invalid" >
                  <span ng-show="detailOrderPurchaseCreateForm.preCompra.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>

            <!-- capo de Texto  Total Bruto-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoBruto.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid]">
                <label for="montoBruto">Total Bruto</label>
                <input ng-disabled="true" type="number" min='0' class="form-control ng-pristine ng-valid ng-touched" name="montoBruto" placeholder="0.00" ng-model="detailOrderPurchase.montoBruto" ng-blur="calculateSuppPric()" step="0.1" >
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoBruto.$dirty && detailOrderPurchaseCreateForm.montoBruto.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoBruto.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.descuento.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid]">
                <label for="descuento">Descuento % </label>

                <input ng-disabled="activarCampCantidad" type="number" min='0' class="form-control ng-pristine ng-valid ng-touched" name="descuento" placeholder="0.00" ng-model="detailOrderPurchase.descuento" ng-blur="calculateSuppPric()" step="0.1">
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.descuento.$dirty && detailOrderPurchaseCreateForm.descuento.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-2"> 
                <div class="form-group" ng-class="{true: 'has-error'}[ detailOrderPurchaseCreateForm.montoTotal.$error.required && detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid]">
                <label for="montoTotal">Total</label>
                <input type="number" class="form-control ng-pristine ng-valid ng-touched" min='0'name="montoTotal" placeholder="0.00" ng-model="detailOrderPurchase.montoTotal" ng-blur="calculateSuppPric()" step="0.1" >
                <label ng-show="detailOrderPurchaseCreateForm.$submitted || detailOrderPurchaseCreateForm.montoTotal.$dirty && detailOrderPurchaseCreateForm.montoTotal.$invalid">
                  <span ng-show="detailOrderPurchaseCreateForm.montoTotal.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
            </div>
            </div>
          <div class="row">
          <!-- capo de Texto  Cantidad-->
          <div class="col-md-1">
          </div> 
           <div class="col-md-4">
          <button type="submit" class="btn btn-primary" ng-click="AgregarProducto()">Agregar Producto</button>
          </div>
        </div>
          </form>
        </div><!-- /.box-body -->
      </div>
      <script>
    $("#box-addPro").activateBox();
      </script>
              
  </div>
  
  <!--=======================================================================================================-->
  <div ng-show="show" class="box" name="table_de_detalle">
    <!--==========================================Agregar Producto====================================-->
      <div class="box box-default" id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
      <div  class="box-body" style="display: block;">
        <div class="box-body table-responsive no-padding">
          <table  class="table table-bordered" id="tabla1">
            <tr style="height: 40px">
              <th style="width: 10px">#</th>

              <th>Producto</th>
              <th>Sku </th>
              <th>Cantidad</th>
              <th>Precio Producto</th>
              <th>Precio Compra</th>
              <th>Total Bruto</th>
              <th>Descuento</th>
              <th>SubTotal</th>
              <th>Acciones</th>     
            </tr>
            <tr style="height: 40px" ng-repeat="row in detailOrderPurchases track by $index" >
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.orderPurchases_id}}</td>
                      <td ng-hide="true">@{{row.detPres_id}}</td>
                      <td>@{{row.producto}}</td>
                      <!--<td>@{{row.codigoEspecifico}}</td>-->
                      <td><a  popover-trigger="mouseenter" popover="Presentacion:@{{variants.PRename}}; 
                      Equivalencia:@{{variants.equivalencia}} @{{presentation.shortname}};Pr:@{{variants.Pnombre}};Mr:@{{variants.Bnombre}}
                      ;Tp:@{{variants.Tnombre}};Mt:@{{variants.Mnombre}}" 
                      ng-mouseover="popover(row)">@{{row.CodigoPCompra}}</a></td>
                      <td>@{{row.cantidad}}</td>
                      <td>S/.@{{row.preProducto}}</td>
                      <td>S/.@{{row.preCompra}}</td>
                      <td>S/.@{{row.montoBruto}}</td>
                      <td>@{{row.descuento}}%</td>
                      <td>S/.@{{row.montoTotal}}</td>
                      <!--<td><a data-target="#miventanaEditRow" ng-click="EditarDetalles(row,$index)" data-toggle="modal" class="btn btn-warning btn-xs" ><i class="fa fa-fw fa-pencil"></i></a>
                          <a  class="btn btn-danger btn-xs" ng-click="sacarRow($index,row.montoTotal)"><i class="fa fa-fw fa-trash"></i></a>
                      </td>-->
                       <td><button type="button" class="btn  btn-xs" ng-click="addCant(row,$index)">
                        <span class="glyphicon glyphicon-plus"></span>
                        <button type="button" class="btn btn-xs " ng-disabled="" ng-click="lessCant(row,$index)">
                        <span type="button" class="glyphicon glyphicon-minus"></span><button type="button" class="btn btn-danger btn-xs"  ng-click="sacarRow($index,row.montoTotal)">
                        <span class="glyphicon glyphicon-trash"></span></td>
                      
                      <!--<td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                      <td><a ng-click="EditarDetalles(row,row.index)" data-target="#miventanaEditRow" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                    -->
                    </tr> 
          </table>
        </div>  
      </div>
<!--===============================================================================================-->
<div  class="box-body" style="display: block;">
     <div class="row">
          <div class="col-md-2"> 
                <div class="form-group">
                <label for="suppPric">Descuento</label>
                <input type="number" ng-model="orderPurchase.descuento" min='0' class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="descuento" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-2"> 
              <div class="form-group">
                <label for="suppPric">Monto Bruto</label>
                <input ng-Disabled="true" type="number" min='0' ng-model="orderPurchase.montoBruto" class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoBruto" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
                <div  class="col-md-2"> 
                <div class="form-group">
                <label for="suppPric">Mas IGV <input type="checkbox" ng-model="orderPurchase.checkIgv" ng-click="activIgvtotal()"></label>
                <input ng-disabled="true" type="number" ng-model="orderPurchase.igv" min='0' class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="descuento" placeholder="0.00"    step="0.1">
              </div> 
                           
            </div>
             <div  class="col-md-2"> 
                <div class="form-group">
                <label for="suppPric">Base Imponible</label>
                <input ng-disabled="true" type="number" ng-model="orderPurchase.montoBase" min='0' class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                       name="descuento" placeholder="0.00"    step="0.1">
              </div>
              
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-4"> 
                <div class="form-group">
                <label for="suppPric">Monto Total</label>
                <input type="number" ng-model="orderPurchase.montoTotal" min='0' class="form-control ng-valid ng-dirty ng-valid-number ng-touched" 
                name="montoTotal" placeholder="0.00"  ng-disabled="product.hasVariants" ng-blur="calcularmontoBrutoF()" step="0.1">
              </div>
            </div>
      </div>
  </div>
  <div  class="box-body" style="display: block;">
      <div class="row">
      
        <div class="col-md-2">
               <em>¿agregar documento?</em>
                      <div   class="form-group" >                            
                            <input  type="checkbox"   name="variantes" ng-click="LimpiarDetdoc()" ng-model="checkfinal" />
                            
                        </div>
                </div>
    <div ng-show="checkfinal" class="col-md-8">
      <div class="well well-lg">
         <div class="row">
        <div class="col-md-5">
                    <div class="form-group" >
                      <label for="descripcion">Numero de Factura</label>
                      <input type="text" class="form-control input-sm" name="descripcion" placeholder="Numero Factura"
                      ng-model="orderPurchase.NumFactura" >
                      <span class="text-info"> <em> Ingrese el numero de factura para este pedido.</em></span>
                  </div>
              </div>
          <div class="col-md-4">
                    <div class="form-group" >
                      <label for="descripcion">Numero de Serie</label>
                      <input type="text" class="form-control input-sm" name="descripcion" placeholder="Numero Factura"
                      ng-model="orderPurchase.NumSerie" >
                      <span class="text-info"> <em> Ingrese el numero de Serie del documento.</em></span>
                  </div>
              </div>
          <div class="col-md-3">
               <div class="form-group" >
                <label for="tipo">Tipo documento</label>
                <select class="form-control" ng-model="orderPurchase.tipoDoc" >
                        <option value="F">Factura</option>
                        <option value="B">Boleta</option>
                        <option value="T">Tique</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
        </div>
        </div>
      </div>
         </div>
    </div>
        
                    <button type="submit" class="btn btn-primary" ng-click="CrearCompraDirecta()">Crear</button>
                    <a target="_self" href="/purchases" class="btn btn-danger">Cancelar</a>
                  </div>
      </div>
   </div>   
</form>
</div><!-- /.box -->

</div>

</div>
</div>
  <!-- ==========================================================================================-->
  </div>
        </form>
  </div>
</div>
</div>

</section>
