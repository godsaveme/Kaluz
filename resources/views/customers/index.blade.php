@extends('layout')
@section('module')
Clientes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/customers"/>
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
<section ng-app="customers">
    <div ng-view>

    </div>
</section>

@section('js-customize')
    <script src="/js/app/customers/app.js"></script>
    <script src="/js/app/customers/controllers.js"></script>
@stop

@stop