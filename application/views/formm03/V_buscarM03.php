<?php 
    $lugar = $this->session->userdata("lugar");
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    BUSQUEDA FORM - M03 POR ID
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DEPATAMENTAL: <?php echo $lugar; ?>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_buscarM03/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idM03Buscar")) {
                                                echo form_label ('Ingrese un ID: ', 'idM03Buscar');
                                                echo form_input(["type" => "text", "name" => "idM03Buscar", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("idM03Buscar")]);
                                            } else {
                                                echo form_label ('Ingrese un ID: ', 'idM03Buscar');
                                                echo form_input(["type" => "text", "name" => "idM03Buscar", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoM03Buscar")) {
                                                echo form_label ('Ingrese un Codigo: ', 'codigoM03Buscar');
                                                echo form_input(["type" => "text", "name" => "codigoM03Buscar", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("codigoM03Buscar")]);
                                            } else {
                                                echo form_label ('Ingrese un Codigo: ', 'codigoM03Buscar');
                                                echo form_input(["type" => "text", "name" => "codigoM03Buscar", "class" => "form-control", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("exportadorM03Buscar")) {
                                                echo form_label ('Ingrese Exportador: ', 'exportadorM03Buscar');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Buscar", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("exportadorM03Buscar")]);
                                            } else {
                                                echo form_label ('Ingrese Exportador: ', 'exportadorM03Buscar');
                                                echo form_input(["type" => "text", "name" => "exportadorM03Buscar", "class" => "form-control", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_buscarM03/mostrar');?>
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
                                            <th style="text-align: center">Estado</th>
                                            <th style="text-align: center">Estado Reliquidacion</th>
                                            <th style="text-align: center">Validador</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Fecha Transaccion</th>
                                            <th style="text-align: center">Fecha Declaracion</th>
                                            <th style="text-align: center">Frontera</th>
                                            <th style="text-align: center">Estado Revision</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($buscados as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigoformm03;?></td>
                                                <td style="text-align: left"><?php echo $recep->estado;?></td>
                                                <td style="text-align: left"><?php echo $recep->estadoreliquidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->codigovalidador;?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechadeclaracion;?></td>
                                                <td style="text-align: center"><?php echo $recep->aduana;?></td>
                                                <td style="text-align: left"><?php echo $recep->estadorevision;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_buscarM03/ver/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
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