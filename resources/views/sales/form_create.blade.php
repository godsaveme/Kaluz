<section class="noPrintx">
 <section class="content-header">
          <h1>
            Venta
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/stores">Venta</li>
            <li class="active">Crear</li>
          </ol>

          
        </section>

        <section class="content"> 
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Venta</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="storeCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                    <ul>
                      <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                  </div> 






            <div class="nav-tabs-custom" id="myTabs">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Venta</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" ng-click="actualizarCaja()">Caja Venta</a></li>
                    <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false" ng-click="cargarVentasProduct()">Ventas Productos</a></li>

                    <!--<li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Opciones</a></li>-->
                   <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false" ng-click="cargarConsulta()">Consultas</a></li>
                    </ul>
                <div class="tab-content">


                     <!--tab Documentos de Venta-->
                  <div class="tab-pane" id="tab_4">
                         <div class="row">
                           <div class="col-md-1">
                           </div>
                           <div class="col-md-7">
                               <h1>Kaluz</h1>
                           </div>
                           <div class="col-md-3" style="text-align: center;">
                              <table>

                                    <h4 style="margin-bottom:0px;"> RUC.- @{{documento.rucTienda}}</h4>
                                    <h1 ng-if="documento.tipoDoc=='F'" style="margin-top: 0xp; padding-top:0px;">Factura</h1>
                                    <h1 ng-if="documento.tipoDoc=='B'" style="margin-top: 0xp; padding-top:0px;">Boleta</h1>
                                    <h1 ng-if="documento.tipoDoc=='TF'" style="margin-top: 0xp; padding-top:0px;">Tiket Factura</h1>
                                    <h1 ng-if="documento.tipoDoc=='TB'" style="margin-top: 0xp; padding-top:0px;">Tiket Boleta</h1>
                                    <h3 style="color:red;">N°.-00@{{documento.cashHeader_id}}-@{{documento.NumDocument}}</h3>
                               </table>
                           </div>
                         </div>
                          <div class="row">
                           <div class="col-md-1">
                           </div>
                            <div class="col-md-8">
                            <label>FECHA:@{{documento.created_at}} </label>
                           </div>
                           <div class="col-md-2">
                            <label>#CAJA: @{{documento.idCaja}}</label>
                           </div>
                           </div>
                         <div class="row">
                           <div class="col-md-1">
                           </div>
                           <div class="col-md-6">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">CLIENTE: @{{documento.cliente}}</label>
                           </div>
                           <div class="col-md-4">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">RUC: @{{documento.ruc}}</label>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-1">
                           </div>
                            <div class="col-md-6">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">DIRECCION: @{{documento.direccion}}</label>
                           </div>
                           <div class="col-md-4">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">VENDEDOR: @{{documento.nomEmpleado}}</label>
                           </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-1">
                           </div>
                           <div class="col-md-10">
                           <div class="box-body table-responsive no-padding">
                             <table class="table table-striped">
                               <thead>
                                 <th>Descripcion</th>
                                 <th>Precion</th>
                                 <th>Cantidad</th>
                                 <th>Subtotal</th>
                               </thead>
                               <tbody>
                                 <tr ng-repeat="row in detDocumento">
                                 <td>@{{row.descripcion}}</td>
                                 <td>@{{row.PrecioUnit}}</td>
                                 <td>@{{row.cantidad}}</td>
                                 <td>@{{row.PrecioVent}}</td>
                                 </tr>
                               </tbody>
                             </table>
                             </div>
                           </div>
                        </div><br>
                        <div class="row">
                           <div class="col-md-1">
                           </div>
                           <div class="col-md-2">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">DESCUENTO: @{{documento.descuento}} %</label>
                           </div>
                           <div class="col-md-3">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">SUBTOTAL:S/.@{{documento.subTotal}}</label>
                           </div>
                           <div class="col-md-2">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">IGV:S/. @{{documento.igv}}</label>
                           </div>
                           <div class="col-md-3">
                               <label style="border:solid 1px; text-align: justify; width:100%; height:35px;">TOTAL:S/.@{{documento.Total}}</label>
                           </div>
                        </div> <br>
                        <div class="row">
                  <div class="col-md-1">
                           </div>
                           <div class="col-md-10">
                                <a  href="#tab_2" data-toggle="tab" aria-expanded="false" class="btn btn-warning">Volver</a>
                                <button  ng-click="tipoDeDocumentoGenerado(documento.tipo,documento.idFactura)" class="btn btn-info">Imprimir</button>
                           </div>
                        </div>
                  </div>

                  <!--Fin tab documentos de venta-->






                  <div class="tab-pane active" id="tab_1">


                    <div class="row">
                      <div class="col-md-6" >
                      <div class="box box-solid">
                        <div class="box-header with-border" style="background-color: #D7EAE3; border-style: solid;
                              border-width: 2px; border-color: #C8D9F7; border-radius: 10px 10px 0px 0px;">
                          <div class="row">
                            <div class="col-md-9" ng-show="skuestado">
                              <input type="text" ng-model="varianteSkuSelected" placeholder="Buscar por SKU" ng-enter="getvariantSKU()" class="form-control">
                            </div>

                            <div class="col-md-9" ng-show="!skuestado">
                              <input  type="text" ng-model="atributoSelected" ng-enter="open()" placeholder="Buscar por codigo" typeahead="atributo as atributo.NombreAtributos for atributo in getAtributos($viewValue)" 
                                    typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control"/>
                            </div>
                            <div class="col-md-3" >
                            <div class="form-group">
                                <input type="checkbox" name="estado" ng-model="base" ng-checked="base" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                                <label for="estado">Base</label>                             
                              
                                <input type="checkbox" name="skuestado" ng-model="skuestado" ng-checked="skuestado" class="ng-valid ng-dirty ng-valid-parse ng-touched">
                                <label for="estado">SKU</label>                             
                              </div>
                            </div>

                            
                            
                            
     
                           </div> 
 
                        </div><!-- /.box-header -->
                        <div class="box-body" style="min-height: 400px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7;" >
                          <table class="table table-bordered">
                                             
                            <tr ng-repeat="row in compras track by $index">
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover.templateUrl" type="button" class="btn btn-default">@{{compras[$index].cantidad}}</button>
                              </td>
                              <td><a popover-template="dynamicPopover5.templateUrl" popover-trigger="mouseenter">@{{compras[$index].NombreAtributos}}</a></td>
                              <td>
                                  <button data-toggle="popover" popover-template="dynamicPopover1.templateUrl" type="button" class="btn btn-default">@{{compras[$index].precioVenta| number:2}}</button>
                              </td>
                              <td>@{{compras[$index].subTotal | number:2}}</td>
                              <td><button type="button" class="btn btn-danger ng-binding"  ng-click="sacarRow($index,row.subTotal)">
                              <span class="glyphicon glyphicon-trash"></span>
                              </td>                    
                            </tr>                                    
                          </table> 
    
                        </div><!-- /.box-body -->


                        <div class="box-footer clearfix" style="background-color: #D7EAE3; border-style: solid;
                               border-width: 2px; border-color: #C8D9F7; border-radius: 0px 0px 10px 10px;">
                          <div class="row">
                            <div class="col-md-6" >
                              <table class="table table-bordered">
                                <tr>
                                  <div class="row">
                                    <div class="col-md-10" >
                                      <input type="text" ng-model="customersSelected" placeholder="Buscar Cliente" typeahead="atributo as atributo.busqueda for atributo in getcustomers($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control" typeahead-on-select="selecionarCliente()"/>
                                    </div>
                                    <div>
                                      <a class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana2"><span class="glyphicon glyphicon-plus"></span></a>
                                    </div>
                                </tr>
                                <tr>
                                  <div>
                                    <a ng-if="sale.cliente!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteCliente()"></a>
                                    @{{sale.cliente!=undefined? sale.cliente:'--No hay cliente seleccionado--'}}
                                  </div>
                                </tr>
                                <tr>
                                  <div>
                                    <input type="text" ng-model="employeeSelected" placeholder="Buscar Vendedor" typeahead="atributo as atributo.busqueda for atributo in getemployee($viewValue)" 
                                            typeahead-loading="loadingLocations" typeahead-no-results="noResults" class="form-control" typeahead-on-select="selecionarVendedor()"/>
                                  </div>
                                </tr>
                               <tr>
                                  <div>
                                    <a ng-if="sale.vendedor!=undefined"type="button" class="glyphicon glyphicon-remove-sign " ng-click="deleteVendedor()"></a>
                                    @{{sale.vendedor!=undefined? sale.vendedor:'--No hay vendedor seleccionado--'}}
                                  </div>
                                </tr>
                                <tr>
                                  <div class="row">
                                    <div class="col-md-7" >
                                      <button ng-click="estadoNotas()" ng-if="banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-default">ADD NOTAS</a>
                                      <button ng-click="estadoNotas()" ng-if="!banderaNotas" data-toggle="popover" popover-template="dynamicPopover6.templateUrl" type="button" class="btn btn-danger">ADD NOTAS</a>
                                      
                                    
                                    </div>
                                    <div class="col-md-5" >
                                      <a ng-if="sale.montoTotal>0" class="btn btn-default ng-binding" data-toggle="modal" data-target="#miventana1" ng-click="pagar()">PAGAR</a>
                                      <a ng-if="sale.montoTotal==0"class="btn btn-default ng-binding" ng-click="pagar()">PAGAR</a>
                                    </div>
                                  </div>
                                </tr>
                                  
                              </table>

                            </div>

                            <div class="col-md-6" >
                                <table class="table table-bordered">
                                <tr>
                                <td>Sub Total</td>
                                <td>@{{sale.montoBruto | number:2}}</td>                    
                                </tr>
                                <tr> 
                                <td>IGV</td>
                                <td>@{{sale.igv | number:2}}</td>                    
                                </tr> 
                                <tr style="border-bottom: solid; border-width: medium;">
                                <td>Descuento</td>
                                <td>
                                  <button popover-template="dynamicPopover2.templateUrl" type="button" class="btn btn-default">@{{sale.descuento | number:2}}</button>
                                </td>                    
                                </tr> 
                                <tr>
                                <td ><b>Total</b></td>
                                <td ng-model="sale.montoTotal" ><b>@{{sale.montoTotal | number:2}}</b></td>                    
                                </tr>                                   
                              </table>
                            </div>
                        </div>
                      </div> 

                    </div>





                    </div>

                    <div class="col-md-6" style="min-height: 670px; border-style: solid;
                                border-width: 2px; border-color: #C8D9F7; border-radius:10px" >
                        <div>
                        <div class="modal-header">
                          <h4 class="modal-title">Favoritos <button type="button" class="btn btn-info btn-flat btn-xs pull-right" ng-click="AddFavoritos()"> <span class="glyphicon glyphicon-plus"></span> </button>
                          <button type="button" class="btn btn-danger btn-flat btn-xs pull-right" ng-click="delFavEst()"> <span class="glyphicon glyphicon-trash"></span> </button></h4>
                        </div>
                          <div class="box-body">
                            <button ng-if="!banderadeleteFavorito" type="button" class="btn btn-default" ng-repeat="row in favoritos" style="width: 450px;height: 60px; overflow-x:hidden;" title="@{{row.NombreAtributos}}"
                                    ng-click="deleteFavoritos(row)">   
                                    <a type="button" class="glyphicon glyphicon-remove" ng-click="deleteFavoritos(row)"></a>                         
                                @{{row.NombreAtributos}}

                            </button>  
                            <button ng-if="banderadeleteFavorito" type="button" class="btn btn-default" ng-repeat="row in favoritos" style="width: 450px;height: 60px; overflow-x:hidden;" title="@{{row.NombreAtributos}}"
                                    ng-click="cargarFavoritos(row)">                           
                                @{{row.NombreAtributos}}

                            </button>  
                          </div>

                        </div>
                      
                    </div>
                  </div>

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_2">
                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Usuario</th>
                      <th>Documento</th>
                      
                      <th>S/.Tarjeta</th>
                      <th>S/.Efectivo</th>
                      <th>Notas</th>
                        <th>Estado</th>

                      <th>Ver Venta</th>
                    </tr>
                    
                    <tr ng-repeat="row in detCashes">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.fecha}}</td>
                      <td>@{{row.hora}}</td>
                      <td>@{{row.name}}</td>
                      <td><a href="#tab_4" data-toggle="tab" aria-expanded="false" ng-click="traerDoumento(row)">@{{row.tipoDoc+"-"+row.NumDocument}}</a></td>
                      <td>@{{row.tarjeta}}</td>
                      <td>@{{row.efectivo}}</td>
                      <td>@{{row.notas}}</td>
                        <td ng-if="row.estado==0" style="color: yellow;">Pend.</td>
                        <td ng-if="row.estado==1" style="color: green;">Term.</td>
                        <td ng-if="row.estado==3" style="color: red;">Anul.</td>

                      <td ng-if="row.cashMotive_id==1 || row.cashMotive_id==14"><a href="/sales/edit/@{{row.id}}" target="_blank">ver venta</a></td>
                      <td ng-if="row.cashMotive_id!=1 && row.cashMotive_id!=14">@{{row.id}}</td>
                    </tr>                   
                  </table>
                  <div class="box-footer clearfix">
                    <pagination total-items="totalItems1" ng-model="currentPage1" max-size="maxSize1" 
                    class="pagination-sm no-margin pull-right" items-per-page="itemsperPage1" boundary-links="true" rotate="false" 
                    num-pages="numPages1" ng-change="pageChanged1()"></pagination>
                  </div>                    

                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="tab_3">
                  <div class="row">
                    <div class="col-md-4">
                     <div class="form-group" >
                        <label for="year">Tienda</label>
                        <select ng-click="mostrarAlmacenCaja()" class="form-control" name="" ng-model="store.id" ng-options="item.id as item.nombreTienda for item in stores">
                          <option value="">--Elije Tienda--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <div class="form-group" >
                        <label for="year">Almacen</label>
                        <select class="form-control" name="" ng-model="warehouse.id" ng-options="item.id as item.nombre for item in warehouses">
                          <option value="">--Elije Almacen--</option>
                        </select>
                      </div>
                    </div>


                   <!-- <div class="col-md-4">
                        <div class="form-group" >
                          <label for="month">Caja</label>

                          <select class="form-control" name="" ng-model="cash1.cashHeader_id" ng-options="item.id as item.nombre for item in cashHeaders">
                          <option value="">--Elije Caja--</option>
                          </select>
                        </div>
                      </div>-->

                    </div>


                  </div><!-- /.tab-pane -->


                <div class="tab-pane" id="tab_6">
                      
                      
                    
                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Marca</th>
                      <th>Codigo</th>
                      <th>sku</th>
                        <th>Cantidad</th>
                      <th>Línea</th>
                      <th>Estacion</th>
                      <th>Modelo</th>
                      <th>Color</th>
                      <th>Taco</th>
                      <th>Talla</th>

                      <th>Modo de Pago</th>
                      <th>Monto</th>
                    </tr>
                    
                    <tr  ng-repeat="row in ventas track by $index">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.marca}}</td>
                      <td>@{{row.codigo}}</td>
                      <td>@{{row.sku}}</td>
                        <td>@{{row.cantidad | number:0}}</td>
                      <td>@{{row.linea}}</td>
                      <td>@{{row.estacion}}</td>
                      <td>@{{row.modelo}}</td>
                      <td>@{{row.color}}</td>
                      <td>@{{row.Taco}}</td>
                      <td>@{{row.Talla}}</td>

                      <td>@{{row.SMPNombre}}</td>
                      <td ng-if="row.estado==3" style="color: red;">S/. @{{row.subTotal}}</td>
                        <td ng-if="row.estado!=3" style="color: green;">S/. @{{row.subTotal}}</td>
                    </tr>
                    
                    
                  </table>
                    <div class="box-footer clearfix">
                        <pagination total-items="totalItemsV" ng-model="currentPageV" max-size="maxSizeV" class="pagination-sm no-margin pull-right" 
                        items-per-page="itemsperPageV" boundary-links="true" rotate="false" num-pages="numPages" ng-change="pageChangedV()"></pagination>
                    </div>
                  </div>







                  <div class="tab-pane" id="tab_5">
                      
                      
                    <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>
                           
                          <form >
                               <div class="input-group" style="width: 150px;">
                                 <input ng-change="cargarConsulta()" type="text" ng-model="busCodigo"  name="table_search" class="form-control input-sm pull-right" placeholder="Codigo" />
                                 <div class="input-group-btn">
                                   <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                 </div>
                               </div>
                          </form>
                      </th>
                      <th>Sku</th>
                      <th>
                      <select class="form-control" name="" ng-model="materialId" ng-change="cargarConsulta1(materialId)"ng-options="item.id as item.nombre for item in brands">
                          <option value="">Marca - Todos</option>
                      <th><select class="form-control" name="" ng-model="lineaId" ng-change="cargarConsulta2(lineaId)"ng-options="item.id as item.nombre for item in types">
                          <option value="">Linea - Todos</option>
                          </select></th>
                      <th>Stock</th>
                      <th><form >
                               <div class="input-group" style="width: 120px;">
                                 <input ng-change="cargarConsulta()" type="text" ng-model="busColor"  name="table_search" class="form-control input-sm pull-right" placeholder="Color" />
                                 <div class="input-group-btn">
                                   <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                 </div>
                               </div>
                          </form>
                      </th>
                      <th><form >
                               <div class="input-group" style="width: 80px;">
                                 <input ng-change="cargarConsulta()" type="text" ng-model="busTaco"  name="table_search" class="form-control input-sm pull-right" placeholder="Taco" />
                                 <div class="input-group-btn">
                                   <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                 </div>
                               </div>
                          </form>
                          </th>
                      <th><form >
                               <div class="input-group" style="width: 80px;">
                                 <input ng-change="cargarConsulta()" type="text" ng-model="busTalla"  name="table_search" class="form-control input-sm pull-right" placeholder="Talla" />
                                 <div class="input-group-btn">
                                   <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                 </div>
                               </div>
                          </form></th>
                      <th><form >
                               <div class="input-group" style="width: 150px;">
                                 <input ng-change="cargarConsulta()" type="text" ng-model="busMaterial"  name="table_search" class="form-control input-sm pull-right" placeholder="Material" />
                                 <div class="input-group-btn">
                                   <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                 </div>
                               </div>
                          </form></th>
                      <th>Precio Venta (S/.)</th>
                    </tr>
                    
                    <tr ng-if="row.color!=undefined  && row.Taco!=undefined && row.Talla!=undefined && row.Material!=undefined" ng-repeat="row in variants1 track by $index">
                      <td>@{{$index + 1}}</td>
                      <td>@{{row.codigo}}</td>
                      <td>@{{row.sku}}</td>
                      <td>@{{row.braNombre}}</td>
                      <td>@{{row.typNombre}}</td>
                      <td>@{{row.stoStockActual}}<spam ng-if="row.separado>0" style="color: red;">-@{{row.separado}}</spam></td>
                      <td>@{{row.color}}</td>
                      <td>@{{row.Taco}}</td>
                      <td>@{{row.Talla}}</td>
                      <td>@{{row.Material}}</td> 
                      <td>@{{row.price}}</td> 
                    </tr>
                    
                    
                  </table>
                  </div>
                    <div class="box-footer clearfix">
                        <pagination total-items="totalItemsZ" ng-model="currentPageZ" max-size="maxSizeZ" class="pagination-sm no-margin pull-right" 
                        items-per-page="itemsperPageZ" boundary-links="true" rotate="false" num-pages="numPages" ng-change="pageChangedZ()"></pagination>
                    </div>
                  </div>
                </div><!-- /.tab-content -->
              </div>
               <script type="text/javascript">$('#myTabs a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')})
              </script>



                  



                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
            
              </section><!-- /.content -->



