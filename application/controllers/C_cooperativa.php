<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cooperativa extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Cooperativa_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idCooperativa = "";
        $cooperativa = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idCooperativa")){
            $idCooperativa = $this->session->userdata("idCooperativa");
        }
        
        if ($this->session->userdata("cooperativa")){
            $cooperativa = $this->session->userdata("cooperativa");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_cooperativa/pagina/";
        $conta = $this->Cooperativa_model->getTotal($idCooperativa, $cooperativa);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_cooperativa";

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
            "cooperativas" => $this->Cooperativa_model->getCooperativa($idCooperativa, $cooperativa, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_cooperativa',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idCooperativa');
        $this->session->unset_userdata('cooperativa');
        
        redirect(base_url()."C_cooperativa");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idCooperativa = $this->input->post("idCooperativa");
        $cooperativa = $this->input->post("cooperativa");
                
        $idCooperativa = trim($idCooperativa);
        $cooperativa = strtoupper(trim($cooperativa));
        
        if(is_numeric($idCooperativa) == false){ $idCooperativa = 0; }
        
        $this->session->set_userdata("idCooperativa", $idCooperativa);
        $this->session->set_userdata("cooperativa", $cooperativa);
        
        redirect(base_url()."C_cooperativa");
    }
    
}

?>
