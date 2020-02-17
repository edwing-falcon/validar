<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_usuario extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Usuario_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $buscador = "";
        
        //$can = $this->session->userdata("cantidad");
        //$this->output->set_output("can=".$can);
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        //$aux = $this->session->userdata("buscador");
        //$this->output->set_output("aux=".$aux);
        
        if ($this->session->userdata("buscador")){
            $buscador = $this->session->userdata("buscador");
        }
        
        if ($this->session->userdata("buscador")){
            $buscador = $this->session->userdata("buscador");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_usuario/pagina/";
        $config['total_rows'] = count($this->Usuario_model->buscar($buscador));
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_usuario";

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='javascript:void(0)'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config); 

        $data = array(
            "usuarios" => $this->Usuario_model->buscar($buscador, $inicio, $mostrarpor)
        ); 
        $this->load->helper('form'); 
        $this->load->view('V_usuarios',$data);
    }
    
    public function mostrar(){
        $this->session->unset_userdata('buscador');
        redirect(base_url()."C_usuario");
    }

    public function busqueda(){
        $buscador = $this->input->post("busqueda");
        $this->session->set_userdata("buscador",$buscador);
        
        //$aux = $this->session->userdata("buscador");
        //$this->output->set_output("aux=".$aux);
        redirect(base_url()."C_usuario");
    }
    
    public function cantidad(){
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
}

?>