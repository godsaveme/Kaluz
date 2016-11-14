<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Empleados
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/employees">Empleados</li>
            <li class="active" >Crear</li>
          </ol>

          
        </section>

 <section class="content">
  <!-- <section class="content">-->
  <div class="row ">
          <div class="col-md-12">
   <div class="box box-success" >
   <!-- Tabs within a box -->
   <div class="nav-tabs-custom" align="" id="my_tab">
                <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#i" data-toggle="tab" class="xlf">General</a></li>
                  <li><a ng-model="checked" href="#e" data-toggle="tab" class="xlf">Ubicación</a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i> Crear Empleados</li>
                </ul>
                
                  <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  
                  <div class=" tab-pane active" id="i" style="position: relative; height: auto;">
                  <!--=======================Contenido del primer tab===========================-->

<section class="content">
<form name="employeeCreateForm" role="form" novalidate>
<div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
<div class="">
<div class="row">

  <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.nombres.$error.required && employeeCreateForm.$submitted || employeeCreateForm.nombres.$dirty && employeeCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="employee.nombres" required>
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.nombres.$dirty && employeeCreateForm.nombres.$invalid">
                        <span ng-show="employeeCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
  </div>
  <div class="col-md-4">
                    <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.apellidos.$error.required && employeeCreateForm.$submitted || employeeCreateForm.apellidos.$dirty && employeeCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="employee.apellidos" required>
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.apellidos.$dirty && employeeCreateForm.apellidos.$invalid">

                        <span ng-show="employeeCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
  </div>
  <div class="col-md-4">
   <div class="form-group" ng-class="{true: 'has-error'}[ employeeCreateForm.fechanac.$error.required && employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha de Nacimiento</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechanac" ng-model="employee.fechanac">
                      <label ng-show="employeeCreateForm.$submitted || employeeCreateForm.fechanac.$dirty && employeeCreateForm.fechanac.$invalid">
                              <span ng-show="employeeCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                      </label>
                      </div></div>   
  </div>
  </div>
  <div class="row">
  <div class="col-md-4">

                     <div class="form-group" >
                      <label for="ruc">E-mail</label>
                      <input type="email" class="form-control" name="ruc" placeholder="E-mail"
                      ng-model="employee.email">
                     </div>
    </div>
    <div class="col-md-4">
    <div class="form-group" >
                      <label for="ruc">Direccion de Contacto</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Direccion Contacto"
                      ng-model="employee.direccioncontacto">
                     </div>
    </div>
    <div class="col-md-2">
    <div class="form-group" >
                      <label for="codigo">Codigo</label>
                      <input type="text" class="form-control" name="codigo" placeholder="Codigo"
                      ng-model="employee.codigo" ng-disabled="employee.autogenerado" ng-required="!employee.autogenerado">
        <span style="color:#dd4b39;" ng-show="employeeCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
    </div>
    </div>
      <div class="col-md-2">
          <div class="form-group">
              <label for="apellidos">Autogenerado</label><br>
              <input type="checkbox" ng-model="employee.autogenerado"> Cód. gen.
          </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="employee.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
         </div>
         <div class="col-md-4">
          <div class="form-group">
                                            <label>Estado</label>
                                            <select name="estado" class="form-control"  ng-model="employee.estado" >
                                             <option value="1" selected>Activo</option>
                                             <option value="0">Inactivo</option>
                                             </select>
                      </div>
                      </div>
                      <div class="col-md-4">     
                    <div class="form-group" >
                      <label for="apellidos">Dni</label>
                      <input type="text" class="form-control" name="empresa" placeholder="Dni"
                      ng-model="employee.dni">
                     </div>
            </div>
                     
  
  </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group" >
                <label for="cargo">Cargo</label>
                <input type="text" class="form-control" name="cargo" placeholder="cargo" ng-model="employee.cargo" >

            </div>
        </div>
    </div>
  <div class="row">
  <div class="col-md-4">
    <div class="form-group">
                       <label>Imagen</label>
                       <input type="file" ng-model="employee.imagen" id="employeeImage" name="imagen"/>
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
                      <label for="ruc">Telefono Fijo</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Telefono Fijo"
                      ng-model="employee.fijo">
                     </div>
              </div>
               <div class="col-md-6">
                     <div class="form-group" >
                      <label for="movil">Telefono Movil</label>
                      <input type="text" class="form-control" name="movil" placeholder="Telfono Movil"
                      ng-model="employee.movil">
                     </div>
              </div>
              
           </div> 
           <div class="row ">
           <div class="col-md-6">
                 <div class="form-group" >
                      <label for="ruc">website</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Website"
                      ng-model="employee.website">
                     </div>
              </div>
               <div class="col-md-6">
                     <div class="form-group" >
                      <label for="fijo">Twitter </label>
                      <input type="text" class="form-control" name="fijo" placeholder="@User"
                      ng-model="employee.twitter">
                     </div>
              </div>
           </div>   
          </div>
          <div class="col-md-4">
        <div class="form-group" >
                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="employee.notas" rows="5" cols="50"></textarea>
                     </div>
          </div>
        </div>
        
      
      
              
    </div>
     <div class="box-footer">
                    <button id="btn_generate" data-loading-text="Enviando.."  type="submit" class="btn btn-primary" aling="left" ng-click="createEmployee()">Crear</button>
                    <a href="/employees" class="btn btn-danger">Cancelar</a>
                    <!--<input type="button" class="btn btn-danger" value="Cancel"onclick="location='/employees'"/>-->
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
                      <label for="movil">Distrito</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="employee.distrito">
                     </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group" >
                      <label for="email">Provincia</label>
                      <input type="text" class="form-control" name="email" placeholder="Chiclayo"
                      ng-model="employee.provincia">
                     </div>
              </div>
              <div class="col-md-4">
                    <div class="form-group" >
                      <label for="website">Departamento</label>
                      <input type="text" class="form-control" name="website" placeholder="Lambayeque"
                      ng-model="employee.departamento">
                     </div>
              </div>
  </div>
  <div class="row ">
              <div class="col-md-4">
                  <div class="form-group" >
                      <label for="direccContac">Pais</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="Peru"
                      ng-model="employee.pais">
                     </div>
                   </div>
               
               
  </div>
  <hr>
  
  <div class="box-footer" aling="right">
                    <button type="submit" class="btn btn-primary" ng-click="createEmployee()">Crear</button>
                    <a href="/employees" class="btn btn-danger">Cancelar</a>
                    <!-- <input type="button" class="btn btn-danger" value="Cancel"onclick="location='/employees'"/>-->
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
                 
</div>
</div>
</div>
</section>
     