@extends('layout1')

@section('base_url')
<base href="{{URL::to('/')}}/cashes"/>
@stop
@section('css-customize')
@stop

@section('content')

<section ng-app="consultas">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/consultas/app.js"></script>
    <script src="/js/app/consultas/controllers.js"></script>
    <script src="/vendor/angular-ui-grid/js/angular.js"></script>
    <script src="/vendor/angular-ui-grid/js/angular-touch.js"></script>
    <script src="/vendor/angular-ui-grid/js/angular-animate.js"></script>
    <script src="/vendor/angular-ui-grid/js/csv.js"></script>
    <script src="/vendor/angular-ui-grid/js/pdfmake.js"></script>
    <script src="/vendor/angular-ui-grid/js/vfs_fonts.js"></script>
    <script src="/vendor/angular-ui-grid/ui-grid.js"></script>

@stop

@stop