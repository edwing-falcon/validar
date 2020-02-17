<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_buscarDepositoM01 extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm01_model");
        /*$this->load->model("Formm02_model");
        $this->load->model("Formm03_model");*/
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $buscarAporteDepositoM01 = "";
        $buscarAporteCuentaM01 = "";
        $buscarAporteConceptoPagoM01 = "";
        
        $controlSession = $this->Formm01_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("buscarAporteDepositoM01")){
            $buscarAporteDepositoM01 = $this->session->userdata("buscarAporteDepositoM01");
        }
        
        if ($this->session->userdata("buscarAporteCuentaM01")){
            $buscarAporteCuentaM01 = $this->session->userdata("buscarAporteCuentaM01");
        }
        
        if ($this->session->userdata("buscarAporteConceptoPagoM01")){
            $buscarAporteConceptoPagoM01 = $this->session->userdata("buscarAporteConceptoPagoM01");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_buscarDepositoM01/pagina/";
        $contaM01 = $this->Formm01_model->getTotalBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarAporteConceptoPagoM01);
        $config['total_rows'] = $contaM01;
        $cant = $contaM01;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_buscarDepositoM01";

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
            "depositoM01s" => $this->Formm01_model->getBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarAporteConceptoPagoM01, $inicio, $mostrarpor),
            "contaM01s" => $contaM01
            
            /*"depositoM02s" => $this->Formm02_model->getBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarEntidadFinanciera, $buscarEntidadAporte),
            "contaM02s" => $contaM02,
            
            "depositoM03s" => $this->Formm03_model->getBuscarDeposito($buscarAporteDepositoM01, $buscarAporteCuentaM01, $buscarEntidadFinanciera, $buscarEntidadAporte),
            "contaM03s" => $contaM03*/
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_buscarDepositoM01',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm01_model->controlSession();
        
        $this->session->unset_userdata('buscarAporteDepositoM01');
        $this->session->unset_userdata('buscarAporteCuentaM01');
        $this->session->unset_userdata('buscarAporteConceptoPagoM01');
        
        redirect(base_url()."C_buscarDepositoM01");
    }

    public function busqueda(){
        $controlSession = $this->Formm01_model->controlSession();
        
        $buscarAporteDepositoM01 = $this->input->post("buscarAporteDepositoM01");
        $buscarAporteCuentaM01 = $this->input->post("buscarAporteCuentaM01");
        $buscarAporteConceptoPagoM01 = $this->input->post("buscarAporteConceptoPagoM01");
       
        $buscarAporteDepositoM01 = strtoupper(trim($buscarAporteDepositoM01));
        $buscarAporteCuentaM01 = strtoupper(trim($buscarAporteCuentaM01));
        $buscarAporteConceptoPagoM01 = strtoupper(trim($buscarAporteConceptoPagoM01));
        
        $this->session->set_userdata("buscarAporteDepositoM01", $buscarAporteDepositoM01);
        $this->session->set_userdata("buscarAporteCuentaM01", $buscarAporteCuentaM01);
        $this->session->set_userdata("buscarAporteConceptoPagoM01", $buscarAporteConceptoPagoM01);
        
        redirect(base_url()."C_buscarDepositoM01");
    }
    
    public function verM01($entrada){
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
    
    public function verM02($entrada){
        $controlSession = $this->Formm01_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        $codigo = $this->Formm02_model->getCodigo($id);
        $fechaactual = $this->Formm02_model->getFechaActual();
        $estado = $this->Formm02_model->getEstado($id);
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$codigo,
           'estados'=>$estado,
           'oficinavalidacions'=>$this->Formm02_model->getOficinaValidacion($id),
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
        $this->load->view("formm02/V_buscar_ver", $data);
        $this->load->view("layouts/footer");
    }
    
    public function verM03($entrada){
        $controlSession = $this->Formm01_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $codigo = $this->Formm03_model->getCodigo($id);
        $estado = $this->Formm03_model->getEstado($id);
        
        $data = array( 
           'ids'=>$id, 
           'codigos'=>$codigo, 
           'estados'=>$estado,
           'oficinavalidacions'=>$this->Formm03_model->getOficinaValidacion($id),
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
        $this->load->view("formm03/V_buscar3_ver", $data);
        $this->load->view("layouts/footer");
    }
    
    
}

?>
