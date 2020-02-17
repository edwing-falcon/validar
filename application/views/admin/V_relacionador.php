	
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    RELACIONADOR
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        M02 - M03
                    </small>
                    <!-- aqui -->
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div class="table-header">
                                <?php
                                    $can1 = $cants;
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <br/>
                            <br/>
                            <div class="col-xs-2"></div>
                            <div class="col-xs-2">
                                <?php echo form_open('C_concluido/busqueda'); ?>
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscador")) {
                                                echo form_input(["type" => "text", "name" => "busqueda", "class" => "form-control", "placeholder" => "Ingrese un ID", "value" => $this->session->userdata("buscador")]);
                                            } else {
                                                echo form_input(["type" => "text", "name" => "busqueda", "class" => "form-control", "placeholder" => "Ingrese un ID"]); 
                                            } ?>	
                                            <span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>				      		
                                            </span>
                                        </div>
                                
                            </div>
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <?php if ($this->session->userdata("buscomprador")) {
                                        echo form_input(["type" => "text", "name" => "buscomprador", "class" => "form-control search-query", "placeholder" => "Ingrese un comprador", "value" => $this->session->userdata("buscomprador")]);
                                    } else {
                                        echo form_input(["type" => "text", "name" => "buscomprador", "class" => "form-control search-query", "placeholder" => "Ingrese un comprador"]); 
                                    } ?>	
                                    <span class="input-group-btn">
                                        <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-xs-2">
                                <div class="input-group">
                                    <?php if ($this->session->userdata("busvendedor")) {
                                        echo form_input(["type" => "text", "name" => "busvendedor", "class" => "form-control search-query", "placeholder" => "Ingrese un vendedor", "value" => $this->session->userdata("busvendedor")]);
                                    } else {
                                        echo form_input(["type" => "text", "name" => "busvendedor", "class" => "form-control search-query", "placeholder" => "Ingrese un vendedor"]); 
                                    } ?>	
                                    <span class="input-group-btn">
                                        <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                    </span>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <div class="col-md-2">
                                <?php echo form_open('C_concluido/mostrar');?>
                                    <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                <?php echo form_close(); ?>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Vendedor</th>
                                            <th style="text-align: center">Fecha Transaccion</th>
                                            <th style="text-align: center">Fecha Validacion</th>
                                            <th style="text-align: center">Total Kilos Finos</th>
                                            <th style="text-align: center">Total vbv [Bs]</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($concluidos as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: left"><?php echo $recep->razonsocialvendedor;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechavalidacion;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalkilosfinos,2);?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalvbvbs,2);?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_concluido/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary">Ver</a>
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

        
