<div class="container-fluid" ng-controller="oficinaVirtual" ng-init="initSolicitudes()" id="contenedorFactura">
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
        Listado de solicitudes
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
            <h6 class="m-0 font-weight-bold text-primary w-75 float-left">Listado de solicitudes</h6> Filtro: 
            <select name="filtro" id="filtro" class="custom-select custom-select-sm form-control form-control-sm float-right" ng-model="filtro" style="width:20%" ng-change="getSolicitudes()">
                <option value="ingresado">Ingresado</option>
                <option value="autorizado">Autorizado</option>
                <option value="rechazado">Rechazado</option>
            </select>
           
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="5%">SOLICITUD</th>
                            <th class="text-center align-middle">DOCUMENTO</th>
                            <th class="text-center align-middle">CLIENTE</th>
                            <th class="text-center align-middle">CLIENTE TIPO</th>
                            <th class="text-center align-middle">MATRÍCULA <br>ACTUAL</th>
                            <th class="text-center align-middle">MATRÍCULA <br>SOLICITUD</th>
                            <th class="text-center align-middle">ESTADO</th>
                            <th class="text-center align-middle">FECHA</th>
                            <th class="text-center align-middle" width="10%">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="sol in solicitudes">
                            <td class="text-center align-middle text-capitalize ">
                                <span class="badge badge-info" ng-if="sol.tipoSolicitud == 'agregar'">{{sol.tipoSolicitud}}</span>
                                <span class="badge badge-primary" ng-if="sol.tipoSolicitud == 'cambio'">{{sol.tipoSolicitud}}</span>
                            </td>
                            <td class="text-center align-middle">{{sol.nroDocumento}}</td>
                            <td class="text-center align-middle">{{sol.nombre}} {{sol.apellido}}</td>
                            <td class="text-center align-middle">{{sol.nombrePerfil}}</td>
                            
                            <td class="text-center align-middle" ng-if="sol.tipoSolicitud == 'cambio'">{{sol.matriculaAfecta}}</td>
                            <td class="text-center align-middle" ng-if="sol.tipoSolicitud == 'agregar'"></td>

                            <td class="text-center align-middle">{{sol.matricula}}</td>

                            <td class="text-center align-middle text-capitalize">
                                <span class="badge badge-secondary" ng-if="sol.estadoMatricula == 'ingresado'">{{sol.estadoMatricula}}</span>
                                <span class="badge badge-success" ng-if="sol.estadoMatricula == 'autorizado'">{{sol.estadoMatricula}}</span>
                                <span class="badge badge-danger" ng-if="sol.estadoMatricula == 'rechazado'">{{sol.estadoMatricula}}</span>
                            </td>

                            <td class="text-center align-middle">{{sol.fechaSolicitud}}</td>
                            <td class="text-center align-middle">
                                <a title="Aprobar" class="btn btn-primary" ng-click="gestionSolicitud('autorizado',sol.matriculaAfecta,sol.matricula,sol.nroDocumento,sol.tipoSolicitud,sol.idSolicitud)"><i class="fa fa-check"></i></a>
                                <a title="Rechazar" class="btn btn-danger" ng-click="gestionSolicitud('rechazado',sol.matriculaAfecta,sol.matricula,sol.nroDocumento,sol.tipoSolicitud,sol.idSolicitud)"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>