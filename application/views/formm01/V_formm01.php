<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO FORM - M01
                    <!--<small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Subsector
                    </small>-->
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_formm01/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idformm01")) {
                                                echo form_label ('Ingrese ID: ', 'idformm01');
                                                echo form_input(["type" => "text", "name" => "idformm01", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idformm01")]);
                                            } else {
                                                echo form_label ('Ingrese ID: ', 'idformm01');
                                                echo form_input(["type" => "text", "name" => "idformm01", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>				      		
                                            </span>-->
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("nimformm01")) {
                                                echo form_label ('Ingrese NIM: ', 'nimformm01');
                                                echo form_input(["type" => "text", "name" => "nimformm01", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("nimformm01")]);
                                            } else {
                                                echo form_label ('Ingrese NIM: ', 'nimformm01');
                                                echo form_input(["type" => "text", "name" => "nimformm01", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>-->
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("operadorformm01")) {
                                                echo form_label ('Razon social: ', 'operadorformm01');
                                                echo form_input(["type" => "text", "name" => "operadorformm01", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("operadorformm01")]);
                                            } else {
                                                echo form_label ('Razon social: ', 'operadorformm01');
                                                echo form_input(["type" => "text", "name" => "operadorformm01", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>-->
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("subsectorformm01")) {
                                                echo form_label ('Sub Sector: ', 'subsectorformm01');
                                                echo form_input(["type" => "text", "name" => "subsectorformm01", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("subsectorformm01")]);
                                            } else {
                                                echo form_label ('Sub Sector: ', 'subsectorformm01');
                                                echo form_input(["type" => "text", "name" => "subsectorformm01", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <div class="col-xs-2">
                                            <?php echo form_submit("", "Buscar", "class='btn btn-primary btn-sm'");?>
                                        </div>
                                <?php echo form_close(); ?>
                                        <div class="col-xs-2">
                                            <?php echo form_open('C_formm01/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#00BE67; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" >
                                <?php
                                    $can1 = $cants;
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">NIM</th>
                                            <th style="text-align: center">Fecha NIM</th>
                                            <th style="text-align: center">Expiracion NIM</th>
                                            <th style="text-align: center">Razon Social</th>
                                            <th style="text-align: center">NIT / CI</th>
                                            <th style="text-align: center">Sub Sector</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datos as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->nim;?></td>
                                                <td style="text-align: left"><?php echo $recep->fechanim;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaexpiracion;?></td>
                                                <td style="text-align: left"><?php echo $recep->razonsocial;?></td>
                                                <td style="text-align: center"><?php echo $recep->documento;?></td>
                                                <td style="text-align: left"><?php echo $recep->subsector;?></td>
                                                <td style="text-align: center"><?php echo $recep->lugar;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_formm01/ver/<?php echo $this->Formm01_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Ver</a>
                                                    <!--<a href="<?php echo base_url()?>C_formm01/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary">Ver</a>-->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>