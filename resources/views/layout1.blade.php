<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Salesfly | @section('module')Dashboard @show</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="/vendor/adminlte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="/vendor/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/vendor/adminlte/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="/vendor/adminlte/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE fonts OpenSans-->
    <link href="/css/fonts.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="/vendor/ngprogress/ngProgress.css">

    <link href="/vendor/jquery-ui/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />

    <link  href="/vendor/angular-ui-grid/ui-grid.css"  rel="stylesheet" type="text/css">
    

     <!-- <link href="/vendor/angular-bootstrap/ui-bootstrap-csp.css" rel="stylesheet" type="text/css" /> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @section('base_url')
    @show
    



  </head>
  <body class="">
    <div class="wrapper">

      
      <!-- Left side column. contains the logo and sidebar -->
      


                    <!-- Content Wrapper. Contains page content -->
      <div class="">
            @yield('content')       




        </div>
  <!-- END Content Wrapper. Contains page content -->


     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="/vendor/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/vendor/jquery-ui/ui/minified/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/vendor/adminlte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Slimscroll -->
    <script src="/vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="/vendor/adminlte/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="/vendor/adminlte/dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="/vendor/adminlte/dist/js/demo.js" type="text/javascript"></script>

    <script src="/dev2/socket.io/socket.io.js"></script>
  <!-- bower:js -->
  <script src="/vendor/angular/angular.js"></script>
  <script src="/vendor/moment/moment.js"></script>
  <script src="/vendor/angular-route/angular-route.js"></script>
  <script src="/vendor/angular-sanitize/angular-sanitize.js"></script>
  <script src="/vendor/angular-ui-router/release/angular-ui-router.js"></script>
  <script src="/vendor/angular-socket-io/socket.js"></script>
    <script src="/vendor/ng-phpdebugbar/ng-phpdebugbar.js"></script>
    <script src="/vendor/angucomplete/angucomplete.js"></script>
    <script src="/vendor/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script src="/vendor/ngprogress/build/ngprogress.min.js"></script>
  <!-- endbower -->
  <!-- inject:js -->
    <script src="/js/app/routes.js"></script>
    <script src="/js/app/servicesglobal.js"></script>
    <script src="/js/app/persons/app.js"></script>
    <script src="/js/app/persons/controllers.js"></script>

    <script src="/js/app/stores/app.js"></script>
    <script src="/js/app/stores/controllers.js"></script>
    <script src="/js/app/brands/app.js"></script>
    <script src="/js/app/brands/controllers.js"></script>
    <script src="/js/app/atributes/app.js"></script>
    <script src="/js/app/atributes/controllers.js"></script>
    <script src="/js/app/types/app.js"></script>
    <script src="/js/app/types/controllers.js"></script>
    <script src="/vendor/angular-ui-slider/src/slider.js"></script>


    <!-- endinject -->
    @section('js-customize')
    @show
<script>

$(document).ready(function(){
    $("body").on("click", '#myTabs2',function(e){
        //alert("The paragraph was clicked.");
        e.preventDefault()
                          $(this).tab('show')
    });
});
</script>

  </body>
</html>
