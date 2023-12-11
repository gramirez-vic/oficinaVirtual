/*
* Controlador que maneja todas las funcionalidades de la creación de usuarios
* @author Farez Prieto @orugal
* @date 15 de Noviembre de 2016
*/
project.controller('oficinaVirtual', function($scope,$http,$q,constantes)
{
	$scope.usuarios 	= [];
	$scope.padreModulo	=	"";
    $scope.config 			=  configLogin;//configuración global
    $scope.solicitudes  = [];
    $scope.filtro = "ingresado";
	$scope.initAsociaMatricula = function()
	{
		$scope.getUsuarios();
	}

    $scope.cargarMatricula = function(){
        //capturo la matricula del elemento que tiene el id  matriculaCargar, el cual puede ser un select o una caja según el perfil
        var matricula = $("#matriculaCargar").val();
        
		var controlador = 	$scope.config.apiUrl+"OficinaVirtual/cargarMatricula";
		var parametros  = 	"matricula="+matricula;
		constantes.consultaApi(controlador,parametros,function(json){
			location.reload();
		});

    }
    $scope.decideMatricula = function(){
        var tipoSolicitud = $('input[name="tipoSolicitud"]:checked').val();
        if(tipoSolicitud == 'cambio'){
            $("#alertaMatricula").show();
        }
        else{
            $("#alertaMatricula").hide();
        }
    }

    $scope.solicitudAsociarMatricula = function(){
        var tipoSolicitud   =  $('input[name="tipoSolicitud"]:checked').val();
        var email           = $("#email").val();
        var telefono        = $("#telefono").val();
        var matricula       = $("#matricula").val();
        var observacion     = $("#observacion").val();
        //validación campos
        if(tipoSolicitud == undefined){
            constantes.alerta("Atención","Debe seleccionar el tipo de solicitud a realizar.","info",()=>{});
        }
        else if(email == ""){
            constantes.alerta("Atención","Debe escribir el correo electrónico.","info",()=>{});
        }
        else if(telefono == ""){
            constantes.alerta("Atención","Por favor digite un número de teléfono en caso de que debamos contactar con usted.","info",()=>{});
        }
        else if(matricula == ""){
            constantes.alerta("Atención","Por favor digite un número la matrícula nueva que va a procesar.","info",()=>{});
        }
        else {
            constantes.confirmacion("Atención","Está a punto de enviar la solicitud con la información ingresar, ¿Desea continuar?","info",()=>{
                var controlador = 	$scope.config.apiUrl+"OficinaVirtual/insertaSolicitud";
                var parametros  = 	$("#formSolicitud").serialize();
                constantes.consultaApi(controlador,parametros,function(json){
                    if(json.continuar == 1){
                        constantes.alerta("Atención",json.mensaje,"success",()=>{
                            location.reload();
                        });
                    }
                    else{
                        constantes.alerta("Atención",json.mensaje,"info",()=>{
                            location.reload();
                        });
                    }
                });
            });
        }
    }

    $scope.initSolicitudes = function(){
        $scope.getSolicitudes();
    }
	$scope.getSolicitudes = function(idUsuario,edita)
	{
        var filtro      =   $("#filtro").val();
		var controlador = 	$scope.config.apiUrl+"OficinaVirtual/getSolicitudes";
		var parametros  = 	"filtro="+filtro;
		constantes.consultaApi(controlador,parametros,function(json){
			$scope.solicitudes  = json.datos;
			$scope.$digest();
		});
	}
	/*
	* Me abre una plantilla que me permitira editar o crear los módulos
	*/
	$scope.cargaPlantillaControl = function(idUsuario,edita)
	{
		$('#modalUsuarios').modal("show");
		var controlador = 	$scope.config.apiUrl+"Usuarios/cargaPlantillaCreacionUsuarios";
		var parametros  = 	"edita="+edita+"&idUsuario="+idUsuario;
		constantes.consultaApi(controlador,parametros,function(json){
				
			$("#modalCrea").html(json);
			//actualiza el DOM
			$scope.compileAngularElement("#formAgregaPersona");
		},'');
	}

    $scope.gestionSolicitud = function(gestion,matriculaActual,matriculaNueva,documento,accion,idSolicitud){
        var texto = (gestion == 'autorizado') ? "Autorizar "+accion+" matricula "+matriculaActual+" a usuario con Documento: "+documento+"?" : "Rechazar "+accion+" matricula "+matriculaActual+" a usuario con Documento: "+documento+"?";
        constantes.confirmacion("Atención",texto,"info",() => {
            var controlador = 	$scope.config.apiUrl+"OficinaVirtual/gestionaSolicitud";
            var parametros  = 	{gestion,matriculaActual,matriculaNueva,documento,accion,idSolicitud};
            constantes.consultaApi(controlador,parametros,function(json){
                if(json.continuar == 1){
                    constantes.alerta("Atención",json.mensaje,"success",function(){
                        location.reload();
                    });
                }
                else{
                    constantes.alerta("Atención",json.mensaje,"info",function(){});
                }
            });
        });
    }
    $scope.solicitudConsultarMatricula = function(){
        var matricula = $("#matricula").val();
        var controlador = $scope.config.apiUrl+"OficinaVirtual/consultaMatricula";
        var parametros  = {matricula};
        constantes.consultaApi(controlador,parametros,function(json){
            if(json != ""){
                // Redirigir a la nueva ubicación
                window.location.assign($scope.config.apiUrl + "/OficinaVirtual/datosFactura/41/" + matricula);
            } else {
                constantes.alerta("Atención", "Matricula Incorrecta, por favor verifique", "info", function(){});
            }
        });
    }
    $scope.PagoFactura= function(){
		constantes.confirmacion("Atención","Esta apunto de realizar el pago de tu factura, ¿Desea continuar?. Recuerde activar las ventanas emergentes antes de continuar.",'info',function(){
			//se abre ventana pop
			var codigo = $("#codigoPago").val();
            var controlador = $scope.config.apiUrl+"OficinaVirtual/insetCodigo";
            var parametros  = $("#dataPago").serialize();
            constantes.consultaApi(controlador,parametros,function(json){
                if(json.continuar == 1){	
                    var ventana ="";
                    var ventana = window.open($scope.config.apiUrl+"OficinaVirtual"+'/procesoPagoOnline/'+"datos"+'/PagoFactura/'+json.datos, "wompi" , "width=600,height=880,left = 420");
                    var tiempo= 0;
                        var interval = setInterval(function(){
                            //Comprobamos que la ventana no este cerrada
                            if(ventana.closed !== false) {
                                window.clearInterval(interval);
                                window.location.assign($scope.config.apiUrl+"App"); 
                            } else {
                                o +=1;
                            }
                        },1000)
                }else{
                constantes.alerta("Atención",json.mensaje,"error",function(){})
                }
            });
		});
	}
    $scope.nuevaPqr = function(){
        window.location.assign($scope.config.apiUrl + "/OficinaVirtual/nuevaPqrs/41");
    }
    $scope.crearPQR = function(){
        alert("aca");
    }
    
});