<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_muestreoReliquidacion extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("Formm03_model");
        $this->load->library('excel');
    }
    
    public function index($nropagina = FALSE){
        $inicio = 0;
        $mostrarpor = 20; 
        $idMuestreoReliquidacion = "";
        $codigoMuestreoReliquidacion1 = "";
	$codigoMuestreoReliquidacion2 = "";
        $exportadorMuestreoReliquidacion = "";
        
        $controlSession = $this->Formm03_model->controlSession();
        
        if ($this->session->userdata("cantidad")){
            $mostrarpor =  $this->session->userdata("cantidad");
        }
        
        if ($this->session->userdata("idMuestreoReliquidacion")){
            $idMuestreoReliquidacion = $this->session->userdata("idMuestreoReliquidacion");
        }
        
        if ($this->session->userdata("codigoMuestreoReliquidacion1")){
            $codigoMuestreoReliquidacion1 = $this->session->userdata("codigoMuestreoReliquidacion1");
        }
        
	if ($this->session->userdata("codigoMuestreoReliquidacion2")){
            $codigoMuestreoReliquidacion2 = $this->session->userdata("codigoMuestreoReliquidacion2");
        }
		
        if ($this->session->userdata("exportadorMuestreoReliquidacion")){
            $exportadorMuestreoReliquidacion = $this->session->userdata("exportadorMuestreoReliquidacion");
        }
        
        if ($nropagina){
            $inicio = ($nropagina - 1) * $mostrarpor;
        }
        
        $this->Formm03_model->depurarM03();
        $this->load->library('pagination');
        
        $config['base_url'] = base_url()."C_muestreoReliquidacion/pagina/";
        $conta = $this->Formm03_model->getTotalMuestreoReliquidacion($idMuestreoReliquidacion, $codigoMuestreoReliquidacion1, $codigoMuestreoReliquidacion2, $exportadorMuestreoReliquidacion);
        $config['total_rows'] = $conta;
        $cant = $conta;
        $config['per_page'] = $mostrarpor; 
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['first_url'] = base_url()."C_muestreoReliquidacion";

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
        
        $lugar = $this->session->userdata("lugar");
        
        if(strlen($idMuestreoReliquidacion) > 0){
            $Error = 0;
            
            // Es otra oficina validacion 
            $sql = "select oficinavalidacion from formm03 where id = ".$idMuestreoReliquidacion."; ";
            $ofivalidacion = $this->Formm03_model->getDatosTabla($sql, "oficinavalidacion");
            if($ofivalidacion <> $lugar){
                $this->session->set_userdata("error", "El formulario M-03 es de la departamental ".$ofivalidacion);
                $Error = 1;
            }
                    
            if($Error == 0){
                // Estado no validado 
                $sql = "select f.estado as numeral, ef.descripcion as literal ";
                $sql .= "from formm03 f ";
                $sql .= "join estadoformulario ef on ef.id = f.estado ";
                $sql .= "where f.id = ".$idMuestreoReliquidacion." ";
                $sql .= "and oficinavalidacion = '".$lugar."'; ";
                $estado = $this->Formm03_model->getDatosTabla($sql, "numeral");
                $estadoLiteral = $this->Formm03_model->getDatosTabla($sql, "literal");
                $estado = trim($estado);
                if($estado <> 2){
                    if($estado <> 3){
                        $this->session->set_userdata("error", "El formulario M-03 con ID: ".$idMuestreoReliquidacion." su estado es ".$estadoLiteral);
                        $Error = 1;
                    }
                }
            }
            
            if($Error == 0){
                // Busqueda de Mineral en cri_mineral
                $sql = "select count(idmineral) as total ";
                $sql .= "from formm03calculorm fc ";
                $sql .= "where idformm03 = ".$idMuestreoReliquidacion." ";
                $sql .= "and fc.idmineral in (select idmineral from cri_mineral); ";
                
                $aux10 = $this->Formm03_model->getDatosTabla($sql, "total");
                $aux10 = trim($aux10);
                if($aux10 == 0){
                    $sql = "select mineralesformm03calculorm(id) minerales from formm03 where id = ".$idMuestreoReliquidacion."; ";
                    $aux11 = $this->Formm03_model->getDatosTabla($sql, "minerales");
                    $this->session->set_userdata("error", "El formulario M-03 con ID: ".$idMuestreoReliquidacion." tiene registrados mineral: ".$aux11." no cumplen los criterios de reliquidacion por mineral");
                    $Error = 1;
                }
            }
            
            if($Error == 0){
                // El formulario esta reliquidado o esta pendiente
                $sql = "select estadosreliquidacion(".$idMuestreoReliquidacion.") estadosreliquidados; ";
                $aux11 = $this->Formm03_model->getDatosTabla($sql, "estadosreliquidados");
                $aux11 = trim($aux11);
                if(strlen($aux11) > 0){
                    $this->session->set_userdata("error", "El formulario M-03 con ID: ".$idMuestreoReliquidacion." tiene: ".$aux11." ");
                    $Error = 1;
                }
            }   
        }
        
        $data = array(
            'reliquidaciones' => $this->Formm03_model->getMuestreoReliquidacion($idMuestreoReliquidacion, $codigoMuestreoReliquidacion1, $codigoMuestreoReliquidacion2, $exportadorMuestreoReliquidacion, $inicio, $mostrarpor),
            'cants' => $cant
        ); 
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion",$data);
        $this->load->view("layouts/footer");
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
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_concluido3_ver", $data);
        $this->load->view("layouts/footer");
    }
    
    public function mostrar(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $this->session->unset_userdata('idMuestreoReliquidacion');
        $this->session->unset_userdata('codigoMuestreoReliquidacion1');
	$this->session->unset_userdata('codigoMuestreoReliquidacion2');
        $this->session->unset_userdata('exportadorMuestreoReliquidacion');
        redirect(base_url()."C_muestreoReliquidacion");
    }
    
    public function busqueda(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idMuestreoReliquidacion = $this->input->post("idMuestreoReliquidacion");
        $codigoMuestreoReliquidacion1 = $this->input->post("codigoMuestreoReliquidacion1");
	$codigoMuestreoReliquidacion2 = $this->input->post("codigoMuestreoReliquidacion2");
        $exportadorMuestreoReliquidacion = $this->input->post("exportadorMuestreoReliquidacion");
        
        $idMuestreoReliquidacion = trim($idMuestreoReliquidacion);
        $codigoMuestreoReliquidacion1 = strtoupper(trim($codigoMuestreoReliquidacion1));
	$codigoMuestreoReliquidacion2 = strtoupper(trim($codigoMuestreoReliquidacion2));
        $exportadorMuestreoReliquidacion = strtoupper(trim($exportadorMuestreoReliquidacion));
        
        if(is_numeric($idMuestreoReliquidacion) == false){ $idMuestreoReliquidacion = 0; }
        
        $this->session->set_userdata("idMuestreoReliquidacion", $idMuestreoReliquidacion);
        $this->session->set_userdata("codigoMuestreoReliquidacion1", $codigoMuestreoReliquidacion1);
	$this->session->set_userdata("codigoMuestreoReliquidacion2", $codigoMuestreoReliquidacion2);
        $this->session->set_userdata("exportadorMuestreoReliquidacion", $exportadorMuestreoReliquidacion);
        redirect(base_url()."C_muestreoReliquidacion");
    }
    
    public function importarExcel(){
     $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidarleyhumedad_aceptar", $data);
        $this->load->view("layouts/footer");   
    }

    /*public function reliquidarLeyHumedad($entrada) {
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $codigo = $this->Formm03_model->getCodigo($idformm03);
        $fechaActual = $this->Formm03_model->getFechaActual();
        $lugar = $this->session->userdata("lugar");
        $usuario = $this->session->userdata("usuario"); 
        
        $sql = "select id, fechamuestra, fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion, fechavalidacion + 2 as fechavencimientohumedad, fechavalidacion + 30 as fechavencimientoley, idpresentacionproducto, pbh, case when humedad is null then 0 else humedad end as humedad ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
        
        $fechamuestra = $this->Formm03_model->getDatosTabla($sql, "fechamuestra");
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        $fechavencimientohumedad = $this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad"); 
        $fechavencimientoley = $this->Formm03_model->getDatosTabla($sql, "fechavencimientoley"); 
        $idpresentacionproducto = $this->Formm03_model->getDatosTabla($sql, "idpresentacionproducto"); 
        $humedadDeclarada = $this->Formm03_model->getDatosTabla($sql, "humedad");
        
        $fechaenviomuestra = trim($fechaenviomuestra);
        $codigoenviomuestra = trim($codigoenviomuestra);
        $citeenviomuestra = trim($citeenviomuestra);
        $fechavalidacion = trim($fechavalidacion);
        $fechavencimientohumedad = trim($fechavencimientohumedad);
        $fechavencimientoley = trim($fechavencimientoley);
        $idpresentacionproducto = trim($idpresentacionproducto);
        $humedadDeclarada = trim($humedadDeclarada);
        
        if($humedadDeclarada == null){
            $this->session->set_userdata("error", "El M-03 con ID: ".$idformm03." no se puede reliquidar por humedad por que no hay humedad declarada");
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($codigoenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el codigo de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechamuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el cite de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select count(*) total from reliquidacion03 where idformm03 = ".$idformm03." and tiporeliquidacion = 'ley';";
        $sw = $this->Formm03_model->getDatosTabla($sql, "total");
        
        if($sw == 0){
            // No existe el id en reliquidacion03 
            $data = array ( 
                'id'=>$this->Formm03_model->getMayor("reliquidacion03", "id"),
                'idformm03'=>$idformm03,
                'estado'=>0,
                'oficinareliquidacion'=>$lugar,
                'codigoreliquidador'=>$usuario,
                'fechamuestra'=>$fechamuestra,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion,
                'fechareliquidacion'=>$fechaActual,
                'fechavencimientohumedad'=>$fechavencimientohumedad,
                'fechavencimientoley'=>$fechavencimientoley,
                'idpresentacionproducto'=>$idpresentacionproducto,
                'tiporeliquidacion'=>"ley"
            );
            $this->db->insert('reliquidacion03', $data);
            $aux9 = $this->Formm03_model->getreliquidacion03calculorm($idformm03, "ley");
        } else {
            $data = array( 
                'oficinareliquidacion'=>$lugar,
                'fechamuestra'=>$fechamuestra,
                'codigoreliquidador'=>$usuario,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'fechareliquidacion'=>$fechaActual,
                'fechavencimientohumedad'=>$fechavencimientohumedad,
                'fechavencimientoley'=>$fechavencimientoley
            );
            $this->db->where('idformm03', $idformm03);
            $this->db->where('tiporeliquidacion', 'ley');
            $this->db->update('reliquidacion03', $data);
        }
        $this->load->helper('form');
        
        $sql = "select idformm03 id, re.estado estado, oficinareliquidacion, codigoreliquidador, fechareliquidacion, laboratorio, fechainformelaboratorio, numinformelaboratorio, humedad_senarecom, fechavalidacion, fechavencimientohumedad, fechavencimientoley ";
        $sql .= "from reliquidacion03 re ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = 'ley'; ";
        
        if ($this->session->userdata("fechainformelaboratorio")){
            $fechainformelaboratorio = $this->session->userdata("fechainformelaboratorio");
        } else { 
            $fechainformelaboratorio = $this->Formm03_model->getDatosTabla($sql, "fechainformelaboratorio");
        }
        
        if ($this->session->userdata("numinformelaboratorio")){
            $numinformelaboratorio = $this->session->userdata("numinformelaboratorio");
        } else { 
            $numinformelaboratorio = $this->Formm03_model->getDatosTabla($sql, "numinformelaboratorio");
        }
        
        if ($this->session->userdata("humedad_senarecom")){
            $humedad_senarecom = $this->session->userdata("humedad_senarecom");
        } else { 
            $humedad_senarecom = $this->Formm03_model->getDatosTabla($sql, "humedad_senarecom");
        }
        
        $sql1 = "select case when humedad is null then 0 else humedad end as humedad from formm03 where id = ".$idformm03."; ";
        
        $data = array( 
           'ids'=>$idformm03, 
           'codigos'=>$codigo, 
           'fechaActuals'=>$fechaActual,
           'fechaenviomuestras'=>$fechaenviomuestra,
           'codigoenviomuestras'=>$codigoenviomuestra,
           'citeenviomuestras'=>$citeenviomuestra,
           'formm03'=>$this->Formm03_model->getDatosTransaccion("formm03", $idformm03),
           'oficinareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "oficinareliquidacion"),
           'codigoreliquidadors'=>$this->Formm03_model->getDatosTabla($sql, "codigoreliquidador"),
           'fechareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechareliquidacion"),
           'laboratorios'=>$this->Formm03_model->getDatosTabla($sql, "laboratorio"),
           'fechainformelaboratorios'=>$fechainformelaboratorio,
           'numinformelaboratorios'=>$numinformelaboratorio,
           'humedad_senarecoms'=>$humedad_senarecom,
           'humedads'=>$this->Formm03_model->getDatosTabla($sql1, "humedad"),
           'fechavalidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechavalidacion"), 
           'fechavencimientohumedads'=>$this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad"),
           'fechavencimientoleys'=>$this->Formm03_model->getDatosTabla($sql, "fechavencimientoley"),
           'minerales'=>$this->Formm03_model->getMineralesRegistrados($idformm03, "", "ley")
        );
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidarleyhumedad_aceptar", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function reliquidarPeso($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $fechaActual = $this->Formm03_model->getFechaActual();
        $lugar = $this->session->userdata("lugar");
        $usuario = $this->session->userdata("usuario"); 
        
        $sql = "select pns, id, codigoformm03, fechamuestra, fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion, idpresentacionproducto, case when humedad is null then 0 else humedad end as humedad ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
        
        $codigo = $this->Formm03_model->getDatosTabla($sql, "codigoformm03");
        $fechamuestra = $this->Formm03_model->getDatosTabla($sql, "fechamuestra");
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        $idpresentacionproducto = $this->Formm03_model->getDatosTabla($sql, "idpresentacionproducto"); 
        $humedadDeclarada = $this->Formm03_model->getDatosTabla($sql, "humedad");
        $pesonetoseco = $this->Formm03_model->getDatosTabla($sql, "pns");
        
        $fechaenviomuestra = trim($fechaenviomuestra);
        $codigoenviomuestra = trim($codigoenviomuestra);
        $citeenviomuestra = trim($citeenviomuestra);
        $fechavalidacion = trim($fechavalidacion);
        $idpresentacionproducto = trim($idpresentacionproducto);
        $humedadDeclarada = trim($humedadDeclarada);
        $pesonetoseco = trim($pesonetoseco);
        
        if($fechamuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($codigoenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el codigo de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el cite de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select count(*) total from reliquidacion03 where idformm03 = ".$idformm03." and tiporeliquidacion = 'peso';";
        $sw = $this->Formm03_model->getDatosTabla($sql, "total");
        
        if($sw == 0){
            // No existe el id en reliquidacion03 por peso
            
            $data = array ( 
                'id'=>$this->Formm03_model->getMayor("reliquidacion03", "id"),
                'idformm03'=>$idformm03,
                'estado'=>0,
                'oficinareliquidacion'=>$lugar,
                'codigoreliquidador'=>$usuario,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion,
                'fechareliquidacion'=>$fechaActual,
                'idpresentacionproducto'=>$idpresentacionproducto,
                'tiporeliquidacion'=>"peso",
                'humedad_senarecom'=>$humedadDeclarada,
                'humedad'=>$humedadDeclarada,
                'tipopeso'=>'Peso Neto Seco [Kg.]'
            );
            
            $this->db->insert('reliquidacion03', $data);
            $aux9 = $this->Formm03_model->getreliquidacion03calculorm($idformm03, "peso");
        } else {
            if($sw == 0){
                $data = array( 
                    'oficinareliquidacion'=>$lugar,
                    'codigoreliquidador'=>$usuario,
                    'fechaenviomuestra'=>$fechaenviomuestra,
                    'codigoenviomuestra'=>$codigoenviomuestra,
                    'fechavalidacion'=>$fechavalidacion,
                    'fechareliquidacion'=>$fechaActual,
                    'humedad_senarecom'=>$humedadDeclarada,
                    'humedad'=>$humedadDeclarada,
                    'tipopeso'=>'Peso Neto Seco [Kg.]'
                );
                $this->db->where('idformm03', $idformm03); 
                $this->db->where('tiporeliquidacion', 'peso');
                $this->db->update('reliquidacion03', $data);
            }
        }
        
        $this->load->helper('form');
        $sql = "select idformm03 id, re.estado estado, oficinareliquidacion, codigoreliquidador, fechareliquidacion, laboratorio, fechainformelaboratorio, numinformelaboratorio, tipopeso, pn_senarecom, fechavalidacion ";
        $sql .= "from reliquidacion03 re ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = 'peso'; ";

        //$this->output->set_output($aux."<br/><br/>");
        
        if ($this->session->userdata("fechainformelaboratorio")){
            $fechainformelaboratorio = $this->session->userdata("fechainformelaboratorio");
        } else { 
            $fechainformelaboratorio = $this->Formm03_model->getDatosTabla($sql, "fechainformelaboratorio");
        }
        
        if ($this->session->userdata("numinformelaboratorio")){
            $numinformelaboratorio = $this->session->userdata("numinformelaboratorio");
        } else { 
            $numinformelaboratorio = $this->Formm03_model->getDatosTabla($sql, "numinformelaboratorio");
        }
        
        if ($this->session->userdata("tipopeso")){
            $tipopeso = $this->session->userdata("tipopeso");
        } else { 
            $tipopeso = $this->Formm03_model->getDatosTabla($sql, "tipopeso");
        }
        
        if ($this->session->userdata("pn_senarecom")){
            $pn_senarecom = $this->session->userdata("pn_senarecom");
        } else { 
            $pn_senarecom = $this->Formm03_model->getDatosTabla($sql, "pn_senarecom");
        }
        
        $data = array( 
           'ids'=>$idformm03, 
           'codigos'=>$codigo, 
           'fechaActuals'=>$fechaActual,
           'fechaenviomuestras'=>$fechaenviomuestra,
           'codigoenviomuestras'=>$codigoenviomuestra,
           'citeenviomuestras'=>$citeenviomuestra,
           'formm03'=>$this->Formm03_model->getDatosTransaccion("formm03", $idformm03),
           'oficinareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "oficinareliquidacion"),
           'codigoreliquidadors'=>$this->Formm03_model->getDatosTabla($sql, "codigoreliquidador"),
           'fechareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechareliquidacion"),
           'laboratorios'=>$this->Formm03_model->getDatosTabla($sql, "laboratorio"),
           'fechainformelaboratorios'=>$fechainformelaboratorio,
           'numinformelaboratorios'=>$numinformelaboratorio,
           'tipopesos'=>$tipopeso,
           'pn_senarecoms'=>$pn_senarecom,
           'fechavalidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechavalidacion"),
           'count_clasificacionminerals'=>$this->Formm03_model->getCountClasificacionMineral($idformm03, "", "peso"),
           'clasificacionminerals'=>$this->Formm03_model->getClasificacionMineral($idformm03, "cri_mineral", "peso"),
           'minerales'=>$this->Formm03_model->getMineralesRegistrados($idformm03, "", "peso"),
           'pesonetosecos'=>$pesonetoseco
        );
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidarpeso_aceptar", $data);
        $this->load->view("layouts/footer");
    }*/
 
    /*public function aceptar_leyhumedad($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $btn = $this->input->post("btn");
        
        $fechainformelaboratorio = $this->input->post("fechainformelaboratorio");
        $numinformelaboratorio = $this->input->post("numinformelaboratorio");
        $humedad_senarecom = $this->input->post("humedadDeclarada");
        
        $fechainformelaboratorio = trim($fechainformelaboratorio);
        $numinformelaboratorio = trim($numinformelaboratorio);
        $humedad_senarecom = trim($humedad_senarecom);
        
        if($btn == "cancelar"){
            $this->session->unset_userdata('fechainformelaboratorio');
            $this->session->unset_userdata('numinformelaboratorio');
            $this->session->unset_userdata('humedad_senarecom');
            $this->session->unset_userdata('error');
            $this->session->unset_userdata('idMuestreoReliquidacion');
            
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion, fechavalidacion + 30 fechavencimientoley, fechavalidacion + 2 fechavencimientohumedad ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
        
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        $fechavencimientoley = $this->Formm03_model->getDatosTabla($sql, "fechavencimientoley");
        $fechavencimientohumedad = $this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad");
        
        if($fechainformelaboratorio == null){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($fechainformelaboratorio > $fechavencimientoley){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio: ".$fechainformelaboratorio." no puede ser mayor que la fecha de vencimiento de ley: ".$fechavencimientoley." ");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($fechainformelaboratorio < $fechavalidacion){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio: ".$fechainformelaboratorio." no puede ser menor que la fecha de validacion: ".$fechavalidacion." ");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($numinformelaboratorio == null){
            $this->session->set_userdata("error", "El n&uacutemero de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($humedad_senarecom == null){
            $this->session->set_userdata("error", "La humedad SENARECOM no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if(is_numeric($humedad_senarecom) == false){
            $this->session->set_userdata("error", "La humedad SENARECOM introducida: ".$humedad_senarecom." no es valida");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        $sql = "select count(id) can ";
        $sql .= "from reliquidacion03calculorm ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = 'ley' ";
        $sql .= "and leyvalor is null ";
        $sql .= "and estado = 1; ";
        $can = $this->Formm03_model->getDatosTabla($sql, "can");
        
        if($can > 0){
            $this->session->set_userdata("error", "Debe introducir el ley SENARECOM para todos los elementos");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($btn == "aceptar"){
            $data = array( 
                'estado'=>1,
                'fechainformelaboratorio'=>$fechainformelaboratorio,
                'numinformelaboratorio'=>$numinformelaboratorio,
                'humedad_senarecom'=>$humedad_senarecom,
                'humedad'=>$humedad_senarecom,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion,
                'fechavencimientohumedad'=>$fechavencimientohumedad,
                'fechavencimientoley'=>$fechavencimientoley,
                'tiporeliquidacion'=>"ley"
            ); 
            $this->db->where('idformm03', $idformm03);
            $this->db->where('tiporeliquidacion', 'ley'); 
            $this->db->update('reliquidacion03', $data);
            
            $aux9 = $this->Formm03_model->getReliquidacionLeyHumedad($idformm03);
            
            $this->session->unset_userdata('idMuestreoReliquidacion');
            $this->session->unset_userdata('codigoMuestreoReliquidacion1');
            $this->session->unset_userdata('exportadorMuestreoReliquidacion');
            redirect(base_url()."C_muestreoReliquidacion");
        }
    }*/
                    
    /*public function guardar_leyValorSenarecom(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->input->post("idformm03");
        $idreliquidacion03calculorm = $this->input->post("idreliquidacion03calculorm");
        $operacion = $this->input->post("btn");
        $leyValorSenarecom = $this->input->post("leyValorSenarecom");
        $leyUnidadSenarecom = $this->input->post("leyUnidadSenarecom");
        $mineral = $this->input->post("mineral");
        $leyvalordeclarado = $this->input->post("leyvalordeclarado");        
        $leyunidaddeclarado = $this->input->post("leyunidaddeclarado"); 
                
        $idformm03 = trim($idformm03);
        $idreliquidacion03calculorm = trim($idreliquidacion03calculorm);
        $operacion = trim($operacion);
        $leyValorSenarecom = trim($leyValorSenarecom);
        $leyUnidadSenarecom = trim($leyUnidadSenarecom);
        $mineral = trim($mineral);
        $leyvalordeclarado = trim($leyvalordeclarado);
        $leyunidaddeclarado = trim($leyunidaddeclarado);
        
        $sql = "select simbolo ";
        $sql .= "from reliquidacion03calculorm ";
        $sql .= "where id = ".$idreliquidacion03calculorm."; ";
        $simbolo = $this->Formm03_model->getDatosTabla($sql, "simbolo");
                
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        }
        
        if($leyValorSenarecom == null){
            $this->session->set_userdata("error", "La ley Senarecom no debe ser null");
            $operacion = "error";
        }
        
        if($leyValorSenarecom > 100 and $leyUnidadSenarecom == "%"){
            $this->session->set_userdata("error", "La ley Senarecom: ".$leyValorSenarecom." ".$leyUnidadSenarecom." no puede ser mayor a 100 %");
            $operacion = "error";
        }
        
        if(is_numeric($leyValorSenarecom) == false){ 
            $this->session->set_userdata("error", "El valor introducido: ".$leyValorSenarecom." no es valido");
            $operacion = "error";
        }
        
        $diferencia = ($leyValorSenarecom * 99.5)/100;
        if($diferencia >= $leyvalordeclarado){
            $leyValorNuevo = $leyValorSenarecom;
        } else {
            $leyValorNuevo = $leyvalordeclarado;
        }
        
        if($operacion == "aceptar"){
            $data = array(
                'leyvalor_senarecom'=>$leyValorSenarecom,
                'leyunidad_senarecom'=>$leyunidaddeclarado,
                'diferencia'=>$diferencia,
                'leyvalor'=>$leyValorNuevo
            ); 
            $this->db->where('idformm03', $idformm03); 
            $this->db->where('id', $idreliquidacion03calculorm); 
            $this->db->update('reliquidacion03calculorm', $data);

            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLeyHumedad/".$cad);
        } else {
            $this->session->set_userdata("leyValorSenarecom", $leyValorSenarecom);
            
            $data = array( 
               'idformm03s'=>$idformm03, 
               'idreliquidacion03calculorms'=>$idreliquidacion03calculorm,
               'leyValorSenarecoms'=>$leyValorSenarecom,
               'leyUnidadSenarecoms'=>$leyUnidadSenarecom,
               'minerals'=>$mineral,
               'leyvalordeclarados'=>$leyvalordeclarado,
               'leyunidaddeclarados'=>$leyunidaddeclarado,
               'simbolos'=>$simbolo, 
            ); 
            $this->session->unset_userdata('leyValorSenarecom');

            $this->load->helper('form'); 

            $this->load->view("layouts/header3");
            $this->load->view("layouts/aside");
            $this->load->view("reliquidacion/V_muestreoReliquidacion_editarLeyValorSenarecom", $data);
            $this->load->view("layouts/footer");
        }
    }*/
    
    /*public function aceptar_peso($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $btn = $this->input->post("btn");
        $fechainformelaboratorio = $this->input->post("fechainformelaboratorio");
        $numinformelaboratorio = $this->input->post("numinformelaboratorio");
        $tipopeso = $this->input->post("tipopeso");
        $pn_senarecom = $this->input->post("pn_senarecom");
        
        $fechainformelaboratorio = trim($fechainformelaboratorio);
        $numinformelaboratorio = trim($numinformelaboratorio);
        $tipopeso = trim($tipopeso);
        $pn_senarecom = trim($pn_senarecom);
        
        if($btn == "cancelar"){
            $this->session->unset_userdata('fechainformelaboratorio');
            $this->session->unset_userdata('numinformelaboratorio');
            $this->session->unset_userdata('tipopeso');
            $this->session->unset_userdata('pn_senarecom');
            $this->session->unset_userdata('error');
            $this->session->unset_userdata('idMuestreoReliquidacion');
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
        
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        
        if($fechainformelaboratorio == null){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratoriopeso", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratoriopeso", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if($numinformelaboratorio == null){
            $this->session->set_userdata("error", "El n&uacutemero de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if($tipopeso == null){
            $this->session->set_userdata("error", "Debe seleccionar el tipo de peso de reliquidacion");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if($pn_senarecom == null){
            $this->session->set_userdata("error", "El ".$tipopeso." no puede ser null");
            $this->session->set_userdata("fechainformelaboratoriopeso", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratoriopeso", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if(is_numeric($pn_senarecom) == false){
            $this->session->set_userdata("error", "El ".$tipopeso." introducido: ".$pn_senarecom." no es valido");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if($pn_senarecom == 0){
            $this->session->set_userdata("error", "El ".$tipopeso." introducido: ".$pn_senarecom." no puede ser 0");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("tipopeso", $tipopeso);
            $this->session->set_userdata("pn_senarecom", $pn_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarPeso/".$cad);
        }
        
        if($btn == "aceptar"){
            $data = array( 
                'estado'=>1,
                'fechainformelaboratorio'=>$fechainformelaboratorio,
                'numinformelaboratorio'=>$numinformelaboratorio,
                'tipopeso'=>$tipopeso,
                'pn_senarecom'=>$pn_senarecom,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion
            ); 
            $this->db->where('idformm03', $idformm03); 
            $this->db->where('tiporeliquidacion', 'peso'); 
            $this->db->update('reliquidacion03', $data);
            
            $aux9 = $this->Formm03_model->getReliquidacionPeso($idformm03);
            
            $this->session->unset_userdata('idMuestreoReliquidacion');
            $this->session->unset_userdata('codigoMuestreoReliquidacion1');
            $this->session->unset_userdata('exportadorMuestreoReliquidacion');
            redirect(base_url()."C_muestreoReliquidacion");
        }
    }*/
    
    /*public function editarCodigoEnvioMuestra($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select f.id, codigoenviomuestra, fechamuestra, lote, o.nombre as empresa ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id = ".$idformm03." ";
        $sql .= "limit 1; ";
        
        if ($this->session->userdata("codigoenviomuestra")){
            $codigoenviomuestra = $this->session->userdata("codigoenviomuestra");
        } else {
            $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        }
        
        if ($this->session->userdata("fechamuestra")){
            $fechamuestra = $this->session->userdata("fechamuestra");
        } else {
            $fechamuestra = $this->Formm03_model->getDatosTabla($sql, "fechamuestra");
        }
        
        $data = array( 
           'idformm03s'=>$idformm03,
           'codigoenviomuestras'=>$codigoenviomuestra,
           'fechamuestras'=>$fechamuestra,
           'fechaActuals'=>$this->Formm03_model->getFechaActual(),
           'lotes'=>$this->Formm03_model->getDatosTabla($sql, "lote"),
           'empresas'=>$this->Formm03_model->getDatosTabla($sql, "empresa") 
        );
        
        $this->session->unset_userdata('codigoenviomuestra');
        $this->session->unset_userdata('fechamuestra');
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion_editarCodigoEnvioMuestra", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function guardar_codigoEnvioMuestra(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->input->post("idformm03");
        $operacion = $this->input->post("btn");
        $codigoenviomuestra = $this->input->post("codigoenviomuestra");
        $fechamuestra = $this->input->post("fechamuestra");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('codigoenviomuestra');
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($codigoenviomuestra == null){
            $this->session->set_userdata("error", "El c&oacutedigo de envi&oacute de muestra no debe ser null");
            $this->session->set_userdata("codigoenviomuestra", $codigoenviomuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarCodigoEnvioMuestra/".$cad);
        }
        
        if($fechamuestra == null){
            $this->session->set_userdata("error", "La fecha de muestra no debe ser null");
            $this->session->set_userdata("fechamuestra", $fechamuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarCodigoEnvioMuestra/".$cad);
        }
        
        $sql = "select id, codigoenviomuestra ";
        $sql .= "from formm03 ";
        $sql .= "where length(codigoenviomuestra) > 0 ";
        $sql .= "and id not in (".$idformm03.") ";
        $sql .= "and codigoenviomuestra = '".$codigoenviomuestra."'; ";
        $AuxCodigoEnvioMuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $AuxCodigoEnvioMuestra = trim($AuxCodigoEnvioMuestra);
        if(strlen($AuxCodigoEnvioMuestra) > 0){
            $AuxID = $this->Formm03_model->getDatosTabla($sql, "id");
            $this->session->set_userdata("error", "El c&oacutedigo de envi&oacute de muestra: ".$AuxCodigoEnvioMuestra." ya esta registrada al ID M-03: ".$AuxID." ");
            $this->session->set_userdata("codigoenviomuestra", $codigoenviomuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarCodigoEnvioMuestra/".$cad);
        }
        
        if($operacion == "aceptar"){
            $data = array( 
                'codigoenviomuestra'=>$codigoenviomuestra,
                'fechamuestra'=>$fechamuestra
            ); 
            $this->db->where('id', $idformm03); 
            $this->db->update('formm03', $data);

            redirect(base_url()."C_muestreoReliquidacion");
        }
        $this->session->unset_userdata('idMuestreoReliquidacion');
        redirect(base_url()."C_muestreoReliquidacion");
    }*/
    
    /*public function editarCiteEnvioMuestra($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select id, citeenviomuestra ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03." ";
        $sql .= "limit 1; ";
                                      
        if ($this->session->userdata("citeenviomuestra")){
            $citeenviomuestra = $this->session->userdata("citeenviomuestra");
        } else {
            $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        }
        
        $data = array( 
           'idformm03s'=>$idformm03,
           'citeenviomuestras'=>$citeenviomuestra
        ); 
        $this->session->unset_userdata('citeenviomuestra');
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion_editarCiteEnvioMuestra", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function guardar_citeEnvioMuestra(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->input->post("idformm03");
        $operacion = $this->input->post("btn");
        $citeenviomuestra = $this->input->post("citeenviomuestra");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('citeenviomuestra');
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "El cite de envi&oacute de muestra no debe ser null");
            $this->session->set_userdata("citeenviomuestra", $citeenviomuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarCiteEnvioMuestra/".$cad);
        }
        
        if($operacion == "aceptar"){
            $data = array( 
                'citeenviomuestra'=>$citeenviomuestra
            ); 
            $this->db->where('id', $idformm03); 
            $this->db->update('formm03', $data);

            //$this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        $this->session->unset_userdata('idMuestreoReliquidacion');
        redirect(base_url()."C_muestreoReliquidacion");
    }*/
    
    /*public function editarFechaEnvioMuestra($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select id, fechaenviomuestra, fechavalidacion, fechavalidacion + 30 fechavencimiento ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03." ";
        $sql .= "limit 1; ";
                                      
        if ($this->session->userdata("fechaenviomuestra")){
            $fechaenviomuestra = $this->session->userdata("fechaenviomuestra");
        } else {
            $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        }
        
        $data = array( 
           'idformm03s'=>$idformm03,
           'fechaenviomuestras'=>$fechaenviomuestra,
           'fechavencimientos'=>$this->Formm03_model->getDatosTabla($sql, "fechavencimiento"),
           'fechaActuals' =>$this->Formm03_model->getFechaActual(),
        ); 
        $this->session->unset_userdata('fechaenviomuestra');
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion_editarFechaEnvioMuestra", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function guardar_fehaEnvioMuestra(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->input->post("idformm03");
        $operacion = $this->input->post("btn");
        $fechaenviomuestra = $this->input->post("fechaenviomuestra");
        $fechavencimiento = $this->input->post("fechavencimiento");
        $this->session->unset_userdata('error');
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('fechaenviomuestra');
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "La fecha de envi&oacute de muestra no debe ser null");
            $this->session->set_userdata("fechaenviomuestra", $fechaenviomuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarFechaEnvioMuestra/".$cad);
        }
        
        if($fechaenviomuestra > $fechavencimiento){
            $this->session->set_userdata("error", "La fecha de envi&oacute de muestra: ".$fechaenviomuestra." no debe ser mayor a la fecha de vencimiento: ".$fechavencimiento." ");
            $this->session->set_userdata("fechaenviomuestra", $fechaenviomuestra);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/editarFechaEnvioMuestra/".$cad);
        }
        
        if($operacion == "aceptar"){
            $data = array( 
                'fechaenviomuestra'=>$fechaenviomuestra
            ); 
            $this->db->where('id', $idformm03); 
            $this->db->update('formm03', $data);

            //$this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        $this->session->unset_userdata('idMuestreoReliquidacion');
        redirect(base_url()."C_muestreoReliquidacion");
    }*/
    
    /*public function notificacionEnvioMuestra($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        
        $lugar = $this->session->userdata("lugar");
        $sql = "select fechamuestra, fechaenviomuestra, codigoenviomuestra, citeenviomuestra from formm03 where id = ".$idformm03."; ";
        $fechamuestra = $this->Formm03_model->getDatosTabla($sql, "fechamuestra");
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechaActualLarga = $this->Formm03_model->getLugar($lugar, "minuscula").", ".$this->Formm03_model->getFechaLarga($fechaenviomuestra);
        
        $fechamuestra = trim($fechamuestra);
        $fechaenviomuestra = trim($fechaenviomuestra);
        $codigoenviomuestra = trim($codigoenviomuestra);
        $citeenviomuestra = trim($citeenviomuestra);
                
        $usuario = $this->session->userdata("usuario");
        $lugar = $this->session->userdata("lugar");
        
        $sql = "select distinct u.id idusuario, correoinstitucional ";
        $sql .= "from usuario u ";
        $sql .= "join empleado e on e.idusuario = u.id ";
        $sql .= "where u.usuario = '".$usuario."'; ";
        $correousuario = $this->Formm03_model->getDatosTabla($sql, "correoinstitucional");
        
        $sql = "select correoinstitucional, nombres, apellidopaterno, apellidomaterno, cargo ";
        $sql .= "from usuario u ";
        $sql .= "join empleado e on e.idusuario = u.id ";
        $sql .= "where u.activo = 1 ";
        $sql .= "and cargo like 'JEFE DEPARTAMENTAL ".$lugar."' ";
        $correojefe = $this->Formm03_model->getDatosTabla($sql, "correoinstitucional");
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de envio de muestra del M-03 con ID: ".$idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($codigoenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el codigo de envio de muestra del M-03 con ID: ".$idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el cite de envio de muestra del M-03 con ID: ".$idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
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
        $mineralEnvioMuestras = $this->Formm03_model->getMineralEnvioMuestra($citeenviomuestra);
        
        // Preparamos y maquetamos el contenido a crear
        $html = '';
        $html .="<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        $html .="<i>".$fechaActualLarga."</i><br/>";
        $html .="<i><strong>CITE: ".$citeenviomuestra."</strong></i><br/>";
        
        $html .= '
        <br/><br/><br/><br/>
        <i>Señores: </i><br/>
        <i><strong>Laboratorio CIMM </strong></i><br/>
        <i><strong>COMIBOL </strong></i><br/>
        <i>Presente.- </i><br/><br/>
        <i><strong><p style="text-align:right">REF.: Remisión de Muestra(s) y Solicitud de Análisis Químico</p></strong></i><br/><br/>
        <i>De mi mayor consideración.</i><br/><br/>
        <i>Mediante la presente remito adjunto muestras para su respectivo análisis químico de CALIDAD, según el siguiente detalle:</i><br/><br/>
        ';
        
        $html .= '<table border="1">';
        $html .= '  <thead>';
        $html .= '      <tr>';
        $html .= '          <th style="text-align: center" width="30"><i><strong>No.</strong></i></th>';
        $html .= '          <th style="text-align: center"><i><strong>Fecha Muestra</strong></i></th>';
        $html .= '          <th style="text-align: center"><i><strong>Codigo SNRCM</strong></i></th>';
        $html .= '          <th style="text-align: center"><i><strong>Producto</strong></i></th>';
        $html .= '          <th style="text-align: center"><i><strong>Analisis Requerido</strong></i></th>';
        $html .= '          <th style="text-align: center" width="180"><i><strong>Observacion (tipo de envase tipo de servicio que se solicita)</strong></i></th>';
        $html .= '      </tr>';
        $html .= '  </thead>';
        $html .= '  <tbody>';
        $i = 0;
        foreach($mineralEnvioMuestras as $recep){
            $i = $i + 1;
            $html .= '<tr>';
            $html .= '  <td style="text-align: center" width="30"><i>'.$i.'</i></td>';
            $html .= '  <td style="text-align: center"><i>'.$recep->fechamuestra.'</i></td>';
            $html .= '  <td style="text-align: center"><i>'.$recep->codigoenviomuestra.'</i></td>';
            $html .= '  <td style="text-align: center"><i>'.$recep->producto.'</i></td>';
            $html .= '  <td style="text-align: center"><i>'.$recep->analisis.'</i></td>';
            $html .= '  <td style="text-align: center" width="180"><i>'.$recep->obs.'</i></td>';
            $html .= '</tr>';
        }    
        $html .= '  </tbody>';
        $html .= '</table>';
        
        $html .= '<i><p>Asimismo se solicita remitir el resultado al correo: '.$correojefe;
        if(strlen($correousuario) > 0) { $html .= ' y '.$correousuario; }
        $html .= '</p></i><br/><br/>';
        $html .= '<i><p>Sin otro particular me despido</p></i>';    
        
        $html = utf8_encode($html);
        
        // Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        
        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Saludo".".pdf");
        $pdf->Output($nombre_archivo, 'I');
    }*/
 
    /*public function datosEnvioMuestra(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $datost = "";
        $datost1 = "";
        //echo print_r($this->input->post('cod')); 
        foreach($this->input->post('cod') as $idformm03){
            $datost.= $idformm03."|";
            $datost1.= $idformm03.", ";
        }
            
        if(strlen($datost) == 0){
            $this->session->set_userdata("error", "Debe seleccionar un ID M-03");
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $Tam = strlen($datost1) - 2;
        $datost2 = substr($datost1, 0, $Tam);
        
        $sql = "select count(distinct idexportador) total ";
        $sql .= "from formm03 ";
        $sql .= "where id in (".$datost2."); ";
        $Tam = $this->Formm03_model->getDatosTabla($sql, "total");
        
        if($Tam > 1){
            $this->session->set_userdata("error", "Solo debe ser de una expresa exportadora");
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select distinct fechaenviomuestra, citeenviomuestra, o.nombre as empresaexportadora ";
        $sql .= "from formm03 f ";
        $sql .= "join operador o on o.id = f.idexportador ";
        $sql .= "where f.id in (".$datost2.") ";
        $sql .= "order by fechaenviomuestra desc; ";
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $empresaexportadora = $this->Formm03_model->getDatosTabla($sql, "empresaexportadora");
        
        $data = array(
           'idformm03s'=>$datost2, 
           'fechaenviomuestras'=>$fechaenviomuestra,
           'citeenviomuestras'=>$citeenviomuestra,  
           'fechaActuals'=>$this->Formm03_model->getFechaActual(),
           'empresaexportadoras'=>$empresaexportadora
        ); 
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion_editarDatosEnvioMuestra", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function guardar_datosEnvioMuestra(){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03s = $this->input->post("idformm03");
        $operacion = $this->input->post("btn");
        $fechaenviomuestra = $this->input->post("fechaenviomuestra");
        $citeenviomuestra = $this->input->post("citeenviomuestra");
        $this->session->unset_userdata('error');
        
        $fechaenviomuestra = trim($fechaenviomuestra);
        $citeenviomuestra = trim($citeenviomuestra);
        
        if($operacion == "cancelar"){
            $this->session->unset_userdata('fechaenviomuestra');
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "La fecha de envi&oacute de muestra no debe ser null");
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "La cite de envi&oacute de muestra no debe ser null");
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($operacion == "aceptar"){
            $cad = $this->Formm03_model->setGuardarDatosEnvioMuestra($idformm03s, $fechaenviomuestra, $citeenviomuestra);
        }
        redirect(base_url()."C_muestreoReliquidacion");
    }*/
    
    /*public function reliquidarHumedad($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $codigo = $this->Formm03_model->getCodigo($idformm03);
        
        $fechaActual = $this->Formm03_model->getFechaActual();
        $lugar = $this->session->userdata("lugar");
        $usuario = $this->session->userdata("usuario"); 
        
        $sql = "select id, fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion, fechavalidacion + 2 fechavencimientohumedad, idpresentacionproducto, case when humedad is null then 0 else humedad end as humedad ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
            
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        $fechavencimientohumedad = $this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad"); 
        $idpresentacionproducto = $this->Formm03_model->getDatosTabla($sql, "idpresentacionproducto"); 
        $humedadDeclarada = $this->Formm03_model->getDatosTabla($sql, "humedad");
                
        $fechaenviomuestra = trim($fechaenviomuestra);
        $codigoenviomuestra = trim($codigoenviomuestra);
        $citeenviomuestra = trim($citeenviomuestra);
        $fechavalidacion = trim($fechavalidacion);
        $fechavencimientohumedad = trim($fechavencimientohumedad);
        $idpresentacionproducto = trim($idpresentacionproducto);
        $humedadDeclarada = trim($humedadDeclarada);
        
        if($humedadDeclarada == null){
            $this->session->set_userdata("error", "El M-03 con ID: ".$idformm03." no se puede reliquidar por humedad por que no hay humedad declarada");
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($fechaenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar la fecha de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($codigoenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el codigo de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($citeenviomuestra == null){
            $this->session->set_userdata("error", "Debe registrar el cite de envio de muestra del M-03 con ID: ".$idformm03);
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        if($humedadDeclarada == 0){
            $this->session->set_userdata("error", "El M-03 con ID: ".$idformm03." no se puede reliquidar por humedad por que no tiene humedad declarada");
            $this->session->set_userdata("idMuestreoReliquidacion", $idformm03);
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select count(*) total from reliquidacion03 where idformm03 = ".$idformm03." and tiporeliquidacion = 'humedad';";
        $sw = $this->Formm03_model->getDatosTabla($sql, "total");
        
        if($sw == 0){
            // No existe el id en reliquidacion03 
            $data = array ( 
                'id'=>$this->Formm03_model->getMayor("reliquidacion03", "id"),
                'idformm03'=>$idformm03,
                'estado'=>0,
                'oficinareliquidacion'=>$lugar,
                'codigoreliquidador'=>$usuario,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion,
                'fechareliquidacion'=>$fechaActual,
                'fechavencimientohumedad'=>$fechavencimientohumedad,
                'idpresentacionproducto'=>$idpresentacionproducto,
                'tiporeliquidacion'=>"humedad"
            );
            $this->db->insert('reliquidacion03', $data);
            $aux9 = $this->Formm03_model->getreliquidacion03calculorm($idformm03, "humedad");
        } else {
            $data = array( 
                'oficinareliquidacion'=>$lugar,
                'codigoreliquidador'=>$usuario,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'fechareliquidacion'=>$fechaActual,
                'fechavencimientohumedad'=>$fechavencimientohumedad
            ); 
            $this->db->where('idformm03', $idformm03);
            $this->db->where('tiporeliquidacion', 'humedad');
            $this->db->update('reliquidacion03', $data);
        }
            
        $this->load->helper('form');
        
        $sql = "select idformm03 id, re.estado estado, oficinareliquidacion, codigoreliquidador, fechareliquidacion, laboratorio, fechainformelaboratorio, numinformelaboratorio, humedad_senarecom, fechavalidacion, fechavencimientohumedad ";
        $sql .= "from reliquidacion03 re ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and tiporeliquidacion = 'humedad'; ";
        
        if ($this->session->userdata("fechainformelaboratorio")){
            $fechainformelaboratorio = $this->session->userdata("fechainformelaboratorio");
        } else { 
            $fechainformelaboratorio  = $this->Formm03_model->getDatosTabla($sql, "fechainformelaboratorio");
        }
        
        if ($this->session->userdata("numinformelaboratorio")){
            $numinformelaboratorio = $this->session->userdata("numinformelaboratorio");
        } else { 
            $numinformelaboratorio = $this->Formm03_model->getDatosTabla($sql, "numinformelaboratorio");
        }
        
        if ($this->session->userdata("humedad_senarecom")){
            $humedad_senarecom = $this->session->userdata("humedad_senarecom");
        } else { 
            $humedad_senarecom = $this->Formm03_model->getDatosTabla($sql, "humedad_senarecom");
        }
        
        $sql1 = "select case when humedad is null then 0 else humedad end as humedad from formm03 where id = ".$idformm03."; ";
        
        $data = array( 
           'ids'=>$idformm03, 
           'codigos'=>$codigo, 
           'fechaActuals'=>$fechaActual,
           'fechaenviomuestras'=>$fechaenviomuestra,
           'codigoenviomuestras'=>$codigoenviomuestra,
           'citeenviomuestras'=>$citeenviomuestra,
           'formm03'=>$this->Formm03_model->getDatosTransaccion("formm03", $idformm03),
           'oficinareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "oficinareliquidacion"),
           'codigoreliquidadors'=>$this->Formm03_model->getDatosTabla($sql, "codigoreliquidador"),
           'fechareliquidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechareliquidacion"),
           'laboratorios'=>$this->Formm03_model->getDatosTabla($sql, "laboratorio"),
           'fechainformelaboratorios'=>$fechainformelaboratorio,
           'numinformelaboratorios'=>$numinformelaboratorio,
           'humedad_senarecoms'=>$humedad_senarecom,   
           'humedads'=>$this->Formm03_model->getDatosTabla($sql1, "humedad"),
           'fechavalidacions'=>$this->Formm03_model->getDatosTabla($sql, "fechavalidacion"), 
           'fechavencimientohumedads'=>$this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad"),
           'minerales'=>$this->Formm03_model->getMineralesRegistrados($idformm03, "", "humedad")
        ); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_reliquidarhumedad_aceptar", $data);
        $this->load->view("layouts/footer");
    }*/
    
    /*public function aceptar_humedad($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idformm03 = $this->Formm03_model->desemcriptar($entrada);
        $btn = $this->input->post("btn");
        $fechainformelaboratorio = $this->input->post("fechainformelaboratorio");
        $numinformelaboratorio = $this->input->post("numinformelaboratorio");
        $humedad_senarecom = $this->input->post("humedad_senarecom");

        $fechainformelaboratorio = trim($fechainformelaboratorio);
        $numinformelaboratorio = trim($numinformelaboratorio);
        $humedad_senarecom = trim($humedad_senarecom);
        
        if($btn == "cancelar"){
            $this->session->unset_userdata('fechainformelaboratorio');
            $this->session->unset_userdata('numinformelaboratorio');
            $this->session->unset_userdata('humedad_senarecom');
            $this->session->unset_userdata('error');
            $this->session->unset_userdata('idMuestreoReliquidacion');
            
            redirect(base_url()."C_muestreoReliquidacion");
        }
        
        $sql = "select humedad, fechaenviomuestra, codigoenviomuestra, citeenviomuestra, fechavalidacion, fechavalidacion + 2 fechavencimientohumedad ";
        $sql .= "from formm03 ";
        $sql .= "where id = ".$idformm03."; ";
        
        $fechaenviomuestra = $this->Formm03_model->getDatosTabla($sql, "fechaenviomuestra");
        $codigoenviomuestra = $this->Formm03_model->getDatosTabla($sql, "codigoenviomuestra");
        $citeenviomuestra = $this->Formm03_model->getDatosTabla($sql, "citeenviomuestra");
        $fechavalidacion = $this->Formm03_model->getDatosTabla($sql, "fechavalidacion");
        $fechavencimientohumedad = $this->Formm03_model->getDatosTabla($sql, "fechavencimientohumedad");
        $humedadDeclarada = $this->Formm03_model->getDatosTabla($sql, "humedad");
        
        if($fechainformelaboratorio == null){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarHumedad/".$cad);
        }
        
        if($fechainformelaboratorio > $fechavencimientohumedad){
            $this->session->set_userdata("error", "La fecha de informe de laboratorio: ".$fechainformelaboratorio." no puede ser mayor que la fecha de vencimiento de humedad: ".$fechavencimientohumedad." ");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarHumedad/".$cad);
        }
        
        if($numinformelaboratorio == null){
            $this->session->set_userdata("error", "El n&uacutemero de informe de laboratorio no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarHumedad/".$cad);
        }
        
        if($humedad_senarecom == null){
            $this->session->set_userdata("error", "La humedad SENARECOM no puede ser null");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarHumedad/".$cad);
        }
        
        if(is_numeric($humedad_senarecom) == false){
            $this->session->set_userdata("error", "La humedad SENARECOM introducida: ".$humedad_senarecom." no es valida");
            $this->session->set_userdata("fechainformelaboratorio", $fechainformelaboratorio);
            $this->session->set_userdata("numinformelaboratorio", $numinformelaboratorio);
            $this->session->set_userdata("humedad_senarecom", $humedad_senarecom);
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarHumedad/".$cad);
        }
        
        $diferencia = 0;
        if($humedad_senarecom > 0){
            $diferencia = ($humedadDeclarada * 100) / $humedad_senarecom;
        }
        
        if($diferencia > 125){
            $humedadNueva = $humedad_senarecom;
        } else {
            $humedadNueva = $humedadDeclarada; 
        }
        
        if($btn == "aceptar"){
            $data = array( 
                'estado'=>1,
                'fechainformelaboratorio'=>$fechainformelaboratorio,
                'numinformelaboratorio'=>$numinformelaboratorio,
                'humedad_senarecom'=>$humedad_senarecom,
                'humedad_declarada'=>$humedadDeclarada,
                'humedad'=>$humedadNueva,
                'diferencia'=>$diferencia,
                'fechaenviomuestra'=>$fechaenviomuestra,
                'codigoenviomuestra'=>$codigoenviomuestra,
                'citeenviomuestra'=>$citeenviomuestra,
                'fechavalidacion'=>$fechavalidacion,
                'fechavencimientohumedad'=>$fechavencimientohumedad
            ); 
            $this->db->where('idformm03', $idformm03);
            $this->db->where('tiporeliquidacion', 'humedad');
            $this->db->update('reliquidacion03', $data);
            
            $aux9 = $this->Formm03_model->getReliquidacionHumedad($idformm03);
            
            $this->session->unset_userdata('idMuestreoReliquidacion');
            redirect(base_url()."C_muestreoReliquidacion");
        }
    }*/
    
    /*public function reliquidarLeyHumedad_ley_editar($entrada){
        $controlSession = $this->Formm03_model->controlSession();
        
        $idreliquidacion03calculorm = $this->Formm03_model->desemcriptar($entrada);
        
        $sql = "select id, leyvalor, leyunidad, estado, idformm03, elemento, clasificacionmineral, idmineral ";
        $sql .= "from reliquidacion03calculorm ";
        $sql .= "where id = ".$idreliquidacion03calculorm." ";
        $sql .= "limit 1; ";
        
        $idformm03 = $this->Formm03_model->getDatosTabla($sql, "idformm03");
        $estado = $this->Formm03_model->getDatosTabla($sql, "estado");
        $elemento = $this->Formm03_model->getDatosTabla($sql, "elemento");
        $clasificacionmineral = $this->Formm03_model->getDatosTabla($sql, "clasificacionmineral");
        $leyValorSenarecom = $this->Formm03_model->getDatosTabla($sql, "leyvalor");
        $leyUnidadSenarecom = $this->Formm03_model->getDatosTabla($sql, "leyunidad");
        $idmineral = $this->Formm03_model->getDatosTabla($sql, "idmineral");
        
        $sql = "select m.descripcion mineral, simbolo, leyvalor leyvalordeclarado, leyunidad leyunidaddeclarado ";
        $sql .= "from formm03calculorm fc ";
        $sql .= "join mineral m on m.id = fc.idmineral ";
        $sql .= "where idformm03 = ".$idformm03." ";
        $sql .= "and idmineral = ".$idmineral."; ";
        
        $mineral = $this->Formm03_model->getDatosTabla($sql, "mineral");
        $leyvalordeclarado = $this->Formm03_model->getDatosTabla($sql, "leyvalordeclarado");
        $leyunidaddeclarado = $this->Formm03_model->getDatosTabla($sql, "leyunidaddeclarado");
        $leyunidaddeclarado = $this->Formm03_model->getDatosTabla($sql, "leyunidaddeclarado");
        $simbolo = $this->Formm03_model->getDatosTabla($sql, "simbolo");
        
        if($estado == 0){
            $this->session->set_userdata("error", "El elemento: ".$elemento." con clasificaci&oacuten mineral: ".$clasificacionmineral." no se puede editar su ley puesto que es NO VALIDA PARA RELIQUIDAR");
            
            $cad = $this->Formm03_model->encriptar($idformm03);
            redirect(base_url()."C_muestreoReliquidacion/reliquidarLey/".$cad);
        }
        
        if ($this->session->userdata("leyValorSenarecom")){
            $leyValorSenarecom = $this->session->userdata("leyValorSenarecom");
        }
        
        $data = array( 
           'idformm03s'=>$idformm03, 
           'idreliquidacion03calculorms'=>$idreliquidacion03calculorm,
           'leyValorSenarecoms'=>$leyValorSenarecom,
           'leyUnidadSenarecoms'=>$leyUnidadSenarecom,
           'minerals'=>$mineral,
           'leyvalordeclarados'=>$leyvalordeclarado, 
           'leyunidaddeclarados'=>$leyunidaddeclarado,
           'simbolos'=>$simbolo 
        );
        
        $this->load->helper('form'); 
        
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("reliquidacion/V_muestreoReliquidacion_editarLeyValorSenarecom", $data);
        $this->load->view("layouts/footer");
    }*/
}

    
?>