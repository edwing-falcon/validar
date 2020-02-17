<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rechazado3 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM03Rechazado = "";
        $M03CodigoRechazado = "";
        $exportadorM03Rechazado = "";
        $compradorM03Rechazado = "";
        $fronteraM03Rechazado = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM03Rechazado")){
            $idM03Rechazado = $this->session->userdata("idM03Rechazado");
        }
        
        if ($this->session->userdata("M03CodigoRechazado")){
            $M03CodigoRechazado = $this->session->userdata("M03CodigoRechazado");
        }
        
        if ($this->session->userdata("exportadorM03Rechazado")){
            $exportadorM03Rechazado = $this->session->userdata("exportadorM03Rechazado");
        }
        
        if ($this->session->userdata("compradorM03Rechazado")){
            $compradorM03Rechazado = $this->session->userdata("compradorM03Rechazado");
        }
        
        if ($this->session->userdata("fronteraM03Rechazado")){
            $fronteraM03Rechazado = $this->session->userdata("fronteraM03Rechazado");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_rechazado3/pagina/";
        $conta = $this->Formm03_model->getTotal(10, $idM03Rechazado, $M03CodigoRechazado, $exportadorM03Rechazado, $compradorM03Rechazado, $fronteraM03Rechazado);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_rechazado3";

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
            "rechazados" => $this->Formm03_model->getRechazado3($idM03Rechazado, $M03CodigoRechazado, $exportadorM03Rechazado, $compradorM03Rechazado, $fronteraM03Rechazado, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_rechazado3",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idM03Rechazado');
        $this->session->unset_userdata('M03CodigoRechazado');
        $this->session->unset_userdata('exportadorM03Rechazado');
        $this->session->unset_userdata('compradorM03Rechazado');
        $this->session->unset_userdata('fronteraM03Rechazado');
        redirect(base_url()."C_rechazado3");
    }

    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idM03Rechazado = $this->input->post("idM03Rechazado");
        $M03CodigoRechazado = $this->input->post("M03CodigoRechazado");
        $exportadorM03Rechazado = $this->input->post("exportadorM03Rechazado");
        $compradorM03Rechazado = $this->input->post("compradorM03Rechazado");
        $fronteraM03Rechazado = $this->input->post("fronteraM03Rechazado");
        
        $idM03Rechazado = trim($idM03Rechazado);
        $M03CodigoRechazado = trim($M03CodigoRechazado);
        $exportadorM03Rechazado = strtoupper(trim($exportadorM03Rechazado));
        $compradorM03Rechazado = strtoupper(trim($compradorM03Rechazado));
        $fronteraM03Rechazado = strtoupper(trim($fronteraM03Rechazado));
        
        if(is_numeric($idM03Rechazado) == false){ $idM03Rechazado = 0; }
        
        $this->session->set_userdata("idM03Rechazado", $idM03Rechazado);
        $this->session->set_userdata("M03CodigoRechazado", $M03CodigoRechazado);
        $this->session->set_userdata("exportadorM03Rechazado", $exportadorM03Rechazado);
        $this->session->set_userdata("compradorM03Rechazado", $compradorM03Rechazado);
        $this->session->set_userdata("fronteraM03Rechazado", $fronteraM03Rechazado);
        
        redirect(base_url()."C_rechazado3");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function bitacora3($id){
        $controlSession = $this->Formm03_model->controlSession();
        
        $data = array( 
            'bitacoras'=>$this->Formm03_model->getBitacoras($id),
        );
        $this->load->view("formm03/V_rechazado3_tabla", $data);
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
        $this->load->view("formm03/V_rechazado3_ver", $data);
        $this->load->view("layouts/footer");
    }
}

?>
