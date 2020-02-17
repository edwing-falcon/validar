<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_recepcion3 extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idM03Recepcion = "";
        $M03CodigoRecepcion = "";
        $exportadorM03Recepcion = "";
        $compradorM03Recepcion = "";
        $fronteraM03Recepcion = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idM03Recepcion")){
            $idM03Recepcion = $this->session->userdata("idM03Recepcion");
        }
        
        if ($this->session->userdata("M03CodigoRecepcion")){
            $M03CodigoRecepcion = $this->session->userdata("M03CodigoRecepcion");
        }
        
        if ($this->session->userdata("exportadorM03Recepcion")){
            $exportadorM03Recepcion = $this->session->userdata("exportadorM03Recepcion");
        }
        
        if ($this->session->userdata("compradorM03Recepcion")){
            $compradorM03Recepcion = $this->session->userdata("compradorM03Recepcion");
        }
        
        if ($this->session->userdata("fronteraM03Recepcion")){
            $fronteraM03Recepcion = $this->session->userdata("fronteraM03Recepcion");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_recepcion3/pagina/";
        $conta = $this->Formm03_model->getTotal(1, $idM03Recepcion, $M03CodigoRecepcion, $exportadorM03Recepcion, $compradorM03Recepcion, $fronteraM03Recepcion);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_recepcion3";

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
            "recepciones" => $this->Formm03_model->getRecepcion3($idM03Recepcion, $M03CodigoRecepcion, $exportadorM03Recepcion, $compradorM03Recepcion, $fronteraM03Recepcion, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_recepcion3",$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idM03Recepcion');
        $this->session->unset_userdata('M03CodigoRecepcion');
        $this->session->unset_userdata('exportadorM03Recepcion');
        $this->session->unset_userdata('compradorM03Recepcion');
        $this->session->unset_userdata('fronteraM03Recepcion');
        redirect(base_url()."C_recepcion3");
    }

    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idM03Recepcion = $this->input->post("idM03Recepcion");
        $M03CodigoRecepcion = $this->input->post("M03CodigoRecepcion");
        $exportadorM03Recepcion = $this->input->post("exportadorM03Recepcion");
        $compradorM03Recepcion = $this->input->post("compradorM03Recepcion");
        $fronteraM03Recepcion = $this->input->post("fronteraM03Recepcion");
        
        $idM03Recepcion = trim($idM03Recepcion);
        $M03CodigoRecepcion = trim($M03CodigoRecepcion);
        $exportadorM03Recepcion = strtoupper(trim($exportadorM03Recepcion));
        $compradorM03Recepcion = strtoupper(trim($compradorM03Recepcion));
        $fronteraM03Recepcion = strtoupper(trim($fronteraM03Recepcion));
        
        if(is_numeric($idM03Recepcion) == false){ $idM03Recepcion = 0; }
        
        $this->session->set_userdata("idM03Recepcion", $idM03Recepcion);
        $this->session->set_userdata("M03CodigoRecepcion", $M03CodigoRecepcion);
        $this->session->set_userdata("exportadorM03Recepcion", $exportadorM03Recepcion);
        $this->session->set_userdata("compradorM03Recepcion", $compradorM03Recepcion);
        $this->session->set_userdata("fronteraM03Recepcion", $fronteraM03Recepcion);
        
        redirect(base_url()."C_recepcion3");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function ver($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $codigo = $this->Formm03_model->getCodigo($id);
        
        $data = array( 
           'ids'=>$id, 
           'codigos'=>$codigo, 
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
        
        $this->db->where('idformm03', $id); 
        $this->db->delete('relacionadorm03m02'); 
        
        $this->session->unset_userdata('error');
        $this->session->unset_userdata('idformm02');
        $this->session->unset_userdata('obs');
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_recepcion3_validar", $data);
        $this->load->view("layouts/footer");   
    }
    
    public function guardar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $verificar = $this->input->post("btn");
        $rechazos = $this->input->post("rechazos");
        $obsmal = $this->input->post("obsmal");
        $idformm03 = $this->input->post("idformm03");
        $obsval = $this->input->post("obsval");
        $this->session->unset_userdata('error');
        
        $usuario =  $this->session->userdata("usuario");
        $idusuario = $this->session->userdata("id");
        $lugar = $this->session->userdata("lugar");
        $fechavalidacion = $this->Formm03_model->getFechaActual();
        
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
        $idlugar = $this->Formm03_model->getDato($sql, "id", "int");
        
        $rec = "";
        for ($i=0;$i<count($rechazos);$i++){
            $rec .= $rechazos[$i]." ";
        } 
        
        $sw = true;
        if($verificar == 'Rechazado' && strlen($rec) == 0){
            $sw = false;
            $this->session->set_userdata("error", "El M-03 con ID: ".$idformm03." no fue RECHAZADO por que no introdujo un motivo de rechazo");
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/ver/".$cad);
        }
        
        /*if($verificar == 'Validado' && strlen($obsval) == 0){
            $sw = false;
            $this->session->set_userdata("error", "El M-03 con ID: ".$idformm03." no fue VALIDADO por que no introdujo un motivo de validacion");
            redirect(base_url()."C_recepcion3");
        }*/
        
        if($sw == true){
            if($verificar == 'Validado'){
                
                // Codigo muestra
                $sql = "select substring(codigoenviomuestra, 13, 4) as num, codigoenviomuestra ";
                $sql .= "from formm03 f ";
                $sql .= "join formm03calculorm fc on fc.idformm03 = f.id ";
                $sql .= "where f.id > 0 ";
                $sql .= "and f.estado = 2 ";
                $sql .= "and f.oficinavalidacion = '".$lugar."' ";
                $sql .= "and fc.idmineral in ( select idmineral from cri_mineral ) ";
                $sql .= "order by f.id desc ";
                $sql .= "limit 1 ";
                $num = $this->Formm02_model->getDatosTabla($sql, "num");
                $num = trim($num);
                
                if(strlen($num) > 0){
                    $num = $num + 1;
                    if(strlen($num) == 1) { $num1 = "000".$num; }
                    if(strlen($num) == 2) { $num1 = "00".$num; }
                    if(strlen($num) == 3) { $num1 = "0".$num; }

                    if($lugar == "CHUQUISACA") { $abreviacion = "CH"; }
                    if($lugar == "LA PAZ") { $abreviacion = "LP"; }
                    if($lugar == "COCHABAMBA") { $abreviacion = "CB"; }
                    if($lugar == "ORURO") { $abreviacion = "OR"; }
                    if($lugar == "POTOSI") { $abreviacion = "PT"; }
                    if($lugar == "TARIJA") { $abreviacion = "TJ"; }
                    if($lugar == "SANTA CRUZ") { $abreviacion = "SC"; }
                    if($lugar == "BENI") { $abreviacion = "BE"; }
                    if($lugar == "PANDO") { $abreviacion = "PA"; }
                     
                    $sql = " ";
                    $codigoenviomuestra = "";
                } else {
                    $codigoenviomuestra = "";
                    $codigomuestra = "";
                }
                
                
                $data = array( 
                    
                    'codigovalidador'=>$usuario,
                    'fechavalidacion'=>$fechavalidacion, 
                    'estado'=>2,
                    'observaciones'=>$obsval
                ); 
                //$this->session->set_userdata("idM03Concluido", $idformm03);
                $this->session->unset_userdata('idM03Concluido');
                $this->session->unset_userdata('M03CodigoConcluido');
                $this->session->unset_userdata('exportadorM03Concluido');
                $this->session->unset_userdata('compradorM03Concluido');
                $this->session->unset_userdata('fronteraM03Concluido');
                
                $this->session->unset_userdata('idM03Recepcion');
                $this->session->unset_userdata('M03CodigoRecepcion');
                $this->session->unset_userdata('exportadorM03Recepcion');
                $this->session->unset_userdata('compradorM03Recepcion');
                $this->session->unset_userdata('fronteraM03Recepcion');
                
                $this->db->where('id', $idformm03); 
                $this->db->update('formm03', $data); 
                redirect(base_url()."C_recepcion3");
            } else {
                $data = array( 
                    'codigovalidador'=>$usuario,
                    'fechavalidacion'=>$fechavalidacion, 
                    'estado'=>10
                );
                //$this->session->set_userdata("idM03Rechazado", $idformm03);
                $this->session->unset_userdata('idM03Rechazado');
                $this->session->unset_userdata('M03CodigoRechazado');
                $this->session->unset_userdata('exportadorM03Rechazado');
                $this->session->unset_userdata('compradorM03Rechazado');
                $this->session->unset_userdata('fronteraM03Rechazado');
        
                $this->db->where('id', $idformm03); 
                $this->db->update('formm03', $data);

                $idbitacorarechazo = $this->Formm03_model->getMayor('bitacorarechazo', 'id');
                $fechaactual = $this->Formm03_model->getFechaActual();

                $data = array ( 
                    'id'=>$idbitacorarechazo,
                    'idformm03'=>$idformm03, 
                    'fecha'=>$fechaactual,
                    'obsmal'=>$obsmal,
                    'idusuario'=>$idusuario,
                    'idlugar'=>$idlugar
                );

                $this->db->insert('bitacorarechazo', $data);
                
                $sql = "update motivo set estado = 0 where idbitacorarechazo in ( select id from bitacorarechazo where idformm03 = ".$idformm03." ); ";
                $query = $this->db->query($sql);
                
                for ($i=0; $i<count($rechazos); $i++){
                    $idmotivo = $this->Formm03_model->getMayor('motivo', 'id');

                    $idrechazo = $rechazos[$i];
                    $data = array ( 
                        'id'=>$idmotivo,
                        'idbitacorarechazo'=>$idbitacorarechazo, 
                        'idrechazo'=>$idrechazo,
                        'estado'=>1
                    );
                    $this->db->insert('motivo', $data);
                }
                $this->session->unset_userdata('idM03Recepcion');
                $this->session->unset_userdata('M03CodigoRecepcion');
                $this->session->unset_userdata('exportadorM03Recepcion');
                $this->session->unset_userdata('compradorM03Recepcion');
                $this->session->unset_userdata('fronteraM03Recepcion');
                redirect(base_url()."C_recepcion3");
            }
            //redirect(base_url());
        }
    }
    
    public function eliminarFormm03($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $id = trim($id);
        
        $sql = "select idformm03 from relacionadorm03m02 where id = ".$id."; ";
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        
        $this->db->where('id', $id); 
        $this->db->delete('relacionadorm03m02'); 
        
        redirect(base_url()."C_recepcion3/relacionadorM03M02/".$idformm03);
    }
    
    public function relacionadorM03M02($idformm03){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = trim($idformm03);
        
        $data = array( 
            'relacionadors'=>$this->Formm03_model->getRelacionadorM03M02($idformm03)
        );
        $this->load->view("formm03/V_relacionadorM03M02_tabla", $data);
    }
    
    public function relacionadorM03M02_1($id){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($id);
        
        $this->db->where('id', $id); 
        $this->db->delete('relacionadorm03m02'); 
        
        /*$sql = "select idformm03 from relacionadorm03m02 where id = ".$id."; ";
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        
        $data = array( 
            'relacionadors'=>$this->Formm03_model->getRelacionadorM03M02($idformm03)
        );
        $this->load->view("formm03/V_relacionadorM03M02_tabla", $data);*/
    }
    
    public function relacionadorm03m02_ver($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = trim($this->Formm03_model->desemcriptar($entrada));
        $idformm03 = trim($idformm03);
        
        $data = array(
            'idformm03s'=>$idformm03,
            'relacionadors'=>$this->Formm03_model->getRelacionadorM03M02($idformm03)
        );
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("formm03/V_relacionadorM03M02_tabla", $data);
        $this->load->view("layouts/footer"); 
    }
    
    public function delete_relacionadorm03m02($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $id = trim($id);
        
        $sql = "select idformm03 from relacionadorm03m02 where id = ".$id."; ";
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        
        $this->db->where('id', $id); 
        $this->db->delete('relacionadorm03m02'); 
        
        $aux = "id=".$id."<br/>";
        $aux .= "idformm03=".$idformm03."<br/>";
        $this->output->set_output($aux);
        
        $var = $this->Formm03_model->encriptar($idformm03);
        redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
    }
    
    public function buscarM02(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $btn = $this->input->post("btn");
        $idformm03 = $this->input->post("idformm03");
        $idformm02 = $this->input->post("idformm02");
        $obs = $this->input->post("obs");
        
        $idformm03 = trim($idformm03);
        $idformm02 = trim($idformm02);
        $obs = trim($obs);
                
        $this->session->unset_userdata('error');
        
        if($btn == "cadena"){
            $sql = "select count(*) t from relacionadorm03m02 where idformm02 = 0 and idformm03 = ".$idformm03.";";
            $aux = $this->Formm03_model->getDatosTabla($sql, "t");
            $aux = trim($aux);
        
            if($aux > 0){ 
                $this->session->set_userdata("error", "El ID M-02: 0 ya fue agregado en la relacion actual");
                $var = $this->Formm03_model->encriptar($idformm03);
                redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
            }
            
            $data = array ( 
                'id'=>$this->Formm03_model->getMayor('relacionadorm03m02', 'id'),
                'idformm02'=>0, 
                'idformm03'=>$idformm03,
                'obs'=>"Tiene toda la cadena productiva"
            ); 
            $this->db->insert('relacionadorm03m02', $data);

            $this->session->unset_userdata('error');
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        }
        
        if(is_numeric($idformm02) == false){ 
            $this->session->set_userdata("error", "El M-02: ".$idformm02." no es valido");
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        }
        
        if(strlen($obs) > 255){ 
            $this->session->set_userdata("error", "La observacion solo permite 255 caracteres alfanumericos");
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        }
        
        $sql = "select count(*) t from formm02 where id = ".$idformm02.";";
        $aux = $this->Formm03_model->getDatosTabla($sql, "t");
        $aux = trim($aux);
        
        if($aux == 0){ 
            $this->session->set_userdata("error", "El ID M-02: ".$idformm02." no existe en la base de datos");
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        }
        
        $sql = "select count(*) t from relacionadorm03m02 where idformm02 = ".$idformm02." and idformm03 = ".$idformm03.";";
        $aux = $this->Formm03_model->getDatosTabla($sql, "t");
        $aux = trim($aux);
        
        if($aux > 0){ 
            $this->session->set_userdata("error", "El ID M-02: ".$idformm02." ya fue agregado en la relacion actual");
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        }
        
        $data = array ( 
            'id'=>$this->Formm03_model->getMayor('relacionadorm03m02', 'id'),
            'idformm02'=>$idformm02, 
            'idformm03'=>$idformm03,
            'obs'=>$obs
        ); 
        $this->db->insert('relacionadorm03m02', $data);
        
        $this->session->unset_userdata('error');
        $var = $this->Formm03_model->encriptar($idformm03);
        redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
    }
    
    public function editar_relacionadorm03m02($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        $id = trim($id);
        
        $sql = "select idformm03, idformm02, obs from relacionadorm03m02 where id = ".$id."; ";
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $idformm02 = $this->Formm03_model->getDatosTabla($sql, "idformm02");
        $obs = $this->Formm03_model->getDatosTabla($sql, "obs");
        
        $this->session->set_userdata("idformm02", $idformm02);
        $this->session->set_userdata("obs", $obs);
        
        $this->session->unset_userdata('error');
        $var = $this->Formm03_model->encriptar($idformm03);
        redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
    }
    
    public function validar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $btn = $this->input->post("btn");
        $idformm03 = $this->input->post("idformm03");
        $idformm03 = trim($idformm03);
        
        $usuario =  $this->session->userdata("usuario");
        $idusuario = $this->session->userdata("id");
        $lugar = $this->session->userdata("lugar");
        $fechavalidacion = $this->Formm03_model->getFechaActual();
        
        if($btn == "cancelar"){
            $this->db->where('idformm03', $idformm03); 
            $this->db->delete('relacionadorm03m02'); 

            $this->session->unset_userdata('error');
            $this->session->unset_userdata('idformm02');
            $this->session->unset_userdata('obs');
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3");
        }
        
        $sql = "select count(*) conta from relacionadorm03m02 where idformm03 = ".$idformm03."; ";
        $conta = $this->Formm03_model->getDatosTabla($sql, "conta");
        $conta = trim($conta);
        if($conta == 0){
            $this->session->set_userdata("error", "Debe a&ntildeadir un M-02");
            $var = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_recepcion3/relacionadorm03m02_ver/".$var);
        } else {
            $sql = "select id from lugarnim where descripcion = '".$lugar."'; ";
            $idlugar = $this->Formm03_model->getDato($sql, "id", "int");

            $data = array( 
                'codigovalidador'=>$usuario,
                'fechavalidacion'=>$fechavalidacion, 
                'estado'=>2
            );
            $this->db->where('id', $idformm03); 
            $this->db->update('formm03', $data);

            $this->session->unset_userdata('idM03Concluido');
            $this->session->unset_userdata('M03CodigoConcluido');
            $this->session->unset_userdata('exportadorM03Concluido');
            $this->session->unset_userdata('compradorM03Concluido');
            $this->session->unset_userdata('fronteraM03Concluido');

            $this->session->unset_userdata('idM03Recepcion');
            $this->session->unset_userdata('M03CodigoRecepcion');
            $this->session->unset_userdata('exportadorM03Recepcion');
            $this->session->unset_userdata('compradorM03Recepcion');
            $this->session->unset_userdata('fronteraM03Recepcion');

            redirect(base_url()."C_recepcion3");
        }
        
    }
}

?>