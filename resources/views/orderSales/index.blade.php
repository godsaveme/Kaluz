@extends('layout')
@section('module')
Pedidos Ventas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/orderSales"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="orderSales">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/orderSales/app.js"></script>
    <script src="/js/app/orderSales/controllers.js"></script>
    <script src="/js/app/orderSales/servicesglobalOrderSales.js"></script>
@stop

@stop