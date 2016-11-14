@extends('layout')
@section('module')
Usuarios
@stop
@section('base_url')
<base href="{{URL::to('/')}}/users"/>
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
<section ng-app="users">
    <div ng-view>

    </div>
</section>

@section('js-customize')
    <script src="/js/app/users/app.js"></script>
    <script src="/js/app/users/controllers.js"></script>
@stop

@stop