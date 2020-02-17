<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model {

    public function login($usuario, $contrasena){
        
        $this->db->select("u.id id, usuario, u.idrol idrol, descripcion rol");
        $this->db->from("usuario u");
        $this->db->join("rol r", "u.idrol = r.id");
        $this->db->where("usuario", $usuario);
        $this->db->where("contrasena", $contrasena);
        $this->db->where("idrol", 6);
        
        $resultados = $this->db->get();
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
        $this->db->select("id, titulo, caveza, mensaje, link");
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
    
}
