<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_reliquidadoReliquidacion extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idReliquidadoReliquidacion = "";
        $codigoReliquidadoReliquidacion = "";
        $exportadorReliquidadoReliquidacion = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idReliquidadoReliquidacion")){
            $idReliquidadoReliquidacion = $this->session->userdata("idReliquidadoReliquidacion");
        }
        
        if ($this->session->userdata("codigoReliquidadoReliquidacion")){
            $codigoReliquidadoReliquidacion = $this->session->userdata("codigoReliquidadoReliquidacion");
        }
        
        if ($this->session->userdata("exportadorReliquidadoReliquidacion")){
            $exportadorReliquidadoReliquidacion = $this->session->userdata("exportadorReliquidadoReliquidacion");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_reliquidadoReliquidacion/pagina/";
        $conta = $this->Formm03_model->getTotalReliquidadoReliquidacion($idReliquidadoReliquidacion, $codigoReliquidadoReliquidacion, $exportadorReliquidadoReliquidacion);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_reliquidadoReliquidacion";

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
            "reliquidadoreliquidaciones" => $this->Formm03_model->getReliquidadoReliquidacion($idReliquidadoReliquidacion, $codigoReliquidadoReliquidacion, $exportadorReliquidadoReliquidacion, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidadoReliquidacion",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idReliquidadoReliquidacion');
        $this->session->unset_userdata('codigoReliquidadoReliquidacion');
        $this->session->unset_userdata('exportadorReliquidadoReliquidacion');
        redirect(base_url()."C_reliquidadoReliquidacion");
    }

    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idReliquidadoReliquidacion = $this->input->post("idReliquidadoReliquidacion");
        $codigoReliquidadoReliquidacion = $this->input->post("codigoReliquidadoReliquidacion");
        $exportadorReliquidadoReliquidacion = $this->input->post("exportadorReliquidadoReliquidacion");
        
        $idReliquidadoReliquidacion = trim($idReliquidadoReliquidacion);
        $codigoReliquidadoReliquidacion = strtoupper(trim($codigoReliquidadoReliquidacion));
        $exportadorReliquidadoReliquidacion = strtoupper(trim($exportadorReliquidadoReliquidacion));
        
        if(is_numeric($idReliquidadoReliquidacion) == false){ $idReliquidadoReliquidacion = 0; }
        
        $this->session->set_userdata("idReliquidadoReliquidacion", $idReliquidadoReliquidacion);
        $this->session->set_userdata("codigoReliquidadoReliquidacion", $codigoReliquidadoReliquidacion);
        $this->session->set_userdata("exportadorReliquidadoReliquidacion", $exportadorReliquidadoReliquidacion);
        redirect(base_url()."C_reliquidadoReliquidacion");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function editarPago($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idreliquidacionM03 = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select id, idformm03, nrodepositopago, fechadepositopago ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where id = ".$idreliquidacionM03."; ";
        
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $nrodepositopago = $this->Formm03_model->getDatosTabla($sql, "nrodepositopago");
        $fechadepositopago = $this->Formm03_model->getDatosTabla($sql, "fechadepositopago");
        
        if ($this->session->userdata("fechadepositopago")){
            $fechadepositopago = $this->session->userdata("fechadepositopago");
        } else {
            $fechadepositopago = $this->Formm03_model->getDatosTabla($sql, "fechadepositopago");
        }
        
        $sql = "select identidadfinanciera, ef.descripcion as entidadfinanciera, nrocuenta ";
        $sql .= "from reliquidacion03cuentas r ";
        $sql .= "join entidadfinanciera ef on ef.id = r.identidadfinanciera ";
        $sql .= "where r.descripcion = 'RELIQUIDACION' ";
        $sql .= "and r.estado = 1; ";
        $identidadfinancierapago = $this->Formm03_model->getDatosTabla($sql, "identidadfinanciera");
        $entidadfinancierapago = $this->Formm03_model->getDatosTabla($sql, "entidadfinanciera");
        $nrocuentapago = $this->Formm03_model->getDatosTabla($sql, "nrocuenta");
                
        $data = array( 
           'idformm03s'=>$idformm03,
           'idreliquidacionM03s'=>$idreliquidacionM03, 
           'identidadfinancierapagos'=>$identidadfinancierapago,
           'entidadfinancierapagos'=>$entidadfinancierapago, 
           'nrocuentapagos'=>$nrocuentapago,
           'nrodepositopagos'=>$nrodepositopago, 
           'fechadepositopagos'=>$fechadepositopago, 
           'fechaActuals' =>$this->Formm03_model->getFechaActual() 
        );
        
        $this->session->unset_userdata('fechadepositopago');
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidadoReliquidacion_editarPago", $data);
        $this->load->view("layouts/footer");
    }
    
    public function guardar_pagoReliquidacion(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->input->post("idformm03");
        $idreliquidacionM03 = $this->input->post("idreliquidacionM03");
        $identidadfinancierapago = $this->input->post("identidadfinancierapago");
        $fechadepositopago = $this->input->post("fechadepositopago"); 
        $nrodepositopago = $this->input->post("nrodepositopago"); 
        $operacion = $this->input->post("btn");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            redirect(base_url()."C_reliquidadoReliquidacion");
        }
        
        if($fechadepositopago == null){
            $this->session->set_userdata("error", "La fecha de deposito no debe ser null");
            $cad = $this->Formm03_model->encriptar($idreliquidacionM03);
            redirect(base_url()."C_muestreoReliquidacion/editarPago/".$cad);
        }
        
        if($nrodepositopago == null){
            $this->session->set_userdata("error", "El n&uacutemero de deposito no debe ser null");
            $cad = $this->Formm03_model->encriptar($idreliquidacionM03);
            redirect(base_url()."C_muestreoReliquidacion/editarPago/".$cad);
        }
        
        if($operacion == "aceptar"){
            $data = array( 
                'nrodepositopago'=>$nrodepositopago,
                'fechadepositopago'=>$fechadepositopago
            ); 
            $this->db->where('id', $idreliquidacionM03); 
            $this->db->update('reliquidacion03', $data);

            redirect(base_url()."C_reliquidadoReliquidacion");
        }
        redirect(base_url()."C_muestreoReliquidacion");
    }
}

?>