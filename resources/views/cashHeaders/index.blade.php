@extends('layout')
@section('module')
Cajas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/cashHeaders"/>
@stop
@section('css-customize')
@stop

@section('content')

<section ng-app="cashHeaders">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/cashHeaders/app.js"></script>
    <script src="/js/app/cashHeaders/controllers.js"></script>

@stop

@stop