@extends('layout')
@section('module')
Compras
@stop
@section('base_url')
<base href="{{URL::to('/')}}/orderPurchases"/>
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
<section ng-app="orderPurchases">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/orderPurchases/app.js"></script>
<script src="/js/app/orderPurchases/controllers.js"></script>
<script src="/js/app/orderPurchases/servicesglobalpurchase.js"></script>
@stop

@stop