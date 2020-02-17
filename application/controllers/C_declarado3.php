<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_declarado3 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $exportadorM03Declarado = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor = $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("exportadorM03Declarado")){
            $exportadorM03Declarado = $this->session->userdata("exportadorM03Declarado");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url()."C_declarado3/pagina/";
        $conta = $this->Formm03_model->getTotalDeclarado($exportadorM03Declarado);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_declarado3";
        
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
            "declarados" => $this->Formm03_model->getDeclaradoResumen($exportadorM03Declarado, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('formm03/V_declaradoResumen3',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('exportadorM03Declarado');
        redirect(base_url()."C_declarado3");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $exportadorM03Declarado = $this->input->post("exportadorM03Declarado");
        $exportadorM03Declarado = strtoupper(trim($exportadorM03Declarado));
        
        $this->session->set_userdata("exportadorM03Declarado", $exportadorM03Declarado);
        
        redirect(base_url()."C_declarado3");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
}












?>