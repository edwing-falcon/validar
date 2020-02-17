<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_entidadaporte extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("EntidadAporte_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $identidadAporte = "";
        $entidadAporte = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("identidadAporte")){
            $identidadAporte = $this->session->userdata("identidadAporte");
        }
        
        if ($this->session->userdata("entidadAporte")){
            $entidadAporte = $this->session->userdata("entidadAporte");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_entidadaporte/pagina/";
        $conta = $this->EntidadAporte_model->getTotal($identidadAporte, $entidadAporte);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_entidadaporte";

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
            "entidades" => $this->EntidadAporte_model->getEntidadAporte($identidadAporte, $entidadAporte, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form');
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_entidadaporte',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('identidadAporte');
        $this->session->unset_userdata('entidadAporte');
        
        redirect(base_url()."C_entidadaporte");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $identidadAporte = $this->input->post("identidadAporte");
        $entidadAporte = $this->input->post("entidadAporte");
        
        $identidadAporte = trim($identidadAporte);
        $entidadAporte = strtoupper(trim($entidadAporte));
        
        if(is_numeric($identidadAporte) == false){ $identidadAporte = 0; }
        
        $this->session->set_userdata("identidadAporte", $identidadAporte);
        $this->session->set_userdata("entidadAporte", $entidadAporte);
        
        redirect(base_url()."C_entidadaporte");
    }
    
}

?>
