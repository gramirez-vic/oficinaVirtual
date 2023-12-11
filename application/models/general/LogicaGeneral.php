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
class LogicaGeneral  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("general/BaseDatosGral","dbGeneral");
    } 
    public function getCiudades($where)
    {
        $listaCiudades = $this->ci->dbGeneral->getCiudades($where);
        if(count($listaCiudades) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de ciudades",
                              "continuar"=>1,
                              "datos"=>$listaCiudades);            
        }
        else
        {
            $respuesta = array("mensaje"=>"No existen ciudades",
                              "continuar"=>0,
                              "datos"=>"");    

        }
        return $respuesta;
    }
    //consulto el listado de módulos de base de datos
    public function getModulos()
    {
        $listaModulos        = array();
        $where['r.idPerfil'] = $_SESSION['project']['info']['idPerfil'];
        $where['r.ver']      = 1;
        $where['m.estado']   = 1;
        $modulos             = $this->ci->dbGeneral->getDistCatModuloModulos($where);
        foreach($modulos as $m)
        {
            $modWhereIn[] = $m['idPadre'];
        }
        $modulosReal         = $this->ci->dbGeneral->getModulosIn($modWhereIn);
        //var_dump($modulosReal);
        //recorro las categorias de los módulos
        foreach($modulosReal as $mod)
        {
            $where['r.idPerfil']  = $_SESSION['project']['info']['idPerfil'];
            $where['m.idPadre']   = $mod['idModulo'];
            $where['m.estado']    = 1;
            $where['m.eliminado'] = 0;
            $modulosHijos        = $this->ci->dbGeneral->getModulos($where);
           
            //capturo la info del módulo
            $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$mod['idModulo']));
            $salidaParcial       = array("idPadre"=>$mod['idModulo'],
                                         "nombreModulo"=>$infoModulo[0]['nombreModulo'],
                                         "icono"=>$infoModulo[0]['icono'],
                                         "modulos"=>$modulosHijos);
            array_push($listaModulos,$salidaParcial);
        }
        return $listaModulos;
    }
    //consulto el listado de módulos de base de datos
    public function getModulosCompletos($padre)
    {
        $listaModulos        = array();
        $where['idPadre']    = $padre;
        //$where['estado']     = 1;
        $where['eliminado']  = 0;
        $modulos             = $this->ci->dbGeneral->infoModulo($where);
        //recorro las categorias de los módulos
        foreach($modulos as $mod)
        {
            $whereH['idPadre']      = $mod['idModulo'];
            //$whereH['estado']     = 1;
            $whereH['eliminado']  = 0;
            $modulosHijos        = $this->ci->dbGeneral->infoModulo($whereH);
            //capturo la info del módulo
            $salidaParcial       = array("idPadre"=>$mod['idModulo'],
                                         "nombreModulo"=>$mod['nombreModulo'],
                                         "urlModulo"=>$mod['urlModulo'],
                                         "icono"=>$mod['icono'],
                                         "estado"=>$mod['estado'],
                                         "eliminado"=>$mod['eliminado'],
                                         "modulos"=>$modulosHijos);
            array_push($listaModulos,$salidaParcial);
        }
        return $listaModulos;
    }
    public function infoModulo($idModulo)
    {
        $infoModulo          = $this->ci->dbGeneral->infoModulo(array("idModulo"=>$idModulo));
        return $infoModulo;
    }
    public function consultaPerfiles()
    {
        $where['estado']    = 1;
        $perfiles          = $this->ci->dbGeneral->consultaPerfiles($where);
        return $perfiles;
    }
    public function consultatiposDoc()
    {
        $where['estado']    = 1;
        $perfiles          = $this->ci->dbGeneral->consultatiposDoc($where);
        return $perfiles;
    }
    public function consultaSexo()
    {
        $where['estado']    = 1;
        $sexo          = $this->ci->dbGeneral->consultaSexo($where);
        return $sexo;
    }
    public function consultaProfesiones()
    {
        $where['estado']    = 1;
        $profesiones          = $this->ci->dbGeneral->consultaProfesiones($where);
        return $profesiones;
    }
    public function consultaCargos()
    {
        $where['estado']    = 1;
        $cargos          = $this->ci->dbGeneral->consultaCargos($where);
        return $cargos;
    }
    public function consultaAreas()
    {
        $where['estado']    = 1;
        $areas          = $this->ci->dbGeneral->consultaAreas($where);
        return $areas;
    }
    public function consultaCiudades()
    {
        $where['ID_PAIS']    = '057';
        $ciudades          = $this->ci->dbGeneral->getCiudades($where);
        return $ciudades;   
    }

    public function consultaEPS()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEPS($where);
        return $resultado; 
    }
    public function consultaAFP()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaAFP($where);
        return $resultado; 

    }
    public function consultaCesantias()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaCesantias($where);
        return $resultado; 
    }
    public function consultaAseguradoras()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaAseguradoras($where);
        return $resultado; 
    }
    public function consultaOcupaciones()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaOcupaciones($where);
        return $resultado; 
    }
    public function consultaEstadoCivil()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEstadoCivil($where);
        return $resultado; 
    }
    public function consultaEscolaridad()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaEscolaridad($where);
        return $resultado; 
    }
    public function consultaReligiones()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaReligiones($where);
        return $resultado; 
    }
    public function consultaGrupoEtnico()
    {
        $where['estado']    = '1';
        $resultado          = $this->ci->dbGeneral->consultaGrupoEtnico($where);
        return $resultado; 
    }
    public function getServicios()
    {
        $where['estado']    = '1';
        $where['especialista']    = '1';
        $resultado          = $this->ci->dbGeneral->getServicios($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getServiciosQuery($where)
    {
        $resultado          = $this->ci->dbGeneral->getServicios($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getPersonas($where)
    {
        $resultado          = $this->ci->dbGeneral->getInfoPersonas($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getPersonasCruce($where)
    {
        $resultado          = $this->ci->dbGeneral->getInfoPersonasCruce($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function consultaCieDiez($where,$like)
    {
        $resultado          = $this->ci->dbGeneral->consultaCieDiez($where,$like);
        //var_dump($resultado);
        return $resultado; 
    }
    public function especialistasServicio($post)
    {
        extract($post);
        $where['rs.idServicio']    = $idServicio;
        $where['p.estado']         = '1';
        $resultado          = $this->ci->dbGeneral->especialistasServicio($where);
        return $resultado; 
    }

    public function consultaPerfilesPersist($id)
    {
        $salidaPerf = array();
        $where['estado']     = 1;
        $where['eliminado']  = 0;
        $perfiles            = $this->ci->dbGeneral->consultaPerfiles($where);
        //recorro los perfiles y verifico 
        foreach($perfiles as $per)
        {
            $wherePerfiles['idModulo']  =   $id;
            $wherePerfiles['idPerfil']  =   $per['idPerfil'];
            //verifico los privilegios si el perfil tiene asignado este módulo
            $relacionPerfMod    =   $this->ci->dbGeneral->consultaRelacionPerfil($wherePerfiles);
            //var_dump($relacionPerfMod[0]);
            $dataRecorre = array("idPerfil"=>$per['idPerfil'],
                                 "nombrePerfil"=>$per['nombrePerfil'],
                                 "ver"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['ver']:"0",
                                 "crear"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['crear']:"0",
                                 "editar"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['editar']:"0",
                                 "borrar"=>(count($relacionPerfMod) > 0)?$relacionPerfMod[0]['borrar']:"0");
            array_push($salidaPerf,$dataRecorre);
        }
        //var_dump($salidaPerf);
        return $salidaPerf;
    }
    //inserta codigo
    public function insetCodigo($codigoPago,$email,$datos){
        $dataInserta['email']           = $email;
        $dataInserta['ip']              = getIP();
        $dataInserta['estadoPago']      = 0;
        $dataInserta['valor']           = $datos["totalAPagar"];
        $dataInserta['codigoPago']      = $codigoPago."-".$datos["numeroFactura"];
        $dataInserta['fechaPago']       = date('Y-m-d H:m:s');
        $dataInserta['factura']         = $datos["numeroFactura"];
        $dataInserta['matricula']       = $datos["matricula"];
        $dataInserta['ENTIDAD']         = "Wompi";
        $resultado = $this->ci->dbGeneral->insetCodigo($dataInserta);
        $respuesta = array("mensaje"=>"data insert",
                            "continuar"=>1,
                            "datos"=>$resultado);   
        return $respuesta;
    }
    //consulto registro registrado, para iniciar el pago
    public function getInfopedido($pedido){ 
        $where['idPago'] = $pedido;
        $resultado          = $this->ci->dbGeneral->getInfopedido($where);
        //var_dump($resultado);
        return $resultado; 
    }
    public function getMatriculas(){ 
        $resultado          = $this->ci->dbGeneral->getMatriculas();
        //var_dump($resultado);
        return $resultado; 
    }
 }