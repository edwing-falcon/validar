<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reportesGralM02 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
     public function index(){
        $inicio = 0;
        $mostrarpor = 10;
        $anio = "";
        $mesini = "";
        $mesfin = ""; 
        $departamento = "";
        $estado = "";
        $tipo = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
                
        if ($this->session->userdata("anio")){
            $anio =  $this->session->userdata("anio");
        }
        
        if ($this->session->userdata("mesini")){
            $mesini =  $this->session->userdata("mesini");
        }
        
        if ($this->session->userdata("mesfin")){
            $mesfin =  $this->session->userdata("mesfin");
        }
        
        if ($this->session->userdata("departamento")){
            $departamento =  $this->session->userdata("departamento");
        }
        
        if ($this->session->userdata("estado")){
            $estado =  $this->session->userdata("estado");
        }
        
        if ($this->session->userdata("tipo")){
            $tipo =  $this->session->userdata("tipo");
        }
        
        //$this->load->library('pagination');
        //$config['base_url'] = base_url()."C_rep_gral/pagina/";
        
        /*$config['total_rows'] = count($this->Formm02_model->buscar_gral($anio, $mesini, $mesfin, $departamento, $estado, $tipo));
        $cant = count($this->Formm02_model->buscar_gral($anio, $mesini, $mesfin, $departamento, $estado, $tipo));
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_rep_gral";

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
        $this->pagination->initialize($config);*/
        
        /*$data = array(
            "anios" => $this->Formm02_model->getAnio(),
            "datos" => $this->Formm02_model->buscar_gral($anio, $mesini, $mesfin, $departamento, $estado, $tipo, $inicio, $mostrarpor),
            "cants" => $cant
        );
        */
        
        $data = array(
            'anios' => $this->Formm02_model->getAnio(),
            //"datos" => $this->Formm02_model->buscar_gral($anio, $mesini, $mesfin, $departamento, $estado, $tipo, $inicio, $mostrarpor),
        );
        
        $data1 = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->helper('form'); 
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('formm02/V_reporteGralM02');
        $this->load->view("layouts/footer");
        
        $this->session->unset_userdata('anio');
        $this->session->unset_userdata('mesini');
        $this->session->unset_userdata('mesfin');
        $this->session->unset_userdata('departamento');
        $this->session->unset_userdata('estado');
        $this->session->unset_userdata('tipo');
     }
}
?>