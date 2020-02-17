<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_declarado extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $compradorM02Declarado = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor = $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("compradorM02Declarado")){
            $compradorM02Declarado = $this->session->userdata("compradorM02Declarado");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url()."C_declarado/pagina/";
        $conta = $this->Formm02_model->getTotalDeclarado($compradorM02Declarado);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_declarado";
        
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
            "declarados" => $this->Formm02_model->getDeclaradoResumen($compradorM02Declarado, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('formm02/V_declaradoResumen',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('compradorM02Declarado');
        redirect(base_url()."C_declarado");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $compradorM02Declarado = $this->input->post("compradorM02Declarado");
        $compradorM02Declarado = strtoupper(trim($compradorM02Declarado));
        
        $this->session->set_userdata("compradorM02Declarado", $compradorM02Declarado);
        
        redirect(base_url()."C_declarado");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
}












?>