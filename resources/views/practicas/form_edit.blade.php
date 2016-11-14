<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Practica
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/Practicas">Praticas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Practica</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="practicaCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ practicaCreateForm.nombre.$error.required && practicaCreateForm.$submitted || practicaCreateForm.nombre.$dirty && practicaCreateForm.nombre.$invalid]">
                      <label for="nombre">nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="nombre" ng-model="practica.nombre" required>
                      <label ng-show="practicaCreateForm.$submitted || practicaCreateForm.nombre.$dirty && practicaCreateForm.nombre.$invalid">
                        <span ng-show="practicaCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ practicaCreateForm.apellidos.$error.required && practicaCreateForm.$submitted || practicaCreateForm.apellidos.$dirty && practicaCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="practica.apellidos" required>
                      <label ng-show="practicaCreateForm.$submitted || practicaCreateForm.apellidos.$dirty && practicaCreateForm.apellidos.$invalid">

                        <span ng-show="practicaCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    <div class="form-group" >
                      <label for="edad">Edad</label>
                      <input type="text" class="form-control" name="edad" placeholder="edad"
                      ng-model="practica.edad"required>
                      <label ng-show="practicaCreateForm.$submitted || practicaCreateForm.edad.$dirty && practicaCreateForm.edad.$invalid">

                        <span ng-show="practicaCreateForm.edad.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                     </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updatepractica()">Modificar</button>
                    <a href="/practicas" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->