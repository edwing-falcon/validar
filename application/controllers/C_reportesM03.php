<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reportesM03 extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
    }
    
    public function index(){
        $controlSession = $this->Formm03_model->controlSession();
        $fecha = $this->Formm03_model->getFechaActual();
        
        $lugar = $this->session->userdata("lugar");
        $this->session->set_userdata("estadoReporteEstadoM03", "VALIDADO");
        $this->session->set_userdata("ordenReporteEstadoM03", "f.id");
        $this->session->set_userdata("departamentalReporteEstadoM03", $lugar);
        
        $data = array(
            'fechasActuales' => $fecha,
            'gestiones' => $this->Formm03_model->getGestiones(),
            'meses' => $this->Formm03_model->getMeses(),
            'estados' => $this->Formm03_model->getEstados(""),
            'estadosValidados' => $this->Formm03_model->getEstados("2"),
            'exportadores' => $this->Formm03_model->getExportadores(),
            'fechas' => $this->Formm03_model->getFechas(""),
            'fechasValidados' => $this->Formm03_model->getFechas("fechavalidacion"),
            'departamentales' => $this->Formm03_model->getDepartamentales(),
            'ordenados' => $this->Formm03_model->getOrdenados()
        );
        
        $this->load->helper('form');
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view('formm03/V_reporteM03',$data);
        $this->load->view("layouts/footer");
    }
    
    public function days_in_month($month, $year){
        $controlSession = $this->Formm03_model->controlSession();
        
        $numdias = 0;
        if($month == 1) { $numdias = 31; }
        if($month == 2 && $year%4 == 0 ) { $numdias =  29; } else { $numdias =  28; } 
        if($month == 3) { $numdias = 31; }
        if($month == 4) { $numdias = 30; }
        if($month == 5) { $numdias = 31; }
        if($month == 6) { $numdias = 30; }
        if($month == 7) { $numdias = 31; }
        if($month == 8) { $numdias = 31; }
        if($month == 9) { $numdias = 30; }
        if($month == 10) { $numdias = 31; }
        if($month == 11) { $numdias = 30; }
        if($month == 12) { $numdias = 31; }
        
        return $numdias;
    }
    
    public function fillDias(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        
        $dias = $this->days_in_month($month, $year);
        for($i=1; $i<=$dias; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    
    public function reporte(){
        $controlSession = $this->Formm03_model->controlSession();
        
        // Establecemos el contenido para imprimir
        $gestionReporteEstadoM03 = $this->input->post('gestionReporteEstadoM03');
        $mesReporteEstadoM03 = $this->input->post('mesReporteEstadoM03');
        $estadoReporteEstadoM03 = $this->input->post('estadoReporteEstadoM03');
        $idexportadorOrigen = $this->input->post('exportadorReporteEstadoM03');
        $fechaReporteEstadoM03 = $this->input->post('fechaReporteEstadoM03');
        $departamentalReporteEstadoM03 = $this->input->post('departamentalReporteEstadoM03');
        $ordenReporteEstadoM03 = $this->input->post('ordenReporteEstadoM03');
        $botonReporteEstadoM03 = $this->input->post('botonReporteEstadoM03');
        
        $gestionReporteEstadoM03 = trim($gestionReporteEstadoM03);
        $mesReporteEstadoM03 = trim($mesReporteEstadoM03);
        $estadoReporteEstadoM03 = trim($estadoReporteEstadoM03);
        $idexportadorOrigen = trim($idexportadorOrigen);
        $fechaReporteEstadoM03 = trim($fechaReporteEstadoM03);
        $departamentalReporteEstadoM03 = trim($departamentalReporteEstadoM03);
        $ordenReporteEstadoM03 = trim($ordenReporteEstadoM03);
        $botonReporteEstadoM03 = trim($botonReporteEstadoM03);
        
        if(strlen($gestionReporteEstadoM03) == 0){
            $this->session->set_userdata("errorReporteEstadoM03", "Debe seleccionar una gestion");
            $this->session->set_userdata("gestionReporteEstadoM03", $gestionReporteEstadoM03);
            $this->session->set_userdata("mesReporteEstadoM03", $mesReporteEstadoM03);
            $this->session->set_userdata("estadoReporteEstadoM03", $estadoReporteEstadoM03);
            $this->session->set_userdata("fechaReporteEstadoM03", $fechaReporteEstadoM03);
            $this->session->set_userdata("idexportadorOrigen", $idexportadorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM03", $departamentalReporteEstadoM03);
            $this->session->set_userdata("ordenReporteEstadoM03", $ordenReporteEstadoM03);
            
            redirect(base_url()."C_reportesM03");
        }
        
        if(strlen($mesReporteEstadoM03) == 0){
            $this->session->set_userdata("errorReporteEstadoM03", "Debe seleccionar un mes");
            $this->session->set_userdata("gestionReporteEstadoM03", $gestionReporteEstadoM03);
            $this->session->set_userdata("mesReporteEstadoM03", $mesReporteEstadoM03);
            $this->session->set_userdata("estadoReporteEstadoM03", $estadoReporteEstadoM03);
            $this->session->set_userdata("fechaReporteEstadoM03", $fechaReporteEstadoM03);
            $this->session->set_userdata("idexportadorOrigen", $idexportadorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM03", $departamentalReporteEstadoM03);
            $this->session->set_userdata("ordenReporteEstadoM03", $ordenReporteEstadoM03);
            
            redirect(base_url()."C_reportesM03");
        }
        
        if(strlen($fechaReporteEstadoM03) == 0){
            $this->session->set_userdata("errorReporteEstadoM03", "Debe seleccionar una fecha de reporte");
            $this->session->set_userdata("gestionReporteEstadoM03", $gestionReporteEstadoM03);
            $this->session->set_userdata("mesReporteEstadoM03", $mesReporteEstadoM03);
            $this->session->set_userdata("estadoReporteEstadoM03", $estadoReporteEstadoM03);
            $this->session->set_userdata("fechaReporteEstadoM03", $fechaReporteEstadoM03);
            $this->session->set_userdata("idexportadorOrigen", $idexportadorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM03", $departamentalReporteEstadoM03);
            $this->session->set_userdata("ordenReporteEstadoM03", $ordenReporteEstadoM03);
            
            redirect(base_url()."C_reportesM03");
        }
        
        if(strlen($departamentalReporteEstadoM03) == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "Debe seleccionar una oficina departamental");
            $this->session->set_userdata("gestionReporteEstadoM03", $gestionReporteEstadoM03);
            $this->session->set_userdata("mesReporteEstadoM03", $mesReporteEstadoM03);
            $this->session->set_userdata("estadoReporteEstadoM03", $estadoReporteEstadoM03);
            $this->session->set_userdata("fechaReporteEstadoM03", $fechaReporteEstadoM03);
            $this->session->set_userdata("idexportadorOrigen", $idexportadorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM03", $departamentalReporteEstadoM03);
            $this->session->set_userdata("ordenReporteEstadoM03", $ordenReporteEstadoM03);
            
            redirect(base_url()."C_reportesM03");
        }
        
        if($mesReporteEstadoM03 == 1) { $mesLiteral = "ENERO"; }
        if($mesReporteEstadoM03 == 2) { $mesLiteral = "FEBRERO"; }
        if($mesReporteEstadoM03 == 3) { $mesLiteral = "MARZO"; }
        if($mesReporteEstadoM03 == 4) { $mesLiteral = "ABRIL"; }
        if($mesReporteEstadoM03 == 5) { $mesLiteral = "MAYO"; }
        if($mesReporteEstadoM03 == 6) { $mesLiteral = "JUNIO"; }
        if($mesReporteEstadoM03 == 7) { $mesLiteral = "JULIO"; }
        if($mesReporteEstadoM03 == 8) { $mesLiteral = "AGOSTO"; }
        if($mesReporteEstadoM03 == 9) { $mesLiteral = "SEPTIEMBRE"; }
        if($mesReporteEstadoM03 == 10) { $mesLiteral = "OCTUBRE"; }
        if($mesReporteEstadoM03 == 11) { $mesLiteral = "NOVIEMBRE"; }
        if($mesReporteEstadoM03 == 12) { $mesLiteral = "DICIEMBRE"; }
        
        if($fechaReporteEstadoM03 == "fechatransaccion") { $fechaSalida = "Por fecha de transaccion"; }
        if($fechaReporteEstadoM03 == "fechaexportacion") { $fechaSalida = "Por fecha de exportacion"; }
        if($fechaReporteEstadoM03 == "fechadeclaracion") { $fechaSalida = "Por fecha de declaracion"; }
        if($fechaReporteEstadoM03 == "fechavalidacion") { $fechaSalida = "Por fecha de validacion"; }
        if($fechaReporteEstadoM03 == "fecharegistro") { $fechaSalida = "Por fecha de registro"; }
        
        $sql = "select id, descripcion ";
        $sql .= "from estadoformulario ";
        $sql .= "where id = ".$estadoReporteEstadoM03."; ";
        $estadoDetalleReporteEstadoM03 = $this->Formm03_model->getDatosTabla($sql, "descripcion");
        
        $exportador = "TODOS LOS EXPORTADORES";
        if(strlen($idexportadorOrigen) > 0){
            $sql = "select nombre ";
            $sql .= "from operador ";
            $sql .= "where id = ".$idexportadorOrigen.";";
            $exportador = "EXPORTADOR: ".$this->Formm03_model->getDatosTabla($sql, "nombre");
        }
        
        $sql = "select count(*) as total ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and oficinavalidacion = '".$departamentalReporteEstadoM03."' "; 
        $sql .= "and f.estado = ".$estadoReporteEstadoM03." ";
        if(strlen($idexportadorOrigen) > 0){ $sql .= "and o.id = ".$idexportadorOrigen." "; }
        $sql .= "and date_part('year', ".$fechaReporteEstadoM03.") = ".$gestionReporteEstadoM03." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM03.") = ".$mesReporteEstadoM03." ";
        $total = $this->Formm03_model->getDatosTabla($sql, "total");
        
        if($total == 0){
            $this->session->set_userdata("errorReporteEstadoM03", "No existe datos");
            $this->session->set_userdata("gestionReporteEstadoM03", $gestionReporteEstadoM03);
            $this->session->set_userdata("mesReporteEstadoM03", $mesReporteEstadoM03);
            $this->session->set_userdata("estadoReporteEstadoM03", $estadoReporteEstadoM03);
            $this->session->set_userdata("fechaReporteEstadoM03", $fechaReporteEstadoM03);
            $this->session->set_userdata("idexportadorOrigen", $idexportadorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM03", $departamentalReporteEstadoM03);
            $this->session->set_userdata("ordenReporteEstadoM03", $ordenReporteEstadoM03);
            
            redirect(base_url()."C_reportesM03");
        }
        
        if($botonReporteEstadoM03 == "pdf"){
            $this->load->library('Pdf');
            //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
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
            //$pdf->AddPage();
            $pdf->AddPage('L', 'A4');
            //$pdf->Cell(0, 0, 'A4 LANDSCAPE', 1, 1, 'C');

            // Fijar efecto de sombra en el texto
            // $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
            
            // Preparamos y maquetamos el contenido a crear
            $html = '';
            $html .= '<table border="1">';
            $html .= '  <thead>';
            $html .= '      <tr>';
            $html .= '          <th style="text-align: center" width="70"><br/><br/><br/><i><strong><h2>FORM<br/>M-02</h2></strong></i></th>';
            $html .= '          <th style="text-align: center" width="760"><br/><br/>SERVICIO NACIONAL DE REGISTRO Y CONTROL DE LA COMERCIALIZACION DE MINERALES Y METALES<br/><i><strong><h2>REPORTE DE FORMULARIO M-03</h2></strong></i><br/><strong><h3><center>DEPARTAMENTAL: '.$departamentalReporteEstadoM03.'     ESTADO: '.$estadoDetalleReporteEstadoM03.'     '.$exportador.'<br/>'.$fechaSalida.'  '.'       Total de registros: '.$total.'</center></h3></strong><h3>Gestion: '.$gestionReporteEstadoM03.' Mes: '.$mesLiteral.'</h3></th>';
            $html .= '          <th style="text-align: center" width="110"><br/><br/><br/><img src="'.base_url()."assets/images/isologo-para-hojas-de-ruta.png".'" WIDTH="60" HEIGHT="60" alt="Smiley face" align="middle"></th>';
            $html .= '      </tr>';
            $html .= '  </thead>';
            $html .= '</table>';
            $html .= '<br/><br/>';
            $formularios = $this->Formm03_model->getFormm03ReporteM03($gestionReporteEstadoM03, $mesReporteEstadoM03, $estadoReporteEstadoM03, $idexportadorOrigen, $fechaReporteEstadoM03, $departamentalReporteEstadoM03, $ordenReporteEstadoM03);
            
            $html .= '<table border="1">';
            $html .= '  <thead>';
            $html .= '      <tr>';
            $html .= '          <th style="text-align: center" width="20"><i>No.</i></th>';
            $html .= '          <th style="text-align: center" width="40"><i>ID</i></th>';
            $html .= '          <th style="text-align: center" width="70"><i>FECHA VALIDACION</i></th>';
            $html .= '          <th style="text-align: center" width="110"><i>CODIGO</i></th>';
            $html .= '          <th style="text-align: center" width="310"><i>RAZON SOCIAL EXPORTADOR</i></th>';
            $html .= '          <th style="text-align: center" width="320"><i>RAZON SOCIAL COMPRADOR</i></th>';
            $html .= '          <th style="text-align: center" width="70"><i>USUARIO</i></th>';
            $html .= '      </tr>';
            $html .= '  </thead>';
            $i = 0;
            
            foreach($formularios as $recep){
                $i = $i + 1;
                $html .= '  <tbody>';
                $html .= '   <tr>';
                $html .= '    <td style="text-align: center" width="20"><i>'.$i.'</i></td>';
                $html .= '    <td style="text-align: center" width="40"><i>'.$recep->id.'</i></td>';
                $html .= '    <td style="text-align: center" width="70"><i>'.$recep->fechavalidacion.'</i></td>';
                $html .= '    <td style="text-align: center" width="110"><i>'.$recep->codigo.'</i></td>';
                $html .= '    <td style="text-align: left" width="310"><i>'.$recep->exportador1.'</i></td>';
                $html .= '    <td style="text-align: left" width="320"><i>'.$recep->razonsocialcomprador1.'</i></td>';
                $html .= '    <td style="text-align: center" width="70"><i>'.$recep->codigovalidador.'</i></td>';
                $html .= '   </tr>';
                $html .= '  </tbody>';
            }
            
            $html .= '</table>';
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
            $pdf->Output($nombre_archivo, 'I');            
        }
        
        if($botonReporteEstadoM03 == "excel"){
            $formularios = $this->Formm03_model->getFormm03ReporteM03($gestionReporteEstadoM03, $mesReporteEstadoM03, $estadoReporteEstadoM03, $idexportadorOrigen, $fechaReporteEstadoM03, $departamentalReporteEstadoM03, $ordenReporteEstadoM03);
            if(count($formularios) > 0){
                //Cargamos la librería de excel.
                $this->load->library('excel');
                $this->excel->setActiveSheetIndex(0);
                $this->excel->getActiveSheet()->setTitle('Formulario');
                
                //Contador de filas
                $contador = 1;
                
                //Le aplicamos ancho las columnas.
                $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
                $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
                $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
                $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
                $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(100);
                $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(100);
                $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
                
                $titulo1 = array(
                            'font' => array(
                            'name'      => 'Arial',
                            'bold'      => true,   
                            'size' =>12,				
                            'color'     => array(
                            'rgb' => '000000'
                            )
                        ),
                            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                            
                        ),
                          /*  'fill' 	=> array(
                            'type'	=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                            'startcolor' => array(
                            'rgb'        => '002e7a'
                            ),
                            'endcolor'   => array(
                            'argb'       => '002e7a'
                            )
			),*/
                            'borders' => array(
                            'right'   => array(
                            'style'   => PHPExcel_Style_Border::BORDER_THIN,
                            'color'   => array(
                            'rgb'     => '000000'
                            )
                        ),
                            'bottom'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb' => '000000'
                            )
                        ),
                            'left'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        ),
                            'right'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        )       
    		));
                
                $titulo2 = array(
                            'font' => array(
                            'name'      => 'Arial',
                            //'bold'      => true,   
                            'size' =>9,				
                            'color'     => array(
                            'rgb' => '000000'
                            )
                        ),
                            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                            
                        ),
                          /*  'fill' 	=> array(
                            'type'	=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                            'startcolor' => array(
                            'rgb'        => '002e7a'
                            ),
                            'endcolor'   => array(
                            'argb'       => '002e7a'
                            )
			),*/
                            'borders' => array(
                            'right'   => array(
                            'style'   => PHPExcel_Style_Border::BORDER_THIN,
                            'color'   => array(
                            'rgb'     => '000000'
                            )
                        ),
                            'bottom'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb' => '000000'
                            )
                        ),
                            'left'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        ),
                            'right'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        )       
    		));
                
                $titulo3 = array(
                            'font' => array(
                            'name'      => 'Arial',
                            //'bold'      => true,   
                            'size' =>9,				
                            'color'     => array(
                            'rgb' => '000000'
                            )
                        ),
                            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                            
                        ),
                          /*  'fill' 	=> array(
                            'type'	=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                            'startcolor' => array(
                            'rgb'        => '002e7a'
                            ),
                            'endcolor'   => array(
                            'argb'       => '002e7a'
                            )
			),*/
                            'borders' => array(
                            'right'   => array(
                            'style'   => PHPExcel_Style_Border::BORDER_THIN,
                            'color'   => array(
                            'rgb'     => '000000'
                            )
                        ),
                            'bottom'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb' => '000000'
                            )
                        ),
                            'left'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        ),
                            'right'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        )       
    		));
                
                $titulo3 = array(
                            'font' => array(
                            'name'      => 'Arial',
                            //'bold'      => true,   
                            'size' =>9,				
                            'color'     => array(
                            'rgb' => '000000'
                            )
                        ),
                            'alignment' => array(
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                            
                        ),
                          /*  'fill' 	=> array(
                            'type'	=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                            'rotation'   => 90,
                            'startcolor' => array(
                            'rgb'        => '002e7a'
                            ),
                            'endcolor'   => array(
                            'argb'       => '002e7a'
                            )
			),*/
                            'borders' => array(
                            'right'   => array(
                            'style'   => PHPExcel_Style_Border::BORDER_THIN,
                            'color'   => array(
                            'rgb'     => '000000'
                            )
                        ),
                            'bottom'=> array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb' => '000000'
                            )
                        ),
                            'left'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        ),
                            'right'   => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN ,
                            'color' => array(
                            'rgb'   => '000000'
                            )
                        ),
                            'numberFormat' => array(
                            "code" =>  "#,###.##"
                        ),                                
    		));
                
                //Definimos los style a la cabecera.
                $this->excel->getActiveSheet()->getStyle("A{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("B{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("C{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("D{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("E{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("F{$contador}")->applyFromArray($titulo1);
                $this->excel->getActiveSheet()->getStyle("G{$contador}")->applyFromArray($titulo1);
                
                //Definimos los títulos de la cabecera.
                $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'No');
                $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'ID M-03');
                $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'FECHA VALIDACION');
                $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'CODIGO');
                $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'EXPORTADOR');
                $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'COMPRADOR');
                $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'CODIGO VALIDADOR');
                
                //Definimos la data del cuerpo.
                foreach($formularios as $f){
                    //Incrementamos una fila más, para ir a la siguiente.
                    $contador++;
                    
                    //Definimos los style a la cabecera.
                    $this->excel->getActiveSheet()->getStyle("A{$contador}")->applyFromArray($titulo2);
                    $this->excel->getActiveSheet()->getStyle("B{$contador}")->applyFromArray($titulo2);
                    $this->excel->getActiveSheet()->getStyle("C{$contador}")->applyFromArray($titulo2);
                    $this->excel->getActiveSheet()->getStyle("D{$contador}")->applyFromArray($titulo2);
                    $this->excel->getActiveSheet()->getStyle("E{$contador}")->applyFromArray($titulo3);
                    $this->excel->getActiveSheet()->getStyle("F{$contador}")->applyFromArray($titulo3);
                    $this->excel->getActiveSheet()->getStyle("G{$contador}")->applyFromArray($titulo2);
                    
                    $this->excel->getActiveSheet()->setCellValue("A{$contador}", $contador-1);
                    $this->excel->getActiveSheet()->setCellValue("B{$contador}", $f->id);
                    $this->excel->getActiveSheet()->setCellValue("C{$contador}", $f->fechavalidacion);
                    $this->excel->getActiveSheet()->setCellValue("D{$contador}", $f->codigo);
                    $this->excel->getActiveSheet()->setCellValue("E{$contador}", $f->exportador1);
                    $this->excel->getActiveSheet()->setCellValue("F{$contador}", $f->razonsocialcomprador1);
                    $this->excel->getActiveSheet()->setCellValue("G{$contador}", $f->codigovalidador);
                }
                
                //Le ponemos un nombre al archivo que se va a generar.
                //$archivo = "FORMULARIO_{$gestionReporteEstadoM02}.xls";
                $archivo = "FORMULARIO_M03.xls";
                ob_end_clean();
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$archivo.'"');
                header('Cache-Control: max-age=0');
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
                //Hacemos una salida al navegador con el archivo Excel.
                $objWriter->save('php://output');
            } else {
                echo 'No se han encontrado llamadas';
                exit;
            }
        }
    } 
    
}


?>

