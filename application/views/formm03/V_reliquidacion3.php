	
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO FORM - M03
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        CONCLUIDO
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_concluido3/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idM03Concluido")) {
                                                echo form_label ('Ingrese ID: ', 'idM03Concluido');
                                                echo form_input(["type" => "text", "name" => "idM03Concluido", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idM03Concluido")]);
                                            } else {
                                                echo form_label ('Ingrese ID: ', 'idM03Concluido');
                                                echo form_input(["type" => "text", "name" => "idM03Concluido", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("M03CodigoConcluido")) {
                                                echo form_label ('Codigo: ', 'M03CodigoConcluido');
                                                echo form_input(["type" => "text", "name" => "M03CodigoConcluido", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("M03CodigoConcluido")]);
                                            } else {
                                                echo form_label ('Codigo: ', 'M03CodigoConcluido');
                                                echo form_input(["type" => "text", "name" => "M03CodigoConcluido", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorM03Concluido")) {
                                                echo form_label ('Exportador: ', 'exportadorM03Concluido');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Concluido", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("exportadorM03Concluido")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorM03Concluido');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Concluido", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("compradorM03Concluido")) {
                                                echo form_label ('Comprador: ', 'compradorM03Concluido');
                                                echo form_input(["type" => "text", "name" => "compradorM03Concluido", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("compradorM03Concluido")]);
                                            } else {
                                                echo form_label ('Comprador: ', 'compradorM03Concluido');
                                                echo form_input(["type" => "text", "name" => "compradorM03Concluido", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("fronteraM03Concluido")) {
                                                echo form_label ('Frontera: ', 'fronteraM03Concluido');
                                                echo form_input(["type" => "text", "name" => "fronteraM03Concluido", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("fronteraM03Concluido")]);
                                            } else {
                                                echo form_label ('Frontera: ', 'fronteraM03Recepcion');
                                                echo form_input(["type" => "text", "name" => "fronteraM03Concluido", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_concluido3/mostrar');?>
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
                                            <th style="text-align: center">Codigo</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Fecha Exportacion</th>
                                            <th style="text-align: center">Codigo Frontera</th>
                                            <th style="text-align: center">Frontera</th>
                                            <th style="text-align: center">Validador</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Lote</th>
                                            <th style="text-align: center">Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($concluidos as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigoformm03;?></td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaexportacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigofontera;?></td>
                                                <td style="text-align: center"><?php echo $recep->frontera;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigovalidador;?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->lote;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_concluido3/ver/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                    <!--<a href="<?php echo base_url() ?>assets/formm03/<?php echo $recep->id;?>.pdf" type="application/pdf" width="800" height="600"><span class="fa fa-book"></span></a>-->
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