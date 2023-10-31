<?php
/*

	("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
   https://github.com/orugal
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicio extends CI_Controller 
{
	function __construct() 
    {
        parent::__construct();
        $this->load->model("general/LogicaGeneral", "logica");
        $this->load->model("oficinaVirtual/LogicaOficinaVirtual", "logicaOv");
       	$this->load->helper('language');
    	$this->lang->load('spanish');
    }
	public function index()	
	{
		if(isset($_SESSION['project']))
		{
			header('Location:'.base_url()."App");
		}
		else
		{
			header('Location:'.base_url()."login");
		}
	}
	public function homeEmpresa()
	{
		
	}	
	public function recordarClave()
	{
		$salida['titulo'] = lang("titulo")." - Recordar Contraseña";
		$salida['centro'] = "login/recordarClave";
		$this->load->view("login/index",$salida);
	}
	public function cabeza()
	{
		$listaMatriculas = $this->logicaOv->getMatriculasUsuario($_SESSION['project']['info']['idPersona']);
		$escribeMatricula = 0;
		//debo validar el perfil para saber que matrículas debo mostrar.
		if(in_array($_SESSION['project']['info']['idPerfil'],array(3,4))){
			if(count($listaMatriculas['datos']) > 0 ){
				if(!isset($_SESSION['matricula']))
				{
					$_SESSION['matricula'] = $listaMatriculas['datos'][0]['matricula'];
				}
			}
			$escribeMatricula = 0;
		}
		else{//administradores
			$escribeMatricula = 1;
		}
		$salida['escribeMatricula']    	  = $escribeMatricula;
		$salida['opc']    	  			  = "";
		$salida['matriculas']  			  = $listaMatriculas['datos'];
		$salida['modulos']    			  = $this->logica->getModulos(1);
		echo $this->load->view("app/menu",$salida,true);
	}
}
?>