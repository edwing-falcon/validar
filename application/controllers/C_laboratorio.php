<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laboratorio extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Laboratorio_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idlaboratorioLaboratorio = "";
        $laboratorioLaboratorio = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idlaboratorioLaboratorio")){
            $idlaboratorioLaboratorio = $this->session->userdata("idlaboratorioLaboratorio");
        }
        
        if ($this->session->userdata("laboratorioLaboratorio")){
            $laboratorioLaboratorio = $this->session->userdata("laboratorioLaboratorio");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url()."C_laboratorio/pagina/";
        $conta = $this->Laboratorio_model->getTotal($idlaboratorioLaboratorio, $laboratorioLaboratorio);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_laboratorio";

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
            "laboratorios" => $this->Laboratorio_model->getLaboratorio($idlaboratorioLaboratorio, $laboratorioLaboratorio, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_laboratorio',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idlaboratorioLaboratorio');
        $this->session->unset_userdata('laboratorioLaboratorio');
        
        redirect(base_url()."C_laboratorio");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idlaboratorioLaboratorio = $this->input->post("idlaboratorioLaboratorio");
        $laboratorioLaboratorio = $this->input->post("laboratorioLaboratorio");
        
        $idlaboratorioLaboratorio = trim($idlaboratorioLaboratorio);
        $laboratorioLaboratorio = strtoupper(trim($laboratorioLaboratorio));
        
        if(is_numeric($idlaboratorioLaboratorio) == false){ $idlaboratorioLaboratorio = 0; }
        
        $this->session->set_userdata("idlaboratorioLaboratorio", $idlaboratorioLaboratorio);
        $this->session->set_userdata("laboratorioLaboratorio", $laboratorioLaboratorio);
        
        redirect(base_url()."C_laboratorio");
    }    
}

?>
