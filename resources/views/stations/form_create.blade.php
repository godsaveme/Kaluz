<setion class="content-header"><h1>
            Estaciones
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/atributes">Estaciones</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Estaciones</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="stationCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.nombre.$error.required && stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomStacion()"placeholder="Nombre" ng-model="station.nombre" required>
                      <label ng-show="stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid">
                        <span ng-show="stationCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.shortname.$error.required && stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid]">
                      <label for="shortname">ShortName</label>
                      <input type="text" class="form-control" name="shortname" placeholder="ShortName" ng-model="station.shortname" required>
                      <label ng-show="stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid">
                        <span ng-show="stationCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="station.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createStation()">Crear</button>
                    <a href="/stations" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->