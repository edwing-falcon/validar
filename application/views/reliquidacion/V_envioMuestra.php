<?php 
$lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    ENVIO DE MUESTRA
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
                                <?php echo form_open('C_envioMuestra/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorEnvioMuestra")) {
                                                echo form_label ('Exportador: ', 'exportadorEnvioMuestra');
                                                echo form_input(["type" => "text", "name" => "exportadorEnvioMuestra", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("exportadorEnvioMuestra")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorEnvioMuestra');
                                                echo form_input(["type" => "text", "name" => "exportadorEnvioMuestra", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_envioMuestra/mostrar');?>
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
                                            <th style="text-align: center"></th>
                                            <th style="text-align: center">ID M-03</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Mineral</th>
                                            <th style="text-align: center">Lote</th>
                                            <th style="text-align: center">Humedad</th>
                                            <th style="text-align: center">Codigo Muestra</th>
                                            <th style="text-align: center">Cite Envi&oacute Muestra</th>
                                            <th style="text-align: center">Envi&oacute de Muestra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($enviomuestras as $recep) { ?>
                                            <tr>
                                                <td class="center">
                                                    <label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $recep->idformm03;?>
                                                </td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: center"><?php echo $recep->mineral;?></td>
                                                <td style="text-align: left"><?php echo $recep->lote;?></td>
                                                <td style="text-align: center"><?php echo $recep->humedad;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigoenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->citeenviomuestra;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaenviomuestra;?></td>
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