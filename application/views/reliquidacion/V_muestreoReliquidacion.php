<?php 
$lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    MUESTREO DE RELIQUIDACION DE FORMULARIO M-03<br/><br/>
                    Form. M-03 Validados y Transcriptos no reliquidados y cumplan el criterio de reliquidaci&oacuten por mineral
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
                                <?php echo form_open('C_muestreoReliquidacion/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idMuestreoReliquidacion")) {
                                                echo form_label ('Ingrese ID M-03: ', 'idMuestreoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idMuestreoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idMuestreoReliquidacion")]);
                                            } else {
                                                echo form_label ('Ingrese ID M-03: ', 'idMuestreoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idMuestreoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoMuestreoReliquidacion1")) {
                                                echo form_label ('Codigo muestra 1: ', 'codigoMuestreoReliquidacion1');
                                                echo form_input(["type" => "text", "name" => "codigoMuestreoReliquidacion1", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("codigoMuestreoReliquidacion1")]);
                                            } else {
                                                echo form_label ('Codigo muestra 1: ', 'codigoMuestreoReliquidacion1');
                                                echo form_input(["type" => "text", "name" => "codigoMuestreoReliquidacion1", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoMuestreoReliquidacion2")) {
                                                echo form_label ('Codigo muestra 2: ', 'codigoMuestreoReliquidacion2');
                                                echo form_input(["type" => "text", "name" => "codigoMuestreoReliquidacion2", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("codigoMuestreoReliquidacion2")]);
                                            } else {
                                                echo form_label ('Codigo muestra 2: ', 'codigoMuestreoReliquidacion2');
                                                echo form_input(["type" => "text", "name" => "codigoMuestreoReliquidacion2", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorMuestreoReliquidacion")) {
                                                echo form_label ('Exportador: ', 'exportadorMuestreoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorMuestreoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("exportadorMuestreoReliquidacion")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorMuestreoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorMuestreoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_muestreoReliquidacion/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                        
                                        <div class="col-xs-2">
                                            <?php echo form_open('C_muestreoReliquidacion/importarExcel');?>
                                                <?php echo form_submit("", "Importar Excel", "class= 'btn btn-success btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if( $this->session->userdata("error") ):?>
                                <div class="alert alert-danger">
                                    <p><?php  echo $this->session->userdata("error");?></p>
                                </div>
                            <?php endif; ?>
                            <?php $this->session->unset_userdata('error'); ?>
                            <div style="background-color:#9630B9; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" >
                                <?php
                                    $can1 = $cants;
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <h5 class="header blue">Lista de Datos</h5>  (Por defecto la fecha de envio de muestra es la fecha de validacion)
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID M-03</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Mineral</th> 
                                            <th style="text-align: center">Lote</th>
                                            <th style="text-align: center">Humedad</th>
                                            <th style="text-align: center">Fecha Muestra</th>
                                            <th style="text-align: center">Codigo Muestra 1</th>
                                            <th style="text-align: center">Codigo Muestra 2</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reliquidaciones as $recep) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $recep->idformm03;?>
                                                    &nbsp;
                                                    <a href="<?php echo base_url()?>C_buscarM03/ver/<?php echo $this->Formm03_model->encriptar($recep->idformm03);?>" class="btn-xs btn-primary">ver</a>
                                                </td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: left"><?php echo $recep->mineral;?></td>
                                                <td style="text-align: left"><?php echo $recep->lote;?></td>
                                                <td style="text-align: center"><?php echo $recep->humedad;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechamuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigoenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigomuestra;?></td>
                                                <td style="text-align: center">
                                                    <?php if(strlen($recep->fechamuestra) > 0 and strlen($recep->codigoenviomuestra) > 0 and strlen($recep->citeenviomuestra) > 0):?>
                                                        <a href="<?php echo base_url()?>C_muestreoReliquidacion/notificacionEnvioMuestra/<?php echo $this->Formm03_model->encriptar($recep->idformm03);?>" class="btn-xs btn-warning" target="_blank">Ver PDF</a>
                                                    <?php endif; ?>    
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