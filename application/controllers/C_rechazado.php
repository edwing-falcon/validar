<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_rechazado extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
       $inicio = 0;
        $mostrarpor = 10; 
        $idM02Rechazado = "";
        $compradorM02Rechazado = "";
        $vendedorM02Rechazado = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM02Rechazado")){
            $idM02Rechazado = $this->session->userdata("idM02Rechazado");
        }
        
        if ($this->session->userdata("compradorM02Rechazado")){
            $compradorM02Rechazado = $this->session->userdata("compradorM02Rechazado");
        }
        
        if ($this->session->userdata("vendedorM02Rechazado")){
            $vendedorM02Rechazado = $this->session->userdata("vendedorM02Rechazado");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_rechazado/pagina/";
        $conta = $this->Formm02_model->getTotal(10, $idM02Rechazado, $compradorM02Rechazado, $vendedorM02Rechazado);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_rechazado";

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
            "rechazados"=>$this->Formm02_model->getRechazado($idM02Rechazado, $compradorM02Rechazado, $vendedorM02Rechazado, $inicio, $mostrarpor),
            "cants"=>$cant
        ); 
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->helper('form'); 
        
        //$this->load->view("layouts/header", $data1);
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_rechazado",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idM02Rechazado');
        $this->session->unset_userdata('compradorM02Rechazado');
        $this->session->unset_userdata('vendedorM02Rechazado');
        redirect(base_url()."C_rechazado");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idM02Rechazado = $this->input->post("idM02Rechazado");
        $compradorM02Rechazado = $this->input->post("compradorM02Rechazado");
        $vendedorM02Rechazado = $this->input->post("vendedorM02Rechazado");
        
        $idM02Rechazado = trim($idM02Rechazado);
        $compradorM02Rechazado = strtoupper(trim($compradorM02Rechazado));
        $vendedorM02Rechazado = strtoupper(trim($vendedorM02Rechazado));
        
        if(is_numeric($idM02Rechazado) == false){ $idM02Rechazado = 0; }
        
        $this->session->set_userdata("idM02Rechazado", $idM02Rechazado);
        $this->session->set_userdata("compradorM02Rechazado", $compradorM02Rechazado);
        $this->session->set_userdata("vendedorM02Rechazado", $vendedorM02Rechazado);
        
        redirect(base_url()."C_rechazado");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function bitacora($id){
        $controlSession = $this->Formm02_model->controlSession();
        
        $data = array( 
            'bitacoras'=>$this->Formm02_model->getBitacoras2($id)
        );
        $this->load->view("formm02/V_rechazado_tabla", $data);
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        
        $fechaactual = $this->Formm02_model->getFechaActual();
        $codigo = $this->Formm02_model->getCodigo($id);
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$codigo, 
           'formm02'=>$this->Formm02_model->getDatosTransaccion("formm02", $id),
           'formm02regalias'=>$this->Formm02_model->getDatosRegalia($id),
           'formm02totalesregalia'=>$this->Formm02_model->getTotalRegaliaMinera($id),
           'formm02aportedepartamental'=>$this->Formm02_model->getAporteDepartamental($id),
           'formm02totalaportedepartamental'=>$this->Formm02_model->getTotalAporteDepartamental($id),
           'formm02aporte'=>$this->Formm02_model->getFormm02Aporte($id),
           'formm02totalimporte'=>$this->Formm02_model->getTotalImporte($id), 
           'bitacoras'=>$this->Formm02_model->getBitacoras1($id),
           'rechazos'=>$this->Formm02_model->getRechazos() 
        ); 
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        //$this->load->view("layouts/header", $data1);
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_rechazado_ver", $data);
        $this->load->view("layouts/footer");
    }
    
}

?>