<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pais_model extends CI_Model {
    
    public function getPais($idpaisPais, $paisPais, $inicio = FALSE, $cantidadregistro = FALSE){
        $idpaisPais = trim($idpaisPais);
        $paisPais = strtoupper(trim($paisPais));
        
        $this->db->select("id, codigo, descripcion, estado ");
        $this->db->from("iso3166pais");
        if(strlen($idpaisPais) > 0) { $this->db->where("id", $idpaisPais); }
        if(strlen($paisPais) > 0) { $this->db->like("upper(descripcion)", $paisPais, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idpaisPais, $paisPais){
        $idpaisPais = trim($idpaisPais);
        $paisPais = strtoupper(trim($paisPais));
        
        $sql = "select count(*) total ";
        $sql .= "from iso3166pais ";
        $sql .= "where id > 0 ";
        if(strlen($idpaisPais) > 0) { $sql .= "and id = ".$idpaisPais." "; }
        if(strlen($paisPais) > 0) { $sql .= "and upper(descripcion) like '%".$paisPais."%' "; }
        
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
