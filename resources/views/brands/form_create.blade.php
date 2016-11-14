<setion class="content-header"><h1>
            Marcas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/atributes">Marcas</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Marcas</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="brandCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="form-group" ng-class="{true: 'has-error'}[ brandCreateForm.nombre.$error.required && brandCreateForm.$submitted || brandCreateForm.nombre.$dirty && brandCreateForm.nombre.$invalid]">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" name="nombre" ng-blur="validanomMarca(brand.nombre)" placeholder="Nombre" ng-model="brand.nombre" required>
                      <label ng-show="brandCreateForm.$submitted || brandCreateForm.nombre.$dirty && brandCreateForm.nombre.$invalid">
                        <span ng-show="brandCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[ brandCreateForm.shortname.$error.required && brandCreateForm.$submitted || brandCreateForm.shortname.$dirty && brandCreateForm.shortname.$invalid]">
                      <label for="shortname">ShortName</label>
                      <input type="text" class="form-control" name="shortname" ng-blur="validanomMarca(brand.nombre)" placeholder="ShortName" ng-model="brand.shortname" required>
                      <label ng-show="brandCreateForm.$submitted || brandCreateForm.shortname.$dirty && brandCreateForm.shortname.$invalid">
                        <span ng-show="brandCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    <div class="form-group" >
                      <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="Descripcion"
                      ng-model="brand.descripcion" rows="4" cols="50"></textarea>
                     </div>

                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createBrand()">Crear</button>
                    <a href="/brands" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->