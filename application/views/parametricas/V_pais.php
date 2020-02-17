<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Pais
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_pais/busqueda'); ?>
                                <div class="col-xs-1"></div>
                                <div class="col-xs-2">
                                    <div class="input-group">
                                        <?php if ($this->session->userdata("idpaisPais")) {
                                            echo form_label ('ID: ', 'idpaisPais');
                                            echo form_input(["type" => "text", "name" => "idpaisPais", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idpaisPais")]);
                                        } else {
                                            echo form_label ('ID: ', 'idpaisPais');
                                            echo form_input(["type" => "text", "name" => "idpaisPais", "class" => "form-control search-query", "placeholder" => ""]); 
                                        } ?>
                                    </div>
                                </div>
                                
                                <div class="col-xs-2">
                                    <div class="input-group">
                                        <?php if ($this->session->userdata("paisPais")) {
                                            echo form_label ('Pais: ', 'paisPais');
                                            echo form_input(["type" => "text", "name" => "paisPais", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("paisPais")]);
                                        } else {
                                            echo form_label ('Pais: ', 'paisPais');
                                            echo form_input(["type" => "text", "name" => "paisPais", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_pais/mostrar');?>
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
                                            <th style="text-align: center">Pais</th>
                                            <th style="text-align: center">Estado</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paises as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigo;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcion;?></td>
                                                <td style="text-align: center"><?php echo $recep->estado;?></td>    
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
        
