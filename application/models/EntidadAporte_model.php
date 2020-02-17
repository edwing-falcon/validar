<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EntidadAporte_model extends CI_Model {
    
    public function getEntidadAporte($identidadAporte, $entidadAporte, $inicio = FALSE, $cantidadregistro = FALSE){
        $identidadAporte = trim($identidadAporte);
        $entidadAporte = strtoupper(trim($entidadAporte));
        
        $this->db->select("id, descripcion, porcentaje1, porcentaje2, bandera, bandera2 ");
        $this->db->from("entidadaporte");
        if(strlen($identidadAporte) > 0) { $this->db->where("id", $identidadAporte); }
        if(strlen($entidadAporte) > 0) { $this->db->like("upper(descripcion)", $entidadAporte, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($identidadAporte, $entidadAporte){
        $identidadAporte = trim($identidadAporte);
        $entidadAporte = strtoupper(trim($entidadAporte));
        
        $sql = "select count(*) total ";
        $sql .= "from entidadaporte ";
        $sql .= "where id > 0 ";
        if(strlen($identidadAporte) > 0) { $sql .= "and id = ".$identidadAporte." "; }
        if(strlen($entidadAporte) > 0) { $sql .= "and upper(descripcion) like '%".$entidadAporte."%' "; }
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
