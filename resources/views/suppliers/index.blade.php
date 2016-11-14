@extends('layout')
@section('module')
Clientes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/suppliers"/>
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
<section ng-app="suppliers">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/suppliers/app.js"></script>
    <script src="/js/app/suppliers/controllers.js"></script>
@stop

@stop