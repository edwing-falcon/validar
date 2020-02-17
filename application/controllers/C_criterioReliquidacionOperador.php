<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_criterioReliquidacionOperador extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idCriterioReliquidacionOperador = "";
        $operadorCriterioReliquidacionOperador = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor = $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idCriterioReliquidacionOperador")){
            $idCriterioReliquidacionOperador = $this->session->userdata("idCriterioReliquidacionOperador");
        }
        
        if ($this->session->userdata("operadorCriterioReliquidacionOperador")){
            $operadorCriterioReliquidacionOperador = $this->session->userdata("operadorCriterioReliquidacionOperador");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url()."C_criterioReliquidacionOperador/pagina/";
        $conta = $this->Formm03_model->getTotalCriterioReliquidacionOperador($idCriterioReliquidacionOperador, $operadorCriterioReliquidacionOperador);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_criterioReliquidacionOperador";
        
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
            "criterios" => $this->Formm03_model->getCriterioReliquidacionOperador($idCriterioReliquidacionOperador, $operadorCriterioReliquidacionOperador, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('reliquidacion/V_criterioReliquidacionOperador',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idCriterioReliquidacionOperador');
        $this->session->unset_userdata('operadorCriterioReliquidacionOperador');
        
        redirect(base_url()."C_criterioReliquidacionOperador");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idCriterioReliquidacionOperador = $this->input->post("idCriterioReliquidacionOperador");
        $operadorCriterioReliquidacionOperador = $this->input->post("operadorCriterioReliquidacionOperador");
        
        $idCriterioReliquidacionOperador = trim($idCriterioReliquidacionOperador);
        $operadorCriterioReliquidacionOperador = strtoupper(trim($operadorCriterioReliquidacionOperador));
        
        if(is_numeric($idCriterioReliquidacionOperador) == false){ $idCriterioReliquidacionOperador = 0; }
        
        $this->session->set_userdata("idCriterioReliquidacionOperador", $idCriterioReliquidacionOperador);
        $this->session->set_userdata("operadorCriterioReliquidacionOperador", $operadorCriterioReliquidacionOperador);
        
        redirect(base_url()."C_criterioReliquidacionOperador");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
}












?>