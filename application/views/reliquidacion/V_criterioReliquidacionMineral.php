<?php
    $lugar = $this->session->userdata("lugar");
?>
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    CRITERIO DE RELIQUIDACION POR MINERAL
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Lista de los minerales y su clasificaci&oacuten mineral, habilitados para su reliquidacion
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_criterioReliquidacionMineral/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idCriterioReliquidacionMineral")) {
                                                echo form_label ('ID Mineral: ', 'idCriterioReliquidacionMineral');
                                                echo form_input(["type" => "text", "name" => "idCriterioReliquidacionMineral", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idCriterioReliquidacionMineral")]);
                                            } else {
                                                echo form_label ('ID Mineral: ', 'idCriterioReliquidacionMineral');
                                                echo form_input(["type" => "text", "name" => "idCriterioReliquidacionMineral", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("mineralCriterioReliquidacionMineral")) {
                                                echo form_label ('Mineral: ', 'mineralCriterioReliquidacionMineral');
                                                echo form_input(["type" => "text", "name" => "mineralCriterioReliquidacionMineral", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("mineralCriterioReliquidacionMineral")]);
                                            } else {
                                                echo form_label ('Mineral: ', 'mineralCriterioReliquidacionMineral');
                                                echo form_input(["type" => "text", "name" => "mineralCriterioReliquidacionMineral", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_criterioReliquidacionMineral/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class='btn btn-danger btn-sm'");?>
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
                            <div class="col-xs-6">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Mineral</th>
                                            <th style="text-align: center">Unidad</th>
                                            <th style="text-align: center">Simbolo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($criterios as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->mineral;?></td>
                                                <td style="text-align: center"><?php echo $recep->unidadcotizacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->simbolo;?></td>
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
