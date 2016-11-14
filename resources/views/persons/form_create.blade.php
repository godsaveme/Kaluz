<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Personas
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="">Personas</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="personCreateForm" role="form" novalidate>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="nombres" ng-model="person.nombres" required>
                      <div ng-show="personCreateForm.$submitted || personCreateForm.nombres.$touched">
                        <div ng-show="personCreateForm.nombres.$error.required">Tell us your name.</div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="apPaterno">Ap paterno</label>
                      <input type="text" class="form-control" name="apPaterno" placeholder="ap paterno"
                      ng-model="person.apPaterno" required>
                      <div ng-show="personCreateForm.$submitted || personCreateForm.apPaterno.$touched">
                        <span ng-show="personCreateForm.apPaterno.$error.required">Tell us your ap Paterno.</span>
                       </div>
                    </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createPerson()">Crear</button>
                    <a href="/persons" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->