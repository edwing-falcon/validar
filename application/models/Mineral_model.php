<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mineral_model extends CI_Model {
    
    public function getMineral($idMineral, $mineral, $estadoMineral, $inicio = FALSE, $cantidadregistro = FALSE){
        $idMineral = trim($idMineral);
        $mineral = strtoupper(trim($mineral));
        $estadoMineral = trim($estadoMineral);
        
        $sql = "select id, descripcion, unidadcotizacion, descripcionsincotizacion, case when estado = 0 then 'DESACTIVADO' when estado = 1 then 'ACTIVO' end as estado ";
        $sql .= "from mineral ";
        $sql .= "where id > 0 ";
        if(strlen($idMineral) > 0) { $sql .= "and id = ".$idMineral." "; }
        if(strlen($mineral) > 0) { $sql .= "and upper(descripcion) like '%".$mineral."%' "; }
        if(strlen($estadoMineral) > 0) { $sql .= "and estado = ".$estadoMineral." "; }
        $sql .= "order by descripcion asc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "limit ".$cantidadregistro." OFFSET ".$inicio." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getEstadoMineral(){
        $sql = "select distinct case when estado = 0 then 'DESACTIVADO' when estado = 1 then 'ACTIVO' end as estadodescri, estado ";
        $sql .= "from mineral ";
        $sql .= "order by estado; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotal($idMineral, $mineral, $estadoMineral){
        $idMineral = trim($idMineral);
        $mineral = strtoupper(trim($mineral));
        $estadoMineral = trim($estadoMineral);
        
        $sql = "select count(*) total ";
        $sql .= "from mineral ";
        $sql .= "where id > 0 ";
        if(strlen($idMineral) > 0) { $sql .= "and id = ".$idMineral." "; }
        if(strlen($mineral) > 0) { $sql .= "and upper(descripcion) like '%".$mineral."%' "; }
        if(strlen($estadoMineral) > 0) { $sql .= "and estado = ".$estadoMineral." "; }
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