<script type="text/ng-template" id="myPopoverTemplate5.html">
      <div class="form-group">
          <label>@{{dynamicPopover5.title}}</label>
        </div>

        <div>
        <label>Stock : </label>
        <label>@{{compras[$index].Stock}}</label>
        </div>

        <div>
        <label>Pedidos : </label>
        <label>@{{compras[$index].stockPedidos}}</label>
        </div>

        <div>
        <label>Separados : </label>
        <label>@{{compras[$index].stockSeparados}}</label>
        </div>

        <div>
        <label>precio : </label>
        <label>@{{compras[$index].precioProducto}}</label>
        </div>
          
                 
    </script>







<script type="text/ng-template" id="myPopoverTemplate6.html">
        <div class="form-group">
          <label>@{{dynamicPopover6.title}}</label>
          <div class="row" >
          <div class="col-md-12">
            <textarea  ng-model="sale.notas" type="text"  class="form-control"/>
           </div> 
          </div>
        </div>
    </script>




    <script type="text/ng-template" id="myPopoverTemplate.html">
        <div class="form-group">
          <label>@{{dynamicPopover.title}}</label>
          <div class="row" >
          <div class="col-md-9">
            <input type="number" min="0" ng-model="compras[$index].cantidad" ng-change="calcularmontos($index)" class="form-control">
            </div>
            <button type="button" class="btn btn-xs" ng-click="aumentarCantidad($index)">
            <span type="button" class="glyphicon glyphicon-plus"></span></button>
            <button type="button" class="btn btn-xs" ng-click="disminuirCantidad($index)">
            <span type="button" class="glyphicon glyphicon-minus"></span></button>

          </div>
        </div>
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate1.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover1.title1}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" ng-model="compras[$index].descuento" ng-change="keyUpDescuento($index)"class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuento($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuento($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Precio Unidad"><div class="form-group">
            <label>@{{dynamicPopover1.title}}</label>
            <div class="row" >
            <div class="col-md-9">
            <input type="number" min="0" ng-change="calcularmontos($index)" ng-model="compras[$index].precioVenta" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarPrecio($index)">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirPrecio($index)">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>
    <hr />
    <script type="text/ng-template" id="myPopoverTemplate2.html">
        
      <tabset justified="true">

      <tab heading="Descuento">
        <label>@{{dynamicPopover2.title1}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" ng-model="sale.descuento" ng-change="keyUpDescuentoPedido()" class="form-control"></input>
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarDescuentoPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirDescuentoPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div>

      </tab>
      <tab heading="Total"><div class="form-group">
            <label>@{{dynamicPopover2.title}}</label>
            <div class="row" >
            <div class="col-md-8">
            <input type="number" min="0" ng-model="sale.montoTotal" ng-change="keyUpTotalPedido()" class="form-control">
          </div>
         <button type="button" class="btn btn-xs" ng-click="aumentarTotalPedido()">
          <span type="button" class="glyphicon glyphicon-plus"></span></button>
         <button type="button" class="btn btn-xs" ng-click="disminuirTotalPedido()">
         <span type="button" class="glyphicon glyphicon-minus"></span></button>

        </div>
        </div> 

        </tab>
      </tabset>
              
    </script>

    <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="ngenabled"> &times; </button>
                          <h4 class="modal-title">Añadir Cliente</h4>
                        </div>
                        <form name="customerCreateForm" role="form" novalidate> 
                        <!--=================cueropo========================-->
                        <div class="modal-body">
                   <div class="row" >
                    <div class="col-md-6">
                      <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.nombres.$error.required && customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid]">
                      <label for="nombres">Nombres</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="nombres" placeholder="Nombres" ng-model="customer.nombres" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.nombres.$dirty && customerCreateForm.nombres.$invalid">
                        <span ng-show="customerCreateForm.nombres.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                      </label>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.apellidos.$error.required && customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid]">
                      <label for="apellidos">Apellidos</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="apellidos" placeholder="Apellidos"
                      ng-model="customer.apellidos" required>
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.apellidos.$dirty && customerCreateForm.apellidos.$invalid">

                        <span ng-show="customerCreateForm.apellidos.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                       </label>
                    </div>
                    </div>
                    </div>

                    <div class="row" >
                    <div class="col-md-6">
                    <div class="form-group" >
                      <label for="apellidos">Empresa / Razón Social</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="empresa" placeholder="empresa"
                      ng-model="customer.empresa">
                     </div>
                     </div>
                     <div class="col-md-6">
                    <div class="form-group" >
                      <label for="direccFiscal">Dirección Fiscal</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="direccFiscal" placeholder="dirección fiscal"
                      ng-model="customer.direccFiscal">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                    <div class="col-md-6"> 
                    <div class="form-group" >
                      <label for="ruc">RUC</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="ruc" placeholder="ruc"
                      ng-model="customer.ruc"  ng-change="ValidarCamposRuc()">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                        <div class="form-group" >
                                      <label for="codigo">Código de Cliente</label>
                                      <input type="text" style="text-transform: uppercase" class="form-control" name="codigo" placeholder="codigo de cliente"
                                             ng-model="customer.codigo" ng-disabled="customer.autogenerado" ng-required="!customer.autogenerado">
                                      <span style="color:#dd4b39;" ng-show="customerCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                  </div>
                      </div>

                        <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="apellidos">Autogenerado</label><br>
                                      <input type="checkbox" ng-model="customer.autogenerado"> Cód. gen.
                                  </div>
                              </div>
                    </div>
                    <div class="row" >
                    <div class="col-md-5"> 
                    <div class="form-group" ng-class="{true: 'has-error'}[ customerCreateForm.fechaNac.$error.required && customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid]">
                    <label for="fechaNac">Fecha de Nac.</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                          </div>
                      <input type="date" class="form-control" name="fechaNac" ng-model="customer.fechaNac">
                      <label ng-show="customerCreateForm.$submitted || customerCreateForm.fechaNac.$dirty && customerCreateForm.fechaNac.$invalid">
                                              <span ng-show="customerCreateForm.fechaNac.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                            </label>
                      </div>
                     </div>
                     </div>
                     <div class="col-md-3"> 
                      <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero" style="text-transform: uppercase" class="form-control" ng-model="customer.genero">
                                             <option value="">-- elige género --</option>
                                             <option value="M">Masculino</option>
                                             <option value="F">Femenino</option>

                                            </select>
                      </div>
                      </div>
                      <div class="col-md-4">
            <div class="form-group" >
                <label for="dni">DNI</label>
                <input type="text" style="text-transform: uppercase" class="form-control" name="dni" placeholder="8 dígitos"
                       ng-model="customer.dni" ng-change="ValidarCamposDni()">
            </div>
        </div>
                     </div>


                     <div class="">
                          <hr>
                          <button type="button" class="btn btn-default" ng-click="toggle()">Mostrar Formulario de Contacto</button>
                          <hr>
                      </div>

                <div ng-show="show" >
                     <div class="row" >
                     

                    <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="fijo">Teléfono fijo</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="fijo" placeholder="###"
                      ng-model="customer.fijo">
                     </div>
                     </div>

                     <div class="col-md-4"> 
                    <div class="form-group" >
                      <label for="movil">Teléfono movil</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="movil" placeholder="###"
                      ng-model="customer.movil">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="email">Email</label>
                      <input type="email" style="text-transform: uppercase" class="form-control" name="email" placeholder="###"
                      ng-model="customer.email">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="website">Página Web</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="website" placeholder="###"
                      ng-model="customer.website">
                     </div>
                     </div>
                     <div class="col-md-4">  
                    <div class="form-group" >
                      <label for="direccContac">Dirección de Contacto</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="direccContac" placeholder="###"
                      ng-model="customer.direccContac">
                     </div>
                     </div>
                     </div>

                    <div class="row" >
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="distrito">Distrito</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="distrito" placeholder="Chiclayo"
                      ng-model="customer.distrito">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="provincia">Provincia</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="provincia" placeholder="Chiclayo"
                      ng-model="customer.provincia">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="departamento">Departamento</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="departamento" placeholder="Lambayeque"
                      ng-model="customer.departamento">
                     </div>
                     </div>
                     <div class="col-md-3"> 
                    <div class="form-group" >
                      <label for="pais">País</label>
                      <input type="text" style="text-transform: uppercase" class="form-control" name="pais" placeholder="Perú"
                      ng-model="customer.pais">
                     </div>
                     </div>
                     </div>
                    <div class="form-group" >
                      <label for="notas">Notas</label>
                      <input type="notas" style="text-transform: uppercase" class="form-control" name="notas" placeholder="..."
                      ng-model="customer.notas"></input>
                     </div>
                      </div>
                  </div>
                        <!--================================================-->
                        <div class="modal-footer" >
                          <button type="submit" class="btn btn-primary" ng-click="createCustomer()">Crear</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>


          <!-- =========================================Ventana Agregar Año=================================-->
         <div class="container"  style="margin-top: 60px;">
           <div  class="modal fade" id="miventana1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="ngenabled">
             <div  class="modal-dialog">
                  <div style="border-radius: 5px" class="modal-content">
                        <div class="modal-header" style="background-color: #0673B3; border-radius: 5px; color: #E2E2EC;">
                    
                          <h4 class="modal-title">Realizar Pago</h4>
                        </div>
                        <!--=================cueropo========================-->
                <div class="modal-body">
              <div class="row" >
                <div class="col-md-5"> 
                  <table class="table table-bordered">
                    <tr>
                      <td>Cash</td>
                      <td>
                        <input type="number" class="form-control" name="cash" placeholder="" min="0.00"
                          ng-model="pago.cash" ng-change="calcularVuelto()"></input>
                      </td>                    
                    </tr>
                    <tr>

                      <td>Tarjeta</td>
                      <td><input type="number" class="form-control" name="tarjeta" placeholder="" min="0.00"
                          ng-model="pago.tarjeta" ng-change="calcularVuelto()"></input>
                      </td>
                    </tr>
                    <tr> 
                      <td>
                          <a class="btn btn-success btn-xs" ng-click="limpiartipoTarjeta()">Clear</a> 
                      </td>
                      <td>
                        <div class="btn-group">
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'2'">Visa</label>
                          <label class="btn btn-primary" ng-model="radioModel" btn-radio="'3'">MasterCard</label>
                        </div>  
                      </td>                    
                    </tr>                                    
                    <tr>
                      <td></td>
                      <td>
                        <div class="form-group">
                          <input type="checkbox" name="estado" ng-model="acuenta" ng-checked="acuenta" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="baseestado()">
                          <label for="estado">Acuenta</label>
                        </div> 
                      </td>
                    </tr>
                  </table>
                </div>
                  <div class="col-md-7">
                    <table class="table table-bordered">
                      <tr>
                        <td>Sub Total</td>
                        <td style="font-size:150%;">S/. @{{sale.montoBruto | number:2}}</td>                    
                      </tr>
                      <tr> 
                        <td>IGV</td>
                        <td style="font-size:150%;">S/. @{{sale.igv | number:2}}</td>                    
                      </tr>
                      <tr style="border-bottom: solid; border-width: medium;">
                        <td>Descuento</td>
                        <td style="font-size:150%;">S/. @{{sale.descuento | number:2}}</td>
                      </tr>  
                      <tr>
                        <td><b>Total Pagar</b></td>
                        <td><b  style="font-size:150%;">S/. @{{sale.montoTotal | number:2}}</b></td>                    
                      </tr> 
                      <tr>
                        <td><b>Vuelto</b></td>
                        <td><b style="font-size:150%;">S/. @{{sale.vuelto | number:2}}</b></td>                    
                      </tr>                                   
                    </table>

                </div>

                </div>
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <input type="checkbox" name="estado" ng-model="sale.comprobante"  ng-checked="sale.comprobante" class="ng-valid ng-dirty ng-valid-parse ng-touched" ng-click="validaDocumento()">
                          <label for="estado">Comprobante:</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div ng-show="sale.comprobante" class="form-group">
                        <label  for="orderPurchase.tipoDoc">Tipo documento</label>
                        <select  class="form-control" ng-model="sale.tipoDoc" ng-change="cambioNumeracion()">
                              <option ng-hide="estadoComoDocument==true" value="F">Factura</option>
                              <option value="B">Boleta</option>
                        </select>
                        </div> 
                      </div>
                      <div ng-show="sale.comprobante" class="col-md-4">
                      <h2>N°.- @{{numActual}}</h2>
                      </div>
                  </div>
                   
                </div>

                        <!--================================================-->
                        <div class="modal-footer" >
                          <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="realizarPago()">Cobrar</button>
                          <a  class="btn btn-danger" data-dismiss="modal" aria-hidden="ngenabled">Salir</a>
                      </div>
                    </form>
                  </div>
              </div>
            </div>
          </div>




          <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 class="modal-title">Presentaciones</h3>
        </div>
                  <table class="table table-bordered">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nombre</th>
                      <th>Precio</th>
                      <th>Presentacion</th>
                      <th>Equivalencia</th>
                      <th>Producto Base</th>

                      <th style="width: 40px">Enviar</th>
                    </tr>
                    
                    <tr ng-repeat="row in presentations">
                      <td>@{{$index + 1}}</td>
                      <td ng-hide="true">@{{row.iddetalleP}}</td>
                      <td >@{{row.NombreAtributos}}</td>
                      <td>@{{row.precioProducto}}</td> 
                      <td>@{{row.Presentacion}}</td>  
                      <td>@{{row.equivalencia}} @{{row.nomBase}}</td>
                      <td ng-if="row.base==0"><span class="badge bg-red">NO</span></td> 
                      <td ng-if="row.base!=0"><span class="badge bg-green">SI</span></td> 
                      <td><a ng-click="AsignarCompra(row)" class="btn btn-warning btn-xs" data-dismiss="modal">Enviar</a></td>

                    </tr>                                       
                  </table>
        <div class="modal-footer">
            <button class="btn btn-primary" type="button" ng-click="ok()">OK</button>
            <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</section>


