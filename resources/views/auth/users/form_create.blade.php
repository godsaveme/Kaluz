<!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
            Usuarios
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/users">Usuarios</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Usuario</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form name="userCreateForm" role="form" novalidate>
                {!! csrf_field() !!}
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    <div class="row">
                        <div class="col-md-6">

                    <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.name.$error.required && userCreateForm.$submitted || userCreateForm.name.$dirty && userCreateForm.name.$invalid]">
                      <label for="name">Nombres y Apellidos del Usuario</label>
                      <input type="text" class="form-control" name="name" placeholder="Nombres" ng-model="user.name" required>
                      <label ng-show="userCreateForm.$submitted || userCreateForm.name.$dirty && userCreateForm.name.$invalid">
                        <span ng-show="userCreateForm.name.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.email1.$error.required  && userCreateForm.$submitted || userCreateForm.email1.$dirty && userCreateForm.email1.$invalid]">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email1" placeholder="user@compañia.pe" ng-model="user.email" required>
                      <label ng-show="userCreateForm.$submitted || userCreateForm.email1.$dirty && userCreateForm.email1.$invalid">
                        <span ng-show="userCreateForm.email1.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                        <span ng-show="userCreateForm.email1.$error.email"><i class="fa fa-times-circle-o"></i>Formato incorrecto.</span>
                      </label>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.pass1.$error.required  && userCreateForm.$submitted || userCreateForm.pass1.$dirty && userCreateForm.pass1.$invalid]">
                      <label for="email">Password</label>
                      <input type="password" class="form-control" name="pass1" id="pass1" placeholder="pass" ng-model="user.password" ng-minlength=6 required>
                      <label ng-show="userCreateForm.$submitted || userCreateForm.pass1.$dirty && userCreateForm.pass1.$invalid">
                        <span ng-show="userCreateForm.pass1.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                        <span ng-show="userCreateForm.pass1.$error.minlength"><i class="fa fa-times-circle-o"></i>Mínimo 6 caracteres.</span>
                      </label>
                    </div></div>
                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.pass2.$error.required  && userCreateForm.$submitted || userCreateForm.pass2.$dirty && userCreateForm.pass2.$invalid]">
                      <label for="email">Confirmación de contraseña</label>
                      <input type="password" class="form-control" name="pass2" placeholder="pass" ng-model="user.password_confirmation" pw-check="pass1" required >
                      <label ng-show="userCreateForm.$submitted || userCreateForm.pass2.$dirty && userCreateForm.pass2.$invalid">
                        <span ng-show="userCreateForm.pass2.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                        <span ng-show="userCreateForm.pass2.$error.pwmatch">  Contraseñas no coinciden.</span>
                      </label>
                    </div></div>
                    </div>
                 </div>

                 <div class="col-md-6">

                   <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.store.$error.required  && userCreateForm.$submitted || userCreateForm.store.$dirty && userCreateForm.store.$invalid]">
                          <label>Tienda</label>
                               <select name="store" class="form-control" ng-model="user.store_id" ng-options="k as v for (k, v) in stores">

                            </select>
                            <label ng-show="userCreateForm.$submitted || userCreateForm.store.$dirty && userCreateForm.store.$invalid">
                                                    <span ng-show="userCreateForm.store.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>

                                                  </label>
                     </div>
                     <div class="row">
                     <div class="col-md-6">

                     <div class="form-group" ng-class="{true: 'has-error'}[ userCreateForm.role.$error.required  && userCreateForm.$submitted || userCreateForm.role.$dirty && userCreateForm.role.$invalid]">
                                               <label>Rol</label>
                                                    <select name="role" class="form-control" ng-model="user.role_id" ng-options="role.key1 as role.value1 for role in roles">

                                                 </select>
                                                 <label ng-show="userCreateForm.$submitted || userCreateForm.role.$dirty && userCreateForm.role.$invalid">
                                                                         <span ng-show="userCreateForm.role.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>

                                                                       </label>
                                          </div></div>
                        <div class="col-md-6">
                       <div class="form-group">
                       <label for="estado">Estado</label>
                            <select class="form-control" name="estado" ng-model="user.estado" ng-options="item.key as item.value for item in estados"></select>
                       </div>
                       </div></div>
                       <div class="form-group">
                       <label>Imagen</label>
                       <input type="file" ng-model="user.image" id="userImage" name="userImage"/>
                       </div>

                 </div>

             </div>






                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="createUser()">Crear</button>
                    <a href="/users" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->