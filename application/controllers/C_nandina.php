<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nandina extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Nandina_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        
        $idNandina = "";
        $codigoNandina = "";
        $descripcionNandina = "";
        $mineralNandina = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idNandina")){
            $idNandina = $this->session->userdata("idNandina");
        }
        
        if ($this->session->userdata("codigoNandina")){
            $codigoNandina = $this->session->userdata("codigoNandina");
        }
        
        if ($this->session->userdata("descripcionNandina")){
            $descripcionNandina = $this->session->userdata("descripcionNandina");
        }
        
        if ($this->session->userdata("mineralNandina")){
            $mineralNandina = $this->session->userdata("mineralNandina");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_nandina/pagina/";
        $conta = $this->Nandina_model->getTotal($idNandina, $codigoNandina, $descripcionNandina, $mineralNandina);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_nandina";

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
            "nandinas" => $this->Nandina_model->getNandina($idNandina, $codigoNandina, $descripcionNandina, $mineralNandina, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_nandina',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idNandina');
        $this->session->unset_userdata('codigoNandina');
        $this->session->unset_userdata('descripcionNandina');
        $this->session->unset_userdata('mineralNandina');
        
        redirect(base_url()."C_nandina");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idNandina = $this->input->post("idNandina");
        $codigoNandina = $this->input->post("codigoNandina");
        $descripcionNandina = $this->input->post("descripcionNandina");
        $mineralNandina = $this->input->post("mineralNandina");
        
        $idNandina = trim($idNandina);
        $codigoNandina = trim($codigoNandina);
        $descripcionNandina = strtoupper(trim($descripcionNandina));
        $mineralNandina = strtoupper(trim($mineralNandina));
        
        if(is_numeric($idNandina) == false){ $idNandina = 0; }
        
        $this->session->set_userdata("idNandina", $idNandina);
        $this->session->set_userdata("codigoNandina", $codigoNandina);
        $this->session->set_userdata("descripcionNandina", $descripcionNandina);
        $this->session->set_userdata("mineralNandina", $mineralNandina);
        
        redirect(base_url()."C_nandina");
    }
    
}

?>

