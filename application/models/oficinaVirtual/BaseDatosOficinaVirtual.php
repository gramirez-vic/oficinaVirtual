<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BaseDatosOficinaVirtual extends CI_Model {
    private $tablePersonas               =   "";
    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->tableMatriculas             = "app_matriculas";
        $this->tableSolicitudes            = "app_solicitudes";
        $this->tablePersonas                = "app_personas";
        $this->tablePerfiles                = "app_perfiles";
    }
    public function getMatriculasUsuario($where)
    {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($this->tableMatriculas);
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function getSolicitudes($where=array())
    {
        $this->db->select("*,s.estado as estadoMatricula");
        if(count($where) > 0){
            $this->db->where($where);
        }
        
        $this->db->from($this->tableSolicitudes." s");
        $this->db->join($this->tablePersonas." p","p.idPersona=s.idPersona","inner");
        $this->db->join($this->tablePerfiles." per","per.idPerfil=p.idPerfil","inner");
        $this->db->order_by("s.fechaSolicitud","DESC");
        $id = $this->db->get();
        //print_r($this->db->last_query());die();
        return $id->result_array();
    }
    public function insertaSolicitud($dataInserta)
    {
        $this->db->insert($this->tableSolicitudes,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }

    public function insertaMatricula($dataInserta)
    {
        $this->db->insert($this->tableMatriculas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->insert_id();
    }

    public function actualizaSolicitud($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableSolicitudes,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }
    public function actualizaMatricula($where,$dataInserta)
    {
        $this->db->where($where);
        $this->db->update($this->tableMatriculas,$dataInserta);
        //print_r($this->db->last_query());die();
        return $this->db->affected_rows();
    }

    
}

?>