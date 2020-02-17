<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Entidades Financieras
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_entidadfinanciera/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idEntidadFinanciera")) {
                                                echo form_label ('ID: ', 'idEntidadFinanciera');
                                                echo form_input(["type" => "text", "name" => "idEntidadFinanciera", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idEntidadFinanciera")]);
                                            } else {
                                                echo form_label ('ID: ', 'idEntidadFinanciera');
                                                echo form_input(["type" => "text", "name" => "idEntidadFinanciera", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("entidadFinanciera")) {
                                                echo form_label ('Entidad: ', 'entidadFinanciera');
                                                echo form_input(["type" => "text", "name" => "entidadFinanciera", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("entidadFinanciera")]);
                                            } else {
                                                echo form_label ('Entidad: ', 'entidadFinanciera');
                                                echo form_input(["type" => "text", "name" => "entidadFinanciera", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_entidadfinanciera/mostrar');?>
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
                                            <th style="text-align: center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($entidades as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcion;?></td>
                                                <td style="text-align: center"><?php echo $recep->estado;?></td>
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
