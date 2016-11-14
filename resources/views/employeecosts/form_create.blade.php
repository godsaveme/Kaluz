<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Costos Fijos
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/employeecosts">Costos Fijos</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Costos Fijos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="employeecostCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                   
                    
                    <div class="form-group" >
                      <label for="descripcion">Costo Fijo</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Costo Fijo"
                      ng-model="employeecost.CostoFijo">
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Comisiones</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Comisiones"
                      ng-model="employeecost.comisiones" >
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Seguro</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Seguro"
                      ng-model="employeecost.seguro">
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Menu</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Menu"
                      ng-model="employeecost.menu" >
                     </div>
                      <div class="form-group" >
                      <label for="descripcion">Pasajes</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Psajes"
                      ng-model="employeecost.pasajes" >
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Descuento</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Total"
                      ng-model="employeecost.total">
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Total</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Total"
                      ng-model="employeecost.total">
                     </div>
                     <div class="form-group" >
                      <label for="descripcion">Empleado</label>
                      <input type="text" class="form-control" name="descripcion" placeholder="Empleado"
                      ng-model="employeecost.employee_id">
                     </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createEmployeecost()">Crear</button>
                    <a href="/atributes" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->