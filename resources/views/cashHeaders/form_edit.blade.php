<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cajas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cashHeaders">Cajas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
          <div class="row">
            <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Cajas</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cashHeaderCreateForm" role="form" novalidate>
                  <div class="box-body">
                    <div class="callout callout-danger" ng-show="errors">
                      <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                      </ul>
                    </div>

                    <div class="row">
                   <div class="col-md-12">
                    <div class="form-group" ng-class="{true: 'has-error'}[ cashHeaderCreateForm.nombre.$error.required && cashHeaderCreateForm.$submitted || cashHeaderCreateForm.nombre.$dirty && cashHeaderCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre Caja</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre Caja" ng-model="cashHeader.nombre" required>
                      <label ng-show="cashHeaderCreateForm.$submitted || cashHeaderCreateForm.nombre.$dirty && cashHeaderCreateForm.nombre.$invalid">
                        <span ng-show="cashHeaderCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                  </div>

                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" ng-class="{true: 'has-error'}[ cashHeaderCreateForm.ambiente.$error.required && cashHeaderCreateForm.$submitted || cashHeaderCreateForm.ambiente.$dirty && cashHeaderCreateForm.ambiente.$invalid]">
                      <label for="ambiente">Ambiente</label>
                      <input type="text" class="form-control" name="ambiente" placeholder="Ambiente" ng-model="cashHeader.ambiente" required>
                      <label ng-show="cashHeaderCreateForm.$submitted || cashHeaderCreateForm.ambiente.$dirty && cashHeaderCreateForm.ambiente.$invalid">
                        <span ng-show="cashHeaderCreateForm.ambiente.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                  </div>
                  </div>

                                    
                  <div class="row">
                    <div class="col-md-6">
                     <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select class="form-control" name="" ng-model="cashHeader.store_id" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6"> 
                        <div class="form-group">
                          <label>Estado</label>
                          <select name="genero" class="form-control" ng-model="cashHeader.estado">
                            <option value="1">Activo</option>
                            <option value="0">inactivo</option>
                          </select>
                        </div>
                      </div>
                   </div>
                     
                  <div class="row">
                  <div class="col-md-12">
                    <div class="form-group" >
                      <label for="apellidos">Descripcion</label>
                      <textarea type="text" class="form-control" name="descripcion" placeholder="Descripcion"
                      ng-model="cashHeader.descripcion"/>
                     </div>
                    </div>
                  </div>

                    



                    </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updatecashHeader()">Modificar</button>
                    <a href="/cashHeaders" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
        </section><!-- /.content -->