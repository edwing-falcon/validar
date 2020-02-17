<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Excel_import_model');
        $this->load->library('excel');
    }
    
    function index(){
        $this->load->helper('form'); 
        
        $this->load->view('admin/Excel_import_vista');
    }

    public function fetch(){
        $data = $this->Excel_import_model->select();
        $output = '
        <h3 align="center">Total Data - '.$data->num_rows().'</h3>
        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
            </tr>
        ';
        
        foreach($data->result() as $row){
            $output .= '
                <tr>
                    <td>'.$row->customerid.'</td>
                    <td>'.$row->customername.'</td>
                    <td>'.$row->address.'</td>
                    <td>'.$row->city.'</td>
                    <td>'.$row->postalcode.'</td>
                    <td>'.$row->country.'</td>
                </tr>
            ';
        }
        $output .= '</table>';
        echo $output;
    }
    
    public function import(){
        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++){
                    $customer_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $city = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $postal_code = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $country = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    
                    /*echo "customer_name = ".$customer_name."<br/>";
                    echo "address = ".$address."<br/>";
                    echo "city = ".$city."<br/>";
                    echo "postal_code = ".$postal_code."<br/>";
                    echo "country = ".$country."<br/>";*/
                    
                    $data[] = array(
                        'customername' => $customer_name,
                        'address' => $address,
                        'city' => $city,
                        'postalcode' => $postal_code,
                        'country' => $country
                    );
                }
            }
            $this->Excel_import_model->insert($data);
            echo 'Data Imported successfully';
        }
    }
    
    
    
    
}

?>
