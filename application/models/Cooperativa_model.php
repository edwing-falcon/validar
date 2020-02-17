<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cooperativa_model extends CI_Model {
    
    public function getCooperativa($idCooperativa, $cooperativa, $inicio = FALSE, $cantidadregistro = FALSE){
        $idCooperativa = trim($idCooperativa);
        $cooperativa = strtoupper(trim($cooperativa));
        
        $this->db->select("id, nrodigeco, nombre, fedecomin ");
        $this->db->from("cooperativa");
        if(strlen($idCooperativa) > 0) { $this->db->where("id", $idCooperativa); }
        if(strlen($cooperativa) > 0) { $this->db->like("upper(nombre)", $cooperativa, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('nombre', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idCooperativa, $cooperativa){
        $idCooperativa = trim($idCooperativa);
        $cooperativa = strtoupper(trim($cooperativa));
        
        $sql = "select count(*) total ";
        $sql .= "from cooperativa ";
        $sql .= "where id > 0 ";
        if(strlen($idCooperativa) > 0) { $sql .= "and id = ".$idCooperativa." "; }
        if(strlen($cooperativa) > 0) { $sql .= "and upper(nombre) like '%".$cooperativa."%' "; }
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
