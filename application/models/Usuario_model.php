<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function login_antes($usuario, $contrasena){
        
        $this->db->select("u.id id, usuario, u.idrol idrol, descripcion rol");
        $this->db->from("usuario u");
        $this->db->join("rol r", "u.idrol = r.id");
        $this->db->where("usuario", $usuario);
        $this->db->where("contrasena", $contrasena);
        $this->db->where("idrol", 6);
        $this->db->where("activo", 1);
        
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
    
      public function login($usuario, $contrasena){
        
        $sql = "select u.id id, usuario, u.idrol idrol, descripcion rol, r.codigo as codigo
                from usuario u
                left join rol r on r.id = u.idrol
                where u.usuario ilike '$usuario'
                and  upper(u.contrasena) = '$contrasena'
                and u.idrol in (1,3,6,14,15)
                and u.activo = 1";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
    
    public function getMensaje(){
        $sql = "select id, titulo, caveza, mensaje, link from mensaje where estado = 1; ";
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            return true;
        } else {
            return false;
        }
    }
    
    public function getDatosMensaje(){
        $this->db->select("id, titulo, caveza, mensaje, link, parpadeo");
        $this->db->from("mensaje");
        $this->db->where("estado", 1);
        $resultados = $this->db->get();
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }
    
    public function getPassword($id, $password){
        $sql = "select id, usuario ";
        $sql .= "from usuario ";
        $sql .= "where id = ".$id." ";
        $sql .= "and contrasena = '".$password."'; ";
        $aux = "sql=".$sql;
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            return true;
        } else {
            return false;
        } 
    }

    public function formulario($tipo, $id){
        $sql = "select formm02, formm03 from usuario u, lugarnim l where u.lugar = l.id and u.id = ". $id ."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $fila=$query->row();
            $var = 0;
            
            $var1 = $fila->$tipo;
            if($var1 != null) { 
                $var = $fila->$tipo;  
            }
            return $var;
        } else {
            return 0;
        } 
    }
        
    public function lugar($id){
        $sql = "select l.id idlugar, l.descripcion lugar from usuario u, lugarnim l where u.lugar = l.id and u.id = ". $id ."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $fila=$query->row();
            return $fila->lugar;
        } else {
            return "";
        } 
    }
    
    public function buscar($buscar, $inicio = FALSE, $cantidadregistro = FALSE){
        $this->db->like("usuario", $buscar);
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
            $this->db->limit($cantidadregistro, $inicio);
        }
        $consulta = $this->db->get("usuario");
        return $consulta->result();
    }
    
    public function lugarCompleto($id){
        $sql = "select l.id idlugar, l.descripcion lugar from usuario u, lugarnim l where u.lugar = l.id and u.id = ". $id ."; ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $fila=$query->row();
            return $fila;//->idlugar;
        } else {
            return "";
        } 
    }
    
    public function getLugares(){
        $sql = "select id, descripcion ";
        $sql .= "from lugarnim ";
        $sql .= "where estado = 1 ";
        $sql .= "order by descripcion; ";
        
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }
    
    public function getReliquidador($id){
        $id = trim($id);
        
        $sql = "select case when reliquidacion = 1 then 1 else 0 end reliquidador ";
        $sql .= "from usuario ";
        $sql .= "where id = ".$id."; ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() >0){
            $fila=$query->row();
            return $fila->reliquidador;
        } else {
            return 0;
        }
    }

}
