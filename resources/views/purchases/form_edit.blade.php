<section class="content-header">
          <h1>
            Detalle De Compra
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
                  <h3 class="box-title">Detalle De Compra</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="purchaseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                       </div>
                                    
 <div class="box">  
                       <div  class="input-group">
                               <label>Proveedor:</label>
                               <spam>@{{purchases.empresa}}</spam>
                         </div>
                          <div class="input-group">
                                <label>Alamacen:</label>
                               <spam>@{{purchases.almacen}}</spam>
                         </div>
                          <div  class="input-group">
                               <label>Fecha de Entrega:</label>
                               <spam>@{{purchases.fechaEntrega.substring(0,10)}}</spam>
                         </div>
                          <div  class="input-group">
                               <label>Orden de Pedido:</label>
                               <spam ng-if="purchases.orderPurchase_id>0"><a   target="_self" ng-href="/orderPurchases/edit/@{{purchases.orderPurchase_id}}">ver Orden de Pedido</a></spam>
                               <spam ng-if="purchases.orderPurchase_id==null">No Cuenta con orden de Pedido</spam>
                         
                         </div>
    </div>   

<!--=================================================================================================================-->
<!--==========================================Agregar Producto====================================-->
      <div class="box box-default"  id="price">
        <div class="box-header with-border">
          <h3 class="box-title">Lista de Producto</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div  class="box-body" style="display: block;">
          <table  class="table table-bordered" id="tabla1">
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
            <tr  ng-repeat="row in detailPurchases">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.purchases_id}}</td>
                      <td ng-hide="true">@{{row.detPres_id}}</td>
                      <td>@{{row.producto}}</td>
                      <td>@{{row.CodigoPCompra}}</td>
                      <td>@{{row.cantidad}}</td>
                      <td>S/.@{{row.preProducto}}</td>
                      <td>S/.@{{row.preCompra}}</td>
                      <td>S/.@{{row.montoBruto}}</td>
                      <td>S/.@{{row.descuento}}</td>
                      <td>S/.@{{row.montoTotal}}</td>
                      
                      <!--<td><a ng-click="sacarRow(row.index,row.montoTotal)" class="btn btn-warning btn-xs">Sacar</a></td>
                      <td><a ng-click="EditarDetalles(row,row.index)" data-target="#miventanaEditRow" data-toggle="modal" class="btn btn-warning btn-xs">Edit</a></td>
                    -->
                    </tr> 
          </table>


        </div>
      </div>
  <!-- ==========================================================================================-->
        <div class="row">
          <div class="col-md-1"> 
                <div class="form-group">
                <label for="suppPric">Descuento</label>
                <label style="border:solid 2px; width:100%; height:30px;">@{{purchase.descuento}} %</label>              
            </div>
            </div>
            <!-- capo de Texto  Descuento-->
            <div class="col-md-3"> 
              <div class="form-group">
                <label for="suppPric">Monto Bruto</label>
                    <label style="border:solid 2px; width:100%; height:30px;">S/.@{{purchase.montoBruto}}</label>              
            
                </div>
            </div>
            <div class="col-md-2"> 
                <div class="form-group">
                <label for="suppPric">Mas IGV(18%)</label>
                <label style="border:solid 2px; width:100%; height:30px;">S/.@{{purchase.igv}}</label>              
            
              </div>
              
            </div>
            <div class="col-md-3"> 
                <div class="form-group">
                <label for="suppPric">Monto Base</label><br>
                <label style="border:solid 2px; width:100%; height:30px;">S/.@{{purchase.montoBase}}</label>              
            </div>
            </div>
            <!-- capo de Texto  Total-->
            <div class="col-md-3"> 
                <div class="form-group">
                <label for="suppPric">Monto Total</label>
                <label style="border:solid 2px; width:100%; height:30px;">S/.@{{purchase.montoTotal}}</label>              
            </div>
            </div>
          </div>
          
                 <!--  <button ng-click="GenerrarReportCod()" type="submit" class="btn btn-primary btn-xs">@{{botonReporteCod}}</button>
                   <a ng-show="verReportSku1" ng-click="" ng-href="@{{pdf1}}" target="_blank" type="submit" class="btn btn-warning btn-xs"  >Ver Reporte</a>-->
                  <button  ng-click="ReportTiketCompras1()" class="btn btn-info">@{{decriboton20}}</button>
                  <button  ng-click="ReportTiketCompras2()" class="btn btn-info">@{{decriboton21}}</button>
                   <a ng-show="verReportTiket1" ng-click=""ng-href="@{{pdfTiketsSku}}" target="_blank" type="submit" class="btn btn-warning btn-xs"  >Ver Reporte</a>
                   <a href="/purchases" class="btn btn-success btn-xs">Regresar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->




      
      


                     
            
        
    