@extends('layout')
@section('module')
Gasos Mensuales
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cashMonthlys"/>
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
<section ng-app="cashMonthlys">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cashMonthlys/app.js"></script>
    <script src="/js/app/cashMonthlys/controllers.js"></script>
@stop

@stop
