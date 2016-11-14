<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Proveedores
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/suppliers">Proveedores</li>
            <li class="active">Crear</li>
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
                  <li class="active"><a href="#i" data-toggle="tab" class="xlf">Area</a></li>
                  <li><a ng-model="checked" href="#e" data-toggle="tab" class="xlf">Datos</a></li>
                  <li class="pull-left header"><i class="fa fa-inbox" ></i> Editar Suppliers</li>
                </ul>
                
                  <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  
                  <div class=" tab-pane active" id="i" style="position: relative; height: auto;">
                   <!--=======================Contenido del primer tab===========================-->
        <section class="content">
<form name="supplierCreateForm" role="form" novalidate>
<div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
<div class="row">

  <div class="col-md-4">                                         
                    <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.nombres.$error.required && supplierCreateForm.$submitted || supplierCreateForm.nombres.$dirty && supplierCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" class="form-control" name="nombres" placeholder="Nombres" ng-model="supplier.nombres" required>
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.nombres.$dirty && supplierCreateForm.nombres.$invalid">
                        <span ng-show="supplierCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>

                    </div>
          </div>
          <div class="col-md-4"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.apellidos.$error.required && supplierCreateForm.$submitted || supplierCreateForm.apellidos.$dirty && supplierCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="supplier.apellidos" required>
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.apellidos.$dirty && supplierCreateForm.apellidos.$invalid">

                        <span ng-show="supplierCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
            </div>
    <div class="col-md-4">
        <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.empresa.$error.required && supplierCreateForm.$submitted || supplierCreateForm.empresa.$dirty && supplierCreateForm.empresa.$invalid]">
            <label for="apellidos">Nombre de Empresa</label>
            <input type="text" class="form-control" name="empresa" placeholder="nombre de empresa"
                   ng-model="supplier.empresa" required>
            <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.empresa.$dirty && supplierCreateForm.empresa.$invalid">

                <span ng-show="supplierCreateForm.empresa.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
            </label>
        </div>
    </div>
  </div>

  <div class="row">


      <div class="col-md-4"> 
                     <div class="form-group" >
                      <label for="direccionfiscal">Direccion Fiscal</label>
                      <input type="text" class="form-control" name="direccionfiscal" placeholder="Direccion Fiscal"
                      ng-model="supplier.direccionfiscal">
                     </div>
    </div>
    <div class="col-md-4"> 
                     <div class="form-group" >
                      <label for="ruc">Ruc</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Ruc"
                      ng-model="supplier.ruc">
                     </div>
        </div>
      <div class="col-md-2">
          <div class="form-group" >
              <label for="codigo">Código de Proveedor</label>
              <input type="text" class="form-control" name="codigo" placeholder="codigo de proveedor"
                     ng-model="supplier.codigo" ng-disabled="supplier.autogenerado" ng-required="!supplier.autogenerado">
              <span style="color:#dd4b39;" ng-show="supplierCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
          </div>
      </div>
      <div class="col-md-2">
          <div class="form-group">
              <label for="apellidos">Autogenerado</label><br>
              <input type="checkbox" ng-model="supplier.autogenerado"> Cód. gen.
          </div>
      </div>
</div>
<div class="row">

  <div class="col-md-4"> 
                     <div class="form-group" >
                      <label for="numcuenta">Numero Cuenta</label>
                      <input type="text" class="form-control" name="numcuenta" placeholder="Numero Cuenta"
                      ng-model="supplier.numcuenta">
                     </div>
  </div>
  <div class="col-md-4"> 
                     <div class="form-group" ng-class="{true: 'has-error'}[ supplierCreateForm.fechanac.$error.required && supplierCreateForm.$submitted || supplierCreateForm.fechanac.$dirty && supplierCreateForm.fechanac.$invalid]">
                    <label for="fechanac">Fecha de Nacimiento</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechanac" ng-model="supplier.fechanac">
                      <label ng-show="supplierCreateForm.$submitted || supplierCreateForm.fechanac.$dirty && supplierCreateForm.fechanac.$invalid">
                                              <span ng-show="supplierCreateForm.fechanac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div></div>
  </div>
  <div class="col-md-4"> 
   <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" class="form-control" ng-model="supplier.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
