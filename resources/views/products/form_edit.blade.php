<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Productos
        <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="/products">Productos</li>
        <li class="active">Crear</li>
    </ol>


</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Producto</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="productCreateForm" role="form" novalidate>
                    <div class="box-body">
                        <div class="callout callout-danger" ng-show="errors">
                            <ul>
                                <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label for="nombres">Nombre</label>
                                    <input type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="nombre" placeholder="Nombre" ng-model="product.nombre" ng-blur="validaNombre2(product.nombre)" typeahead-on-select="validarNombre()" typeahead="product as product.proNombre for product in products | filter:$viewValue | limitTo:8" >
                                    
                                </div></div>
                            <div class="col-md-6">
                                <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.codigo.$error.required && productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid]">
                                    <label for="codigo">Código de Producto</label>
                                    <input type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="codigo" placeholder="1000"
                                           ng-model="product.codigo" ng-keyup="duplicateCodProveedor()" required>
                                    <label ng-show="productCreateForm.$submitted || productCreateForm.codigo.$dirty && productCreateForm.codigo.$invalid">

                                        <span ng-show="productCreateForm.codigo.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                    </label>
                                    <span class="text-info"> <em> Identificador único para este producto.</em></span>
                                </div></div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group" ng-class="{true: 'has-error'}[ productCreateForm.suppCode.$error.required && productCreateForm.$submitted || productCreateForm.suppCode.$dirty && productCreateForm.suppCode.$invalid]">
                                            <label for="suppCode">Código de Proveedor</label>
                                            <input type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="suppCode" placeholder="1000"
                                                   ng-model="product.suppCode" required>
                                            <label ng-show="productCreateForm.$submitted || productCreateForm.suppCode.$dirty && productCreateForm.suppCode.$invalid">

                                                <span ng-show="productCreateForm.suppCode.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                            </label>
                                            <span class="text-info"> <em> Código del producto para el proveedor.</em></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Presentación Base:</label>
                                            <select class="form-control" style="text-transform: uppercase"  ng-model="product.presentation_base_object" ng-change="changePreBase()" ng-options="item as item.nombre for item in presentations_base">
                                                <option value="">-- Elige Presentación Base--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!--end row-->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Marca <a class="btn btn-xs btn-info btn-flat" ng-click="addBrand()">+</a> </label>
                                            <select name="brand" style="text-transform: uppercase" class="form-control" ng-model="product.brand_id" ng-options="k as v for (k, v) in brands">
                                                <option value="">--Elige Marca--</option>

                                            </select>


                                        </div></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Línea <a class="btn btn-xs btn-info btn-flat" ng-click="addLine()">+</a></label>
                                            <select name="ttype" style="text-transform: uppercase" class="form-control" ng-model="product.type_id" ng-options="k as v for (k, v) in types">
                                                <option value="">--Elige Categoría--</option>
                                            </select>
                                        </div></div>
                                    <!--<div class="col-md-3">
                                        <div class="form-group">
                                            <label>Material <a class="btn btn-xs btn-info btn-flat" ng-click="addMaterial()">+</a></label>
                                            <select name="material" class="form-control" ng-model="product.material_id" ng-options="k as v for (k, v) in materials">
                                                <option value="">--Elige Material--</option>
                                            </select>
                                        </div></div>-->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Estación <a class="btn btn-xs btn-info btn-flat" ng-click="addStation()">+</a></label>
                                            <select name="station" style="text-transform: uppercase" class="form-control" ng-model="product.station_id" ng-options="k as v for (k, v) in stations">
                                                <option value="">--Elige Estación--</option>
                                            </select>
                                        </div></div>
                                </div>


                            </div> <!--end col-md-8-->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Imagen</label>
                                    <input type="file" ng-model="product.image" id="productImage" name="productImage"/>

                                </div>
                                <div class="form-group">
                                    <img ng-src="@{{::product.image}}" alt="" class="img-thumbnail"/>
                                </div>
                            </div>

                        </div> <!--end row-->


                        <div class="row">



                        </div>
                     <div class="row">
                        <div class="col-md-4">
                        <div class="form-group" >
                            <label for="estado">¿Puede ser vendido/comprado?</label>
                            <input type="checkbox" name="estado" ng-model="product.estado" ng-checked="product.estado"/>
                        </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Modelo</label>
                            <input class="form-control" type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="product.modelo">
                        </div>
                      </div>
                      </div>
                        <div class="form-group" >
                            <label for="notas">Descripción</label>
                      <textarea type="notas" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="notas" placeholder="..."
                                ng-model="product.descripcion" rows="4" cols="50"></textarea>
                        </div>


                        <div class="box box-default" id="variants">
                            <div class="box-header with-border">
                                <h3 class="box-title">Variantes</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group" >
                                    <label for="variantes">¿Producto con Variantes?</label>
                                    <input type="checkbox" name="variantes" ng-model="product.hasVariants" ng-checked="product.hasVariants" ng-disabled="true"/>
                                    <span class="text-info"> <em> Si su producto cuenta con atributos específicos tales como: Color, Talla, etc. Active este item y agregue las variantes una vez creado el producto.</em></span>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                        <!--  =============================================================================PRESENTACIONES===============================================================-->
                        <div class="box box-default" id="price" ng-hide="product.hasVariants">
                            <div class="box-header with-border">
                                <h3 class="box-title">Presentaciones del Producto     </h3>    <button class="btn btn-xs btn-info btn-flat" data-toggle="modal" data-target="#presentation" ng-click="traerPres(product.presentation_base)" ng-disabled="enabled_presentation_button" >Añadir Presentación</button>
                                <button class="btn btn-xs btn-warning btn-flat" data-toggle="modal" data-target="#createpresentation"  ng-disabled="enabled_createpresentation_button" >Crear Presentación</button>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">

                                <div class="row">

                                    <div class="col-md-6 col-md-offset-3">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                <th>#</th>
                                                <th>Presentación</th>
                                                <th>Precio de Proveedor</th>
                                                <th>% de Utilidad</th>
                                                <th>Precio de Venta</th>
                                                <th>Opciones</th>
                                            </tr>
                                            <tr ng-repeat="row in product.presentations">
                                                <td>@{{$index + 1}}</td>
                                                <td>@{{row.nombre}}</td>
                                                <td>@{{row.suppPri}}</td>
                                                <td>@{{row.markup}}</td>

                                                <td>@{{row.price}}</td>
                                                <td><a class="btn btn-warning btn-xs" href="" ng-click="editPres($index)"><i class="fa fa-fw fa-pencil"></i></a>
                                                    <a href="" class="btn btn-danger btn-xs" ng-click="deletePres($index)"><i class="fa fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>



                                            </tbody></table>
                                    </div>


                                </div>
                            </div><!-- /.box-body -->
                            <div class="overlay" ng-class="{ 'hidden': !product.hasVariants}">
                            </div>

                        </div><!-- /.box -->

                                <!--  =============================================================================PRECIO DEL PRODUCTO.. ya no se usa===============================================================-->

                        <!--                                <div class="box box-default" id="price">
                                                                                   <div class="box-header with-border">
                                                                                     <h3 class="box-title">Precio del Producto</h3>
                                                                                     <div class="box-tools pull-right">
                                                                                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                                     </div>
                                                                                     </div>
                                                                                     <div class="box-body">
                                                                                               <div class="callout callout-default">
                                                                                                   <p>Si el producto presenta Variantes. El precio del mismo se establecerá al momento de crear las Variantes.</p>
                                                                                                 </div>
                                                                                                 <div class="row">
                                                                                                 <div class="col-md-2 col-md-offset-3">
                                                                                             <div class="form-group" >

                                                                                                    <label for="suppPric">Precio de Compra</label>
                                                                                                     <input type="number" class="form-control" name="suppPric" placeholder="0.00"
                                                                                                                   ng-model="product.suppPri" ng-disabled="product.hasVariants"  ng-blur="calculateSuppPric()" step="0.1">

                                                                                             </div>
                                                                                             </div>
                                                                                              <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                                   <label for="suppPric">% de Ganancia</label>
                                                                                                                                                                                                    <input type="number" class="form-control" name="markup" placeholder="0.00"
                                                                                                                                                                                                                  ng-model="product.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants" step="0.1">

                                                                                                                                                                                            </div></div>
                                                                                               <div class="col-md-2"><div class="form-group" >

                                                                                                                                                                                                    <label for="suppPric">Precio de Venta</label>
                                                                                                                                                                                                     <input type="number" class="form-control" name="price" placeholder="0.00"
                                                                                                                                                                                                                   ng-model="product.price" ng-blur="calculatePrice()" ng-disabled="product.hasVariants" step="0.1">

                                                                                                                                                                                             </div></div>
                                                                                     </div>
                                                                                   </div>
                                                                                       <div class="overlay" >
                                                                                       </div>

                                                                                 </div> -->

                        <!--  =============================================================================FIN PRECIO DEL PRODUCTO.. ya no se usa===============================================================-->
                        <!--  =============================================================================INVENTARIOS===============================================================-->
                        <div class="box box-default" id="inventory" ng-hide="product.hasVariants">
                            <div class="box-header with-border">
                                <h3 class="box-title">Inventario</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="sku">Sku: <br>(Stock Keep Unit) </label>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input  class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="sku" type="text" ng-model="product.sku" ng-disabled="product.hasVariants || product.autogenerado" ng-required="!product.hasVariants && !product.autogenerado"/>
                                            <span style="color:#dd4b39;" ng-show="productCreateForm.sku.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" ng-model="product.autogenerado"> Autogenerado
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="variantes">¿Desea seguir el stock del Producto?</label>
                                    <input type="checkbox" name="trackeo" ng-model="product.track" ng-checked="product.track" ng-disabled="product.hasVariants"/>

                                    <span class="text-info"> <em> </em></span>

                                    <div class="" ng-show="product.track && !product.hasVariants">

                                        <div class="box-tools">
                                            <div class="input-group" style="width: 150px;">
                                                <input type="text" style="text-transform: uppercase" name="table_search" class="form-control input-sm pull-right" placeholder="Search" ng-model="query">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                                                                                <span ng-repeat="row in warehouses | filter:query">
                                                                                                <div class="col-md-5">
                                                                                                    <div class="form-group" >
                                                                                                        <label for=""></label>
                                                                                                        <h5>@{{ row.nombre }}</h5>
                                                                                                        <input type="text" class="hidden" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="product.stock[$index].warehouse_id" ng-init="product.stock[$index].warehouse_id = row.id"/>

                                                                                                    </div></div>

                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Stock Actual</label>
                                                                                                        <input type="number" class="form-control" name="markup" ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="product.stock[$index].stockActual" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Stock Mínimo</label>
                                                                                                        <input type="number" class="form-control" name="markup"  ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="product.stock[$index].stockMin" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2">
                                                                                                    <div class="form-group" >
                                                                                                        <label for="suppPric">Costo Mínimo</label>
                                                                                                        <input type="number" class="form-control" name="markup"  ng-attr-min="@{{minNumber}}" string-to-number placeholder="0.00"  ng-model="product.stock[$index].stockMinSoles" ng-disabled="product.hasVariants || !product.track" step="0.1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                 </span>


                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="overlay" ng-class="{ 'hidden': !product.hasVariants}">
                            </div>
                        </div>
                        <!--  =============================================================================FIN INVENTARIO===============================================================-->
                        <script>
                            $("#variants").activateBox();
                            $("#price").activateBox();
                            $("#inventory").activateBox();
                        </script>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button id="btn_generate" data-loading-text="Enviando.." type="submit" class="btn btn-primary" ng-click="updateProduct()">Editar</button>
                        <a href="/products" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div><!-- /.box -->

        </div>
    </div><!-- /.row -->
