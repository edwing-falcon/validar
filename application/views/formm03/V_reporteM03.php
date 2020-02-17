<?php 
    $lugar = $this->session->userdata("lugar");
    $fecha = $fechasActuales;
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    REPORTES DE FORMULARIO M-03 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Departamental: <strong><?php echo $lugar; ?></strong>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <h4 class="widget-title">Formularios M-03 VALIDADOS</h4>
                            <span class="widget-toolbar">
                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>

                                <a href="#" data-action="close">
                                    <i class="ace-icon fa fa-times"></i>
                                </a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_reportesM03/reporte">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="gestionReporteEstadoM03"> Gestion:  </label>
                                        <div class="col-sm-9">
                                            <select id="gestion" name="gestionReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <?php foreach($gestiones as $gestion): ?>
                                                    <?php if($gestion->gestion == $this->session->userdata("gestionReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $gestion->gestion; ?>"><?php echo $gestion->gestion; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo $gestion->gestion; ?>"><?php echo $gestion->gestion; ?>    
                                                    <?php endif ?>        
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="mesReporteEstadoM03"> Mes:  </label>
                                        <div class="col-sm-9">
                                            <select id="mes" name="mesReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <?php foreach($meses as $mes): ?>
                                                    <?php if($mes->id == $this->session->userdata("mesReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $mes->id; ?>"><?php echo $mes->mes; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo $mes->id; ?>"><?php echo $mes->mes; ?>
                                                    <?php endif ?>        
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="estadoReporteEstadoM03"> Estado:  </label>
                                        <div class="col-sm-9">
                                            <select id="gestion" name="estadoReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <!--<option value="-666">TODOS LOS ESTADOS</option>-->
                                                <?php foreach($estadosValidados as $estado): ?>
                                                    <?php if($estado->estado == $this->session->userdata("estadoReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $estado->id; ?>"><?php echo $estado->estado; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo $estado->id; ?>"><?php echo $estado->estado; ?>    
                                                    <?php endif ?>        
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="exportadorReporteEstadoM03"> Exportador:  </label>
                                        <div class="col-sm-9">
                                            <select id="gestion" name="exportadorReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <option value="">TODOS LOS EXPORTADORES</option>
                                                <?php foreach($exportadores as $exportador): ?>
                                                    <?php if($exportador->id == $this->session->userdata("exportadorReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $exportador->id; ?>"><?php echo $exportador->exportador; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $exportador->id; ?>"><?php echo $exportador->exportador; ?></option>
                                                    <?php endif ?>        
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="fechaReporteEstadoM03"> Reporte por:  </label>
                                        <div class="col-sm-9">
                                            <select id="mes" name="fechaReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <?php foreach($fechasValidados as $fecha): ?>
                                                    <?php if($fecha->id == $this->session->userdata("fechaReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $fecha->id; ?>"><?php echo $fecha->fecha; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo $fecha->id; ?>"><?php echo $fecha->fecha; ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="departamentalReporteEstadoM03"> Departamental:  </label>
                                        <div class="col-sm-9">
                                            <select id="mes" name="departamentalReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <?php foreach($departamentales as $departamental): ?>
                                                    <?php if($departamental->oficinavalidacion == $this->session->userdata("departamentalReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $departamental->oficinavalidacion; ?>"><?php echo $departamental->oficinavalidacion; ?>
                                                    <?php else: ?>
                                                        <?php if($departamental->oficinavalidacion == $lugar):?>
                                                            <option selected value="<?php echo $departamental->oficinavalidacion; ?>"><?php echo $departamental->oficinavalidacion; ?>
                                                        <?php else: ?>
                                                            <option value="<?php echo $departamental->oficinavalidacion; ?>"><?php echo $departamental->oficinavalidacion; ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="ordenReporteEstadoM03"> Ordenado Por:  </label>
                                        <div class="col-sm-9">
                                            <select id="mes" name="ordenReporteEstadoM03" style="width: 400px; height: 35px;" >
                                                <?php foreach($ordenados as $orden): ?>
                                                    <?php if($orden->id == $this->session->userdata("ordenReporteEstadoM03")):?>
                                                        <option selected value="<?php echo $orden->id; ?>"><?php echo $orden->orden; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $orden->id; ?>"><?php echo $orden->orden; ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button class="btn btn-sm btn-success" type="submit" name="botonReporteEstadoM03" value="pdf">
                                            Exportar a PDF Formularios M-03 VALIDADOS
					<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
                                        &nbsp;
                                        <button class="btn btn-sm btn-info" type="submit" name="botonReporteEstadoM03" value="excel">
                                            Exportar a EXCEL Formularios M-03 VALIDADOS
					<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
					</button>
                                    </div>    
                                    <!--<div class="clearfix form-actions">
                                        <div class="col-md-offset-4 col-md-9">
                                            <button class="btn btn-info" type="submit">
                                                <i class="ace-icon fa fa- bigger-110"></i>
                                                Generar Reporte
                                            </button>
                                        </div>    
                                    </div>-->
                                </form>
                                <?php if( $this->session->userdata("errorReporteEstadoM03") ):?>
                                    <div class="alert alert-danger">
                                        <p><?php  echo $this->session->userdata("errorReporteEstadoM03");?></p>
                                    </div>
                                    <?php $this->session->unset_userdata('errorReporteEstadoM03'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>