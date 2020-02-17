<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_formm01 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm01_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idformm01 = "";
        $nimformm01 = "";
        $operadorformm01 = "";
        $subsectorformm01 = "";
        
        $controlSession = $this->Formm01_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idformm01")){
            $idformm01 = $this->session->userdata("idformm01");
        }
        
        if ($this->session->userdata("nimformm01")){
            $nimformm01 = $this->session->userdata("nimformm01");
        }
        
        if ($this->session->userdata("operadorformm01")){
            $operadorformm01 = $this->session->userdata("operadorformm01");
        }
        
        if ($this->session->userdata("subsectorformm01")){
            $subsectorformm01 = $this->session->userdata("subsectorformm01");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_formm01/pagina/";
        $conta = $this->Formm01_model->getTotal($idformm01, $nimformm01, $operadorformm01, $subsectorformm01);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_formm01";

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
            "datos" => $this->Formm01_model->getFormm01($idformm01, $nimformm01, $operadorformm01, $subsectorformm01, $inicio, $mostrarpor),
            "cants" => $cant
        );
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm01/V_formm01",$data);
        $this->load->view("layouts/footer");
    }
        
    public function mostrar(){
        $controlSession = $this->Formm01_model->controlSession();
        
        $this->session->unset_userdata('idformm01');
        $this->session->unset_userdata('nimformm01');
        $this->session->unset_userdata('operadorformm01');
        $this->session->unset_userdata('subsectorformm01');

        redirect(base_url()."C_formm01");
    }

    public function busqueda(){
        $controlSession = $this->Formm01_model->controlSession();
        
        $idformm01 = $this->input->post("idformm01");
        $nimformm01 = $this->input->post("nimformm01");
        $operadorformm01 = $this->input->post("operadorformm01");
        $subsectorformm01 = $this->input->post("subsectorformm01");
        
        $idformm01 = trim($idformm01);
        $nimformm01 = trim($nimformm01);
        $operadorformm01 = strtoupper(trim($operadorformm01));
        $subsectorformm01 = strtoupper(trim($subsectorformm01));
        
        if(is_numeric($idformm01) == false){ $idformm01 = 0; }
        
        $this->session->set_userdata("idformm01", $idformm01);
        $this->session->set_userdata("nimformm01", $nimformm01);
        $this->session->set_userdata("operadorformm01", $operadorformm01);
        $this->session->set_userdata("subsectorformm01", $subsectorformm01);
        
        redirect(base_url()."C_formm01");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm01_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm01_model->controlSession();
        
        $id = trim($this->Formm01_model->desemcriptar($entrada));
        
        $data = array( 
            'ids'=>$id,
            'datospersonales'=>$this->Formm01_model->getDatosPersona($id),
            'actividadesmineras'=>$this->Formm01_model->getActividadesMineras($id),
            'minerales'=>$this->Formm01_model->getMinerales($id),
            'concesionesmineras'=>$this->Formm01_model->getConcesionesMineras($id),
            'contactosmineros'=>$this->Formm01_model->getContactosMineros($id),
            'representanteslegales'=>$this->Formm01_model->getRepresentantesLegales($id),
            'habilitacionusuario'=>$this->Formm01_model->getHabilitacionUsuario($id),
            'contactos'=>$this->Formm01_model->getContactos($id)
        ); 
                
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm01/V_formm01_ver", $data);
        $this->load->view("layouts/footer");
    }
    
}

?>
