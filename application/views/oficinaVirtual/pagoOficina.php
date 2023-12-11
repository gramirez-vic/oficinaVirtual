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
            <h6 class="m-0 font-weight-bold text-primary">Listado de pagos</h6>
        </div>
        <div class="card-body">
            <div class="table-reponsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>FACTURA</th>
                            <th>CODIGO PAGO</th>
                            <th>MATRICULA</th>
                            <th>RECAUDADOR</th>
                            <th>ESTADO PAGO</th>
                            <th>VALOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($PagosOficina as $historico){ ?>
                        <tr>
                            <td><?php echo $historico["fechaPago"]?></td>  
                            <td><?php echo $historico["factura"]?></td>  
                            <td><?php echo $historico["codigoPago"]?></td>  
                            <td><?php echo $historico["matricula"]?></td>  
                            <td><?php echo $historico["entidad"]?></td>  
                            <td>
                                <?php if($historico["estadoPago"] == 0){
                                    echo "INICIADO";
                                }else if($historico["estadoPago"] == 1){
                                    echo "DECLINADO";
                                }else if($historico["estadoPago"] == 2){
                                    echo "ERROR DE PAGO";
                                }else if($historico["estadoPago"] == 3){
                                    echo "APROVADO";
                                }   
                                ?>
                            </td>  
                            <td><?php echo "$ ".number_format($historico["valor"], 0, ',', '.');?></td> 			 
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>