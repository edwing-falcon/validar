<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cambiopassword extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Usuario_model");
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $password = "";
        $newpassword = "";
        $reppassword = "";
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('exito');
        
        $data = array(
            "passwords" => $password,
            "newpasswords" => $newpassword,
            "reppasswords" => $reppassword
        );
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_cambiopassword', $data);
        $this->load->view("layouts/footer");
    }
    
    public function guardar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = $this->session->userdata("id");
        $usuario = $this->session->userdata("usuario");
        
        $password_o = $this->input->post("password");
        $newpassword_o = $this->input->post("newpassword");
        $reppassword_o = $this->input->post("reppassword");
        
        $password_o = strtoupper($password_o);
        $newpassword_o = strtoupper($newpassword_o);
        $reppassword_o = strtoupper($reppassword_o);
                
        $password =  strtoupper(md5(strtoupper(trim($password_o))));
        $newpassword = strtoupper(md5(strtoupper(trim($newpassword_o))));
        $reppassword = strtoupper(md5(strtoupper(trim($reppassword_o))));
        
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('exito');
        
        $sw = $this->Usuario_model->getPassword($id, $password);
        
        if($sw != 1){
            $this->session->set_userdata("error", "El password actual no es valido ");
        } 
        
        if($sw == 1){
            if(strlen($newpassword_o) < 6){
                $this->session->set_userdata("error", "La longitud del nuevo password no debe ser menor a 6 caracteres");   
                $sw = 0;
            }
        }
        
        if($sw == 1){
            if($newpassword != $reppassword){
                $this->session->set_userdata("error", "El nuevo password y la repeticion son diferentes");
                $sw = 0;
            }
        }
        
        if($sw == 1){
            if($newpassword_o == $usuario){
                $this->session->set_userdata("error", "El nuevo password no puede ser igual al usuario actual");
                $sw = 0;
            }
        }
        
        if($sw == 1){
            $data = array( 
              'contrasena'=>$newpassword
             );
            $this->db->where('id', $id);
            $this->db->update('usuario', $data);     
            
            $password_o = "";
            $newpassword_o = "";
            $reppassword_o = "";
            $this->session->set_userdata("exito", "Se realizo correctamente el cambio");
        }
        
        $data = array(
            "passwords" => $password_o,
            "newpasswords" => $newpassword_o,
            "reppasswords" => $reppassword_o
        );

        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );

        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_cambiopassword', $data);
        $this->load->view("layouts/footer");
    }
    
}

?>
