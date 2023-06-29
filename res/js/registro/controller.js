/*
* Controlador que maneja todas las funcionalidades de la zona de registro
* @author Farez Prieto @orugal
* @date 28 de Junio de 2016
*/
project.controller('registroEmpresas', function($scope,$http,$q,constantes)
{
	$scope.registroInit = function()
	{
		$scope.config = configLogin;//configuración global
		$('#formRegEmpresas').validator()

	}
	$scope.getCiudad = function(){
		$scope.departamento = $("#departamento").val();
		var controlador = 	$scope.config.apiUrl+"registro/getCiudades";
		var parametros  = "idDepto="+$scope.departamento;
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.ciudadesSelect	= json;
			$scope.$digest();
		});
	}
	$scope.verificaEmpresa = function()
	{

		var controlador = 	$scope.config.apiUrl+"registro/verificaEmpresaN";
		var parametros  = "palabra="+$scope.nombre;
		constantes.consultaApi(controlador,parametros,function(json){
			if(json.continuar)
			{

			}
		});
	}
	//registra empresas
	$scope.registraEmpresa = function()
	{
		$scope.departamento = $("#departamento").val();
		$scope.ciudad 		= $("#ciudad").val();

		if($scope.nombre == "" || $scope.nombre == undefined)
		{
			constantes.alerta("Atención","El campo nombre de la empresa es requerido","warning",function(){
				setTimeout(function(){$("#nombre").focus()});
			})
		}
		else if($scope.direccion == "" || $scope.direccion == undefined)
		{
			constantes.alerta("Atención","El campo dirección de la empresa es requerido","warning",function(){
				setTimeout(function(){$("#direccion").focus()});
			})
		}
		else if($scope.telefono == "" || $scope.telefono == undefined)
		{
			constantes.alerta("Atención","El campo teléfono de la empresa es requerido y no debe contener letras","warning",function(){
				setTimeout(function(){$("#telefono").focus()});
			})
		}
		else if($scope.telefono != "" && isNaN($scope.telefono))
		{
			constantes.alerta("Atención","El campo teléfono sólo puede contener números","warning",function(){
				setTimeout(function(){$("#telefono").focus()});
			})
		}
		else if($scope.email == "" || $scope.email == undefined)
		{
			constantes.alerta("Atención","El campo correo electrónico de la empresa es requerido y debe ser un correo válido","warning",function(){
				setTimeout(function(){$("#email").focus()});
			})
		}
		else if($scope.email != "" && !constantes.validaMail($scope.email))
		{
			constantes.alerta("Atención","Debe escribir un correo electrónico válido","warning",function(){
				setTimeout(function(){$("#email").focus()});
			})
		}
		else if($scope.departamento == "" || $scope.departamento == undefined)
		{
			constantes.alerta("Atención","Seleccione el departamento donde está ubicada su empresa","warning",function(){
				setTimeout(function(){$("#departamento").focus()});
			})
		}
		else if($scope.ciudad == "" || $scope.ciudad == undefined)
		{
			constantes.alerta("Atención","Seleccione la ciudad donde está ubicada su empresa","warning",function(){
				setTimeout(function(){$("#ciudad").focus()});
			})
		}
		else if($scope.clave == "" || $scope.clave == undefined)
		{
			constantes.alerta("Atención","Escriba una clave para su cuenta","warning",function(){
				setTimeout(function(){$("#clave").focus()});
			})
		}
		else if($scope.rclave == "" || $scope.rclave == undefined)
		{
			constantes.alerta("Atención","Debe volver a escribir la clave de ingresó anteriormente","warning",function(){
				setTimeout(function(){$("#rclave").focus()});
			})
		}
		else if($scope.clave != "" && $scope.rclave != "" && $scope.rclave != $scope.clave)
		{
			constantes.alerta("Atención","Las contraseñas no coinciden, por favor verifique.","warning",function(){
				setTimeout(function(){$("#rclave").focus()});
			})
		}
		else if(!$("#terminos").prop('checked'))
		{
			constantes.alerta("Atención","Debe leer y aceptar los términos y condiciones","warning",function(){
				setTimeout(function(){$("#terminos").focus()});
			})
		}
		else
		{
			constantes.confirmacion("Confirmación!","Los datos que acaba de ingresar son correctos, desea continuar?","info",function(){
				var controlador = $scope.config.apiUrl+"registro/insertaEmpresas";
				var parametros  = $("#formRegEmpresas").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							document.location = $scope.config.apiUrl;
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"error",function(){})
					}
				});
			});
			
		}

	}
	//registra personas
	$scope.registraPersona = function()
	{
		var idPerfil 		= $("#idPerfil").val();
		var matricula 		= $("#matricula").val();
		var tipoDocumento 	= $("#tipoDocumento").val();
		var nroDocumento 	= $("#nroDocumento").val();
		var nombre 			= $("#nombre").val();
		var apellido 		= $("#apellido").val();
		var email 			= $("#email").val();
		var clave 			= $("#clave").val();
		var rclave 			= $("#rclave").val();
		var terminos		=	$("#terminos").val();
		var recaptchaResponse = grecaptcha.getResponse();

		if(idPerfil == ""){
			constantes.alerta("Atención","Debe seleccionar el tipo de usuario","warning",function(){
				setTimeout(function(){$("#idPerfil").focus()});
			})
		}
		else if(matricula == ""){
			constantes.alerta("Atención","Debe escríbir el número de la matrícula. Recuerde que este número lo encuentra en su factura de acueducto","warning",function(){
				setTimeout(function(){$("#matricula").focus()});
			})
		}
		else if(tipoDocumento == ""){
			constantes.alerta("Atención","Debe seleccionar el tipo de documento","warning",function(){
				setTimeout(function(){$("#tipoDocumento").focus()});
			})
		}
		else if(nroDocumento == ""){
			constantes.alerta("Atención","Por favor digite su número de documento","warning",function(){
				setTimeout(function(){$("#nroDocumento").focus()});
			})
		}
		else if(nombre == "" || nombre == undefined){
			constantes.alerta("Atención","Debe escribir el nombre del usuario","warning",function(){
				setTimeout(function(){$("#nombre").focus()});
			})
		}
		else if(apellido == "" || apellido == undefined){
			constantes.alerta("Atención","Debe escribir los apellidos del usuario","warning",function(){
				setTimeout(function(){$("#nombre").focus()});
			})
		}
		else if(email == "" || email == undefined){
			constantes.alerta("Atención","El campo correo electrónico es requerido y debe ser un correo válido","warning",function(){
				setTimeout(function(){$("#email").focus()});
			})
		}
		else if(email != "" && !constantes.validaMail(email)){
			constantes.alerta("Atención","Debe escribir un correo electrónico válido","warning",function(){
				setTimeout(function(){$("#email").focus()});
			})
		}
		else if(clave == "" || clave == undefined){
			constantes.alerta("Atención","Escriba una clave para su cuenta","warning",function(){
				setTimeout(function(){$("#clave").focus()});
			})
		}
		else if(rclave == "" || rclave == undefined){
			constantes.alerta("Atención","Debe volver a escribir la clave de ingresó anteriormente","warning",function(){
				setTimeout(function(){$("#rclave").focus()});
			})
		}
		else if(clave != "" && rclave != "" && rclave != clave){
			constantes.alerta("Atención","Las contraseñas no coinciden, por favor verifique.","warning",function(){
				setTimeout(function(){$("#rclave").focus()});
			})
		}
		else if(!$("#terminos").prop('checked')){
			constantes.alerta("Atención","Debe leer y aceptar los términos y condiciones","warning",function(){
				setTimeout(function(){$("#terminos").focus()});
			})
		}
		else if (recaptchaResponse.length === 0) {
			constantes.alerta("Atención","Por favor, verifica que no eres un robot.","warning",function(){
				setTimeout(function(){$("#terminos").focus()});
			})
		}
		else{
			constantes.confirmacion("Confirmación!","Los datos que acaba de ingresar son correctos, desea continuar?","info",function(){
				var controlador = $scope.config.apiUrl+"registro/insertaPersonas";
				var parametros  = $("#formRegEmpresas").serialize();
				constantes.consultaApi(controlador,parametros,function(json){
					if(json.continuar == 1)
					{
						constantes.alerta("Atención",json.mensaje,"success",function(){
							document.location = $scope.config.apiUrl;
						})
					}
					else
					{
						constantes.alerta("Atención",json.mensaje,"error",function(){})
					}
				});
			});
		}

	}
});
