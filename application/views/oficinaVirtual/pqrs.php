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
        <?php echo $infoModulo['nombreModulo'] ?>
                <a class=" d-sm-inline-block btn btn-sm btn-primary shadow-sm" ng-click="nuevaPqr()" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-plus"></i> Nueva PQR
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
            <h6 class="m-0 font-weight-bold text-primary">Listado de Pqrs</h6>
        </div>
        <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>DOCUMENTO</th>
                            <th>CONSULTA</th>
                            <th>RADICADO</th>
                            <th>FECHA</th>
                            <th>CONCEPTO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>ESTADO</th>
                            <th>RESPUESTAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($a=0;$a<=100;$a++){?>
                        <tr>
                            <td>12345</td>  
                            <td>Pregunta</td>  
                            <td>674530</td>  
                            <td>2023-03-02</td>  
                            <td>Consulta</td>  
                            <td>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero ipsam praesentium provident quod ratione distinctio illo quasi dolorem. Dignissimos pariatur expedita voluptatibus excepturi explicabo amet magnam, dolor blanditiis. Corporis, saepe?
                            </td> 			 
                            <td>ACTIVA</td> 			 
                            <td>Respuestas</td> 			 
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>