<style>
.custom-radio {
    position: relative;
    padding: 10px 20px;
    cursor: pointer;
    width: 150px;
    height: 150px;
    margin-left: 10px;
}

.custom-radio input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.custom-radio:hover,
.custom-radio.active {
    background-color: blue;
    color: white;
}

.custom-radio input:checked + span::before {
    content: '\2022'; /* Unicode bullet character */
    font-size: 24px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.custom-radio span {
    display: flex; /* Agregado */
    align-items: center; /* Agregado */
    justify-content: center; /* Agregado */
    flex-grow: 1; /* Agregado para que el texto ocupe todo el espacio disponible */
}
</style>


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
        <?php echo $titulo ?>
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
            <li class="breadcrumb-item active" aria-current="page">Nueva Pqr</li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <h2 style="display:blok; margin:auto; margin-top:auto; margin-top:5%;">Selecciona el tipo de PQR que desea enviar.</h2>
        <form action="" id="formPQR" ng-submit="crearPQR()">
            
            <div class="mt-2 btn-group-toggle" data-toggle="buttons" style="display: flex; justify-content: center; text-align: center; margin: auto;">    
                <label class="btn btn-outline-primary custom-radio">
                    <i class="fas fa-envelope"></i><br>
                    <input type="radio" name="gender" value="6" data-tipo="2" data-tramite="6" autocomplete="off"> Peticion
                </label>

                <label class="btn btn-outline-primary custom-radio">
                    <i class="fas fa-quote-left"></i> <i class="fas fa-quote-right" style="margin-left:20px;"></i><br>
                    <input type="radio" name="gender" value="2" data-tipo="1" data-tramite="2" autocomplete="off"> Queja
                </label>

                <label class="btn btn-outline-primary custom-radio">
                    <i class="fas fa-comments"></i><br>
                    <input type="radio" name="gender" value="1" data-tipo="1" data-tramite="1" autocomplete="off"> Reclamo
                </label>

                <label class="btn btn-outline-primary custom-radio">
                    <i class="fas fa-ellipsis-h"></i><br>
                    <input type="radio" name="gender" value="5" data-tipo="1" data-tramite="5" autocomplete="off"> Recurso
                </label>
            </div>
            
            <div class="col-md-12 pt-4" style="height: 100px;">
                <div class="col-md-4 float-left p-4">
                    <p class="float-left">Servicio</p> 
                    <label class="btn btn-outline-primary float-left ml-2">
                        <input type="radio" value="1" id="sa"> Acueducto
                    </label>
                    <label class="btn btn-outline-primary float-left ml-2">
                        <input type="radio" value="2" id="se"> Alcantarillado
                    </label>
                </div>
                <div class="col-md-4 float-left">
                    <div class="form-group">
                        <label for="matricula">Matrícula</label>
                        <input type="number" class="form-control" id="matricula" placeholder="100000">
                    </div>
                </div>
                <div class="col-md-4 float-left">
                    <div class="form-group">
                        <label for="Factura">Factura No.</label>
                        <input  class="form-control" id="Factura" placeholder="101010 - 1">
                    </div>
                    
                </div>
            </div>

            <div class="col-md-12 float-left" style="height: 100px;">
                <div class="form-row">
                    <div class="col-md-4 float-left ml-2">
                        <div class="form-group">
                            <label for="documento">Documento</label>
                            <input class="form-control" id="documento">
                        </div>
                    </div>
                    <div class="col-md-4 float-left">
                        <div class="form-group">
                            <label for="correoElectronico">Email</label>
                            <input type="email" class="form-control" id="correoElectronico">
                        </div>
                    </div>
                    <div class="col-md- float-left">
                        ¿Autoriza Notificación por correo electrónico?
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3 float-left">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input class="form-control" id="nombre">
                    </div>
                </div>
                <div class="col-md-3 float-left">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input class="form-control" id="direccion" >
                        <small id="emailHelp" class="form-text text-muted">Dirección de entrega del documento</small>
                    </div>
                </div>
                <div class="col-md-3 float-left">
                    <div class="form-group">
                        <label for="telefono">Teléfono Fijo</label>
                        <input class="form-control" id="telefono">                    
                    </div>
                </div>
                <div class="col-md-3 float-left">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="email" class="form-control" id="celular">
                    
                    </div>
                </div>
            </div>
            <div class="col-md-12 float-left">
                <div class="col-md-2 float-left">Concepto:</div>
                <div class="col-md-10 float-left">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php foreach($conceptosDeReclamacion as $conceptos){?>
                            <option value="<?php echo $conceptos["idConcepto"]?>"><?php echo $conceptos["nombreConcepto"]?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 float-left">
                <div class="col-md-2 float-left">Descripción:</div>
                <div class="col-md-10 float-left">
                <textarea class="form-control" id="descripcion" rows="3"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-2 float-left">Adjuntos</div>
                <div class="col-md-10 float-left">
                    <div class="form-group">
                        <label for="documentosAdjuntos">Agregar Documentos</label>
                        <input type="file" class="form-control-file" id="documentosAdjuntos">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-outline-primary">Enviar</button>
            </div>               
                           
        </form>
    </div>

</div>