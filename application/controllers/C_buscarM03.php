<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_buscarM03 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM03Buscar = "";
        $codigoM03Buscar = "";
        $exportadorM03Buscar = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM03Buscar")){
            $idM03Buscar = $this->session->userdata("idM03Buscar");
        }
        
        if ($this->session->userdata("codigoM03Buscar")){
            $codigoM03Buscar = $this->session->userdata("codigoM03Buscar");
        }
        
        if ($this->session->userdata("exportadorM03Buscar")){
            $exportadorM03Buscar = $this->session->userdata("exportadorM03Buscar");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_buscarM03/pagina/";
        $conta = $this->Formm03_model->getTotalBuscar($idM03Buscar, $codigoM03Buscar, $exportadorM03Buscar);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_buscarM03";

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
            "buscados" => $this->Formm03_model->getFormm03Buscar($idM03Buscar, $codigoM03Buscar, $exportadorM03Buscar, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_buscarM03",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idM03Buscar');
        $this->session->unset_userdata('codigoM03Buscar');
        $this->session->unset_userdata('exportadorM03Buscar');
        
        redirect(base_url()."C_buscarM03");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idM03Buscar = $this->input->post("idM03Buscar");
        $codigoM03Buscar = $this->input->post("codigoM03Buscar");
        $exportadorM03Buscar = $this->input->post("exportadorM03Buscar");
        
        $idM03Buscar = trim($idM03Buscar);
        $codigoM03Buscar = trim($codigoM03Buscar);
        $exportadorM03Buscar = strtoupper(trim($exportadorM03Buscar));
        
        if(is_numeric($idM03Buscar) == false){ $idM03Buscar = 0; }
        
        $this->session->set_userdata("idM03Buscar", $idM03Buscar);
        $this->session->set_userdata("codigoM03Buscar", $codigoM03Buscar);
        $this->session->set_userdata("exportadorM03Buscar", $exportadorM03Buscar);
        
        redirect(base_url()."C_buscarM03");
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select codigoformm03, oficinavalidacion, ef.descripcion estado, case when f.estadorevision = 1 then 'SUJETO A REVISION' else '' end estadorevision ";
        $sql .= "from formm03 f ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where f.id = ".$id."; ";
        
        $data = array( 
           'ids'=>$id, 
           'codigos'=>$this->Formm03_model->getDatosTabla($sql, "codigoformm03"),
           'estados'=>$this->Formm03_model->getDatosTabla($sql, "estado"),
           'estadorevisions'=>$this->Formm03_model->getDatosTabla($sql, "estadorevision"),  
           'oficinavalidacions'=>$this->Formm03_model->getDatosTabla($sql, "oficinavalidacion"),
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