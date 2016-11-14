@extends('layout')
@section('module')
    Variants
@stop
@section('base_url')
    <base href="{{URL::to('/')}}/variants"/>
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
    <section ng-app="variants">
        <div ng-view>

        </div>
    </section>

@section('js-customize')

@stop

@stop