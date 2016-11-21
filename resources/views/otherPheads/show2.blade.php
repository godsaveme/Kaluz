<section class="content-header">
          <h1>
            Pago de Compras 
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/otherPheads"><i class="fa fa-dashboard"></i>Compras Varios</a></li>
          </ol>

          
        </section>

        <section class="content">
        <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
                
                <form name="otherPheadCreateForm" role="form" >
                  
      <div class="box-body">
      <div class="row">
          <div class="col-md-4">
                <label>Numero Documento</label>
                <input ng-disabled="true" type="text" class="form-control" ng-model="otherPhead.documento">
           </div>
           <div class="col-md-4">
                <label>Proveedor</label>
                <input ng-disabled="true" type="text" class="form-control" ng-model="otherPhead. proveedor">
           </div>
           <div class="col-md-2">
                <label>Monto Deuda</label>
                <input ng-disabled="true" type="number" class="form-control" ng-model="otherPhead.MontoTotal">
           </div>
           <div class="col-md-2">
                <label>Saldo</label>
                <input ng-disabled="true" type="number" class="form-control" ng-model="otherPhead.saldo">
           </div>
    </div><br>
<div class="row">

     <div ng-enabled="otherPhead.Saldo>0" class="col-md-7" align="center">
     

     <div class="row">
           <div class="col-md-12">
                 <div  class="form-group" >
                      <b>Agrega Pago</b>
                 </div>
                  <div class="box-body table-responsive no-padding">
                 <table class="table table-striped" >
                    <tr>
                      <th style="width: 100px">Fecha</th>
                      <th style="width: 200px">Elija Caja</th>
                      <th style="width: 150px" ng-disabled="detotherPhead.methodotherPhead_id>0 || detotherPhead.cashe_id>0 || otherPhead.cajamensual==true">Monto Pagado</th>
                    </tr>
                <tr >
                <td >

                               <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  type="date"   class="form-control" name="fecha" ng-model="pagos.fecha" required>
                                   </div>   
                                
                     
              </td>
              <td >
               <div  >
                <div class="form-group" ng-class="{true: 'has-error'}[ otherPheadCreateForm.warehouse.$error.required && otherPheadCreateForm.$submitted || otherPheadCreateForm.warehouse.$dirty && otherPheadCreateForm.warehouse.$invalid]">
                     
                       <select  ng-disabled="pagos.cajamensual==true" ng-change="TraerSales(pagos.cashe_id)" class="form-control" name="warehouse"  ng-model="pagos.cashe_id" ng-options="item.cashID as item.nombre for item in cashHeaders">
                       <option value="">--Elija Caja--</option>
                       </select>
                       <label ng-show="otherPheadCreateForm.$submitted || otherPheadCreateForm.warehouse.$dirty && otherPheadCreateForm.warehouse.$invalid">
                                <span ng-show="otherPheadCreateForm.warehouse.$invalid"><i class="fa fa-times-circle-o"></i>Requerido.</span>
                </label>
                </div>
                <label>@{{pagos.montoUsable}}</label>
            </div>
                 
              </td>
              <td>
                     <div class="form-group" ng-class="{true: 'has-error'}[ otherPheadCreateForm.montoPagando.$error.required && otherPheadCreateForm.$submitted || otherPheadCreateForm.montoPagando.$dirty && otherPheadCreateForm.montoPagando.$invalid]" >
                       <input ng-disabled="pagos.cajamensual!=true && pagos.cashe_id==null" type="number" class="form-control" ng-model='pagos.monto' ng-blur='validad()' name="montoPagando" placeholder="0.00"  min='0' step="0.1" required>
                      
                     </div>

              </td>
              </tr>
            </table>
            </div>
          </div>
        </div>
        <div class="row">
             
            
             <div   class="form-group" >                            
                            <input ng-disabled="pagos.cashe_id!=null" type="checkbox"   name="variantes" ng-click="limpiar()" ng-model="pagos.cajamensual" />
                            <span class="text-info"> <em>Pagar con caja mensual</em></span>
                        </div>
        
         <!-- <div ng-show="otherPhead.cajamensual" class="col-md-5">
                   <em>Descripcion .</em>
                   <div class="form-group" >
                        <textarea ng-model="otherPhead.descripcion" class="form-control input-lg">
                         </textarea>
                    </div>
        </div>-->
         
        </div>
      </div>
        

        <div class="col-md-5" align="center">
            <div class="form-group">
              <b>Pagos Realizados</b>
              </div>
            <div class="box-body table-responsive no-padding">
            <table class="table table-striped" >
                <thead style="display: block;">
                    <tr>
                      <th Style="width:47%;">Fecha</th>
                     
                      <th Style="width:20%;">Pago Con</th>
                      <th>Monto</th>
                    </tr>
                 </thead>
                 <tbody style="display: block; width:auto; height: 200px; overflow-x: auto;">  
                    <tr ng-repeat="row in listpagos">

                      <td style="width:50%;">@{{row.fecha}}</td>
                      <td>@{{row.tipo}}</td>
                      <td>S/.@{{row.monto}}</td>
                     <td><button ng-disabled="otherPhead.saldo==0" type="button" class="btn btn-danger btn-xs"  ng-click="destroyPagos2(row)">
                        <span class="glyphicon glyphicon-trash"></span></button>
                    </tr>
                
                </tbody>
                   </table>
                   </div> 
            </div>
      </div>
            <div >
                    <button ng-disabled="otherPhead.saldo==0" class=" label-default" type='submit' ng-click='createPagos2()' >Registrar Pago</button>  
                     <button class=" label-danger"  ng-click='cancelCreatePago()'>Cancelar</button>  
            
            </div>
        </div>
     
             
                   <div class="box-footer">
                    <a href="/services" class="btn btn-danger">Salir</a>
                  </div>
                </form>
              </div><!-- /.box -->

              </div>
              </div><!-- /.row -->
              </section><!-- /.content -->