</section><!-- /.content -->



<!-- =============================Modal de Presentacion ================================ -->

<div class="modal fade bs-example-modal-sm" id="presentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Añadir Presentación</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <select name="" ng-click="selectPres()" style="text-transform: uppercase" class="form-control" id="" ng-model="presentationSelect" ng-options="item as item.nombre+' / '+item.shortname+' / '+item.cant for item in presentations">
                                <option value="">-- Elige Presentación--</option>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control hidden" name="presentation.nombre" ng-model="presentation.nombre" ng-disabled="product.hasVariants">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Compra</label>
                            <input type="number" class="form-control" name="suppPric1" placeholder="0.00" ng-model="presentation.suppPri" ng-disabled="product.hasVariants"  ng-blur="calculateSuppPric()" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" > <label for="suppPric">% de Ganancia</label> <input type="number" class="form-control" name="markup1" placeholder="0.00" ng-model="presentation.markup" ng-blur="calculateMarkup()" ng-disabled="product.hasVariants" step="0.1">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Precio de Venta</label>
                            <input type="number" class="form-control" name="price1" placeholder="0.00" ng-model="presentation.price" ng-blur="calculatePrice()" ng-disabled="product.hasVariants" step="0.1">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click="AddPres()" data-dismiss="modal">Grabar Cambios</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->

