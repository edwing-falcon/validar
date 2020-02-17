	
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO FORM - M02
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        RECHAZADO
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
                                <?php echo form_open('C_rechazado/busqueda'); ?>
                                    <div class="col-xs-2"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idM02Rechazado")) {
                                                echo form_label ('Ingrese un ID: ', 'idM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "idM02Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idM02Rechazado")]);
                                            } else {
                                                echo form_label ('Ingrese un ID: ', 'idM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "idM02Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("compradorM02Rechazado")) {
                                                echo form_label ('Comprador: ', 'compradorM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "compradorM02Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("compradorM02Rechazado")]);
                                            } else {
                                                echo form_label ('Comprador: ', 'compradorM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "compradorM02Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>	
                                        </div>
                                    </div>

                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("vendedorM02Rechazado")) {
                                                echo form_label ('Vendedor: ', 'vendedorM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "vendedorM02Rechazado", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("vendedorM02Rechazado")]);
                                            } else {
                                                echo form_label ('Vendedor: ', 'vendedorM02Rechazado');
                                                echo form_input(["type" => "text", "name" => "vendedorM02Rechazado", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_rechazado/mostrar');?>
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
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Vendedor</th>
                                            <th style="text-align: center">Fecha Transaccion</th>
                                            <th style="text-align: center">Fecha Rechazo</th>
                                            <th style="text-align: center">Total Kilos Finos</th>
                                            <th style="text-align: center">Total vbv [Bs]</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Cant. Rechazos</th>
                                            <th style="text-align: center">Historial</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($rechazados)):?>
                                        <?php foreach ($rechazados as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: left"><?php echo $recep->razonsocialvendedor;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechavalidacion;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalkilosfinos,2);?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalvbvbs,2);?></td>
                                                <td style="text-align: left"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->contador_rechazo;?></td>
                                                <td style="text-align: center">
                                                    <a href="#" data-toggle="modal" data-target="#bitacoraformulario" class="btn-xs btn-success" onclick="carga_tabla(<?php echo $recep->id;?>, 'modal')">Bitacora</a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_rechazado/ver/<?php echo $this->Formm02_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Ver</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <?php endif ?>       
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal fade" id="bitacoraformulario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <b>Bitacora de Formulario</b>
                </h4>
            </div>
            <div class="modal-body">
                <div id="tabla"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function carga_tabla(id){
        $('#tabla').load('<?php echo base_url(); ?>C_rechazado/bitacora/'+id);
}
</script>    
