<?php
    $estadoMineral = $estadoMinerals;
?>
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Mineral
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
                                <?php echo form_open('C_mineral/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idMineral")) {
                                                echo form_label ('ID: ', 'idMineral');
                                                echo form_input(["type" => "text", "name" => "idMineral", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idMineral")]);
                                            } else {
                                                echo form_label ('ID: ', 'idMineral');
                                                echo form_input(["type" => "text", "name" => "idMineral", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("mineral")) {
                                                echo form_label ('Mineral: ', 'mineral');
                                                echo form_input(["type" => "text", "name" => "mineral", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("mineral")]);
                                            } else {
                                                echo form_label ('Mineral: ', 'mineral');
                                                echo form_input(["type" => "text", "name" => "mineral", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php echo form_label ('Seleccionar Estado: ', 'estadoMineral'); ?>
                                            <select id="estadoMineral" name="estadoMineral" style="width: 230px; height: 35px;" >
                                                <option value="" selected>Seleccione un estado</option>
                                                <!--<?php 
                                                    $estadoMineral = ""; 
                                                    if ($this->session->userdata("estadoMineral")) { $estadoMineral = $this->session->userdata("estadoMineral"); }
                                                ?>-->
                                                <?php foreach($estados as $estado): ?>
                                                    <?php if($estado->estado == $estadoMineral):?>
                                                        <option selected value="<?php echo $estado->estado; ?>"><?php echo $estado->estadodescri; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo $estado->estado; ?>"><?php echo $estado->estadodescri; ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>    
                                            </select>
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
                                            <?php echo form_open('C_mineral/mostrar');?>
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
                                            <th style="text-align: center">Descripcion</th>
                                            <th style="text-align: center">Unidad Cotizacion</th>
                                            <th style="text-align: center">Descripcion Sin Cotizacion</th>
                                            <th style="text-align: center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($minerales as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcion;?></td>
                                                <td style="text-align: left"><?php echo $recep->unidadcotizacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcionsincotizacion;?></td>
                                                <td style="text-align: left"><?php echo $recep->estado;?></td>
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
