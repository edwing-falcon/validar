<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nandina_model extends CI_Model {
    
    public function getNandina($idNandina, $codigoNandina, $descripcionNandina, $mineralNandina, $inicio = FALSE, $cantidadregistro = FALSE){
        $idNandina = trim($idNandina);
        $codigoNandina = strtoupper(trim($codigoNandina));
        $descripcionNandina = strtoupper(trim($descripcionNandina));
        $mineralNandina = strtoupper(trim($mineralNandina)); 
                
        $this->db->select("n.id id, n.codigo codigo, n.descripcion, m.descripcion mineral, CASE WHEN n.estado = 0 THEN 'Desactivado' WHEN n.estado = 1 THEN 'Activado' END as estado, CASE WHEN calculorm = 0 THEN 'No' WHEN calculorm = 1 THEN 'Si' END as calculorm, CASE WHEN clasificacionmineral is null THEN 'SIN CLASIFICAR' ELSE clasificacionmineral END as clasificacionmineral ");
        $this->db->from("nandina n");
        $this->db->join("mineral m", "m.id = n.idmineral");
        if(strlen($idNandina) > 0) { $this->db->where("n.id", $idNandina); }
        if(strlen($codigoNandina) > 0) { $this->db->like("n.codigo", $codigoNandina, "both"); }
        if(strlen($descripcionNandina) > 0) { $this->db->like("upper(n.descripcion)", $descripcionNandina, "both"); }
        if(strlen($mineralNandina) > 0) { $this->db->like("upper(m.descripcion)", $mineralNandina, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('n.codigo', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idNandina, $codigoNandina, $descripcionNandina, $mineralNandina){
        $idNandina = trim($idNandina);
        $codigoNandina = strtoupper(trim($codigoNandina));
        $descripcionNandina = strtoupper(trim($descripcionNandina));
        $mineralNandina = strtoupper(trim($mineralNandina));
        
        $sql = "select count(*) total ";
        $sql .= "from nandina n ";
        $sql .= "join mineral m on m.id = n.idmineral ";
        $sql .= "where n.id > 0 ";
        if(strlen($idNandina) > 0) { $sql .= "and n.id = ".$idNandina." "; }
        if(strlen($codigoNandina) > 0) { $sql .= "and upper(codigo) like '%".$codigoNandina."%' "; }
        if(strlen($descripcionNandina) > 0) { $sql .= "and upper(n.descripcion) like '%".$descripcionNandina."%' "; }
        if(strlen($mineralNandina) > 0) { $sql .= "and upper(m.descripcion) like '%".$mineralNandina."%' "; }
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
