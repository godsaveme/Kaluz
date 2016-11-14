<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Clientes
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/customers">Clientes</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

            <div class="box box-success" >
                <!-- Tabs within a box -->
                <div class="nav-tabs-custom" align="" id="my_tab">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#i" data-toggle="tab" class="xlf">General</a></li>
                        <li><a ng-model="checked" href="#e" data-toggle="tab" class="xlf">Ubicación</a></li>
                        <li class="pull-left header"><i class="fa fa-users"></i> Crear Cliente</li>
                    </ul>

                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->

                        <div class=" tab-pane active" id="i" style="position: relative; height: auto;">
                            <!--=======================Contenido del primer tab===========================-->
                <!-- form start -->
                            <section class="content">
                <form name="customerCreateForm" role="form" novalidate>

                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
<div>
                      <div class="row">

                          <div class="col-md-4">

                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.nombres.$error.required && customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="customer.nombres" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid">
                        <span ng-show="customerCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                              </div>
                          <div class="col-md-4">

                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.apellidos.$error.required && customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="customer.apellidos" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid">

                        <span ng-show="customerCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                          </div>
                          <div class="col-md-4">
                    <div class="form-group" >
                      <label for="apellidos">Empresa / Razón Social</label>
                      <input type="text" class="form-control" name="empresa" placeholder="empresa"
                      ng-model="customer.empresa">
                     </div>
                              </div></div>
                          <div class="row">

                              <div class="col-md-4">
                    <div class="form-group" >
                      <label for="direccFiscal">Dirección Fiscal</label>
                      <input type="text" class="form-control" name="direccFiscal" placeholder="dirección fiscal"
                      ng-model="customer.direccFiscal">
                     </div>
                              </div>
                              <div class="col-md-4">
                    <div class="form-group" >
                      <label for="ruc">RUC</label>
                      <input type="text" class="form-control" name="ruc" ng-change="ValidarCamposRuc()" placeholder="ruc"
                      ng-model="customer.ruc">
                     </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group" >
                                      <label for="codigo">Código de Cliente</label>
                                      <input type="text" class="form-control" name="codigo" placeholder="codigo de cliente"
                                             ng-model="customer.codigo" ng-disabled="customer.autogenerado" ng-required="!customer.autogenerado">
                                      <span style="color:#dd4b39;" ng-show="customerCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                  </div>
                              </div>
                              <div class="col-md-2">
                                  <div class="form-group">
                                      <label for="apellidos">Autogenerado</label><br>
                                      <input type="checkbox" ng-model="customer.autogenerado"> Cód. gen.
                                  </div>
                              </div>
                          </div>
                      <div class="row">

                          <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.fechaNac.$error.required && customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid]">
                    <label for="fechaNac">Fecha de Nac.</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechaNac" ng-model="customer.fechaNac">
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid">
                                              <span ng-show="customerCreateForm.fechaNac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                     </div>
                          </div>
                          <div class="col-md-4">
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="customer.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                          </div>
                          <div class="col-md-4">
                    <div class="form-group" >
                      <label for="fijo">Teléfono fijo</label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="customer.fijo">
                     </div>
                              </div></div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group" >
                <label for="dni">DNI</label>
                <input type="text" class="form-control" name="dni" ng-change="ValidarCamposDni()" placeholder="8 dígitos"
                       ng-model="customer.dni" required>
                       
            </div>
        </div>
    </div>
    </div>

                      <div class="">
                          <hr>
                          <button type="button" class="btn btn-default" ng-click="toggle()">Mostrar Formulario de Contacto</button>
                          <hr>
                      </div>
                      <div ng-show="show" >
                          <div class="row ">
                              <div class="col-md-8">
                                  <div class="row ">
                                      <div class="col-md-6">
                    <div class="form-group" >
                      <label for="movil">Teléfono movil</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="customer.movil">
                     </div>
                                      </div>
                                      <div class="col-md-6">
                    <div class="form-group" >
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="###"
                      ng-model="customer.email">
                     </div>

                                      </div>

                                  </div>
                                  <div class="row ">
                                      <div class="col-md-6">


                    <div class="form-group" >
                      <label for="website">Página Web</label>
                      <input type="text" class="form-control" name="website" placeholder="###"
                      ng-model="customer.website">
                     </div>

                                      </div>
                                      <div class="col-md-6">

                    <div class="form-group" >
                      <label for="direccContac">Dirección de Contacto</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="###"
                      ng-model="customer.direccContac">
                     </div>

                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group" >
                                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                                ng-model="customer.notas" rows="5" cols="50"></textarea>
                                  </div>

                              </div>





                </div><!-- /.box-body -->
                  </div>


                  <div class="box-footer">
                    <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="createCustomer()">Crear</button>
                      <!--<input type="button" class="btn btn-danger" value="Cancel" onclick="location='/customers'">-->
                      <a href="/customers" class="btn btn-danger">Cancelar</a>
                  </div>

                </form>


                            </section>




                            <!--=======================fin del primer tab===========================-->
                        </div>
                        <div class=" tab-pane" id="e" style="position: relative; height: auto;">
                            <!--====================Contenido de la segundo Tab=========================-->
                            <section class="content">
                                <div class="row ">
                                    <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="distrito">Distrito</label>
                                    <input type="text" class="form-control" name="distrito" placeholder="Chiclayo"
                                           ng-model="customer.distrito">
                                </div>
                                    </div>
                                    <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="provincia">Provincia</label>
                                    <input type="text" class="form-control" name="provincia" placeholder="Chiclayo"
                                           ng-model="customer.provincia">
                                </div>
                                    </div>
                                    <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="departamento">Departamento</label>
                                    <input type="text" class="form-control" name="departamento" placeholder="Lambayeque"
                                           ng-model="customer.departamento">
                                </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-4">
                                <div class="form-group" >
                                    <label for="pais">País</label>
                                    <input type="text" class="form-control" name="pais" placeholder="Perú"
                                           ng-model="customer.pais">
                                </div>
                                    </div>


                                </div>

                                <hr>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" ng-click="createCustomer()">Crear</button>
                                    <!--<input type="button" class="btn btn-danger" value="Cancel" onclick="location='/customers'">-->
                                    <a href="/customers" class="btn btn-danger">Cancelar</a>
                                </div>
                            </section>

                            <!--=======================fin del segundo tab===========================-->
                        </div>


                    </div>
                </div><!-- /.nav-tabs-custom -->

                <script type="text/javascript">
                    $('#my_tab .xlf').click(function (e) {
                        e.preventDefault();
                        $(this).tab('show');
                    });
                </script>


              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->