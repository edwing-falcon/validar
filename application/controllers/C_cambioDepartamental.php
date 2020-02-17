<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cambioDepartamental extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Usuario_model");
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $idlugarCambioDepartamental = "";
        
        if ($this->session->userdata("idlugarCambioDepartamental")){
            $idlugarCambioDepartamental = $this->session->userdata("idlugarCambioDepartamental");
        }
        
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('exito');
        
        $idlugarCambioDepartamental = trim($idlugarCambioDepartamental);
        if(strlen($idlugarCambioDepartamental) == 0){
            $sql = "select id ";
            $sql .= "from lugarnim ";
            $sql .= "where descripcion = '".$lugar."'; ";
            $idlugarCambioDepartamental = $this->Formm02_model->getDatosTabla($sql, "id");
        }
        
        $this->session->set_userdata("idlugarCambioDepartamental", $idlugarCambioDepartamental);
        $data = array(
            "lugars" => $this->Usuario_model->getLugares()
        );
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_cambioDepartamental', $data);
        $this->load->view("layouts/footer");
    }
    
    public function guardar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = $this->session->userdata("id");
        $usuario = $this->session->userdata("usuario");
        
        $idlugarCambioDepartamental = $this->input->post("idlugarCambioDepartamental");
        $idlugarCambioDepartamental = trim($idlugarCambioDepartamental);
        
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('exito');
        
        $sql = "select descripcion from lugarnim where id = ".$idlugarCambioDepartamental."; ";
        $lugarCambioDepartamental = $this->Formm02_model->getDatosTabla($sql, "descripcion");
        $lugarCambioDepartamental = trim($lugarCambioDepartamental);
        
        $aux = "id = ".$id."<br/>";
        $aux .= "usuario = ".$usuario."<br/>";
        $aux .= "idlugarCambioDepartamental = ".$idlugarCambioDepartamental."<br/>";
        $aux .= "lugarCambioDepartamental = ".$lugarCambioDepartamental."<br/>";
        $this->output->set_output($aux);
        
        $Error = 0;
        if(strlen($idlugarCambioDepartamental) == 0){
            $Error = 1;
            
            $this->session->set_userdata("error", "Debe seleccionar una departamental");
            $this->session->set_userdata("idlugarCambioDepartamental", $idlugarCambioDepartamental);
            
            $data = array(
                "lugars" => $this->Usuario_model->getLugares()
            );
        
            $this->load->view("layouts/header3");
            $this->load->view("layouts/aside");
            $this->load->view('admin/V_cambioDepartamental', $data);
            $this->load->view("layouts/footer");
        } 
        
        if($Error == 0){
            $data = array( 
              'lugar'=>$idlugarCambioDepartamental
             );
            $this->db->where('id', $id);
            $this->db->update('usuario', $data);     
            
            $this->session->set_userdata("lugar", $lugarCambioDepartamental);
            redirect(base_url()."C_principal");
        }
    }
    
}

?>
