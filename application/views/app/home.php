<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bienvenido <small> <?php echo $_SESSION['project']['info']['nombre'] ?> <?php echo $_SESSION['project']['info']['apellido'] ?></small></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Estado de Cuenta</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Detalles de tu(s) cuenta(s)y factura(s)</div>
                        <a href="<?php echo base_url('OficinaVirtual/factura/41')?>" class="btn btn-primary"><i class="fa fa-list"></i> Ver detalles</a>
                        <a href="<?php echo base_url('OficinaVirtual/pagarFactura/41')?>" class="btn btn-success"><i class="fa fa-list"></i> Pagar factura</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Pagos</div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Consulta el histórico de pagos</div>
                        <a href="<?php echo base_url('OficinaVirtual/historicoPagos/42')?>" class="btn btn-primary"><i class="fa fa-list"></i> Ver pagos</a>
                        <a href="<?php echo base_url('OficinaVirtual/PagarFactura/48')?>" class="btn btn-success"><i class="fa fa-list"></i> Realizar pagos</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">PQRs</div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Consulta tus PQRs o Radica una nueva</div>
                        <a href="<?php echo base_url('OficinaVirtual/pqrs/43')?>" class="btn btn-primary"><i class="fa fa-list"></i> Mis PQRS</a>
                        <a href="<?php echo base_url('OficinaVirtual/nuevaPqrs/43')?>" class="btn btn-success"><i class="fa fa-list"></i> Enviar PQR</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Usuario</div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Datos de tu cuenta en Oficina Virtual</div>
                        <a href="<?php echo base_url('OficinaVirtual/misDatos/43')?>" class="btn btn-primary"><i class="fa fa-list"></i> Mis datos</a>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



<!-- Content Row -->



</div>
<!-- /.container-fluid -->