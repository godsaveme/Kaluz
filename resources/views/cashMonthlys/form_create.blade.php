
        <section class="content-header">
          <h1>
            Gastos Mensuales
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/cashMonthlys">Gastos Mensuales</a></li>
            <li class="active">Crear</li>
          </ol>
        </section>
          


        <section class="content">
          <div class="row">
            <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Gastos Mensuales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="cashMonthlyCreateForm" role="form" novalidate>
                  <div class="box-body">
                    <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                    </div>
                      <!-- Combo Concepto tabla expenseMonthlys-->
                      <div class="row">
                      <div class="col-md-6">
                        <div class="row">
                        <div class="col-md-8">
                        <div class="form-group" >
                         <label for="expense">Concepto</label>

                          <select class="form-control" name="" ng-model="cashMonthly.expenseMonthlys_id" ng-options="item.id as item.name for item in expenses | orderBy: 'name'">
                            <option value="">--Elije Concepto--</option>
                          </select>
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group" >
                          <br>
                          <button style="margin-top: 7px;"type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#miventana1">
                          <span class="glyphicon glyphicon-plus"></span>
                          </button>
                          </div>
                          </div>

                        </div>
                      </div>
                      </div>
                
                      <!-- Combo Año tabla years-->
                      <div class="row">
                      <div class="col-md-6">
                      <div class="row">
                      <div class="col-md-8">

                        <!--<div class="form-group" >
                          <label for="year">Año</label>

                          <select class="form-control" name="" ng-model="cashMonthly.years_id" ng-options="item.id as item.year for item in years | orderBy: 'year'">
                          <option value="">--Elije Año--</option>
                          </select>
                          </div>
                          </div>
                          <div class="col-md-4">
                          <div class="form-group" >
                          <br>
                          <button style="margin-top: 7px;"type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#miventana2">
                            <span class="glyphicon glyphicon-plus"></span>
                          </button>
                          </div>
                          </div>
                        </div>
                        
                      </div>
                      </div> -->

                      <!-- Combo Mes tabla mounts-->
                      <!-- <div class="row">
                      <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Mes</label>

                          <select class="form-control" name="" ng-model="cashMonthly.months_id" ng-options="item.id as item.month for item in months">
                          <option value="">--Elije Mes--</option>
                          </select>
                        </div>
                      </div>
                      </div> -->

                      <div class="form-group" ng-class="{true: 'has-error'}[ cashMonthlyCreateForm.fechaPedido.$error.required &amp;&amp; cashMonthlyCreateForm.$submitted || cashMonthlyCreateForm.fechaPedido.$dirty &amp;&amp; cashMonthlyCreateForm.fechaPedido.$invalid]">
                                <label for="fechaPedido">Fecha Entrega: </label>
                            <div ng-hide="show" class="input-group">
                                <div class="input-group-addon">
                                      <i class="fa fa-calendar"></i>
                                </div>
                                  <input type="datetime-local" class="form-control ng-pristine ng-valid ng-touched" name="fechaPedido">
                                </div>
                            <label ng-show="cashMonthlyCreateForm.$submitted || cashMonthlyCreateForm.fechaPedido.$dirty &amp;&amp; cashMonthlyCreateForm.fechaPedido.$invalid" class="ng-hide">
                            <span ng-show="cashMonthlyCreateForm.fechaPedido.$invalid" class="ng-hide"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                            </label>
                             
                             <div ng-show="show" class="input-group ng-hide">
                               <spam class="ng-binding"></spam>
                            </div> 
                      </div>  

                      <!-- capo de Texto  Monto-->
                        <div class="form-group" ng-class="{true: 'has-error'}[ cashMonthlyCreateForm.amount.$error.required && cashMonthlyCreateForm.$submitted || cashMonthlyCreateForm.amount.$dirty && cashMonthlyCreateForm.amount.$invalid]">
                          <label for="amount">Monto</label>
                          <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="amount" placeholder="0.00" ng-model="cashMonthly.amount" ng-blur="calculateSuppPric()" step="0.1">
                          <label ng-show="cashMonthlyCreateForm.$submitted || cashMonthlyCreateForm.amount.$dirty && cashMonthlyCreateForm.amount.$invalid">
                            <span ng-show="cashMonthlyCreateForm.amount.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                         </div>

                      <!-- capo de Texto  Descripcion-->
                      <div class="form-group" >
                        <label for="descripcion">Descripción</label>
                          <textarea type="descripcion" class="form-control" name="descripcion" placeholder="..."
                            ng-model="cashMonthly.descripcion" rows="4" cols="50"></textarea>
                      </div>
                  </div>
                </form>

          </div><!-- /.box-body -->

                <!-- pie de pagina botnones Crear y Cancelar-->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" ng-click="createcashMonthly()">Crear</button>
            <a href="/cashMonthlys" class="btn btn-danger">Cancelar</a>

            <!-- <a href="/cashMonthlys" class="btn btn-danger">Cancelar</a>-->
          </div>
                
            </div><!-- /.box -->

          </div>
    </section>

 <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Opciones Año</h4>
                        </div>
                        <!--=================cueropo========================-->
                        <div class="nav-tabs-custom" id="myTabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_11" data-toggle="#tab">Agregar Año</a></li>
                  <li><a href="#tab_21" data-toggle="tab">Editar o Eliminar</a></li>

                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_11">
                      <form name="yearCreateForm" role="form" novalidate>
                        <div class="row">
                          <div class="col-md-8">

                          <div class="form-group" ng-class="{true: 'has-error'}[ yearCreateForm.year.$error.required && yearCreateForm.$submitted || yearCreateForm.year.$dirty && yearCreateForm.year.$invalid]">
                          <label for="year">Año</label>
                          <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="year" placeholder="2015" ng-model="year.year" ng-blur="calculateSuppPric()" step="1">
                          <label ng-show="yearCreateForm.$submitted || yearCreateForm.year.$dirty && yearCreateForm.year.$invalid">
                            <span ng-show="yearCreateForm.year.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                         </div>

                          </div>
                        </div>
                      

                      <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="createYear()" data-dismiss="modal">Agregar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                      </form>
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_21">
                    <div class="form-group" >
                          
                          <div class="row" ng-hide="mostrardata1">
                          <div class="col-md-8">

                          <div class="form-group" >
                          <label for="year">Año</label>

                          <select class="form-control" name="" ng-model="cashMonthly.years_id" ng-options="item.id as item.year for item in years | orderBy: 'year'">
                            <option value="">--Elije Año--</option>
                          </select>
                          </div>
                          </div>
                          </div>
                          </div>
                          <!---->
                        <div class="row" ng-show="mostrardata1">
                          <div class="col-md-8">
                          

                            <div class="form-group" ng-class="{true: 'has-error'}[ yearCreateForm.year.$error.required && yearCreateForm.$submitted || yearCreateForm.year.$dirty && yearCreateForm.year.$invalid]">
                          <label for="year">Año</label>
                          <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="year" placeholder="2015" ng-model="year.year" ng-blur="calculateSuppPric()" step="1">
                          <label ng-show="yearCreateForm.$submitted || yearCreateForm.year.$dirty && yearCreateForm.year.$invalid">
                            <span ng-show="yearCreateForm.year.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                          </label>
                         </div>

                          </div>

                        </div>


                        <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-show="mostrardata1" ng-click="ocultar()">Cancelar</button>
                          <button type="submit" class="btn btn-primary" ng-click="updatecashYear()" ng-show="mostrardata1">Guardar</button>
                          <button type="submit" class="btn btn-primary" ng-hide="mostrardata1" ng-click="deleteYear()">Eliminar</button>
                          <button type="submit" class="btn btn-primary" ng-hide="mostrardata1" ng-click="ver()">Modificar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>

                      </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
              <script type="text/javascript">$('#myTabs a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')})
              </script>
              
                        <!--================================================-->
                  </div>
              </div>
            </div>
          </div>

