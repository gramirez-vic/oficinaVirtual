<?php
class LogicaOficinaVirtual  {
    private $ci;
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model("oficinaVirtual/BaseDatosOficinaVirtual","dbOv");
    } 
    public function getMatriculasUsuario($idPersona)
    {
        $where['idPersona']        = $idPersona;
        $listado = $this->ci->dbOv->getMatriculasUsuario($where);
        if(count($listado) > 0)
        {
            $respuesta = array("mensaje"=>"Listado de matriculas.",
                          "continuar"=>1,
                          "datos"=>$listado); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay matrículas para el usuario logueado",
                          "continuar"=>0,
                          "datos"=>""); 
        }
        return $respuesta;
    }
    public function insertaSolicitud($post)
    {
        $post['idPersona']          = $_SESSION['project']['info']['idPersona'];
        $post['matriculaAfecta']    = $_SESSION['matricula'];
        $post['fechaSolicitud']     = date("Y-m-d H:i:s");
        $resultado = $this->ci->dbOv->insertaSolicitud($post);
        if($resultado > 0)
        {
            $respuesta = array("mensaje"=>"La solicitud se ha insertado de manera exitosa, pronto estaremos en contacto con usted.",
                               "continuar"=>1,
                               "datos"=>$resultado); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No se ha podido insertar la solicitud, por favor intente de nuevo más tarde.",
                               "continuar"=>0,
                               "datos"=>""); 
        }
        return $respuesta;
    }
    public function getSolicitudes($post)
    {
        $where['s.estado']     = $post['filtro'];
        $resultado = $this->ci->dbOv->getSolicitudes($where);
        if($resultado > 0)
        {
            $respuesta = array("mensaje"=>"Listado solicitudes.",
                               "continuar"=>1,
                               "datos"=>$resultado); 
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay solicitudes.",
                               "continuar"=>0,
                               "datos"=>""); 
        }
        return $respuesta;
    }

    public function gestionaSolicitud($post){
        extract($post);
        $resultado = $this->ci->dbOv->getSolicitudes(array("idSolicitud"=>$idSolicitud));
        if(count($resultado) > 0)
        {
            //si el proceso está rechazado
            if($gestion != 'rechazado'){
                //valido si es agregar o si es cambiar
                if($accion == 'agregar'){//agregar matrícula
                    //pongo la solicitud como  autorizado
                    $dataActualizo['estado'] =  $gestion;
                    $where['idSolicitud']    =  $idSolicitud;
                    //proceso de actualización
                    $actualizacion = $this->ci->dbOv->actualizaSolicitud($where,$dataActualizo);
                    if($actualizacion > 0){
                        //procedo a agregar matrícula
                        $dataInserta['idPersona'] = $resultado[0]['idPersona'];
                        $dataInserta['matricula'] = $matriculaNueva;
                        //proceso a insertar
                        $insertaMatricula = $this->ci->dbOv->insertaMatricula($dataInserta);
                        if($insertaMatricula > 0){
                            $respuesta = array("mensaje"=>"Se ha insertado la matrícula a la cuenta del usuario",
                                            "continuar"=>1,
                                            "datos"=>array());
                        }
                        else{
                            $respuesta = array("mensaje"=>"No se ha podido agregar la matrícula, por favor intente más tarde.",
                                            "continuar"=>0,
                                            "datos"=>array());
                        }
                    }
                    else{
                        $respuesta = array("mensaje"=>"No se ha podido insertar la matrícula. Por favor intente de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>array()); 
                    }
                }
                else if($accion == 'cambio'){//cambiar matrícula
                    //pongo la solicitud como  autorizado
                    $dataActualizo['estado'] =  $gestion;
                    $where['idSolicitud']    =  $idSolicitud;
                    //proceso de actualización
                    $actualizacion = $this->ci->dbOv->actualizaSolicitud($where,$dataActualizo);
                    //valido
                    if($actualizacion > 0){
                        //actualizo la tabla matriculas
                        $dataInserta['matricula'] = $matriculaNueva;
                        $whereM['idPersona']       = $resultado[0]['idPersona'];
                        $whereM['matricula']       = $matriculaActual;
                        //proceso a insertar
                        $actualizaMatricula = $this->ci->dbOv->actualizaMatricula($whereM,$dataInserta);
                        if($actualizaMatricula > 0){
                            $respuesta = array("mensaje"=>"Se ha cambiado la matrícula en la cuenta del usuario",
                                            "continuar"=>1,
                                            "datos"=>array());
                        }
                        else{
                            $respuesta = array("mensaje"=>"No se ha podido actualizar la matrícula, por favor intente más tarde.",
                                            "continuar"=>0,
                                            "datos"=>array());
                        }
                        
                    }
                    else{
                        $respuesta = array("mensaje"=>"No se ha podido actualizar la matrícula. Por favor intente de nuevo más tarde.",
                                        "continuar"=>0,
                                        "datos"=>array()); 
                    }

                }
            }
            else{//si es rechazado, procedo a rechazarlo en la base de datos
                $dataActualizo['estado'] =  $gestion;
                $where['idSolicitud']    =  $idSolicitud;
                //proceso de actualización
                $actualizacion = $this->ci->dbOv->actualizaSolicitud($where,$dataActualizo);
                if($actualizacion > 0){
                    $respuesta = array("mensaje"=>"Se ha actualizado el estado de la solicitud",
                                       "continuar"=>1,
                                       "datos"=>array()); 
                }
                else{
                    $respuesta = array("mensaje"=>"No se ha podido llevar a cabo la solicitud. Por favor intente de nuevo más tarde.",
                                       "continuar"=>0,
                                       "datos"=>array()); 
                }
            }
        }
        else
        {
            $respuesta = array("mensaje"=>"No hay solicitudes.",
                               "continuar"=>0,
                               "datos"=>""); 
        }
        return $respuesta;

    }
 }