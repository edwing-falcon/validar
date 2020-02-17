<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reportesM02Ver extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $lugar = $this->session->userdata("lugar");
        $fecha = $this->Formm02_model->getFechaActual();
        
        /*$this->session->unset_userdata('errorReporteEstadoM02');
        $this->session->unset_userdata('feciniReporteEstadoM02');
        $this->session->unset_userdata('fecfinReporteEstadoM02');*/
        $this->session->set_userdata("estadoReporteEstadoM02", "VALIDADO");
        
        $data = array(
            'fechasActuales' => $fecha,
            'lugares' => $lugar,
            'estados' => $this->Formm02_model->getEstados(),
            'gestiones' => $this->Formm02_model->getGestiones()
        );
        
        $data1 = array(
            'datos' => $this->Formm02_model->contador()
        );
        
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
    
    public function rerporte(){
        $controlSession = $this->Formm02_model->controlSession();
        
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Israel Parra');
        $pdf->SetTitle('Ejemplo de provincías con TCPDF');
        $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

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
        $pdf->SetFont('freemono', '', 14, '', true);

        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        // Fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        
        // Establecemos el contenido para imprimir
        $fecini = $this->input->post('feciniReporteEstadoM02');
        $fecfin = $this->input->post('fecfinReporteEstadoM02');
        $estado = $this->input->post('estadoReporteEstadoM02');
        
        $fecini = trim($fecini);
        $fecfin = trim($fecfin);
        $estado = trim($estado);
        
        $anioini = substr($fecini, 0, 4);
        $aniofin = substr($fecfin, 0, 4);
        
        if($anioini <> $aniofin){
            $this->session->set_userdata("errorReporteEstadoM02", "No se puede generar un reporte de dos gestiones diferentes");
            $this->session->set_userdata("feciniReporteEstadoM02", $fecini);
            $this->session->set_userdata("fecfinReporteEstadoM02", $fecfin);
            $this->session->set_userdata("estadoReporteEstadoM02", $estado);
            
            redirect(base_url()."C_reportesM02");
        }
        
        if($fecfin < $fecini){
            $this->session->set_userdata("errorReporteEstadoM02", "La fecha final no puede ser menor que la fecha inicial");
            $this->session->set_userdata("feciniReporteEstadoM02", $fecini);
            $this->session->set_userdata("fecfinReporteEstadoM02", $fecfin);
            $this->session->set_userdata("estadoReporteEstadoM02", $estado);
            
            redirect(base_url()."C_reportesM02");
        }
        
        $formm02 = $this->Formm02_model->getForm02Estado($estado, $fecini, $fecfin);
        
        $aux = "fecini=".$fecini." /fecfin=".$fecfin." /estado=".$estado." /anioini=".$anioini." /aniofin=".$aniofin;
        $this->output->set_output($aux);
        
        $this->session->unset_userdata('errorReporteEstadoM02');
        $this->session->unset_userdata('feciniReporteEstadoM02');
        $this->session->unset_userdata('fecfinReporteEstadoM02');
        $this->session->unset_userdata('estadoReporteEstadoM02');
        
        redirect(base_url()."C_reportesM02");
    } 
    
}


?>
