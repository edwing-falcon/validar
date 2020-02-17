<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_principal extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("Formm02_model");
          $this->load->model("ReporteGrafico_model");
          
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

//    public function index(){
//        $data1  = array(
//            'datos' => $this->Formm02_model->contador()
//        );
//        $this->load->view("layouts/header", $data1);
//        $this->load->view("layouts/aside");
//        $this->load->view("admin/V_principal", $data);
//        $this->load->view("layouts/footer");
//    }
    
    function convertirJson($consolid){
             $dato='';
             $dato1='';
             $anterior =$consolid[0]->departamento;
            foreach ($consolid AS $tablas)
            {
                if ( $tablas->departamento != $anterior){
                     $dato=$dato.',{"departamento":'.'"'.$anterior.'"'. $dato1 .'}';
                     $anterior= $tablas->departamento;
                     $dato1=',"'.$tablas->estado.'": '. $tablas->cantidad;
                } else {
                      $dato1=$dato1.',"'.$tablas->estado. '":'.$tablas->cantidad;
                }
            }  
            $dato=$dato.',{"departamento":'.'"'.$anterior.'"'. $dato1 .'}';
            $cad = substr ($dato, 0, strlen($dato) - 1);
            $cad = substr ($dato,1);
            $a='['. $cad.']';
           // echo $a;
            return $a;
    }
            
    function convertirJson2($consolid){
         $dato='';
        $dato1='';
        $anterior =$consolid[0]->nombremes;
       foreach ($consolid AS $tablas)
       {   if ( $tablas->nombremes != $anterior){
                $dato=$dato.',{"nombremes":'.'"'.$anterior.'"'. $dato1 .'}';
                $anterior= $tablas->nombremes;
                $dato1= ',"'.$tablas->estado.'": '. $tablas->cantidad;
           } else {
                     $dato1=$dato1.',"'.$tablas->estado.'": '. $tablas->cantidad;
           } 
       }
       $dato=$dato.',{"nombremes":'.'"'.$anterior.'"'. $dato1 .'}';
        $cad = substr ($dato, 0, strlen($dato) - 1);
         $cad = substr ($dato,1);
         $a='['. $cad.']';
         //echo $a;
         return $a;
    }
    
    function convertirJson3($consolid){
         $dato='';
             $dato1='';
             $anterior =$consolid[0]->codigovalidador;
            foreach ($consolid AS $tablas)
            {
                if ( $tablas->codigovalidador != $anterior){
                     $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
                     $anterior= $tablas->codigovalidador;
                     $dato1=',"'.$tablas->descripcionestado.'": '. $tablas->cantidad;
                } else {
                    //$dato=$dato.',{"estado":'.'"'.$tablas->descripcion. $tablas->departamento.'","total":'.$tablas->cantidad.',"color":"'.$color[$i]->color.'"}';
                    //$dato1=$dato1.',{"estado":'.'"'.$tablas->estado. $tablas->departamento.'","cantidad":'.$tablas->cantidad.'}';
                    $dato1=$dato1.',"'.$tablas->descripcionestado. '":'.$tablas->cantidad;
                }
            }  
             $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
             $cad = substr ($dato, 0, strlen($dato) - 1);
         $cad = substr ($dato,1);
         $a='['. $cad.']';
        // echo $a;
         return $a;
    }
    
    function convertirJson4($consolid){
          $dato='';
             $dato1='';
             $anterior =$consolid[0]->codigovalidador2;
            foreach ($consolid AS $tablas)
            {
                if ( $tablas->codigovalidador2 != $anterior){
                     $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
                     $anterior= $tablas->codigovalidador2;
                      $dato1= ',"'.$tablas->descripcionestado.'": '. $tablas->cantidad;
                } else {
                    //$dato=$dato.',{"estado":'.'"'.$tablas->descripcion. $tablas->departamento.'","total":'.$tablas->cantidad.',"color":"'.$color[$i]->color.'"}';
                    //$dato1=$dato1.',{"estado":'.'"'.$tablas->estado. $tablas->departamento.'","cantidad":'.$tablas->cantidad.'}';
                    $dato1=$dato1.',"'.$tablas->descripcionestado. '":'.$tablas->cantidad;
                }
            }  
             $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
             //echo $dato;
              $cad = substr ($dato, 0, strlen($dato) - 1);
         $cad = substr ($dato,1);
         $a='['. $cad.']';
         //echo $a;
         return $a;
    }
   
    public function index(){
            $data1  = array(
                'datos' => $this->Formm02_model->contador()
            );
            $idrol = $this->session->userdata("idrol");
            $login = $this->session->userdata("login");
            $departamento = $this->session->userdata("lugarCompleto")->idlugar;
            $data['departamento'] = $this->session->userdata("lugarCompleto")->lugar;
            $gestion = 2019;
            $data['gestion']      = $gestion; 
            
            // ***** USUARIO GERENCIAL O EXTERNO **********************//
            if($idrol == 14 || $idrol == 3)
            {
                 $temp = $this->ReporteGrafico_model->datosParaCuadroNacionalOnLine($gestion,'formm02');
                 $data['cuadroDataM02']   = $temp;
                 $data['chartDataM02']    = $this->convertirJson($temp);// $this->datosParaGrafico($departamento,$gestion,$idrol); 
                 
                 $dptos                = $this->ReporteGrafico_model->departamentoActivos();
                 $i=1;
                 foreach ($dptos as $dpto)
                 {
                    $data['departamento_' . $i] = $dpto->descripcion;
                    $temp                       = $this->ReporteGrafico_model->estadoPorMesPorDpto($dpto->id, $gestion,'M-02');//$this->datosParaGrafico($dpto->id,$gestion); 
                     if (count ($temp) > 0) {
                        $data['chartData_'. $i]     = $this->convertirJson2($temp);
                        $data['cuadroData_'. $i]    = $this->ReporteGrafico_model->datosParaCuadro($dpto->id, $gestion,'M-02');
                        $i++;
                     }
                   
                 }
                 // M03
   
                 $temp = $this->ReporteGrafico_model->datosParaCuadroNacionalOnLine($gestion,'formm03');
                 $data['cuadroDataM03']   = $temp;
                 $data['chartDataM03']    = $this->convertirJson($temp);// $this->datosParaGrafico($departamento,$gestion,$idrol); 
                 
                 
                 //****** VALIDADORES ************************
                 $data['gestion5']      = $gestion;
                 $temp                  = $this->ReporteGrafico_model->validadorPorGestion($gestion , 'formm02');// $this->validadorParaGraficoAcumulado($departamento,$gestion,$idrol); 
                 $data['chartDataVM02']    = $this->convertirJson4($temp);
                 $data['cuadroDataVM02']   = $temp;
                 
                 $temp                     = $this->ReporteGrafico_model->validadorPorGestion($gestion, 'formm03');// $this->validadorParaGraficoAcumulado($departamento,$gestion,$idrol); 
                 $data['chartDataVM03']    = $this->convertirJson4($temp);
                 $data['cuadroDataVM03']   = $temp;
                 
                $dato='';
                $dato1='';
                $i=1;
                 $validadores                 = $this->ReporteGrafico_model->validadorIndividualAcumulado($gestion);
                 $anterior =$validadores[0]->codigovalidador2;
                 foreach ($validadores as $tablas)
                 {
                     if ( $tablas->codigovalidador2 != $anterior){
                        $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
                        $cad = substr ($dato, 0, strlen($dato) - 1);
                        $cad = substr ($dato,1);
                        $a='['. $cad.']';
                        //echo $a;
                        $data['chartDataV_' . $i++]    = $a;
                        $anterior= $tablas->codigovalidador2;
                        $dato1= ',"'.$tablas->descripcionestado2.'": '. $tablas->cantidad;
                        $dato='';
                         
                    } else {
                         $dato1=$dato1.',"'.$tablas->descripcionestado2. '":'.$tablas->cantidad;
                    }
                 }
                $dato=$dato.',{"codigovalidador":'.'"'.$anterior.'"'. $dato1 .'}';
                $cad = substr ($dato, 0, strlen($dato) - 1);
                $cad = substr ($dato,1);
                $a='['. $cad.']';
                $data['chartDataV_' . $i++]    = $a;
     
                 
                 
                 $data['totalM02']   = $this->ReporteGrafico_model->totalValidadores($gestion, 'formm02');
                 $data['totalM03']   = $this->ReporteGrafico_model->totalValidadores($gestion, 'formm03');
            // ***** DEPARTAMENTAL **********************// 
                 //15)
            } elseif ($idrol == 15) {
                
                $data['departamento'] = $this->session->userdata("lugarCompleto")->lugar;
                // actual acumulado
                 $temp = $this->ReporteGrafico_model->datosCuadroNacionalOnLineDpto($gestion,'formm02',$departamento);
                 $data['chartAcumuladoM02']    = $this->convertirJson($temp);// $this->datosParaGrafico($departamento,$gestion,$idrol); 
                 
                 $temp = $this->ReporteGrafico_model->datosCuadroNacionalOnLineDpto($gestion,'formm03',$departamento);
                 $data['chartAcumuladoM03']    = $this->convertirJson($temp);// $this->datosParaGrafico($departamento,$gestion,$idrol); 
                 
                // actual por mes
//                $temp                 = $this->ReporteGrafico_model->estadoPorMesPorDptoOnLine($departamento, $gestion, 'formm02');//$this->datosParaGrafico($departamento,$gestion); 
//                $data['chartDataM02']    = $this->convertirJson2($temp);
//                $data['cuadroDataM02']   = $this->ReporteGrafico_model->datosParaCuadroOnLine($departamento,$gestion, 'formm02');
//                
//
//                $temp                 = $this->ReporteGrafico_model->estadoPorMesPorDptoOnLine($departamento, $gestion, 'formm03');//$this->datosParaGrafico($departamento,$gestion); 
//                $data['chartDataM03']    = $this->convertirJson2($temp);
//                $data['cuadroDataM03']   = $this->ReporteGrafico_model->datosParaCuadroOnLine($departamento,$gestion, 'formm03');
                
                // historico
                $temp                 = $this->ReporteGrafico_model->estadoPorMesPorDpto($departamento, $gestion, 'M-02');//$this->datosParaGrafico($departamento,$gestion); 
                $data['chartDataH_M02']    = $this->convertirJson2($temp);
                $data['cuadroDataH_M02']   = $this->ReporteGrafico_model->datosParaCuadro($departamento,$gestion, 'M-02');
                
                $temp                 = $this->ReporteGrafico_model->estadoPorMesPorDpto($departamento, $gestion, 'M-03');//$this->datosParaGrafico($departamento,$gestion); 
                $data['chartDataH_M03']    = $this->convertirJson2($temp);
                $data['cuadroDataH_M03']   = $this->ReporteGrafico_model->datosParaCuadro($departamento,$gestion, 'M-03');
                
                // *** validadores
                $temp = $this->ReporteGrafico_model->validadorPorDpto($departamento,$gestion);
                $data['chartDataV']    = $this->convertirJson3($temp);
                $data['cuadroDataV']   = $temp;
                $meses = $this->ReporteGrafico_model->meses();
                foreach ($meses as $mes)
                 {
                    $data['mes'.$mes->id]          = $mes->nombre;
                    $data['gestion'.$mes->id]      = $gestion; 
                    // esta funcion saca todos los validadores a nivel nacional
                    $temp                          =  $this->ReporteGrafico_model->validadorPorMesPorDpto($departamento, $gestion, $mes->id);// $this->validadorParaGrafico($departamento,$gestion,$mes->id); 
                    if (count ($temp) > 0) {
                        $data['chartData'.$mes->id]    = $this->convertirJson3($temp);
                        $data['cuadroData'.$mes->id]   = $temp; 
                    }
                   
                 }
            }
            
            $this->load->view("layouts/header", $data1);
            $this->load->view("layouts/aside");

            if ( ($idrol == 14 || $idrol == 3 )  && $login == true)
             {
                 $this->load->view("admin/reporteGerencial", $data); // limpio

            } elseif ($idrol == 15 && $login == true) 
             {
                $this->load->view("admin/reporteRegional", $data); //esta bien ultimo limpio
    
            } else {
                $this->load->view("admin/V_principal", $data); // reporte3
            }
            $this->load->view("layouts/footer");
    }
     
     
     
}