<!-- =============================Modal CREATE de Presentacion ================================ -->

<div class="modal fade bs-example-modal-sm" id="createpresentation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Crear Presentación</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" class="form-control" name="preAdd.preBase_id" ng-model="product.presentation_base">
                        <div class="form-group" >
                            <label for="suppPric">Nombre</label>
                            <input type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="nombre" placeholder="Docena" ng-model="preAdd.nombre">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" > <label for="suppPric">Shortname</label>
                            <input type="text" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="shortname" placeholder="DO12" ng-model="preAdd.shortname">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="suppPric">Equiv (@{{ product.presentation_base_object.nombre }})</label>
                            <input type="number" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" name="equiv" placeholder="12.00" ng-model="preAdd.cant" min="0">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" ng-click="createPres(product.presentation_base)" data-dismiss="modal">Crear</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ======================================================================================== -->

<!-- =============================Modal de Brand ================================ -->
<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Marca</h3>
    </div>
    <div class="modal-body">


        <form name="brandCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ brandCreateForm.nombre.$error.required && brandCreateForm.$submitted || brandCreateForm.nombre.$dirty && brandCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre" placeholder="Nombre" ng-model="brand.nombre" required>
                    <label ng-show="brandCreateForm.$submitted || brandCreateForm.nombre.$dirty && brandCreateForm.nombre.$invalid">
                        <span ng-show="brandCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ brandCreateForm.shortname.$error.required && brandCreateForm.$submitted || brandCreateForm.shortname.$dirty && brandCreateForm.shortname.$invalid]">
                    <label for="shortname">ShortName</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="shortname" placeholder="ShortName" ng-model="brand.shortname" required>
                    <label ng-show="brandCreateForm.$submitted || brandCreateForm.shortname.$dirty && brandCreateForm.shortname.$invalid">
                        <span ng-show="brandCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="notas" placeholder="Descripcion"
                                ng-model="brand.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->

                    </form>



    </div>
    <div class="modal-footer">
        <button id="btn_generateMarca" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createBrand()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelBrand()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Brand ================================ -->

