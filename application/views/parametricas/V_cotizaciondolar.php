<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Cotizacion Dolar 
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
                            <!--<div class="row">
                                <?php echo form_open('C_aduana/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigo")) {
                                                echo form_input(["type" => "text", "name" => "buscodigo", "class" => "form-control search-query", "placeholder" => "Codigo", "value" => $this->session->userdata("buscodigo")]);
                                            } else {
                                                echo form_input(["type" => "text", "name" => "buscodigo", "class" => "form-control search-query", "placeholder" => "Codigo"]); 
                                            } ?>	
                                            <span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("aduana")) {
                                                echo form_input(["type" => "text", "name" => "busaduana", "class" => "form-control search-query", "placeholder" => "Aduana", "value" => $this->session->userdata("busaduana")]);
                                            } else {
                                                echo form_input(["type" => "text", "name" => "busaduana", "class" => "form-control search-query", "placeholder" => "Aduana"]); 
                                            } ?>	
                                            <span class="input-group-btn">
                                                <?php echo form_button(["type" => "submit", "class" => "btn btn-info btn-sm", "content"=>"<span class='glyphicon glyphicon-search'></span>"]);?>
                                            </span>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                                <div class="col-xs-2">
                                    <?php echo form_open('C_aduana/mostrar');?>
                                        <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>-->
                            <!--<div class="row">
                                <?php echo form_open('C_cotizaciondolar/recalcular');?>
                                        <?php echo form_submit("", "CALCULAR LAS FECHAS", "class= 'btn btn-danger btn-sm'");?>
                                    <?php echo form_close(); ?>
                            </div>-->
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Valor Bs.</th>
                                            <th style="text-align: center">Fecha Inicio</th>
                                            <th style="text-align: center">Fecha Final</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cotizaciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->valorbs;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechainicio;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechafin;?></td>
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
