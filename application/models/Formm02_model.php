<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formm02_model extends CI_Model {
    
    public function getTotalBuscar($idM02Buscar, $codigoM02Buscar, $compradorM02Buscar){
        $idM02Buscar = trim($idM02Buscar);
        $codigoM02Buscar = trim($codigoM02Buscar);
        $compradorM02Buscar = strtoupper(trim($compradorM02Buscar));
        
        $sql = "select count(*) total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where f.id > 0 ";
        if(strlen($idM02Buscar) > 0){
            $sql .= "and f.id = ".$idM02Buscar." ";
            if(strlen($codigoM02Buscar) > 0){ $sql .= "and f.codigoformm02 like '%".$codigoM02Buscar."%' "; }
            if(strlen($compradorM02Buscar) > 0){ $sql .= "and upper(o.nombre) like '%".$compradorM02Buscar."%' "; }
        } else {
            if(strlen($codigoM02Buscar) > 0){
                $sql .= "and f.codigoformm02 like '%".$codigoM02Buscar."%' ";
            } else {
                if(strlen($compradorM02Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
            
            if(strlen($compradorM02Buscar) > 0){
                $sql .= "and upper(o.nombre) like '%".$compradorM02Buscar."%' ";
            } else {
                if(strlen($codigoM02Buscar) == 0){
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
    
    public function getFormm02Buscar($idM02Buscar, $codigoM02Buscar, $compradorM02Buscar, $inicio = FALSE, $cantidadregistro = FALSE){
        $idM02Buscar = trim($idM02Buscar);
        $codigoM02Buscar = trim($codigoM02Buscar);
        $compradorM02Buscar = strtoupper(trim($compradorM02Buscar));
        
        $sql = "select f.id id, codigooperador, codigoformm02, codigooperador, codigovalidador, oficinavalidacion, fechavalidacion, fechatransaccion, fecharegistro, fechadeclaracion, o.nombre as comprador, o.nim nim, nimvendedor, razonsocialvendedor, totalkilosfinos, totalvbvbs, ef.descripcion as estado, case when f.estadorevision = 1 then 'SUJETO A REVISION' else '' end estadorevision ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where f.id > 0 ";
        if(strlen($idM02Buscar) > 0){
            $sql .= "and f.id = ".$idM02Buscar." ";
            if(strlen($codigoM02Buscar) > 0){ $sql .= "and f.codigoformm02 like '%".$codigoM02Buscar."%' "; }
            if(strlen($compradorM02Buscar) > 0){ $sql .= "and upper(o.nombre) like '%".$compradorM02Buscar."%' "; }
        } else {
            if(strlen($codigoM02Buscar) > 0){
                $sql .= "and f.codigoformm02 like '%".$codigoM02Buscar."%' ";
            } else {
                if(strlen($compradorM02Buscar) == 0){
                    $sql .= "and f.id = 0 ";
                }
            }
            
            if(strlen($compradorM02Buscar) > 0){
                $sql .= "and upper(o.nombre) like '%".$compradorM02Buscar."%' ";
            } else {
                if(strlen($codigoM02Buscar) == 0){
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
    
    public function getTotal($estado, $idM02, $compradorM02, $vendedorM02){
        $idM02 = trim($idM02);
        $compradorM02 = strtoupper(trim($compradorM02));
        $vendedorM02 = strtoupper(trim($vendedorM02));
        $lugar = $this->session->userdata("lugar");

        $sql = "select count(*) total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador op on op.id = f.idcomprador ";
        $sql .= "where f.estado = ".$estado." ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        if(strlen($idM02) > 0) { $sql .= "and f.id = ".$idM02." "; }
        if(strlen($compradorM02) > 0) { $sql .= "and upper(op.nombre) like '%".$compradorM02."%' "; }
        if(strlen($vendedorM02) > 0) { $sql .= "and upper(razonsocialvendedor) like '%".$vendedorM02."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getTotalDeclarado($compradorM02Declarado){
        $compradorM02Declarado = strtoupper(trim($compradorM02Declarado));
        $lugar = $this->session->userdata("lugar"); 
        
        $sql = "select count(distinct nim) total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador op on op.id = f.idcomprador ";
        $sql .= "where f.estado = 0 ";
        if(strlen($compradorM02Declarado) > 0) { $sql .= "and upper(op.nombre) like '%".$compradorM02Declarado."%' "; }
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


    
    public function getRecepcion($idM02recepcion, $compradorM02Recepcion, $vendedorM02Recepcion, $inicio = FALSE, $cantidadregistro = FALSE){
        $idM02recepcion = trim($idM02recepcion);
        $compradorM02Recepcion = strtoupper(trim($compradorM02Recepcion));
        $vendedorM02Recepcion = strtoupper(trim($vendedorM02Recepcion));
        $lugar = $this->session->userdata("lugar");
        
        $this->db->select("codigooperador, codigoformm02, oficinavalidacion, f.id as id, o.nombre as comprador, razonsocialvendedor, fecharegistro, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from("formm02 f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", 1);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM02recepcion) > 0) { $this->db->where("f.id", $idM02recepcion); }
        if(strlen($compradorM02Recepcion) > 0) { $this->db->like("o.nombre", $compradorM02Recepcion, "both"); }
        if(strlen($vendedorM02Recepcion) > 0) { $this->db->like("razonsocialvendedor", $vendedorM02Recepcion, "both"); }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
    
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getConcluido($idM02Concluido, $compradorM02Concluido, $vendedorM02Concluido, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        $usuario = $this->session->userdata("usuario"); 
        
        $idM02Concluido = trim($idM02Concluido);
        $compradorM02Concluido = strtoupper(trim($compradorM02Concluido));
        $vendedorM02Concluido = strtoupper(trim($vendedorM02Concluido));
         
        $this->db->select("codigooperador, codigoformm02, codigovalidador, oficinavalidacion, fechavalidacion,  f.id as id, o.nombre as comprador, razonsocialvendedor, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from("formm02 f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", 2);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM02Concluido) > 0) { $this->db->where("f.id", $idM02Concluido); }
        if(strlen($compradorM02Concluido) > 0) { $this->db->like("upper(o.nombre)", $compradorM02Concluido, "both"); }
        if(strlen($vendedorM02Concluido) > 0) { $this->db->like("upper(razonsocialvendedor)", $vendedorM02Concluido, "both"); }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getRechazado($idM02Rechazado, $compradorM02Rechazado, $vendedorM02Rechazado, $inicio = FALSE, $cantidadregistro = FALSE){
        $lugar = $this->session->userdata("lugar"); 
        $idM02Rechazado = trim($idM02Rechazado);
        $compradorM02Rechazado = strtoupper(trim($compradorM02Rechazado));
        $vendedorM02Rechazado = strtoupper(trim($vendedorM02Rechazado));
        
        $this->db->select("codigooperador, oficinavalidacion, f.id as id, o.nombre as comprador, razonsocialvendedor, fechatransaccion, fechavalidacion, totalkilosfinos, totalvbvbs, oficinavalidacion, codigovalidador, codigooperador, contador_rechazo_formm02(f.id) contador_rechazo ");
        $this->db->from("formm02 f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", 10);
        $this->db->where("oficinavalidacion", $lugar);
        if(strlen($idM02Rechazado) > 0) { $this->db->where("f.id", $idM02Rechazado); }
        if(strlen($compradorM02Rechazado) > 0) { $this->db->like("o.nombre", $compradorM02Rechazado, "both"); }
        if(strlen($vendedorM02Rechazado) > 0) { $this->db->like("razonsocialvendedor", $vendedorM02Rechazado, "both"); }
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
    
    public function getDeclaradoResumen($compradorM02Declarado, $inicio = FALSE, $cantidadregistro = FALSE){
        $compradorM02Declarado = strtoupper(trim($compradorM02Declarado));
        $lugar = $this->session->userdata("lugar"); 
        
        $sql = "select op.nombre empresa, nim, op.id id, count(op.nombre) cantidad ";
        $sql .= "from formm02 f ";
        $sql .= "join operador op on op.id = f.idcomprador ";
        $sql .= "where f.estado = 0 ";
        if(strlen($compradorM02Declarado) > 0) { $sql .= "and upper(op.nombre) like '%".$compradorM02Declarado."%' "; }
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

    // ********** envio
    public function getenvio($comprador){     
        $this->db->select("codigooperador, codigoformm02, oficinavalidacion, f.id as id, o.nombre as comprador, razonsocialvendedor, fecharegistro, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from("formm02 f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", 0);
        $this->db->where('o.id', $comprador);
        $this->db->order_by('f.id', 'desc');
    
        $consulta = $this->db->get();
        return $consulta->result();
    }

    
                                         
    public function getDeclaradosDetalle($nim, $idM02DeclaradoDetalle, $vendedorM02DeclaradoDetalle, $inicio = FALSE, $cantidadregistro = FALSE){
        $nim = trim($nim);
        $idM02DeclaradoDetalle = trim($idM02DeclaradoDetalle);
        $vendedorM02DeclaradoDetalle = strtoupper(trim($vendedorM02DeclaradoDetalle));
        $lugar = $this->session->userdata("lugar"); 
        
        $this->db->select("f.id as id, o.nombre as comprador, razonsocialvendedor, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from("formm02 f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", 0);
        $this->db->where("oficinavalidacion", $lugar);
        $this->db->where("nim", $nim);
        if(strlen($idM02DeclaradoDetalle) > 0) { $this->db->where("f.id", $idM02DeclaradoDetalle); }
        if(strlen($vendedorM02DeclaradoDetalle) > 0) { $this->db->like("upper(razonsocialvendedor)", $vendedorM02DeclaradoDetalle, "both"); }
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $this->db->order_by('f.id', 'desc');
        
        $consulta = $this->db->get();
        return $consulta->result();
    }
     
    public function getTotalNIM($estado, $nim, $idM02DeclaradoDetalle, $vendedorM02DeclaradoDetalle){
        $nim = trim($nim);
        $idM02DeclaradoDetalle = trim($idM02DeclaradoDetalle);
        $vendedorM02DeclaradoDetalle = strtoupper(trim($vendedorM02DeclaradoDetalle));
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select count(*) total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador op on op.id = f.idcomprador ";
        $sql .= "where f.estado = ".$estado." ";
        $sql .= "and f.oficinavalidacion = '".$lugar."' ";
        $sql .= "and op.nim = '".$nim."' ";
        if(strlen($idM02DeclaradoDetalle) > 0) { $sql .= "and f.id = ".$idM02DeclaradoDetalle." "; }
        if(strlen($vendedorM02DeclaradoDetalle) > 0) { $sql .= "and upper(razonsocialvendedor) like '%".$vendedorM02DeclaradoDetalle."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getAnio(){
        $sql = "select distinct date_part('year', fechatransaccion) anio ";
        $sql .= "from formm02 ";
        $sql .= "where fechatransaccion is not null ";
        $sql .= "order by date_part('year', fechatransaccion) desc; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function contador(){
        $id = $this->session->userdata("id");
        
        // Controlar si se perdio la session
        $id = trim($id);
        if(strlen($id) == 0){
            $this->session->unset_userdata('usuario');
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('lugar');
            $this->session->sess_destroy();
            $this->session->set_flashdata("error", "Se borro la session");
            redirect(base_url());
        }
        
        $sql = "select * ";
        $sql .= "from conta(".$id."); ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->row();
        } else {
            return false;
        }
    }

    private function buscar_fecha_mes($origen, $mes, $gestion){
        $fecha = $gestion;
        if($mes == "ENERO"){ if($origen == "inicio") { $fecha .= "-01-01"; } else { $fecha .= "-01-31"; } }
        
        if($mes == "FEBRERO"){ 
            if($origen == "inicio") { 
                $fecha .= "-01-01"; 
                
            } else {
                if(($gestion %4) == 0){
                    $fecha .= "-02-29";
                } else {
                    $fecha .= "-02-28";
                }
            } 
        }
        
        if($mes == "MARZO"){ 
        if($origen == "inicio") { $fecha .= "-03-01"; } else { $fecha .= "-03-31"; } }
        if($mes == "ABRIL"){ if($origen == "inicio") { $fecha .= "-04-01"; } else { $fecha .= "-04-30"; } }
        if($mes == "MAYO"){ if($origen == "inicio") { $fecha .= "-05-01"; } else { $fecha .= "-05-31"; } }
        if($mes == "JUNIO"){ if($origen == "inicio") { $fecha .= "-06-01"; } else { $fecha .= "-06-30"; } }
        if($mes == "JULIO"){ if($origen == "inicio") { $fecha .= "-07-01"; } else { $fecha .= "-07-31"; } }
        if($mes == "AGOSTO"){ if($origen == "inicio") { $fecha .= "-08-01"; } else { $fecha .= "-08-31"; } }
        if($mes == "SEPTIEMBRE"){ if($origen == "inicio") { $fecha .= "-09-01"; } else { $fecha .= "-09-30"; } }
        if($mes == "OCTUBRE"){ if($origen == "inicio") { $fecha .= "-10-01"; } else { $fecha .= "-10-31"; } }
        if($mes == "NOVIEMBRE"){ if($origen == "inicio") { $fecha .= "-11-01"; } else { $fecha .= "-11-30"; } }
        if($mes == "DICIEMBRE"){ if($origen == "inicio") { $fecha .= "-12-01"; } else { $fecha .= "-12-31"; } }
    }
    
    public function buscar_gral($anio, $mesini, $mesfin, $departamento, $estado, $tipo, $inicio = FALSE, $cantidadregistro = FALSE){
        $buscar = trim($anio);
        $mesini = trim($mesini);
        $mesfin = trim($mesfin);
        $departamento = trim($departamento);
        $estado = trim($estado);
        $tipo = trim($tipo);
        
        $fecini = "";
        $fecfin = "";
        
        if(strlen($anio) > 0 && strlen($mesini) > 0){
            $fecini = buscar_fecha_mes("inicio", $mesini, $anio);
        }
        
        if(strlen($anio) > 0 && strlen($mesini) > 0){
            $fecfin = buscar_fecha_mes("final", $mesfin, $anio);
        }
        
        $sql = "select m.departamento departamento, municipio, mi.descripcion mineral, sum(valorbrutobs) suma_valorbrutobs, sum(totalkilosfinos) suma_totalkilosfinos ";
        $sql .= "from formm02 f ";
        $sql .= "join municipio m on m.id = f.idmunicipio ";
        $sql .= "join formm02calculorm fc on fc.idformm02 = f.id ";
        $sql .= "join mineral mi on mi.id = fc.idmineral ";
        $sql .= "where f.id > 0 ";
        
        if(strlen($anio) > 0) { $sql .= "and date_part('year', fechatransaccion) = ".$anio." "; }
        if(strlen($fecini) > 0) { $sql .= "and fechatransaccion >= '".$fecini."' "; }
        if(strlen($fecfin) > 0) { $sql .= "and fechatransaccion <= '".$fecfin."' "; }
        if(strlen($departamento) > 0) { $sql .= "m.departamento = '".$departamento."' "; }
        if(strlen($estado) > 0) { $sql .= "and f.estado = ".$estado." "; }
        
        $sql .= "group by departamento, municipio, mi.descripcion ";
        $sql .= "order by departamento, municipio, mi.descripcion ";
        
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "LIMIT ".$cantidadregistro." OFFSET ".$inicio." ";
        }
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getFormm02Depa($tabla, $estado){
        $tabla = trim($tabla);
        $usuario = $this->session->userdata("usuario");
        $lugar = $this->session->userdata("lugar");

        $this->db->select("codigooperador, oficinavalidacion, f.id as id, o.nombre as comprador, razonsocialvendedor, fechatransaccion, totalkilosfinos, totalvbvbs, oficinavalidacion ");
        $this->db->from($tabla." f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("f.estado", $estado);
        $this->db->where("oficinavalidacion", $lugar);
        $this->db->order_by('f.id', 'desc');
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getFormm02($tabla, $estado){
        $tabla = trim($tabla);
        $usuario = $this->session->userdata("usuario");

        $this->db->select("f.id as id, codigoformm02, o.nombre as comprador, razonsocialvendedor, fechatransaccion, totalkilosfinos, totalvbvbs, fechavalidacion ");
        $this->db->from($tabla." f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->where("codigooperador", $usuario);
        $this->db->where("f.estado", $estado);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function delete($tabla, $estado){
        $usuario = $this->session->userdata("usuario");

        $this->db->where('codigooperador', $usuario);
        $this->db->where('estado', $estado);
        $this->db->delete($tabla);
    }

    public function getCodigo($id){
        $sql = "select codigoformm02 ";
        $sql .= "from formm02 ";
        $sql .= "where id = ".$id."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->codigoformm02;
        } else {
            return "";
        }
    }
    
    public function getDatosTransaccion($tabla, $id){
        $tabla = trim($tabla);

        $this->db->select("f.id as id, codigoformm02, nim, f.idcomprador idcomprador, o.nombre as comprador, o.documento onronit, codigooperador, fechatransaccion, fechavalidacion, tipocambiobs, nimvendedor, razonsocialvendedor, nronit, la.descripcion descripcion, certificadoanalisis, nombremina, departamento, provincia, municipio, localidad, p.descripcion presentacion, pbh, tara, pnh, humedad, mermaporcentaje, mermakg, pns, lote, totalvbvusd, totalvbvbs, vnv, gastosacordado, totaldeducciones, liquido  ");
        $this->db->from($tabla." f");
        $this->db->join("operador o", "o.id = f.idcomprador");
        $this->db->join("municipio m", "m.id = f.idmunicipio");
        $this->db->join("presentacionproducto p", "p.id = f.idpresentacionproducto");
        $this->db->join("laboratorio la", "la.id = f.idlaboratorio");
        $this->db->where("f.id", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function getDatosRegalia($id){
        $sql = "select fvr.id id, idformm02, elemento, n.codigo codigonandina, n.descripcion descripcion, leyvalor leymineral, leyunidad, pesofinokg, pesofino, cotizacionmineral, cotizacionunidad, valorbrutousd, valorbrutobs, alicuotainterna, importermbs regalia ";
        $sql .= "from formm02calculorm fvr ";
        $sql .= "join nandina n on n.id = fvr.idnandina ";
        $sql .= "join mineral m on m.id = fvr.idmineral ";
        $sql .= "where fvr.idformm02 = ".$id." ";
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
        $this->db->from("formm02calculorm");
        $this->db->where("idformm02", $id);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getAporteDepartamental($id){
        $this->db->select("fd.id id, m.codigo codigo, importermbs, municipio, aportemunicipalbs, departamento, aportedepartamentalbs, ef.descripcion entidadfinanciera, nrodeorden, fechadeposito");
        $this->db->from("formm02 f");
        $this->db->join("formm02distribucionrm fd", "fd.idformm02 = f.id");
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
        $this->db->from("formm02 f");
        $this->db->join("formm02distribucionrm fd", "fd.idformm02 = f.id");
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

    public function getMotivos($id){
        $this->db->select("m.id id, r.detalle detalle");
        $this->db->from("from motivo m ");
        $this->db->join("rechazo r", "r.id = m.idrechazo");
        $this->db->where("idbitacorarechazo",$id);
        $this->db->order_by("m.id", "asc");
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getMotivoRechazo(){
        $this->db->select("id, detalle ");
        $this->db->from("rechazo");
        $this->db->order_by("id", "asc");
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getBitacoras($id){
        $this->db->select("b.id id, idformm02, usuario, fecha, l.descripcion lugar, obsmal");
        $this->db->from("bitacorarechazo b");
        $this->db->join("usuario u", "u.id = b.idusuario");
        $this->db->join("lugarnim l", "l.id = u.lugar");
        $this->db->where("idformm02", $id);
        $this->db->order_by('b.id', 'asc');
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getBitacoras2($id){
        $sql = "select b.idformm02 idformm02, b.fecha fecha, m.idbitacorarechazo idbitacorarechazo, r.detalle detalle, b.obsmal obsmal, u.usuario usuario, l.descripcion lugar ";
        $sql .= "from bitacorarechazo b ";
        $sql .= "join motivo m on m.idbitacorarechazo = b.id ";
        $sql .= "join rechazo r on r.id = m.idrechazo ";
        $sql .= "join usuario u on u.id = b.idusuario ";
        $sql .= "join lugarnim l on l.id = u.lugar ";
        $sql .= "where idformm02 = ".$id."; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getBitacoras1($id){
        $sql = "select bitacorarechazo.idformm02, bitacorarechazo.fecha, motivo.idbitacorarechazo, rechazo.detalle, bitacorarechazo.obsmal,usuario.usuario usuario, lugarnim.descripcion lugar ";
        $sql .= "FROM public.bitacorarechazo, public.motivo, public.rechazo, public.usuario, public.lugarnim ";
        $sql .= "WHERE bitacorarechazo.id = motivo.idbitacorarechazo AND motivo.idrechazo = rechazo.id AND bitacorarechazo.idusuario = usuario.id AND usuario.lugar = lugarnim.id AND idformm02 = ".$id."; ";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getRechazos(){
        $this->db->select("id, detalle");
        $this->db->from("rechazo");
	//$this->db->where("id > 0");
	$this->db->where("estado",1);
        $this->db->order_by('id', 'asc');
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else  {
            return false;
        }
    }

    public function getFormm02Aporte($id){
        $this->db->select("fa.id id, ea.descripcion entidad_aporte, tipobaseaporte, valorbaseaportebs, porcentajeaporte, importebs, ef.descripcion entidad_financiera, nrocuenta, nrodeposito, fechadeposito ");
        $this->db->from("formm02aporte fa");
        $this->db->join("entidadaporte ea", "ea.id = fa.identidadaporte");
        $this->db->join("entidadfinanciera ef", "ef.id = fa.identidadfinanciera");
        $this->db->where("idformm02", $id);
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
        $this->db->from("formm02aporte fa");
        $this->db->join("entidadaporte ea", "ea.id = fa.identidadaporte");
        $this->db->join("entidadfinanciera ef", "ef.id = fa.identidadfinanciera");
        $this->db->where("idformm02", $id);
        $resultados = $this->db->get();
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
    
    public function getOficinasValidacion(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct oficinavalidacion "; 
        $sql .= "from formm02 ";
        $sql .= "where length(oficinavalidacion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "order by oficinavalidacion asc; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getGestiones(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct date_part('year', fechavalidacion) gestion ";
        $sql .= "from formm02 ";
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fechavalidacion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fecharegistro) gestion ";
        $sql .= "from formm02 "; 
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fecharegistro) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fechadeclaracion) gestion ";
        $sql .= "from formm02 ";
        $sql .= "where id > 0 ";
        $sql .= "and date_part('year', fechadeclaracion) > 0 ";
        $sql .= "and oficinavalidacion = '".$lugar."' ";
        $sql .= "union ";
        $sql .= "select distinct date_part('year', fechatransaccion) gestion ";
        $sql .= "from formm02 ";
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
    
    public function getMesLiteral($mesNumerico){
        $mesNumerico = trim($mesNumerico);
        $mesLiteral = ""; 
        if($mesNumerico == 1) { $mesLiteral = "ENERO"; }
        if($mesNumerico == 2) { $mesLiteral = "FEBRERO"; }
        if($mesNumerico == 3) { $mesLiteral = "MARZO"; }
        if($mesNumerico == 4) { $mesLiteral = "ABRIL"; }
        if($mesNumerico == 5) { $mesLiteral = "MAYO"; }
        if($mesNumerico == 6) { $mesLiteral = "JUNIO"; }
        if($mesNumerico == 7) { $mesLiteral = "JULIO"; }
        if($mesNumerico == 8) { $mesLiteral = "AGOSTO"; }
        if($mesNumerico == 9) { $mesLiteral = "SEPTIEMBRE"; }
        if($mesNumerico == 10) { $mesLiteral = "OCTUBRE"; }
        if($mesNumerico == 11) { $mesLiteral = "NOVIENBRE"; }
        if($mesNumerico == 12) { $mesLiteral = "DICIEMBRE"; }
        
        return $mesLiteral;    
        
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

    public function getCompradoresReporte($idcomprador, $feciniReporteResumenM02, $fecfinReporteResumenM02){
        $idcomprador = trim($idcomprador);
        $feciniReporteResumenM02 = trim($feciniReporteResumenM02);
        $fecfinReporteResumenM02 = trim($fecfinReporteResumenM02);
        
        $nim = $this->session->userdata("nim");
        
        $sql = "select distinct o.nombre comprador, o.id id ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "where f.nimvendedor = '".$nim."' ";
        $sql .= "and f.fechatransaccion between '".$feciniReporteResumenM02."' and '".$fecfinReporteResumenM02."' ";
        if(strlen($idcomprador) > 0) { $sql .= "and o.id = ".$idcomprador." "; }
        $sql .= "order by o.nombre; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getForm02Estado($estado, $fecini, $fecfin){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select f.id id, f.fechavalidacion fechavalidacion, codigoformm02, op.id as idoperador, op.nombre comprador, razonsocialvendedor, codigovalidador ";
        $sql .= "from formm02 f ";
        $sql .= "join operador op on op.id = f.idcomprador ";
        $sql .= "where oficinavalidacion = '".$lugar."' ";
        $sql .= "and f.estado = ".$estado." ";
        $query = $this->db->query($sql);
        if($estado == 2 or $estado == 10){ 
            $sql .= "and f.fechavalidacion >= '".$fecini."' ";
            $sql .= "and f.fechavalidacion <= '".$fecfin."' ";
        } else {
            $sql .= "and f.fecharegistro >= '".$fecini."' ";
            $sql .= "and f.fecharegistro <= '".$fecfin."' ";
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
    
    public function getCompradores(){
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct o.id id, o.nombre comprador ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "where f.oficinavalidacion = '".$lugar."' ";
        $sql .= "order by o.nombre; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalBuscarDeposito($buscarAporteDepositoM02, $buscarAporteCuentaM02, $buscarAporteEntidadFinancieraM02, $buscarAporteEntidadAporteM02){
        $buscarAporteDepositoM02 = strtoupper(trim($buscarAporteDepositoM02));
        $buscarAporteCuentaM02 = strtoupper(trim($buscarAporteCuentaM02));
        $buscarAporteEntidadFinancieraM02 = strtoupper(trim($buscarAporteEntidadFinancieraM02));
        $buscarAporteEntidadAporteM02 = strtoupper(trim($buscarAporteEntidadAporteM02));
        
        if(strlen($buscarAporteDepositoM02) == 0) { $buscarAporteDepositoM02 = "0"; }
        
        $sql = "select count(*) total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDepositoM02 == 0 and strlen($buscarAporteCuentaM02) == 0 and strlen($buscarAporteEntidadFinancieraM02) == 0 and strlen($buscarAporteEntidadAporteM02) == 0) { $sql .= "and nrodeposito = '-1' "; }
        if($buscarAporteDepositoM02 > 0) { $sql .= "and nrodeposito = '".$buscarAporteDepositoM02."' "; }
        if(strlen($buscarAporteCuentaM02) > 0) { $sql .= "and nrocuenta = '".$buscarAporteCuentaM02."' "; }
        if(strlen($buscarAporteEntidadFinancieraM02) > 0) { $sql .= "and upper(ef.descripcion) like '%".$buscarAporteEntidadFinancieraM02."%' "; }        
        if(strlen($buscarAporteEntidadAporteM02) > 0) { $sql .= "and upper(ea.descripcion) like '%".$buscarAporteEntidadAporteM02."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getBuscarDeposito($buscarAporteDepositoM02, $buscarAporteCuentaM02, $buscarAporteEntidadFinancieraM02, $buscarAporteEntidadAporteM02, $inicio = FALSE, $cantidadregistro = FALSE){
        $buscarAporteDepositoM02 = strtoupper(trim($buscarAporteDepositoM02));
        $buscarAporteCuentaM02 = strtoupper(trim($buscarAporteCuentaM02));
        $buscarAporteEntidadFinancieraM02 = strtoupper(trim($buscarAporteEntidadFinancieraM02));
        $buscarAporteEntidadAporteM02 = strtoupper(trim($buscarAporteEntidadAporteM02));
        
        if(strlen($buscarAporteDepositoM02) == 0) { $buscarAporteDepositoM02 = "0"; }
        
        $sql = "select f.id id, oficinavalidacion, o.nombre comprador, razonsocialvendedor vendedor, ef.descripcion entidadfinanciera, nrocuenta, nrodeposito, importebs, fechadeposito, e.descripcion as estado, ea.descripcion as entidadaporte, e.descripcion as estadoformulario ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDepositoM02 == 0 and strlen($buscarAporteCuentaM02) == 0 and strlen($buscarAporteEntidadFinancieraM02) == 0 and strlen($buscarAporteEntidadAporteM02) == 0) { $sql .= "and nrodeposito = '-1' "; }
        if($buscarAporteDepositoM02 > 0) { $sql .= "and nrodeposito = '".$buscarAporteDepositoM02."' "; }
        if(strlen($buscarAporteCuentaM02) > 0) { $sql .= "and nrocuenta = '".$buscarAporteCuentaM02."' "; }
        if(strlen($buscarAporteEntidadFinancieraM02) > 0) { $sql .= "and upper(ef.descripcion) like '%".$buscarAporteEntidadFinancieraM02."%' "; }        
        if(strlen($buscarAporteEntidadAporteM02) > 0) { $sql .= "and upper(ea.descripcion) like '%".$buscarAporteEntidadAporteM02."%' "; }
        
        $sql .= "order by f.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
                                                        
    public function getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02){
        $lugar = $this->session->userdata("lugar");
        $gestionReporteEstadoM02 = trim($gestionReporteEstadoM02);
        $mesReporteEstadoM02 = trim($mesReporteEstadoM02);
        $estadoReporteEstadoM02 = trim($estadoReporteEstadoM02);
        $idcompradorOrigen = trim($idcompradorOrigen);
        $fechaReporteEstadoM02 = trim($fechaReporteEstadoM02);
        $departamentalReporteEstadoM02 = trim($departamentalReporteEstadoM02);
        $ordenReporteEstadoM02 = trim($ordenReporteEstadoM02);
                
        $sql = "select f.id as id, f.codigoformm02 as codigo, f.fechatransaccion fechatransaccion, f.fechadeclaracion fechadeclaracion, f.fechavalidacion fechavalidacion, f.fecharegistro fecharegistro, ' ' || o.nombre as comprador, o.nombre as comprador1, ' ' || razonsocialvendedor razonsocialvendedor, razonsocialvendedor razonsocialvendedor1, codigovalidador, o.id as idoperador ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and date_part('year', ".$fechaReporteEstadoM02.") = ".$gestionReporteEstadoM02." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM02.") = ".$mesReporteEstadoM02." ";
        //$sql .= "and date_part('month', ".$fechaReporteEstadoM02.") <= ".$mesFinalReporteEstadoM02." ";
        $sql .= "and f.estado = ".$estadoReporteEstadoM02." ";
        if(strlen($idcompradorOrigen) > 0){ $sql .= "and o.id = ".$idcompradorOrigen." "; }
        $sql .= "and f.oficinavalidacion = '".$departamentalReporteEstadoM02."' ";
        $sql .= "order by ".$ordenReporteEstadoM02.", f.id; ";
        
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
    
    public function getDepartamentales(){
        $lugar = $this->session->userdata("lugar");
        $codigo = $this->session->userdata("codigo");
        
        $sql = "select distinct f.oficinavalidacion oficinavalidacion ";
        $sql .= "from formm02 f ";
        $sql .= "where f.id > 0 ";
        $sql .= "and f.oficinavalidacion is not null ";
        if($codigo == "REG") { $sql .= "and f.oficinavalidacion = '".$lugar."' "; }
        $sql .= "order by f.oficinavalidacion; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getElementos(){
        $sql = "select id, descripcion, estado ";
        $sql .= "from mineral ";
        $sql .= "where id > 0 ";
        $sql .= "order by descripcion; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getEstados($idestado){
        $idestado = trim($idestado);
        
        $sql = "select distinct ef.id id, ef.descripcion as estado "; 
        $sql .= "from formm02 f ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where length(ef.descripcion) > 0 ";
        if(strlen($idestado) > 0) { $sql .= "and ef.id = ".$idestado." "; }
        $sql .= "order by ef.descripcion; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getEstado($idestado){
        $idestado = trim($idestado);
        
        $sql = "select id, descripcion as estado "; 
        $sql .= "from estadoformulario ";
        if(strlen($idestado) > 0) { $sql .= "where id = ".$idestado." "; }
        $sql .= "order by id; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getCompradoresReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02){
        $gestionReporteEstadoM02 = trim($gestionReporteEstadoM02);
        $mesReporteEstadoM02 = trim($mesReporteEstadoM02);
        $estadoReporteEstadoM02 = trim($estadoReporteEstadoM02);
        $idcompradorOrigen = trim($idcompradorOrigen);
        $fechaReporteEstadoM02 = trim($fechaReporteEstadoM02);
        $departamentalReporteEstadoM02 = trim($departamentalReporteEstadoM02);
                
        $sql = "select distinct o.nombre comprador, o.id idcomprador ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and date_part('year', ".$fechaReporteEstadoM02.") = ".$gestionReporteEstadoM02." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM02.") = ".$mesReporteEstadoM02." ";
        //$sql .= "and date_part('month', ".$fechaReporteEstadoM02.") <= ".$mesFinalReporteEstadoM02." ";
        $sql .= "and f.estado = ".$estadoReporteEstadoM02." ";
        if(strlen($idcompradorOrigen) > 0){ $sql .= "and o.id = ".$idcompradorOrigen." "; }
        //if($departamentalReporteEstadoM02 > 0) { $sql .= "and f.oficinavalidacion = '".$departamentalReporteEstadoM02."' "; }
        $sql .= "and f.oficinavalidacion = '".$departamentalReporteEstadoM02."' ";
        $sql .= "order by o.nombre; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getOrdenados(){
        $sql = "select 'ID' orden, 'f.id' id ";
        $sql .= "union ";
        $sql .= "select 'CODIGO' orden, 'f.codigoformm02' id ";
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
    
    public function getBuscarDepositoGeneral($buscarAporteDeposito, $buscarAporteCuenta, $buscarAporteEntidadFinanciera, $buscarAporteEntidadAporte, $inicio = FALSE, $cantidadregistro = FALSE){
        $buscarAporteDeposito = strtoupper(trim($buscarAporteDeposito));
        $buscarAporteCuenta = strtoupper(trim($buscarAporteCuenta));
        $buscarAporteEntidadFinanciera = strtoupper(trim($buscarAporteEntidadFinanciera));
        $buscarAporteEntidadAporte = strtoupper(trim($buscarAporteEntidadAporte));
        
        if(strlen($buscarAporteDeposito) == 0 and strlen($buscarAporteCuenta) == 0 and strlen($buscarAporteEntidadFinanciera) == 0 and strlen($buscarAporteEntidadAporte) == 0) { $buscarAporteDeposito = "-1"; }
        
        $sql = "select 'M-01' as formulario, o.id id, '' as oficinavalidacion, '' as estadoformulario, o.nombre as operador, o.nim as nim, '' as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, cast(nrodeposito as varchar(50)) as nrodeposito, montobs as importebs, '' as entidadaporte, conceptopago ";
        $sql .= "from operador o ";
        $sql .= "join aportenim a on a.idoperador = o.id ";
        $sql .= "join entidadfinanciera ef on ef.id = a.identidadfinanciera ";
        $sql .= "where o.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and cast(nrodeposito as varchar(50)) is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(cast(nrodeposito as varchar(50))) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        $sql .= "union ";
        $sql .= "select 'M-02' as formulario, f.id id, oficinavalidacion, e.descripcion as estadoformulario, o.nombre operador, o.nim as nim, razonsocialvendedor as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, nrodeposito, importebs, ea.descripcion as entidadaporte, '' as conceptopago ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and nrodeposito is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(nrodeposito) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        if(strlen($buscarAporteEntidadAporte) > 0) { $sql .= "and identidadaporte = ".$buscarAporteEntidadAporte." "; }
        $sql .= "union ";
        $sql .= "select 'M-03' as formulario, f.id id, oficinavalidacion, e.descripcion as estadoformulario, o.nombre operador, o.nim as nim, razonsocialcomprador as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, nrodeposito, importebs, ea.descripcion as entidadaporte, '' conceptopago ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm03aporte fa on fa.idformm03 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and nrodeposito is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(nrodeposito) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        if(strlen($buscarAporteEntidadAporte) > 0) { $sql .= "and identidadaporte = ".$buscarAporteEntidadAporte." "; }
        $sql .= "order by formulario, id ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotalBuscarDepositoGeneral($buscarAporteDeposito, $buscarAporteCuenta, $buscarAporteEntidadFinanciera, $buscarAporteEntidadAporte){
        $buscarAporteDeposito = strtoupper(trim($buscarAporteDeposito));
        $buscarAporteCuenta = strtoupper(trim($buscarAporteCuenta));
        $buscarAporteEntidadFinanciera = strtoupper(trim($buscarAporteEntidadFinanciera));
        $buscarAporteEntidadAporte = strtoupper(trim($buscarAporteEntidadAporte));
        
        if(strlen($buscarAporteDeposito) == 0 and strlen($buscarAporteCuenta) == 0 and strlen($buscarAporteEntidadFinanciera) == 0 and strlen($buscarAporteEntidadAporte) == 0) { $buscarAporteDeposito = "-1"; }
        
        $sql = "select count(*) as total ";
        $sql .= "from ( ";
        $sql .= "select 'M-01' as formulario, o.id id, '' as oficinavalidacion, '' as estadoformulario, o.nombre as operador, o.nim as nim, '' as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, cast(nrodeposito as varchar(50)) as nrodeposito, montobs as importebs, '' as entidadaporte, conceptopago ";
        $sql .= "from operador o ";
        $sql .= "join aportenim a on a.idoperador = o.id ";
        $sql .= "join entidadfinanciera ef on ef.id = a.identidadfinanciera ";
        $sql .= "where o.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and cast(nrodeposito as varchar(50)) is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(cast(nrodeposito as varchar(50))) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        $sql .= "union ";
        $sql .= "select 'M-02' as formulario, f.id id, oficinavalidacion, e.descripcion as estadoformulario, o.nombre operador, o.nim as nim, razonsocialvendedor as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, nrodeposito, importebs, ea.descripcion as entidadaporte, '' as conceptopago ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and nrodeposito is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(nrodeposito) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        if(strlen($buscarAporteEntidadAporte) > 0) { $sql .= "and identidadaporte = ".$buscarAporteEntidadAporte." "; }
        $sql .= "union ";
        $sql .= "select 'M-03' as formulario, f.id id, oficinavalidacion, e.descripcion as estadoformulario, o.nombre operador, o.nim as nim, razonsocialcomprador as vendedor, ef.descripcion entidadfinanciera, fechadeposito, nrocuenta, nrodeposito, importebs, ea.descripcion as entidadaporte, '' conceptopago ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm03aporte fa on fa.idformm03 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "where f.id > 0 ";
        if($buscarAporteDeposito == "NULL") { $sql .= "and nrodeposito is null "; }
        if(strlen($buscarAporteDeposito) > 0) { $sql .= "and upper(nrodeposito) = '".$buscarAporteDeposito."' "; }
        if($buscarAporteCuenta == "NULL") { $sql .= "and nrocuenta is null "; }
        if(strlen($buscarAporteCuenta) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuenta."' "; }
        if(strlen($buscarAporteEntidadFinanciera) > 0) { $sql .= "and identidadfinanciera = ".$buscarAporteEntidadFinanciera." "; }
        if(strlen($buscarAporteEntidadAporte) > 0) { $sql .= "and identidadaporte = ".$buscarAporteEntidadAporte." "; }
        $sql .= ") as aux ";
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getEntidadesFinancierasGeneral(){
        $sql = "select distinct ef.id as id, ef.descripcion as entidadfinanciera ";
        $sql .= "from operador o ";
        $sql .= "join aportenim a on a.idoperador = o.id ";
        $sql .= "join entidadfinanciera ef on ef.id = a.identidadfinanciera ";
        $sql .= "where o.id > 0 ";
        $sql .= "union ";
        $sql .= "select distinct ef.id as id, ef.descripcion as entidadfinanciera ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "union ";
        $sql .= "select distinct ef.id as id, ef.descripcion as entidadfinanciera ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm03aporte fa on fa.idformm03 = f.id ";
        $sql .= "join entidadfinanciera ef on ef.id = fa.identidadfinanciera ";
        $sql .= "order by id, entidadfinanciera; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getAportesGeneral(){
        $sql = "select distinct ea.id as id, ea.descripcion as entidadaporte ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "union ";
        $sql .= "select distinct ea.id as id, ea.descripcion as entidadaporte ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "join estadoformulario e on e.id = f.estado ";
        $sql .= "join formm02aporte fa on fa.idformm02 = f.id ";
        $sql .= "join entidadaporte ea on ea.id = fa.identidadaporte ";
        $sql .= "order by id, entidadaporte; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getOficinaValidacion($id){
        $id = trim($id);
        
        $sql = "select oficinavalidacion "; 
        $sql .= "from formm02 ";
        $sql .= "where id = ".$id."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->oficinavalidacion;
        } else {
            return "";
        }
    }
}

?>

