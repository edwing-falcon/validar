<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cotizacionminera extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("CotizacionMinera_model");
        $this->load->model("Formm02_model");
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 10; 
        $idCotizacionMinera = "";
        $cotizacionMineraMineral = "";
        $cotizacionMineraDescripcion = "";
        $cotizacionMineraFecha = "";
        
        $controlSession = $this->Formm02_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idCotizacionMinera")){
            $idCotizacionMinera = $this->session->userdata("idCotizacionMinera");
        }
                
        if ($this->session->userdata("cotizacionMineraMineral")){
            $cotizacionMineraMineral = $this->session->userdata("cotizacionMineraMineral");
        }
        
        if ($this->session->userdata("cotizacionMineraDescripcion")){
            $cotizacionMineraDescripcion = $this->session->userdata("cotizacionMineraDescripcion");
        }
        
        if ($this->session->userdata("cotizacionMineraFecha")){
            $cotizacionMineraFecha = $this->session->userdata("cotizacionMineraFecha");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."C_cotizacionminera/pagina/";
        $conta = $this->CotizacionMinera_model->getTotal($idCotizacionMinera, $cotizacionMineraMineral, $cotizacionMineraDescripcion, $cotizacionMineraFecha);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_cotizacionminera";

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
            "fechas" => $this->CotizacionMinera_model->getfecha(),
            "cotizaciones" => $this->CotizacionMinera_model->buscar_cotizacionminera($idCotizacionMinera, $cotizacionMineraMineral, $cotizacionMineraDescripcion, $cotizacionMineraFecha, $inicio, $mostrarpor),
            "cants" => $cant
        );
        
        /*$data1  = array(
            'datos' => $this->Formm02_model->contador()
        );*/
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('parametricas/V_cotizacionminera',$data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->session->unset_userdata('idCotizacionMinera');
        $this->session->unset_userdata('cotizacionMineraMineral');
        $this->session->unset_userdata('cotizacionMineraDescripcion');
        $this->session->unset_userdata('cotizacionMineraFecha');
        
        redirect(base_url()."C_cotizacionminera");
    }
    
    public function reporte(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->load->library('Pdf');
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Franz Ibanez');
        $pdf->SetTitle('Notificacion de Envio de Muestra');
        $pdf->SetSubject('Envio Muestra');
        $pdf->SetKeywords('Notificacion, Envio, Muestra, test, guide');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        //$pdf->setPrintFooter(false);
        
        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        //*$pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 0, 0), $lc = array(0, 0, 0));

        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        
        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
        $pdf->SetFont('helvetica', '', 7, '', true);
        
        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        // Fijar efecto de sombra en el texto
        // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Establecemos el contenido para imprimir
        $idCotizacionMinera = $this->input->post('idCotizacionMinera');
        $cotizacionMineraMineral = $this->input->post('cotizacionMineraMineral');
        $cotizacionMineraDescripcion = $this->input->post('cotizacionMineraDescripcion');
        $cotizacionMineraFecha = $this->input->post('cotizacionMineraFecha');

        $idCotizacionMinera = trim($idCotizacionMinera);
        $cotizacionMineraMineral = trim($cotizacionMineraMineral);
        $cotizacionMineraDescripcion = trim($cotizacionMineraDescripcion);
        $cotizacionMineraFecha = trim($cotizacionMineraFecha);
        
        $aux = "idCotizacionMinera=".$idCotizacionMinera."<br/>";
        $aux .= "cotizacionMineraMineral=".$cotizacionMineraMineral."<br/>";
        $aux .= "cotizacionMineraDescripcion=".$cotizacionMineraDescripcion."<br/>";
        $aux .= "cotizacionMineraFecha=".$cotizacionMineraFecha."<br/>";
        $this->output->set_output($aux);
        /*
        // Preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= ' ';
        $html .= '<table border="1">';
        $html .= '  <thead>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: center" width="70"><br/><br/><i><strong><h2>FORM<br/>M-02</h2></strong></i></th>';
        $html .= '          <th style="text-align: center" width="450"><br/><br/>SERVICIO NACIONAL DE REGISTRO Y CONTROL DE LA COMERCIALIZACION DE MINERALES Y METALES<br/><i><strong><h2>REPORTE DE FORMULARIO M-02</h2></strong></i><br/><strong><h3><center>Departamental: '.$lugar.'     Estado: '.$estadoDetalleReporteEstadoM02.'     '.$fechaSalida.'</center></h3></strong><h3>Gestion: '.$gestionReporteEstadoM02.' Mes: '.$mesLiteral.'</h3></th>';
        $html .= '          <th style="text-align: center" width="110"><br/><br/><img src="'.base_url()."assets/images/isologo-para-hojas-de-ruta.png".'" WIDTH="60" HEIGHT="60" alt="Smiley face" align="middle"></th>';
        $html .= '      </tr>';
        $html .= '  </thead>';
        $html .= '</table>';
                                                                      
        $compradores = $this->Formm02_model->getCompradoresReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02);
        
        foreach($compradores as $comprador){
            $idcompradoraux = $comprador->idcomprador;
            $formularios = $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradoraux, $fechaReporteEstadoM02);
            
            $sql = "select count(*) as total ";
            $sql .= "from formm02 f ";
            $sql .= "join operador o on o.id = f.idcomprador ";
            $sql .= "where f.id > 0 ";
            $sql .= "and oficinavalidacion = '".$lugar."' "; 
            $sql .= "and f.estado = ".$estadoReporteEstadoM02." ";
            if($idcompradoraux > 0){ $sql .= "and o.id = ".$idcompradoraux." "; }
            $sql .= "and date_part('year', ".$fechaReporteEstadoM02.") = ".$gestionReporteEstadoM02." ";
            $sql .= "and date_part('month', ".$fechaReporteEstadoM02.") = ".$mesReporteEstadoM02." ";
            $cantidad = $this->Formm02_model->getDatosTabla($sql, "total");
        
            $html .= '<i><strong><p style="text-align:center">--------------- COMPRADOR: '.$comprador->comprador.' Registros: '.$cantidad.' ---------------</p></strong></i><br/>';
            
            $html .= '<table border="1">';
            $html .= '  <thead>';
            $html .= '      <tr>';
            //$html .= '          <th style="text-align: center" width="20"><i>No.</i></th>';
            $html .= '          <th style="text-align: center" width="40"><i>ID</i></th>';
            $html .= '          <th style="text-align: center" width="70"><i>FECHA<br/>DECLARACION</i></th>';
            $html .= '          <th style="text-align: center" width="55"><i>FECHA<br/>REGISTRO</i></th>';
            $html .= '          <th style="text-align: center" width="70"><i>FECHA<br/>TRANSACCION</i></th>';
            $html .= '          <th style="text-align: center" width="65"><i>FECHA VALIDACION</i></th>';
            $html .= '          <th style="text-align: center" width="90"><i>CODIGO</i></th>';
            $html .= '          <th style="text-align: center" width="180"><i>RAZON SOCIAL VENDEDOR</i></th>';
            $html .= '          <th style="text-align: center" width="60"><i>USUARIO</i></th>';
            $html .= '      </tr>';
            $html .= '  </thead>';
            $i = 0;    
            foreach($formularios as $recep){
                //$i = $i + 1;
                $html .= '  <tbody>';
                $html .= '   <tr>';
                //$html .= '    <td style="text-align: center" width="20"><i>'.$i.'</i></td>';
                $html .= '    <td style="text-align: center" width="40"><i>'.$recep->id.'</i></td>';
                $html .= '    <td style="text-align: center" width="70"><i>'.$recep->fechadeclaracion.'</i></td>';
                $html .= '    <td style="text-align: center" width="55"><i>'.$recep->fecharegistro.'</i></td>';
                $html .= '    <td style="text-align: center" width="70"><i>'.$recep->fechatransaccion.'</i></td>';
                $html .= '    <td style="text-align: center" width="65"><i>'.$recep->fechavalidacion.'</i></td>';
                $html .= '    <td style="text-align: center" width="90"><i>'.$recep->codigo.'</i></td>';
                $html .= '    <td style="text-align: left" width="180"><i>'.$recep->razonsocialvendedor.'</i></td>';
                $html .= '    <td style="text-align: center" width="60"><i>'.$recep->codigovalidador.'</i></td>';
                $html .= '   </tr>';
                $html .= '  </tbody>';
            }
            $html .= '</table>';
        }
        
        $html .= '<br/><br/>';
        $html .= '<i><p style="text-align:right">Sistema Nacional de Informacion Sobre Comercializacion Ventas Operador v. 1.0</p></i><br/><br/>';
        $html .= '<br/>';
        $html = utf8_encode($html);
        ob_clean();
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("salida".".pdf");
        $pdf->Output($nombre_archivo, 'I');*/
    }
    
    public function busqueda(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $idCotizacionMinera = $this->input->post("idCotizacionMinera"); 
        $cotizacionMineraMineral = $this->input->post("cotizacionMineraMineral");
        $cotizacionMineraDescripcion = $this->input->post("cotizacionMineraDescripcion");
        $cotizacionMineraFecha = $this->input->post("cotizacionMineraFecha");
        
        $idCotizacionMinera = trim($idCotizacionMinera);
        $cotizacionMineraMineral = strtoupper(trim($cotizacionMineraMineral));
        $cotizacionMineraDescripcion = strtoupper(trim($cotizacionMineraDescripcion));
        $cotizacionMineraFecha = trim($cotizacionMineraFecha);
        
        if(is_numeric($idCotizacionMinera) == false){ $idCotizacionMinera = 0; }
        
        $this->session->set_userdata("idCotizacionMinera", $idCotizacionMinera);
        $this->session->set_userdata("cotizacionMineraMineral", $cotizacionMineraMineral);
        $this->session->set_userdata("cotizacionMineraDescripcion", $cotizacionMineraDescripcion);
        $this->session->set_userdata("cotizacionMineraFecha", $cotizacionMineraFecha);
        
        redirect(base_url()."C_cotizacionminera");
    }
    
}

?>
