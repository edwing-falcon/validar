<?php
    $idempleado = $idempleados;
    $nombre = $nombres;
    $apellidopaterno = $apellidopaternos;
    $apellidomaterno = $apellidomaternos;
    $cargo = $cargos;
    $correoinstitucional = $correoinstitucionals;
?> 

<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    CAMBIO DE CORREO INSTITUCIONAL
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        EMPLEADO: <?php echo $nombre." ".$apellidopaterno." ".$apellidomaterno."  CARGO: ".$cargo; ?>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div class="table-header">
                                <!-- Cambio de Password -->
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_cambiocorreoinstitucional/guardar">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="correoinstitucional"> Correo Institucional: </label>
                                            <input type="hidden" name="idempleado" id="idempleado" value="<?php echo $idempleado; ?>" />
                                            <div class="col-sm-9">
                                                <?php if($correoinstitucional): ?>
                                                    <input type="text" name="correoinstitucional" id="correoinstitucional" placeholder="" value="<?php echo $correoinstitucional; ?>" class="col-xs-10 col-sm-5" />
                                                <?php else: ?>
                                                    <input type="text" name="correoinstitucional" id="correoinstitucional" placeholder="" class="col-xs-10 col-sm-5" />
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="space-2"></div>
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-4 col-md-9">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Guardar
                                                </button>
                                            </div>    
                                        </div>
                                    </form>
                                    <div class="space-6"></div>
                                    <?php if( $this->session->userdata("error") ):?>
                                        <div class="alert alert-danger">
                                            <p><?php  echo $this->session->userdata("error");?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if( $this->session->userdata("exito") ):?>
                                        <div class="alert alert-success">
                                            <p><?php  echo $this->session->userdata("exito");?></p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php 
                                        $this->session->unset_userdata('error');
                                        $this->session->unset_userdata('exito');
                                    ?>
                                </div>
                            </div>
                            <br/><br/><br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
