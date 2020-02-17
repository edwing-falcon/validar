<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_concluido extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM02Concluido = "";
        $compradorM02Concluido = "";
        $vendedorM02Concluido = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM02Concluido")){
            $idM02Concluido = $this->session->userdata("idM02Concluido");
        }
        
        if ($this->session->userdata("compradorM02Concluido")){
            $compradorM02Concluido = $this->session->userdata("compradorM02Concluido");
        }
        
        if ($this->session->userdata("vendedorM02Concluido")){
            $vendedorM02Concluido = $this->session->userdata("vendedorM02Concluido");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_concluido/pagina/";
        $conta = $this->Formm02_model->getTotal(2, $idM02Concluido, $compradorM02Concluido, $vendedorM02Concluido);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_concluido";

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
            "concluidos" => $this->Formm02_model->getConcluido($idM02Concluido, $compradorM02Concluido, $vendedorM02Concluido, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        $this->load->helper('form'); 
        
        //$this->load->view("layouts/header", $data1);
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_concluido",$data);
        $this->load->view("layouts/footer");
    }
    
    public function motivos($id){
        $controlSession = $this->Formm02_model->controlSession();
        
        $data = array( 
               'bitacoras'=>$this->Formm02_model->getBitacoras1($id),
        );    
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idM02Concluido');
        $this->session->unset_userdata('compradorM02Concluido');
        $this->session->unset_userdata('vendedorM02Concluido');
        redirect(base_url()."C_concluido");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idM02Concluido = $this->input->post("idM02Concluido");
        $compradorM02Concluido = $this->input->post("compradorM02Concluido");
        $vendedorM02Concluido = $this->input->post("vendedorM02Concluido");
        
        $idM02Concluido = trim($idM02Concluido);
        $compradorM02Concluido = strtoupper(trim($compradorM02Concluido));
        $vendedorM02Concluido = strtoupper(trim($vendedorM02Concluido));
        
        if(is_numeric($idM02Concluido) == false){ $idM02Concluido = 0; }
        
        $this->session->set_userdata("idM02Concluido", $idM02Concluido);
        $this->session->set_userdata("compradorM02Concluido", $compradorM02Concluido);
        $this->session->set_userdata("vendedorM02Concluido", $vendedorM02Concluido);
        
        redirect(base_url()."C_concluido");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        $codigo = $this->Formm02_model->getCodigo($id);
        
        $sql = "select ef.descripcion estado ";
        $sql .= "from formm02 f ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where f.id = ".$id."; ";
        $estado = $this->Formm02_model->getDatosTabla($sql, "estado");
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$codigo,
           'estados'=>$estado,
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
        //$this->load->view("layouts/header", $data1);
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_formm02_ver", $data);
        $this->load->view("layouts/footer");
    }
}

?>