


        <!--================================================================================-->
        <section class="content-header">
          <h1>
            Movimientos de Almacen 
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/purchases"><i class="fa fa-dashboard"></i>compras</a></li>
            
          </ol>

          
        </section>
<!--===========================================================================================-->
<section class="content">

<div class="row">
<div class="col-md-12">

<div class="box box-primary" >
                             <div class="box-header with-border">
                                   <h3 class="box-title">Movimientos de Almacen</h3>
                             </div><!-- /.box-header -->
                <!-- form start -->
 <form name="inputStocksCreateForm" role="form" novalidate>
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
          <div  class="col-md-1">
                    <button  ng-click="limpiarStocks()"class="btn btn-success btn-xs">Registrar Nuevo</button>
           </div>
  </div> 
  <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-2">
               <em>¿Seleccione para filtrar individualmente?</em>
                      <div   class="form-group" >                            
                            <input   ng-click="limpiarFiltros()" type="checkbox"  name="variantes" ng-model="check" />
                            
                        </div>
                </div>        
        
          <div class="col-md-2">
                  <div  class="form-group">
                                <label for="fechaPedido">Elija Rango de Fechas</label>
                            <div  class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input  type="date" class="form-control"  ng-change="filtrarFechas()" name="fechaPedido" ng-model="purchase.fechaini">
                            </div>
                  </div>
          </div>
          <div class="col-md-3">
                  <div  class="form-group" ng-class="{true: 'has-error'}[ inputStocksCreateForm.fechaPrevista.$error.required && inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPrevista.$dirty && inputStocksCreateForm.fechaPrevista.$invalid]">
                            <label for="fechaPrevista"><---></label>
                                <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  ng-disabled="purchase.fechaini==null" type="date"  ng-change="filtrarFechas()" min="@{{purchase.fechaini}}" class="form-control" name="fechaPrevista" ng-model="purchase.fechafin" required>
                                   </div>   
                                  <label ng-show="inputStocksCreateForm.$submitted || inputStocksCreateForm.fechaPrevista.$dirty && inputStocksCreateForm.fechaPrevista.$invalid">
                                         <span ng-show="inputStocksCreateForm.fechaPrevista.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                      </label>
                            
                      </div> 
          </div>
           <div ng-show="check" class="col-md-2">
          <div class="form-group" >
                <label for="Variante">Filtrar Por</label>
                <select  class="form-control"   ng-change="searchporTipo()" ng-model="purchase.tipoMov" >
                  <option value="">Elejir Mov</option>
                  <option value="Entrada">Entrada</option>
                  <option value="Salida">Salida</option>
                  <option value="Transferencia">Transferencia</option>
                  <option value="Venta">Salida Venta</option>
                  <option value="Compra">Entrada Compra</option> 
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
           <div ng-hide="check" class="col-md-2">
          <div class="form-group" >
                <label for="Variante">Filtrar Por</label>
                <select  ng-disabled="purchase.fechaini==null || purchase.fechafin==null" ng-change="filtrarFechas()" class="form-control"   ng-model="purchase.tipoMov" >
                  <option value="">Elejir Mov</option>
                  <option value="Entrada">Entrada</option>
                  <option value="Salida">Salida</option>
                  <option value="Transferencia">Transferencia</option>
                  <option value="Venta">Salida Venta</option>
                  <option value="Compra">Entrada Compra</option> 
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
          <div class="col-md-1">
             <a ng-click="MovimientoAlmacen()" style="width:95px;"class="btn btn-success btn-xs">@{{textMovimiento}}</a>
             <a ng-href="@{{pdfMovimiento}}" style="width:95px;" target="_blank" class="btn btn-primary btn-xs">Ver Reporte</a>
          </div>
  </div>
      
      <div class="row">
          <div class="col-md-1">
          </div>
         
          <div class="col-md-10">
            <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Tipo</th>
                      <th>Numero de Orden</th>
                      <th>Numero de Compra</th>
                      <th>Numero de Venta</th>
                      <th>Usuario</th>
                      <th style="width: 200px">Almacen</th>
                      <th>Detalles</th>
                    </tr>
                    
                    <tr ng-repeat="row in headInputStocks">
                      <td>@{{$index + 1}}</td>
                      <td >@{{row.Fecha}}</td>
                      <td ng-if="row.tipo=='Entrada-Anulado'"><span class="badge bg-yellow">Entrada-Anulado</span></td> 
                      <td ng-if="row.tipo=='Entrada'"><span class="badge bg-red">Entrada</span></td> 
                      <td ng-if="row.tipo=='Transferencia'"><span class="badge bg-yellow">Transferencia</span></td> 
                      <td ng-if="row.tipo=='Salida'"><span class="badge bg-green">Salida</span></td> 

                      <td ng-if="row.tipo=='Compra'"><span class="badge bg-brown">Compra</span></td> 
                      <td ng-if="row.tipo=='Venta'"><span class="badge bg-purple">Venta</span></td> 

                      <td ng-if="row.tipo=='Salida Venta'"><span class="badge bg-green">Salida Venta</span></td> 
                      <td ng-if="row.tipo=='Entrada Venta'"><span class="badge bg-red">Entrada Venta</span></td> 

                      <td >@{{row.orderPurchase_id}}</td>
                      <td>@{{row.purchase_id}}</td>
                      <td>@{{row.sale_id}}</td>
                      <td>@{{row.nombreUser}}
                      <td ng-if="row.tipo!='Transferencia'">@{{row.nombre}}</td>  
                      <td ng-if="row.tipo=='Transferencia'">@{{row.nombre+"->"+row.nomAlmacen2}}</td>
                      <td><button data-toggle="modal" ng-click="ListarinputStocks(row)" data-target="#ventanalista" class="btn btn-success btn-xs">Ver Detalles</button>
                      </td>
                    </tr>
                    
                    
                  </table>
                </div>
            </div>
        <div class="row">
        <div class="col-md-1">
        </div>
          <div class="col-md-1">
                    <a href="/purchases" class="btn btn-danger">Salir</a>
        </div>
          <div class="col-md-9">
            <div class="box-footer clearfix">
                  <pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" 
                  class="pagination-sm no-margin pull-right" items-per-page="itemsperPage" 
                  boundary-links="true" rotate="false" num-pages="numPages" 
                  ng-change="pagechan2()"></pagination>
               </div> 
           </div>
        <div class="col-md-1">
        </div>
        
      </div>
 
             <!--   <div ng-app>
                         <a ng-click="purchase.$show()" ng-show="!purchase.$visible" ediable-text="userxx.name">@{{ userxx.name }}</a>
                </div>-->
            </div>
            <!--===================================================================================-->
            
        
 
<!--===============================================================================================-->
     
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


<!--================Ventana Emergente Crear=================================-->
       
        <!--================Ventana Emergente Crear=================================-->
        <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="ventanalista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
               <div style="border-radius: 5px" class="modal-content">
                 <div class="modal-header" style="border-radius: 5px" >
                   <button type="button"  class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                   <h4><b>Listado de Detalles</b></h4>
                   </div>
                   <div class="modal-body">
        
      
    
      </br>
           <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="box-body table-responsive no-padding">
              
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
                    </tr>
                    
                    
                  </table>
                  
              </div>
          </div>
      </div>
                     </div>
                     
                     </form>
                   
                    <div class="box-footer">
                    <a href="/purchases" class="btn btn-danger">Salir</a>
                  </div>
               </div>
             </div>
           </div>
        </div>
        </div>