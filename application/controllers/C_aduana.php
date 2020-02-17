<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_aduana extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Aduana_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idAduana = "";
        $codigoAduana = "";
        $aduanaAduana = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idAduana")){
            $idAduana = $this->session->userdata("idAduana");
        }
        
        if ($this->session->userdata("codigoAduana")){
            $codigoAduana = $this->session->userdata("codigoAduana");
        }
        
        if ($this->session->userdata("aduanaAduana")){
            $aduanaAduana = $this->session->userdata("aduanaAduana");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_aduana/pagina/";
        $conta = $this->Aduana_model->getTotal($idAduana, $codigoAduana, $aduanaAduana);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_aduana";

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
            "aduanas" => $this->Aduana_model->getAduana($idAduana, $codigoAduana, $aduanaAduana, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_aduana',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idAduana');
        $this->session->unset_userdata('codigoAduana');
        $this->session->unset_userdata('aduanaAduana');
        redirect(base_url()."C_aduana");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idAduana = $this->input->post("idAduana");
        $codigoAduana = $this->input->post("codigoAduana");
        $aduanaAduana = $this->input->post("aduanaAduana");
        
        $idAduana = trim($idAduana);
        $codigoAduana = trim($codigoAduana);
        $aduanaAduana = strtoupper(trim($aduanaAduana));
        
        if(is_numeric($idAduana) == false){ $idAduana = 0; }
        
        $this->session->set_userdata("idAduana", $idAduana);
        $this->session->set_userdata("codigoAduana", $codigoAduana);
        $this->session->set_userdata("aduanaAduana", $aduanaAduana);
        
        redirect(base_url()."C_aduana");
    }
    
}

?>
