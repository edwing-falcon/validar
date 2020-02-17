<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import_model extends CI_Model {
    
    public function select(){
        $this->db->order_by('customerid', 'desc');
        $query = $this->db->get('tbl_customer');
        return $query;
    }

    public function insert($data){
        $this->db->insert_batch('tbl_customer', $data);
    }
}


?>
