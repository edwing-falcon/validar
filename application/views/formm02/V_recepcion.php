	
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    LISTADO FORM - M02
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        RECEPCION
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_recepcion/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idM02recepcion")) {
                                                echo form_label ('Ingrese un ID: ', 'idM02recepcion');
                                                echo form_input(["type" => "text", "name" => "idM02recepcion", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idM02recepcion")]);
                                            } else {
                                                echo form_label ('Ingrese un ID: ', 'idM02recepcion');    
                                                echo form_input(["type" => "text", "name" => "idM02recepcion", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>-->
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("compradorM02Recepcion")) {
                                                echo form_label ('Comprador: ', 'compradorM02Recepcion');
                                                echo form_input(["type" => "text", "name" => "compradorM02Recepcion", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("compradorM02Recepcion")]);
                                            } else {
                                                echo form_label ('Comprador: ', 'compradorM02Recepcion');
                                                echo form_input(["type" => "text", "name" => "compradorM02Recepcion", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>-->
                                        </div>
                                    </div>

                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("vendedorM02Recepcion")) {
                                                echo form_label ('Vendedor: ', 'vendedorM02Recepcion');
                                                echo form_input(["type" => "text", "name" => "vendedorM02Recepcion", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("vendedorM02Recepcion")]);
                                            } else {
                                                echo form_label ('Vendedor: ', 'vendedorM02Recepcion');
                                                echo form_input(["type" => "text", "name" => "vendedorM02Recepcion", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                            <!--<span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>-->
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
                                            <?php echo form_open('C_recepcion/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                <?php
                                    $can1 = $cants;
                                    $aux = "sdsa dasd";
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Vendedor</th>
                                            <th style="text-align: center">Fecha Registro</th>
                                            <th style="text-align: center">Fecha Transaccion</th>
                                            <th style="text-align: center">Total Kilos Finos</th>
                                            <th style="text-align: center">Total vbv [Bs]</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recepciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: left"><?php echo $recep->razonsocialvendedor;?></td>
                                                <td style="text-align: center"><?php echo $recep->fecharegistro;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalkilosfinos,2);?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalvbvbs,2);?></td>
                                                <td style="text-align: left"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_recepcion/ver/<?php echo $this->Formm02_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Validar/Rechazar</a>
                                                    <!--<a href="<?php echo base_url()?>C_recepcion/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary">Validar/Rechazar</a>-->
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                            <?php if( $this->session->userdata("error") ):?>
                                <div class="alert alert-danger">
                                    <p><?php  echo $this->session->userdata("error");?></p>
                                </div>
                                <?php $this->session->unset_userdata('error'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
