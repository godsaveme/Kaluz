@extends('layout')
@section('module')
Cajas Diarias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cashes"/>
@stop
@section('css-customize')
@stop

@section('content')

<section ng-app="cashes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cashes/app.js"></script>
    <script src="/js/app/cashes/controllers.js"></script>

@stop

@stop