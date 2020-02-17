<!-- =============================================== -->

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <!--<div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>
                <span class="btn btn-info"></span>
                <span class="btn btn-warning"></span>
                <span class="btn btn-danger"></span>
            </div>
        </div>-->

        <ul class="nav nav-list">
            <li class="active">
                <a href="<?php echo base_url(); ?>C_principal">
                    <i class="menu-icon fa fa-home"></i>
                    <span class="menu-text"> Menu Principal </span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-key"></i>
                    <span class="menu-text"> Opciones </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_cambiopassword">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cambio de Password
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_cambiocorreoinstitucional">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cambio de correo institucional
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <?php $usuarioaux = $this->session->userdata("usuario"); ?>
                    <?php if($usuarioaux == 'SINACOM'): ?>
                        <li class="">
                            <a href="<?php echo base_url(); ?>C_cambioDepartamental">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Cambio de Departamental
                            </a>
                            <b class="arrow"></b>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>    
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-credit-card"></i>
                    <span class="menu-text"> Param&eacutetricas </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_aduana">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Aduanas
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_cotizaciondolar">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cotizaci&oacuten de Dolar
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_cotizacionminera">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cotizaci&oacuten Mineral
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_entidadaporte">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Entidades Aporte
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_entidadfinanciera">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Entidades Financieras
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_laboratorio">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Laboratorios
                        </a>
                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="<?php echo base_url(); ?>C_cooperativa">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Cooperativa
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_mineral">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Minerales
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_municipio">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Municipios
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_nandina">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Nandinas
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_pais">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Paises
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_subsector">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Subsectores
                        </a>
                        <b class="arrow"></b>
                    </li>
                    
                  <!--  <li class="">
                        <a href="<?php echo base_url(); ?>Excel_import">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Excel
                        </a>
                        <b class="arrow"></b>
                    </li> -->
                </ul>
            </li>
            
            <?php 
                $val = $this->session->userdata("formm02");
                $val1 = $this->session->userdata("formm03");
                $lugar = $this->session->userdata("lugar");
                $lugar = trim($lugar);
            ?>
            
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Formulario - M01 </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_formm01">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Existentes
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>
            
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Formulario - M02 </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <?php if($val == 0 && $val1 == 0 && strlen($lugar) == 0){ ?>
                        <a href="<?php echo base_url(); ?>C_declarado">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Declarado
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_recepcion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Recepci&oacuten
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_concluido">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Concluido
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_rechazado">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Rechazado
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_declarado">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Declarado por Operador
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_buscarM02">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Buscar M-02 por ID
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_reportesM02">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Reporte M-02
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <!--<?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_relacion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Relacion entre M02 y M03
                        </a>
                        <b class="arrow"></b>
                        <?php }?>-->
                    </li>
                </ul>
            </li>
            
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Formulario - M03 </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <?php if($val == 0 && $val1 == 0 && strlen($lugar) == 0){ ?>
                        <a href="<?php echo base_url(); ?>C_declarado3">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Declarado
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_recepcion3">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Recepci&oacuten
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_concluido3">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Concluido
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_rechazado3">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Rechazado
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_declarado3">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Declarado por Operador
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_buscarM03">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Buscar M-03 por ID
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <!--<?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_relacionadorM03M02">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Relacionador M-03 con M-02
                        </a>
                        <b class="arrow"></b>
                        <?php }?>-->
                        
                        <?php if($val1 > 0){ ?>
                        <a href="<?php echo base_url(); ?>C_reportesM03">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Reporte M-03
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                    </li>
                </ul>
            </li>
            
            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-bolt"></i>
                    <span class="menu-text"> Buscador </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_buscarDeposito">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Deposito
                        </a>
                        <b class="arrow"></b>
                    </li>   
                </ul>
            </li>
            
            <!--<li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cog"></i>
                    <span class="menu-text"> Procesos </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_normalizarPadre">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Normalizar Vendedor
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>-->
            
            <!--<li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-gavel"></i>
                    <span class="menu-text"> Reliquidaci&oacuten - M03 </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <?php $reliquidador = $this->session->userdata("reliquidador"); ?>
			<?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_criterioReliquidacionMineral">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Criterio Reliquidaci&oacuten por Mineral
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_muestreoReliquidacion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Muestreo de Reliquidaci&oacuten
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_pendienteReliquidacion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Pendientes de Reliquidaci&oacuten
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_pendienteDirimision">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Pendientes de Dirimision
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_reliquidadoReliquidacion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Form. M03 Reliquidados
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                        
                        <?php if($reliquidador == 1){ ?>
                        <a href="<?php echo base_url(); ?>C_noReliquidadoReliquidacion">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Form. M03 No Reliquidados
                        </a>
                        <b class="arrow"></b>
                        <?php }?>
                    </li>   
                </ul>
            </li>-->
            
            <!--<li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-folder-o"></i>
                    <span class="menu-text"> Reportes </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class="">
                        <a href="<?php echo base_url(); ?>C_reportesGralM02">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Reporte Gral M-02  
                        </a>
                        <b class="arrow"></b>
                    </li>
                </ul>
            </li>-->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
<!-- =============================================== -->
