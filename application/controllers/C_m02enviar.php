<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_m02enviar extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
        
    public function index($nropagina = FALSE){
/*        $inicio = 0;
        $mostrarpor = 10; 
        $idM02recepcion = "";
        $compradorM02Recepcion = "";
        $vendedorM02Recepcion = "";
        */
       /* $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM02recepcion")){
            $idM02recepcion = $this->session->userdata("idM02recepcion");
        }
        
        if ($this->session->userdata("compradorM02Recepcion")){
            $compradorM02Recepcion = $this->session->userdata("compradorM02Recepcion");
        }
        
        if ($this->session->userdata("vendedorM02Recepcion")){
            $vendedorM02Recepcion = $this->session->userdata("vendedorM02Recepcion");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }*/
        
/*        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_recepcion/pagina/";
        $conta = 10;

        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_recepcion";

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
        $this->pagination->initialize($config); */
        //$compra=2071;
        $compra=295;

        $data = array(
            "recepciones" => $this->Formm02_model->getenvio($compra),
        );
        
/*        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        
        //$this->load->helper('form'); 
        
        //$this->load->view("layouts/header", $data1);
        //$this->load->view("layouts/header3");
       // $this->load->view("layouts/aside");
        $this->load->view("formm02/V_formm02__enviar",$data);
        //$this->load->view("layouts/footer");
    }
    

    //*****************************

    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idM02recepcion');
        $this->session->unset_userdata('compradorM02Recepcion');
        $this->session->unset_userdata('vendedorM02Recepcion');
        redirect(base_url()."C_recepcion");
    }

    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idM02recepcion = $this->input->post("idM02recepcion");
        $compradorM02Recepcion = $this->input->post("compradorM02Recepcion");
        $vendedorM02Recepcion = $this->input->post("vendedorM02Recepcion");
        
        $idM02recepcion = trim($idM02recepcion);
        $compradorM02Recepcion = strtoupper(trim($compradorM02Recepcion));
        $vendedorM02Recepcion = strtoupper(trim($vendedorM02Recepcion));
        
        if(is_numeric($idM02recepcion) == false){ $idM02recepcion = 0; }
        
        $this->session->set_userdata("idM02recepcion", $idM02recepcion);
        $this->session->set_userdata("compradorM02Recepcion", $compradorM02Recepcion);
        $this->session->set_userdata("vendedorM02Recepcion", $vendedorM02Recepcion);
        
        redirect(base_url()."C_recepcion");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function verMotivo($idbitacora){
        $controlSession = $this->Formm02_model->controlSession();
        
        $bitacora = array( 
           'motivos'=>$this->Formm02_model->getMotivos($idbitacora)
        );
        $this->load->view("formm02/V_recepcion_validar", $bitacora);
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm02_model->controlSession();
        
        $id = trim($this->Formm02_model->desemcriptar($entrada));
        $codigo = $this->Formm02_model->getCodigo($id);
        
        $fechaactual = $this->Formm02_model->getFechaActual();
        
        $data = array(
           'ids'=>$id, 
           'codigos'=>$codigo, 
           'formm02'=>$this->Formm02_model->getDatosTransaccion("formm02", $id),
           'formm02regalias'=>$this->Formm02_model->getDatosRegalia($id),
           'formm02totalesregalia'=>$this->Formm02_model->getTotalRegaliaMinera($id),
           'formm02aportedepartamental'=>$this->Formm02_model->getAporteDepartamental($id),
           'formm02totalaportedepartamental'=>$this->Formm02_model->getTotalAporteDepartamental($id),
           'formm02aporte'=>$this->Formm02_model->getFormm02Aporte($id),
           'formm02totalimporte'=>$this->Formm02_model->getTotalImporte($id), 
           'bitacoras'=>$this->Formm02_model->getBitacoras2($id),
           'rechazos'=>$this->Formm02_model->getRechazos() 
        ); 
          
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_recepcion_validar", $data);
        $this->load->view("layouts/footer");
    }
    
    public function guardar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $verificar = $this->input->post("btn");
        $rechazos = $this->input->post("rechazos");
        $obsmal = $this->input->post("obsmal");
        $idform = $this->input->post("idform");
        $obsval = $this->input->post("obsval");
        $this->session->unset_userdata('error');
        
        $obsmal = trim($obsmal);
        $obsval = trim($obsval);
        
        $usuario =  $this->session->userdata("usuario");
        $idusuario = $this->session->userdata("id");
        $lugar = $this->session->userdata("lugar");
        $fechavalidacion = $this->Formm02_model->getFechaActual();
        
        // Controlar si se perdio la session
        $usuario = trim($usuario);
        $idusuario = trim($idusuario);
        $lugar = trim($lugar);
        if(strlen($usuario) == 0){
            $this->session->unset_userdata('usuario');
            $this->session->unset_userdata('id');
            $this->session->unset_userdata('lugar');
            $this->session->sess_destroy();
            $this->session->set_flashdata("error", "Se borro la session");
            redirect(base_url());
        }
        
        $sql = "select id from lugarnim where descripcion = '".$lugar."'; ";
        $idlugar = $this->Formm02_model->getDato($sql, "id", "int");
        
        $rec = "";
        for ($i=0;$i<count($rechazos);$i++){
            $rec .= $rechazos[$i]." ";
        } 
        
        $sw = true;
        if($verificar == 'Rechazado' && strlen($rec) == 0){
            $sw = false;
            $this->session->set_userdata("error", "El M-02 con ID: ".$idform." no fue RECHAZADO por que no introdujo un motivo de rechazo");
            $cad = $this->Formm02_model->encriptar($idform);
            redirect(base_url()."C_recepcion/ver/".$cad);
        }
        
        /*if($verificar == 'Validado' && strlen($obsval) == 0){
            $sw = false;
            $this->session->set_userdata("error", "El M-02 con ID: ".$idform." no fue VALIDADO por que no introdujo un motivo de validacion");
            redirect(base_url()."C_recepcion");
        }*/
        
        if($sw == true){
            if($verificar == 'Validado'){
                $data = array( 
                    //'oficinavalidacion'=>$lugar,
                    'codigovalidador'=>$usuario,
                    'fechavalidacion'=>$fechavalidacion, 
                    'estado'=>2,
                    'observaciones'=>$obsval
                ); 
                //$this->session->set_userdata("idM02Concluido", $idform);
                $this->session->unset_userdata('idM02Concluido');
                $this->session->unset_userdata('compradorM02Concluido');
                $this->session->unset_userdata('vendedorM02Concluido');
                
                $this->session->unset_userdata('idM02recepcion');
                $this->session->unset_userdata('compradorM02Recepcion');
                $this->session->unset_userdata('vendedorM02Recepcion');
        
                $this->db->where('id', $idform); 
                $this->db->update('formm02', $data); 
                redirect(base_url()."C_recepcion");
            } else {
                $data = array( 
                    'codigovalidador'=>$usuario,
                    'fechavalidacion'=>$fechavalidacion, 
                    'estado'=>10
                ); 
                //$this->session->set_userdata("idM02Rechazado", $idform);
                $this->session->unset_userdata('idM02Rechazado');
                $this->session->unset_userdata('compradorM02Rechazado');
                $this->session->unset_userdata('vendedorM02Rechazado');
                $this->db->where('id', $idform); 
                $this->db->update('formm02', $data);

                $idbitacorarechazo = $this->Formm02_model->getMayor('bitacorarechazo', 'id');
                $fechaactual = $this->Formm02_model->getFechaActual();

                $data = array ( 
                    'id'=>$idbitacorarechazo,
                    'idformm02'=>$idform, 
                    'fecha'=>$fechaactual,
                    'obsmal'=>$obsmal,
                    'idusuario'=>$idusuario,
                    'idlugar'=>$idlugar
                );

                $this->db->insert('bitacorarechazo', $data);

                $sql = "update motivo set estado = 0 where idbitacorarechazo in ( select id from bitacorarechazo where idformm02 = ".$idform." ); ";
                $query = $this->db->query($sql);
                
                for ($i=0; $i<count($rechazos); $i++){
                    $idmotivo = $this->Formm02_model->getMayor('motivo', 'id');

                    $idrechazo = $rechazos[$i];
                    $data = array ( 
                        'id'=>$idmotivo,
                        'idbitacorarechazo'=>$idbitacorarechazo, 
                        'idrechazo'=>$idrechazo,
                        'estado'=>1
                    );
                    $this->db->insert('motivo', $data);
                }
                $this->session->unset_userdata('idM02recepcion');
                $this->session->unset_userdata('compradorM02Recepcion');
                $this->session->unset_userdata('vendedorM02Recepcion');
                redirect(base_url()."C_recepcion");
            }
        }
    }
    
}

?>