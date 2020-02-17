<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntidadFinanciera_model extends CI_Model {
    
    public function getEntidadFinanciera($idEntidadFinanciera, $entidadFinanciera, $inicio = FALSE, $cantidadregistro = FALSE){
        $idEntidadFinanciera = trim($idEntidadFinanciera);
        $entidadFinanciera = strtoupper(trim($entidadFinanciera));
        
        $this->db->select("id, descripcion, estado ");
        $this->db->from("entidadfinanciera");
        if(strlen($idEntidadFinanciera) > 0) { $this->db->where("id", $idEntidadFinanciera); }
        if(strlen($entidadFinanciera) > 0) { $this->db->like("upper(descripcion)", $entidadFinanciera, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('descripcion', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idEntidadFinanciera, $entidadFinanciera){
        $idEntidadFinanciera = trim($idEntidadFinanciera);
        $entidadFinanciera = strtoupper(trim($entidadFinanciera));
        
        $sql = "select count(*) total ";
        $sql .= "from entidadfinanciera ";
        $sql .= "where id > 0 ";
        if(strlen($idEntidadFinanciera) > 0) { $sql .= "and id = ".$idEntidadFinanciera." "; }
        if(strlen($entidadFinanciera) > 0) { $sql .= "and upper(descripcion) like '%".$entidadFinanciera."%' "; }
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
