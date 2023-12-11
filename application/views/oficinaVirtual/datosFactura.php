<div class="container-fluid" ng-controller="oficinaVirtual" ng-init="initFactura()" id="contenedorFactura">
    <!-- modal estandar-->
    <div id="modalUsuarios" class="modal fade" role="dialog"  data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content" id="modalCrea">
                <!--Form de creación -->
            </div>
        </div>
    </div>
    <!-- cabecera de la plantilla-->
    <h1 class="h3 mb-4 text-gray-800">
        <?php echo $infoModulo['nombreModulo']." - ".$titulo; ?>
                <!-- <a href="<?php echo base_url()?>OficinaVirtual/descargarFactura/<?php echo $infoFacturaCargada['vigencia']?>" class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm " target="_bank">
                    <i class="fa fa-download"></i> Descargar factura
                </a> -->
        <!-- <?php if(getPrivilegios()[0]['crear'] == 1){ ?>
            <div class="dropdown">
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i> <?php echo lang("lblAcciones") ?> <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <h6 class="dropdown-header"><?php echo lang("lblSeleccioneOpc") ?></h6>
                    <a class="dropdown-item" ng-click="cargaPlantillaControl('',0)" style="cursor:pointer"><i class="fa fa-fw fa-plus"></i> NUEVO USUARIO</a>
                </div>
            </div>
        <?php } ?> -->
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Factura a pagar</li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detalle de la fatura</h6>
        </div>
        <div class="card-body">
            <form method="post" id="dataPago" ng-submit="PagoFactura()">
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Matricula</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['matricula']?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Suscriptor</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['nombreSuscriptor']?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Direccion</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['direccion']?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Ciudad</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['nombreCiudad']?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Factura</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['numeroFactura']?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Fecha de Vencimiento</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo date("Y-m-d",strtotime($infoFacturaCargada['fecVen1']))?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Periodo Consumo	</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['periodoDeConsumo']?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Facturas Adeudadas</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['facturasAdeudadas']?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Lectura Anterior</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['lecturaAnterior']?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Lectura Actual</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        <?php echo $infoFacturaCargada['lecturaActual']?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Valor Deuda	</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        $<?php echo number_format($infoFacturaCargada['valorMora'], 0, ',', '.')?>
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Valor Financiado</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        $<?php echo number_format($infoFacturaCargada['valorFinanciado'], 0, ',', '.')?>	
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 text-left">
                        <strong>Valor Mes</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        $<?php echo number_format($infoFacturaCargada['valorCorriente'], 0, ',', '.')?>	
                            
                    </div>

                    <div class="col-lg-3 text-left">
                        <strong>Total a Pagar</strong>
                    </div>
                    <div class="col-lg-3 text-left">
                        $<?php echo  number_format($infoFacturaCargada['totalAPagar'], 0, ',', '.')?>
                    </div>
                    <input type="hidden" id="codigoPago" name="codigoPago" value="<?php echo $referencia;?>" />
                    <input type="hidden" id="totalAPagar" name="totalAPagar" value="<?php echo $infoFacturaCargada['totalAPagar'];?>" />
                    <input type="hidden" id="matricula" name="matricula" value="<?php echo $infoFacturaCargada['matricula'];?>" />
                    <input type="hidden" id="numeroFactura" name="numeroFactura" value="<?php echo $infoFacturaCargada['numeroFactura']."-1";?>" />
                    <div class="col-lg-3 text-left mt-4">
                        <div class="form-group">    
                            <input type="submit" value="PagoFactura" class="btn btn-primary">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</div>