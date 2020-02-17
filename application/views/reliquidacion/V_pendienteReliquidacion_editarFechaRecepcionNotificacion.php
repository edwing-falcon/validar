<?php 
    /*$id = $this->session->userdata("idRecepcionNotificacion");
    $idformm03 = $this->session->userdata("idformm03RecepcionNotificacion");
    $fechaenvionotificacion = $this->session->userdata("fechaenvionotificacionRecepcionNotificacion");
    $citenotificacion = $this->session->userdata("citenotificacionRecepcionNotificacion");
    $fecharecepcionnotificacion = $this->session->userdata("fecharecepcionnotificacion");*/

    $id = $ids;
    $idformm03 = $idformm03s;
    $fechaenvionotificacion = $fechaenvionotificacions;
    $citenotificacion = $citenotificacions;
    $fecharecepcionnotificacion = $fecharecepcionnotificacions;
    $fechaActual = $fechaActuals;
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    EDITAR FECHA DE RECEPCION DE NOTIFICACION<br/><br/>
                    ID M-03: <?php echo $idformm03;?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        La fecha de envi&oacute de notificaci&oacuten es: <?php echo $fechaenvionotificacion; ?> con CITE: <?php echo $citenotificacion;?>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_pendienteReliquidacion/guardar_fehaRecepcionNotificacion">
                                    <br/>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="idformm03" value="<?php echo $idformm03; ?>" />
                                    <input type="hidden" name="fechaenvionotificacion" value="<?php echo $fechaenvionotificacion; ?>" />
                                    <input type="hidden" name="citenotificacion" value="<?php echo $citenotificacion; ?>" />
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fecha de Recepci&oacuten de Notificaci&oacuten: </label>
                                        <div class="col-sm-9">
                                            <?php if($fecharecepcionnotificacion): ?>
                                                <input type="date" name="fecharecepcionnotificacion" id="fecharecepcionnotificacion" placeholder="" value="<?php echo $fecharecepcionnotificacion; ?>" class="col-xs-10 col-sm-5" />
                                            <?php else: ?>
                                                <input type="date" name="fecharecepcionnotificacion" id="fecharecepcionnotificacion" placeholder="" value="<?php echo $fechaActual; ?>"class="col-xs-10 col-sm-5" />
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
        
        