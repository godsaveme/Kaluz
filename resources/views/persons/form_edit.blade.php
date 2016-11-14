<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Personas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Personas</li>
            <li class="active">Editar</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Persona</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form name="personCreateForm" role="form" novalidate>
                  <div class="box-body">
                                <div class="callout callout-danger" ng-show="errors">
                                <ul>
                            <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                            </ul>
                          </div>


                    <div class="form-group">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="nombres" ng-model="person.nombres" required>
                      <div ng-show="personCreateForm.$submitted || personCreateForm.nombres.$touched">
                        <div ng-show="personCreateForm.nombres.$error.required">Tell us your name.</div>
                      </div>
                    </div>
                    <div class="form-group" ng-class="{true: 'has-error'}[personCreateForm.apPaterno.$dirty && personCreateForm.apPaterno.$invalid]">
                      <label for="apPaterno">Ap paterno</label>
                      <input type="text" class="form-control" name="apPaterno" placeholder="ap paterno"
                      ng-model="person.apPaterno" required>
                      <label ng-show="personCreateForm.$submitted || personCreateForm.$dirty || personCreateForm.apPaterno.$touched">
                      <i class="fa fa-times-circle-o"></i>
                        <span ng-show="personCreateForm.apPaterno.$error.required">Tell us your ap Paterno.
                        </span>
                       </label>
                    </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updatePerson()">Editar</button>
                    <a href="/persons" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->