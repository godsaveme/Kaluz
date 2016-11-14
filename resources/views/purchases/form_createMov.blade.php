 <section class="content-header">
          <h1>
            Registrar Nuevo Movimiento de Stock
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/purchases"><i class="fa fa-dashboard"></i>compras</a></li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Registro de Movimientos</h3>
                </div><!-- /.box-header -->
                <!-- form start -
                <form name="storeCreateForm" role="form" novalidate>-->
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                    
        <form name="inputStocksCreateForm" role="form" novalidate>
            <div class="row">
            <div class="col-md-1">
            </div>
          
          </div>          
          <div  class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-4">
           <div  class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.fechaPedido.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPedido.$dirty && inputStocksCreateForm.fechaPedido.$invalid]">
                                <label for="fechaPedido">Fecha  </label>
                            <div  class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input ng-disabled="mostrarCreate" type="date" class="form-control"  name="fechaPedido" ng-model="purchase.fecha" required>
                            </div>
                            <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPedido.$dirty && inputStocksCreateForm.fechaPedido.$invalid">
                            <span ng-show="inputStocksCreateForm.fechaPedido.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                            </label>
                             
                           
                      </div>
          </div>
         
          <div  class="col-md-3">
          <div class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.warehouse.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid]">
                       <label for="Tienda">Almacen: </label>
                       <select ng-disabled="mostrarCreate" class="form-control" name="warehouse"  ng-model="purchase.warehouses_id" ng-options="item.id as item.nombre for item in warehouses" required>
                       <option value="">--Elija almacen--</option>
                       </select>
                       <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid">
                                <span ng-show="inputStocksCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                       
          </div>
           
      </div>
       <div  class="col-md-3">
                <div class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.warehouse.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid]">
                       <label for="Tienda">Tipo: </label>
                       <select  ng-disabled="mostrarCreate" class="form-control"  name="warehouse"  ng-model="purchase.tipo"  required>
                       <option value="Entrada" >Entrada</option>
                       <option value="Salida">Salida</option>
                       <option value="Transferencia">Transferencia</option>
                       </select>
                       <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid">
                                <span ng-show="inputStocksCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                       
                    </div>
          </div>
          
     </div>

     <div  ng-hide="mostrarCreate" class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-2">
             <div ng-hide="false" class="col-md-1">
                    <button ng-click="ver()" type="submit" class="btn btn-success btn-xs">Continuar</button>
             </div>
            </div>
    </div>
  </form>
  <form name="inputStocksBodyCreateForm" role="form" novalidate>
     <div  ng-show="mostrarCreate" class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-2">
          <div class="form-group" ng-class="{true: 'has-error'}[ inputStocksBodyCreateForm.nombre.$error.required && inputStocksBodyCreateForm.$submitted || inputStocksBodyCreateForm.nombre.$dirty && inputStocksBodyCreateForm.nombre.$invalid]">
                      <label for="nombre">Cantidad</label>
                      <input ng-disabled="Listo" type="Number" min='0' class="form-control" name="nombre" placeholder="Nombre" ng-blur="verStockActual()" ng-model="inputStock.cantidad_llegado" required>
                      <label ng-show="inputStocksBodyCreateForm.$submitted || inputStocksBodyCreateForm.nombre.$dirty && inputStocksBodyCreateForm.nombre.$invalid">
                        <span ng-show="inputStocksBodyCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
          </div>
           <div class="col-md-3">
                <div class="input-group">
                <div class="form-group" ng-class="{true: 'has-error'}[ inputStocksBodyCreateForm.empresa.$error.required && inputStocksBodyCreateForm.$submitted || inputStocksBodyCreateForm.empresa.$dirty && inputStocksBodyCreateForm.empresa.$invalid]">
              
              <label>Producto(Stock Actual:@{{inputStock.CantidaStock}})</label>
                
               <input ng-Disabled="check" typeahead-on-select="asignarProduc1()" type="text" ng-model="product.proId"  name="empresa" placeholder="Locations loaded via $http" 
               typeahead="product as product.proCodigo+'-'+product.proNombre+'('+(product.BraName==null ? '': product.BraName+'/')+(product.TName==null ? '' : product.TName+'/')+(product.descripcion==null ? '':product.descripcion+'/')+(product.Mnombre==null ? '':product.Mnombre+'/')+')' for product in products | filter:$viewValue | limitTo:8"
               typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"
               tooltip="Ingrese caracteres para busacar producto por nombre"
            required >
            
         
                    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> No Results Found
           </div>
            <label ng-show="inputStocksBodyCreateForm.$submitted || inputStocksBodyCreateForm.empresa.$dirty && inputStocksBodyCreateForm.empresa.$invalid">
                    <span ng-show="inputStocksBodyCreateForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
          </label>
        </div> 
        </div>
          </div>
          <div ng-hide="check" class="col-md-2">
           
              <div class="form-group" >
                <label for="Variante">Taco</label>
                <select ng-disabled="item!=null" ng-Disabled="!Listo" class="form-control"   ng-change="mostrarTallas(detailOrderPurchase.taco)" ng-model="detailOrderPurchase.taco" ng-options="item.valorDetAtr as item.nomCortoVar+': '+item.valorDetAtr for item in variants">
                  <option value="">--Elija Num Taco--</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
            </div>
             <div ng-show="check" class="col-md-3">
            <label for="Variante">Busca Por Sku</label>
            <div class="form-group">
            <input type="text" ng-enter="searchSkuEstock(variant.sku)" class="form-control" placeholder="Ingrse Sku" ng-model="variant.sku">
            </div>
            </div>
            <div class="col-md-3">
               <em>¿POR SKU?</em>
                      <div   class="form-group" >                            
                            <input  ng-click="soloFinta()" type="checkbox"  name="variantes" ng-model="check" />
                            
                        </div>
                </div>
          
      
          
     </div>
       <div class="row">
  <div class="col-md-1">
       </div>
  <div class="col-md-10">
  <div ng-hide="mostrarPresentacion" class="well well-lg">
   <em>Las Tallas Disponibles Para este Producto Son</em>
  <div class="row">
       <div ng-repeat="item in atributes">
       <div class="col-md-1">
       </div>
       <div class="col-md-2" >
               <div class="input-group" ng-value="item.valorDetAtr">
                 <!-- <input  type="checkbox"  ng-click="quitarTalla(item.numTalla,cheked1)" ng-model="cheked1"  />@{{item.numTalla}}
                  <input ng-show="cheked1" type="number"  style="width:40px"  placeholder="0" ng-model="cantidad" ng-blur="calCantidad(cantidad,item.numTalla)" step="1" rquired>-->
                  <input  type="checkbox"  ng-click="quitarTalla($index,item.valorDetAtr,cheked1)" ng-model="cheked1"  />@{{item.valorDetAtr}}
                  <input ng-show="cheked1" type="number" min='0' style="width:40px"  placeholder="0" ng-model="cantidad[$index]" ng-blur="calCantidad($index,item.stockActual,item.NombreAtributos,item.varSku,item.varCodigo,cantidad[$index],item.valorDetAtr)" step="1" rquired>
                  <em>Stock:@{{item.stockActual}}</em>
              </div>    
       </div>
       
     
      </div>
  </div>  
  </div>
  </div>
