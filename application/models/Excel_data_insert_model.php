<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_data_insert_model extends CI_Model {
    public function __construct (){
        parent :: __construct();
        
    }
    
    public function Add_User($data_user){
        $this->db->insert('user1', $data_user);
    }
     
}

?>
