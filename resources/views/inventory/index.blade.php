@extends('layout')
@section('module')
Cajas Diarias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/inventory"/>
@stop
@section('css-customize')
@stop

@section('content')

<section ng-app="inventory">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/inventory/app.js"></script>
    <script src="/js/app/inventory/controllers.js"></script>

@stop

@stop