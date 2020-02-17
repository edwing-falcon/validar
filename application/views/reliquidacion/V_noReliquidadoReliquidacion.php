<?php 
$lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    M-03 NO RELIQUIDADOS<br/><br/>
                    Lista de Form. M-03 Validados que no se reliquidaron
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DEPARTAMENTAL: <?php echo $lugar;?> 
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_noReliquidadoReliquidacion/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idnoReliquidadoReliquidacion")) {
                                                echo form_label ('Ingrese ID: ', 'idnoReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idnoReliquidadoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idnoReliquidadoReliquidacion")]);
                                            } else {
                                                echo form_label ('Ingrese ID: ', 'idnoReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idnoReliquidadoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_noReliquidadoReliquidacion/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color:#9630B9; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" >
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
                                            <th style="text-align: center">Oficina reliquidacion</th>
                                            <th style="text-align: center">Codigo reliquidador</th>
                                            <th style="text-align: center">Fecha Envi&oacute Muestra</th>
                                            <th style="text-align: center">C&oacutedigo Envi&oacute Muestra</th>
                                            <th style="text-align: center">CITE Envi&oacute Muestra</th>
                                            <th style="text-align: center">Elementos</th>
                                            <th style="text-align: center">Fecha Validacion</th>
                                            <th style="text-align: center">Observacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($noreliquidadoreliquidaciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->idformm03;?></td>
                                                <td style="text-align: left"><?php echo $recep->oficinareliquidacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigoreliquidador;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigoenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->citeenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->elementos;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechavalidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->observacion;?></td>
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
         