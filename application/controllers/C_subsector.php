<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_subsector extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Subsector_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idsubSector = "";
        $subSector = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idsubSector")){
            $idsubSector = $this->session->userdata("idsubSector");
        }
        
        if ($this->session->userdata("subSector")){
            $subSector = $this->session->userdata("subSector");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_subsector/pagina/";
        $conta = $this->Subsector_model->getTotal($idsubSector, $subSector);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_subsector";

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
            "subsectores" => $this->Subsector_model->getSubSector($idsubSector, $subSector, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form');
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_subsector',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idsubSector');
        $this->session->unset_userdata('subSector');
        
        redirect(base_url()."C_subsector");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idsubSector = $this->input->post("idsubSector");
        $subSector = $this->input->post("subSector");
        
        $idsubSector = trim($idsubSector);
        $subSector = strtoupper(trim($subSector));
        
        if(is_numeric($idsubSector) == false){ $idsubSector = 0; }
        
        $this->session->set_userdata("idsubSector", $idsubSector);
        $this->session->set_userdata("subSector", $subSector);
        
        redirect(base_url()."C_subsector");
    }
    
}

?>
