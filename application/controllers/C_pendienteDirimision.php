<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_pendienteDirimision extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idPendienteDirimision = "";
        $codigoPendienteDirimision = "";
        $exportadorPendienteDirimision = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idPendienteDirimision")){
            $idPendienteDirimision = $this->session->userdata("idPendienteDirimision");
        }
        
        if ($this->session->userdata("codigoPendienteDirimision")){
            $codigoPendienteDirimision = $this->session->userdata("codigoPendienteDirimision");
        }
        
        if ($this->session->userdata("exportadorPendienteDirimision")){
            $exportadorPendienteDirimision = $this->session->userdata("exportadorPendienteDirimision");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_pendienteDirimision/pagina/";
        $conta = $this->Formm03_model->getTotalDirimisionReliquidacion($idPendienteDirimision, $codigoPendienteDirimision, $exportadorPendienteDirimision);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_pendienteDirimision";

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
            "pendientedirimisions" => $this->Formm03_model->getDirimisionReliquidacion($idPendienteDirimision, $codigoPendienteDirimision, $exportadorPendienteDirimision, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_pendienteDirimision",$data);
        $this->load->view("layouts/footer");
        
        $this->session->unset_userdata('error');
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idPendienteDirimision');
        $this->session->unset_userdata('codigoPendienteDirimision');
        $this->session->unset_userdata('exportadorPendienteDirimision');
        redirect(base_url()."C_pendienteDirimision");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idPendienteDirimision = $this->input->post("idPendienteDirimision");
        $codigoPendienteDirimision = $this->input->post("codigoPendienteDirimision");
        $exportadorPendienteDirimision = $this->input->post("exportadorPendienteDirimision");
        
        $idPendienteDirimision = trim($idPendienteDirimision);
        $codigoPendienteDirimision = strtoupper(trim($codigoPendienteDirimision));
        $exportadorPendienteDirimision = strtoupper(trim($exportadorPendienteDirimision));
       
        if(is_numeric($idPendienteDirimision) == false){ $idPendienteDirimision = 0; }
        
        $this->session->set_userdata("idPendienteDirimision", $idPendienteDirimision);
        $this->session->set_userdata("codigoPendienteDirimision", $codigoPendienteDirimision);
        $this->session->set_userdata("exportadorPendienteDirimision", $exportadorPendienteDirimision);
        redirect(base_url()."C_pendienteReliquidacion");
    }
    
    public function datosEnvioNotificacionDirimision($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select id, idformm03, tiporeliquidacion, fechareliquidacion, fechaenvionotificacion, citenotificacion, fecharecepcionnotificacion, fechaenviodirimision, citedirimision, fecharecepciondirimision ";
        $sql .= "from reliquidacion03calculorm ";
        $sql .= "where id = ".$id." ";
        $sql .= "; ";
        
        
    }
    
}

?>