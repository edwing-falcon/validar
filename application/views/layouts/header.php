<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <title>VALIDADOR | Ver. 1.7</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php base_url();?>ultima_lib/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- bootstrap & fontawesome -->
        <!-- <link rel="stylesheet" href="<?php base_url();?>assets/css/bootstrap.min.css" /> -->  <!-- descomentar -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" /> --> <!-- descomentar -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-colorpicker.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />

        <!-- ace settings handler -->
        <script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script>
        
        <!-- jquery -->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/external/jquery/jquery.js" type="text/javascript"></script>
        <!--jquery ui-->
        <script src="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        
        <link href="<?php echo base_url();?>assets/datapicker/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-duallistbox.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-multiselect.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
        
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <!-- ace.min.css General -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" /> -->  <!-- descomentar -->
        <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" /> --> <!-- descomentar -->

	<!-- ace settings handler -->
	<!--<script src="<?php echo base_url();?>assets/js/ace-extra.min.js"></script> -->  <!-- descomentar -->
        
        <!-- Combo Anidado -->
<!--    <script src="<?php echo base_url();?>MiJS/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url();?>MiJS/jquery-ui.js"></script>-->
        
<!--         <script src="<?php base_url();?>ultima_lib/jquery-1.9.1.js"></script> -->
<!--         <script src="<?php base_url();?>ultima_lib/jquery-ui.js"></script> -->
         
         <!--  amCharts V3    -->
<!--        <script src="<?= base_url() ?>dist/amcharts_3.3.4/amcharts.js" type="text/javascript"></script>
        <script src="<?= base_url() ?>dist/amcharts_3.3.4/serial.js" type="text/javascript"></script>
-->
        <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->     <!-- descomentar -->
        <!-- <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script> --> <!-- descomentar -->
         
         
        <!--  amCharts V4  PARA EL EJEMPLO NRO 3  -->
        <link rel="stylesheet" href="<?php echo base_url()?>amcharts4/css/index.css" />
        <link rel="stylesheet" href="<?php base_url();?>ultima_lib/export.css" type="text/css" media="all" />
        <script src="<?php base_url();?>ultima_lib/amcharts.js"></script>
        <script src="<?php base_url();?>ultima_lib/serial.js"></script>
        <script src="<?php base_url();?>ultima_lib/export.min.js"></script>
        <script src="<?php base_url();?>ultima_lib/light.js"></script>
    

   
    
    </head>
<!--    <body class="no-skin" onunload="javascript:funcionCalculo()">-->
        <body class="no-skin">
        <div id="navbar" class="navbar navbar-default          ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            SINACOM
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <!--<li class="grey dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                M-02
                                <span class="badge badge-grey">3</span>
                            </a>
                            
                            <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-check"></i>
                                    Formulario M-02__
                                </li>
                                <?php if(!empty($datos)):?>
                                <?php       $pen = $datos->pen;
                                            $val = $datos->val;
                                            $rech = $datos->rech;
                                            $reg = $datos->reg;
                                            $penp = $datos->penp;
                                            $valp = $datos->valp;
                                            $rechp = $datos->rechp;
                                            $total = $datos->total;
                                ?>    
                                <?php endif ?>
                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Recepcionados</span>
                                                    <span class="pull-right"><?php echo $penp.'%  '.'('.$pen.')'; ?></span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:<?php echo $penp;?>%" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Validados</span>
                                                    <span class="pull-right"><?php echo $valp.'%  '.'('.$val.')'; ?></span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:<?php echo $valp;?>%" class="progress-bar progress-bar-success"></div>
                                                </div>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Rechazadosss</span>
                                                    <span class="pull-right"><?php echo $rechp.'%  '.'('.$rech.')'; ?></span>
                                                </div>

                                                <div class="progress progress-mini">
                                                    <div style="width:<?php echo $rechp;?>%" class="progress-bar progress-bar-danger"></div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">Formularios Registrados sin cerrar</span>
                                                    <span class="pull-right"><?php echo $reg; ?></span>
                                                </div>

                                                <div class="progress progress-mini progress-striped active">
                                                    <div style="width:99%" class="progress-bar"></div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>-->

                        <li class="purple dropdown-modal">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                                <span class="badge badge-important">1</span>
                            </a>

                            <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-exclamation-triangle"></i>
                                    Notificaciones
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar navbar-pink">
                                        <li>
                                            <!--<embed src="<?php echo base_url() ?>assets/archivos/Nota_1.pdf" type="application/pdf" width="800" height="600"></embed>-->
                                            <!--<a href="<?php echo base_url() ?>assets/archivos/Nota_1.pdf" type="application/pdf" width="800" height="600">-->
                                            <a href="http://www.senarecom.gob.bo/marco-legal-circulares-comunicados.php" target="_blank">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                                                        Circulares Comunicados
                                                    </span>
                                                    <span class="pull-right badge badge-info">+6</span>
                                                </div>
                                            </a>
                                        </li>

<!--                                        <li>
                                            <a href="#">
                                                <i class="btn btn-xs btn-primary fa fa-user"></i>
                                                Bob just signed up as an editor ...
                                            </a>
                                        </li>-->

<!--                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                                                        New Orders
                                                    </span>
                                                    <span class="pull-right badge badge-success">+8</span>
                                                </div>
                                            </a>
                                        </li>-->

<!--                                        <li>
                                            <a href="#">
                                                <div class="clearfix">
                                                    <span class="pull-left">
                                                        <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                                                        Followers
                                                    </span>
                                                    <span class="pull-right badge badge-info">+11</span>
                                                </div>
                                            </a>
                                        </li>-->
                                    </ul>
                                </li>

<!--                                <li class="dropdown-footer">
                                    <a href="#">
                                        See all notifications
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>-->
                            </ul>
                        </li>

                        <li class="green dropdown-modal">
                            <a href="https://correo.senarecom.gob.bo/" target="_blank">
                                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                                <span class="badge badge-success">0</span>
                            </a>

                            <!--<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                                <li class="dropdown-header">
                                    <i class="ace-icon fa fa-envelope-o"></i>
                                    5 Messages
                                </li>

                                <li class="dropdown-content">
                                    <ul class="dropdown-menu dropdown-navbar">
                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url();?>assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Alex:</span>
                                                        Ciao sociis natoque penatibus et auctor ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>a moment ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url();?>assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Susan:</span>
                                                        Vestibulum id ligula porta felis euismod ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>20 minutes ago</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url();?>assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Bob:</span>
                                                        Nullam quis risus eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>3:15 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url();?>assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Kate:</span>
                                                        Ciao sociis natoque eget urna mollis ornare ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>1:33 pm</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="clearfix">
                                                <img src="<?php echo base_url();?>assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                                <span class="msg-body">
                                                    <span class="msg-title">
                                                        <span class="blue">Fred:</span>
                                                        Vestibulum id penatibus et auctor  ...
                                                    </span>

                                                    <span class="msg-time">
                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                        <span>10:09 am</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown-footer">
                                    <a href="#">
                                        See all messages
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </li>
                            </ul>-->
                        </li>

                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo base_url();?>assets/images/avatars/avatar2.png" alt="" />
                                <span class="user-info">
                                    <small>Bienvenido</small>
                                    <?php echo $this->session->userdata("usuario")?> 
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-user"></i>
                                        Usuario
                                    </a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="<?php echo base_url(); ?>c_inicio/logout">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Salir
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>