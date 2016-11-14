  <section class="content-header">
          <h1>
            Alamacenes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/types">Almacenes</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Creando Almacenes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="warehouseCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                   <div class="row">
                     <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ warehouseCreateForm.nombre.$error.required && warehouseCreateForm.$submitted || warehouseCreateForm.nombre.$dirty && warehouseCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="warehouse.nombre" required>
                      <label ng-show="warehouseCreateForm.$submitted || warehouseCreateForm.nombre.$dirty && warehouseCreateForm.nombre.$invalid">
                        <span ng-show="warehouseCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ warehouseCreateForm.shortname.$error.required && warehouseCreateForm.$submitted || warehouseCreateForm.shortname.$dirty && warehouseCreateForm.shortname.$invalid]">
                      <label for="nombre">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="Nombre" ng-model="warehouse.shortname" required>
                      <label ng-show="warehouseCreateForm.$submitted || warehouseCreateForm.shortname.$dirty && warehouseCreateForm.shortname.$invalid">
                        <span ng-show="warehouseCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="form-group" >
                      <label for="descripcion">Capacidad</label>
                      <input type="text" class="form-control" name="capacidad" placeholder="Capcidad"
                      ng-model="warehouse.capacidad">
                     </div>
                     
                     <div class="form-group" >
                       <label for="Tienda">Tienda</label>
                       <select class="form-control" name="" ng-model="warehouse.store_id" ng-options="item.id as item.nombreTienda for item in stores">
                       </select>
                     </div>
                     </div>
                     <div class="col-md-12">
                      <div class="form-group" >
                      <label for="descripcion">Descripcion</label>
                      <textarea type="descripcion" class="form-control" name="descripcion" placeholder="Decripcion"
                      ng-model="warehouse.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createWarehouse()">Crear</button>
                    <a href="/warehouses" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->