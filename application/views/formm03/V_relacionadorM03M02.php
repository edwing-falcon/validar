
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO DE RELACION ENTRE M-03 y M-02
                    <!--<small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        RECEPCION
                    </small>-->
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_relacionadorM03M02/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idformm03relacionadorM03M02")) {
                                                echo form_label ('Ingrese un ID M-03: ', 'idformm03relacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "idformm03relacionadorM03M02", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idformm03relacionadorM03M02")]);
                                            } else {
                                                echo form_label ('Ingrese un ID M-03: ', 'idformm03relacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "idformm03relacionadorM03M02", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idformm02relacionadorM03M02")) {
                                                echo form_label ('Ingrese un ID M-02: ', 'idformm02relacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "idformm02relacionadorM03M02", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idformm02relacionadorM03M02")]);
                                            } else {
                                                echo form_label ('Ingrese un ID M-02: ', 'idformm02relacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "idformm02relacionadorM03M02", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("obsrelacionadorM03M02")) {
                                                echo form_label ('Observacion: ', 'obsrelacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "obsrelacionadorM03M02", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("obsrelacionadorM03M02")]);
                                            } else {
                                                echo form_label ('Observacion: ', 'obsrelacionadorM03M02');
                                                echo form_input(["type" => "text", "name" => "obsrelacionadorM03M02", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_relacionadorM03M02/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" >
                                <?php
                                    $can1 = $cants;
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <h5 class="header blue">Lista de Datos</h5>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">ID M-03</th>
                                            <th style="text-align: center">ID M-02</th>
                                            <th style="text-align: center">OBSERVACIONES</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($relacionadors as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->idformm03;?></td>
                                                <td style="text-align: left"><?php echo $recep->idformm02;?></td>
                                                <td style="text-align: left"><?php echo $recep->obs;?></td>
                                                <!--<td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_relacionadorM03M02/ver/<?php echo $this->Formm03_model->encriptar($recep->idformm03);?>" class="btn-xs btn-warning">ver</a>
                                                </td>-->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                            <?php if( $this->session->userdata("error") ):?>
                                <div class="alert alert-danger">
                                    <p><?php  echo $this->session->userdata("error");?></p>
                                </div>
                                <?php $this->session->unset_userdata('error'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