<!-- =============================Modal de Linea ================================ -->
<script type="text/ng-template" id="myModalContent2.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Línea</h3>
    </div>
    <div class="modal-body">


        <form name="TtypeCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ TtypeCreateForm.nombre.$error.required && TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre" ng-model="Ttype.nombre" required>
                    <label ng-show="TtypeCreateForm.$submitted || TtypeCreateForm.nombre.$dirty && TtypeCreateForm.nombre.$invalid">
                        <span ng-show="TtypeCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ TtypeCreateForm.shortname.$error.required && TtypeCreateForm.$submitted || TtypeCreateForm.shortname.$dirty && TtypeCreateForm.shortname.$invalid]">
                    <label for="nombre">ShortName</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="shortname" placeholder="Nombre" ng-model="Ttype.shortname" required>
                    <label ng-show="TtypeCreateForm.$submitted || TtypeCreateForm.shortname.$dirty && TtypeCreateForm.shortname.$invalid">
                        <span ng-show="TtypeCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="descripcion">Descripcion</label>
                      <textarea type="descripcion" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="descripcion" placeholder="Decripcion"
                                ng-model="Ttype.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button id="btn_generateLinea" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createLine()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelLine()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Linea ================================ -->

<!-- =============================Modal de Material ================================ -->
<script type="text/ng-template" id="myModalContent3.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Material</h3>
    </div>
    <div class="modal-body">


        <form name="materialCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.nombre.$error.required && materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre" placeholder="Nombre" ng-model="material.nombre" required>
                    <label ng-show="materialCreateForm.$submitted || materialCreateForm.nombre.$dirty && materialCreateForm.nombre.$invalid">
                        <span ng-show="materialCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ materialCreateForm.shortname.$error.required && materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid]">
                    <label for="shortname">ShortName</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="shortname" placeholder="ShortName" ng-model="material.shortname" required>
                    <label ng-show="materialCreateForm.$submitted || materialCreateForm.shortname.$dirty && materialCreateForm.shortname.$invalid">
                        <span ng-show="materialCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="notas" placeholder="Descripcion"
                                ng-model="material.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="createMaterial()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelMaterial()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Material ================================ -->

