<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aduana_model extends CI_Model {
    
    public function getAduana($idAduana, $codigoAduana, $aduanaAduana, $inicio = FALSE, $cantidadregistro = FALSE){
        $idAduana = trim($idAduana);
        $codigoAduana = strtoupper(trim($codigoAduana));
        $aduanaAduana = strtoupper(trim($aduanaAduana));
        
        $this->db->select("id, codigo, descripcion ");
        $this->db->from("aduana");
        if(strlen($idAduana) > 0) { $this->db->where("id", $idAduana); }
        if(strlen($codigoAduana) > 0) { $this->db->like("codigo", $codigoAduana, "both"); }
        if(strlen($aduanaAduana) > 0) { $this->db->like("upper(descripcion)", $aduanaAduana, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idAduana, $codigoAduana, $aduanaAduana){
        $idAduana = trim($idAduana);
        $codigoAduana = strtoupper(trim($codigoAduana));
        $aduanaAduana = strtoupper(trim($aduanaAduana));
        
        $sql = "select count(*) total ";
        $sql .= "from aduana ";
        $sql .= "where id > 0 ";
        if(strlen($idAduana) > 0) { $sql .= "and id = ".$idAduana." "; }
        if(strlen($codigoAduana) > 0) { $sql .= "and upper(codigo) like '%".$codigoAduana."%' "; }
        if(strlen($aduanaAduana) > 0) { $sql .= "and upper(descripcion) like '%".$aduanaAduana."%' "; }
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
