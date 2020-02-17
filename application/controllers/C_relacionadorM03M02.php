<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_relacionadorM03M02 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idformm03relacionadorM03M02 = "";
        $idformm02relacionadorM03M02 = "";
        $obsrelacionadorM03M02 = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idformm03relacionadorM03M02")){
            $idformm03relacionadorM03M02 = $this->session->userdata("idformm03relacionadorM03M02");
        }
        
        if ($this->session->userdata("idformm02relacionadorM03M02")){
            $idformm02relacionadorM03M02 = $this->session->userdata("idformm02relacionadorM03M02");
        }
        
        if ($this->session->userdata("obsrelacionadorM03M02")){
            $obsrelacionadorM03M02 = $this->session->userdata("obsrelacionadorM03M02");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_relacionadorM03M02/pagina/";
        $conta = $this->Formm03_model->getTotalRelacionadorM03M02($idformm03relacionadorM03M02, $idformm02relacionadorM03M02, $obsrelacionadorM03M02);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_relacionadorM03M02";

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
            "relacionadors" => $this->Formm03_model->getRelacionadorM03M02Detalle($idformm03relacionadorM03M02, $idformm02relacionadorM03M02, $obsrelacionadorM03M02, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_relacionadorM03M02",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idformm03relacionadorM03M02');
        $this->session->unset_userdata('idformm02relacionadorM03M02');
        $this->session->unset_userdata('obsrelacionadorM03M02');
        
        redirect(base_url()."C_relacionadorM03M02");
    }

    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03relacionadorM03M02 = $this->input->post("idformm03relacionadorM03M02");
        $idformm02relacionadorM03M02 = $this->input->post("idformm02relacionadorM03M02");
        $obsrelacionadorM03M02 = $this->input->post("obsrelacionadorM03M02");
        
        $idformm03relacionadorM03M02 = trim($idformm03relacionadorM03M02);
        $idformm02relacionadorM03M02 = trim($idformm02relacionadorM03M02);
        $obsrelacionadorM03M02 = trim($obsrelacionadorM03M02);
        
        if(is_numeric($idformm03relacionadorM03M02) == false){ $idformm03relacionadorM03M02 = 0; }
        if(is_numeric($idformm02relacionadorM03M02) == false){ $idformm02relacionadorM03M02 = 0; }
        
        $this->session->set_userdata("idformm03relacionadorM03M02", $idformm03relacionadorM03M02);
        $this->session->set_userdata("idformm02relacionadorM03M02", $idformm02relacionadorM03M02);
        $this->session->set_userdata("obsrelacionadorM03M02", $obsrelacionadorM03M02);
        
        redirect(base_url()."C_relacionadorM03M02");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $codigo = $this->Formm03_model->getCodigo($id);
        
        $data = array( 
           'ids'=>$id, 
           'codigos'=>$codigo, 
           'formm03'=>$this->Formm03_model->getDatosTransaccion("formm03", $id),
           'formm03regalias'=>$this->Formm03_model->getDatosRegalia($id),
           'formm03totalesregalia'=>$this->Formm03_model->getTotalRegaliaMinera($id),
           'formm03aportedepartamental'=>$this->Formm03_model->getAporteDepartamental($id),
           'formm03totalaportedepartamental'=>$this->Formm03_model->getTotalAporteDepartamental($id),
           'formm03aporte'=>$this->Formm03_model->getFormm03Aporte($id),
           'formm03totalimporte'=>$this->Formm03_model->getTotalImporte($id),
           'bitacoras'=>$this->Formm03_model->getBitacoras($id),
           'rechazos'=>$this->Formm03_model->getRechazos() 
        ); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_relacionadorM03M02_ver", $data);
        $this->load->view("layouts/footer");
    }
}

?>