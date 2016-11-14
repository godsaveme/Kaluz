@extends('layout')
@section('module')
Compras
@stop
@section('base_url')
<base href="{{URL::to('/')}}/purchases"/>
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
<section ng-app="purchases">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/purchases/app.js"></script>
<script src="/js/app/purchases/controllers.js"></script>
<script src="/js/app/purchases/servicesglobalP.js"></script>
@stop

@stop