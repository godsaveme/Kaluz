@extends('layout')
@section('module')
Clientes
@stop
@section('base_url')
<base href="{{URL::to('/')}}/detCashes"/>
@stop
@section('css-customize')
@stop
@section('content')

<section ng-app="detCashes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
    <script src="/js/app/detCashes/app.js"></script>
    <script src="/js/app/detCashes/controllers.js"></script>
@stop

@stop