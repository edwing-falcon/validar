<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorio_model extends CI_Model {
    
    public function getLaboratorio($idlaboratorioLaboratorio, $laboratorioLaboratorio, $inicio = FALSE, $cantidadregistro = FALSE){
        $idlaboratorioLaboratorio = trim($idlaboratorioLaboratorio);
        $laboratorioLaboratorio = strtoupper(trim($laboratorioLaboratorio));
        
        $this->db->select("id, descripcion, estado, m02 ");
        $this->db->from("laboratorio");
        if(strlen($idlaboratorioLaboratorio) > 0) { $this->db->where("id", $idlaboratorioLaboratorio); }
        if(strlen($laboratorioLaboratorio) > 0) { $this->db->like("upper(descripcion)", $laboratorioLaboratorio, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idlaboratorioLaboratorio, $laboratorioLaboratorio){
        $idlaboratorioLaboratorio = trim($idlaboratorioLaboratorio);
        $laboratorioLaboratorio = strtoupper(trim($laboratorioLaboratorio));
        
        $sql = "select count(*) total ";
        $sql .= "from laboratorio ";
        $sql .= "where id >= 0 ";
        if(strlen($idlaboratorioLaboratorio) > 0) { $sql .= "and id = ".$idlaboratorioLaboratorio." "; }
        if(strlen($laboratorioLaboratorio) > 0) { $sql .= "and upper(descripcion) like '%".$laboratorioLaboratorio."%' "; }
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

