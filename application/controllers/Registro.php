<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registro extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("registro/LogicaRegistro", "logicaReg");
        $this->load->model("general/LogicaGeneral", "logicaGen");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function index()	
	{
		$this->login();
	}
	public function registroEmpresas()
	{
		$salida['titulo'] = lang("tituloRegistroEmp");
		$salida['centro'] = "registro/empresas";
		$salida['listaDeptos']	=		getDepartamentos('057',"ARRAY");
		$this->load->view("registro/index",$salida);
	}
	public function registroPersonas()
	{
		
		$tiposDoc		  	 = $this->logicaGen->consultatiposDoc(); 

		$salida['titulo'] = lang("tituloRegistroEmp");
		$salida['centro'] = "registro/personas";
		$salida['tiposDoc'] = $tiposDoc;
		$salida['listaDeptos']	=		getDepartamentos('057',"ARRAY");
		$this->load->view("registro/index",$salida);
	}

	//Funciones para el AJAX
	public function getCiudades()
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			extract($_POST);
			$ciudades =  getCiudades('057',$idDepto,"JSON");
			echo $ciudades;
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
		}
	}
	public function insertaEmpresas()
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$procesoEmpresa = $this->logicaReg->insertaEmpresa($_POST);
			echo json_encode($procesoEmpresa);
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
		}
	}
	public function insertaPersonas()
	{
		if(validaInApp("web"))//esta validación me hará consultas más seguras
		{
			$procesoPersona = $this->logicaReg->insertaPersona($_POST);
			echo json_encode($procesoPersona);
		}
		else
		{
			$respuesta = array("mensaje"=>"Acceso no admitido.",
                              "continuar"=>0,
                              "datos"=>""); 

            echo json_encode($respuesta); 
		}
	}
}
?>