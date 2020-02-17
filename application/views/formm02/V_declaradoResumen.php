	
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO FORM - M02
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DECLARADOS POR EL OPERADOR SIN ENVIO A LA DEPARTAMENTAL PARA SU VALIDACION &oacute RECHAZO
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
                                <div class="col-xs-12">
                                    <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_declarado/busqueda">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comprador: </label>
                                            <div class="col-sm-4">
                                                <?php if($this->session->userdata("compradorM02Declarado")): ?>
                                                    <input type="text" name="compradorM02Declarado" id="compradorM02Declarado" placeholder="" value="<?php echo $this->session->userdata("compradorM02Declarado"); ?>" class="col-xs-10 col-sm-5" />
                                                <?php else: ?>
                                                    <input type="text" name="compradorM02Declarado" id="compradorM02Declarado" placeholder="" class="col-xs-10 col-sm-5" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <div class="col-xs-2">
                                                    <input type="submit" value="Buscar" class="btn btn-primary btn-sm">
                                                </div>
                                    </form>
                                                <div class="col-xs-2">
                                                    <?php echo form_open('C_declarado/mostrar');?>
                                                        <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                                    <?php echo form_close(); ?>
                                                </div>
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
                            <div class="col-xs-9">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">COMPRADOR</th>
                                            <th style="text-align: center">NIM</th>
                                            <th style="text-align: center">NUM. FORMULARIOS</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($declarados as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->empresa;?></td>
                                                <td style="text-align: left"><?php echo $recep->nim;?></td>
                                                <td style="text-align: left"><?php echo $recep->cantidad;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_declaradoDetalle/detalle/<?php echo $recep->nim;?>" class="btn-xs btn-primary">Ver Detalle de Formularios</a>
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
