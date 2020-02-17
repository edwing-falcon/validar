<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_mineral extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Mineral_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idMineral = "";
        $mineral = "";
        $estadoMineral = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idMineral")){
            $idMineral = $this->session->userdata("idMineral");
        }
        
        if ($this->session->userdata("mineral")){
            $mineral = $this->session->userdata("mineral");
        }
        
        if ($this->session->userdata("estadoMineral")){
            $estadoMineral = $this->session->userdata("estadoMineral");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_mineral/pagina/";
        $conta = $this->Mineral_model->getTotal($idMineral, $mineral, $estadoMineral);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_mineral";

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
            "estadoMinerals" => $estadoMineral, 
            "estados" => $this->Mineral_model->getEstadoMineral(),
            "minerales" => $this->Mineral_model->getMineral($idMineral, $mineral, $estadoMineral, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_mineral',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idMineral');
        $this->session->unset_userdata('mineral');
        redirect(base_url()."C_mineral");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idMineral = $this->input->post("idMineral");
        $mineral = $this->input->post("mineral");
        $estadoMineral = $this->input->post("estadoMineral");
        
        $idMineral = trim($idMineral);
        $mineral = strtoupper(trim($mineral));
        $estadoMineral = trim($estadoMineral);
        
        if(is_numeric($idMineral) == false){ $idMineral = 0; }
        
        $this->session->set_userdata("idMineral", $idMineral);
        $this->session->set_userdata("mineral", $mineral);
        $this->session->set_userdata("estadoMineral", $estadoMineral);
        
        redirect(base_url()."C_mineral");
    }
    
}

?>
