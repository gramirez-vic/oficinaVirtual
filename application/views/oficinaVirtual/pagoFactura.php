<div class="container-fluid" ng-controller="oficinaVirtual" id="contenedorFactura">
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
        Pago en línea
    </h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color:transparent !important">
            <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
        </ol>
    </nav>
    <!-- fin cabecera-->


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary w-75 float-left">Pago de factura</h6>
        </div>
        <div class="card-body">
            <div class="ml-4 mr-4 alert alert-primary" role="alert">
                <strong>Atención</strong>
                <ul>
                    <li> Podrá hacer el pago en línea mediante el servicio WOMPI vía PSE o con tarjetas: Visa, MasterCard ó Amex.</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="col-md-3 float-left"></div>
                <div class="col-md-6 float-left">
                    <form  method="post" id="formConsultar" ng-submit="solicitudConsultarMatricula()">
                        <div class="form-group">
                            <label for="matricula">Número de Matricula:</label>
                            <input type="number" class="form-control" id="matricula" name="matricula">
                            <small class="form-text text-muted">Se encuentra como MATRICULA en la información en la factura de Afrocaucana de Aguas.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Consultar</button>
                    </form>
                </div>

                <div class="col-md-3 float-left"></div>
            </div>
        </div>
    </div>

</div>