<?php 
    $lugar = $this->session->userdata("lugar");
    $idformm03 = $idformm03s;
    $fechaenviomuestra = $fechaenviomuestras;
    $citeenviomuestra = $citeenviomuestras;
    $fechaActual = $fechaActuals;
    $empresaexportadora = $empresaexportadoras;
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    EDITAR DATOS DE ENVIO DE MUESTRA<br/><br/>
                    ID M-03: <?php echo $idformm03;?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Empresa exportadora: <?php echo $empresaexportadora;?><br/>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_muestreoReliquidacion/guardar_datosEnvioMuestra">
                                    <br/>
                                    <input type="hidden" name="idformm03" value="<?php echo $idformm03; ?>" />
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fecha de Envi&oacute de Muestra: </label>
                                        <div class="col-sm-9">
                                            <?php if($fechaenviomuestra): ?>
                                                <input type="date" name="fechaenviomuestra" id="fechaenviomuestra" placeholder="" value="<?php echo $fechaenviomuestra; ?>" class="col-xs-10 col-sm-5" />
                                            <?php else: ?>
                                                <input type="date" name="fechaenviomuestra" id="fechaenviomuestra" placeholder="" value="<?php echo $fechaActual; ?>"class="col-xs-10 col-sm-5" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cite de Envi&oacute de Muestra: </label>
                                        <div class="col-sm-9">
                                            <?php if($citeenviomuestra): ?>
                                                <input type="text" name="citeenviomuestra" id="citeenviomuestra" placeholder="" value="<?php echo $citeenviomuestra; ?>" class="col-xs-10 col-sm-5" maxlength="30" />
                                            <?php else: ?>
                                                <input type="text" name="citeenviomuestra" id="citeenviomuestra" placeholder="" value="" class="col-xs-10 col-sm-5" maxlength="30" />
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="clearfix form-actions">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <div class="col-xs-2">
                                                        <button class="btn btn-info" name="btn" value="aceptar" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Aceptar
                                                        </button>
                                                    </div>

                                                    <div class="col-xs-2">
                                                        <button  class="btn btn-danger" name="btn" value="cancelar" type="submit" >
                                                            <i class="ace-icon fa fa-ban bigger-110"></i>
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if( $this->session->userdata("error") ):?>
                <div class="alert alert-danger">
                    <p><?php  echo $this->session->userdata("error");?></p>
                </div>
                <?php $this->session->unset_userdata('error'); ?>
            <?php endif; ?>
        </div>
        
        