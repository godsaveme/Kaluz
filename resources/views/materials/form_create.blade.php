<setion class="content-header"><h1>
            Materiales
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/materials">Materiales</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Materiales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="materialCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.nombre.$error.required && materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="Nombre" ng-model="material.nombre" required>
                      <label ng-show="materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid">
                        <span ng-show="materialCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.shortname.$error.required && materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid]">
                      <label for="shortname">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="material.shortname" required>
                      <label ng-show="materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid">
                        <span ng-show="materialCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="material.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createMaterial()">Crear</button>
                    <a href="/materials" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->