<!-- =========================================Ventana Agregar Concepto=================================-->
   
           <div class="container"  style="margin-top: 60px;">
              <div  class="modal fade" id="miventana1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Opciones Concepto</h4>
                        </div>
                        <!--=================cueropo========================-->
                        <div class="nav-tabs-custom" id="myTabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="#tab">Agregar</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Editar o Eliminar</a></li>

                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                      <form name="expenseMonthlyCreateForm" role="form" validate>
                        <div class="row">
                          <div class="col-md-8">

                            <div class="form-group" ng-class="{true: 'has-error'}[ expenseMonthlyCreateForm.name.$error.required && expenseMonthlyCreateForm.$submitted || expenseMonthlyCreateForm.name.$dirty && expenseMonthlyCreateForm.name.$invalid]">
                              <label for="name">Concepto</label>
                              <input type="text" class="form-control" name="name" placeholder="Concepto" ng-model="expenseMonthly.name" required>
                              <label ng-show="expenseMonthlyCreateForm.$submitted || expenseMonthlyCreateForm.name.$dirty && expenseMonthlyCreateForm.name.$invalid">
                                <span ng-show="expenseMonthlyCreateForm.name.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                              </label>
                            </div>

                          </div>
                        </div>
                      

                      <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="createExpense()" >Agregar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                      </form>
                  </div><!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                    <div class="form-group" >
                          
                          <div class="row" ng-hide="mostrardata">
                          <div class="col-md-8">

                          <div class="form-group" >
                          <label for="expense">Concepto</label>

                          <select class="form-control" name="" ng-model="cashMonthly.expenseMonthlys_id" ng-options="item.id as item.name for item in expenses | orderBy: 'name'">
                            <option value="">--Elije Concepto--</option>
                          </select>
                          </div>
                          </div>
                          </div>
                          </div>
                          <!---->

                        <div ng-show="mostrardata" class="row">
                          <div class="col-md-8">

                            <div class="form-group" ng-class="{true: 'has-error'}[ expenseMonthlyCreateForm.name.$error.required && expenseMonthlyCreateForm.$submitted || expenseMonthlyCreateForm.name.$dirty && expenseMonthlyCreateForm.name.$invalid]">
                              <label for="name">Concepto</label>
                              <input type="text" class="form-control" name="name" placeholder="Concepto" ng-model="expense.name" required>
                              <label ng-show="expenseMonthlyCreateForm.$submitted || expenseMonthlyCreateForm.name.$dirty && expenseMonthlyCreateForm.name.$invalid">
                                <span ng-show="expenseMonthlyCreateForm.name.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                              </label>
                            </div>

                          </div>
                        </div>



                          <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-show="mostrardata" ng-click="ocultardata()">Cancelaar</button>
                          <button type="submit" class="btn btn-primary" ng-click="updatecashExpense()" ng-show="mostrardata">Guardar</button>
                          <button type="submit" class="btn btn-primary" ng-hide="mostrardata" ng-click="deleteExpense()">Eliminar</button>
                          <button type="submit" class="btn btn-primary" ng-hide="mostrardata" ng-click="verdata()">Modificar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
              <script type="text/javascript">$('#myTabs a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')})
              </script>
              
                        <!--================================================-->
                  </div>
              </div>
            </div>
          </div>
          
          <!--===================================================-->


