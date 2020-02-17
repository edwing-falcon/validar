<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inicio extends CI_Controller {
        
    public function __construct(){
        parent::__construct();
        $this->load->model("Usuario_model");
    }
        
    public function index()
    {
        $this->session->sess_destroy();
        if ($this->session->userdata("login")) {
            redirect(base_url()."C_principal");
        } else {
            $mensaje = $this->Usuario_model->getMensaje();
            if($mensaje){
                $res = $this->Usuario_model->getDatosMensaje();
                if($res){
                    $data  = array(
                        'ids' => $res->id,
                        'titulos' => $res->titulo,
                        'cavezas' => $res->caveza,
                        'mensajes' => $res->mensaje,
                        'links' => $res->link,
                        'parpadeos' => $res->parpadeo
                    );
                    $this->load->view('admin/V_mensaje', $data);
                } else {
                    $this->load->view('admin/V_login');
                }
            } else {
                $this->load->view('admin/V_login');
            }
        }
    }
    
    public function validador(){
        $this->session->sess_destroy();
        if ($this->session->userdata("login")) {
            redirect(base_url()."C_principal");
        } else {
            $this->load->view('admin/V_login');
        }
    }
    
    public function prueba(){
        //$this->load->view("layouts/header");
        //$this->load->view("layouts/aside");
        $this->load->view("data");
        //$this->load->view("layouts/footer");
    }
    
    public function falta(){
        $this->load->view("layouts/header3");
        $this->load->view("layouts/aside");
        $this->load->view("V_falta");
        $this->load->view("layouts/footer");
    }
    
    public function login(){
        $usuario = $this->input->post("usuario");
        $contrasena = $this->input->post("contrasena");
        
        $usuario = strtoupper(trim($usuario));
        $contrasena = strtoupper($contrasena);
        $pass = strtoupper(md5($contrasena)); 
        
        $res = $this->Usuario_model->login($usuario, $pass);
        if(!$res){
            $this->session->set_flashdata("error", "El usuario y/o contraseña son incorrectos, SOLO REGIONALES y que esten ACTIVOS");
            //redirect(base_url());
            $this->session->set_userdata("usuario", $usuario);
            $this->session->set_userdata("contrasena", $contrasena);
            $this->load->view('admin/V_login');
        } else {
            $id = $res->id;
            $cad = "";
            $lugar = $this->Usuario_model->lugar($id);
            $formm02 = $this->Usuario_model->formulario("formm02", $id);
            $formm03 = $this->Usuario_model->formulario("formm03", $id);
            $reliquidador = $this->Usuario_model->getReliquidador($id);
            $lugarC = $this->Usuario_model->lugarCompleto($id);
            $data  = array(
                'id' => $res->id, 
                'usuario' => $res->usuario,
                'idrol' => $res->idrol,
                'rol' => $res->rol,
                'formm02' => $formm02,
                'formm03' => $formm03,
                'reliquidador' => $reliquidador,
                'lugar' => $lugar,
                'codigo' => $res->codigo,
                'login' => TRUE,
                'lugarCompleto' => $lugarC,
            );
            $this->session->set_userdata($data);
            redirect(base_url()."C_principal");
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

?>