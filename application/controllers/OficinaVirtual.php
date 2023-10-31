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
class OficinaVirtual extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("admin/LogicaUsuarios", "logicaUsuarios");
        $this->load->model("oficinaVirtual/LogicaOficinaVirtual", "logicaOv");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }

	public function factura($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			//$dataApiLogin = getTokenAPI();
			//var_dump($_SESSION['project']['api']);die();
			$dataApi["IdSession"] 			= $_SESSION['project']['api']['idSesion'];
			$dataApi["IdEmpresa"] 			= ID_EMPRESA_API;
			$dataApi["NombreEnsamblado"] 	= "VirtualOfficeWSS.dll";
			$dataApi["EspacioDeNombres"] 	= "VirtualOfficeWSS";
			$dataApi["NombreClase"] 		= "VirtualOffice";
			$dataApi["NombreMetodo"] 		= "EstadoDeCuenta";
			$dataApi["Parametros"][0]["NombreParametro"] 	= "matriculas";
			$dataApi["Parametros"][0]["Tipo"] 				= "System.Decimal[]";
			$dataApi["Parametros"][0]["Valor"]				= array($_SESSION['matricula']);


			//echo $_SESSION['matricula'];die();
			$infoFacturaActual = consultaApiAfro($dataApi,"SolicitudGenerica",$_SESSION['project']['api']['token']);
			//echo json_encode($infoFacturaActual);die();
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/factura";
				$salida['infoModulo']  = $infoModulo[0];
				$salida['infoFacturaCargada']  = $infoFacturaActual['datos']['estadosDeCuenta'][0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
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

	public function historicoPagos($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/historico";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}

	public function pqrs($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/pqrs";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}

	public function asociarMatricula($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/asociarMatricula";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}

	public function solicitudes($idModulo)	
	{
		//valido que haya una sesión de usuario, si no existe siempre lo enviaré al login
		if(validaIngreso())
		{
			/*******************************************************************************************/
			/* ESTA SECCIÓN DE CÓDIGO  ES MUY IMPORTANTE YA QUE ES LA QUE CONTROLARÁ EL MÓDULO VISITADO*/
			/*******************************************************************************************/
			//si no se declara está variable en cada inicio del módulo no se podrán consultar los privilegios
			$_SESSION['moduloVisitado']		=	$idModulo;
			//antes de pintar la plantilla del módulo valido si hay permisos de ver ese módulo para evitar que ingresen al módulo vía URL
			if(getPrivilegios()[0]['ver'] == 1)
			{ 
				//info Módulo
				$infoModulo	      	   = $this->logica->infoModulo($idModulo);
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - ".$infoModulo[0]['nombreModulo'];
				$salida['centro'] 	   = "oficinaVirtual/solicitudes";
				$salida['infoModulo']  = $infoModulo[0];
				$this->load->view("app/index",$salida);
			}
			else
			{
				$opc 				   = "home";
				$salida['titulo']      = lang("titulo")." - Área Restringida";
				$salida['centro'] 	   = "error/areaRestringida";
				$this->load->view("app/index",$salida);
			}
		}
		else
		{
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
}
?>