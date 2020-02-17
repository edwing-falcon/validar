<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_prueba extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata("login")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $this->load->view("layouts/header");
        $this->load->view("layouts/aside");
        //$this->load->view("v_data");
        $this->load->view("V_lista_1");
        $this->load->view("layouts/footer");
    }
    
    public function buscar($buscar,$inicio = FALSE, $cantidadregistro = FALSE)
    {
        $this->db->like("nombres",$buscar);
        if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
                $this->db->limit($cantidadregistro,$inicio);
        }
        $consulta = $this->db->get("clientes");
        return $consulta->result();
    }
}
