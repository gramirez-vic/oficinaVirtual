<div class="container-fluid" ng-controller="oficinaVirtual" ng-init="initAsociaMatricula()" id="contenedorFactura">
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
    Solicitud de asociación de Matrícula a Cuenta
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
            <li class="breadcrumb-item active" aria-current="page"><?php echo $infoModulo['nombreModulo'] ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulario de solicitud</h6>
        </div>
        <div class="card-body">
            <form method="post" id="formSolicitud" ng-submit="solicitudAsociarMatricula()">
                <div class="row">
                    <div class="col-lg-12">
                        A continuación complete los datos de su solicitud<br><br>
                        <div class="alert alert-primary" role="alert">
                            <strong>Atención</strong>
                            <ul>
                                <li> Si desea cambiar la matrícula actual por una nueva seleccione 'Cambiar Matricula Actual'.</li>
                                <li> Si desea asociar una matrícula adicional selecccione 'Agregar Matricula'.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><strong>Tipo de Solicitud</strong><br><br></div>
                    <div class="col-lg-2">
                        <div class="form-group">    
                            <label >
                                <input type="radio" name="tipoSolicitud" value="agregar" ng-click="decideMatricula()">
                                Agregar Matricula
                            </label>
                        </div>    
                    </div>    
                    <div class="col-lg-2">
                        <div class="form-group">    
                            <label >
                                <input type="radio" name="tipoSolicitud" value="cambio" ng-click="decideMatricula()">
                                Cambiar Matricula Actual
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">    
                            <label>Correo electrónico</label>
                            <input type="text" class="form-control" name="email" id="email" readonly value="<?php echo $_SESSION['project']['info']['email']?>">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">    
                            <label>Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">    
                            <label>Nueva matrícula</label>
                            <input type="text" class="form-control" name="matricula" id="matricula">
                        </div>
                    </div>
                    <?php if(isset($_SESSION['matricula'])){?>
                        <div class="col-lg-3">
                            <div class="form-group">    
                                <label>Matrícula Actual <span class="badge badge-danger" style="display:none" id="alertaMatricula" title="Si esta no es la matrícula que desea cambiar, seleccione otra en la parte superior">Esta matrícula cambiará</span></label>
                                <h2><?php echo $_SESSION['matricula']?></h2>
                            </div>
                        </div>
                    <?php }?>
                    <div class="col-lg-12">
                        <div class="form-group">    
                            <label>Observación</label>
                            <textarea type="text" class="form-control" name="observacion" id="observacion"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <div class="form-group">    
                        <input type="submit" value="ENVIAR SOLICITUD" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>