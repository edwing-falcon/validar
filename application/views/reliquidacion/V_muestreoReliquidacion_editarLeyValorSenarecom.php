<?php 
$idformm03 = $idformm03s;
$idreliquidacion03calculorm = $idreliquidacion03calculorms;
$leyValorSenarecom = $leyValorSenarecoms;
$leyUnidadSenarecom = $leyUnidadSenarecoms;
$mineral = $minerals;
$leyvalordeclarado = $leyvalordeclarados;
$leyunidaddeclarado = $leyunidaddeclarados;
$simbolo = $simbolos;
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    EDITAR LEY SENARECOM ID M-03: <?php echo $idformm03;?><br/><br/>
                    Mineral declarado: <?php echo $mineral;?>  ( <?php echo $simbolo;?> )   Ley: <?php echo $leyvalordeclarado;?> <?php echo $leyunidaddeclarado;?> 
                    <!--<small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                    </small>-->
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_muestreoReliquidacion/guardar_leyValorSenarecom">
                                    <br/>
                                    <input type="hidden" name="idformm03" value="<?php echo $idformm03; ?>" />
                                    <input type="hidden" name="idreliquidacion03calculorm" value="<?php echo $idreliquidacion03calculorm; ?>" />
                                    <input type="hidden" name="leyUnidadSenarecom" value="<?php echo $leyUnidadSenarecom; ?>" />
                                    <input type="hidden" name="mineral" value="<?php echo $mineral; ?>" />
                                    <input type="hidden" name="leyvalordeclarado" value="<?php echo $leyvalordeclarado; ?>" />
                                    <input type="hidden" name="leyunidaddeclarado" value="<?php echo $leyunidaddeclarado; ?>" />
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ley Senarecom (<?php echo $leyUnidadSenarecom;?>): </label>
                                        <div class="col-sm-9">
                                            <?php if($leyValorSenarecom): ?>
                                                <input type="text" name="leyValorSenarecom" id="leyValorSenarecom" placeholder="" value="<?php echo $leyValorSenarecom; ?>" class="col-xs-10 col-sm-5" />
                                            <?php else: ?>
                                                <input type="text" name="leyValorSenarecom" id="leyValorSenarecom" placeholder="" value=""class="col-xs-10 col-sm-5" />
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
        
        