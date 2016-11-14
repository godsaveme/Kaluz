<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            promotions
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/promotions">promotions</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear promotions</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="promotionCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    <div class="row">
                    <div class="col-md-8"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.nombre.$error.required && promotionCreateForm.$submitted || promotionCreateForm.nombre.$dirty && promotionCreateForm.nombre.$invalid]">
                      <label for="nombre">nombre</label>
                      <input type="text" class="form-control" name="nombre" placeholder="nombre" ng-model="promotion.nombre" required>
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.nombre.$dirty && promotionCreateForm.nombre.$invalid">
                        <span ng-show="promotionCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="row">
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.cantidadOfre.$error.required && promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid]">
                      <label for="cantidadOfre">Cantidad Ofrecida</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidadOfre" id="cantidadOfre" placeholder="0.00" ng-model="cantidadOfre" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.cantidadOfre.$dirty && promotionCreateForm.cantidadOfre.$invalid">
                        <span ng-show="promotionCreateForm.cantidadOfre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.cantidadCobro.$error.required && promotionCreateForm.$submitted || promotionCreateForm.cantidadCobro.$dirty && promotionCreateForm.cantidadCobro.$invalid]">
                      <label for="cantidadCobro">Cantidad Cobro</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="cantidadCobro" id="cantidadCobro" placeholder="0.00" ng-model="cantidadCobro" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.cantidadCobro.$dirty && promotionCreateForm.cantidadCobro.$invalid">
                        <span ng-show="promotionCreateForm.cantidadCobro.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="col-md-2"> 
                      <div class="form-group" ng-class="{true: 'has-error'}[ promotionCreateForm.descuento.$error.required && promotionCreateForm.$submitted || promotionCreateForm.descuento.$dirty && promotionCreateForm.descuento.$invalid]">
                      <label for="descuento">Descuento %</label>
                      <input type="number" class="form-control ng-pristine ng-valid ng-touched" name="descuento" id="descuento" placeholder="0.00" ng-model="descuento" ng-blur="calculateDescuento()" step="0.1">
                      <label ng-show="promotionCreateForm.$submitted || promotionCreateForm.descuento.$dirty && promotionCreateForm.descuento.$invalid">
                        <span ng-show="promotionCreateForm.descuento.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                      </div>
                    </div>
                    </div>
                    <!-- capo de Texto  Cantidad-->
                    <div class="row">
                    <div class="col-md-8"> 
                    <div class="form-group" >
                      <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" name="notas" placeholder="..."
                      ng-model="promotion.descripcion" rows="4" cols="50"></textarea>
                     </div>
                     </div>
                     </div>
                    
                     
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="createPromotion()">Crear</button>
                    <a href="/promotions" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->