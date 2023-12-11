<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class OficinaVirtual extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaUsuarios", "logicaUsuarios");
        $this->load->model("oficinaVirtual/LogicaOficinaVirtual", "logicaOv");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }

	public function factura($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			//$dataApiLogin = getTokenAPI();
			// var_dump($_SESSION['project']['api']);die();
			$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
			$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
			$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
			$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
			$dataApi["NombreClase"] 		= "VirtualOffice";
			$dataApi["NombreMetodo"] 		= "EstadoDeCuenta";
			$dataApi["Parametros"][0]["NombreParametro"] 	= "matriculas";
			$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
			$dataApi["Parametros"][0]["Valor"]				= array($_SESSION['matricula']);


			$infoFacturaActual = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
			//echo json_encode($infoFacturaActual);die();
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/factura";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoFacturaCargada']  = $infoFacturaActual['datos']['estadosDeCuenta'][0];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}

	public function descargarFactura($vigencia){
		$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
		$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
		$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
		$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
		$dataApi["NombreClase"] 		= "VirtualOffice";
		$dataApi["NombreMetodo"] 		= "DescargarFactura";
		$dataApi["Parametros"][0]["NombreParametro"] 	= "matricula";
		$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal";
		$dataApi["Parametros"][0]["Valor"]				= $_SESSION['matricula'];
		$dataApi["Parametros"][1]["NombreParametro"] 	= "vigencia";
		$dataApi["Parametros"][1]["Tipo"] 				= "System.Decimal";
		$dataApi["Parametros"][1]["Valor"]				= $vigencia;

		//echo json_encode($dataApi);die();
		//echo $_SESSION['matricula'];die();
		$infoFacturaDescarga = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
		//echo $infoFacturaDescarga['datos']['facturaBase64String'];die();
		# Decode the Base64 string, making sure that it contains only valid characters
		$bin = base64_decode($infoFacturaDescarga['datos']['facturaBase64String'], true);

		# Perform a basic validation to make sure that the result is a valid PDF file
		# Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
		# Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
		if (strpos($bin, '%PDF') !== 0) {
			throw new Exception('Missing the PDF file signature');
		}
		$nombreArchivo = $_SESSION['matricula']." - ".$vigencia.".pdf";
		# Write the PDF contents to a local file
		file_put_contents('./res/pdf/'.$nombreArchivo, $bin);
		//redirecciono al PDF para mostrarlo :D
		echo "<script>document.location='".base_url()."res/pdf/".$nombreArchivo."'</script>";
		
	}

	public function historicoPagos($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 	

				$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
				$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
				$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
				$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
				$dataApi["NombreClase"] 		= "VirtualOffice";
				$dataApi["NombreMetodo"] 		= "HistoricoPagosSuscriptor";
				$dataApi["Parametros"][0]["NombreParametro"] 	= "matriculas";
				$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
				$dataApi["Parametros"][0]["Valor"]				= $_SESSION['matricula'];
				$historicoPagos = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
				// var_dump($historicoPagos);die();
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/historico";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['historicoPagos']  = $historicoPagos["datos"]["detallePagos"];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}

	public function pqrs($idModulo)	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
				$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
				$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
				$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
				$dataApi["NombreClase"] 		= "VirtualOffice";
				$dataApi["NombreMetodo"] 		= "HistoricoPqrUsuario";
				$dataApi["Parametros"][0]["NombreParametro"] 	= "nit";
				$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
				$dataApi["Parametros"][0]["Valor"]				= "12345";
				$pqrs = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
				var_dump($pqrs);die();
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/pqrs";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['pqrs']  		= $pqrs["datos"] ["detallePqr"];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}

	public function asociarMatricula($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/asociarMatricula";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}

	public function solicitudes($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/solicitudes";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}
	public function cargarMatricula(){
		$_SESSION['matricula'] = $_POST['matricula'];
		$salida = array("mensaje"=>"Matrícula cargada","continuar"=>1);
		echo json_encode($salida);
	}
	public function insertaSolicitud(){
		$respuesta	   = $this->logicaOv->insertaSolicitud($_POST);
		echo json_encode($respuesta);
	}
	public function getSolicitudes(){
		$respuesta	   = $this->logicaOv->getSolicitudes($_POST);
		echo json_encode($respuesta);
	}

	public function gestionaSolicitud(){
		$respuesta	   = $this->logicaOv->gestionaSolicitud($_POST);
		echo json_encode($respuesta);
	}
	//pago de factura
	public function PagarFactura(){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
				$opc 					= "home";
				$salida['titulo'] 	  	= "Pago en línea";
				$salida['centro'] 		= "oficinaVirtual/pagoFactura";
				$this->load->view("app/index",$salida);
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//consulto matricula antes
	public function consultaMatricula(){
		$matricula = $_POST["matricula"];
		$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
		$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
		$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
		$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
		$dataApi["NombreClase"] 		= "VirtualOffice";
		$dataApi["NombreMetodo"] 		= "EstadoDeCuenta";
		$dataApi["Parametros"][0]["NombreParametro"] 	= "matriculas";
		$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
		$dataApi["Parametros"][0]["Valor"]				= array($matricula);
		$infoFacturaActual = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
		$datos = $infoFacturaActual["datos"]["estadosDeCuenta"];
		// var_dump($datos);die();
		echo json_encode($datos);
	}
	//datos de factura
	public function datosFactura($idModulo, $matricula){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			//$dataApiLogin = getTokenAPI();
			// var_dump($_SESSION['project']['api']);die();
			$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
			$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
			$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
			$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
			$dataApi["NombreClase"] 		= "VirtualOffice";
			$dataApi["NombreMetodo"] 		= "EstadoDeCuenta";
			$dataApi["Parametros"][0]["NombreParametro"] 	= "matriculas";
			$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
			$dataApi["Parametros"][0]["Valor"]				= array($matricula);


			$infoFacturaActual = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
			// echo json_encode($infoFacturaActual);die();
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				//info Módulo
				$referencia 			= str_pad(rand(0, pow(10, 16) - 1), 16, '0', STR_PAD_LEFT);
				$infoModulo	      	   	= $this->logica->infoModulo($idModulo);
				$opc 				   	= "home";
				$salida['titulo']      	= "Pagos";
				$salida['centro'] 	  	= "oficinaVirtual/datosFactura";
				$salida['infoModulo']  	= $infoModulo[0];
				$salida['referencia']  	= $referencia;
				$salida['infoFacturaCargada']  = $infoFacturaActual['datos']['estadosDeCuenta'][0];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//inserto codigo o referencia de pago
	public function insetCodigo(){
		$codigoPago				= substr(md5(time()), 0, 16);
		$email 					= $_SESSION['project']['info']["email"];
		$datos 					= $_POST;
		$insetCodigo			= $this->logica->insetCodigo($codigoPago,$email,$datos);
		echo json_encode($insetCodigo);
	}
	//pop pasarela de pagos
	public function procesoPagoOnline($idPedido,$proveedor,$pedido){
        $infopedido = $this->logica->getInfopedido($pedido);
		// var_dump($infopedido);die();
        //consulto la info de la tienda
		$salida['titulo']       = "Pasarela de pago";
		$salida['centro']       = "registro/pagoOnline";
		$salida['infopedido']    = $infopedido[0];
		$salida['proveedor']    = $proveedor;
		$this->load->view("registro/indexPago",$salida);    
    }
	//link de confirmacion de pago wompi
	public function confirmacionPagoWompi(){
        
        extract($_SESSION['confirmaWompi']);
        //var_dump($_POST);die();reference_sale
        extract($_POST);
        //debo actualizar la informacon del pedido con lo que me retorno payu
        $dataInserta['estadoPago']      = $state_pol;
        $dataInserta['transactionId']   = $transaction_id;
        $dataInserta['reference_pol']   = $reference_pol;
        $dataInserta['valor']           = $value;
        $dataInserta['moneda']          = $currency;
        $dataInserta['entidad']         = $payment_method;
        $dataInserta['fechaPago']       = date("Y-m-d H:i:s");
        $condicion['codigoPedido']      = $codigoPedido;
        var_dump($_SESSION['confirmaWompi']);
        $infoPedido     = $this->logicaPedidos->getPedidos(array("codigoPedido"=>$codigoPedido));
        $infoTienda     = $this->logica->getInfoTiendaNew($infoPedido[0]['tienda']);
        
        $updatePedido                   = $this->logica->actualizaPedido($dataInserta,$condicion);
        //envia el mensaje al administrador de la tienda diciendo que el pedido llego
        //$mensajeMail  = "Confirmación de pago del pedido <strong>".$reference_sale."</strong><br><br>";
       // sendMail(_ADMIN_PEDIDOS,"Estado de pago del pedido ".$reference_sale,$mensajeMail);

       if ($state_pol == 998) {
            $estadoTx = "Transacción aprobada";
            $claseLabel = "label-success";
        }else{
            $estadoTx = "Transacción rechazada";
            $claseLabel = "label-danger";
        }
        $salida['estadoTx']         =   $estadoTx;
        $salida['currency']         =   $currency;
        $salida['referenceCode']    =   $codigoPedido;
        $salida['pseBank']          =   $payment_method;
        $salida['lapPaymentMethod'] =   $payment_method;
        $salida['transactionId']    =   $transaction_id;
        $salida['valor']    =   $value;


        $salida['titulo']      = "Respuesta de pago";
        $salida['titulo']      = lang("titulo")." - Resumen de la transacción";
        $salida['centro']      = "pedidos/respuestaPagoAppWompi";
        $salida['claseLabel']   = $claseLabel;
        $salida['infoTienda']   = $infoTienda['datos'][0];
        
		$this->load->view("registro/indexPago",$salida);
    }
	public function pagos($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 	

				$PagosOficina			=$this->logica->getMatriculas();//consulto todas las matriculas
				// var_dump($PagosOficina);die();
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/pagoOficina";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['PagosOficina']  = $PagosOficina;
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}
	//nueva pqr
	public function nuevaPqrs($idModulo){
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso()){
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1){ 
				$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
				$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
				$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
				$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
				$dataApi["NombreClase"] 		= "VirtualOffice";
				$dataApi["NombreMetodo"] 		= "DatosBasicosPQR";
				$dataApi["Parametros"] 			= [];
				$datosBasicosPqrs = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
				
				// var_dump($datosBasicosPqrs);die();
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = "Registara Nueva Pqr";
				$salida['centro'] 	   = "oficinaVirtual/nuevaPqr";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['tiposDePqr']  				=$datosBasicosPqrs["datos"]["tiposDePqr"];
				// var_dump($datosBasicosPqrs["datos"]["conceptosDeReclamacion"]);die();
				$salida['tiposDeTramite']  			= $datosBasicosPqrs["datos"]["tiposDeTramite"];
				$salida['procesosOperativos']  		= $datosBasicosPqrs["datos"]["procesosOperativos"];
				$salida['tiposPresentacionPqr']  	= $datosBasicosPqrs["datos"]["tiposPresentacionPqr"];
				$salida['tiposDeIdentificacion']  	= $datosBasicosPqrs["datos"]["tiposDeIdentificacion"];
				$salida['conceptosDeReclamacion']	= $datosBasicosPqrs["datos"]["conceptosDeReclamacion"];
				$salida['ciudades']  				= $datosBasicosPqrs["datos"]["ciudades"];
				$salida['barrios']  				= $datosBasicosPqrs["datos"]["barrios"];
				$salida['usosEstratos']  			= $datosBasicosPqrs["datos"]["usosEstratos"];
				$salida['sectores']  				= $datosBasicosPqrs["datos"]["sectores"];
				$salida['tiposSolicitante']  		= $datosBasicosPqrs["datos"]["tiposSolicitante"];
				$salida['tiposInstalacion']  		= $datosBasicosPqrs["datos"]["tiposInstalacion"];
				$salida['diametrosConexion']  		= $datosBasicosPqrs["datos"]["diametrosConexion"];
				$salida['codigoConceptoSolicitudServicio'] = $datosBasicosPqrs["datos"]["codigoConceptoSolicitudServicio"];
				$this->load->view("app/index",$salida);
			}else{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}else{
			header('Location:'.base_url()."login");
		}
	}

}
?>