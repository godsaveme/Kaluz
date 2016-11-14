@extends('layout')
@section('module')
Separados
@stop
@section('base_url')
<base href="{{URL::to('/')}}/separateSales"/>
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
<section ng-app="separateSales">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/separateSales/app.js"></script>
    <script src="/js/app/separateSales/controllers.js"></script>
    <script src="/js/app/separateSales/servicesglobalSeparates.js"></script>
@stop

@stop