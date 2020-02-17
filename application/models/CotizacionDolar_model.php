<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CotizacionDolar_model extends CI_Model {
    
    public function getCotizacion($inicio = FALSE, $cantidadregistro = FALSE){
        
        $this->db->select("id, valorbs, fechainicio, fechafin ");
        $this->db->from("cotizaciondolar");
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal(){
        $sql = "select count(*) total ";
        $sql .= "from cotizaciondolar; ";
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
