<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CotizacionMinera_model extends CI_Model {
    
    public function buscar_cotizacionminera($idCotizacionMinera, $cotizacionMineraMineral, $cotizacionMineraDescripcion, $cotizacionMineraFecha, $inicio = FALSE, $cantidadregistro = FALSE){
        $idCotizacionMinera = trim($idCotizacionMinera);
        $cotizacionMineraMineral = strtoupper(trim($cotizacionMineraMineral));
        $cotizacionMineraFecha = trim($cotizacionMineraFecha);
        
        $this->db->select("m.id id, m.descripcion mineral, descripcionsincotizacion, simbolo, unidadcotizacion, cotizacionusd, alicuotaexterna, alicuotainterna, fechainicio, fechafin");
        $this->db->from("cotizacionmineral cm");
        $this->db->join("mineral m", "m.id = cm.idmineral");
        if(strlen($idCotizacionMinera) > 0) { $this->db->where("m.id", $idCotizacionMinera); }
        if(strlen($cotizacionMineraMineral) > 0) { $this->db->like("upper(m.descripcion)", $cotizacionMineraMineral, "both"); }
        if(strlen($cotizacionMineraDescripcion) > 0) { $this->db->like("upper(descripcionsincotizacion)", $cotizacionMineraDescripcion, "both"); }
        if(strlen($cotizacionMineraFecha) > 0) { $this->db->where("fechafin", $cotizacionMineraFecha); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('cm.id', 'asc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotal($idCotizacionMinera, $cotizacionMineraMineral, $cotizacionMineraDescripcion, $cotizacionMineraFecha){
        $idCotizacionMinera = trim($idCotizacionMinera);
        $cotizacionMineraMineral = strtoupper(trim($cotizacionMineraMineral));
        $cotizacionMineraDescripcion = strtoupper(trim($cotizacionMineraDescripcion));
        $cotizacionMineraFecha = trim($cotizacionMineraFecha);
        
        $sql = "select count(*) total ";
        $sql .= "from cotizacionmineral cm ";
        $sql .= "join mineral m on m.id = cm.idmineral ";
        $sql .= "where cm.id > 0 ";
        if(strlen($idCotizacionMinera) > 0) { $sql .= "and m.id = ".$idCotizacionMinera." "; }
        if(strlen($cotizacionMineraMineral) > 0) { $sql .= "and upper(m.descripcion) like '%".$cotizacionMineraMineral."%' "; }
        if(strlen($cotizacionMineraDescripcion) > 0) { $sql .= "and upper(m.descripcionsincotizacion) like '%".$cotizacionMineraDescripcion."%' "; }
        if(strlen($cotizacionMineraFecha) > 0) { $sql .= "and fechafin = '%".$cotizacionMineraFecha."%' "; }
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getfecha(){
        $this->db->distinct();
        $this->db->select("fechafin");
        $this->db->from("cotizacionmineral cm");
        $this->db->order_by('fechafin', 'desc');
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    
}


?>
