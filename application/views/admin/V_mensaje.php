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
    
    <script> 
        var par=false; 
        function parpadeo() { 
            col=par ? 'blue' : 'red'; 
            document.getElementById('txt').style.color=col; 
            par = !par; 
            setTimeout("parpadeo()",500); //500 = medio segundo 
        } 
        window.onload=parpadeo; 
    </script> 
    <script> 
        var par=false; 
        function parpadeo() { 
            col=par ? 'blue' : 'red'; 
            document.getElementById('txt1').style.color=col; 
            par = !par; 
            setTimeout("parpadeo()",500); //500 = medio segundo 
        } 
        window.onload=parpadeo; 
    </script> 
</head>
<body class="login-layout">
    <div class="main-container">
        <div class="main-content">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <br/>
                    <div class="center">
                            <h1>
                                <!--<span class="green" style="font-size: 20px">Sistema Nacional de Informaci&oacuten Sobre Comercializaci&oacuten y Exportaciones Mineras</span>-->
                            </h1>
                            <!--<h4 class="blue" id="id-company-text">VALIDADOR v1.6.0</h4>-->
                    </div>
                    <br/>
                    <br/>
                    <?php
                        $id = $ids; 
                        $titulo = $titulos; 
                        $caveza = $cavezas;
                        $mensaje = $mensajes;
                        $link = $links;
                        $parpadeo = $parpadeos;
                    ?>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <?php echo $titulo;?>
                                    </h4>
                                    <div class="space-6"></div>
                                    <strong><?php echo $caveza;?></strong>
                                    <div class="space-6"></div>
                                    <?php echo $mensaje;?>
                                    <br/><br/>
                                    <div class="social-or-login center">
                                        <span class="bigger-110"></span>
                                    </div>
                                    <div class="space-6"></div>
                                    <a href="<?php echo base_url() ?>assets/mensajes/<?php echo $id;?>.pdf" target="_blank" type="application/pdf" width="800" height="600" style="color:red; font-size:15px;"><span id="txt">Ver Documento</span></a>
                                    <br/><br/>
                                    
                                    <?php if(strlen($parpadeo) > 0): ?>
                                        <a href="#" width="800" height="600" style="color:red; font-size:15px;"><span id="txt1"><?php echo $parpadeo;?></span></a>
                                    <?php endif; ?>                                    
                                    <br/><br/>
                                    <div class="center">
                                        <a href="<?php echo base_url();?>C_inicio/validador" class="btn btn-primary">Acepto</a>
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