</div>  
     <div ng-show="mostrarCreate" class="row">
        <div class="col-md-1">
        </div>
         <!--<div ng-hide="mostrarAlmacen"class="col-md-4">
               <label for="variantes">¿Mostrar Alamcen Destino?</label>
                      <div   class="form-group" >                            
                            <input ng-disabled="orderPurchase.cancelar" type="checkbox"  name="variantes" ng-model="mostrarAlmacen" />
                            <span class="text-info"> <em> Seleccione enviar a otro almacen.</em></span>
                        </div>
                </div>-->
        <div ng-if="purchase.tipo=='Transferencia'" class="col-md-3">
          <div class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.warehouse.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid]">
                       <label for="Tienda">Alamcen Destino: </label>
                       <select  class="form-control" name="warehouse"  ng-model="purchase.warehouDestino_id" ng-options="item.id as item.nombre for item in warehouses" required>
                       <option value="">--Elija warehouses_id--</option>
                       </select>
                       <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.warehouse.$dirty && inputStocksCreateForm.warehouse.$invalid">
                                <span ng-show="inputStocksCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                       
          </div>
        </div>
        <div class="col-md-5">
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="inputStock.descripcion" rows="2" cols="50"></textarea>
                     </div>
          </div>
       
    </div>
      
    <div  ng-show="mostrarCreate" class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-1">
                    <a  type="submit" ng-click="nuevo()" class="btn btn-success btn-xs">Nuevo</a>
           </div>
          <div class="col-md-1">
                    <a  type="submit" type="submit" ng-click="noreapeatrow()" class="btn btn-success btn-xs">Agregar</a>
           </div>
      </div>
  </form>  
  </br>
           <div ng-show="mostrarCreate" class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
              <div  class="well well-lg">
                   <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Producto</th>
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Codigo</th>
                    </tr>
                    
                    <tr ng-repeat="row in inputStocks">
                      <td>@{{$index + 1}}</td>
                      <td >@{{row.producto}}</td>
                      <td >@{{row.descripcion}}</td>
                      <td >@{{row.cantidad_llegado}}</td>
                      <td>@{{row.codigo}}</td> 
                      <td><button type="button" class="btn btn-danger btn-xs"  ng-click="sacarRowStock($index)">
                        <span class="glyphicon glyphicon-trash"></span></button></td>
                    </tr>
                    
                    
                  </table>
                  <div class="">
                    <a  type="submit" ng-click="crearEntradasEstock()" class="btn btn-success btn-xs">Guardar</a>
                 </div>
              </div>
          </div>
      </div>          
                    
     <div class="box-footer">
                    <a href="/purchases/create" class="btn btn-danger">Salir</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
