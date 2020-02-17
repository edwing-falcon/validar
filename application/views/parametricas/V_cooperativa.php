<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Cooperativas
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
                                <?php echo form_open('C_cooperativa/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idCooperativa")) {
                                                echo form_label ('ID: ', 'idCooperativa');
                                                echo form_input(["type" => "text", "name" => "idCooperativa", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idCooperativa")]);
                                            } else {
                                                echo form_label ('ID: ', 'idCooperativa');
                                                echo form_input(["type" => "text", "name" => "idCooperativa", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("cooperativa")) {
                                                echo form_label ('Cooperativa: ', 'cooperativa');
                                                echo form_input(["type" => "text", "name" => "cooperativa", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("cooperativa")]);
                                            } else {
                                                echo form_label ('Cooperativa: ', 'cooperativa');
                                                echo form_input(["type" => "text", "name" => "cooperativa", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_cooperativa/mostrar');?>
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
                                            <th style="text-align: center">Nro DIGECO</th>
                                            <th style="text-align: center">Cooperativa</th>
                                            <th style="text-align: center">Fedecomin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cooperativas as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrodigeco;?></td>
                                                <td style="text-align: left"><?php echo $recep->nombre;?></td>
                                                <td style="text-align: left"><?php echo $recep->fedecomin;?></td>
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
