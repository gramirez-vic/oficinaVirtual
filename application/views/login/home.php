<div class="container-fluid noPaddingRight">
    <div class="row m-0">
        <div class="col-lg-3 noPadding filaLogin" style="margin:10% auto">
            <div class="p-5">
                <div class="row-picture text-center" style="margin:0% 0 0 0">
                    <!-- <h1 class="h4 text-gray-900 mb-4"><strong>OFICINA VIRTUAL</strong></h1> -->
                    <img class="img img-circle" id="miniatura" src="<?php echo base_url('res/img/logo.png')?>" alt="icon" width="80%" style="margin:auto !important;"><br><br>
                </div>
                <form class="user" id="formLogin" ng-submit="loginInApp()">
                    <div class="form-group">
                        <input type="email" ng-change="getPicture()" class="form-control " aria-describedby="emailHelp" placeholder="Correo electrónico" name="usuario" ng-model="usuario" id="usuario" >
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control " placeholder="Contraseña" name="clave" ng-model="clave" id="clave">
                    </div>
                    <!-- <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Remember
                                Me</label>
                        </div>
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        <strong><?php echo lang("labelBtnLogin") ?></strong>
                    </button>
                    <a href="<?php echo base_url('registro/registroPersonas')?>" class="btn btn-danger btn-user btn-block">
                        <strong>REGÍSTRATE GRATIS</strong>
                   </a>
                    <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="<?php echo base_url() ?>Inicio/recordarClave">¿Olvidaste tu clave?</a>
                </div>
            </div>
        </div>
    </div>
</div>