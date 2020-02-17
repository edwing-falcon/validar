<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Municipio_model extends CI_Model {
    
    public function getMunicipio($idMunicipio, $codigoMunicipio, $municipioMunicipio, $provinciaMunicipio, $departamentoMunicipio, $inicio = FALSE, $cantidadregistro = FALSE){
        $idMunicipio = trim($idMunicipio);
        $codigoMunicipio = strtoupper(trim($codigoMunicipio));
        $municipioMunicipio  = strtoupper(trim($municipioMunicipio));
        $provinciaMunicipio = strtoupper(trim($provinciaMunicipio));
        $departamentoMunicipio = strtoupper(trim($departamentoMunicipio));
        
        $this->db->select("id, codigo, municipio, provincia, departamento ");
        $this->db->from("municipio");
        if(strlen($idMunicipio) > 0) { $this->db->where("id", $idMunicipio); }
        if(strlen($codigoMunicipio) > 0) { $this->db->like("upper(codigo)", $codigoMunicipio, "both"); }
        if(strlen($municipioMunicipio) > 0) { $this->db->like("upper(municipio)", $municipioMunicipio, "both"); }
        if(strlen($provinciaMunicipio) > 0) { $this->db->like("upper(provincia)", $provinciaMunicipio, "both"); }
        if(strlen($departamentoMunicipio) > 0) { $this->db->like("upper(departamento)", $departamentoMunicipio, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('municipio', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idMunicipio, $codigoMunicipio, $municipioMunicipio, $provinciaMunicipio, $departamentoMunicipio){
        $idMunicipio = trim($idMunicipio);
        $codigoMunicipio = strtoupper(trim($codigoMunicipio));
        $municipioMunicipio  = strtoupper(trim($municipioMunicipio));
        $provinciaMunicipio = strtoupper(trim($provinciaMunicipio));
        $departamentoMunicipio = strtoupper(trim($departamentoMunicipio));
                
        $sql = "select count(*) total ";
        $sql .= "from municipio ";
        $sql .= "where id > 0 ";
        if(strlen($idMunicipio) > 0) { $sql .= "and id = ".$idMunicipio." "; }
        if(strlen($codigoMunicipio) > 0) { $sql .= "and upper(codigo) like '%".$codigoMunicipio."%' "; }
        if(strlen($municipioMunicipio) > 0) { $sql .= "and upper(municipio) like '%".$municipioMunicipio."%' "; }
        if(strlen($provinciaMunicipio) > 0) { $sql .= "and upper(provincia) like '%".$provinciaMunicipio."%' "; }
        if(strlen($departamentoMunicipio) > 0) { $sql .= "and upper(departamento) like '%".$departamentoMunicipio."%' "; }
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
}


?>
