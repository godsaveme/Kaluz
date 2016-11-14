@extends('layout')
@section('module')
Practica
@stop
@section('base_url')
<base href="{{URL::to('/')}}/promotions"/>
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
<section ng-app="promotions">
    <div ng-view>

    </div>
</section>

@section('js-customize')
    <script src="/js/app/promotions/app.js"></script>
    <script src="/js/app/promotions/controllers.js"></script>
@stop

@stop