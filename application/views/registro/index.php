<!--                                                    
     ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
-->
<!DOCTYPE html>
<html ng-app="projectRegistro">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Sistema de administración de multiple integración">
		<meta name="author" content="Wannabe Digital">
		<title><?php echo $titulo ?></title>
		<!-- Custom fonts for this template-->
		<link href="<?php echo base_url()?>res/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<!-- Custom styles for this template-->
		<link href="<?php echo base_url()?>res/css/sb-admin-2.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
			<link rel="stylesheet" href="<?php echo base_url()?>res/css/login/login.css?<?php echo rand(1,1000)?>" />
	</head>
	<body ng-controller="registroEmpresas" class="bg-gradient-primary fondo-login" ng-init="registroInit()">
		<?php $this->load->view($centro);?>


		<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-2.1.4.min.js"></script>
		<!--<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-ui-1.10.3.custom.js"></script>-->
		<script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/registro/controller.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/material.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/ripples.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/snackbar.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>res/js/validator.js"></script>
		
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<script type="text/javascript">
			var configLogin =  {
			    apiUrl: '<?php echo base_url()?>'
			}
			 $.material.init();
		</script>

		
	</body>
</html>