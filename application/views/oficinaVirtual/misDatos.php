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
        <?php echo $nombreModulo ?>
                <!-- <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm " id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <li class="breadcrumb-item active" aria-current="page"><?php echo $nombreModulo ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
        </div>
        <div class="card-body">
            <div class="table-reponsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Matrícula</th>
                            <td><?php echo $Dato["matricula"];?></td>
                            <th scope="row">Tipo</th>
                            <td><?php echo $Dato["nombrePerfil"];?></td>
                        </tr>
                        <tr>
                            <th scope="row">Documento</th>
                            <td><?php echo $Dato["nroDocumento"];?></td>
                            <th scope="row">Nombres</th>
                            <td><?php echo $Dato["nombre"];?></td>
                        </tr>
                        <tr>
                            <th scope="row">Apellidos</th>
                            <td><?php echo $Dato["apellido"];?></td>
                            <th scope="row">Dirección</th>
                            <td><?php echo $Dato["direccion"];?></td>
                        </tr>
                        <tr>
                            <th scope="row">Celular</th>
                            <td><?php echo $Dato["celular"];?></td>
                            <th scope="row">Email</th>
                            <td><?php echo $Dato["email"];?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>