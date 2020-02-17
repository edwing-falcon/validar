
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Cotizaci&oacuten Minera
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
                                <?php echo form_open('C_cotizacionminera/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idCotizacionMinera")) {
                                                echo form_label ('ID: ', 'idCotizacionMinera');
                                                echo form_input(["type" => "text", "name" => "idCotizacionMinera", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idCotizacionMinera")]);
                                            } else {
                                                echo form_label ('ID: ', 'idCotizacionMinera');
                                                echo form_input(["type" => "text", "name" => "idCotizacionMinera", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("cotizacionMineraMineral")) {
                                                echo form_label ('Mineral: ', 'cotizacionMineraMineral');
                                                echo form_input(["type" => "text", "name" => "cotizacionMineraMineral", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("cotizacionMineraMineral")]);
                                            } else {
                                                echo form_label ('Mineral: ', 'cotizacionMineraMineral');
                                                echo form_input(["type" => "text", "name" => "cotizacionMineraMineral", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("cotizacionMineraDescripcion")) {
                                                echo form_label ('Descripcion: ', 'cotizacionMineraDescripcion');
                                                echo form_input(["type" => "text", "name" => "cotizacionMineraDescripcion", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("cotizacionMineraDescripcion")]);
                                            } else {
                                                echo form_label ('Descripcion: ', 'cotizacionMineraMineral');
                                                echo form_input(["type" => "text", "name" => "cotizacionMineraDescripcion", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php echo form_label ('Seleccionar Fecha Fin: ', 'cotizacionMineraFecha'); ?>
                                            <select id="cotizacionMineraFecha" name="cotizacionMineraFecha" style="width: 230px; height: 35px;" >
                                                <?php 
                                                    $fechafin = ""; 
                                                    if ($this->session->userdata("cotizacionMineraFecha")) { $fechafin = $this->session->userdata("cotizacionMineraFecha"); }
                                                ?>
                                                <option value="">TODAS LAS FECHAS</option>
                                                <?php foreach($fechas as $fecha): ?>
                                                    <?php if($fecha->fechafin == $fechafin):?>
                                                        <option selected value="<?php echo $fecha->fechafin; ?>"><?php echo $fecha->fechafin; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $fecha->fechafin; ?>"><?php echo $fecha->fechafin; ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>    
                                            </select>
                                        </div>
                                    </div>
                            </div>    
                            <div class="row">
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <!--<div class="col-xs-2">
                                            <?php echo form_submit("", "Imprimir", "class='btn btn-success btn-sm'");?>
                                        </div>-->
                                        
                                        <div class="col-xs-2">
                                            <?php echo form_submit("", "Buscar", "class='btn btn-primary btn-sm'");?>
                                        </div>
                                <?php echo form_close(); ?>
                                        <div class="col-xs-2">
                                            <?php echo form_open('C_cotizacionminera/mostrar');?>
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
                                            <th style="text-align: center">Mineral</th>
                                            <th style="text-align: center">Descripcion</th>
                                            <th style="text-align: center">Simbolo</th>
                                            <th style="text-align: center">Unidad</th>
                                            <th style="text-align: center">Cotizacion usb</th>
                                            <th style="text-align: center">Alicuota externa</th>
                                            <th style="text-align: center">Alicuota interna</th>
                                            <th style="text-align: center">Fecha Inicio</th>
                                            <th style="text-align: center">Fecha Fin</th>
                                            <!--<th style="text-align: center">Acciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cotizaciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->mineral;?></td>
                                                <td style="text-align: left"><?php echo $recep->descripcionsincotizacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->simbolo;?></td>
                                                <td style="text-align: center"><?php echo $recep->unidadcotizacion;?></td>
                                                <td style="text-align: right"><?php echo $recep->cotizacionusd;?></td>
                                                <td style="text-align: right"><?php echo $recep->alicuotaexterna;?></td>
                                                <td style="text-align: right"><?php echo $recep->alicuotainterna;?></td>
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
