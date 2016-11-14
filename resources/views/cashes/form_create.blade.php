 <section class="content-header">
          <h1>
            Cajas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/cashHeaders">Cajas</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Cajas</h3>
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
                   <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Tienda</label>

                          <select class="form-control" name="" ng-model="stores.id" ng-click="mostrarCajas()" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                          </select>
                        </div>
                      </div>
                   <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Caja</label>

                          <select class="form-control" name="" ng-model="cash.cashHeader_id" ng-options="item.id as item.nombre for item in cashHeaders">
                          <option value="">--Elije Caja--</option>
                          </select>
                        </div>
                      </div>
                    <!-- capo de Texto  Monto-->
                      <div class="col-md-4">
                        <div class="form-group" ng-class="{true: 'has-error'}[ cashCreateForm.montoInicial.$error.required && cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid]">
                          <label for="montoInicial">Monto Inicial</label>
                          <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="montoInicial" placeholder="0.00" ng-model="cash.montoInicial" ng-blur="calculateSuppPric()" step="0.1">
                          <label ng-show="cashCreateForm.$submitted || cashCreateForm.montoInicial.$dirty && cashCreateForm.montoInicial.$invalid">
                            <span ng-show="cashCreateForm.montoInicial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                         </div>
                        </div>
                  </div>


                  </div><!-- /.box -->
                                  
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createcash()">Crear</button>
                    <a href="/cashes" class="btn btn-danger">Cancelar</a>
                  </div>

                </form>
              

              </div>
              </div><!-- /.row -->
              </div>
              </section><!-- /.content -->