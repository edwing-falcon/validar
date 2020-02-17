<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reporteEstadoExcel extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
    }
    
    public function index(){
        $gestionReporteEstadoM02 = $this->session->userdata("gestionReporteEstadoM02");
        $mesReporteEstadoM02 = $this->session->userdata("mesReporteEstadoM02");
        $estadoReporteEstadoM02 = $this->session->userdata("estadoReporteEstadoM02");
        $idcompradorOrigen = $this->session->userdata("idcompradorOrigen");
        $fechaReporteEstadoM02 = $this->session->userdata("fechaReporteEstadoM02"); 
        $departamentalReporteEstadoM02 = $this->session->userdata("departamentalReporteEstadoM02");
        $ordenReporteEstadoM02 = $this->session->userdata("ordenReporteEstadoM02");
        
        $data1  = array(
            'datos' => $this->Formm02_model->contador()
        );
        
        $data = array(
            'gestionReporteEstadoM02s' => $gestionReporteEstadoM02,
            'mesReporteEstadoM02s' => $mesReporteEstadoM02,
            'mesliterals' => $this->Formm02_model->getMesLiteral($mesReporteEstadoM02),
            '$estadoReporteEstadoM02' => $this->Formm02_model->getMesLiteral($mesReporteEstadoM02),
            'formularios' => $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02)
        );
        
        $this->load->view("layouts/header", $data1);
        $this->load->view("layouts/aside");
        $this->load->view("formm02/V_reporteM02Excel",$data);
        $this->load->view("layouts/footer");
    }
    
    public function action(){
        $this->load->library("Excel");
        $object = new PHPExcel();
        
        $object->setActiveSheetIndex(0);
        $table_columns = array("ID M-02", "CODIGO", "FECHA TRANSACCION", "FECHA DECLARACION", "FECHA VALIDACION", "FECHA REGISTRO", "COMPRADOR", "RAZON SOCIAL VENDEDOR", "CODIGO VALIDADOR");
        
        $column = 0;
        
        foreach($table_columns as $field){
           $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
           $column++;
        }
                  
        $gestionReporteEstadoM02 = $this->session->userdata("gestionReporteEstadoM02");
        $mesReporteEstadoM02 = $this->session->userdata("mesReporteEstadoM02");
        $estadoReporteEstadoM02 = $this->session->userdata("estadoReporteEstadoM02");
        $idcompradorOrigen = $this->session->userdata("idcompradorOrigen");
        $fechaReporteEstadoM02 = $this->session->userdata("fechaReporteEstadoM02"); 
        $departamentalReporteEstadoM02 = $this->session->userdata("departamentalReporteEstadoM02");
        $ordenReporteEstadoM02 = $this->session->userdata("ordenReporteEstadoM02");
        
        $aux = "gestionReporteEstadoM02 = ".$gestionReporteEstadoM02."<br/>";
        $aux .= "mesReporteEstadoM02 = ".$mesReporteEstadoM02."<br/>";
        $aux .= "estadoReporteEstadoM02 = ".$estadoReporteEstadoM02."<br/>";
        $aux .= "idcompradorOrigen = ".$idcompradorOrigen."<br/>";
        $aux .= "fechaReporteEstadoM02 = ".$fechaReporteEstadoM02."<br/>";
        $aux .= "departamentalReporteEstadoM02 = ".$departamentalReporteEstadoM02."<br/>";
        $aux .= "ordenReporteEstadoM02 = ".$ordenReporteEstadoM02."<br/>";
        //$this->output->set_output($aux);

        $formularios = $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02);
        $excel_row = 2;
            
        foreach($formularios as $row){
           $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->id);
           $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->codigo);
           $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->fechatransaccion);
           $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->fechadeclaracion);
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->fechavalidacion);
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->fecharegistro);
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->comprador);
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->razonsocialvendedor);
           $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->codigovalidador);
           $excel_row++;
        }
        
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="Employee Data.xls"');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="Employee Data.xls"');
        $object_writer->save('php://output');
    }
    
    public function generar_excel(){
        $gestionReporteEstadoM02 = $this->session->userdata("gestionReporteEstadoM02");
        $mesReporteEstadoM02 = $this->session->userdata("mesReporteEstadoM02");
        $estadoReporteEstadoM02 = $this->session->userdata("estadoReporteEstadoM02");
        $idcompradorOrigen = $this->session->userdata("idcompradorOrigen");
        $fechaReporteEstadoM02 = $this->session->userdata("fechaReporteEstadoM02"); 
        $departamentalReporteEstadoM02 = $this->session->userdata("departamentalReporteEstadoM02");
        $ordenReporteEstadoM02 = $this->session->userdata("ordenReporteEstadoM02");
        
        $aux = "gestionReporteEstadoM02 = ".$gestionReporteEstadoM02."<br/>";
        $aux .= "mesReporteEstadoM02 = ".$mesReporteEstadoM02."<br/>";
        $aux .= "estadoReporteEstadoM02 = ".$estadoReporteEstadoM02."<br/>";
        $aux .= "idcompradorOrigen = ".$idcompradorOrigen."<br/>";
        $aux .= "fechaReporteEstadoM02 = ".$fechaReporteEstadoM02."<br/>";
        $aux .= "departamentalReporteEstadoM02 = ".$departamentalReporteEstadoM02."<br/>";
        $aux .= "ordenReporteEstadoM02 = ".$ordenReporteEstadoM02."<br/>";
        //$this->output->set_output($aux);
                
        //Cargamos la librería de excel.
        $this->load->library('excel'); 
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('SALUDO');
        
        //Contador de filas
        $contador = 1;
        
        //Le aplicamos ancho las columnas.
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(100);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(100);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(100);
        $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(100);
        $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(100);
        
        //Le aplicamos negrita a los títulos de la cabecera.
        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
        
        //Definimos los títulos de la cabecera.
        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'ID M-02');
        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'CODIGO');
        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'FECHA TRANSACCION');
        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'FECHA DECLARACION');
        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'FECHA VALIDACION');
        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'FECHA REGISTRO');
        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'COMPRADOR');
        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'RAZON SOCIAL VENDEDOR');
        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'CODIGO VALIDADOR');
        
        $formularios = $this->Formm02_model->getFormm02ReporteM02($gestionReporteEstadoM02, $mesReporteEstadoM02, $estadoReporteEstadoM02, $idcompradorOrigen, $fechaReporteEstadoM02, $departamentalReporteEstadoM02, $ordenReporteEstadoM02);
        
        //Definimos la data del cuerpo.        
        foreach($formularios as $f){
           //Incrementamos una fila más, para ir a la siguiente.
           $contador++;
           //Informacion de las filas de la consulta.
           $this->excel->getActiveSheet()->setCellValue("A{$contador}", $f->id);
           $this->excel->getActiveSheet()->setCellValue("B{$contador}", $f->codigo);
           $this->excel->getActiveSheet()->setCellValue("C{$contador}", $f->fechatransaccion);
           $this->excel->getActiveSheet()->setCellValue("D{$contador}", $f->fechadeclaracion);
           $this->excel->getActiveSheet()->setCellValue("E{$contador}", $f->fechavalidacion);
           $this->excel->getActiveSheet()->setCellValue("F{$contador}", $f->fecharegistro);
           $this->excel->getActiveSheet()->setCellValue("G{$contador}", $f->comprador);
           $this->excel->getActiveSheet()->setCellValue("H{$contador}", $f->razonsocialvendedor);
           $this->excel->getActiveSheet()->setCellValue("I{$contador}", $f->codigovalidador);
        }
        
        //Le ponemos un nombre al archivo que se va a generar.
        $archivo = "archivo_{$gestionReporteEstadoM02}.xlsx";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$archivo.'"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //Hacemos una salida al navegador con el archivo Excel.
        $objWriter->save('php://output');
    }

}

