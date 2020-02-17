<?php 
    $usuario = $this->session->userdata("usuario");
    $lugar = $this->session->userdata("lugar"); 
?> 

<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    CAMBIO DE DEPARTAMENTAL<br/><br/>Usuario: <?php echo $usuario; ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        SENARECOM actual: <?php echo $lugar; ?>     
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
                                    <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_cambioDepartamental/guardar">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="idlugarCambioDepartamental"> Departamentales:  </label>
                                            <div class="col-sm-9">
                                                <select id="idlugarCambioDepartamental" name="idlugarCambioDepartamental" style="width: 400px; height: 35px;" >
                                                    <?php foreach($lugars as $lugar): ?>
                                                        <?php if($lugar->id == $this->session->userdata("idlugarCambioDepartamental")):?>
                                                            <option selected value="<?php echo $lugar->id; ?>"><?php echo $lugar->descripcion; ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo $lugar->id; ?>"><?php echo $lugar->descripcion; ?></option>
                                                        <?php endif ?>        
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="space-2"></div>
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-4 col-md-9">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Cambiar de Departamental
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
