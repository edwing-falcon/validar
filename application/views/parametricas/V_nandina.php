<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Nandina
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_nandina/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idNandina")) {
                                                echo form_label ('ID: ', 'idNandina');
                                                echo form_input(["type" => "text", "name" => "idNandina", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idNandina")]);
                                            } else {
                                                echo form_label ('ID: ', 'idNandina');
                                                echo form_input(["type" => "text", "name" => "idNandina", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoNandina")) {
                                                echo form_label ('Codigo: ', 'codigoNandina');
                                                echo form_input(["type" => "text", "name" => "codigoNandina", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("codigoNandina")]);
                                            } else {
                                                echo form_label ('Codigo: ', 'codigoNandina');
                                                echo form_input(["type" => "text", "name" => "codigoNandina", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("descripcionNandina")) {
                                                echo form_label ('Descripcion: ', 'descripcionNandina');
                                                echo form_input(["type" => "text", "name" => "descripcionNandina", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("descripcionNandina")]);
                                            } else {
                                                echo form_label ('Descripcion: ', 'descripcionNandina');
                                                echo form_input(["type" => "text", "name" => "descripcionNandina", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("mineralNandina")) {
                                                echo form_label ('Mineral: ', 'mineralNandina');
                                                echo form_input(["type" => "text", "name" => "mineralNandina", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("mineralNandina")]);
                                            } else {
                                                echo form_label ('Mineral: ', 'mineralNandina');
                                                echo form_input(["type" => "text", "name" => "mineralNandina", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_nandina/mostrar');?>
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
                                            <th style="text-align: center">Codigo</th>
                                            <th style="text-align: center">Descripcion</th>
                                            <th style="text-align: center">Mineral</th>
                                            <th style="text-align: center">Estado</th>
                                            <th style="text-align: center">Calculo RM</th>
                                            <th style="text-align: center">Clasificacion</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($nandinas as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigo;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcion;?></td>
                                                <td style="text-align: left"><?php echo $recep->mineral;?></td>
                                                <td style="text-align: left"><?php echo $recep->estado;?></td>
                                                <td style="text-align: left"><?php echo $recep->calculorm;?></td>
                                                <?php if($recep->clasificacionmineral == 'SIN CLASIFICAR') { ?>
                                                    <td style="text-align: left; color: red"><?php echo $recep->clasificacionmineral;?></td>
                                                <?php } else { ?>
                                                    <td style="text-align: left"><?php echo $recep->clasificacionmineral;?></td>
                                                <?php } ?>
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
