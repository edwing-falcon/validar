<?php 
$idformm03 = $idformm03s;
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    RELACION DE M02 PARA VALIDACION DE M03  
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Debe introducir ID de formularios M02 que respaldan la validacion del M03 con ID: <?php echo $idformm03;?> 
                    </small>
                    <!-- aqui -->
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <form class="form-horizontal" role="form" method="POST" name="formrelacionadorm03m02" action="<?php echo base_url();?>C_recepcion3/buscarM02">
                                    <input type="hidden" name="idformm03" value="<?php echo $idformm03; ?>" />
                                    <center>
                                        <table border="0" cellspacing="30" cellpadding="30" align="center">
                                            <tr>
                                                <td style="text-align: left" width="150px">ID M02  : </td>
                                                <td style="text-align: left" width="400px">
                                                    <?php if( $this->session->userdata("idformm02") ):?>
                                                        <input type="text" name="idformm02" id="idformm02" placeholder="" value="<?php echo $this->session->userdata("idformm02");?>" class="col-xs-10 col-sm-5" />
                                                    <?php else: ?>
                                                        <input type="text" name="idformm02" id="idformm02" placeholder="" value="" class="col-xs-10 col-sm-5" />
                                                    <?php endif; ?>
                                                    <?php $this->session->unset_userdata('idformm02'); ?>         
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left" width="150px">OBSERVACION  : </td>
                                                <td style="text-align: left" width="400px">
                                                    <?php if( $this->session->userdata("obs") ):?>
                                                        <input type="text" name="obs" id="obs" placeholder="" value="<?php echo $this->session->userdata("obs");?>" class="col-xs-10 col-sm-5" size="255" />
                                                    <?php else: ?>
                                                        <input type="text" name="obs" id="obs" placeholder="" value="" class="col-xs-10 col-sm-5" size="255" />
                                                    <?php endif; ?>
                                                    <?php $this->session->unset_userdata('obs'); ?>
                                                    &nbsp;
                                                    (*)Campo no obligatorio
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <button class="btn btn-success" name="btn" value="insertar" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Agregar M02
                                                        </button>
                                                    </center>
                                                </td>
                                                
                                                <td>
                                                    <center>
                                                        <button class="btn btn-primary" name="btn" value="cadena" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Tiene toda la cadena productiva
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                        </table>
                                    </center>
                                </form>    
                            </div>
                            <?php if( $this->session->userdata("error") ):?>
                                <br/>
                                <div class="alert alert-danger">
                                    <p><?php  echo $this->session->userdata("error");?></p>
                                </div>
                                <?php $this->session->unset_userdata('error'); ?>
                                <br/>
                            <?php endif; ?>
                            <h5 class="header blue">Lista de Datos</h5>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">ID M03</th>
                                            <th style="text-align: center">ID M02</th>
                                            <th style="text-align: center">OBSERVACIONES</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($relacionadors)):?>
                                            <?php foreach ($relacionadors as $recep) { ?>
                                                <tr>
                                                    <td style="text-align: center"><?php  echo $recep->id;?></td>
                                                    <td style="text-align: center"><?php  echo $recep->idformm03;?></td>
                                                    <td style="text-align: center"><?php  echo $recep->idformm02;?></td>
                                                    <td style="text-align: center"><?php  echo $recep->obs;?></td>
                                                    <td>
                                                        <center>
                                                            <!--<a href="<?php echo base_url()?>C_recepcion3/editar_relacionadorm03m02/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">Editar</a>&nbsp;--><a href="<?php echo base_url()?>C_recepcion3/delete_relacionadorm03m02/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-success">Eliminar</a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/><br/><br/>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="clearfix form-actions">
                                        <form class="form-horizontal" role="form" method="POST" name="formrelacionadorm03m02Validar" action="<?php echo base_url();?>C_recepcion3/validar">
                                            <center>
                                                <input type="hidden" name="idformm03" value="<?php echo $idformm03; ?>" />
                                                <button class="btn btn-info" name="btn" value="validar" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Confirmar la validaci&oacuten
                                                </button>
                                                &nbsp;  
                                                <button class="btn btn-danger" name="btn" value="cancelar" type="submit">
                                                    <i class=""></i>
                                                    Cancelar la validaci&oacuten
                                                </button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
