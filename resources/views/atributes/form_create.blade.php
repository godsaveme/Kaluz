<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Atributos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/atributes">Atributos</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Atributos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="atributCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                   
                    <div class="form-group" ng-class="{true: 'has-error'}[ atributCreateForm.nombre.$error.required && atributCreateForm.$submitted || atributCreateForm.nombre.$dirty && atributCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="atribut.nombre" required>
                      <label ng-show="atributCreateForm.$submitted || atributCreateForm.nombre.$dirty && atributCreateForm.nombre.$invalid">
                        <span ng-show="atributCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ atributCreateForm.shortname.$error.required && atributCreateForm.$submitted || atributCreateForm.shortname.$dirty && atributCreateForm.shortname.$invalid]">
                      <label for="nombre">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="atribut.shortname" required>
                      <label ng-show="atributCreateForm.$submitted || atributCreateForm.shortname.$dirty && atributCreateForm.shortname.$invalid">
                        <span ng-show="atributCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" >
                      <label for="descripcion">Descripcion</label>
                      <textarea type="descripcion" class="form-control" name="descripcion" placeholder="Descripcion"
                      ng-model="atribut.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createAtribut()">Crear</button>
                    <a href="/atributes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->