<!-- =============================Modal de Material ================================ -->
<script type="text/ng-template" id="myModalContent4.html">
    <div class="modal-header">
        <h3 class="modal-title">Crear Estación</h3>
    </div>
    <div class="modal-body">


        <form name="stationCreateForm" role="form" novalidate>
            <div class="box-body">
                <div class="callout callout-danger" ng-show="errors">
                    <ul>
                        <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                    </ul>
                </div>

                <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.nombre.$error.required && stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid]">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombre" placeholder="Nombre" ng-model="station.nombre" required>
                    <label ng-show="stationCreateForm.$submitted || stationCreateForm.nombre.$dirty && stationCreateForm.nombre.$invalid">
                        <span ng-show="stationCreateForm.nombre.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" ng-class="{true: 'has-error'}[ stationCreateForm.shortname.$error.required && stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid]">
                    <label for="shortname">ShortName</label>
                    <input type="text" class="form-control" style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="shortname" placeholder="ShortName" ng-model="station.shortname" required>
                    <label ng-show="stationCreateForm.$submitted || stationCreateForm.shortname.$dirty && stationCreateForm.shortname.$invalid">
                        <span ng-show="stationCreateForm.shortname.$error.required"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                    </label>
                </div>
                <div class="form-group" >
                    <label for="notas">Descripcion</label>
                      <textarea type="notas" class="form-control"  style="text-transform: uppercase" onkeyup="javascript:this.value=this.value.toUpperCase();" name="notas" placeholder="Descripcion"
                                ng-model="station.descripcion" rows="4" cols="50"></textarea>
                </div>

            </div><!-- /.box-body -->


        </form>



    </div>
    <div class="modal-footer">
        <button id="btn_generateEstacion" data-loading-text="Enviando.." class="btn btn-primary" type="button" ng-click="createStation()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancelStation()">Cancelar</button>
    </div>
</script>
<!-- =============================END Modal de Estación ================================ -->