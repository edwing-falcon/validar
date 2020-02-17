<?php
    $lugar = $this->session->userdata("lugar");
?>
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    CRITERIO DE RELIQUIDACION POR EMPRESA
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DEPARTAMENTAL <?php echo $lugar;?>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_criterioReliquidacionOperador/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idCriterioReliquidacionOperador")) {
                                                echo form_label ('ID: ', 'idCriterioReliquidacionOperador');
                                                echo form_input(["type" => "text", "name" => "idCriterioReliquidacionOperador", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idCriterioReliquidacionOperador")]);
                                            } else {
                                                echo form_label ('ID: ', 'idCriterioReliquidacionOperador');
                                                echo form_input(["type" => "text", "name" => "idCriterioReliquidacionOperador", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("operadorCriterioReliquidacionOperador")) {
                                                echo form_label ('Empresa: ', 'operadorCriterioReliquidacionOperador');
                                                echo form_input(["type" => "text", "name" => "operadorCriterioReliquidacionOperador", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("operadorCriterioReliquidacionOperador")]);
                                            } else {
                                                echo form_label ('Empresa: ', 'operadorCriterioReliquidacionOperador');
                                                echo form_input(["type" => "text", "name" => "operadorCriterioReliquidacionOperador", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_criterioReliquidacionOperador/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class='btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
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
                                            <th style="text-align: center">Empresa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($criterios as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->operador;?></td>
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