<div id="printx" style="display:none;">
<body >
    <div class="logotipo">
      <h1 class="log">KALUZ.EIRL</h1>
      <label>av. Pedro Ruiz #1020 - Chiclayo</label>
    </div>
    <div class="cuadroNume">
      <label>R.U.C.:12548963002</label>
      <h1 ng-if="headVoice.tipoDoc=='F'" class="fac">FACTURA</h1>
      <h1 ng-if="headVoice.tipoDoc=='B'" class="fac">BOLETA DE VENTA</h1>
      <label>N° @{{numCaja}}-@{{numeroDocumento}}</label>
    </div>
    <div class="headfac">
        <br>
      <label class="fech">Chiclayo @{{diaFactura}} de @{{mesActual}} del @{{anoFactura}}</label><br>
    <table class="tbhead" >
      <tr>
        <td><label>Señor(a):</label></td>
        <td><input style="width:400px;" type="text" value="@{{headVoice.cliente}}"></td>
        <td><label ng-if="headVoice.tipoDoc=='F'">RUC:</label><label ng-if="headVoice.tipoDoc=='B'">N° Doc:</label></td>
        <td><input style="width:250px;" type="text" value="@{{headVoice.ruc}}"></td>
      </tr>

      <tr>
        <td><label>Direccion:</label></td>
        <td ><input style="width:400px;" type="text" value="@{{headVoice.direccion}}"></td>
        <td><label>G. Remicion:</label></td>
        <td><input style="width:250px;" type="text"></td>
      </tr>
    </table>
      
    </div>
    <div class="tbcontent">
      <table class="table table-bordered">
        <thead>
          <th>CANTIDAD</th>
          <th style="width: 400px;">DESCRIPCION</th>
          <th>PRECIO<br>UNITARIO</th>
          <th>VALOR DE<br>VENTA</th>
        </thead>
        <tbody>
          <tr ng-repeat="row in detVoices">
            <td>@{{row.cantidad}}</td>
            <td>@{{row.descripcion}}</td>
            <td>S/.@{{row.PrecioUnit}}</td>
            <td>S/.@{{row.PrecioVent}}</td>
          </tr>
          <tr ng-if="headVoice.tipoDoc=='F'">
               <td colspan='2'><label>Son:</label><input class="descrResult" type="text" value="@{{DecripcionTotal}}"></td>
               <td></td>
               <td></td>
          </tr>
        </tbody>
      </table>
      
       </div>
      <div class="firma">
          <label>______________</label><br>
          <label>
            CANCELADO
          </label>
        </div>
      <div class="result">
        
        <table class="tbre">
        
          <tr ng-if="headVoice.tipoDoc=='F'">
             <td><label>Sub Total:</label></td>
             <td><input type="text"  value="S/.@{{headVoice.subTotal}}"></td>
          </tr>
          <tr ng-if="headVoice.tipoDoc=='F'">
              <td><label >IGV.18%:</label></td>
              <td><input type="text"  value="S/.@{{headVoice.igv}}"></td>
          </tr>
          <tr>
              <td><label >Total:</label></td>
              <td><input type="text"  value="S/.@{{headVoice.Total}}"></td>
          </tr> 
        
         </table>
      </div>
    
</body>
</div>







    
    













              
               