</div>
</div>
<div class="row">
         <div class="col-md-4">
                    <div class="form-group" >
                      <label for="ruc">E-mail</label>
                      <input type="email" class="form-control" name="ruc" placeholder="E-mail"
                      ng-model="supplier.email">
                     </div>
        </div>
        <div class="col-md-4">
        <div class="form-group" >
                      <label for="ruc">Direccion de Contacto</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Direccion Contacto"
                      ng-model="supplier.direccontacto">
                     </div>
        </div>
    <div class="col-md-4">
        <div class="form-group" >
            <label for="dni">DNI</label>
            <input type="text" class="form-control" name="dni" placeholder="8 dígitos"
                   ng-model="supplier.dni">
        </div>
    </div>
</div>
<div class="">
                <hr>
                 <button type="button" class="btn btn-default" ng-click="toggle()">Mostrar Formulario de Contacto</button>
          <hr>
    </div>
    <div ng-show="show" >
    <div class="row">
    <div class="col-md-8">
          <div class="row">

                <div class="col-md-6">
                    <div class="form-group" >
                      <label for="ruc">Telefono Fijo</label>
                      <input type="text" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="supplier.fijo">
                     </div>
                </div>     
                <div class="col-md-6">       
                      <div class="form-group" >
                      <label for="movl">Telefono Movil</label>
                      <input type="text" class="form-control" name="movl" placeholder="Telfono Movil"
                      ng-model="supplier.movl">
                     </div>
                 </div>
            </div>
            <div class="row">
                   <div class="col-md-6">
                     <div class="form-group" >
                      <label for="ruc">website</label>
                      <input type="text" class="form-control" name="ruc" placeholder="Website"
                      ng-model="supplier.website">
                     </div>
                  </div>

                  <div class="col-md-6">       
                     
                    <div class="form-group" >
                      <label for="fijo">Twitter </label>
                      <input type="text" class="form-control" name="fijo" placeholder="###"
                      ng-model="supplier.twitter">
                     </div>
                  </div>
            </div>
      </div>
      <div class="col-md-4">
                   <div class="form-group" >
                      <label for="notas">Notas</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="supplier.notas" rows="5" cols="50"></textarea>
                     </div>
      </div>
  </div>
 

   </div>
   <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateSupplier()">Modificar</button>
                    <a href="/suppliers" class="btn btn-danger">Cancelar</a>
                     <!--<input type="button" class="btn btn-danger" value="Cancel"onclick="location='/suppliers'"/>-->
                  </div>
   </form>
   </section>
                  </div>
                  
<!--=======================fin del primer tab===========================-->
                
                  <div class=" tab-pane" id="e" style="position: relative; height: auto;">
        <!--====================Contenido de la segundo Tab=========================-->      
 <section class="content">              
              <div class="row">

  <div class="col-md-4">
                    <div class="form-group" >
                      <label for="movil">Distrito</label>
                      <input type="text" class="form-control" name="movil" placeholder="###"
                      ng-model="supplier.distrito">
                     </div>
          </div>
          <div class="col-md-4">
                    <div class="form-group" >
                      <label for="email">Provincia</label>
                      <input type="text" class="form-control" name="email" placeholder="Chiclayo"
                      ng-model="supplier.provincia">
                     </div>
          </div>
          <div class="col-md-4">
                    <div class="form-group" >
                      <label for="website">Departamento</label>
                      <input type="text" class="form-control" name="website" placeholder="Lambayeque"
                      ng-model="supplier.departamento">
                     </div>
          </div>
  </div>
  <div class="row">

  <div class="col-md-4">
                    <div class="form-group" >
                      <label for="direccContac">Pais</label>
                      <input type="text" class="form-control" name="direccContac" placeholder="Peru"
                      ng-model="supplier.pais">
                     </div>
        </div>
  </div>
  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateSupplier()">Modificar</button>
                    <a href="/suppliers" class="btn btn-danger">Cancelar</a>
                    <!--<input type="button" class="btn btn-danger" value="Cancel"onclick="location='/suppliers'"/>-->
                  </div>
  </section>
                  
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
