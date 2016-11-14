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

     <!-- <link href="/vendor/angular-bootstrap/ui-bootstrap-csp.css" rel="stylesheet" type="text/css" /> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @section('base_url')
    @show
    @section('css-customize')
    @show



  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SL</b>F</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sales</b>Fly</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">



              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{Auth()->user()->image}}" class="user-image" alt="User Image" />
                  <span class="hidden-xs"> @if(!empty(Auth()->user())){{Auth()->user()->name}} @else Not user @endif</span>
                  <!--
                  @if(!empty(Auth::user()))
                  {{Auth::user()->name}}
                  @else
                  {{'No estas logueado'}}
                  @endif
                  </span>
                  -->
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{Auth()->user()->image}}" class="img-circle" alt="User Image" />
                    <p>
                    @if(!empty(Auth()->user()))
                      {{Auth()->user()->name}}
                      <small>Miembro desde {{Auth()->user()->created_at}}</small>
                    <p class="text-muted text-center">{{Auth()->user()->email}}</p>
                      @else
                        Not user
                        <small>Miembro desde --</small>
                      @endif
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/users/edit/{{Auth()->user()->id}}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="/auth/logout" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{Auth()->user()->image}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>@if(!empty(Auth()->user())){{Auth()->user()->name}} @else Not user @endif</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <?php $role = Auth()->user()->role_id; ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Navegación</li>
            @if($role == 1)
            <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
            @endif
            @if($role == 1)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-wrench"></i>
                <span>Configuración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="/users" ><i class="fa fa-circle-o"></i>Usuarios</a></li>
                <li class=""><a href="/employees" ><i class="fa fa-circle-o"></i>Empleados</a></li>
                  <li><a href="/stores"><i class="fa fa-circle-o"></i>Tienda </a></li>
                <li><a href="/warehouses"><i class="fa fa-circle-o"></i>Almacenes </a></li>
              </ul>
            </li>
            @endif
            @if($role == 1 || $role == 3)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-barcode"></i>
                <span>Productos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if($role == 1 || $role == 3)
                <li class=""><a href="/products" ><i class="fa fa-circle-o"></i>Productos</a></li>
                @endif
                  @if($role == 1)
                <li class=""><a href="/purchases" ><i class="fa fa-circle-o"></i>Control de Stock</a></li>
                <li class=""><a href="/brands" ><i class="fa fa-circle-o"></i>Marcas</a></li>
                <li><a href="/types"><i class="fa fa-circle-o"></i>Líneas </a></li>
                <li><a href="/materials"><i class="fa fa-circle-o"></i>Materiales </a></li>
                <li><a href="/stations"><i class="fa fa-circle-o"></i>Estaciones </a></li>
                <li><a href="/atributes"><i class="fa fa-circle-o"></i>Atributos </a></li>
                <li><a href="/suppliers"><i class="fa fa-circle-o"></i>Proveedores </a></li>
                    @endif
              </ul>
            </li>
            @endif
            @if($role == 1 || $role == 2)
            <li class="">
                          <a href="/sales/create">
                            <i class="fa fa-shopping-cart"></i> <span>Vender!</span>
                          </a>
             </li>
            @endif
              @if($role == 1 || $role == 2)
             <li class="">
                          <a href="/separateSales/create">
                            <i class="fa fa-shopping-cart"></i> <span>Pedid./Separ.</span>
                          </a>
             </li>
            @endif
            @if($role == 1 || $role == 2)
            <li class="">
              <a href="/sales">
                <i class="fa fa-list-ol"></i> <span>Lista de Ventas en Total</span>
              </a>
            </li>
            @endif
            @if($role == 1 || $role == 2)
            <li class="">
              <a href="/separateSales">
                <i class="fa fa-list-ol"></i> <span>Lista de Ped/Sep en Total</span>
              </a>
            </li>
            @endif
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calculator"></i>
                <span>Cajas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @if($role == 1)
                <li class=""><a href="/cashHeaders" ><i class="fa fa-circle-o"></i>Cajas</a></li>
                <li class=""><a href="/cashMonthlys" ><i class="fa fa-circle-o"></i>Gastos de Caja Mensual</a></li>
                @endif
                  @if($role == 1 || $role == 2)
                <li class=""><a href="/cashes" ><i class="fa fa-circle-o"></i>Ver Cajas Abiertas</a></li>
                    @endif

              </ul>
            </li>
            @if($role == 1)
            <li class="">
              <a href="/customers">
                <i class="fa fa-users"></i> <span>Clientes</span>
              </a>
            </li>
            @endif
            @if($role == 1)
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="/sales" ><i class="fa fa-circle-o"></i>Reporte de Ventas</a></li>
                <li class=""><a href="/purchases/cardex#detCajas" ><i class="fa fa-circle-o"></i>Reporte detalles caja</a></li>
                <li><a href="/separateSales"><i class="fa fa-circle-o"></i>Reporte de Seeparados </a></li>
                <li><a href="/purchases/cardex#PagoProveedores"><i class="fa fa-circle-o"></i>Reporte de Pagos a Proveedores </a></li>
                <li><a href="/cashes"><i class="fa fa-circle-o"></i>Reporte de Cajas </a></li>
                <li><a href="/purchases/cardex#mejoresEmplCli"><i class="fa fa-circle-o"></i>Reporte de Mejores Vendedores/clientes </a></li>
                <li><a href="/purchases/create"><i class="fa fa-circle-o"></i>Reporte de Movimientos de Almacén </a></li>
                <li><a href="/purchases/cardex#reportProduct"><i class="fa fa-circle-o"></i>Reporte Cardex </a></li>
              </ul>
            </li>
              @endif


          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>



                    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
            @yield('content')


        @if(Request::is('/'))

          <section class="content-header">
            <h1>
              ¡Empezando!
              <small>Version 2.0</small>
            </h1>
            <ol class="breadcrumb">
              <li class="active"><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>

            </ol>
          </section>
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-home"></i> SalesFly</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-0">
                        <h4>Completa los primeros pasos para poder empezar a descubrir SalesFly o mira el video de la derecha y
                        aprenda como hacer tu primera venta con los productos de demostración que hemos añadido para usted. </h4>
                    </div>

                  </div><!-- /.row -->
                  <br>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                      <div class="box box-default">
                        <div class="box-header with-border">
                          <h3 class="box-title"> 1. Añade tus productos!  </h3>
                          <div class="box-tools pull-right">

                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                          </div><!-- /.box-tools -->
                          <a href="/products/create" type="button" class="btn  btn-info btn-flat pull-right btn-sm" style="margin-right: 25px;">Añade un Producto</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          Puedes agregar manualmente tus productos. Te hemos puesto productos de ejemplo.
                        </div><!-- /.box-body -->

                      </div><!-- /.box -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                      <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> 2. Añade tus clientes!  </h3>
                          <div class="box-tools pull-right">

                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>

                          </div><!-- /.box-tools -->
                          <a href="/customers/create" type="button" class="btn  btn-info btn-flat pull-right btn-sm" style="margin-right: 25px;">Añade un Cliente</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          Puedes agregar manualmente tus productos. Te hemos puesto productos de ejemplo.
                        </div><!-- /.box-body -->

                      </div><!-- /.box -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">

                      <div class="box box-default collapsed-box">
                        <div class="box-header with-border">
                          <h3 class="box-title"> 3. Añade tus empleados!  </h3>
                          <div class="box-tools pull-right">

                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>

                          </div><!-- /.box-tools -->
                          <a href="/employees/create" type="button" class="btn  btn-info btn-flat pull-right btn-sm" style="margin-right: 25px;">Añade un Empleado!</a>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          Puedes agregar manualmente tus productos. Te hemos puesto productos de ejemplo.
                        </div><!-- /.box-body -->

                      </div><!-- /.box -->
                    </div>
                  </div>
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-3 col-xs-6">
                      <div class="description-block">
                        <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                      </div><!-- /.description-block -->
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div>
        </section>
          @endif




        </div>
  <!-- END Content Wrapper. Contains page content -->


      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.01
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">Salesfly</a>.</strong> Todos los derechos reservados.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
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
