<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formm01_model extends CI_Model {
    
    public function getFormm01($idformm01, $nimformm01, $operadorformm01, $subsectorformm01, $inicio = FALSE, $cantidadregistro = FALSE){
        $idformm01 = trim($idformm01);
        $nimformm01 = trim($nimformm01);
        $operadorformm01 = strtoupper(trim($operadorformm01));
        $subsectorformm01 = strtoupper(trim($subsectorformm01));
        
        $sql = "select o.id id, nim, fechanim, fechaexpiracion, o.nombre razonsocial, documento, nombresubsector(o.idsubsector) subsector, l.descripcion lugar ";
        $sql .= "from operador o ";
        $sql .= "join lugarnim l on l.id = o.idlugarnim ";
        $sql .= "where o.estado = 0 ";
        if(strlen($idformm01) > 0) { $sql .= "and o.id = ".$idformm01." "; }
        if(strlen($nimformm01) > 0) { $sql .= "and nim like '%".$nimformm01."%' "; }
        if(strlen($operadorformm01) > 0) { $sql .= "and upper(o.nombre) like '%".$operadorformm01."%' "; }
        if(strlen($subsectorformm01) > 0) { $sql .= "and upper(nombresubsector(o.idsubsector)) like '%".$subsectorformm01."%' "; }
        $sql .= "order by o.id desc ";
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $sql .= "OFFSET ".$inicio." LIMIT ".$cantidadregistro." ";
        }
        $sql .= "; ";
        
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getTotal($idformm01, $nimformm01, $operadorformm01, $subsectorformm01){
        $idformm01 = trim($idformm01);
        $nimformm01 = trim($nimformm01);
        $operadorformm01 = strtoupper(trim($operadorformm01));
        $subsectorformm01 = strtoupper(trim($subsectorformm01));
        
        $sql = "select count(*) total ";
        $sql .= "from operador o ";
        $sql .= "join lugarnim l on l.id = o.idlugarnim ";
        $sql .= "where o.estado = 0 ";
        if(strlen($idformm01) > 0) { $sql .= "and o.id = ".$idformm01." "; }
        if(strlen($nimformm01) > 0) { $sql .= "and nim like '%".$nimformm01."%' "; }
        if(strlen($operadorformm01) > 0) { $sql .= "and upper(o.nombre) like '%".$operadorformm01."%' "; }
        if(strlen($subsectorformm01) > 0) { $sql .= "and upper(nombresubsector(o.idsubsector)) like '%".$subsectorformm01."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getDatosPersona($id){
        $sql = "select op.id id, nim, op.nombre razonsocial, nombresubsector(op.idsubsector) actorproductivo, op.documento as ci_nit, op.fundempresa as nro_fundempresa, registrocooperativa nrodrcooperativa, resolucionconsejo, fechaconsejo, nrosocio, op.ruex as nro_ruex, departamento, municipio, direccion, telefono, fax ";
        $sql .= "from operador op ";
        $sql .= "join municipio m on m.id = op.idmunicipio ";
        $sql .= "join personajuridica pj on pj.idoperador = op.id ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getActividadesMineras($id){
        $sql = "select op.id id, a.descripcion actividad, departamento ";
        $sql .= "from operador op ";
        $sql .= "join operadoractividad oa on oa.idoperador = op.id ";
        $sql .= "join actividad a on a.id = oa.idactividad ";
        $sql .= "join municipio m on m.id = oa.idmunicipio ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getMinerales($id){
        $sql = "select op.id id, minerales ";
        $sql .= "from operador op ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getConcesionesMineras($id){
        $sql = "select op.id id, c.nombre nombre, nroresolucion, fechainicio fechaconcesion, cuadriculas, pertenencia , m.codigo codigo, municipio, departamento, activo obs ";
        $sql .= "from operador op ";
        $sql .= "join concesion c on c.idoperador = op.id ";
        $sql .= "join municipio m on m.id = c.idmunicipio ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getContactosMineros($id){
        $sql = "select op.id id, titular, nrotestimonio, fechacontrato, plazo plazo_anios ";
        $sql .= "from operador op ";
        $sql .= "join contratominero cm on cm.idoperador = op.id ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getRepresentantesLegales($id){
        $sql = "select op.id id, nombres, apellidopaterno, apellidomaterno, codtipodocid, nrodocid || ' ' || codlugardocid docu, rl.telefono telefono, celular, rl.correoelectronico correoelectronico, cargo ";
        $sql .= "from operador op ";
        $sql .= "join representantelegal rl on rl.idoperador = op.id ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getHabilitacionUsuario($id){
        $sql = "select op.id id, us.nombres nombres, apellidopaterno, apellidomaterno, codtipodocid, nrodocid || ' ' || codlugardocid docu, us.telefono telefono, us.celular celular, us.correoelectronico correoelectronico, cargo, nim ";
        $sql .= "from operador op ";
        $sql .= "join usuariosinacom us on us.idoperador  = op.id ";
        $sql .= "where op.id in (".$id."); ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
    }
    
    public function getContactos($id){
        $sql = "select op.id id, nombres, apellidopaterno, apellidomaterno, codtipodocid, nrodocid, codlugardocid, c.telefono telefono, celular, c.correoelectronico correoelectronico, cargo ";
        $sql .= "from contacto c ";
        $sql .= "join operador op on op.id = c.idoperador ";
        //$sql .= "join lugarnim l on l.id = c.idlugarnim ";
        $sql .= "where op.id = ".$id."; ";
        $consulta = $this->db->query($sql);
        return $consulta->result();
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
    
    public function getTotalBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarAporteConceptoPagoM01){
        $buscarAporteDepositoM01 = strtoupper(trim($buscarAporteDepositoM01));
        $buscarAporteCuentaM01 = strtoupper(trim($buscarAporteCuentaM01));
        $buscarAporteConceptoPagoM01 = strtoupper(trim($buscarAporteConceptoPagoM01));
        
        if(strlen($buscarAporteDepositoM01) == 0) { $buscarAporteDepositoM01 = "0"; }
        if(is_numeric($buscarAporteDepositoM01) == false){ $buscarAporteDepositoM01 = "0"; }
        
        $sql = "select count(*) total ";
        $sql .= "from operador o ";
        $sql .= "join aportenim a on a.idoperador = o.id  ";
        $sql .= "join entidadfinanciera ef on ef.id = a.identidadfinanciera ";
        $sql .= "where o.id > 0 ";
        if($buscarAporteDepositoM01 == 0 and strlen($buscarAporteCuentaM01) == 0 and strlen($buscarAporteConceptoPagoM01) == 0) { $sql .= "and nrodeposito = -1 "; }
        if($buscarAporteDepositoM01 > 0) { $sql .= "and nrodeposito = ".$buscarAporteDepositoM01." "; }
        if(strlen($buscarAporteCuentaM01) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuentaM01."' "; }
        if(strlen($buscarAporteConceptoPagoM01) > 0) { $sql .= "and upper(conceptopago) like '%".$buscarAporteConceptoPagoM01."%' "; }
        $sql .= "; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->total;
        } else {
            return 0;
        }
    }
    
    public function getBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarAporteConceptoPagoM01, $inicio = FALSE, $cantidadregistro = FALSE){
        $buscarAporteDepositoM01 = strtoupper(trim($buscarAporteDepositoM01));
        $buscarAporteCuentaM01 = strtoupper(trim($buscarAporteCuentaM01));
        $buscarAporteConceptoPagoM01 = strtoupper(trim($buscarAporteConceptoPagoM01));
                
        if(strlen($buscarAporteDepositoM01) == 0) { $buscarAporteDepositoM01 = "0"; }
        if(is_numeric($buscarAporteDepositoM01) == false){ $buscarAporteDepositoM01 = "0"; }
        
        $sql = "select o.id id, o.nim nim, o.nombre nombre, ef.descripcion as entidadfinanciera, nrocuenta, nrodeposito, fechadeposito, montobs, conceptopago ";
        $sql .= "from operador o ";
        $sql .= "join aportenim a on a.idoperador = o.id ";
        $sql .= "join entidadfinanciera ef on ef.id = a.identidadfinanciera ";
        $sql .= "where o.id > 0 ";
        if($buscarAporteDepositoM01 == 0 and strlen($buscarAporteCuentaM01) == 0 and strlen($buscarAporteConceptoPagoM01) == 0) { $sql .= "and nrodeposito = -1 "; }
        if($buscarAporteDepositoM01 > 0) { $sql .= "and nrodeposito = ".$buscarAporteDepositoM01." "; }
        if(strlen($buscarAporteCuentaM01) > 0) { $sql .= "and upper(nrocuenta) = '".$buscarAporteCuentaM01."' "; }
        if(strlen($buscarAporteConceptoPagoM01) > 0) { $sql .= "and upper(conceptopago) like '%".$buscarAporteConceptoPagoM01."%' "; }
        $sql .= "order by o.nim asc ";
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
}

?>