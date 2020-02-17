<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Entidades Aporte
                    </small>
                    <!-- aqui -->
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_entidadaporte/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("identidadAporte")) {
                                                echo form_label ('ID: ', 'identidadAporte');
                                                echo form_input(["type" => "text", "name" => "identidadAporte", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("identidadAporte")]);
                                            } else {
                                                echo form_label ('ID: ', 'identidadAporte');
                                                echo form_input(["type" => "text", "name" => "identidadAporte", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("entidadAporte")) {
                                                echo form_label ('Entidad de Aporte: ', 'entidadAporte');
                                                echo form_input(["type" => "text", "name" => "entidadAporte", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("entidadAporte")]);
                                            } else {
                                                echo form_label ('Entidad de Aporte: ', 'entidadAporte');
                                                echo form_input(["type" => "text", "name" => "entidadAporte", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_entidadaporte/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
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
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Entidad</th>
                                            <th style="text-align: center">Porcentaje 1</th>
                                            <th style="text-align: center">Porcentaje 2</th>
                                            <th style="text-align: center">Bandera</th>
                                            <th style="text-align: center">Bandera 2</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($entidades as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcion;?></td>
                                                <td style="text-align: right"><?php echo $recep->porcentaje1;?></td>
                                                <td style="text-align: right"><?php echo $recep->porcentaje2;?></td>
                                                <td style="text-align: right"><?php echo $recep->bandera;?></td>
                                                <td style="text-align: right"><?php echo $recep->bandera2;?></td>
                                                <!--<td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_laboratorio/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary"><span class="fa fa-check-square-o"></span></a>
                                                </td>-->
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
