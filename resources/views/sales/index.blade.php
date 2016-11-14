@extends('layout')
@section('module')
Ventas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/sales"/>
@stop
@section('css-customize')
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print">
@stop
@section('content')
<!--<section class="content-header">
    <h1>
        CLIENTES
        <small>Panel de Control</small>
    </h1>
</section>-->

<!-- Main content -->
<section ng-app="sales">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/sales/app.js"></script>
    <script src="/js/app/sales/controllers.js"></script>
    <script src="/js/app/sales/servicesglobalOrders.js"></script>
@stop

@stop