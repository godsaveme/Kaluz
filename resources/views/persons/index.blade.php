@extends('layout')
@section('module')
Personas
@stop
@section('base_url')
<base href="{{URL::to('/')}}/persons"/>
@stop
@section('css-customize')
@stop
@section('content')
<!--<section class="content-header">
    <h1>
        PERSONAS
        <small>Panel de Control</small>
    </h1>
</section>-->

<!-- Main content -->
<section ng-app="persons">
    <div ng-view>

    </div>
</section>

@section('js-customize')
@stop

@stop