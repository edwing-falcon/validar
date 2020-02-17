<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_pendienteReliquidacion extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idPendienteReliquidacion = "";
        $codigoPendienteReliquidacion = "";
        $exportadorPendienteReliquidacion = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idPendienteReliquidacion")){
            $idPendienteReliquidacion = $this->session->userdata("idPendienteReliquidacion");
        }
        
        if ($this->session->userdata("codigoPendienteReliquidacion")){
            $codigoPendienteReliquidacion = $this->session->userdata("codigoPendienteReliquidacion");
        }
        
        if ($this->session->userdata("exportadorPendienteReliquidacion")){
            $exportadorPendienteReliquidacion = $this->session->userdata("exportadorPendienteReliquidacion");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_pendienteReliquidacion/pagina/";
        $conta = $this->Formm03_model->getTotalPendienteReliquidacion($idPendienteReliquidacion, $codigoPendienteReliquidacion, $exportadorPendienteReliquidacion);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_pendienteReliquidacion";

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
            "pendientesreliquidaciones" => $this->Formm03_model->getPendienteReliquidacion($idPendienteReliquidacion, $codigoPendienteReliquidacion, $exportadorPendienteReliquidacion, $inicio, $mostrarpor),
            "cants" => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_pendienteReliquidacion",$data);
        $this->load->view("layouts/footer");
        
        $this->session->unset_userdata('error');
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idPendienteReliquidacion');
        $this->session->unset_userdata('codigoPendienteReliquidacion');
        $this->session->unset_userdata('exportadorPendienteReliquidacion');
        redirect(base_url()."C_pendienteReliquidacion");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idPendienteReliquidacion = $this->input->post("idPendienteReliquidacion");
        $codigoPendienteReliquidacion = $this->input->post("codigoPendienteReliquidacion");
        $exportadorPendienteReliquidacion = $this->input->post("exportadorPendienteReliquidacion");
        
        $idPendienteReliquidacion = trim($idPendienteReliquidacion);
        $codigoPendienteReliquidacion = strtoupper(trim($codigoPendienteReliquidacion));
        $exportadorPendienteReliquidacion = strtoupper(trim($exportadorPendienteReliquidacion));
       
        if(is_numeric($idPendienteReliquidacion) == false){ $idPendienteReliquidacion = 0; }
        
        $this->session->set_userdata("idPendienteReliquidacion", $idPendienteReliquidacion);
        $this->session->set_userdata("codigoPendienteReliquidacion", $codigoPendienteReliquidacion);
        $this->session->set_userdata("exportadorPendienteReliquidacion", $exportadorPendienteReliquidacion);
        redirect(base_url()."C_pendienteReliquidacion");
    }
    
    public function cantidad(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->set_userdata("cantidad",$this->input->post("cantidad"));
    }
    
    public function cuadro_reliquidacion($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select lote, r.idformm03 idformm03, codigoformm03, o.nombre exportador, nim, o.id idoperador, direccion, telefono, r.fechaenviomuestra, r.codigoenviomuestra, r.citeenviomuestra, o.nombre as exportador, nim, numinformelaboratorio, fechainformelaboratorio, tiporeliquidacion ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.id = ".$id."; ";
            
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $idoperador = $this->Formm03_model->getDatosTabla($sql, "idoperador");
        $codigo = $this->Formm03_model->getDatosTabla($sql, "codigoformm03");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $nim = $this->Formm03_model->getDatosTabla($sql, "nim");
        $direccion = $this->Formm03_model->getDatosTabla($sql, "direccion");
        $telefono = $this->Formm03_model->getDatosTabla($sql, "telefono");
        $fechaEnvioMuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoEnvioMuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeEnvioMuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $tipoReliquidacion = $this->Formm03_model->getDatosTabla($sql, "tiporeliquidacion");
        $tipoReliquidacion = strtoupper($tipoReliquidacion); 
        $numInformeLaboratorio = $this->Formm03_model->getDatosTabla($sql, "numinformelaboratorio");
        $fechaInformeLaboratorio = $this->Formm03_model->getDatosTabla($sql, "fechainformelaboratorio");
        $mineralesReliquidados = $this->Formm03_model->getMineralesReliquidados($idformm03, $tipoReliquidacion);
        $FecActual = $this->Formm03_model->getFechaActual();
        $representantes = $this->Formm03_model->getRepresentanteLegal($idoperador);
        
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Franz Ibanez');
        $pdf->SetTitle('Notificacion de Envio de Muestra');
        $pdf->SetSubject('Envio Muestra');
        $pdf->SetKeywords('Notificacion, Envio, Muestra, test, guide');
        
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // ---------------------------------------------------------
        // Establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
        
        // Establecer el tipo de letra
 
        // Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        // $pdf->SetFont('freemono', '', 12, '', true);  //Original
        $pdf->SetFont('helvetica', '', 9, '', true);
           
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
        
        // Fijar efecto de sombra en el texto
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Preparamos y maquetamos el contenido a crear
        $html = '<strong><p style="text-align:center"><h3>CUADRO DE RELIQUIDACION M-03 POR: '.$tipoReliquidacion.'</h3></p></strong>';
        $html .= '<table border="1">';
        $html .= '  <thead>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: center" width="80">ID M-03:</th>';
        $html .= '          <th style="text-align: center" width="100" bgcolor="E5E0E0"><strong>'.$idformm03.'</strong></th>';
        $html .= '          <th style="text-align: center" width="90">CODIGO:</th>';
        $html .= '          <th style="text-align: center" width="140" bgcolor="E5E0E0"><strong>'.$codigo.'</strong></th>';
        $html .= '          <th style="text-align: center" width="80">LOTE:</th>';
        $html .= '          <th style="text-align: center" width="140" bgcolor="E5E0E0"><strong>'.$lote.'</strong></th>';
        $html .= '      </tr>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: left" width="630"><strong>IDENTIFICACION EXPORTADOR</strong></th>';
        $html .= '      </tr>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: left" width="120">Nombre / Razon Social: </th>';
        $html .= '          <th style="text-align: left" width="390" bgcolor="E5E0E0"><strong>'.$exportador.'</strong></th>';
        $html .= '          <th style="text-align: center" width="50">NIM: </th>';
        $html .= '          <th style="text-align: center" width="70" bgcolor="E5E0E0"><strong>'.$nim.'</strong></th>';
        $html .= '      </tr>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: left" width="80">Direccion: </th>';
        $html .= '          <th style="text-align: center" width="390" bgcolor="E5E0E0"><strong>'.$direccion.'</strong></th>';
        $html .= '          <th style="text-align: center" width="70">Telefono: </th>';
        $html .= '          <th style="text-align: center" width="90" bgcolor="E5E0E0"><strong>'.$telefono.'</strong></th>';
        $html .= '      </tr>';
        foreach($representantes as $recep){
        $html .= '      <tr>';
        $html .= '          <th style="text-align: left" width="150">Representante Legal: </th>';
        $html .= '          <th style="text-align: center" width="310" bgcolor="E5E0E0"><strong>'.$recep->nombre.'</strong></th>';
        $html .= '          <th style="text-align: center" width="70">Documento: </th>';
        $html .= '          <th style="text-align: center" width="100" bgcolor="E5E0E0"><strong>'.$recep->documento.'</strong></th>';
        $html .= '      </tr>';    
        $html .= '      <tr>';
        $html .= '          <th style="text-align: left" width="70">Telefono: </th>';
        $html .= '          <th style="text-align: center" width="250" bgcolor="E5E0E0"><strong>'.$recep->telefono.'</strong></th>';
        $html .= '          <th style="text-align: center" width="70">Celular: </th>';
        $html .= '          <th style="text-align: center" width="240" bgcolor="E5E0E0"><strong>'.$recep->celular.'</strong></th>';
        $html .= '      </tr>';    
        }
        $html .= '  </thead>';
        $html .= '</table>';
        $html .= '<strong><p style="text-align:center"><h4>DETALLE DE RELIQUIDACION</h4></p></strong>';
        $html .= '<table border="1">';
        $html .= '  <thead>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: center" width="180">Fecha de Envio de Muestra:</th>';
        $html .= '          <th style="text-align: center" width="80" bgcolor="E5E0E0"><strong>'.$fechaEnvioMuestra.'</strong></th>';
        $html .= '          <th style="text-align: center" width="60">Codigo:</th>';
        $html .= '          <th style="text-align: center" width="110" bgcolor="E5E0E0"><strong>'.$codigoEnvioMuestra.'</strong></th>';
        $html .= '          <th style="text-align: center" width="50">CITE:</th>';
        $html .= '          <th style="text-align: center" width="150" bgcolor="E5E0E0"><strong>'.$citeEnvioMuestra.'</strong></th>';
        $html .= '      </tr>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: center" width="240">Fecha de Informe de Laboratorio: </th>';
        $html .= '          <th style="text-align: center" width="70" bgcolor="E5E0E0"><strong>'.$fechaInformeLaboratorio.'</strong></th>';
        $html .= '          <th style="text-align: center" width="240">Num de Informe Laboratorio: </th>';
        $html .= '          <th style="text-align: center" width="80" bgcolor="E5E0E0"><strong>'.$numInformeLaboratorio.'</strong></th>';
        $html .= '      </tr>';
        
        $html .= '  </thead>';
        $html .= '</table>';
        $html = utf8_encode($html);
        ob_clean();
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("salida".".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    
    public function cancelar($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select idformm03, tiporeliquidacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where id = ".$id."; ";
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03"); 
        $tipo = $this->Formm03_model->getDatosTabla($sql, "tiporeliquidacion");
        $strVacio = "";
        
        $data = array( 
              'estado'=>0, 
              'tiporeliquidacion'=>$strVacio
        );
 
        $this->db->where('id', $id); 
        $this->db->update('reliquidacion03', $data); 

        redirect(base_url()."C_pendienteReliquidacion");
    }
    
    public function ejecutar($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select idformm03, tiporeliquidacion, fecharecepcionnotificacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where id = ".$id."; ";
        $fecharecepcionnotificacion = $this->Formm03_model->getDatosTabla($sql, "fecharecepcionnotificacion");
        $fecharecepcionnotificacion = trim($fecharecepcionnotificacion);
        
        if(strlen($fecharecepcionnotificacion) > 0){
            $data = array( 
              'estado'=>2 
            );
 
            $this->db->where('id', $id); 
            $this->db->update('reliquidacion03', $data); 
            redirect(base_url()."C_pendienteReliquidacion");
        } else {
            $this->session->set_userdata("error", "Debe introducir la fecha de recepcion de notificacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
    }
    
    public function dirimision($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $data = array( 
              'estado'=>4
        );
 
        $this->db->where('id', $id); 
        $this->db->update('reliquidacion03', $data); 
        redirect(base_url()."C_pendienteDirimision");
    }
    
    public function editarDatosNotificacion($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select id, idformm03, tiporeliquidacion, fechaenvionotificacion, citenotificacion, fechareliquidacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where id = ".$id."; ";
        
        if ($this->session->userdata("fechaenvionotificacion")){
            $fechaenvionotificacion = $this->session->userdata("fechaenvionotificacion");
        } else {
            $fechaenvionotificacion = $this->Formm03_model->getDatosTabla($sql, "fechaenvionotificacion");
        }
        
        if ($this->session->userdata("citenotificacion")){
            $citenotificacion = $this->session->userdata("citenotificacion");
        } else {
            $citenotificacion = $this->Formm03_model->getDatosTabla($sql, "citenotificacion");
        }
        
        $data = array( 
           'ids'=>$id,
           'idformm03s'=>$this->Formm03_model->getDatosTabla($sql, "idformm03"),
           'tiporeliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "tiporeliquidacion"),
           'fechaenvionotificacions'=>$fechaenvionotificacion,
           'citenotificacions'=>$citenotificacion,
           'fechaActuals'=>$this->Formm03_model->getFechaActual(),
           'fechareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechareliquidacion")
        ); 
        $this->session->unset_userdata('fechaenvionotificacion');
        $this->session->unset_userdata('citenotificacion');
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_pendienteReliquidacion_editarDatosNotificacion", $data);
        $this->load->view("layouts/footer");
    }
                    
    public function guardar_datosNotificacion(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = $this->input->post("id");
        $idformm03 = $this->input->post("idformm03");
        $fechareliquidacion = $this->input->post("fechareliquidacion");
        $operacion = $this->input->post("btn");
        $fechaenvionotificacion = $this->input->post("fechaenvionotificacion");
        $citenotificacion = $this->input->post("citenotificacion");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('fechaenvionotificacion');
            $this->session->unset_userdata('citenotificacion');
            $this->session->unset_userdata('idPendienteReliquidacion');
            
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        if($fechaenvionotificacion == null){
            $this->session->set_userdata("error", "La fecha de env&iacuteo de notificaci&oacuten no debe ser null");
            $this->session->set_userdata("fechaenvionotificacion", $fechaenvionotificacion);
            $this->session->set_userdata("citenotificacion", $citenotificacion);
            $cad = $this->Formm03_model->encriptar($id);
            redirect(base_url()."C_pendienteReliquidacion/editarDatosNotificacion/".$cad);
        }
        
        if($citenotificacion == null){
            $this->session->set_userdata("error", "La cite env&iacuteo de notificaci&oacuten no debe ser null");
            $this->session->set_userdata("fechaenvionotificacion", $fechaenvionotificacion);
            $this->session->set_userdata("citenotificacion", $citenotificacion);
            $cad = $this->Formm03_model->encriptar($id);
            redirect(base_url()."C_pendienteReliquidacion/editarDatosNotificacion/".$cad);
        }
        
        if($fechareliquidacion > $fechaenvionotificacion){
            $this->session->set_userdata("error", "La fecha de env&iacuteo de notificaci&oacuten: ".$fechaenvionotificacion." no debe ser mayor a la fecha de envio de notificacion: ".$fechareliquidacion." ");
            $this->session->set_userdata("fechaenvionotificacion", $fechaenvionotificacion);
            $this->session->set_userdata("citenotificacion", $citenotificacion);
            $cad = $this->Formm03_model->encriptar($id);
            redirect(base_url()."C_pendienteReliquidacion/editarDatosNotificacion/".$cad);
        }
        
        $data = array( 
            'fechaenvionotificacion'=>$fechaenvionotificacion,
            'citenotificacion'=>$citenotificacion
        ); 
        $this->db->where('id', $id); 
        $this->db->update('reliquidacion03', $data);
        
        $this->session->set_userdata("idPendienteReliquidacion", $idformm03);
        redirect(base_url()."C_pendienteReliquidacion");
    }

    public function editarFechaRecepcionNotificacion($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select id, idformm03, tiporeliquidacion, fechaenvionotificacion, citenotificacion, fecharecepcionnotificacion ";
        $sql .= "from reliquidacion03 ";
        $sql .= "where id = ".$id." ";
        
        if ($this->session->userdata("fecharecepcionnotificacion")){
            $fecharecepcionnotificacion = $this->session->userdata("fecharecepcionnotificacion");
        } else {
            $fecharecepcionnotificacion = $this->Formm03_model->getDatosTabla($sql, "fecharecepcionnotificacion");
        }
        
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $fechaenvionotificacion = $this->Formm03_model->getDatosTabla($sql, "fechaenvionotificacion");
        $citenotificacion = $this->Formm03_model->getDatosTabla($sql, "citenotificacion");  

        $data = array(
           'ids' => $id,
           'idformm03s' => $idformm03,
           'fechaenvionotificacions' => $fechaenvionotificacion,
           'citenotificacions' => $citenotificacion,
           'fecharecepcionnotificacions'=> $fecharecepcionnotificacion,
           'fechaActuals' =>$this->Formm03_model->getFechaActual()
        );
            
        $this->load->helper('form');  
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_pendienteReliquidacion_editarFechaRecepcionNotificacion", $data);
        $this->load->view("layouts/footer");
    }
                    
    public function guardar_fehaRecepcionNotificacion(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = $this->input->post("id");
        $idformm03 = $this->input->post("idformm03");
        $fechaenvionotificacion = $this->input->post("fechaenvionotificacion");
        $citenotificacion = $this->input->post("citenotificacion");
        $operacion = $this->input->post("btn");
        $fecharecepcionnotificacion = $this->input->post("fecharecepcionnotificacion");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('idRecepcionNotificacion');
            $this->session->unset_userdata('idformm03RecepcionNotificacion');
            $this->session->unset_userdata('fechaenvionotificacionRecepcionNotificacion');
            $this->session->unset_userdata('citenotificacion');
            $this->session->unset_userdata('fecharecepcionnotificacion');
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        if($fecharecepcionnotificacion == null){
            $this->session->set_userdata("error", "La fecha de recepci&oacuten no debe ser null");
            $cad = $this->Formm03_model->encriptar($id);
            redirect(base_url()."C_pendienteReliquidacion/editarFechaRecepcionNotificacion/".$cad);
        }
        
        if($fecharecepcionnotificacion < $fechaenvionotificacion){
            $this->session->set_userdata("error", "La fecha de recepci&oacuten: ".$fecharecepcionnotificacion." no debe ser menor a la fecha de envi&oacute: ".$fechaenvionotificacion." ");
            $cad = $this->Formm03_model->encriptar($id);
            redirect(base_url()."C_pendienteReliquidacion/editarFechaRecepcionNotificacion/".$cad);
        }
        
        if($operacion == "aceptar"){
            $data = array( 
                'fecharecepcionnotificacion'=>$fecharecepcionnotificacion
            ); 
            $this->db->where('id', $id); 
            $this->db->update('reliquidacion03', $data);

            redirect(base_url()."C_pendienteReliquidacion");
        }
    }
    
    public function cuadroReliquidacionLeyPreliminar($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select lote, r.idformm03 idformm03, codigoformm03, o.nombre exportador, nim, o.id idoperador, direccion, telefono, r.fechaenviomuestra, r.codigoenviomuestra, r.citeenviomuestra, o.nombre as exportador, nim, numinformelaboratorio, fechainformelaboratorio, tiporeliquidacion ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.id = ".$id."; ";
        
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $tipo = $this->Formm03_model->getDatosTabla($sql, "tiporeliquidacion");
        
        $data = array(
           'idformm03s' => $idformm03,
           'lotes' => $lote,
           'exportadors' => $exportador,
           'tipos' => $tipo,
           'minerals' => $this->Formm03_model->getCuadroReliquidacionPreliminar($idformm03, $tipo) 
        );
            
        $this->load->helper('form');  
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_cuadroReliquidacionLeyPreliminar", $data);
        $this->load->view("layouts/footer");
    }
    
    public function cuadroReliquidacionHumedadPreliminar($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select lote, r.idformm03 idformm03, o.nombre exportador, tiporeliquidacion, humedad_senarecom, humedad_declarada, diferencia, case when diferencia > 125 then 'SE RELIQUIDA' else 'NO SE RELIQUIDA' end as estado ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where r.id > 0 ";
        $sql .= "and r.id = ".$id."; ";
        
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $tipo = $this->Formm03_model->getDatosTabla($sql, "tiporeliquidacion");
        $humedad_senarecom = $this->Formm03_model->getDatosTabla($sql, "humedad_senarecom");
        $humedad_declarada = $this->Formm03_model->getDatosTabla($sql, "humedad_declarada");
        $diferencia = $this->Formm03_model->getDatosTabla($sql, "diferencia");
        $estado = $this->Formm03_model->getDatosTabla($sql, "estado");
                
        $data = array(
           'idformm03s' => $idformm03,
           'lotes' => $lote,
           'exportadors' => $exportador,
           'tipos' => $tipo,
           'humedad_senarecoms' => $humedad_senarecom,
           'humedad_declaradas' => $humedad_declarada,
           'diferencias' => $diferencia, 
           'estados' => $estado
        );
            
        $this->load->helper('form');  
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_cuadroReliquidacionHumedadPreliminar", $data);
        $this->load->view("layouts/footer");
    }
    
    public function notificacionReliquidacionHumedad($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select distinct r.id id, r.idformm03 idformm03, tiporeliquidacion, fechaenvionotificacion, citenotificacion, upper(o.nombre) exportador, o.id idoperador, minusculas(rl.nombres) || ' ' || minusculas(rl.apellidopaterno) || ' ' || minusculas(rl.apellidomaterno) as representante, f.lote lote ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join representantelegal rl on rl.idoperador = o.id ";
        $sql .= "where r.id = ".$id."; ";
        
        $fechaenvioNotificacion = $this->Formm03_model->getDatosTabla($sql, "fechaenvionotificacion"); 
        $citeNotificacion = $this->Formm03_model->getDatosTabla($sql, "citenotificacion");
        $fechaActualLarga = $this->Formm03_model->getLugar($lugar, "minuscula").", ".$this->Formm03_model->getFechaLarga($fechaenvioNotificacion);
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $representante = $this->Formm03_model->getDatosTabla($sql, "representante");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        
        $fechaenvioNotificacion = trim($fechaenvioNotificacion);
        $citeNotificacion = trim($citeNotificacion);
        $fechaActualLarga = trim($fechaActualLarga);
        $idformm03 = trim($idformm03);
        $representante = trim($representante);
        $exportador = trim($exportador);
        $lote = trim($lote);
        
        if($fechaenvioNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        if($citeNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar el CITE de la notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Franz Ibanez');
        $pdf->SetTitle('Notificacion de Envio de Muestra');
        $pdf->SetSubject('Envio Muestra');
        $pdf->SetKeywords('Notificacion, Envio, Muestra, test, guide');
        
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // ---------------------------------------------------------
        // Establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
        
        // Establecer el tipo de letra
 
        // Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        // $pdf->SetFont('freemono', '', 12, '', true);  //Original
           $pdf->SetFont('helvetica', '', 9, '', true);
           
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
        
        // Fijar efecto de sombra en el texto
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Establecemos el contenido para imprimir
        
        // Preparamos y maquetamos el contenido a crear
        $html = '';
        $html .="<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        $html .="<i>".$fechaActualLarga."</i><br/>";
        $html .="<i><strong>CITE: ".$citeNotificacion."</strong></i><br/>";
        
        $html .= '
        <br/><br/><br/><br/>
        <i>Señor: </i><br/>
        <i><strong>'.$representante.'</strong></i><br/>
        <i><strong>'.$exportador.'</strong></i><br/>
        <i>Presente.- </i><br/><br/>
        <i><strong><p style="text-align:right">REF.: NOTIFICION DE RELIQUIDACION</p></strong></i><br/><br/>
        <i>De mi mayor consideración.</i><br/><br/>
        <i>De acuerdo a lo establecido en el articulo 87 Inc. i) de la Ley Nro. 535 de Mineria y Metalurgica de fecha 19 de mayo de 2014 y Resoluci&oacuten de Directorio Nro. 14/20111 de fecha 18 de noviembre de 2011, tengo a bien notificar a su Empresa conforme el Acta de Inspecci&oacuten de Minerales y Metales </i><br/><br/>
        ';
        
        $html .= '<i><p>En tal sentido, la Empresa deber&aacute realizar el pago y presentar el descargo, tal como lo establece la norma vigente';
        $html .= '</p></i><br/><br/>';
        $html .= '<i><p>Con este particular, saludo a usted cordilmente.</p></i>';    
        
        $html = utf8_encode($html);
        
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Saludo".".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    
    public function notificacionReliquidacionPeso($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select distinct r.id id, r.idformm03 idformm03, tiporeliquidacion, fechaenvionotificacion, citenotificacion, upper(o.nombre) exportador, o.id idoperador, minusculas(rl.nombres) || ' ' || minusculas(rl.apellidopaterno) || ' ' || minusculas(rl.apellidomaterno) as representante, f.lote lote ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join representantelegal rl on rl.idoperador = o.id ";
        $sql .= "where r.id = ".$id."; ";
        
        $fechaenvioNotificacion = $this->Formm03_model->getDatosTabla($sql, "fechaenvionotificacion"); 
        $citeNotificacion = $this->Formm03_model->getDatosTabla($sql, "citenotificacion");
        $fechaActualLarga = $this->Formm03_model->getLugar($lugar, "minuscula").", ".$this->Formm03_model->getFechaLarga($fechaenvioNotificacion);
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $representante = $this->Formm03_model->getDatosTabla($sql, "representante");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        
        $fechaenvioNotificacion = trim($fechaenvioNotificacion);
        $citeNotificacion = trim($citeNotificacion);
        $fechaActualLarga = trim($fechaActualLarga);
        $idformm03 = trim($idformm03);
        $representante = trim($representante);
        $exportador = trim($exportador);
        $lote = trim($lote);
        
        if($fechaenvioNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        if($citeNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar el CITE de la notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Franz Ibanez');
        $pdf->SetTitle('Notificacion de Envio de Muestra');
        $pdf->SetSubject('Envio Muestra');
        $pdf->SetKeywords('Notificacion, Envio, Muestra, test, guide');
        
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // ---------------------------------------------------------
        // Establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
        
        // Establecer el tipo de letra
 
        // Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        // $pdf->SetFont('freemono', '', 12, '', true);  //Original
           $pdf->SetFont('helvetica', '', 9, '', true);
           
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
        
        // Fijar efecto de sombra en el texto
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Establecemos el contenido para imprimir
        
        // Preparamos y maquetamos el contenido a crear
        $html = '';
        $html .="<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        $html .="<i>".$fechaActualLarga."</i><br/>";
        $html .="<i><strong>CITE: ".$citeNotificacion."</strong></i><br/>";
        
        $html .= '
        <br/><br/><br/><br/>
        <i>Señor: </i><br/>
        <i><strong>'.$representante.'</strong></i><br/>
        <i><strong>'.$exportador.'</strong></i><br/>
        <i>Presente.- </i><br/><br/>
        <i><strong><p style="text-align:right">REF.: NOTIFICION DE RELIQUIDACION</p></strong></i><br/><br/>
        <i>De mi mayor consideración.</i><br/><br/>
        <i>De acuerdo a lo establecido en el articulo 87 Inc. i) de la Ley Nro. 535 de Mineria y Metalurgica de fecha 19 de mayo de 2014 y Resoluci&oacuten de Directorio Nro. 14/20111 de fecha 18 de noviembre de 2011, tengo a bien notificar a su Empresa conforme el Acta de Inspecci&oacuten de Minerales y Metales </i><br/><br/>
        ';
        
        $html .= '<i><p>En tal sentido, la Empresa deber&aacute realizar el pago y presentar el descargo, tal como lo establece la norma vigente';
        $html .= '</p></i><br/><br/>';
        $html .= '<i><p>Con este particular, saludo a usted cordilmente.</p></i>';    
        
        $html = utf8_encode($html);
        
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Saludo".".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
    
    public function notificacionReliquidacionLey($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $id = trim($this->Formm03_model->desemcriptar($entrada));
        
        $sql = "select distinct r.id id, r.idformm03 idformm03, tiporeliquidacion, fechaenvionotificacion, citenotificacion, upper(o.nombre) exportador, o.id idoperador, minusculas(rl.nombres) || ' ' || minusculas(rl.apellidopaterno) || ' ' || minusculas(rl.apellidomaterno) as representante, f.lote lote ";
        $sql .= "from reliquidacion03 r ";
        $sql .= "join formm03 f on f.id = r.idformm03 ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "join representantelegal rl on rl.idoperador = o.id ";
        $sql .= "where r.id = ".$id."; ";
        
        $fechaenvioNotificacion = $this->Formm03_model->getDatosTabla($sql, "fechaenvionotificacion"); 
        $citeNotificacion = $this->Formm03_model->getDatosTabla($sql, "citenotificacion");
        $fechaActualLarga = $this->Formm03_model->getLugar($lugar, "minuscula").", ".$this->Formm03_model->getFechaLarga($fechaenvioNotificacion);
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $representante = $this->Formm03_model->getDatosTabla($sql, "representante");
        $exportador = $this->Formm03_model->getDatosTabla($sql, "exportador");
        $lote = $this->Formm03_model->getDatosTabla($sql, "lote");
        
        $fechaenvioNotificacion = trim($fechaenvioNotificacion);
        $citeNotificacion = trim($citeNotificacion);
        $fechaActualLarga = trim($fechaActualLarga);
        $idformm03 = trim($idformm03);
        $representante = trim($representante);
        $exportador = trim($exportador);
        $lote = trim($lote);
        
        if($fechaenvioNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        if($citeNotificacion == null){
            $this->session->set_userdata("error", "Debe registrar el CITE de la notificacion de reliquidacion");
            redirect(base_url()."C_pendienteReliquidacion");
        }
        
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Franz Ibanez');
        $pdf->SetTitle('Notificacion de Envio de Muestra');
        $pdf->SetSubject('Envio Muestra');
        $pdf->SetKeywords('Notificacion, Envio, Muestra, test, guide');
        
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        
        // ---------------------------------------------------------
        // Establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
        
        // Establecer el tipo de letra
 
        // Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        // $pdf->SetFont('freemono', '', 12, '', true);  //Original
           $pdf->SetFont('helvetica', '', 9, '', true);
           
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
        
        // Fijar efecto de sombra en el texto
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Establecemos el contenido para imprimir
        
        // Preparamos y maquetamos el contenido a crear
        $html = '';
        $html .="<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        $html .="<i>".$fechaActualLarga."</i><br/>";
        $html .="<i><strong>CITE: ".$citeNotificacion."</strong></i><br/>";
        
        $html .= '
        <br/><br/><br/><br/>
        <i>Señor: </i><br/>
        <i><strong>'.$representante.'</strong></i><br/>
        <i><strong>'.$exportador.'</strong></i><br/>
        <i>Presente.- </i><br/><br/>
        <i><strong><p style="text-align:right">REF.: NOTIFICION DE RELIQUIDACION</p></strong></i><br/><br/>
        <i>De mi mayor consideración.</i><br/><br/>
        <i>De acuerdo a lo establecido en el articulo 87 Inc. i) de la Ley Nro. 535 de Mineria y Metalurgica de fecha 19 de mayo de 2014 y Resoluci&oacuten de Directorio Nro. 14/20111 de fecha 18 de noviembre de 2011, tengo a bien notificar a su Empresa conforme el Acta de Inspecci&oacuten de Minerales y Metales </i><br/><br/>
        ';
        
        $html .= '<i><p>En tal sentido, la Empresa deber&aacute realizar el pago y presentar el descargo, tal como lo establece la norma vigente';
        $html .= '</p></i><br/><br/>';
        $html .= '<i><p>Con este particular, saludo a usted cordilmente.</p></i>';    
        
        $html = utf8_encode($html);
        
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Saludo".".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
}

?>