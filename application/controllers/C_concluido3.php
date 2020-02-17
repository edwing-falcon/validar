<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_concluido3 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM03Concluido = "";
        $M03CodigoConcluido = "";
        $exportadorM03Concluido = "";
        $compradorM03Concluido = "";
        $fronteraM03Concluido = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM03Concluido")){
            $idM03Concluido = $this->session->userdata("idM03Concluido");
        }
        
        if ($this->session->userdata("M03CodigoConcluido")){
            $M03CodigoConcluido = $this->session->userdata("M03CodigoConcluido");
        }
        
        if ($this->session->userdata("exportadorM03Concluido")){
            $exportadorM03Concluido = $this->session->userdata("exportadorM03Concluido");
        }
        
        if ($this->session->userdata("compradorM03Concluido")){
            $compradorM03Concluido = $this->session->userdata("compradorM03Concluido");
        }
        
        if ($this->session->userdata("fronteraM03Concluido")){
            $fronteraM03Concluido = $this->session->userdata("fronteraM03Concluido");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_concluido3/pagina/";
        $conta = $this->Formm03_model->getTotal(2, $idM03Concluido, $M03CodigoConcluido, $exportadorM03Concluido, $compradorM03Concluido, $fronteraM03Concluido);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_concluido3";

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
            "concluidos" => $this->Formm03_model->getConcluido3($idM03Concluido, $M03CodigoConcluido, $exportadorM03Concluido, $compradorM03Concluido, $fronteraM03Concluido, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_concluido3",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idM03Concluido');
        $this->session->unset_userdata('M03CodigoConcluido');
        $this->session->unset_userdata('exportadorM03Concluido');
        $this->session->unset_userdata('compradorM03Concluido');
        $this->session->unset_userdata('fronteraM03Concluido');
        redirect(base_url()."C_concluido3");
    }

    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idM03Concluido = $this->input->post("idM03Concluido");
        $M03CodigoConcluido = $this->input->post("M03CodigoConcluido");
        $exportadorM03Concluido = $this->input->post("exportadorM03Concluido");
        $compradorM03Concluido = $this->input->post("compradorM03Concluido");
        $fronteraM03Concluido = $this->input->post("fronteraM03Concluido");
        
        $idM03Concluido = trim($idM03Concluido);
        $M03CodigoConcluido = trim($M03CodigoConcluido);
        $exportadorM03Concluido = strtoupper(trim($exportadorM03Concluido));
        $compradorM03Concluido = strtoupper(trim($compradorM03Concluido));
        $fronteraM03Concluido = strtoupper(trim($fronteraM03Concluido));
        
        if(is_numeric($idM03Concluido) == false){ $idM03Concluido = 0; }
        
        $this->session->set_userdata("idM03Concluido", $idM03Concluido);
        $this->session->set_userdata("M03CodigoConcluido", $M03CodigoConcluido);
        $this->session->set_userdata("exportadorM03Concluido", $exportadorM03Concluido);
        $this->session->set_userdata("compradorM03Concluido", $compradorM03Concluido);
        $this->session->set_userdata("fronteraM03Concluido", $fronteraM03Concluido);
        
        redirect(base_url()."C_concluido3");
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
        $this->load->view("formm03/V_concluido3_ver", $data);
        $this->load->view("layouts/footer");
    }
}

?>