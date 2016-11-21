<section class="content-header">
          <h1>
            Balace Mensual
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/"><i class="fa fa-dashboard"></i>Pagina Pricipal</a></li>
          </ol>

          
        </section>

    <section class="content">
        <div class="box box-primary" >
                             <div class="box-header with-border">
                                   <h3 class="box-title">Datos total de Balance</h3>
                             </div>
        <form name="balanceCreateForm" role="form" novalidate>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                                  <label>Fecha Inicio</label>
                                  <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  type="date"   class="form-control" name="fecha" ng-model="pagos.fecha1" required>
                                   </div>   
            </div>
             <div class="col-md-5">
                                  <label>Fecha Fin</label>
                                  <div  class="input-group">
                                        <div class="input-group-addon">
                                              <i class="fa fa-calendar"></i>
                                        </div>
                                      <input  type="date"   class="form-control" name="fecha" ng-model="pagos.fecha2" required>
                                   </div>   
            </div>
        </div><br>
        <div class="row">
              <div class="col-md-1"></div>
            <div class="col-md-5">
              <button type="button" class="btn btn-info" ng-click="consultarBalance()">Consultar Datos</button>
            </div>
        </div>
        <br>
         <div class="row">

              <div class="col-md-1"></div>
              <div class="col-md-10">
              <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Descripcion</th>
                      <th>total Monto Pagado</th>
                      <th>total Monto Pendiente</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <th>Compras Productos</th>
                        <td>S/.@{{Compras.totalPaga}}</td>
                        <td>S/.@{{Compras.totSaldo}}</td>
                    </tr>
                    <tr>
                        <th>Compras Varios</th>
                        <td>S/.@{{CajaMensual.total}}</td>
                        <td>S/.@{{OtrasCompras.saldos}}</td>
                    </tr>
                    <tr>
                        <th>Ventas Totales</th>
                        <td>S/.@{{CjaDiraria.totVenta}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Ventas Facturado</th>
                        <td>S/.@{{VentasFactu.TotalVentasFacturado}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Reembolso</th>
                        <td>S/.@{{CjaDiraria.totReembolso}}</td>
                        <td>----</td>
                    </tr>
                     <tr>
                        <th>Adelanto Servicios</th>
                        <td>S/.@{{CjaDiraria.totAdelantoServicio}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Prestamos</th>
                        <td>S/.@{{CjaDiraria.totPrestamos}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Ingresos Varios</th>
                        <td>S/.@{{CjaDiraria.totIngresosVarios}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Devoluciones</th>
                        <td>S/.@{{CjaDiraria.totDevoluciones}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Adelanto al Personal</th>
                        <td>S/.@{{CjaDiraria.totAdelantoPersonal}}</td>
                        <td>----</td>
                    </tr>
                    <tr>
                        <th>Viaticos</th>
                        <td>S/.@{{CjaDiraria.totViaticos}}</td>
                        <td>----</td>
                    </tr>
                  </tbody>
                </table>
                </div>
              </div>
        </div> 
     
             
                   <div class="box-footer">
                    <a href="/otherPheads" class="btn btn-danger">Salir</a>
                  </div>
        </form>
              </div>
          </section>