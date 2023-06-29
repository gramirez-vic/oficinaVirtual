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
        <?php echo $infoModulo['nombreModulo'] ?> - Estado de cuenta
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-download"></i> Descargar factura
                </a>
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
            <li class="breadcrumb-item active" aria-current="page"><?php echo $infoModulo['nombreModulo'] ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detalle de la fatura</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Matricula</strong>
                </div>
                <div class="col-lg-3 text-left">
                    12345
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Suscriptor</strong>
                </div>
                <div class="col-lg-3 text-left">
                    AFROCAUCANA DE AGUAS ESP
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Direccion</strong>
                </div>
                <div class="col-lg-3 text-left">
                    CL 10 26 91 - EL REPOSO
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Ciudad</strong>
                </div>
                <div class="col-lg-3 text-left">
                HONDA
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Factura</strong>
                </div>
                <div class="col-lg-3 text-left">
                    674530
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Fecha de Vencimiento</strong>
                </div>
                <div class="col-lg-3 text-left">
                    2023-06-15
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Periodo Consumo	</strong>
                </div>
                <div class="col-lg-3 text-left">
                    01 may. 2023 al 31 may. 2023
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Facturas Adeudadas</strong>
                </div>
                <div class="col-lg-3 text-left">
                    1
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Lectura Anterior</strong>
                </div>
                <div class="col-lg-3 text-left">
                    1493
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Lectura Actual</strong>
                </div>
                <div class="col-lg-3 text-left">
                    1507
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Valor Deuda	</strong>
                </div>
                <div class="col-lg-3 text-left">
                    $0	
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Valor Financiado</strong>
                </div>
                <div class="col-lg-3 text-left">
                    $0	
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 text-left">
                    <strong>Valor Mes</strong>
                </div>
                <div class="col-lg-3 text-left">
                    $0	
                </div>

                <div class="col-lg-3 text-left">
                    <strong>Total a Pagar</strong>
                </div>
                <div class="col-lg-3 text-left">
                    $0	
                </div>
            </div>
        </div>
    </div>

</div>