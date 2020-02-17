<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_declaradoDetalle extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        
        $nim = "";
        $idM02DeclaradoDetalle = "";
        $vendedorM02DeclaradoDetalle = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("nim")){
            $nim = $this->session->userdata("nim");
        }
        
        if ($this->session->userdata("idM02DeclaradoDetalle")){
            $idM02DeclaradoDetalle = $this->session->userdata("idM02DeclaradoDetalle");
        }
        
        if ($this->session->userdata("vendedorM02DeclaradoDetalle")){
            $vendedorM02DeclaradoDetalle = $this->session->userdata("vendedorM02DeclaradoDetalle");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_declaradoDetalle/pagina/";
        $conta = $this->Formm02_model->getTotalNIM(0, $nim, $idM02DeclaradoDetalle, $vendedorM02DeclaradoDetalle);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_declaradoDetalle";

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
            "declarados" => $this->Formm02_model->getDeclaradosDetalle($nim, $idM02DeclaradoDetalle, $vendedorM02DeclaradoDetalle, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_declaradoDetalle",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idM02DeclaradoDetalle');
        $this->session->unset_userdata('vendedorM02DeclaradoDetalle');
        
        redirect(base_url()."C_declaradoDetalle");
    }

    public function detalle($nim){
        $controlSession = $this->Formm02_model->controlSession();
        
        $nim = trim($nim);
        $this->session->set_userdata("nim", $nim);
        
        redirect(base_url()."C_declaradoDetalle");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idM02DeclaradoDetalle = $this->input->post("idM02DeclaradoDetalle");
        $vendedorM02DeclaradoDetalle = $this->input->post("vendedorM02DeclaradoDetalle");
        
        $idM02DeclaradoDetalle = trim($idM02DeclaradoDetalle);
        $vendedorM02DeclaradoDetalle = strtoupper(trim($vendedorM02DeclaradoDetalle));
        
        if(is_numeric($idM02DeclaradoDetalle) == false){ $idM02DeclaradoDetalle = 0; }
        
        $this->session->set_userdata("idM02DeclaradoDetalle", $idM02DeclaradoDetalle);
        $this->session->set_userdata("vendedorM02DeclaradoDetalle", $vendedorM02DeclaradoDetalle);
        
        redirect(base_url()."C_declaradoDetalle");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($id){
        $controlSession = $this->Formm02_model->controlSession();
        
        //$id = $this->Formm02_model->desemcriptar($entrada);
        
        $data = array( 
           'formm02'=>$this->Formm02_model->getDatosTransaccion("formm02", $id),
           'formm02regalias'=>$this->Formm02_model->getDatosRegalia($id),
           'formm02totalesregalia'=>$this->Formm02_model->getTotalRegaliaMinera($id),
           'formm02aportedepartamental'=>$this->Formm02_model->getAporteDepartamental($id),
           'formm02totalaportedepartamental'=>$this->Formm02_model->getTotalAporteDepartamental($id),
           'formm02aporte'=>$this->Formm02_model->getFormm02Aporte($id),
           'formm02totalimporte'=>$this->Formm02_model->getTotalImporte($id),
           'motivos'=>$this->Formm02_model->getMotivoRechazo()
        ); 
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_formm02_ver", $data);
        $this->load->view("layouts/footer");
        
    }
    
}

?>
