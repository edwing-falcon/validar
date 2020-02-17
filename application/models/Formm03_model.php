<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formm03_model extends CI_Model {
    
    public function getTotalBuscar($idM03Buscar, $codigoM03Buscar, $exportadorM03Buscar){
        $idM03Buscar = trim($idM03Buscar);
        $codigoM03Buscar = trim($codigoM03Buscar);
        $exportadorM03Buscar = strtoupper(trim($exportadorM03Buscar));
        
        $sql = "select count(*) total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "join aduana a on a.id = f.idaduana ";
        $sql .= "where f.id > 0 ";
        if(strlen($idM03Buscar) > 0){
            $sql .= "and f.id = ".$idM03Buscar." ";
            if(strlen($codigoM03Buscar) > 0){ $sql .= "and f.codigoformm03 like '%".$codigoM03Buscar."%' "; }
            if(strlen($exportadorM03Buscar) > 0){ $sql .= "and upper(o.nombre) like '%".$exportadorM03Buscar."%' "; }
        } else {
            if(strlen($codigoM03Buscar) > 0){
                $sql .= "and f.codigoformm03 like '%".$codigoM03Buscar."%' ";
            } else {
                if(strlen($exportadorM03Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
            
            if(strlen($exportadorM03Buscar) > 0){
                $sql .= "and upper(o.nombre) like '%".$exportadorM03Buscar."%' ";
            } else {
                if(strlen($codigoM03Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
        }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getFormm03Buscar($idM03Buscar, $codigoM03Buscar, $exportadorM03Buscar, $inicio = FALSE, $cantidadregistro = FALSE){
        $idM03Buscar = trim($idM03Buscar);
        $codigoM03Buscar = trim($codigoM03Buscar);
        $exportadorM03Buscar = strtoupper(trim($exportadorM03Buscar));
        
        $sql = "select f.id id, codigooperador, estadoreliquidacion03(f.id) estadoreliquidacion, codigoformm03, codigovalidador, oficinavalidacion, fechavalidacion, fechatransaccion, fecharegistro, fechadeclaracion, o.nim nim, o.nombre exportador, razonsocialcomprador comprador, totalkilosfinos, totalvbvbs, lote, a.descripcion as aduana, ef.descripcion as estado, case when f.estadorevision = 1 then 'SUJETO A REVISION' else '' end estadorevision ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "join aduana a on a.id = f.idaduana ";
        $sql .= "where f.id > 0 ";
        if(strlen($idM03Buscar) > 0){
            $sql .= "and f.id = ".$idM03Buscar." ";
            if(strlen($codigoM03Buscar) > 0){ $sql .= "and f.codigoformm03 like '%".$codigoM03Buscar."%' "; }
            if(strlen($exportadorM03Buscar) > 0){ $sql .= "and upper(o.nombre) like '%".$exportadorM03Buscar."%' "; }
        } else {
            if(strlen($codigoM03Buscar) > 0){
                $sql .= "and f.codigoformm03 like '%".$codigoM03Buscar."%' ";
            } else {
                if(strlen($exportadorM03Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
            
            if(strlen($exportadorM03Buscar) > 0){
                $sql .= "and upper(o.nombre) like '%".$exportadorM03Buscar."%' ";
            } else {
                if(strlen($codigoM03Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
        }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "limit ".$cantidadregistro." OFFSET ".$inicio." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getIDLugar($lugar){
        $lugar = trim($lugar);
        
        $sql = "select id from lugarnim where descripcion = '".$lugar."'; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->id;
        } else {
            return 0;
        }
    } 

    public function getTotalCriterioReliquidacionEscalar($idCriterioReliquidacionEscalar, $detalleCriterioReliquidacionEscalar){
        $idCriterioReliquidacionEscalar = trim($idCriterioReliquidacionEscalar);
        $detalleCriterioReliquidacionEscalar = strtoupper(trim($detalleCriterioReliquidacionEscalar));
        
        $sql = "select count(*) total ";
        $sql .= "from cri_escalar ";
        $sql .= "where id > 0 ";
        if(strlen($idCriterioReliquidacionEscalar) > 0) { $sql .= "and id = ".$idCriterioReliquidacionEscalar." "; }
        if(strlen($detalleCriterioReliquidacionEscalar) > 0) { $sql .= "and upper(detalle) like '%".$detalleCriterioReliquidacionEscalar."%' "; }
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getTotal($estado, $idM03, $M03Codigo, $exportadorM03, $compradorM03, $fronteraM03){
        $lugar = $this->session->userdata("lugar");    
        $idM03 = trim($idM03);
        $M03Codigo = trim($M03Codigo);
        $exportadorM03 = strtoupper(trim($exportadorM03));
        $compradorM03 = strtoupper(trim($compradorM03));
        $fronteraM03 = strtoupper(trim($fronteraM03));
                
        $sql = "select count(*) total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador op on op.id = f.idexportador ";
        $sql .= "join aduana a on a.id = f.idaduana ";
        $sql .= "where f.estado = ".$estado." ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        if(strlen($idM03) > 0) { $sql .= "and f.id = ".$idM03." "; }
        if(strlen($M03Codigo) > 0) { $sql .= "and codigoformm03 like '%".$M03Codigo."%' "; }
        if(strlen($exportadorM03) > 0) { $sql .= "and upper(op.nombre) like '%".$exportadorM03."%' "; }
        if(strlen($compradorM03) > 0) { $sql .= "and upper(razonsocialcomprador) like '%".$compradorM03."%' "; }
        if(strlen($fronteraM03) > 0) { $sql .= "and upper(a.descripcion) like '%".$fronteraM03."%' "; } 
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getRecepcion3($idM03Recepcion, $M03CodigoRecepcion, $exportadorM03Recepcion, $compradorM03Recepcion, $fronteraM03Recepcion, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        $idM03Recepcion = trim($idM03Recepcion);
        $M03CodigoRecepcion = trim($M03CodigoRecepcion);
        $exportadorM03Recepcion = strtoupper(trim($exportadorM03Recepcion));
        $compradorM03Recepcion = strtoupper(trim($compradorM03Recepcion));
        $fronteraM03Recepcion = strtoupper(trim($fronteraM03Recepcion));
        
        $this->db->select("f.id, codigoformm03, o.nim, o.nombre exportador, razonsocialcomprador comprador, fecharegistro, fechaexportacion, a.codigo codigofontera, a.descripcion frontera, lote, oficinavalidacion ");
        $this->db->from("formm03 f");
        $this->db->join("operador o", "o.id = f.idexportador");
        $this->db->join("aduana a", "a.id = f.idaduana");
        $this->db->where("f.estado", 1);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM03Recepcion) > 0) { $this->db->where("f.id", $idM03Recepcion); }
        if(strlen($M03CodigoRecepcion) > 0) { $this->db->like("codigoformm03", $M03CodigoRecepcion, "both"); }
        if(strlen($exportadorM03Recepcion) > 0) { $this->db->like("upper(o.nombre)", $exportadorM03Recepcion, "both"); }
        if(strlen($compradorM03Recepcion) > 0) { $this->db->like("upper(razonsocialcomprador)", $compradorM03Recepcion, "both"); }
        if(strlen($fronteraM03Recepcion) > 0) { $this->db->like("upper(a.descripcion)", $fronteraM03Recepcion, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotalNoReliquidadoReliquidacion($idnoReliquidadoReliquidacion){
        $idnoReliquidadoReliquidacion = trim($idnoReliquidadoReliquidacion);
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) total ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where estado = 4 ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idnoReliquidadoReliquidacion) > 0) { $sql .= "and idformm03 = ".$idnoReliquidadoReliquidacion." "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getNoReliquidadoReliquidacion($idnoReliquidadoReliquidacion, $inicio = FALSE, $cantidadregistro = FALSE){
        $idnoReliquidadoReliquidacion = trim($idnoReliquidadoReliquidacion);
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select idformm03, estado, oficinareliquidacion, codigoreliquidador, fechaenviomuestra, codigoenviomuestra, citeenviomuestra, mineralesreliquidacion03calculorm(idformm03) elementos, fechavalidacion, observacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where estado = 4 ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idnoReliquidadoReliquidacion) > 0) { $sql .= "and idformm03 = ".$idnoReliquidadoReliquidacion." "; }
        $sql .= "order by idformm03 desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalReliquidadoReliquidacion($idReliquidadoReliquidacion, $codigoReliquidadoReliquidacion, $exportadorReliquidadoReliquidacion){
        $idReliquidadoReliquidacion = trim($idReliquidadoReliquidacion);
        $codigoReliquidadoReliquidacion = strtoupper(trim($codigoReliquidadoReliquidacion));
        $exportadorReliquidadoReliquidacion = strtoupper(trim($exportadorReliquidadoReliquidacion));
        
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) total ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join entidadfinanciera ef on ef.id = r.identidadfinancierapago ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (2, 3) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idReliquidadoReliquidacion) > 0) { $sql .= "and r.idformm03 = ".$idReliquidadoReliquidacion." "; }
        if(strlen($codigoReliquidadoReliquidacion) > 0) { $sql .= "and upper(r.codigoenviomuestra) like '%".$codigoReliquidadoReliquidacion."%' "; }
        if(strlen($exportadorReliquidadoReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorReliquidadoReliquidacion."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getReliquidadoReliquidacion($idReliquidadoReliquidacion, $codigoReliquidadoReliquidacion, $exportadorReliquidadoReliquidacion, $inicio = FALSE, $cantidadregistro = FALSE){
        $idReliquidadoReliquidacion = trim($idReliquidadoReliquidacion);
        $codigoReliquidadoReliquidacion = strtoupper(trim($codigoReliquidadoReliquidacion));
        $exportadorReliquidadoReliquidacion = strtoupper(trim($exportadorReliquidadoReliquidacion));
        
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select r.id id, idformm03, codigoreliquidador, r.codigoenviomuestra codigoenviomuestra, r.fechaenvionotificacion fechaenvionotificacion, fecharecepcionnotificacion, mineralesreliquidacion03calculorm(idformm03) elementos, er.descripcion as estado, fechareliquidacion, o.nombre exportador, ef.descripcion as entidadfinanciera, nrocuentapago, nrodepositopago, fechadepositopago, case when length(nrodepositopago) = 0 then 'SIN PAGAR' else 'PAGADO' end as pago ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join entidadfinanciera ef on ef.id = r.identidadfinancierapago ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (2, 3) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idReliquidadoReliquidacion) > 0) { $sql .= "and r.idformm03 = ".$idReliquidadoReliquidacion." "; }
        if(strlen($codigoReliquidadoReliquidacion) > 0) { $sql .= "and upper(r.codigoenviomuestra) like '%".$codigoReliquidadoReliquidacion."%' "; }
        if(strlen($exportadorReliquidadoReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorReliquidadoReliquidacion."%' "; }
        $sql .= "order by r.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalPendienteReliquidacion($idPendienteReliquidacion, $codigoPendienteReliquidacion, $exportadorPendienteReliquidacion){
        $idPendienteReliquidacion = trim($idPendienteReliquidacion);
        $codigoPendienteReliquidacion = strtoupper(trim($codigoPendienteReliquidacion));
        $exportadorPendienteReliquidacion = strtoupper(trim($exportadorPendienteReliquidacion));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) total ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (1) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idPendienteReliquidacion) > 0) { $sql .= "and r.idformm03 = ".$idPendienteReliquidacion." "; }
        if(strlen($codigoPendienteReliquidacion) > 0) { $sql .= "and upper(r.codigoenviomuestra) like '%".$codigoPendienteReliquidacion."%' "; }
        if(strlen($exportadorPendienteReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorPendienteReliquidacion."%' "; }
        
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getPendienteReliquidacion($idPendienteReliquidacion, $codigoPendienteReliquidacion, $exportadorPendienteReliquidacion, $inicio = FALSE, $cantidadregistro = FALSE){
        $idPendienteReliquidacion = trim($idPendienteReliquidacion);
        $codigoPendienteReliquidacion = strtoupper(trim($codigoPendienteReliquidacion));
        $exportadorPendienteReliquidacion = strtoupper(trim($exportadorPendienteReliquidacion));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select fechareliquidacion, citenotificacion, r.id id, idformm03, codigoreliquidador, upper(tiporeliquidacion) tiporeliquidacion, mineralesreliquidacion03calculorm(idformm03) elementos, r.fechaenviomuestra fechaenviomuestra, r.codigoenviomuestra codigoenviomuestra, r.citeenviomuestra citeenviomuestra, r.fechaenvionotificacion as fechaenvionotificacion, r.fecharecepcionnotificacion as fecharecepcionnotificacion, o.nombre as exportador ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (1) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idPendienteReliquidacion) > 0) { $sql .= "and r.idformm03 = ".$idPendienteReliquidacion." "; }
        if(strlen($codigoPendienteReliquidacion) > 0) { $sql .= "and upper(r.codigoenviomuestra) like '%".$codigoPendienteReliquidacion."%' "; }
        if(strlen($exportadorPendienteReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorPendienteReliquidacion."%' "; }
        $sql .= "order by r.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalMuestreoReliquidacion($idMuestreoReliquidacion, $codigoMuestreoReliquidacion1, $codigoMuestreoReliquidacion2, $exportadorMuestreoReliquidacion){
        $lugar = $this->session->userdata("lugar");
        $idMuestreoReliquidacion = trim($idMuestreoReliquidacion);
        $codigoMuestreoReliquidacion1 = strtoupper(trim($codigoMuestreoReliquidacion1));
        $codigoMuestreoReliquidacion2 = strtoupper(trim($codigoMuestreoReliquidacion2));
        $exportadorMuestreoReliquidacion = strtoupper(trim($exportadorMuestreoReliquidacion));
        
        $sql = "select count( distinct f.id ) total ";
        $sql .= "from formm03 f ";
        $sql .= "join formm03calculorm fc on fc.idformm03 = f.id ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and f.id not in (30333) ";
        $sql .= "and f.estado in (2, 3) ";
        $sql .= "and fc.idmineral in ( select idmineral from cri_mineral ) ";
        $sql .= "and f.id not in ( select idformm03 from reliquidacion03 where estado in (1, 2, 3, 4) ) ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        if(strlen($idMuestreoReliquidacion) > 0) { $sql .= "and f.id = ".$idMuestreoReliquidacion." "; }
        if(strlen($codigoMuestreoReliquidacion1) > 0) { $sql .= "and upper(f.codigoenviomuestra) like '%".$codigoMuestreoReliquidacion1."%' "; }
        if(strlen($codigoMuestreoReliquidacion2) > 0) { $sql .= "and upper(f.codigomuestra) like '%".$codigoMuestreoReliquidacion2."%' "; }
        if(strlen($exportadorMuestreoReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorMuestreoReliquidacion."%' "; }
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getMuestreoReliquidacion($idMuestreoReliquidacion, $codigoMuestreoReliquidacion1, $codigoMuestreoReliquidacion2, $exportadorMuestreoReliquidacion, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        $idMuestreoReliquidacion = trim($idMuestreoReliquidacion);
        $codigoMuestreoReliquidacion1 = strtoupper(trim($codigoMuestreoReliquidacion1));
        $codigoMuestreoReliquidacion2 = strtoupper(trim($codigoMuestreoReliquidacion2));
        $exportadorMuestreoReliquidacion = strtoupper(trim($exportadorMuestreoReliquidacion));
        
        $sql = "select distinct f.id idformm03, o.nombre exportador, mineralesformm03calculorm(f.id) mineral, lote, case when humedad is null then 0 else humedad end as humedad, fechamuestra, codigoenviomuestra, codigomuestra, citeenviomuestra ";
        $sql .= "from formm03 f ";
        $sql .= "join formm03calculorm fc on fc.idformm03 = f.id ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and f.id not in (30333) ";
        $sql .= "and f.estado in (2, 3) ";
        $sql .= "and fc.idmineral in ( select idmineral from cri_mineral ) ";
        $sql .= "and f.id not in ( select idformm03 from reliquidacion03 where estado in (1, 2, 3, 4) ) ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        if(strlen($idMuestreoReliquidacion) > 0) { $sql .= "and f.id = ".$idMuestreoReliquidacion." "; }
        if(strlen($codigoMuestreoReliquidacion1) > 0) { $sql .= "and upper(f.codigoenviomuestra) like '%".$codigoMuestreoReliquidacion1."%' "; }
        if(strlen($codigoMuestreoReliquidacion2) > 0) { $sql .= "and upper(f.codigomuestra) like '%".$codigoMuestreoReliquidacion2."%' "; }
        if(strlen($exportadorMuestreoReliquidacion) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorMuestreoReliquidacion."%' "; }
        $sql .= "order by f.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function depurarM03(){
        $lugar = $this->session->userdata("lugar");
        $sql = "select * from depurarM03('".$lugar."'); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return 1;
        } else {
            return 0;
        }
    }
    
    public function getDatosTabla($sql, $campo){
        $campo = trim($campo);
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila = $query->row();
            return $fila->$campo;
        } else {
            return "";
        }
    }

    public function criterio_operador(){
        $lugar = $this->session->userdata("lugar"); 
        $idLugar = $this->Formm03_model->getIDLugar($lugar);
        
        $var = "select count(*) total ";
        $var .= "from cri_operador ";
        $var .= "where idlugar = ".$idLugar."; ";
        $query = $this->db->query($var);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getTotalCriterioReliquidacionMineral($idCriterioReliquidacionMineral, $mineralCriterioReliquidacionMineral){
        $idCriterioReliquidacionMineral = trim($idCriterioReliquidacionMineral);
        $mineralCriterioReliquidacionMineral = strtoupper(trim($mineralCriterioReliquidacionMineral));
        
        $sql = "select count(*) as total ";
        $sql .= "from cri_mineral cm ";
        $sql .= "join mineral m on m.id = cm.idmineral ";
        $sql .= "where m.id > 0 ";
        if(strlen($idCriterioReliquidacionMineral) > 0) { $sql .= "and m.id = ".$idCriterioReliquidacionMineral." "; }
        if(strlen($mineralCriterioReliquidacionMineral) > 0) { $sql .= "and upper(m.descripcion) like '%".$mineralCriterioReliquidacionMineral."%' "; }
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getCriterioReliquidacionMineral($idCriterioReliquidacionMineral, $mineralCriterioReliquidacionMineral, $inicio = FALSE, $cantidadregistro = FALSE){
        $idCriterioReliquidacionMineral = trim($idCriterioReliquidacionMineral);
        $mineralCriterioReliquidacionMineral = strtoupper(trim($mineralCriterioReliquidacionMineral));
        
        $sql = "select m.id id, m.descripcion mineral, simbolo, unidadcotizacion ";
        $sql .= "from cri_mineral cm ";
        $sql .= "join mineral m on m.id = cm.idmineral ";
        $sql .= "where m.id > 0 ";
        if(strlen($idCriterioReliquidacionMineral) > 0) { $sql .= "and m.id = ".$idCriterioReliquidacionMineral." "; }
        if(strlen($mineralCriterioReliquidacionMineral) > 0) { $sql .= "and upper(m.descripcion) like '%".$mineralCriterioReliquidacionMineral."%' "; }
        $sql .= "order by m.descripcion ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "limit ".$cantidadregistro." OFFSET ".$inicio." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalCriterioReliquidacionOperador($idCriterioReliquidacionOperador, $operadorCriterioReliquidacionOperador){
        $lugar = $this->session->userdata("lugar");
        $idLugar = $this->Formm03_model->getIDLugar($lugar);
        $idCriterioReliquidacionOperador = trim($idCriterioReliquidacionOperador);
        $operadorCriterioReliquidacionOperador = strtoupper(trim($operadorCriterioReliquidacionOperador));
        
        $sql = "select count(*) total ";
        $sql .= "from cri_operador co ";
        $sql .= "join operador op on op.id = co.idoperador ";
        $sql .= "where co.idlugar = ".$idLugar." ";
        if(strlen($idCriterioReliquidacionOperador) > 0) { $sql .= "and co.id = ".$idCriterioReliquidacionOperador." "; }
        if(strlen($operadorCriterioReliquidacionOperador) > 0) { $sql .= "and upper(op.nombre) like '%".$operadorCriterioReliquidacionOperador."%' "; }
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getCriterioReliquidacionOperador($idCriterioReliquidacionOperador, $operadorCriterioReliquidacionOperador, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar");
        $idLugar = $this->Formm03_model->getIDLugar($lugar);
        $idCriterioReliquidacionOperador = trim($idCriterioReliquidacionOperador);
        $operadorCriterioReliquidacionOperador = strtoupper(trim($operadorCriterioReliquidacionOperador));
        
        $this->db->select("op.id id, op.nombre operador ");
        $this->db->from("cri_operador co");
        $this->db->join("operador op", "op.id = co.idoperador");
        $this->db->where("co.idlugar", $idLugar);
        if(strlen($idCriterioReliquidacionOperador) > 0) { $this->db->where("op.id", $idCriterioReliquidacionOperador); }
        if(strlen($operadorCriterioReliquidacionOperador) > 0) { $this->db->like("upper(op.nombre)", $operadorCriterioReliquidacionOperador, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('op.nombre', 'asc');
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function criterio_escalar(){
        $var = "select 'and ' || campo || ' ' || tipo || ' ' || escalar || ' ' criterio ";
        $var .= "from cri_escalar ";
        $var .= "where id > 0 ";
        $var .= "order by id; ";
        $consulta = $this->db->query($var);
        $datos = $consulta->result();
        
        $salida = "";
        foreach ($datos as $recep){
            $salida .= $recep->criterio;
        }
        
        return $salida;
    }
    
    public function getCriterioReliquidacionEscalar($idCriterioReliquidacionEscalar, $detalleCriterioReliquidacionEscalar, $inicio = FALSE, $cantidadregistro = FALSE){
        $idCriterioReliquidacionEscalar = trim($idCriterioReliquidacionEscalar);
        $detalleCriterioReliquidacionEscalar = strtoupper(trim($detalleCriterioReliquidacionEscalar));
        
        $this->db->select("id, detalle, campo, tipo, escalar ");
        $this->db->from("cri_escalar");
        if(strlen($idCriterioReliquidacionEscalar) > 0) { $this->db->where("id", $idCriterioReliquidacionEscalar); }
        if(strlen($detalleCriterioReliquidacionEscalar) > 0) { $this->db->like("upper(detalle)", $detalleCriterioReliquidacionEscalar, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('id', 'asc');
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getConcluido3($idM03Concluido, $M03CodigoConcluido, $exportadorM03Concluido, $compradorM03Concluido, $fronteraM03Concluido, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        
        $idM03Concluido = trim($idM03Concluido);
        $M03CodigoConcluido = trim($M03CodigoConcluido);
        $exportadorM03Concluido = strtoupper(trim($exportadorM03Concluido));
        $compradorM03Concluido = strtoupper(trim($compradorM03Concluido));
        $fronteraM03Concluido = strtoupper(trim($fronteraM03Concluido));
        
        $this->db->select("f.id id, codigoformm03, o.nim, codigovalidador, o.nombre exportador, razonsocialcomprador comprador, fechaexportacion, a.codigo codigofontera, a.descripcion frontera, lote, oficinavalidacion, banderaarchivodigital ");
        $this->db->from("formm03 f");
        $this->db->join("operador o", "o.id = f.idexportador");
        $this->db->join("aduana a", "a.id = f.idaduana");
        $this->db->where("f.estado", 2);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM03Concluido) > 0) { $this->db->where("f.id", $idM03Concluido); }
        if(strlen($M03CodigoConcluido) > 0) { $this->db->like("codigoformm03", $M03CodigoConcluido, "both"); }
        if(strlen($exportadorM03Concluido) > 0) { $this->db->like("upper(o.nombre)", $exportadorM03Concluido, "both"); }
        if(strlen($compradorM03Concluido) > 0) { $this->db->like("upper(razonsocialcomprador)", $compradorM03Concluido, "both"); }
        if(strlen($fronteraM03Concluido) > 0) { $this->db->like("upper(a.descripcion)", $fronteraM03Concluido, "both"); }

        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');

        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getRechazado3($idM03Rechazado, $M03CodigoRechazado, $exportadorM03Rechazado, $compradorM03Rechazado, $fronteraM03Rechazado, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        $idM03Rechazado = trim($idM03Rechazado);
        $M03CodigoRechazado = trim($M03CodigoRechazado);
        $exportadorM03Rechazado = strtoupper(trim($exportadorM03Rechazado));
        $compradorM03Rechazado = strtoupper(trim($compradorM03Rechazado));
        $fronteraM03Rechazado = strtoupper(trim($fronteraM03Rechazado));
        
        $this->db->select("f.id, codigoformm03, o.nim, o.nombre exportador, razonsocialcomprador comprador, fechaexportacion,  a.codigo codigofontera, a.descripcion frontera, lote, oficinavalidacion, contador_rechazo_formm03(f.id) contador_rechazo ");
        $this->db->from("formm03 f");
        $this->db->join("operador o", "o.id = f.idexportador");
        $this->db->join("aduana a", "a.id = f.idaduana");
        $this->db->where("f.estado", 10);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM03Rechazado) > 0) { $this->db->where("f.id", $idM03Rechazado); }
        if(strlen($M03CodigoRechazado) > 0) { $this->db->like("codigoformm03", $M03CodigoRechazado, "both"); }
        if(strlen($exportadorM03Rechazado) > 0) { $this->db->like("upper(o.nombre)", $exportadorM03Rechazado, "both"); }
        if(strlen($compradorM03Rechazado) > 0) { $this->db->like("upper(razonsocialcomprador)", $compradorM03Rechazado, "both"); }
        if(strlen($fronteraM03Rechazado) > 0) { $this->db->like("upper(a.descripcion)", $fronteraM03Rechazado, "both"); }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function delete($tabla, $estado){
        $usuario = $this->session->userdata("usuario");

        $this->db->where('codigooperador', $usuario);
        $this->db->where('estado', $estado);
        $this->db->delete($tabla);
    }
    
    public function getCodigo($id){
        $sql = "select codigoformm03 ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$id."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->codigoformm03;
        } else {
            return "";
        }
    }
    
    public function getDatosTransaccion($tabla, $id){
        $tabla = trim($tabla);

        $this->db->select("f.id id, codigoformm03, o.nim nim, o.nombre exportador, o.documento nnit, o.ruex ruex, fechaexportacion, fechatransaccion, l.descripcion laboratorio, certificadoanalisis, a.descripcion aduanasalida, a.codigo codigoaduana, nrofactura, tipocambiobs, p.descripcion paisdestino, razonsocialcomprador, fob, pre.descripcion presentacion, pbh, tara, pnh, humedad, mermaporcentaje, mermakg, pns, lote, totalvbvusd, totalvbvbs, vnv, gastosacordado, totaldeducciones, liquido, fechavalidacion ");
        $this->db->from($tabla." f");
        $this->db->join("operador o", "o.id = f.idexportador");
        $this->db->join("laboratorio l", "l.id = f.idlaboratorio");
        $this->db->join("aduana a", "a.id = f.idaduana");
        $this->db->join("iso3166pais p", "p.id = f.idiso3166pais");
        $this->db->join("presentacionproducto pre", "pre.id = f.idpresentacionproducto"); 
        $this->db->where("f.id", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function getEstado($id){
        $id = trim($id);
        
        $sql = "select distinct f.estado id, CASE WHEN f.estado = -7 THEN 'RECTIFICACION NO VALIDA' WHEN f.estado = -3 THEN 'ANULADO POR DUPLICIDAD EN LA TRANSCRIPCION' WHEN f.estado = -2 THEN 'FORMULARIOS CON ERRORES DE DECLARACION' WHEN f.estado = 0 THEN 'DECLARADO' WHEN f.estado = 1 THEN 'PENDIENTE' WHEN f.estado = 2 THEN 'VALIDADO' WHEN f.estado = 3 THEN 'TRANSCRITO POR SINACOM' WHEN f.estado = 4 THEN 'ANULADO DESPUES DE SER VALIDADO' WHEN f.estado = 5 THEN 'ELIMINADO' WHEN f.estado = 6 THEN 'FORMULARIO A SER RECTIFICADO' WHEN f.estado = 7 THEN 'RECTIFICADO ACTUALIZADO' WHEN f.estado = 10 THEN 'RECHAZADO' WHEN f.estado = 12 THEN 'SIN ESTADO' WHEN f.estado = 13 THEN 'FORMULARIOS RELIQUIDADOS' WHEN f.estado = 1010 THEN 'SIN ESTADO' ELSE NULL END AS estado "; 
        $sql .= "from formm03 f ";
        $sql .= "where id = ".$id." ";
        $sql .= "order by f.estado; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->estado;
        } else {
            return "";
        }
            
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getDato($sql, $campo, $tipo){
        $sql = trim($sql);
        $campo = trim($campo);
        $tipo = trim($tipo);

        if($tipo == 'string') { $salida = ""; }
        if($tipo == 'int') { $salida = 0; }
        if($tipo == 'float') { $salida = 0; }
        if($tipo == 'date') { $salida = "1900-01-01"; }
        if($tipo == 'time') { $salida = "00:00"; }

        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->$campo;
        } else {
            return $salida;
        }
    }

    public function getRechazos(){
        $this->db->select("id, detalle ");
        $this->db->from("rechazo");
	$this->db->where("estado",1);
        $this->db->order_by("id", "asc");
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getDatosRegalia($id){
        $sql = "select fvr.id id, idformm03, elemento, fvr.idmineral, fvr.codigonandina nandina, n.descripcion descrinandina, leyvalor leymineral, leyunidad,  pesofinokg, pesofino, cotizacionmineral, cotizacionunidad, valorbrutousd, valorbrutobs, alicuotaexterna, importermusd regaliausb, importermbs regaliabs ";
        $sql .= "from formm03calculorm fvr ";
        $sql .= "join nandina n on n.id = fvr.idnandina ";
        $sql .= "join mineral m on m.id = fvr.idmineral ";
        $sql .= "where fvr.idformm03 = ".$id." ";
        $sql .= "order by fvr.id desc; ";
        $resultados = $this->db->query($sql);
        if($resultados->num_rows() >0){
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getTotalRegaliaMinera($id){
        $this->db->select("sum(pesofinokg) suma_pesofino, sum(valorbrutousd) suma_vbvusb, sum(valorbrutobs) suma_vbvbs, sum(importermbs) suma_regalia ");
        $this->db->from("formm03calculorm");
        $this->db->where("idformm03", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getAporteDepartamental($id){
        $this->db->select("fd.id id, m.codigo codigo, importermbs, municipio, aportemunicipalbs, departamento, aportedepartamentalbs, ef.descripcion entidadfinanciera, nrodeorden, fechadeposito");
        $this->db->from("formm03 f");
        $this->db->join("formm03distribucionrm fd", "fd.idformm03 = f.id");
        $this->db->join("municipio m", "m.id = fd.idmunicipio");
        $this->db->join("entidadfinanciera ef", "ef.id = fd.identidadfinanciera");
        $this->db->where("f.id", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getTotalAporteDepartamental($id){
        $this->db->select("sum(importermbs) suma_importermbs, sum(aportemunicipalbs) suma_aportemunicipalbs, sum(aportedepartamentalbs) suma_aportedepartamentalbs");
        $this->db->from("formm03 f");
        $this->db->join("formm03distribucionrm fd", "fd.idformm03 = f.id");
        $this->db->join("municipio m", "m.id = fd.idmunicipio");
        $this->db->join("entidadfinanciera ef", "ef.id = fd.identidadfinanciera");
        $this->db->where("f.id", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getFormm03Aporte($id){
        $this->db->select("fa.id id, ea.descripcion entidad_aporte, tipobaseaporte, valorbaseaportebs, porcentajeaporte, importebs, ef.descripcion entidad_financiera, nrocuenta, nrodeposito, fechadeposito ");
        $this->db->from("formm03aporte fa");
        $this->db->join("entidadaporte ea", "ea.id = fa.identidadaporte");
        $this->db->join("entidadfinanciera ef", "ef.id = fa.identidadfinanciera");
        $this->db->where("idformm03", $id);
        $this->db->order_by('fa.id', 'desc'); 
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getTotalImporte($id){
        $this->db->select("sum(importebs) suma_importe ");
        $this->db->from("formm03aporte fa");
        $this->db->join("entidadaporte ea", "ea.id = fa.identidadaporte");
        $this->db->join("entidadfinanciera ef", "ef.id = fa.identidadfinanciera");
        $this->db->where("idformm03", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getBitacoras($id){
        $sql = "select b.idformm03 idformm03, b.fecha fecha, m.idbitacorarechazo idbitacorarechazo, r.detalle detalle, b.obsmal obsmal, u.usuario usuario, l.descripcion lugar ";
        $sql .= "from bitacorarechazo b ";
        $sql .= "join motivo m on m.idbitacorarechazo = b.id ";
        $sql .= "join rechazo r on r.id = m.idrechazo ";
        $sql .= "join usuario u on u.id = b.idusuario ";
        $sql .= "join lugarnim l on l.id = u.lugar ";
        $sql .= "where idformm03 = ".$id."; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function getFechaActual(){
        $sql = "select now() fecha_actual; ";
        $query = $this->db->query($sql);
        $fila=$query->row();
        $fechaLarga = $fila->fecha_actual;

        $fecha = substr($fechaLarga, 0, 10);

        return $fecha;
    }
    
    public function getFechaLarga($fechaActual){
        $fechaActual = trim($fechaActual);
        $mesLiteral = "";
        
        $anio = substr($fechaActual, 0, 4);
        $mes = substr($fechaActual, 5, 2);
        $dia = substr($fechaActual, 8, 2);
        
        if($dia == "01") { $dia = "1"; }
        if($dia == "02") { $dia = "2"; }
        if($dia == "03") { $dia = "3"; }
        if($dia == "04") { $dia = "4"; }
        if($dia == "05") { $dia = "5"; }
        if($dia == "06") { $dia = "6"; }
        if($dia == "07") { $dia = "7"; }
        if($dia == "08") { $dia = "8"; }
        if($dia == "09") { $dia = "9"; }
        
        if($mes == "01") { $mesLiteral = "enero"; }
        if($mes == "02") { $mesLiteral = "febrero"; }
        if($mes == "03") { $mesLiteral = "marzo"; }
        if($mes == "04") { $mesLiteral = "abril"; }
        if($mes == "05") { $mesLiteral = "mayo"; }
        if($mes == "06") { $mesLiteral = "junio"; }
        if($mes == "07") { $mesLiteral = "julio"; }
        if($mes == "08") { $mesLiteral = "agosto"; }
        if($mes == "09") { $mesLiteral = "septiembre"; }
        if($mes == "10") { $mesLiteral = "octubre"; }
        if($mes == "11") { $mesLiteral = "noviembre"; }
        if($mes == "12") { $mesLiteral = "diciembre"; }
        
        return $dia." de ".$mesLiteral." de ".$anio;
    }
    
    public function getLugar($lugar, $tipo){
        $lugar = trim($lugar);
        $tipo = trim($tipo);
        $salida = "";
        
        if($tipo == "abreviacion"){
            if($lugar == "BENI") { $salida = "BN"; }    
            if($lugar == "CHUQUISACA") { $salida = "CH"; }    
            if($lugar == "COCHABAMBA") { $salida = "CB"; }    
            if($lugar == "LA PAZ") { $salida = "LP"; }    
            if($lugar == "ORURO") { $salida = "OR"; }    
            if($lugar == "PANDO") { $salida = "PA"; }    
            if($lugar == "POTOSI") { $salida = "PT"; }    
            if($lugar == "SANTA CRUZ") { $salida = "SC"; }    
            if($lugar == "TARIJA") { $salida = "TJ"; }
        }
        
        if($tipo == "minuscula"){
            if($lugar == "BENI") { $salida = "Beni"; }    
            if($lugar == "CHUQUISACA") { $salida = "Chuquisaca"; }    
            if($lugar == "COCHABAMBA") { $salida = "Cochabamba"; }
            if($lugar == "LA PAZ") { $salida = "La Paz"; }
            if($lugar == "ORURO") { $salida = "Oruro"; }
            if($lugar == "PANDO") { $salida = "Pando"; }    
            if($lugar == "POTOSI") { $salida = "Potosí"; }    
            if($lugar == "SANTA CRUZ") { $salida = "Santa Cruz"; }    
            if($lugar == "TARIJA") { $salida = "Tarija"; }
        }
        return $salida;
    }
    
    public function getMayor($tabla, $campo){
        $tabla = trim($tabla);
        $campo = trim($campo);

        $sql = "select ".$campo."+1 id from ".$tabla." order by ".$campo." desc limit 1; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->id;
        } else {
            return 1;
        }
    }
    
    public function add($tabla, $data){
        $this->db->insert($tabla, $data);
        if ($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getOperadorM03(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct op.id id, nombre, nim ";
        $sql .= "from formm03 f ";
        $sql .= "join operador op on op.id = f.idexportador ";
        $sql .= "where oficinavalidacion = '".$lugar."' ";
        $sql .= "order by nombre; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function encriptar($entrada){
        $entrada = trim($entrada);
        $salida = "";
        
        for($i=0; $i<strlen($entrada); $i++){
            $letra = substr($entrada, $i, 1);
            
            if($letra == "0") { $salida .= "Q"; }
            if($letra == "1") { $salida .= "1"; }
            if($letra == "2") { $salida .= "E"; }
            if($letra == "3") { $salida .= "F"; }
            if($letra == "4") { $salida .= "G"; }
            if($letra == "5") { $salida .= "3"; }
            if($letra == "6") { $salida .= "B"; }
            if($letra == "7") { $salida .= "7"; }
            if($letra == "8") { $salida .= "9"; }
            if($letra == "9") { $salida .= "X"; }
        }
        
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen(trim($characters));
        $randomString = "";
        
        for ($i = 1; $i <= 40; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $randomString = trim($randomString);
        $salida = trim($salida);
        return $randomString.$salida;
    }

    public function desemcriptar($entrada){
        $salida = "";
        $entrada = trim($entrada);
        $tam = strlen($entrada)-40;
        $entrada_new = substr($entrada, 40, $tam);
        $entrada_new = trim($entrada_new);

        for($i=0; $i<strlen($entrada_new); $i++){
            $letra = substr($entrada_new, $i, 1);
            
            if($letra == "Q") { $salida .= "0"; }
            if($letra == "1") { $salida .= "1"; }
            if($letra == "E") { $salida .= "2"; }
            if($letra == "F") { $salida .= "3"; }
            if($letra == "G") { $salida .= "4"; }
            if($letra == "3") { $salida .= "5"; }
            if($letra == "B") { $salida .= "6"; }
            if($letra == "7") { $salida .= "7"; }
            if($letra == "9") { $salida .= "8"; }
            if($letra == "X") { $salida .= "9"; }
        }
        
        $salida = trim($salida);
        return $salida;
    }
    
    public function getCountClasificacionMineral($idformm03, $criterio, $tiporeliquidacion){
        $idformm03 = trim($idformm03);
        $criterio = trim($criterio);
        $tiporeliquidacion = trim($tiporeliquidacion);
                
        $sql = "select count(distinct clasificacionmineral) cantidad ";
        $sql .= "from reliquidacion03calculorm rm ";
        if(strlen($criterio) > 0) { $sql .= "join cri_mineral cm on cm.idmineral = rm.idmineral and cm.idnandina = rm.idnandina "; }
        $sql .= "where rm.idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = '".$tiporeliquidacion."'; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->cantidad;
        } else {
            return 0;
        }
    }
    
    public function getClasificacionMineral($idformm03, $criterio, $tiporeliquidacion){
        $idformm03 = trim($idformm03);
        $criterio = trim($criterio);
        $tiporeliquidacion = trim($tiporeliquidacion);
        
        $sql = "select distinct CASE WHEN clasificacionmineral = 'NO METALICO' THEN 'Peso Neto Seco [Kg.]' WHEN clasificacionmineral = 'METALICO' THEN 'Peso Neto Humedo [Kg.]' WHEN clasificacionmineral = 'METAL' THEN 'Peso Neto Seco [Kg.]' WHEN clasificacionmineral = 'MANUFACTURA METALICO' THEN 'Peso Neto Seco [Kg.]' ELSE NULL END AS clasificacionmineral ";
        $sql .= "from reliquidacion03calculorm rm ";
        if(strlen($criterio) > 0) { $sql .= "join cri_mineral cm on cm.idmineral = rm.idmineral and cm.idnandina = rm.idnandina "; }
        $sql .= "where rm.idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = '".$tiporeliquidacion."' ";
        $sql .= "order by clasificacionmineral; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }

    public function getMineralesRegistrados($id, $criterio, $tiporeliquidacion){
        $id = trim($id);
        $criterio = trim($criterio);
        $tiporeliquidacion = trim($tiporeliquidacion);
                
        $sql = "select rm.id id, idmineral, elemento, rm.simbolo simbolo, codigonandina, clasificacionmineral, rm.descripcion, leyvalor_declarado, leyunidad_declarado, leyvalor, leyunidad, rm.estado, CASE WHEN rm.estado = 1 THEN 'VALIDO PARA RELIQUIDAR' WHEN rm.estado = 0 THEN 'NO VALIDO PARA RELIQUIDAR' ELSE NULL END AS estadodescri ";
        $sql .= "from reliquidacion03calculorm rm ";
        //if(strlen($criterio) > 0) { $sql .= "join cri_mineral cm on cm.idmineral = rm.idmineral and cm.idnandina = rm.idnandina "; }
        $sql .= "join mineral m on m.id = rm.idmineral ";
        $sql .= "where idformm03 = ".$id." ";
        $sql .= "and tiporeliquidacion = '".$tiporeliquidacion."' ";
        $sql .= "order by rm.id; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getReliquidacionHumedad($idformm03){
        $idformm03 = trim($idformm03);
        
        $sql = "select * from getReliquidacionHumedad(".$idformm03."); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function getReliquidacionLeyHumedad($idformm03){
        $idformm03 = trim($idformm03);
        
        $sql = "select * from getreliquidacionleyhumedad(".$idformm03."); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function getReliquidacionLey($idformm03){
        $idformm03 = trim($idformm03);
        
        $sql = "select * from getReliquidacionLey(".$idformm03."); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function getReliquidacionPeso($idformm03){
        $idformm03 = trim($idformm03);
        
        $sql = "select * from getReliquidacionPeso(".$idformm03."); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }
    
    public function getEstaReliquidadorPor($idformm03, $tiporeliquidacion){
        $idformm03 = trim($idformm03);
        $tiporeliquidacion = trim($tiporeliquidacion);
        
        $sql = "select idformm03 from reliquidacion03 where idformm03 = ".$idformm03." and tiporeliquidacion = '".$tiporeliquidacion."'; ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $query->row();
            return $fila->idformm03;
        } else {
            return "";
        }
    }
    
    public function getRelacionadorM03M02($idformm03){
        $idformm03 = trim($idformm03);
        
        $sql = "select id, idformm03, idformm02, obs ";
        $sql .= "from relacionadorm03m02 ";
        $sql .= "where idformm03 = ".$idformm03."; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function getTotalDeclarado($exportadorM03Declarado){
        $exportadorM03Declarado = strtoupper(trim($exportadorM03Declarado));
        $lugar = $this->session->userdata("lugar"); 
        
        $sql = "select count(distinct nim) total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador op on op.id = f.idexportador ";
        $sql .= "where f.estado = 0 ";
        if(strlen($exportadorM03Declarado) > 0) { $sql .= "and upper(op.nombre) like '%".$exportadorM03Declarado."%' "; }
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getDeclaradoResumen($exportadorM03Declarado, $inicio = FALSE, $cantidadregistro = FALSE){
        $exportadorM03Declarado = strtoupper(trim($exportadorM03Declarado));
        $lugar = $this->session->userdata("lugar"); 
        
        $sql = "select op.nombre empresa, nim, op.id id, count(op.nombre) cantidad ";
        $sql .= "from formm03 f ";
        $sql .= "join operador op on op.id = f.idexportador ";
        $sql .= "where f.estado = 0 ";
        if(strlen($exportadorM03Declarado) > 0) { $sql .= "and upper(op.nombre) like '%".$exportadorM03Declarado."%' "; }
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "group by op.id, op.nombre, nim ";
        $sql .= "order by count(op.nombre) desc, op.nombre asc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "limit ".$cantidadregistro." OFFSET ".$inicio." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalNIM($estado, $nim, $idM03DeclaradoDetalle, $compradorM03DeclaradoDetalle){
        $nim = trim($nim);
        $idM03DeclaradoDetalle = trim($idM03DeclaradoDetalle);
        $compradorM03DeclaradoDetalle = strtoupper(trim($compradorM03DeclaradoDetalle));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador op on op.id = f.idexportador ";
        $sql .= "where f.estado = ".$estado." ";
        $sql .= "and f.oficinavalidacion = '".$lugar."' ";
        $sql .= "and op.nim = '".$nim."' ";
        if(strlen($idM03DeclaradoDetalle) > 0) { $sql .= "and f.id = ".$idM03DeclaradoDetalle." "; }
        if(strlen($compradorM03DeclaradoDetalle) > 0) { $sql .= "and upper(razonsocialcomprador) like '%".$compradorM03DeclaradoDetalle."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getDeclaradosDetalle($nim, $idM03DeclaradoDetalle, $compradorM03DeclaradoDetalle, $inicio = FALSE, $cantidadregistro = FALSE){
        $nim = trim($nim);
        $idM03DeclaradoDetalle = trim($idM03DeclaradoDetalle);
        $compradorM03DeclaradoDetalle = strtoupper(trim($compradorM03DeclaradoDetalle));
        $lugar = $this->session->userdata("lugar"); 
        
        $this->db->select("f.id as id, o.nombre as exportador, razonsocialcomprador, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from("formm03 f");
        $this->db->join("operador o", "o.id = f.idexportador");
        $this->db->where("f.estado", 0);
        $this->db->where("oficinavalidacion", $lugar);
        $this->db->where("nim", $nim);
        if(strlen($idM03DeclaradoDetalle) > 0) { $this->db->where("f.id", $idM03DeclaradoDetalle); }
        if(strlen($compradorM03DeclaradoDetalle) > 0) { $this->db->like("upper(razonsocialcomprador)", $compradorM03DeclaradoDetalle, "both"); }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getTotalRelacionadorM03M02($idformm03relacionadorM03M02, $idformm02relacionadorM03M02, $obsrelacionadorM03M02){
        $idformm03relacionadorM03M02 = trim($idformm03relacionadorM03M02);
        $idformm02relacionadorM03M02 = trim($idformm02relacionadorM03M02);
        $obsrelacionadorM03M02 = trim($obsrelacionadorM03M02);
                
        $sql = "select count(*) total ";
        $sql .= "from relacionadorm03m02 ";
        $sql .= "where idformm03 > 0 ";
        if(strlen($idformm03relacionadorM03M02) > 0) { $sql .= "and idformm03 = ".$idformm03relacionadorM03M02." "; }
        if(strlen($idformm02relacionadorM03M02) > 0) { $sql .= "and idformm02 = ".$idformm02relacionadorM03M02." "; }
        if(strlen($obsrelacionadorM03M02) > 0) { $sql .= "and obs like '%".$obsrelacionadorM03M02."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getRelacionadorM03M02Detalle($idformm03relacionadorM03M02, $idformm02relacionadorM03M02, $obsrelacionadorM03M02, $inicio = FALSE, $cantidadregistro = FALSE){
        $idformm03relacionadorM03M02 = trim($idformm03relacionadorM03M02);
        $idformm02relacionadorM03M02 = trim($idformm02relacionadorM03M02);
        $obsrelacionadorM03M02 = trim($obsrelacionadorM03M02);
        
        $sql = "select id, idformm03, idformm02, obs ";
        $sql .= "from relacionadorm03m02 ";
        $sql .= "where idformm03 > 0 ";
        if(strlen($idformm03relacionadorM03M02) > 0) { $sql .= "and idformm03 = ".$idformm03relacionadorM03M02." "; }
        if(strlen($idformm02relacionadorM03M02) > 0) { $sql .= "and idformm02 = ".$idformm02relacionadorM03M02." "; }
        if(strlen($obsrelacionadorM03M02) > 0) { $sql .= "and obs like '%".$obsrelacionadorM03M02."%' "; }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    /*public function geExisteReliquidacion($idformm03, $tipo){
        $idformm03 = trim($idformm03);
        $tipo = trim($tipo);
        
        $sql = "select tiporeliquidacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = '".$tipo."'; ";
    }*/
    
    public function getTotalBuscarDeposito($buscarAporteDepositoM03, $buscarAporteCuentaM03, $buscarAporteEntidadFinancieraM03, $buscarAporteEntidadAporteM03){
        $buscarAporteDepositoM03 = strtoupper(trim($buscarAporteDepositoM03));
        $buscarAporteCuentaM03 = strtoupper(trim($buscarAporteCuentaM03));
        $buscarAporteEntidadFinancieraM03 = strtoupper(trim($buscarAporteEntidadFinancieraM03));
        $buscarAporteEntidadAporteM03 = strtoupper(trim($buscarAporteEntidadAporteM03));
        
        if(strlen($buscarAporteDepositoM03) == 0) { $buscarAporteDepositoM03 = "0"; }
        
        $sql = "select count(*) total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm03aporte fa on fa.idformm03 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDepositoM03 == 0 and strlen($buscarAporteCuentaM03) == 0 and strlen($buscarAporteEntidadFinancieraM03) == 0 and strlen($buscarAporteEntidadAporteM03) == 0) { $sql .= "and nrodeposito = '-1' "; }
        if($buscarAporteDepositoM03 > 0) { $sql .= "and nrodeposito = '".$buscarAporteDepositoM03."' "; }
        if(strlen($buscarAporteCuentaM03) > 0) { $sql .= "and nrocuenta = '".$buscarAporteCuentaM03."' "; }
        if(strlen($buscarAporteEntidadFinancieraM03) > 0) { $sql .= "and upper(ef.descripcion) like '%".$buscarAporteEntidadFinancieraM03."%' "; }        
        if(strlen($buscarAporteEntidadAporteM03) > 0) { $sql .= "and upper(ea.descripcion) like '%".$buscarAporteEntidadAporteM03."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getBuscarDeposito($buscarAporteDepositoM03, $buscarAporteCuentaM03, $buscarAporteEntidadFinancieraM03, $buscarAporteEntidadAporteM03, $inicio = FALSE, $cantidadregistro = FALSE){
        $buscarAporteDepositoM03 = strtoupper(trim($buscarAporteDepositoM03));
        $buscarAporteCuentaM03 = strtoupper(trim($buscarAporteCuentaM03));
        $buscarAporteEntidadFinancieraM03 = strtoupper(trim($buscarAporteEntidadFinancieraM03));
        $buscarAporteEntidadAporteM03 = strtoupper(trim($buscarAporteEntidadAporteM03));
        
        if(strlen($buscarAporteDepositoM03) == 0) { $buscarAporteDepositoM03 = "0"; }
        
        $sql = "select f.id id, oficinavalidacion, o.nombre exportador, razonsocialcomprador comprador, ef.descripcion entidadfinanciera, nrocuenta, nrodeposito, importebs, fechadeposito, e.descripcion as estado, ea.descripcion as entidadaporte, e.descripcion as estadoformulario ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm03aporte fa on fa.idformm03 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDepositoM03 == 0 and strlen($buscarAporteCuentaM03) == 0 and strlen($buscarAporteEntidadFinancieraM03) == 0 and strlen($buscarAporteEntidadAporteM03) == 0) { $sql .= "and nrodeposito = '-1' "; }
        if($buscarAporteDepositoM03 > 0) { $sql .= "and nrodeposito = '".$buscarAporteDepositoM03."' "; }
        if(strlen($buscarAporteCuentaM03) > 0) { $sql .= "and nrocuenta = '".$buscarAporteCuentaM03."' "; }
        if(strlen($buscarAporteEntidadFinancieraM03) > 0) { $sql .= "and upper(ef.descripcion) like '%".$buscarAporteEntidadFinancieraM03."%' "; }
        if(strlen($buscarAporteEntidadAporteM03) > 0) { $sql .= "and upper(ea.descripcion) like '%".$buscarAporteEntidadAporteM03."%' "; }
        
        $sql .= "order by f.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function controlSession(){
        $usuario =  $this->session->userdata("usuario"); 
        $usuario = trim($usuario);
        
        if(strlen($usuario) == 0){
            $this->session->unset_userdata('usuario');
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('lugar');
            $this->session->sess_destroy();
            $this->session->set_flashdata("error", "Se borro la session");
            redirect(base_url());
        }
        return true;
    }
    
    public function getGestiones(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct date_part('year', fechavalidacion) gestion ";
        $sql .= "from formm03 ";
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fechavalidacion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fecharegistro) gestion ";
        $sql .= "from formm03 "; 
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fecharegistro) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fechadeclaracion) gestion ";
        $sql .= "from formm03 ";
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fechadeclaracion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fechatransaccion) gestion ";
        $sql .= "from formm03 ";
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fechatransaccion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "order by gestion desc; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getMeses(){
        $sql = "select 1 as id, 'ENERO' as mes ";
        $sql .= "union "; 
        $sql .= "select 2 as id, 'FEBRERO' as mes ";
        $sql .= "union "; 
        $sql .= "select 3 as id, 'MARZO' as mes ";
        $sql .= "union "; 
        $sql .= "select 4 as id, 'ABRIL' as mes ";
        $sql .= "union "; 
        $sql .= "select 5 as id, 'MAYO' as mes ";
        $sql .= "union "; 
        $sql .= "select 6 as id, 'JUNIO' as mes ";
        $sql .= "union "; 
        $sql .= "select 7 as id, 'JULIO' as mes ";
        $sql .= "union "; 
        $sql .= "select 8 as id, 'AGOSTO' as mes ";
        $sql .= "union "; 
        $sql .= "select 9 as id, 'SEPTIEMBRE' as mes ";
        $sql .= "union "; 
        $sql .= "select 10 as id, 'OCTUBRE' as mes ";
        $sql .= "union ";
        $sql .= "select 11 as id, 'NOVIEMBRE' as mes ";
        $sql .= "union ";
        $sql .= "select 12 as id, 'DICIEMBRE' as mes ";
        $sql .= "order by id; ";

        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getEstados($idestado){
        $idestado = trim($idestado);
        
        $sql = "select distinct ef.id id, ef.descripcion as estado "; 
        $sql .= "from formm03 f ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where length(ef.descripcion) > 0 ";
        if(strlen($idestado) > 0) { $sql .= "and ef.id = ".$idestado." "; }
        $sql .= "order by ef.descripcion; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getExportadores(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct o.id id, o.nombre exportador ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.oficinavalidacion = '".$lugar."' ";
        $sql .= "order by o.nombre; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getFechas($idfecha){
        $idfecha = trim($idfecha);
        
        if(strlen($idfecha) > 0){
            if($idfecha == "fechadeclaracion") { $sql = "select 'FECHA DECLARACION' fecha, 'fechadeclaracion' id "; }
            if($idfecha == "fecharegistro") { $sql = "select 'FECHA REGISTRO' fecha, 'fecharegistro' id "; }
            if($idfecha == "fechatransaccion") { $sql = "select 'FECHA TRANSACCION' fecha, 'fechatransaccion' id "; }
            if($idfecha == "fechavalidacion") { $sql = "select 'FECHA VALIDACION' fecha, 'fechavalidacion' id "; }
        } else {
            $sql = "select 'FECHA DECLARACION' fecha, 'fechadeclaracion' id ";
            $sql .= "union ";
            $sql .= "select 'FECHA REGISTRO' fecha, 'fecharegistro' id ";
            $sql .= "union ";
            $sql .= "select 'FECHA TRANSACCION' fecha, 'fechatransaccion' id ";
            $sql .= "union ";
            $sql .= "select 'FECHA VALIDACION' fecha, 'fechavalidacion' id ";
            $sql .= "order by id; ";
        } 
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
                                              
    public function getExportadoresReporteM03($gestionReporteEstadoM03, $mesReporteEstadoM03, $estadoReporteEstadoM03, $idexportadorOrigen, $fechaReporteEstadoM03, $departamentalReporteEstadoM03){
        $gestionReporteEstadoM03 = trim($gestionReporteEstadoM03);
        $mesReporteEstadoM03 = trim($mesReporteEstadoM03);
        //$mesFinalReporteEstadoM03 = trim($mesFinalReporteEstadoM03);
        $estadoReporteEstadoM03 = trim($estadoReporteEstadoM03);
        $idexportadorOrigen = trim($idexportadorOrigen);
        $fechaReporteEstadoM03 = trim($fechaReporteEstadoM03);
        $departamentalReporteEstadoM03 = trim($departamentalReporteEstadoM03);
        
        $sql = "select distinct o.nombre exportador, o.id idexportador ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and oficinavalidacion = '".$departamentalReporteEstadoM03."' ";
        $sql .= "and date_part('year', ".$fechaReporteEstadoM03.") = ".$gestionReporteEstadoM03." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM03.") = ".$mesReporteEstadoM03." ";
        //$sql .= "and date_part('month', ".$fechaReporteEstadoM03.") <= ".$mesFinalReporteEstadoM03." ";
        $sql .= "and f.estado = ".$estadoReporteEstadoM03." ";
        if(strlen($idexportadorOrigen) > 0){ $sql .= "and o.id = ".$idexportadorOrigen." "; }
        $sql .= "order by o.nombre; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
                                         
    public function getFormm03ReporteM03($gestionReporteEstadoM03, $mesReporteEstadoM03, $estadoReporteEstadoM03, $idexportadorAux, $fechaReporteEstadoM03, $departamentalReporteEstadoM03){
        $gestionReporteEstadoM03 = trim($gestionReporteEstadoM03);
        $mesReporteEstadoM03 = trim($mesReporteEstadoM03);
        $estadoReporteEstadoM03 = trim($estadoReporteEstadoM03);
        $idexportadorAux = trim($idexportadorAux);
        $fechaReporteEstadoM03 = trim($fechaReporteEstadoM03);
        $departamentalReporteEstadoM03 = trim($departamentalReporteEstadoM03);
        
        $sql = "select f.id as id, f.codigoformm03 as codigo, f.fechatransaccion fechatransaccion, f.fechadeclaracion fechadeclaracion, f.fechavalidacion fechavalidacion, f.fecharegistro fecharegistro, ' ' || o.nombre as exportador,o.nombre as exportador1, ' ' || razonsocialcomprador razonsocialcomprador, razonsocialcomprador razonsocialcomprador1, codigovalidador, o.id as idoperador ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and oficinavalidacion = '".$departamentalReporteEstadoM03."' "; 
        $sql .= "and date_part('year', ".$fechaReporteEstadoM03.") = ".$gestionReporteEstadoM03." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM03.") = ".$mesReporteEstadoM03." ";
        //$sql .= "and date_part('month', ".$fechaReporteEstadoM03.") <= ".$mesFinalReporteEstadoM03." ";
        $sql .= "and f.estado = ".$estadoReporteEstadoM03." ";
        if(strlen($idexportadorAux) > 0){ $sql .= "and o.id = ".$idexportadorAux." "; }
        $sql .= "order by o.nombre, ".$fechaReporteEstadoM03.", f.id; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getRepresentanteLegal($idoperador){
        $idoperador = trim($idoperador);
        
        $sql = "select rl.nombres || ' ' || apellidopaterno || ' ' || apellidomaterno nombre, nrodocid || ' ' || codlugardocid  documento, rl.telefono telefono, case when celular <> rl.telefono then celular end as celular ";
        $sql .= "from operador op ";
        $sql .= "join representantelegal rl on rl.idoperador = op.id ";
        $sql .= "where op.id in ( ".$idoperador." ) ";
        $sql .= "order by rl.nombres || ' ' || apellidopaterno || ' ' || apellidomaterno; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getDepartamentales(){
        $lugar = $this->session->userdata("lugar");
        $codigo = $this->session->userdata("codigo");
        
        $sql = "select distinct f.oficinavalidacion oficinavalidacion ";
        $sql .= "from formm03 f ";
        $sql .= "where f.id > 0 ";
        $sql .= "and f.oficinavalidacion is not null ";
        if($codigo == "REG") { $sql .= "and f.oficinavalidacion = '".$lugar."' "; }
        $sql .= "order by f.oficinavalidacion; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getOrdenados(){
        $sql = "select 'ID' orden, 'f.id' id ";
        $sql .= "union ";
        $sql .= "select 'CODIGO' orden, 'f.codigoformm03' id ";
        $sql .= "union ";
        $sql .= "select 'COMPRADOR' orden, 'o.nombre' id ";
        $sql .= "union ";
        $sql .= "select 'FECHA DECLARACION' orden, 'f.fechadeclaracion' id ";
        $sql .= "union ";
        $sql .= "select 'FECHA REGISTRO' orden, 'f.fecharegistro' id ";
        $sql .= "union ";
        $sql .= "select 'FECHA TRANSACCION' orden, 'f.fechatransaccion' id ";
        $sql .= "union ";
        $sql .= "select 'FECHA VALIDACION' orden, 'f.fechavalidacion' id ";
        $sql .= "order by id; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getOficinaValidacion($id){
        $id = trim($id);
        
        $sql = "select oficinavalidacion "; 
        $sql .= "from formm03 ";
        $sql .= "where id = ".$id."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->oficinavalidacion;
        } else {
            return "";
        }
    }
    
    public function setGuardarDatosEnvioMuestra($idformm03s, $fechaenviomuestra, $citeenviomuestra){
        $consulta = "select fn_grabaDatosEnvioMuestra('$idformm03s', '$fechaenviomuestra', '$citeenviomuestra')";
        $query = $this->db->query($consulta);
        $salida = $query->result();
        return $salida;
    }
    
    public function getMineralEnvioMuestra($citeenviomuestra){
        $citeenviomuestra = trim($citeenviomuestra);
        
        $sql = "select distinct f.id idformm03, f.codigoenviomuestra as codigoenviomuestra, 'SENARECOM' cliente, mineralesformm03calculorm(f.id) producto, simbolosformm03calculorm(f.id) analisis, '1 MUESTRA' obs, fechamuestra ";
        $sql .= "from formm03 f ";
        $sql .= "join formm03calculorm fc on fc.idformm03 = f.id ";
        $sql .= "where f.citeenviomuestra = '".$citeenviomuestra."' ";
        $sql .= "and length(f.codigoenviomuestra) > 0 ";
        $sql .= "and length(f.fechamuestra::varchar) > 0 ";
        $sql .= "order by f.id; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getreliquidacion03calculorm($id, $tiporeliquidacion){
        $id = trim($id);
        $tiporeliquidacion = trim($tiporeliquidacion);
                
        $sql = "select * ";
        $sql .= "from getreliquidacion03calculorm(".$id.", '".$tiporeliquidacion."'); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return 1;
        } else {
            return 0;
        }
        
    }
    
    public function getTotalDirimisionReliquidacion($idPendienteDirimision, $codigoPendienteDirimision, $exportadorPendienteDirimision, $inicio = FALSE, $cantidadregistro = FALSE){
        $idPendienteDirimision = trim($idPendienteDirimision);
        $codigoPendienteDirimision = strtoupper(trim($codigoPendienteDirimision));
        $exportadorPendienteDirimision = strtoupper(trim($exportadorPendienteDirimision));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) as total ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (4) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idPendienteDirimision) > 0) { $sql .= "and r.idformm03 = ".$idPendienteDirimision." "; }
        if(strlen($codigoPendienteDirimision) > 0) { $sql .= "and upper(r.codigoPendienteDirimision) like '%".$codigoPendienteDirimision."%' "; }
        if(strlen($exportadorPendienteDirimision) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorPendienteReliquidacion."%' "; }
        $sql .= "; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getDirimisionReliquidacion($idPendienteDirimision, $codigoPendienteDirimision, $exportadorPendienteDirimision, $inicio = FALSE, $cantidadregistro = FALSE){
        $idPendienteDirimision = trim($idPendienteDirimision);
        $codigoPendienteDirimision = strtoupper(trim($codigoPendienteDirimision));
        $exportadorPendienteDirimision = strtoupper(trim($exportadorPendienteDirimision));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select r.humedad_senarecom humedad, r.id id, idformm03, codigoreliquidador, upper(tiporeliquidacion) tiporeliquidacion, mineralesreliquidacion03calculorm(idformm03) mineral, lote, r.codigoenviomuestra codigoenviomuestra, o.nombre as exportador, fechaenviodirimision, citedirimision, fecharecepciondirimision ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join estadoreliquidacion er on er.estado = r.estado ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.estado in (4) ";
        $sql .= "and oficinareliquidacion = '".$lugar."' ";
        if(strlen($idPendienteDirimision) > 0) { $sql .= "and r.idformm03 = ".$idPendienteDirimision." "; }
        if(strlen($codigoPendienteDirimision) > 0) { $sql .= "and upper(r.codigoPendienteDirimision) like '%".$codigoPendienteDirimision."%' "; }
        if(strlen($exportadorPendienteDirimision) > 0) { $sql .= "and upper(o.nombre) like '%".$exportadorPendienteReliquidacion."%' "; }
        $sql .= "order by r.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getCuadroReliquidacionPreliminar($idformm03, $tipo){
        $idformm03 = trim($idformm03);
        $tipo = trim($tipo);
        
        $sql = "select elemento, simbolo, leyvalor_declarado, leyunidad_declarado, leyvalor_senarecom, leyunidad_senarecom, diferencia, case when diferencia >= leyvalor_declarado then 'SE RELIQUIDA' else 'NO SE RELIQUIDA' end as estado ";
        $sql .= "from reliquidacion03calculorm ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = '".$tipo."'; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
}
