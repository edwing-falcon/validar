<!DOCTYPE html>
<html>
<head>
 <title>How to Import Excel Data into Mysql in Codeigniter</title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bootstrap.min.css" />
 <!--<script src="<?php echo base_url(); ?>asset/jquery.min.js"></script>-->
 <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php base_url();?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

        <!-- ace settings handler -->
        <script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
        
        <!-- jquery -->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>
        <!--jquery ui-->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        
        <link href="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-duallistbox.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-multiselect.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
        
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <!-- ace.min.css General -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

	<!-- ace settings handler -->
	<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
        
        <!-- Combo Anidado -->
<!--        <script src="<?php echo base_url();?>MiJS/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>MiJS/jquery-ui.js"></script>-->
        
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>

<body>
 <div class="container">
  <br />
  <h3 align="center">How to Import Excel Data into Mysql in Codeigniter</h3>
  <form method="post" id="import_form" enctype="multipart/form-data">
   <p><label>Select Excel File</label>
   <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
   <br />
   <input type="submit" name="import" value="Import" class="btn btn-info" />
  </form>
  <br />
  <br />
  <h3 align="center">Ejemplo 2 Import Excel in Codeigniter</h3>
  <div> 
    <?php echo form_open_multipart ('ExcelDataInsert/ExcelDataAdd'); ?>
        <label> Excel File : </label>
        <input type = "file" name = "userfile" />
        <input type = "submit" value = "upload" name = "upload" />
    <?php echo form_close(); ?>
  </div>    
  <h2 align="center">Datos a Listar</h2>
  <div class="table-responsive" id="customer_data">

  </div>
 </div>
</body>
</html>

<script>
$(document).ready(function(){

 load_data();

 function load_data()
 {
  $.ajax({
   url:"<?php echo base_url(); ?>Excel_import/fetch",
   method:"POST",
   success:function(data){
    $('#customer_data').html(data);
   }
  })
 }

 $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>Excel_import/import",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   success:function(data){
    $('#file').val('');
    load_data();
    alert(data);
   }
  })
 });

});
</script>
