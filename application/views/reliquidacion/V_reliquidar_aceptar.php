<?php 
    $id = $ids;
    $cod = $codigos;
    $fechaActual = $fechaActuals;
    $oficinareliquidacion = $oficinareliquidacions;
    $codigoreliquidador = $codigoreliquidadors;
    $fecreliquidacion = $fecreliquidacions;
    $idlaboratorio = $idlaboratorios;
    $laboratorio = $laboratorios;
    $fecinformelaboratorio = $fecinformelaboratorios;
    $numinformelaboratorio = $numinformelaboratorios;
    $codigoenviomuestra = $codigoenviomuestras;
    $fechapesaje = $fechapesajes;  
    $humedad_senarecom = $humedad_senarecoms;   
    $pnh_senarecom = $pnh_senarecoms; 
    $pns_senarecom = $pns_senarecoms;
    $fechavalidacion = $fechavalidacions;
    $fechavencimiento = $fechavencimientos; 
    $fechaenviomuestra = $fechaenviomuestras;
    $codigoenviomuestra = $codigoenviomuestras;
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>FORMULARIO M-03 PARA SU RELIQUIDACION</h1><br/>
                <h1>
                    ID: <?php echo $id;?>
                    <small>
                        <!--<i class="ace-icon fa fa-angle-double-right"></i>
                        Para su reliquidaci&oacuten-->
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
                            <div style="background-color:#9630B9; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > DATOS DEL FORM. M-03</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">FECHA VALIDACION</th>
                                            <th style="text-align: center">FECHA VENCIMIENTO</th>
                                            <th style="text-align: center">FECHA DE ENVIO DE MUESTRA</th>
                                            <th style="text-align: center">CODIGO DE ENVIO DE MUESTRA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center"><?php echo $fechavalidacion;?></td>
                                            <td style="text-align: center"><?php echo $fechavencimiento;?></td>
                                            <td style="text-align: center"><?php echo $fechaenviomuestra;?></td>
                                            <td style="text-align: center"><?php echo $codigoenviomuestra;?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="background-color:#9630B9; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > INTRODUSCA DATOS</div>
                            <br/>
                            <div class="row">
                                <div class="col-xs-12">
                                    <form class="form-horizontal" role="form" method="POST" name="formreliquidar" action="<?php echo base_url();?>C_muestreoReliquidacion/aceptar/<?php echo $this->Formm03_model->encriptar($id);?>">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="fecinformelaboratorio"> Fecha de Informe de Laboratorio: </label>
                                            <div class="col-sm-9">
                                                <?php if($fecinformelaboratorio): ?>
                                                    <input type="date" name="fecinformelaboratorio" value="<?php echo $fecinformelaboratorio; ?>">
                                                <?php else: ?>
                                                    <input type="date" name="fecinformelaboratorio" value="<?php echo $fechaActual; ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="numinformelaboratorio"> N&uacutemero de Informe de Laboratorio: </label>
                                            <div class="col-sm-9">
                                                <?php if($numinformelaboratorio): ?>
                                                    <input type="text" name="numinformelaboratorio" value="<?php echo $numinformelaboratorio; ?>">
                                                <?php else: ?>
                                                    <input type="text" name="numinformelaboratorio" value="">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="humedad_senarecom"> Humedad: </label>
                                            <div class="col-sm-9">
                                                <?php if($humedad_senarecom): ?>
                                                    <input type="text" name="humedad_senarecom" value="<?php echo $humedad_senarecom; ?>">
                                                <?php else: ?>
                                                    <input type="text" name="humedad_senarecom" value="">
                                                <?php endif; ?>
                                            </div>
                                        </div>    
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="fechapesaje"> Fecha de Pesaje: </label>
                                            <div class="col-sm-9">
                                                <?php if($fechapesaje): ?>
                                                    <input type="date" name="fechapesaje" value="<?php echo $fechapesaje; ?>">
                                                <?php else: ?>
                                                    <input type="date" name="fechapesaje" value="<?php echo $fechaActual; ?>">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="pns_senarecom"> Peso Neto Seco [Kg.]: </label>
                                            <div class="col-sm-9">
                                                <?php if($pns_senarecom): ?>
                                                    <input type="text" name="pns_senarecom" value="<?php echo $pns_senarecom; ?>">
                                                <?php else: ?>
                                                    <input type="text" name="pns_senarecom" value="">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center">ID</th>
                                                        <th style="text-align: center">ELEMENTO</th>
                                                        <th style="text-align: center">CLASIFICACION MINERAL</th>
                                                        <th style="text-align: center">CODIGO NANDINA</th>
                                                        <th style="text-align: center">DESCRIPCION</th>
                                                        <th style="text-align: center">LEY DECLARADO</th>
                                                        <th style="text-align: center">UNIDAD LEY DECLARADO</th>
                                                        <th style="text-align: center">LEY SENARECOM</th>
                                                        <th style="text-align: center">UNIDAD LEY SENARECOM</th>
                                                        <th style="text-align: center">ESTADO MINERAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($minerales)):?>
                                                        <?php foreach($minerales as $mineral): ?>
                                                        <tr>
                                                            <td style="text-align: center"><?php echo $mineral->id;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->elemento;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->clasificacionmineral;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->codigonandina;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->descripcion;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->leyvalor_declarado;?></td>
                                                            <td style="text-align: center"><?php echo $mineral->leyunidad_declarado;?></td>
                                                            <td style="text-align: center">
                                                                <?php echo $mineral->leyvalor;?>
                                                                <a href="<?php echo base_url()?>C_muestreoReliquidacion/reliquidar_editar/<?php echo $this->Formm03_model->encriptar($mineral->id);?>" class="btn-xs btn-success">Editar</a>    
                                                            </td>
                                                            <td style="text-align: center"><?php echo $mineral->leyunidad;?></td>
                                                            <?php if($mineral->estado == 0): ?>
                                                                <td style="text-align: center"><font color="red"><?php echo $mineral->estadodescri;?></font></td>
                                                            <?php else: ?>
                                                                <td style="text-align: center"><?php echo $mineral->estadodescri;?></td>
                                                            <?php endif ?>
                                                        </tr>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="clearfix form-actions">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <div class="col-xs-2">
                                                        <button class="btn btn-info" name="btn" value="aceptar" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Aceptar
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="col-xs-2">
                                                        <button class="btn btn-success" name="btn" value="previa" type="submit">
                                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                                            Vista Previa
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
                                    </form>
                                </div>
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
            <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        </div>
    </div>    