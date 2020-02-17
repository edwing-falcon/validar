<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    Formulario M-02
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                         Reportes 
                    </small>
                    <!-- aqui -->
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Reportes M-02 (PDF)</h4>
                                <span class="widget-toolbar">
                                    <a href="#" data-action="reload">
                                        <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    
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
                                    <?php echo form_open('C_reportesM02/pdf'); ?>
                                        <label>A&Ntilde;O</label>
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-11">
                                                <select id="oficina" name="oficina" style="width: 230px; height: 35px;" >
                                                    <option value="" selected>Seleccione un a&ntilde;o</option>
                                                    <?php foreach($anios as $dat): ?>
                                                        <option value="<?php echo $dat->anio; ?>"><?php echo $dat->anio; ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <label>Estado del Formulario</label>
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-11">
                                                <select id="estado" name="estado" style="width: 230px; height: 35px;" >
                                                    <option value="" selected>Seleccione un ESTADO</option>
                                                    <!--<?php foreach($estados as $est): ?>
                                                        <option value="<?php echo $est->id; ?>"><?php echo $est->estado; ?>
                                                    <?php endforeach ?>-->
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-xs-8 col-sm-11">
                                                <input type="submit" value="Reporte PDF" name="btn" class="btn btn-primary"/>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                
            </div>
        </div>
