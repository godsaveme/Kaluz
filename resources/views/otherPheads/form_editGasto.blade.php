<setion class="content-header"><h1>
            Gastos Especiales
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/otherPheads">Compras Varios</a> </li>
            <li class="active">Editar</li>
          </ol>


        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Agregar Compras Varios</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form name="stationCreateForm" role="form" novalidate>
                  <div class="box-body">
                  <div class="callout callout-danger" ng-show="errors">
                                                  <ul>
                                              <li ng-repeat="row in errors track by $index"><strong >@{{row}}</strong></li>
                                              </ul>
                                            </div>
                    
                   <div class="row">
                      <div class="col-md-4">
                          <div  class="form-group" ng-class="{true: 'has-error'}[ otherPheadCreateForm.fechaPrevista.$error.required && otherPheadCreateForm.$submitted || otherPheadCreateForm.fechaPrevista.$dirty && otherPheadCreateForm.fechaPrevista.$invalid]">
                               <label for="fechaPrevista">Fecha</label>
                                <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input   type="datetime-local"   class="form-control" name="fechaPrevista" ng-model="otherPhead.fecha" required>
                                   </div>   
                                  <label ng-show="otherPheadCreateForm.$submitted || otherPheadCreateForm.fechaPrevista.$dirty && otherPheadCreateForm.fechaPrevista.$invalid">
                                         <span ng-show="otherPheadCreateForm.fechaPrevista.$invalid"><i class="fa fa-times-circle-o"></i>Fecha Inválida.</span>
                                      </label>
                            
                           </div> 
                          
                      </div>
                       <div class="col-md-4">
                               <div class="form-group">
                                 <label for="proveedor">Empresa o Proveedor</label>
                                 
                                   <input type="text" name="proveedor" ng-model="otherPhead.proveedor" class="form-control">
                               
                               </div>
                           </div>
                         <div class="col-md-4">
                               <div class="form-group">
                                 <label for="direccion">Direccion</label>
                                 
                                   <input type="text" name="direccion" ng-model="otherPhead.direccion" class="form-control">
                               
                               </div>
                           </div>
                   </div>
                    <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                 <label for="ruc">Ruc</label>
                                 
                                   <input type="text" name="ruc" ng-model="otherPhead.ruc" class="form-control">
                               
                               </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                 <label for="numeroDocumento">Numero de Documento F/B</label>
                                 
                                   <input type="text" name="numeroDocumento" ng-model="otherPhead.numeroDocumento" class="form-control">
                               
                               </div>
                            </div>
                             <div class="col-md-2">
                                <div class="form-group">
                                 <label for="serie">Numero de Serie</label>
                                 
                                   <input type="text" name="serie" ng-model="otherPhead.serie" class="form-control">
                               
                               </div>
                            </div>
                             <div class="col-md-3">
               <div class="form-group" >
                <label for="tipo">Tipo documento</label>
                <select class="form-control" ng-model="otherPhead.tipoDoc" >
                        <option value="O">Sin Documento</option>
                        <option value="F">Factura</option>
                        <option value="B">Boleta</option>
                        <option value="T">Tique</option>
                </select>
                <!--@{{variants.varid}}-->
                </div>
          </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-8"><h1>Datos de Detalle de @{{tipomodi}}</h1></div>
                        <div class="col-md-4">
                        <label>Seleccione tipo</label>
                            <select class="form-control" ng-model="tipomodi">
                         <option value="Compra">Compra</option>
                         <option value="Gasto">Gasto</option>
                    </select>
                        </div>
                    </div>
                    <hr>
                    <form  name="otherPdetailCreateForm" role="form" novalidate>
                    
                  
                   <!--gg----------------Gastos----------------------yy-->
                    
                    <div  class="row">
                             
                             <div class="col-md-4">
                                 <div class="form-group">
                                 <label for="descripcion">Descripcion</label>
                                 
                                   <textarea class="form-control" name="descripcion" ng-model="otherPdetail.detalle" rows="1" required></textarea> 
                               
                               </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                 <label for="preciounitario">Cuenta</label>
                                     <select class="form-control" ng-model="otherPdetail.acount_id" ng-options="item.id as item.nombre for item in cashMotives">
                                       <option value="">--Seleccione una Cuenta--</option>
                                     </select>
                                   
                               </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="form-group">
                                 <label for="subtotal">Subtotal</label>
                                 
                                   <input type="number" name="subtotal" ng-model="otherPdetail.total" class="form-control" required>
                               
                               </div>
                             </div>
                             <div class="col-md-2">
                                 <div class="form-group">
                                 <label for="fechaPrevista"></label><br>
                                 
                                   <input type="submit" ng-click="llenarDetalles2()" class="btn btn-info" value="Agregar Detalle">
                               
                               </div>
                             </div>
                    </div>
                   </form>
                   <!-----------------Fin Gastos-------------->
                    

                       <div class="row">
                      <div class="col-md-12">
                      <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                          <thead>
                            <th>Detalle</th>
                            <th>cashmotive_id</th>
                            <th>IGV</th>
                            <th>Total</th>
                          </thead>
                          <tbody>
                            <tr ng-repeat="row in otherPdetails">
                              <td>@{{row.detalle}}</td>
                              <td>@{{row.nomCuenta}}</td>
                              <td>S/.@{{row.igv}}</td>
                              <td>S/.@{{row.total}}</td>
                              <td><button type="button" class="btn btn-danger btn-xs"  ng-click="sacarRow2($index,row.PrecioFinal)">
                        <span class="glyphicon glyphicon-trash"></span></button></td>
                            </tr>
                          </tbody>
                        </table></div>
                        </div>
                      </div>

                     
                    <div  class="row">
                            <div class="col-md-9">
                                 <div class="form-group">
                                 <label for="fechaPrevista"></label><br>
                                 
                                   <input type="submit" ng-click="llenarDetalles()" class="btn btn-success" value="Comprobar igv">
                               
                               </div>                             
                            </div>
                             <div class="col-md-3">
                               <div class="form-group">
                                 <label for="fechaPrevista">Monto Total</label>
                                 
                                   <input type="number" ng-blur="calcMontosFinales2()" name="MontoTotal" ng-model="otherPhead.MontoTotal" class="form-control">
                               
                               </div>
                            </div>
                    </div>
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" ng-click="updateGastos()">Crear</button>
                    <a href="/otherPheads" class="btn btn-danger">Cancelar</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.r-->
              </section>