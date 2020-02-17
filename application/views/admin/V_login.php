<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>VALIDADOR | Ver. 1.7 | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="description" content="User login page" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-rtl.min.css" />
                
</head>
<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="col-sm-10 col-sm-offset-1">
                <br/><br/><br/><br/>
                <p><center><span class="blue" style="font-size: 20px">Sistema Nacional de Informaci&oacuten Sobre Comercializaci&oacuten y Exportaciones Mineras</span></center></p>
                <p><center><span class="blue" style="font-size: 20px">VALIDADOR v1.6.0</span></center></p>
                <p><center><span class="black" style="font-size: 1px">Fecha: 15/03/2019 [Ultima]</span></center></p>
                <br/><br/>
                <div class="login-container">
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <!--<i class="ace-icon fa fa-coffee green"></i>-->
                                        Por favor introdusca su informaci&oacuten
                                    </h4>
                                    <div class="space-6"></div>
                                    <?php if($this->session->flashdata("error")):?>
                                      <div class="alert alert-danger">
                                        <p><?php echo $this->session->flashdata("error")?></p>
                                      </div>
                                    <?php endif; ?>
                                    <form action="<?php echo base_url();?>C_inicio/login" method="post">
                                        <fieldset>
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <?php if($this->session->userdata("usuario")): ?>
                                                        <input type="text" value="<?php echo $this->session->userdata("usuario"); ?>" class="form-control" placeholder="Usuario" name="usuario" />
                                                    <?php else: ?>
                                                        <input type="text" value="" class="form-control" placeholder="Usuario" name="usuario" />
                                                    <?php endif; ?>
                                                    <i class="ace-icon fa fa-user"></i>
                                                </span>
                                            </label>
                                            
                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <?php if($this->session->userdata("contrasena")): ?>
                                                        <input type="password" value="<?php echo $this->session->userdata("contrasena"); ?>" class="form-control" placeholder="Password" name="contrasena" />
                                                    <?php else: ?>
                                                        <input type="password" value="" class="form-control" placeholder="Password" name="contrasena" />
                                                    <?php endif; ?>
                                                    <i class="ace-icon fa fa-lock"></i>
                                                </span>
                                            </label>
                                            <div class="space"></div>
                                            <div class="clearfix">
                                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Ingresar</span>
                                                </button>
                                            </div>
                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>
                                    <div class="social-or-login center">
                                        <span class="bigger-110">Tambi&eacuten nos puede ver en:</span>
                                    </div>
                                    <div class="space-6"></div>
                                    
                                    <div class="social-login center">
                                        <a href="https://www.facebook.com/senarecom1/" target="_blank"  class="btn btn-primary"><i class="ace-icon fa fa-facebook"></i></a>
                                        <a href="https://twitter.com/senarecom1" target="_blank" class="btn btn-info"><i class="ace-icon fa fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php base_url();?>assets/js/jquery-2.1.4.min.js"></script>
</body>
</html>
