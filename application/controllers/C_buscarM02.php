<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_buscarM02 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM02Buscar = "";
        $codigoM02Buscar = "";
        $compradorM02Buscar = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM02Buscar")){
            $idM02Buscar = $this->session->userdata("idM02Buscar");
        }
        
        if ($this->session->userdata("codigoM02Buscar")){
            $codigoM02Buscar = $this->session->userdata("codigoM02Buscar");
        }
        
        if ($this->session->userdata("compradorM02Buscar")){
            $compradorM02Buscar = $this->session->userdata("compradorM02Buscar");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_buscarM02/pagina/";
        $conta = $this->Formm02_model->getTotalBuscar($idM02Buscar, $codigoM02Buscar, $compradorM02Buscar);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_buscarM02";

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
            "buscados" => $this->Formm02_model->getFormm02Buscar($idM02Buscar, $codigoM02Buscar, $compradorM02Buscar, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_buscarM02",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idM02Buscar');
        $this->session->unset_userdata('codigoM02Buscar');
        $this->session->unset_userdata('compradorM02Buscar');
        redirect(base_url()."C_buscarM02");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idM02Buscar = $this->input->post("idM02Buscar");
        $codigoM02Buscar = $this->input->post("codigoM02Buscar");
        $compradorM02Buscar = $this->input->post("compradorM02Buscar");
        
        $idM02Buscar = trim($idM02Buscar);
        $codigoM02Buscar = trim($codigoM02Buscar);
        $compradorM02Buscar = strtoupper(trim($compradorM02Buscar));
                
        if(is_numeric($idM02Buscar) == false){ $idM02Buscar = 0; }
        
        $this->session->set_userdata("idM02Buscar", $idM02Buscar);
        $this->session->set_userdata("codigoM02Buscar", $codigoM02Buscar);
        $this->session->set_userdata("compradorM02Buscar", $compradorM02Buscar);
        
        redirect(base_url()."C_buscarM02");
    }
   
    public function ver($entrada){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        
        $sql = "select codigoformm02, oficinavalidacion, ef.descripcion estado, case when f.estadorevision = 1 then 'SUJETO A REVISION' else '' end estadorevision ";
        $sql .= "from formm02 f ";
        $sql .= "join estadoformulario ef on ef.id = f.estado ";
        $sql .= "where f.id = ".$id."; ";
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$this->Formm02_model->getDatosTabla($sql, "codigoformm02"),
           'estados'=>$this->Formm02_model->getDatosTabla($sql, "estado"),
           'estadorevisions'=>$this->Formm02_model->getDatosTabla($sql, "estadorevision"), 
           'oficinavalidacions'=>$this->Formm02_model->getDatosTabla($sql, "oficinavalidacion"),
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
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_buscar_ver", $data);
        $this->load->view("layouts/footer");
    }
}

?>
