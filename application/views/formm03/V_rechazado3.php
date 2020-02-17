
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO FORM - M03
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        RECHAZADO
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_rechazado3/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idM03Rechazado")) {
                                                echo form_label ('Ingrese ID: ', 'idM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "idM03Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idM03Rechazado")]);
                                            } else {
                                                echo form_label ('Ingrese ID: ', 'idM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "idM03Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("M03CodigoRechazado")) {
                                                echo form_label ('Codigo: ', 'M03CodigoRechazado');
                                                echo form_input(["type" => "text", "name" => "M03CodigoRechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("M03CodigoRechazado")]);
                                            } else {
                                                echo form_label ('Codigo: ', 'M03CodigoRechazado');
                                                echo form_input(["type" => "text", "name" => "M03CodigoRechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorM03Rechazado")) {
                                                echo form_label ('Exportador: ', 'exportadorM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("exportadorM03Rechazado")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("compradorM03Rechazado")) {
                                                echo form_label ('Comprador: ', 'compradorM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "compradorM03Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("compradorM03Rechazado")]);
                                            } else {
                                                echo form_label ('Comprador: ', 'compradorM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "compradorM03Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("fronteraM03Rechazado")) {
                                                echo form_label ('Frontera: ', 'fronteraM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "fronteraM03Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("fronteraM03Rechazado")]);
                                            } else {
                                                echo form_label ('Frontera: ', 'fronteraM03Rechazado');
                                                echo form_input(["type" => "text", "name" => "fronteraM03Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_rechazado3/mostrar');?>
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
                            <br/>
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
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Lote</th>
                                            <th style="text-align: center">Cant. Rechazos</th>
                                            <th style="text-align: center">Historial</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rechazados as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigoformm03;?></td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaexportacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigofontera;?></td>
                                                <td style="text-align: center"><?php echo $recep->frontera;?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->lote;?></td>
                                                <td style="text-align: center"><?php echo $recep->contador_rechazo;?></td>
                                                <td style="text-align: center">
                                                    <a href="#" data-toggle="modal" data-target="#bitacoraformulario" class="btn-xs btn-success" onclick="carga_tabla(<?php echo $recep->id;?>, 'modal')">Bitacora</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_rechazado3/ver/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Ver</a>
                                                    <!--<a href="<?php echo base_url()?>C_rechazado3/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary">Ver</a>-->
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
        
        <div class="modal fade" id="bitacoraformulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                <b>Bitacora de Formulario</b>
                            </h4>
                    </div>
                    <div class="modal-body">
                        <div id="tabla"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            function carga_tabla(id){
                $('#tabla').load('<?php echo base_url(); ?>C_rechazado3/bitacora3/'+id);
                //$('#tabla').load('http://192.168.242.106/validador/C_rechazado3/bitacora3/'+id);
            }
        </script>