<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class C_importarExcel extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('excelImportar_model');
        $this->load->library('excel');
    }
    
    public function index(){
        
        
    }
}
?>
