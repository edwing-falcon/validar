<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_fueraplazo extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $buscador = "";
        $buscomprador = "";
        $busvendedor = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("buscador")){
            $buscador = $this->session->userdata("buscador");
        }
        
        if ($this->session->userdata("buscomprador")){
            $buscomprador = $this->session->userdata("buscomprador");
        }
        
        if ($this->session->userdata("busvendedor")){
            $busvendedor = $this->session->userdata("busvendedor");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_fueraplazo/pagina/";
        $config['total_rows'] = count($this->Formm02_model->buscar_fueraplazo($buscador, $buscomprador, $busvendedor));
        $cant = count($this->Formm02_model->buscar_fueraplazo($buscador, $buscomprador, $busvendedor));
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_fueraplazo";

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
            "fueraplazos" => $this->Formm02_model->buscar_fueraplazo($buscador, $buscomprador, $busvendedor, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('formm02/V_fueraplazo',$data);
        $this->load->view("layouts/footer");
        
        $this->session->unset_userdata('buscador');
        $this->session->unset_userdata('buscomprador');
        $this->session->unset_userdata('busvendedor');
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('buscador');
        $this->session->unset_userdata('buscomprador');
        $this->session->unset_userdata('busvendedor');
        redirect(base_url()."C_fueraplazo");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $buscador = $this->input->post("busqueda");
        $buscomprador = $this->input->post("buscomprador");
        $busvendedor = $this->input->post("busvendedor");
        
        $buscador = trim($buscador);
        $buscomprador = trim($buscomprador);
        $busvendedor = trim($busvendedor);
        
        $this->session->set_userdata("buscador", $buscador);
        $this->session->set_userdata("buscomprador", $buscomprador);
        $this->session->set_userdata("busvendedor", $busvendedor);
        
        /*$aux0 = "";
        $aux1 = $this->session->userdata("buscador");
        $aux3 = $this->session->userdata("buscomprador");
        $aux4 = $this->session->userdata("busvendedor");
        
        $aux0 = "bus=".$aux1.", cod= ".$aux2.", com= ".$aux3.", ven = ".$aux4." ";
        $this->output->set_output("aux=".$aux0);*/
        
        redirect(base_url()."C_fueraplazo");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($id){
        $controlSession = $this->Formm02_model->controlSession();
        
        $fechaactual = $this->Formm02_model->getFechaActual();
        
        $data = array( 
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
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_rechazado_ver", $data);
        $this->load->view("layouts/footer");
    }
    
}

