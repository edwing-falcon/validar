<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_municipio extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Municipio_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        
        $idMunicipio = "";
        $codigoMunicipio = "";
        $municipioMunicipio = "";
        $provinciaMunicipio = "";
        $departamentoMunicipio = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idMunicipio")){
            $idMunicipio = $this->session->userdata("idMunicipio");
        }
        
        if ($this->session->userdata("codigoMunicipio")){
            $codigoMunicipio = $this->session->userdata("codigoMunicipio");
        }
        
        if ($this->session->userdata("municipioMunicipio")){
            $municipioMunicipio = $this->session->userdata("municipioMunicipio");
        }
        
        if ($this->session->userdata("provinciaMunicipio")){
            $provinciaMunicipio = $this->session->userdata("provinciaMunicipio");
        }
        
        if ($this->session->userdata("departamentoMunicipio")){
            $departamentoMunicipio = $this->session->userdata("departamentoMunicipio");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_municipio/pagina/";
        
        $conta = $this->Municipio_model->getTotal($idMunicipio, $codigoMunicipio, $municipioMunicipio, $provinciaMunicipio, $departamentoMunicipio);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_municipio";

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
            "municipios" => $this->Municipio_model->getMunicipio($idMunicipio, $codigoMunicipio, $municipioMunicipio, $provinciaMunicipio, $departamentoMunicipio, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_municipio',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idMunicipio');
        $this->session->unset_userdata('codigoMunicipio');
        $this->session->unset_userdata('municipioMunicipio');
        $this->session->unset_userdata('provinciaMunicipio');
        $this->session->unset_userdata('departamentoMunicipio');
        
        redirect(base_url()."C_municipio");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idMunicipio = $this->input->post("idMunicipio");
        $codigoMunicipio = $this->input->post("codigoMunicipio");
        $municipioMunicipio = $this->input->post("municipioMunicipio");
        $provinciaMunicipio = $this->input->post("provinciaMunicipio");
        $departamentoMunicipio = $this->input->post("departamentoMunicipio");
        
        $idMunicipio = trim($idMunicipio);
        $codigoMunicipio = trim($codigoMunicipio);
        $municipioMunicipio = strtoupper(trim($municipioMunicipio));
        $provinciaMunicipio = strtoupper(trim($provinciaMunicipio));
        $departamentoMunicipio = strtoupper(trim($departamentoMunicipio));
        
        if(is_numeric($idMunicipio) == false){ $idMunicipio = 0; }
        
        $this->session->set_userdata("idMunicipio", $idMunicipio);
        $this->session->set_userdata("codigoMunicipio", $codigoMunicipio);
        $this->session->set_userdata("municipioMunicipio", $municipioMunicipio);
        $this->session->set_userdata("provinciaMunicipio", $provinciaMunicipio);
        $this->session->set_userdata("departamentoMunicipio", $departamentoMunicipio);
        
        redirect(base_url()."C_municipio");
    }
    
}

?>
