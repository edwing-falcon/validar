<?php 
$lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    PENDIENTES DE RELIQUIDACION<br/><br/>
                    Lista de Form. M-03 que estan con estado pendiente reliquidaci&oacuten
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
                                <?php echo form_open('C_pendienteReliquidacion/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idPendienteReliquidacion")) {
                                                echo form_label ('Ingrese ID M-03: ', 'idPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idPendienteReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idPendienteReliquidacion")]);
                                            } else {
                                                echo form_label ('Ingrese ID M-03: ', 'idPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idPendienteReliquidacion", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoPendienteReliquidacion")) {
                                                echo form_label ('Codigo muestra: ', 'codigoPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "codigoPendienteReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("codigoPendienteReliquidacion")]);
                                            } else {
                                                echo form_label ('Codigo muestra: ', 'codigoPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "codigoPendienteReliquidacion", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorPendienteReliquidacion")) {
                                                echo form_label ('Exportador: ', 'exportadorPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorPendienteReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("exportadorPendienteReliquidacion")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorPendienteReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorPendienteReliquidacion", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_pendienteReliquidacion/mostrar');?>
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
                                            <th style="text-align: center">ID M-03</th>
                                            <th style="text-align: center">Codigo Muestra</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Fecha Reliquidacion</th>
                                            <th style="text-align: center">Reliquidaci&oacuten</th>
                                            <th style="text-align: center">Cuadro Reliquidacion Preliminar</th>
                                            <th style="text-align: center">Datos Notificaci&oacuten</th>
                                            <th style="text-align: center">Fecha Recepcion Notificaci&oacuten</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>             
                                        <?php foreach ($pendientesreliquidaciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->idformm03;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigoenviomuestra;?></td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechareliquidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->tiporeliquidacion;?></td>
                                                <td style="text-align: center">
                                                    <?php if($recep->tiporeliquidacion == "LEY"): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/cuadroReliquidacionLeyPreliminar/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-warning" target="_blank">Ver</a>
                                                    <?php endif; ?>
                                                    &nbsp;
                                                    <?php if($recep->tiporeliquidacion == "HUMEDAD"): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/cuadroReliquidacionHumedadPreliminar/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-warning" target="_blank">Ver</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $recep->fechaenvionotificacion; ?>
                                                    &nbsp;
                                                    <a href="<?php echo base_url()?>C_pendienteReliquidacion/editarDatosNotificacion/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-success">Editar</a>
                                                    &nbsp;
                                                    <?php if($recep->tiporeliquidacion == "LEY"): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/notificacionReliquidacionLey/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-warning" target="_blank">Ver</a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($recep->tiporeliquidacion == "HUMEDAD"): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/notificacionReliquidacionHumedad/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-warning" target="_blank">Ver</a>
                                                    <?php endif; ?>
                                                        
                                                    <?php if($recep->tiporeliquidacion == "PESO"): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/notificacionReliquidacionPeso/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-warning" target="_blank">Ver P</a>
                                                    <?php endif; ?>                                                    
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $recep->fecharecepcionnotificacion;?>
                                                    &nbsp;
                                                    <?php if(strlen($recep->fechaenvionotificacion) > 0 and strlen($recep->citenotificacion) > 0): ?>
                                                        <a href="<?php echo base_url()?>C_pendienteReliquidacion/editarFechaRecepcionNotificacion/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-success">Editar</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_pendienteReliquidacion/ejecutar/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Ejecutar</a>
                                                    &nbsp;
                                                    <a href="<?php echo base_url()?>C_pendienteReliquidacion/dirimision/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Dirimici&oacuten</a>
                                                    &nbsp;
                                                    <a href="<?php echo base_url()?>C_pendienteReliquidacion/cancelar/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-danger">Cancelar</a>
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
            <?php if( $this->session->userdata("error") ):?>
                <div class="alert alert-danger">
                    <p><?php  echo $this->session->userdata("error");?></p>
                </div>
                <?php $this->session->unset_userdata('error'); ?>
            <?php endif; ?>
        </div>
 