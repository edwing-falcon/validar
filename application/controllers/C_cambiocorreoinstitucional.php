<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cambiocorreoinstitucional extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Empleado_model");
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idusuario = $this->session->userdata("id");
        
        $sql = "select e.id idempleado, correoinstitucional, nombres, apellidopaterno, apellidomaterno, cargo ";
        $sql .= "from usuario u ";
        $sql .= "join empleado e on e.idusuario = u.id ";
        $sql .= "where u.id = ".$idusuario."; ";
        
        
        $data = array(
            'idempleados' => $this->Formm02_model->getDatosTabla($sql, "idempleado"),
            'nombres' => $this->Formm02_model->getDatosTabla($sql, "nombres"),
            'apellidopaternos' => $this->Formm02_model->getDatosTabla($sql, "apellidopaterno"),
            'apellidomaternos' => $this->Formm02_model->getDatosTabla($sql, "apellidomaterno"),
            'cargos' => $this->Formm02_model->getDatosTabla($sql, "cargo"),
            'correoinstitucionals' => $this->Formm02_model->getDatosTabla($sql, "correoinstitucional")
        );
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_cambiocorreoinstitucional', $data);
        $this->load->view("layouts/footer");
    }
    
    public function guardar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idempleado = $this->input->post("idempleado");
        $correoinstitucional = $this->input->post("correoinstitucional");
        
        $correoinstitucional = strtolower(trim($correoinstitucional));
        
        if($correoinstitucional == null){
            $this->session->unset_userdata('exito');
            $this->session->set_userdata("error", "El correo institucional no puede ser null");
            redirect(base_url()."C_cambiocorreoinstitucional");
            
            $this->session->unset_userdata('error');
            $this->session->unset_userdata('exito');
        } 
        
        $data = array( 
            'correoinstitucional'=>$correoinstitucional
        ); 
 
        $this->db->where('id', $idempleado); 
        $this->db->update('empleado', $data); 
        
        $this->session->unset_userdata('error');
        $this->session->set_userdata("exito", "El correo institucional se guardo correctamente");
        redirect(base_url()."C_cambiocorreoinstitucional");
    }
    
}

?>
