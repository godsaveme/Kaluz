 <section class="content-header">
          <h1>
            Saldos A Favor
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
                  <h3 class="box-title">Saldos A Favor</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                    
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
              <div  class="well well-lg">
                   <table class="table table-striped">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Proveedor</th>
                      <th>Saldo</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                      <th>Numero de Documento</th>
                      <th>Editar</th>
                    </tr>
                    
                    <tr ng-repeat="row in pendientAccounts">
                      <td>@{{$index + 1}}</td>
                      <td >@{{row.empresa}}</td>
                      
                     <td ><label style="width: 50px">@{{row.Saldo}}</label>
                      <input ng-if="indexPirata==$index" ng-show="verEdicion" ng-model="row.nuevoSaldo" type="number" min='0' ng-blur="ActualizarSaldo(row,row.nuevoSaldo)" style="width: 50px">
                      <select ng-if="indexPirata==$index" ng-show="verEdicion" class="form-control"  ng-model="row.cash_id" style="width: 100px" ng-options="item.cashID as item.nombre for item in cashHeaders" >
                       <option value="">Elija Caja</option>
                       </select></td>
                      <td>@{{row.created_at}}</td> 
                      <td ng-if="row.estado==0"><span class="badge bg-red">Pendiente</span></td> 
                      <td ng-if="row.estado==1"><span class="badge bg-green">Pagada</span></td> 
                      <td>@{{row.orderPurchase_id}}</td>
                      <td><a  ng-disabled="row.Saldo<=0" ng-hide="indexPirata==$index" type="submit" ng-click="EditarDeudas($index)" class="btn btn-success btn-xs">Editar</a>
                          <a  ng-if="indexPirata==$index" type="submit" ng-show="verEdicion" type="submit" ng-click="CuentasAFavor(row)" class="btn btn-info btn-xs">Guardar</a>
                          <a  ng-if="indexPirata==$index" ng-show="verEdicion" type="submit" ng-click="canselarEditDeudas()" class="btn btn-danger btn-xs">Cancelar</a>
                 
                 </td>
                    </tr>
                    
                    
                  </table>
                   <div class="box-body">
                  <pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" 
                  class="pagination-sm no-margin pull-right" items-per-page="itemsperPage" 
                  boundary-links="true" rotate="false" num-pages="numPages" 
                  ng-change="pagechan4()"></pagination>
                  </div>
              </div>
          </div>
      </div>             
                    
     <div class="box-footer">
                    <a href="/purchases" class="btn btn-danger">Salir</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->
