<div class="container-fluid noPaddingRight">
    <form class="form-registro bs-component" id="formRegEmpresas" role="form" ng-submit="registraPersona()">
      <div class="row m-0">
          <div class="col-lg-4 noPadding filaLogin" style="margin:2% auto">
            <div class="row-picture text-center" style="margin:2% 0 0 0">
                <img class="img img-circle" id="miniatura" src="<?php echo base_url('res/img/logo.png')?>" alt="icon" width="40%" style="margin:auto !important;">
            </div>
            <div style="padding:5%">
                  <div class="row">
                  <div class="col-lg-6">
                        <small for="idPerfil">Tipo de usuario</small>
                        <select name="idPerfil" id="idPerfil" ng-model="idPerfil" class="form-control">
                          <option value="">Seleccione....</option>
                          <option value="3">Suscriptor</option>
                          <option value="4">Usuario</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <small for="matricula">Matrícula</small>
                            <input type="text" class="form-control" placeholder="Matrícula" name="matricula" ng-model="matricula" id="matricula" >
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                        <small for="tipoDocumento">Tipo documento</small>
                        <select name="tipoDocumento" id="tipoDocumento" class="form-control ">
                          <option value="">Seleccione....</option>
                          <?php foreach($tiposDoc as $td){?>
                            <option value="<?php echo $td['idTipoDoc']?>"><?php echo $td['nombreTipoDoc']?></option>
                          <?php }?>
                        </select>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <small for="nroDocumento">Nro de documento</small>
                          <input type="nroDocumento" class="form-control" placeholder="Número de documento" name="nroDocumento" ng-model="nroDocumento" id="nroDocumento" >
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                          <small for="nombre">Nombres</small>
                          <input type="text" class="form-control" placeholder="Ejemplo: Jhon" name="nombre" ng-model="nombre" id="nombre" >
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <small for="apellido">Apellidos</small>
                          <input type="text" class="form-control" placeholder="Ejemplo: Puerto" name="apellido" ng-model="apellido" id="apellido">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                          <small for="email">Correo electrónico</small>
                          <input type="email" class="form-control" placeholder="Ejemplo: Jhonato@gmail.com" name="email" ng-model="email" id="email" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                          <small for="clave">Contraseña</small>
                          <input type="password" class="form-control" placeholder="Contraseña" name="clave" ng-model="clave" id="clave" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <small for="rclave">Confirmar contraseña</small>
                          <input type="password" class="form-control" placeholder="Repetir contraseña" name="rclave" ng-model="rclave" id="rclave" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-12">
                        <div class="checkbox">
                        <label>
                          <input type="checkbox" id="terminos" name="terminos" ng-model="terminos"> <?php echo lang('plh_terminos') ?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                        <center><div class="g-recaptcha" data-sitekey="6Ld2gNwmAAAAAL8zsP4_zHjecUGYbPGusEPkiypp"></div></center><br>
                    </div>
                  </div>

                  
                  <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="<?php echo base_url('login')?>" class="btn btn-danger btn-user ">
                            <strong>REGRESAR</strong>
                        </a>
                        <button type="submit" class="btn btn-primary btn-user ">
                            <strong>CREAR CUENTA</strong>
                        </button>
                    </div>

                  </div>

                  
                    
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url() ?>Inicio/recordarClave">¿Olvidaste tu clave?</a>
                  </div>
                </div>
        </div>
      </div>
  </form>
</div>