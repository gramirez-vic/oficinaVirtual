 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url()?>">
    <!-- <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-smile-wink"></i>
    </div> -->
    <div class="sidebar-brand-text mx-3">AFROCAUCANA</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url()?>">
        <i class="fas fa-fw fa-home"></i>
        <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<?php foreach($modulos as $modMenu){ ?>
    <!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#modulo<?php echo $modMenu['idPadre']?>"
        aria-expanded="true" aria-controls="modulo<?php $modMenu['idPadre']?>">
        <i class="<?php if($modMenu['icono'] != ""){ echo $modMenu['icono']; }else{ echo '';}?>"></i>
        <span><?php echo ucwords(mb_strtolower($modMenu['nombreModulo']))?></span>
    </a>
    <?php if(count($modMenu['modulos']) > 0){ ?>
        <div id="modulo<?php echo $modMenu['idPadre']?>" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Módulos:</h6>
                <?php foreach($modMenu['modulos'] as $hijos){ ?>
                    <a class="collapse-item" href="<?php echo base_url()?><?php echo $hijos['urlModulo'] ?><?php echo $hijos['idModulo'] ?>" title="<?php echo ucwords($hijos['nombreModulo']) ?>"><i class="<?php if($hijos['icono'] != ""){ echo $hijos['icono']; }else{ echo '';}?>"></i> <?php echo ucwords($hijos['nombreModulo']) ?></a>
                <?php }?>
            </div>
        </div>
    <?php }?>
</li>
<?php } ?>
<hr class="sidebar-divider">
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
<!-- Divider -->



<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="<?php echo base_url()?>res/img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SAMI.</strong> <br>Sistema Administrativo de Multiple Integración</p>
    <a class="btn btn-success btn-sm" target="_blank" href="https://github.com/orugal">Ver desarrollador</a>
</div> -->

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column" ng-controller="oficinaVirtual">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <?php if($_SESSION['project']['info']['idPerfil'] == 2 or $_SESSION['project']['info']['idPerfil'] == 1){?>
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Cargar matrícula..." aria-label="Search" aria-describedby="basic-addon2" id="matriculaCargar" name="matriculaCargar">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" ng-click="cargarMatricula()">
                            <strong>CARGAR</strong>
                        </button>
                    </div>
                </div>
            <?php }else if($_SESSION['project']['info']['idPerfil'] == 3 or $_SESSION['project']['info']['idPerfil'] == 4){?>
                <?php if(count($matriculas) > 0){?>
                    <div class="input-group">
                        <select class="form-control bg-light border-0 small" id="matriculaCargar" name="matriculaCargar">
                            <?php foreach($matriculas as $mat){?>
                                <option value="<?php echo $mat['matricula']?>" <?php if($mat['matricula'] == $_SESSION['matricula']){?>selected<?php }?> ><?php echo $mat['matricula']?></option>
                            <?php }?>
                        </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" ng-click="cargarMatricula()">
                                    <strong>CARGAR</strong>
                                </button>
                            </div>
                    </div>
                <?php }else{?>
                    No hay matrículas relacionadas
                <?php }?>
            <?php }?>
            
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">
                        Alerts Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2019</div>
                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2019</div>
                            $290.29 has been deposited into your account!
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2019</div>
                            Spending Alert: We've noticed unusually high spending for your account.
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
            </li> -->

            <!-- Nav Item - Messages -->
            <!-- <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-envelope fa-fw"></i>
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        Message Center
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                problem I've been having.</div>
                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                alt="...">
                            <div class="status-indicator"></div>
                        </div>
                        <div>
                            <div class="text-truncate">I have the photos that you ordered last month, how
                                would you like them sent to you?</div>
                            <div class="small text-gray-500">Jae Chun · 1d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                alt="...">
                            <div class="status-indicator bg-warning"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Last month's report looks great, I am very happy with
                                the progress so far, keep up the good work!</div>
                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                alt="...">
                            <div class="status-indicator bg-success"></div>
                        </div>
                        <div>
                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                told me that people say this to all dogs, even if they aren't good...</div>
                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                </div>
            </li> -->
            <?php if(isset($_SESSION['matricula'])){?>
                <li>
                    <h5  style="padding-top:24px !important">
                        Matrícula: <?php echo $_SESSION['matricula']?>
                    </h5>
                </li>
            <?php }?>
            <div class="topbar-divider d-none d-sm-block"></div>
                    
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['project']['info']['nombre'] ?>  <?php echo $_SESSION['project']['info']['apellido'] ?></span>
                    <!-- <img class="img-profile rounded-circle" src="<?php echo base_url()?>res/fotos/personas/<?php echo $_SESSION['project']['info']['idPersona']?>/<?php echo $_SESSION['project']['info']['icono']?>"> -->
                    <i class="fa fa-user"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="<?php echo base_url()?>PerfilUsuario/datosUsuario">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                    </a> -->
                    <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="<?php echo base_url()?>Login/logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar sesión
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->


        