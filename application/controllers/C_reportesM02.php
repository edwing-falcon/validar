<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reportesM02 extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $fecha = $this->Formm02_model->getFechaActual();

        $this->session->set_userdata("estadoReporteEstadoM02", "VALIDADO");
        $this->session->set_userdata("ordenReporteEstadoM02", "f.id");
        $this->session->set_userdata("departamentalReporteEstadoM02", $lugar);
        
        $data = array(
            'fechasActuales' => $fecha,
            'lugares' => $lugar,
            'gestiones' => $this->Formm02_model->getGestiones(),
            'meses' => $this->Formm02_model->getMeses(),
            'estados' => $this->Formm02_model->getEstados(""),
            'estadosValidados' => $this->Formm02_model->getEstados("2"),
            'compradores' => $this->Formm02_model->getCompradores(),
            'fechas' => $this->Formm02_model->getFechas("fechavalidacion"),
            'fechasValidados' => $this->Formm02_model->getFechas("fechavalidacion"),
            'departamentales' => $this->Formm02_model->getDepartamentales(),
            'ordenados' => $this->Formm02_model->getOrdenados()
        );
        
        $data1 = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $lugar = $this->session->userdata("lugar");
        $codigo = $this->session->userdata("codigo");
        
        $this->load->helper('form');
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view('formm02/V_reporteM02',$data);
        $this->load->view("layouts/footer");
    }
    
    public function days_in_month($month, $year){
        $controlSession = $this->Formm02_model->controlSession();
        
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
        $controlSession = $this->Formm02_model->controlSession();
        
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        
        $dias = $this->days_in_month($month, $year);
        for($i=1; $i<=$dias; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
        }
    }
    
    public function reporte(){
        $controlSession = $this->Formm02_model->controlSession();
        
        // Establecemos el contenido para imprimir
        $gestionReporteEstadoM02 = $this->input->post('gestionReporteEstadoM02');
        $mesReporteEstadoM02 = $this->input->post('mesReporteEstadoM02');
        $estadoReporteEstadoM02 = $this->input->post('estadoReporteEstadoM02');
        $idcompradorOrigen = $this->input->post('compradorReporteEstadoM02');
        $fechaReporteEstadoM02 = $this->input->post('fechaReporteEstadoM02');
        $departamentalReporteEstadoM02 = $this->input->post('departamentalReporteEstadoM02');
        $ordenReporteEstadoM02 = $this->input->post('ordenReporteEstadoM02');
        $botonReporteEstadoM02 = $this->input->post('botonReporteEstadoM02');
        
        $gestionReporteEstadoM02 = trim($gestionReporteEstadoM02);
        $mesReporteEstadoM02 = trim($mesReporteEstadoM02);
        $estadoReporteEstadoM02 = trim($estadoReporteEstadoM02);
        $idcompradorOrigen = trim($idcompradorOrigen);
        $fechaReporteEstadoM02 = trim($fechaReporteEstadoM02);
        $departamentalReporteEstadoM02 = trim($departamentalReporteEstadoM02);
        $ordenReporteEstadoM02 = trim($ordenReporteEstadoM02);
        $botonReporteEstadoM02 = trim($botonReporteEstadoM02);
        
        if(strlen($gestionReporteEstadoM02) == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "Debe seleccionar una gestion");
            $this->session->set_userdata("gestionReporteEstadoM02", $gestionReporteEstadoM02);
            $this->session->set_userdata("mesReporteEstadoM02", $mesReporteEstadoM02);
            $this->session->set_userdata("estadoReporteEstadoM02", $estadoReporteEstadoM02);
            $this->session->set_userdata("fechaReporteEstadoM02", $fechaReporteEstadoM02);
            $this->session->set_userdata("idcompradorOrigen", $idcompradorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM02", $departamentalReporteEstadoM02);
            $this->session->set_userdata("ordenReporteEstadoM02", $ordenReporteEstadoM02);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if(strlen($mesReporteEstadoM02) == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "Debe seleccionar un mes");
            $this->session->set_userdata("gestionReporteEstadoM02", $gestionReporteEstadoM02);
            $this->session->set_userdata("mesReporteEstadoM02", $mesReporteEstadoM02);
            $this->session->set_userdata("estadoReporteEstadoM02", $estadoReporteEstadoM02);
            $this->session->set_userdata("fechaReporteEstadoM02", $fechaReporteEstadoM02);
            $this->session->set_userdata("idcompradorOrigen", $idcompradorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM02", $departamentalReporteEstadoM02);
            $this->session->set_userdata("ordenReporteEstadoM02", $ordenReporteEstadoM02);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if(strlen($fechaReporteEstadoM02) == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "Debe seleccionar una fecha de reporte");
            $this->session->set_userdata("gestionReporteEstadoM02", $gestionReporteEstadoM02);
            $this->session->set_userdata("mesReporteEstadoM02", $mesReporteEstadoM02);
            $this->session->set_userdata("estadoReporteEstadoM02", $estadoReporteEstadoM02);
            $this->session->set_userdata("fechaReporteEstadoM02", $fechaReporteEstadoM02);
            $this->session->set_userdata("idcompradorOrigen", $idcompradorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM02", $departamentalReporteEstadoM02);
            $this->session->set_userdata("ordenReporteEstadoM02", $ordenReporteEstadoM02);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if(strlen($departamentalReporteEstadoM02) == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "Debe seleccionar una oficina departamental");
            $this->session->set_userdata("gestionReporteEstadoM02", $gestionReporteEstadoM02);
            $this->session->set_userdata("mesReporteEstadoM02", $mesReporteEstadoM02);
            $this->session->set_userdata("estadoReporteEstadoM02", $estadoReporteEstadoM02);
            $this->session->set_userdata("fechaReporteEstadoM02", $fechaReporteEstadoM02);
            $this->session->set_userdata("idcompradorOrigen", $idcompradorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM02", $departamentalReporteEstadoM02);
            $this->session->set_userdata("ordenReporteEstadoM02", $ordenReporteEstadoM02);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if($mesReporteEstadoM02 == 1) { $mesLiteral = "ENERO"; }
        if($mesReporteEstadoM02 == 2) { $mesLiteral = "FEBRERO"; }
        if($mesReporteEstadoM02 == 3) { $mesLiteral = "MARZO"; }
        if($mesReporteEstadoM02 == 4) { $mesLiteral = "ABRIL"; }
        if($mesReporteEstadoM02 == 5) { $mesLiteral = "MAYO"; }
        if($mesReporteEstadoM02 == 6) { $mesLiteral = "JUNIO"; }
        if($mesReporteEstadoM02 == 7) { $mesLiteral = "JULIO"; }
        if($mesReporteEstadoM02 == 8) { $mesLiteral = "AGOSTO"; }
        if($mesReporteEstadoM02 == 9) { $mesLiteral = "SEPTIEMBRE"; }
        if($mesReporteEstadoM02 == 10) { $mesLiteral = "OCTUBRE"; }
        if($mesReporteEstadoM02 == 11) { $mesLiteral = "NOVIEMBRE"; }
        if($mesReporteEstadoM02 == 12) { $mesLiteral = "DICIEMBRE"; }
        
        if($fechaReporteEstadoM02 == "fechatransaccion") { $fechaSalida = "Por fecha de transaccion"; }
        if($fechaReporteEstadoM02 == "fechaexportacion") { $fechaSalida = "Por fecha de exportacion"; }
        if($fechaReporteEstadoM02 == "fechadeclaracion") { $fechaSalida = "Por fecha de declaracion"; }
        if($fechaReporteEstadoM02 == "fechavalidacion") { $fechaSalida = "Por fecha de validacion"; }
        if($fechaReporteEstadoM02 == "fecharegistro") { $fechaSalida = "Por fecha de registro"; }
        
        $sql = "select id, descripcion ";
        $sql .= "from estadoformulario ";
        $sql .= "where id = ".$estadoReporteEstadoM02."; ";
        $estadoDetalleReporteEstadoM02 = $this->Formm02_model->getDatosTabla($sql, "descripcion");
        
        $comprador = "TODOS LOS COMPRADORES";
        if(strlen($idcompradorOrigen) > 0){
            $sql = "select nombre ";
            $sql .= "from operador ";
            $sql .= "where id = ".$idcompradorOrigen.";";
            $comprador = "COMPRADOR: ".$this->Formm02_model->getDatosTabla($sql, "nombre");
        }
        
        $sql = "select count(*) as total ";
        $sql .= "from formm02 f ";
        $sql .= "join operador o on o.id = f.idcomprador ";
        $sql .= "where f.id > 0 ";
        $sql .= "and oficinavalidacion = '".$departamentalReporteEstadoM02."' "; 
        $sql .= "and f.estado = ".$estadoReporteEstadoM02." ";
        if(strlen($idcompradorOrigen) > 0){ $sql .= "and o.id = ".$idcompradorOrigen." "; }
        $sql .= "and date_part('year', ".$fechaReporteEstadoM02.") = ".$gestionReporteEstadoM02." ";
        $sql .= "and date_part('month', ".$fechaReporteEstadoM02.") = ".$mesReporteEstadoM02." ";
        $total = $this->Formm02_model->getDatosTabla($sql, "total");
        
        if($total == 0){
            $this->session->set_userdata("errorReporteEstadoM02", "No existe datos");
            $this->session->set_userdata("gestionReporteEstadoM02", $gestionReporteEstadoM02);
            $this->session->set_userdata("mesReporteEstadoM02", $mesReporteEstadoM02);
            $this->session->set_userdata("estadoReporteEstadoM02", $estadoReporteEstadoM02);
            $this->session->set_userdata("fechaReporteEstadoM02", $fechaReporteEstadoM02);
            $this->session->set_userdata("idcompradorOrigen", $idcompradorOrigen);
            $this->session->set_userdata("departamentalReporteEstadoM02", $departamentalReporteEstadoM02);
            $this->session->set_userdata("ordenReporteEstadoM02", $ordenReporteEstadoM02);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if($botonReporteEstadoM02 == "pdf"){
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
            $html .= '          <th style="text-align: center" width="760"><br/><br/>SERVICIO NACIONAL DE REGISTRO Y CONTROL DE LA COMERCIALIZACION DE MINERALES Y METALES<br/><i><strong><h2>REPORTE DE FORMULARIO M-02</h2></strong></i><br/><strong><h3><center>DEPARTAMENTAL: '.$departamentalReporteEstadoM02.'     ESTADO: '.$estadoDetalleReporteEstadoM02.'     '.$comprador.'<br/>'.$fechaSalida.'  '.'       Total de registros: '.$total.'</center></h3></strong><h3>Gestion: '.$gestionReporteEstadoM02.' Mes: '.$mesLiteral.'</h3></th>';
            $html .= '          <th style="text-align: center" width="110"><br/><br/><br/><img src="'.base_url()."assets/images/isologo-para-hojas-de-ruta.png".'" WIDTH="60" HEIGHT="60" alt="Smiley face" align="middle"></th>';
            $html .= '      </tr>';
            $html .= '  </thead>';
            $html .= '</table>';
            $html .= '<br/><br/>';
            $formularios = $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02);

            $html .= '<table border="1">';
            $html .= '  <thead>';
            $html .= '      <tr>';
            $html .= '          <th style="text-align: center" width="20"><i>No.</i></th>';
            $html .= '          <th style="text-align: center" width="40"><i>ID</i></th>';
            $html .= '          <th style="text-align: center" width="70"><i>FECHA VALIDACION</i></th>';
            $html .= '          <th style="text-align: center" width="110"><i>CODIGO</i></th>';
            $html .= '          <th style="text-align: center" width="310"><i>RAZON SOCIAL COMPRADOR</i></th>';
            $html .= '          <th style="text-align: center" width="320"><i>RAZON SOCIAL VENDEDOR</i></th>';
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
                $html .= '    <td style="text-align: left" width="310"><i>'.$recep->comprador.'</i></td>';
                $html .= '    <td style="text-align: left" width="320"><i>'.$recep->razonsocialvendedor.'</i></td>';
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
        
        if($botonReporteEstadoM02 == "excel"){
            $formularios = $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02);
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
                $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'ID M-02');
                $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'FECHA VALIDACION');
                $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'CODIGO');
                $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'COMPRADOR');
                $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'VENDEDOR');
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
                    
                    //Informacion de las filas de la consulta.
                    $this->excel->getActiveSheet()->setCellValue("A{$contador}", $contador-1);
                    $this->excel->getActiveSheet()->setCellValue("B{$contador}", $f->id);
                    $this->excel->getActiveSheet()->setCellValue("C{$contador}", $f->fechavalidacion);
                    $this->excel->getActiveSheet()->setCellValue("D{$contador}", $f->codigo);
                    $this->excel->getActiveSheet()->setCellValue("E{$contador}", $f->comprador1);
                    $this->excel->getActiveSheet()->setCellValue("F{$contador}", $f->razonsocialvendedor1);
                    $this->excel->getActiveSheet()->setCellValue("G{$contador}", $f->codigovalidador);
                }
                
                //Le ponemos un nombre al archivo que se va a generar.
                //$archivo = "FORMULARIO_{$gestionReporteEstadoM02}.xls";
                $archivo = "FORMULARIO_M02.xls";
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
