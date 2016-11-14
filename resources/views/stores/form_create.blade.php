 <section class="content-header">
          <h1>
            Tiendas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Tiendas</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Tienda</h3>
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
                          <div class="col-md-6">


                    <div class="form-group" ng-class="{true: 'has-error'}[ storeCreateForm.nombreTienda.$error.required && storeCreateForm.$submitted || storeCreateForm.nombreTienda.$dirty && storeCreateForm.nombreTienda.$invalid]">
                      <label for="nombres">Nombre Tienda</label>
                      <input type="text" class="form-control" name="nombreTienda" placeholder="Nombre Tienda" ng-model="store.nombreTienda" required>
                      <label ng-show="storeCreateForm.$submitted || storeCreateForm.nombreTienda.$dirty && storeCreateForm.nombreTienda.$invalid">
                        <span ng-show="storeCreateForm.nombreTienda.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ storeCreateForm.razonSocial.$error.required && storeCreateForm.$submitted || storeCreateForm.razonSocial.$dirty && storeCreateForm.razonSocial.$invalid]">
                      <label for="Rasocial">Razon Social</label>
                      <input type="text" class="form-control" name="razonSocial" placeholder="Razon Social" ng-model="store.razonSocial" required>
                      <label ng-show="storeCreateForm.$submitted || storeCreateForm.razonSocial.$dirty && storeCreateForm.razonSocial.$invalid">
                        <span ng-show="storeCreateForm.razonSocial.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ storeCreateForm.ruc.$error.required && storeCreateForm.$submitted || storeCreateForm.ruc.$dirty && storeCreateForm.ruc.$invalid]">
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" placeholder="RUC" ng-model="store.ruc" required>
                      <label ng-show="storeCreateForm.$submitted || storeCreateForm.ruc.$dirty && storeCreateForm.ruc.$invalid">
                        <span ng-show="storeCreateForm.ruc.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                              <div class="form-group" ng-class="{true: 'has-error'}[ storeCreateForm.ruc.$error.required && storeCreateForm.$submitted || storeCreateForm.email1.$dirty && storeCreateForm.email1.$invalid]">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control" name="email1" placeholder="tienda@compania.pe" ng-model="store.email">
                                  <label ng-show="storeCreateForm.$submitted || storeCreateForm.email1.$dirty && storeCreateForm.email1.$invalid">

                                      <span ng-show="storeCreateForm.email1.$error.email"><i class="fa fa-times-circle-o"></i>Formato incorrecto.</span>
                                  </label>
                              </div>

                              <div class="form-group" >
                                  <label for="apellidos">Website</label>
                                  <input type="text" class="form-control" name="website" placeholder="Website"
                                         ng-model="store.website">
                              </div>

                          </div>
                          <div class="col-md-6">

                              <div class="form-group" ng-class="{true: 'has-error'}[ storeCreateForm.direccion.$error.required && storeCreateForm.$submitted || storeCreateForm.direccion.$dirty && storeCreateForm.direccion.$invalid]">
                                  <label for="ruc">Direccion</label>
                                  <input type="text" class="form-control" name="direccion" placeholder="RUC" ng-model="store.direccion" required>
                                  <label ng-show="storeCreateForm.$submitted || storeCreateForm.direccion.$dirty && storeCreateForm.direccion.$invalid">
                                      <span ng-show="storeCreateForm.direccion.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                  </label>
                              </div>
                     
                    <div class="form-group" >
                      <label for="apellidos">Distrito</label>
                      <input type="text" class="form-control" name="distrito" placeholder="Distrito"
                      ng-model="store.distrito">
                     </div>
                    <div class="form-group" >
                      <label for="apellidos">Provincia</label>
                      <input type="text" class="form-control" name="provincia" placeholder="Provincia"
                      ng-model="store.provincia">
                     </div>
                     <div class="form-group" >
                      <label for="apellidos">Departamento</label>
                      <input type="text" class="form-control" name="departamento" placeholder="Departamento"
                      ng-model="store.departamento">
                     </div>
                              <div class="form-group" >
                                  <label for="apellidos">País</label>
                                  <input type="text" class="form-control" name="departamento" placeholder="País"
                                         ng-model="store.pais">
                              </div>



                          </div>
                          </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createStore()">Crear</button>
                    <a href="/stores" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->