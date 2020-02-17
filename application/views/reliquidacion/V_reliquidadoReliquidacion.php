<?php 
$lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    M-03 Reliquidados<br/><br/>
                    Lista de Form. M-03 que estan reliquidados
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
                                <?php echo form_open('C_reliquidadoReliquidacion/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idReliquidadoReliquidacion")) {
                                                echo form_label ('Ingrese ID M-03: ', 'idReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idReliquidadoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idReliquidadoReliquidacion")]);
                                            } else {
                                                echo form_label ('Ingrese ID M-03: ', 'idReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "idReliquidadoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoReliquidadoReliquidacion")) {
                                                echo form_label ('Codigo muestra: ', 'codigoReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "codigoReliquidadoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("codigoReliquidadoReliquidacion")]);
                                            } else {
                                                echo form_label ('Codigo muestra: ', 'codigoReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "codigoReliquidadoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorReliquidadoReliquidacion")) {
                                                echo form_label ('Exportador: ', 'exportadorReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorReliquidadoReliquidacion", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("exportadorReliquidadoReliquidacion")]);
                                            } else {
                                                echo form_label ('Exportador: ', 'exportadorReliquidadoReliquidacion');
                                                echo form_input(["type" => "text", "name" => "exportadorReliquidadoReliquidacion", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_reliquidadoReliquidacion/mostrar');?>
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
                                            <th style="text-align: center">Codigo reliquidador</th>
                                            <th style="text-align: center">Elementos</th>
                                            <th style="text-align: center">Fec. Envio Notificaci&oacuten</th>
                                            <th style="text-align: center">Fec. Recepci&oacuten Notificaci&oacuten</th>
                                            <th style="text-align: center">Cuadro de Reliquidaci&oacuten</th>
                                            <th style="text-align: center">Pagos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reliquidadoreliquidaciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->idformm03;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigoenviomuestra;?></td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigoreliquidador;?></td>
                                                <td style="text-align: center"><?php echo $recep->elementos;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechaenvionotificacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->fecharecepcionnotificacion;?></td>
                                                <td style="text-align: center">
                                                    <a href="#" class="btn-xs btn-warning">Ver</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php echo $recep->pago;?>
                                                    &nbsp;
                                                    <a href="<?php echo base_url()?>C_reliquidadoReliquidacion/editarPago/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-success">Pagos</a>
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
         