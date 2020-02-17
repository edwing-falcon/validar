<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsector_model extends CI_Model {
    
    public function getSubSector($idsubSector, $subSector, $inicio = FALSE, $cantidadregistro = FALSE){
        $idsubSector = trim($idsubSector);
        $subSector = strtoupper(trim($subSector));
        
        $this->db->select("id, descripcion");
        $this->db->from("subsector");
        if(strlen($idsubSector) > 0) { $this->db->where("id", $idsubSector); }
        if(strlen($subSector) > 0) { $this->db->like("upper(descripcion)", $subSector, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('descripcion', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idsubSector, $subSector){
        $idsubSector = trim($idsubSector);
        $subSector = strtoupper(trim($subSector));
        
        $sql = "select count(*) total ";
        $sql .= "from subsector ";
        $sql .= "where id > 0 ";
        if(strlen($idsubSector) > 0) { $sql .= "and id = ".$idsubSector." "; }
        if(strlen($subSector) > 0) { $sql .= "and upper(descripcion) like '%".$subSector."%' "; }
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
