@extends('layout')
@section('module')
    Clientes
@stop
@section('base_url')
    <base href="{{URL::to('/')}}/status"/>
    @stop
    @section('css-customize')
    @stop
    @section('content')
            <!--<section class="content-header">
    <h1>
        CLIENTES
        <small>Panel de Control</small>
    </h1>
</section>-->

    <!-- Main content -->
    <section ng-app="warehouseProductTypeMiddleware">
        <div class="container-fluid" ng-controller="warehouseProductTypeMiddlewareController as vm">
        <div class="row" style="margin-top: 15px;">
        <div class="col-md-6 col-md-offset-3">
            <!-- Box Comment -->
            <form action="/" method="post">
                {!! csrf_field() !!}
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">

                        <span class="description">Seleccione</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read">
                            <i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">

                    <p>
                    <div class="form-group">
                        <label>Selecciona Sucursal</label>
                        <select name="storeId" class="form-control" ng-model="vm.store" ng-options="item as item.nombreTienda for item in vm.stores track by item.id">

                        </select>
                    </div>
                    </p>

                    <p>
                    <div class="form-group">
                        <label>Selecciona Almacén</label>
                        <select name="warehouseId" class="form-control" ng-model="vm.warehouse" ng-options="item as item.nombre for item in vm.warehouses track by item.id">

                        </select>
                    </div>
                    </p>

                    <p>

                    <div class="form-group">
                        <label>Selecciona Tipo de Producto</label>
                            <select name="prodType" class="form-control">
                                <option value="1" selected>Zapatos</option>
                                <option value="2">Accesorios</option>
                            </select>
                    </div>
                    </p>

                </div>
                <!-- /.box-body -->
                <div class="box-footer box-comments" style="">
                    <div class="box-comment">
                        <input type="submit" class="btn btn-block btn-info btn-flat" value="Siguiente"/>
                    </div>

                </div>
                <!-- /.box-footer -->
                <!-- /.box-footer -->
            </div>
            </form>
            <!-- /.box -->
        </div>
        </div>
        </div>
    </section>

@section('js-customize')
    <script src="/js/app/middleware/app.js"></script>
    <script src="/js/app/middleware/controllers.js"></script>
@stop

@stop