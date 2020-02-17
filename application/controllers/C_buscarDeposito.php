<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_buscarDeposito extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm01_model");
        $this->load->model("Formm02_model");
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $buscarAporteDeposito = "";
        $buscarAporteCuenta = "";
        $buscarAporteEntidadFinanciera = "";
        $buscarAporteEntidadAporte = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("buscarAporteDeposito")){
            $buscarAporteDeposito = $this->session->userdata("buscarAporteDeposito");
        }
        
        if ($this->session->userdata("buscarAporteCuenta")){
            $buscarAporteCuenta = $this->session->userdata("buscarAporteCuenta");
        }
        
        if ($this->session->userdata("buscarAporteEntidadFinanciera")){
            $buscarAporteEntidadFinanciera = $this->session->userdata("buscarAporteEntidadFinanciera");
        }
        
        if ($this->session->userdata("buscarAporteEntidadAporte")){
            $buscarAporteEntidadAporte = $this->session->userdata("buscarAporteEntidadAporte");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_buscarDeposito/pagina/";
        $conta = $this->Formm02_model->getTotalBuscarDepositoGeneral($buscarAporteDeposito, $buscarAporteCuenta, $buscarAporteEntidadFinanciera, $buscarAporteEntidadAporte);
        $config['total_rows'] = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_buscarDeposito";

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
            "depositos" => $this->Formm02_model->getBuscarDepositoGeneral($buscarAporteDeposito, $buscarAporteCuenta, $buscarAporteEntidadFinanciera, $buscarAporteEntidadAporte, $inicio, $mostrarpor),
            "entidadesfinancieras" => $this->Formm02_model->getEntidadesFinancierasGeneral(),
            "aportes" => $this->Formm02_model->getAportesGeneral(),
            "contas" => $conta
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('admin/V_buscarDeposito',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('buscarAporteDeposito');
        $this->session->unset_userdata('buscarAporteCuenta');
        $this->session->unset_userdata('buscarAporteEntidadFinanciera');
        $this->session->unset_userdata('buscarAporteEntidadAporte');
        
        redirect(base_url()."C_buscarDeposito");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $buscarAporteDeposito = $this->input->post("buscarAporteDeposito");
        $buscarAporteCuenta = $this->input->post("buscarAporteCuenta");
        $buscarAporteEntidadFinanciera = $this->input->post("buscarAporteEntidadFinanciera");
        $buscarAporteEntidadAporte = $this->input->post("buscarAporteEntidadAporte");
       
        $buscarAporteDeposito = strtoupper(trim($buscarAporteDeposito));
        $buscarAporteCuenta = strtoupper(trim($buscarAporteCuenta));
        $buscarAporteEntidadFinanciera = strtoupper(trim($buscarAporteEntidadFinanciera));
        $buscarAporteEntidadAporte = strtoupper(trim($buscarAporteEntidadAporte));
        
        $this->session->set_userdata("buscarAporteDeposito", $buscarAporteDeposito);
        $this->session->set_userdata("buscarAporteCuenta", $buscarAporteCuenta);
        $this->session->set_userdata("buscarAporteEntidadFinanciera", $buscarAporteEntidadFinanciera);
        $this->session->set_userdata("buscarAporteEntidadAporte", $buscarAporteEntidadAporte);
        
        $conta = $this->Formm02_model->getTotalBuscarDepositoGeneral($buscarAporteDeposito, $buscarAporteCuenta, $buscarAporteEntidadFinanciera, $buscarAporteEntidadAporte);
        if($conta == 0){
            $this->session->set_userdata("error", "No existen datos");
        }
                
        redirect(base_url()."C_buscarDeposito");
    }
    
    public function verM01($entrada){
        $controlSession = $this->Formm02_model->controlSession();
        
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
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        $fechaactual = $this->Formm02_model->getFechaActual();
        $sql = "select ef.descripcion estado, codigoformm02 codigo from formm02 f join estadoformulario ef on ef.id = f.estado where f.id = ".$id."; ";
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$this->Formm02_model->getDatosTabla($sql, "codigo"),
           'estados'=>$this->Formm02_model->getDatosTabla($sql, "estado"),
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
        $controlSession = $this->Formm02_model->controlSession();
        
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
