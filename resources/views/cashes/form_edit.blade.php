<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Caja Diaria
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cashMonthlys">Caja Diaria</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
          <div class="row">
            <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Estado Caja # @{{cash.id}}</h3> 
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cashCreateForm" role="form" novalidate>
                  <div class="box-body">
                    <div class="callout callout-danger" ng-show="errors">
                      <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                      </ul>
                    </div>
                    <div class="row">
                    <div class="col-md-1">
                    </div>
                      <div class="col-md-4">
                        <a ng-click="rutaMovimiento()" ng-href="@{{rutaDetCash}}"  target="_self" type="submit" class="btn btn-primary" ng-if="cash.estado==1">Agregar Movimiento</a>
                      </div>
                      <div class="col-md-1">
                    </div>
                      <div class="col-md-4">
                        <a ng-click="cerrarCaja()"  type="submit" class="btn btn-primary" ng-if="cash.estado==1">Cerrar Caja</a>
                      </div>
                    </div>

                    

                  <div class="row">
                  <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-calculator"></i>
                          <h3 class="box-title">Movimientos de Caja</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                            <label for="montoInicial">Monto Inicial</label>
                            <input string-to-number ng-disabled="true" type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoInicial" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid">
                              <span ng-show="cashCreateForm.montoInicial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                            <label for="ingresos">Monto Ingresos</label>
                            <input string-to-number ng-disabled="true" type="text" class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.ingresos" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid">
                              <span ng-show="cashCreateForm.ingresos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.gastos.$error.required && cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid]">
                            <label for="gastos">Monto Gastos</label>
                            <input string-to-number ng-disabled="true" type="text" class="form-control ng-pristine ng-valid ng-touched" name="gastos" placeholder="0.00" ng-model="cash.gastos" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid">
                              <span ng-show="cashCreateForm.gastos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>
                     
                    
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>


                    <div class="col-md-1">
                    </div>

                    <div class="col-md-4">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <i class="fa fa-calculator"></i>
                          <h3 class="box-title">Arqueo</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                           <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                            <label for="montoInicial">Monto Teorico</label>
                            
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                            <input string-to-number ng-disabled="true" style="width:40%; float:left;" type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoBruto2" ng-blur="calculateSuppPric()" step="0.1">
                            <input string-to-number ng-disabled="true" style="width:30%; float:left" type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.totoTarjeta" ng-blur="calculateSuppPric()" step="0.1">
                            <input string-to-number ng-disabled="true" style="width:30%;" type="text" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoBruto" ng-blur="calculateSuppPric()" step="0.1">
                            
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid">
                              <span ng-show="cashCreateForm.montoInicial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div ng-if="cash.estado!=1" class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                            <label for="ingresos">Monto Real</label>
                            <input string-to-number ng-disabled="true" type="number" class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.montoReal" ng-blur="calculardescuadre()" step="0.1" min="0">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid">
                              <span ng-show="cashCreateForm.ingresos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>
                          <div ng-if="cash.estado==1" class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                              <label for="ingresos">Monto Real Efect./Tarj.</label>
                          </div>
                          <div ng-if="cash.estado==1" class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.ingresos.$error.required && cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid]">
                            
                            <input string-to-number style="width:50%; float:left;" type="number" min="0"class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.montoReal" ng-blur="calculardescuadre()" step="0.1">
                            <input string-to-number style="width:50%;" type="number" min="0"class="form-control ng-pristine ng-valid ng-touched" name="ingresos" placeholder="0.00" ng-model="cash.montoRealTar" ng-blur="calculardescuadre()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.ingresos.$dirty && cashCreateForm.ingresos.$invalid">
                              <span ng-show="cashCreateForm.ingresos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>

                          <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.gastos.$error.required && cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid]">
                            <label for="gastos">Descuadre</label>
                            <input string-to-number ng-disabled="true" type="text" class="form-control ng-pristine ng-valid ng-touched" name="gastos" placeholder="0.00" ng-model="cash.descuadre" ng-blur="calculateSuppPric()" step="0.1">
                            <label ng-show="cashCreateForm.$submitted || cashCreateForm.gastos.$dirty && cashCreateForm.gastos.$invalid">
                              <span ng-show="cashCreateForm.gastos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                            </label>
                          </div>


                     
                    
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10"> </div>
                      <div class="col-md-2">
                        <button ng-click="generarReporteDetCash()" type="submit" class="btn btn-primary" >@{{descriReport}}</button>
                      </div>
                  </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Caja</th>
                      <th>Usuario</th>
                      <th>Tipo de Mov</th>
                      <th>Documento</th>
                      <th>S/.Tarjeta</th>
                      <th>S/.Efectivo</th>
                      <th>Estado</th>
                      <th>Ver Venta</th>
                    </tr>
                    
                    <tr ng-repeat="row in detCashes">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.hora}}</td>
                      <td>@{{row.nombre}}</td>
                      <td>@{{row.name}}</td>
                      <td>@{{row.Motivo}}</td>
                      <td ng-if="row.tipoDoc!=null">@{{row.tipoDoc+"-"+row.NumDocument}}</td>
                      <td ng-if="row.tipoDoc==null">-</td>
                      <td>@{{row.tarjeta}}</td>
                      <td ng-if="row.cashMotive_id!=1 && row.cashMotive_id!=13 && row.cashMotive_id!=14 && row.cashMotive_id!=15 && row.cashMotive_id!=16 && row.cashMotive_id!=17
                                 && row.cashMotive_id!=19 && row.cashMotive_id!=20 && row.cashMotive_id!=21"><spam style="color:red;">@{{row.efectivo}}</spam></td>
                      <td ng-if="row.cashMotive_id==1 || row.cashMotive_id==13 || row.cashMotive_id==14
                      || row.cashMotive_id==15 || row.cashMotive_id==16 || row.cashMotive_id==17 ||
                      row.cashMotive_id==19 || row.cashMotive_id==20 || row.cashMotive_id==21">@{{row.efectivo}}</td>
                      
                      <td ng-if="row.estado==3"><span style="color: red;">Anul.</span></td>
                      <td ng-if="row.estado==1"><span style="color: green;">Term.</span></td>
                      <td ng-if="row.estado==0"><span style="color: yellow;">Pend.</span></td>
                      <td ng-if="row.estado==null"><span style="color: greenyellow;">Activo.</span></td>
                      <td ng-if="row.cashMotive_id==1 || row.cashMotive_id==13 || row.cashMotive_id==14"><a href="/sales/edit/@{{row.id}}" target="_blank">ver venta</a></td>
                      <td ng-if="row.cashMotive_id==15 || row.cashMotive_id==16 || row.cashMotive_id==17"><a href="/separateSales/edit/@{{row.observacion}}" target="_blank">ver pedido</a></td>
                      <td ng-if="row.cashMotive_id==19 || row.cashMotive_id==20 || row.cashMotive_id==21"><a href="/separateSales/edit/@{{row.observacion}}" target="_blank">ver separado</a></td>
                      <td ng-if="row.cashMotive_id!=1 && row.cashMotive_id!=13 && row.cashMotive_id!=14 && row.cashMotive_id!=15 && row.cashMotive_id!=16 && row.cashMotive_id!=17
                                 && row.cashMotive_id!=19 && row.cashMotive_id!=20 && row.cashMotive_id!=21">
                               @{{row.observacion}}</td>

                    </tr>                    
                  </table>
                  <div class="box-footer clearfix">
                    <pagination total-items="totalItems1" ng-model="currentPage1" max-size="maxSize1" 
                    class="pagination-sm no-margin pull-right" items-per-page="itemsperPage1" boundary-links="true" rotate="false" 
                    num-pages="numPages1" ng-change="pageChanged1()"></pagination>
                  </div>



                    </div>


                  <script type="text/javascript">
                     $('#myModal').on('shown.bs.modal', function () {
                        $('#myInput').focus()
                      })
                  </script>
                 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">Cambiar Monto de Gasto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4"> 
               <label>Ingrese nuevo Monto</label>
            </div>
            <div class="col-md-8"> 
               <input string-to-number type="number" class="form-control" ng-model="nuevoMonto">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" ng-click="updateMontoGasto()" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->



        </section><!-- /.content -->


