<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?php echo base_url();?>C_principal">Inicio</a>
                </li>
                <li class="active">Principal</li>
            </ul><!-- /.breadcrumb -->


        </div>

        <div class="page-content" >
             <div class="page-header">
                <h1>
                    Pantalla Principal 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Inicio
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>

                        <i class="ace-icon fa fa-check green"></i>

                        BIENVENIDO
                        <strong class="green">
                            <small><?php echo $this->session->userdata("usuario");?></small>
                        </strong>
                        ROL: <?php echo $this->session->userdata("rol");?> 

                        <?php 
                            $acceso = "";
                            $val1 = $this->session->userdata("formm02");
                            $val2 = $this->session->userdata("formm03");
                            $val3 = $this->session->userdata("lugar");
                            if($val1 == 1 or $val2 == 1){
                                $acceso = "Acceso a:";
                            }

                            if($val1 == 1){ $acceso .= " Form M-02"; }
                            if($val2 == 1){ $acceso .= " Form M-03"; }
                            if(strlen($val3) > 0) { $acceso .= " SENARECOM: ".$val3; }

                            echo $acceso;
                        ?>
                    </div>
                    
                    
 <div class="space"></div>
 <div class="vspace-12-sm"></div>
 <div class="row">
 
    <div class=" alert alert-block alert-success">
        
        <h4 class="widget-title">
            <i class="ace-icon fa fa-home fa-2x green"></i>
            <strong class="green">
                <?=  $departamento ?> 
            </strong>
        </h4>
    </div>
 
 </div>
<div class="row">
                       
                                  
                                    

                                    <div class="col-sm-6">
                                            <div class="widget-box">
                                                    <div class="widget-header widget-header-flat widget-header-small">
                                                            <h5 class="widget-title">
                                                                    <i class="ace-icon fa fa-bar-chart-o"></i>
                                                                    Gestion <?= $gestion ?> <strong>M02 - Comercio Interno</strong>
                                                            </h5>
                                                    </div>

                                                    <div class="widget-body">
                                                            <div class="widget-main">

                                                                    <div id="chartAcumuladoM02_" class="chartdiv"></div>
                                                            </div>
                                                    </div><!-- /.widget-main -->
                                            </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                   
                                    
                                    
                                     <div class="col-sm-6">
                                            <div class="widget-box">
                                                    <div class="widget-header widget-header-flat widget-header-small">
                                                            <h5 class="widget-title">
                                                                    <i class="ace-icon fa fa-bar-chart-o"></i>
                                                                   Gestion <?= $gestion ?> <strong>M03 - Comercio Externo</strong>
                                                            </h5>
                                                    </div>

                                                    <div class="widget-body">
                                                            <div class="widget-main">

                                                                    <div id="chartAcumuladoM03_" class="chartdiv"></div>
                                                                    



                                                            </div>
                                                    </div><!-- /.widget-main -->
                                            </div><!-- /.widget-body -->
                                    </div><!-- /.widget-box -->
                                   

   </div>   
    
                
 <div class="space"></div>
 <div class="vspace-12-sm"></div>
  <div class="alert alert-block alert-success">
        <i class="ace-icon fa fa-bar-chart-o  fa-2x green"></i>
        COMERCIO INTERNO
        <strong class="green">
            M02
        </strong> POR MES (Historico)
    </div>
    
                    
                    <div class="row">
                       
                                  
                                    <div class="vspace-12-sm"></div>

                            <div class="col-sm-12">
                                    <div class="widget-box">
                                            <div class="widget-header widget-header-flat widget-header-small">
                                                    <h5 class="widget-title">
                                                            <i class="ace-icon fa fa-signal"></i>
                                                            Gestion <?= $gestion ?> - <strong>M02</strong> Comercio Interno  (Historico)
                                                    </h5>
                                            </div>

                                            <div class="widget-body">
                                                    <div class="widget-main">

                                                            <div id="chartdiv4_1" class="chartdiv"></div>
                                                            <div class="hr hr8 hr-double"></div>

                                                            <div class="clearfix">

<div class="widget-box transparent">
<div class="widget-header widget-header-flat">
<h5 class="widget-title lighter">
<i class="ace-icon fa fa-table"></i>
Datos tabulares
</h5>

<div class="widget-toolbar">
<a href="#" data-action="collapse">
    <i class="ace-icon fa fa-chevron-up"></i>
</a>
</div>
</div>

<div class="widget-body">
<div class="widget-main no-padding">

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">

</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="center">Nro</th>
<th>Mes</th>
<th class="hidden-480">Estado</th>

<th>
    <i class="ace-icon fa bigger-110 hidden-480"></i>
    Cantidad
</th>

<th class="hidden-480">Status</th>
<th></th>

</tr>
</thead>

<tbody>
<?php
if(isset($cuadroDataH_M02)){
$nro=1;
$datosTabla= '';
foreach($cuadroDataH_M02 as $value)
{
$datosTabla = $datosTabla. "<tr>
<td class='center'>".$nro++."</td>
<td>".$value->nombremes."</td>
<td>".$value->estado."</td>     
<td class='hidden-480 left'>".($value->cantidad)."</td>
<td class='left'><span class='label label-sm label-info arrowed arrowed-left'>".$value->estado. "</span></td>
<td></td></tr>";
}
$datosTabla = $datosTabla;
echo $datosTabla;
} else {
echo "<h2 class='widget-title lighter'>No existe Informaci&oacute;n Tabular</h2>";
}
?>
</tbody>
</table>
</div>
</div>

</div><!-- /.widget-main -->
</div><!-- /.widget-body -->

                                                                    </div>
                                                            </div><!-- /.widget-main -->
                                                    </div><!-- /.widget-body -->
                                            </div><!-- /.widget-box -->
                                    </div><!-- /.col -->

                    </div>


  <div class="space"></div>
 <div class="vspace-12-sm"></div>
  <div class="alert alert-block alert-success">
        <i class="ace-icon fa fa-bar-chart-o fa-2x green"></i>
        COMERCIO EXTERNO
        <strong class="green"> 
            M03
        </strong> - POR MES (Historico)
    </div>
      
                    <div class="row">
                       
                                  
                                  

                                    <div class="col-sm-12">
                                            <div class="widget-box">
                                                    <div class="widget-header widget-header-flat widget-header-small">
                                                            <h5 class="widget-title">
                                                                    <i class="ace-icon fa fa-signal"></i>
                                                                    Gestion <?= $gestion ?> - <strong>M03</strong> Comercio Externo  (Historico)
                                                            </h5>
                                                    </div>

                                                    <div class="widget-body">
                                                            <div class="widget-main">

                                                                    <div id="chartdiv4_2" class="chartdiv"></div>
                                                                    <div class="hr hr8 hr-double"></div>

                                                                    <div class="clearfix">

<div class="widget-box transparent">
<div class="widget-header widget-header-flat">
<h5 class="widget-title lighter">
<i class="ace-icon fa fa-table"></i>
Datos tabulares
</h5>

<div class="widget-toolbar">
<a href="#" data-action="collapse">
    <i class="ace-icon fa fa-chevron-up"></i>
</a>
</div>
</div>

<div class="widget-body">
<div class="widget-main no-padding">

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">

</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="center">Nro</th>
<th>Mes</th>
<th class="hidden-480">Estado</th>

<th>
    <i class="ace-icon fa bigger-110 hidden-480"></i>
    Cantidad
</th>

<th class="hidden-480">Status</th>
<th></th>

</tr>
</thead>

<tbody>
<?php
if(isset($cuadroDataH_M03)){
$nro=1;
$datosTabla= '';
foreach($cuadroDataH_M03 as $value)
{
$datosTabla = $datosTabla. "<tr>
<td class='center'>".$nro++."</td>
<td>".$value->nombremes."</td>
<td>".$value->estado."</td>     
<td class='hidden-480 left'>".($value->cantidad)."</td>
<td class='left'><span class='label label-sm label-info arrowed arrowed-left'>".$value->estado. "</span></td>
<td></td></tr>";
}
$datosTabla = $datosTabla;
echo $datosTabla;
} else {
echo "<h2 class='widget-title lighter'>No existe Informaci&oacute;n Tabular</h2>";
}
?>
</tbody>
</table>
</div>
</div>

</div><!-- /.widget-main -->
</div><!-- /.widget-body -->

                                                                    </div>
                                                            </div><!-- /.widget-main -->
                                                    </div><!-- /.widget-body -->
                                            </div><!-- /.widget-box -->
                                    </div><!-- /.col -->

                    </div>

                               
                    
<div class="space"></div>
<div class="vspace-12-sm"></div>
<div class="alert alert-block alert-success center">
      <i class="ace-icon fa fa-bar-chart-o fa-2x green middle"></i>
      VALIDADORES DEL FORMULARIO <strong class="green">M02</strong>        COMERCIO INTERNO
</div>        

  <div class="row">
  <div class="col-xs-12">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i></i>
                                        Validadores Gestion <?= $gestion ?> del Formulario M02
                                </h5>

                                <div class="widget-toolbar">
                                       
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>

                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>

                                    
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>

                        <div class="widget-body">
                                <div class="widget-main no-padding">
                                        <div id="chartdivVM02" class = "chartdiv"></div>
                                 <div class="hr hr8 hr-double"></div>
                                         <div class="clearfix">

                                                <div class="widget-box transparent">
                                                <div class="widget-header widget-header-flat">
                                                    <h5 class="widget-title lighter">
                                                        <i class="ace-icon fa fa-table"></i>
                                                        Datos tabulares <strong>Validadores</strong>
                                                    </h5>

                                                    <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                <div class="widget-main no-padding">
                                        <?php  if(isset($cuadroDataVM02)){

                                        ?>
                                                <div class="clearfix">
                                                <div class="pull-right tableTools-container"></div>
                                                </div>
                                                <div class="table-header"></div>

                                                <!-- div.table-responsive -->

                                                <!-- div.dataTables_borderWrap -->
                                                <div>
                                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                        <tr>
                                                            <th class="center">Nro</th>
                                                            <th>Departamento</th>
                                                            <th>Validador</th>
                                                            <th>Estado</th>
                                                            <th>Cantidad</th>
                                                            <th>Status</th>
                                                        </tr>
                                                </thead>

                                                <tbody>
                                                        <?php
                                                        $nro=1;
                                                        $datosTabla= '';
                                                        foreach($cuadroDataVM02 as $value)
                                                        {
                                                        $datosTabla = $datosTabla. "<tr>
                                                        <td class='center'>".$nro++."</td>
                                                        <td>".$value->departamento."</td>    
                                                        <td>".$value->codigovalidador."</td>
                                                        <td>".$value->descripcionestado."</td>     
                                                        <td class='hidden-480 left'>".($value->cantidad)."</td>
                                                        <td class='left'><span class='label label-sm label-info arrowed arrowed-left'>".$value->descripcionestado. "</span></td>
                                                        </tr>";
                                                        }

                                                        echo $datosTabla;
                                                        ?>
                                                </tbody>
                                                </table>
                                                </div>
                                    <?php 
                                    } else {
                                            echo "<h5 class='widget-title green center' >No existe Informaci&oacute;n Tabular</h5>";
                                            }
                                    ?>                                                
                                                </div>

                                                </div><!-- /.widget-main -->
                                                </div><!-- /.widget-body -->

                                         </div>
                                
                                
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->

  </div>    


 <div class="space"></div>
 <div class="vspace-12-sm"></div>
  
  <div class="row">
    <div class="col-sm-12">
            <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat green">
                            <h5 class="widget-title lighter">
                                   <i class="ace-icon fa fa-bar-chart-o fa-2x green"></i>
                                   <strong class="green"> VALIDADORES DEL FORMULARIO M02 POR MES </strong>
                            </h5>

                            <div class="widget-toolbar">
                                    <a href="#" data-action="collapse">
                                            <i class="ace-icon fa fa-chevron-up green"></i>
                                    </a>
                            </div>
                    </div>

                    <div class="widget-body">
                            <div class="widget-main padding-4">
                                
      
   <div class="row">
        <div class="col-sm-6 ">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes1 ?> </strong>- <?= $gestion1 ?>
                                </h5>
                                <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>
                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u1" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->

    <div class="col-sm-6 ">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes2 ?> </strong>- <?= $gestion2 ?>
                                </h5>
                                <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>
                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u2" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->

        
  </div>
                                
                                
<div class="row">
        <div class="col-sm-6">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes3 ?></strong> - <?= $gestion3 ?> 
                                </h5>

                                <div class="widget-toolbar">
                                       
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>

                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>

                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>

                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u3" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->
 
        <div class="col-sm-6">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes4 ?>  </strong>- <?= $gestion4 ?>
                                </h5>
                                <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>

                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>
                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u4" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->
        
 </div>

<div>
         <div class="col-sm-6">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes5 ?>  </strong>- <?= $gestion5 ?>
                                </h5>
                                <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>

                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>
                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u5" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->
         <div class="col-sm-6">
                <div class="widget-box">
                        <div class="widget-header widget-header-flat">
                                <h5 class="widget-title lighter">
                                        <i class="ace-icon fa fa-users"></i>
                                        <strong> <?= $mes6 ?>  </strong>- <?= $gestion6 ?>
                                </h5>
                                <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>

                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>
                        </div>
                        <div class="widget-body">
                                <div class="widget-main">
                                        <div id="chartdiv4_u6" class = "chartdiv_p"></div>
                                </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
        </div><!-- /.col -->
 </div>
                                
                               
                            </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
    </div><!-- /.col -->

</div>
 
 <div class="space"></div>
 <div class="vspace-12-sm"></div>
 
 <div class="row">
  <div class="alert alert-block alert-success center">
        <i class="ace-icon fa fa-bar-chart-o fa-2x green middle"></i>
        VALIDADORES DEL FORMULARIO 
        <strong class="green">
            M03
        </strong> COMERCIO EXTERNO
    </div>  
 </div>

 <div class="row">
    <div class="col-sm-12">
            <div class="widget-box">
                    <div class="widget-header widget-header-flat widget-header-small">
                            <h5 class="widget-title">
                                   <i class="ace-icon fa fa-users"></i>
                                    Validadores Gestion <?= $gestion3 ?> 
                            </h5>
                                  <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>

                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>                       
                        
                    </div>

                    <div class="widget-body">
                            <div class="widget-main padding-4">
                                <div id="chartdivVM03" class="chartdiv"></div>
                                <div class="hr hr8 hr-double"></div>
                                         <div class="clearfix">

                                                <div class="widget-box transparent">
                                                <div class="widget-header widget-header-flat">
                                                    <h5 class="widget-title lighter">
                                                        <i class="ace-icon fa fa-table"></i>
                                                        Datos tabulares <strong>Validadores</strong>
                                                    </h5>

                                                    <div class="widget-toolbar">
                                                    <a href="#" data-action="collapse">
                                                        <i class="ace-icon fa fa-chevron-up"></i>
                                                    </a>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                <div class="widget-main no-padding">
                                        <?php  if(isset($cuadroDataVM03)){

                                        ?>
                                                <div class="clearfix">
                                                <div class="pull-right tableTools-container"></div>
                                                </div>
                                                <div class="table-header"></div>

                                                <!-- div.table-responsive -->

                                                <!-- div.dataTables_borderWrap -->
                                                <div>
                                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                        <tr>
                                                            <th class="center">Nro</th>
                                                            <th>Departamento</th>
                                                            <th>Validador</th>
                                                            <th>Estado</th>
                                                            <th>Cantidad</th>
                                                            <th>Status</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        $nro=1;
                                                        $datosTabla= '';
                                                        foreach($cuadroDataVM03 as $value)
                                                        {
                                                        $datosTabla = $datosTabla. "<tr>
                                                        <td class='center'>".$nro++."</td>
                                                        <td>".$value->departamento."</td>    
                                                        <td>".$value->codigovalidador."</td>
                                                        <td>".$value->descripcionestado."</td>     
                                                        <td class='hidden-480 left'>".($value->cantidad)."</td>
                                                        <td class='left'><span class='label label-sm label-info arrowed arrowed-left'>".$value->descripcionestado. "</span></td>
                                                        </tr>";
                                                        }
                                                        echo $datosTabla;
                                                        ?>
                                                </tbody>
                                                </table>
                                                </div>
                                    <?php 
                                    } else {
                                            echo "<h5 class='widget-title green center' >No existe Informaci&oacute;n Tabular</h5>";
                                            }
                                    ?>                                                   
                                                </div>

                                                </div><!-- /.widget-main -->
                                                </div><!-- /.widget-body -->

                                         </div>
                                
                            </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
    </div><!-- /.col -->

</div>
 
 <div class="row">
    <div class="col-sm-6">
            <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                            <h6 class="widget-title">
                                   <i class="ace-icon fa fa-users"></i>
                                   <strong>Validaciones de HOY</strong> - Comercio Interno Formularios M-02
                            </h6>
                                  <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>                       
                    </div>
                    <div class="widget-body">
                            <div class="widget-main">
                                <div id="chartdivVM02Hoy" class="chartdiv"></div>
                            </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
    </div><!-- /.col -->
    <div class="col-sm-6">
            <div class="widget-box">
                    <div class="widget-header widget-header-flat">
                            <h6 class="widget-title">
                                   <i class="ace-icon fa fa-users"></i>
                                   <strong>Validaciones de HOY<strong> - Comercio Externo Formularios M-03
                            </h6>
                                  <div class="widget-toolbar">
                                    <a href="#" data-action="settings">
                                            <i class="ace-icon fa fa-cog"></i>
                                    </a>
                                    <a href="#" data-action="reload">
                                            <i class="ace-icon fa fa-refresh"></i>
                                    </a>
                                    <a href="#" data-action="fullscreen" class="orange2">
                                            <i class="ace-icon fa fa-expand"></i>
                                    </a>
                                </div>                       
                    </div>
                    <div class="widget-body">
                            <div class="widget-main">
                                <div id="chartdivVM03Hoy" class="chartdiv"></div>
                            </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
    </div><!-- /.col -->

</div>
 <!--[if !IE]> -->
<!--    <script src="assets/js/jquery-2.1.4.min.js"></script>-->

    <!-- <![endif]-->             
   <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>                                                                 
<!-- <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>-->

  <!-- page specific plugin scripts -->
		<script src="<?php echo base_url()?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>                                                                                
 <!-- ace scripts   mueve los bloques--> 
<!--		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>-->
                                                                               
<!-- page specific plugin scripts -->
		<script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/buttons.flash.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/buttons.html5.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/buttons.print.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/buttons.colVis.min.js"></script>
		<script src="<?php echo base_url()?>assets/js/dataTables.select.min.js"></script>
                                                                                
<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table, #dynamic-table2')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
                                                "filename": "Datos_Tabulares",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
                                                 "title": "Datos_Tabulares",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'Reporte de Datos Tabulares'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>
                
 <script src="<?php echo base_url()?>amcharts4/core.js"></script>
 <script src="<?php echo base_url()?>amcharts4/charts.js"></script>
 <script src="<?php echo base_url()?>amcharts4/themes/animated.js"></script>
 <script src="<?php echo base_url()?>amcharts4/themes/kelly.js"></script>
 <script src="<?php echo base_url()?>amcharts4/themes/material.js"></script>

    
 <script type="text/javascript">
  function am4themes_myTheme(target) {
        if (target instanceof am4core.ColorSet) {
    target.list = [
      am4core.color("#1BA68D"),
      am4core.color("#E7DA4F"),
      am4core.color("#E77624"),
      am4core.color("#DF3520"),
      am4core.color("#64297B"),
      am4core.color("#232555")
    ];
  }
}

//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
//am4core.useTheme(am4themes_kelly);
//am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
var chart = am4core.create("chartAcumuladoM02_", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data =  <?php echo $chartAcumuladoM02 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "departamento";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;


var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series
var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "REGISTRADO";
series3.dataFields.categoryX = "departamento";
series3.name = "REGISTRADO";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#3A87AD"); // azul
series3.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

var series8 = chart.series.push(new am4charts.ColumnSeries3D());
series8.dataFields.valueY = "PENDIENTE";
series8.dataFields.categoryX = "departamento";
series8.name = "Pendiente";
series8.tooltipText = "{name}: [bold]{valueY}[/]";
series8.columns.template.stroke = am4core.color("#fc830d"); // naranja
series8.columns.template.fill = am4core.color("#fc830d");
//series8.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series8.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

var series9 = chart.series.push(new am4charts.ColumnSeries3D());
series9.dataFields.valueY = "RECHAZADO";
series9.dataFields.categoryX = "departamento";
series9.name = "Rechazado";
series9.tooltipText = "{name}: [bold]{valueY}[/]";
series9.columns.template.stroke = am4core.color("#bf0e08"); // ROJO
series9.columns.template.fill = am4core.color("#bf0e08");
//series9.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series9.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

//var series3 = chart.series.push(new am4charts.ColumnSeries());
var series13 = chart.series.push(new am4charts.ColumnSeries3D());
series13.dataFields.valueY = "VALIDADO";
series13.dataFields.categoryX = "departamento";
series13.name = "VALIDADO";
series13.tooltipText = "{name}: [bold]{valueY}[/]";
series13.columns.template.stroke = am4core.color("#08bf2b"); // verde
series13.columns.template.fill = am4core.color("#08bf2b");
//series13.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series13.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script>

  
 <script type="text/javascript">


//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
//am4core.useTheme(am4themes_kelly);
//am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
var chart = am4core.create("chartAcumuladoM03_", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data =  <?php echo $chartAcumuladoM03 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "departamento";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;


var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M03";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series
var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "REGISTRADO";
series3.dataFields.categoryX = "departamento";
series3.name = "REGISTRADO";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#3A87AD"); // azul
series3.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

var series8 = chart.series.push(new am4charts.ColumnSeries3D());
series8.dataFields.valueY = "PENDIENTE";
series8.dataFields.categoryX = "departamento";
series8.name = "Pendiente";
series8.tooltipText = "{name}: [bold]{valueY}[/]";
series8.columns.template.stroke = am4core.color("#fc830d"); // naranja
series8.columns.template.fill = am4core.color("#fc830d");
//series8.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series8.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

//var series2 = chart.series.push(new am4charts.ColumnSeries());
var series9 = chart.series.push(new am4charts.ColumnSeries3D());
series9.dataFields.valueY = "RECHAZADO";
series9.dataFields.categoryX = "departamento";
series9.name = "Rechazado";
series9.tooltipText = "{name}: [bold]{valueY}[/]";
series9.columns.template.stroke = am4core.color("#bf0e08"); // ROJO
series9.columns.template.fill = am4core.color("#bf0e08");
//series9.stacked = true;


// label bullet
var labelBullet = new am4charts.LabelBullet();
series9.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

//var series3 = chart.series.push(new am4charts.ColumnSeries());
var series13 = chart.series.push(new am4charts.ColumnSeries3D());
series13.dataFields.valueY = "VALIDADO";
series13.dataFields.categoryX = "departamento";
series13.name = "VALIDADO";
series13.tooltipText = "{name}: [bold]{valueY}[/]";
series13.columns.template.stroke = am4core.color("#08bf2b"); // verde
series13.columns.template.fill = am4core.color("#08bf2b");
//series13.stacked = true;

// label bullet
var labelBullet = new am4charts.LabelBullet();
series13.bullets.push(labelBullet);
labelBullet.label.text = "{valueY.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dy = -15;

var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script>

 <script type="text/javascript">

//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
// am4core.useTheme(am4themes_kelly);
// am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
//var chart = am4core.create("chartdiv4", am4charts.XYChart);
var chart = am4core.create("chartdiv4M02", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data = <?php echo $chartDataM02 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nombremes";
categoryAxis.title.text = "Mes";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;



var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series

var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "REGISTRADO";
series.dataFields.categoryX = "nombremes";
series.name = "Registrado";
series.tooltipText = "{name}: [bold]{valueY}[/]";
series.columns.template.stroke = am4core.color("#3A87AD"); // 
series.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;



var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "PENDIENTE";
series2.dataFields.categoryX = "nombremes";
series2.name = "Pendiente";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
//series2.columns.template.column.fill = am4core.color("#ff0000");
series2.columns.template.stroke = am4core.color("#fc830d"); // naranja
series2.columns.template.fill = am4core.color("#fc830d");
//series2.stroke = am4core.color("#ff000");
//series8.stacked = true;


var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "RECHAZADO";
series3.dataFields.categoryX = "nombremes";
series3.name = "Rechazado";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#bf0e08"); // naranja
series3.columns.template.fill = am4core.color("#bf0e08");
//series8.stacked = true;

var series4 = chart.series.push(new am4charts.ColumnSeries3D());
series4.dataFields.valueY = "VALIDADO";
series4.dataFields.categoryX = "nombremes";
series4.name = "Validado";
series4.tooltipText = "{name}: [bold]{valueY}[/]";
series4.columns.template.stroke = am4core.color("#08bf2b"); // verde
series4.columns.template.fill = am4core.color("#08bf2b");
//series8.stacked = true;


// brechas para cantidad altas y pequeñas en el mismo grafico
var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script> 

 
 <script type="text/javascript">

//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
// am4core.useTheme(am4themes_kelly);
// am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
//var chart = am4core.create("chartdiv4", am4charts.XYChart);
var chart = am4core.create("chartdiv4M03", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data = <?php echo $chartDataM03 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nombremes";
categoryAxis.title.text = "Mes";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;



var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series

var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "REGISTRADO";
series.dataFields.categoryX = "nombremes";
series.name = "Registrado";
series.tooltipText = "{name}: [bold]{valueY}[/]";
series.columns.template.stroke = am4core.color("#3A87AD"); // 
series.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;



var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "PENDIENTE";
series2.dataFields.categoryX = "nombremes";
series2.name = "Pendiente";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
//series2.columns.template.column.fill = am4core.color("#ff0000");
series2.columns.template.stroke = am4core.color("#fc830d"); // naranja
series2.columns.template.fill = am4core.color("#fc830d");
//series2.stroke = am4core.color("#ff000");
//series8.stacked = true;


var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "RECHAZADO";
series3.dataFields.categoryX = "nombremes";
series3.name = "Rechazado";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#bf0e08"); // naranja
series3.columns.template.fill = am4core.color("#bf0e08");
//series8.stacked = true;

var series4 = chart.series.push(new am4charts.ColumnSeries3D());
series4.dataFields.valueY = "VALIDADO";
series4.dataFields.categoryX = "nombremes";
series4.name = "Validado";
series4.tooltipText = "{name}: [bold]{valueY}[/]";
series4.columns.template.stroke = am4core.color("#08bf2b"); // verde
series4.columns.template.fill = am4core.color("#08bf2b");
//series8.stacked = true;


// brechas para cantidad altas y pequeñas en el mismo grafico
var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script> 

 
 <script type="text/javascript">


//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
// am4core.useTheme(am4themes_kelly);
// am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
//var chart = am4core.create("chartdiv4", am4charts.XYChart);
var chart = am4core.create("chartdiv4_1", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data = <?php echo $chartDataH_M02 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nombremes";
categoryAxis.title.text = "Mes";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;



var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series

var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "REGISTRADO";
series.dataFields.categoryX = "nombremes";
series.name = "Registrado";
series.tooltipText = "{name}: [bold]{valueY}[/]";
series.columns.template.stroke = am4core.color("#3A87AD"); // 
series.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;



var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "PENDIENTE";
series2.dataFields.categoryX = "nombremes";
series2.name = "Pendiente";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
//series2.columns.template.column.fill = am4core.color("#ff0000");
series2.columns.template.stroke = am4core.color("#fc830d"); // naranja
series2.columns.template.fill = am4core.color("#fc830d");
//series2.stroke = am4core.color("#ff000");
//series8.stacked = true;


var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "RECHAZADO";
series3.dataFields.categoryX = "nombremes";
series3.name = "Rechazado";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#bf0e08"); // naranja
series3.columns.template.fill = am4core.color("#bf0e08");
//series8.stacked = true;

var series4 = chart.series.push(new am4charts.ColumnSeries3D());
series4.dataFields.valueY = "VALIDADO";
series4.dataFields.categoryX = "nombremes";
series4.name = "Validado";
series4.tooltipText = "{name}: [bold]{valueY}[/]";
series4.columns.template.stroke = am4core.color("#08bf2b"); // verde
series4.columns.template.fill = am4core.color("#08bf2b");
//series8.stacked = true;


// brechas para cantidad altas y pequeñas en el mismo grafico
var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script> 

 
 <script type="text/javascript">
 

//am4core.useTheme(am4themes_myTheme);
// Apply chart themes
am4core.useTheme(am4themes_animated);
// am4core.useTheme(am4themes_kelly);
// am4core.useTheme(am4themes_material);
//am4core.unuseTheme(am4themes_material);


// Create chart instance
//var chart = am4core.create("chartdiv4", am4charts.XYChart);
var chart = am4core.create("chartdiv4_2", am4charts.XYChart3D);
chart.marginRight = 400;

// Add data
chart.data = <?php echo $chartDataH_M03 ?>;
       

//console.log('chart', chart);

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nombremes";
categoryAxis.title.text = "Mes";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 80; // distancia entre lineas px

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;



var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M03";
valueAxis.calculateTotals = true;
valueAxis.min = 0;
//valueAxis.max = 1000;
//valueAxis.strictMinMax = true;
/* valueAxis.renderer.labels.template.adapter.add("text", function(text) {
      return text + "M";
    }); etiquela de las cantidades
*/

//valueAxis.extraMin = 0.2;
//valueAxis.extraMax = 0.2;
valueAxis.renderer.grid.template.strokeOpacity = 1;
valueAxis.renderer.grid.template.stroke = am4core.color("#A0CA92");
valueAxis.renderer.grid.template.strokeWidth = 2;

// Second value axis
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.title.text = "Unidades";
valueAxis2.renderer.opposite = true;



// Create series

var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "REGISTRADO";
series.dataFields.categoryX = "nombremes";
series.name = "Registrado";
series.tooltipText = "{name}: [bold]{valueY}[/]";
series.columns.template.stroke = am4core.color("#3A87AD"); // 
series.columns.template.fill = am4core.color("#3A87AD");
//series3.stacked = true;



var series2 = chart.series.push(new am4charts.ColumnSeries3D());
series2.dataFields.valueY = "PENDIENTE";
series2.dataFields.categoryX = "nombremes";
series2.name = "Pendiente";
series2.tooltipText = "{name}: [bold]{valueY}[/]";
//series2.columns.template.column.fill = am4core.color("#ff0000");
series2.columns.template.stroke = am4core.color("#fc830d"); // naranja
series2.columns.template.fill = am4core.color("#fc830d");
//series2.stroke = am4core.color("#ff000");
//series8.stacked = true;


var series3 = chart.series.push(new am4charts.ColumnSeries3D());
series3.dataFields.valueY = "RECHAZADO";
series3.dataFields.categoryX = "nombremes";
series3.name = "Rechazado";
series3.tooltipText = "{name}: [bold]{valueY}[/]";
series3.columns.template.stroke = am4core.color("#bf0e08"); // naranja
series3.columns.template.fill = am4core.color("#bf0e08");
//series8.stacked = true;

var series4 = chart.series.push(new am4charts.ColumnSeries3D());
series4.dataFields.valueY = "VALIDADO";
series4.dataFields.categoryX = "nombremes";
series4.name = "Validado";
series4.tooltipText = "{name}: [bold]{valueY}[/]";
series4.columns.template.stroke = am4core.color("#08bf2b"); // verde
series4.columns.template.fill = am4core.color("#08bf2b");
//series8.stacked = true;


// brechas para cantidad altas y pequeñas en el mismo grafico
var axisBreak = valueAxis.axisBreaks.create();
axisBreak.startValue = 20000;
axisBreak.endValue   = 90000;
axisBreak.breakSize = 0.05;

// Add cursor
chart.cursor = new am4charts.XYCursor();
// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";
</script> 

<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				$('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
					var color_class = $(this).find('option:selected').data('class');
					var new_class = 'widget-box';
					if(color_class != 'default')  new_class += ' widget-color-'+color_class;
					$(this).closest('.widget-box').attr('class', new_class);
				});
			
			
				// scrollables
				$('.scrollable').each(function () {
					var $this = $(this);
					$(this).ace_scroll({
						size: $this.attr('data-size') || 100,
						//styleClass: 'scroll-left scroll-margin scroll-thin scroll-dark scroll-light no-track scroll-visible'
					});
				});
				$('.scrollable-horizontal').each(function () {
					var $this = $(this);
					$(this).ace_scroll(
					  {
						horizontal: true,
						styleClass: 'scroll-top',//show the scrollbars on top(default is bottom)
						size: $this.attr('data-size') || 500,
						mouseWheelLock: true
					  }
					).css({'padding-top': 12});
				});
				
				$(window).on('resize.scroll_reset', function() {
					$('.scrollable-horizontal').ace_scroll('reset');
				});
			
				
				$('#id-checkbox-vertical').prop('checked', false).on('click', function() {
					$('#widget-toolbox-1').toggleClass('toolbox-vertical')
					.find('.btn-group').toggleClass('btn-group-vertical')
					.filter(':first').toggleClass('hidden')
					.parent().toggleClass('btn-toolbar')
				});
			
				/**
				//or use slimScroll plugin
				$('.slim-scrollable').each(function () {
					var $this = $(this);
					$this.slimScroll({
						height: $this.data('height') || 100,
						railVisible:true
					});
				});
				*/
				
			
				/**$('.widget-box').on('setting.ace.widget' , function(e) {
					e.preventDefault();
				});*/
			
				/**
				$('.widget-box').on('show.ace.widget', function(e) {
					//e.preventDefault();
					//this = the widget-box
				});
				$('.widget-box').on('reload.ace.widget', function(e) {
					//this = the widget-box
				});
				*/
			
				//$('#my-widget-box').widget_box('hide');
			
				
			
				// widget boxes
				// widget box drag & drop example
			    $('.widget-container-col').sortable({
			        connectWith: '.widget-container-col',
					items:'> .widget-box',
					handle: ace.vars['touch'] ? '.widget-title' : false,
					cancel: '.fullscreen',
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'widget-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					start: function(event, ui) {
						//when an element is moved, it's parent becomes empty with almost zero height.
						//we set a min-height for it to be large enough so that later we can easily drop elements back onto it
						ui.item.parent().css({'min-height':ui.item.height()})
						//ui.sender.css({'min-height':ui.item.height() , 'background-color' : '#F5F5F5'})
					},
					update: function(event, ui) {
						ui.item.parent({'min-height':''})
						//p.style.removeProperty('background-color');
			
						
						//save widget positions
						var widget_order = {}
						$('.widget-container-col').each(function() {
							var container_id = $(this).attr('id');
							widget_order[container_id] = []
							
							
							$(this).find('> .widget-box').each(function() {
								var widget_id = $(this).attr('id');
								widget_order[container_id].push(widget_id);
								//now we know each container contains which widgets
							});
						});
						
						ace.data.set('demo', 'widget-order', widget_order, null, true);
					}
			    });
				
				
				///////////////////////
			
				//when a widget is shown/hidden/closed, we save its state for later retrieval
				$(document).on('shown.ace.widget hidden.ace.widget closed.ace.widget', '.widget-box', function(event) {
					var widgets = ace.data.get('demo', 'widget-state', true);
					if(widgets == null) widgets = {}
			
					var id = $(this).attr('id');
					widgets[id] = event.type;
					ace.data.set('demo', 'widget-state', widgets, null, true);
				});
			
			
				(function() {
					//restore widget order
					var container_list = ace.data.get('demo', 'widget-order', true);
					if(container_list) {
						for(var container_id in container_list) if(container_list.hasOwnProperty(container_id)) {
			
							var widgets_inside_container = container_list[container_id];
							if(widgets_inside_container.length == 0) continue;
							
							for(var i = 0; i < widgets_inside_container.length; i++) {
								var widget = widgets_inside_container[i];
								$('#'+widget).appendTo('#'+container_id);
							}
			
						}
					}
					
					
					//restore widget state
					var widgets = ace.data.get('demo', 'widget-state', true);
					if(widgets != null) {
						for(var id in widgets) if(widgets.hasOwnProperty(id)) {
							var state = widgets[id];
							var widget = $('#'+id);
							if
							(
								(state == 'shown' && widget.hasClass('collapsed'))
								||
								(state == 'hidden' && !widget.hasClass('collapsed'))
							) 
							{
								widget.widget_box('toggleFast');
							}
							else if(state == 'closed') {
								widget.widget_box('closeFast');
							}
						}
					}
					
					
					$('#main-widget-container').removeClass('invisible');
					
					
					//reset saved positions and states
					$('#reset-widgets').on('click', function() {
						ace.data.remove('demo', 'widget-state');
						ace.data.remove('demo', 'widget-order');
						document.location.reload();
					});
				
				})();
			
			});
		</script>
                
                 
                
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u1", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData1 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
//categoryAxis.renderer.grid.template.disabled = true;

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;

categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>                

                
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u2", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData2 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
//categoryAxis.renderer.grid.template.disabled = true;

categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;

categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>                
                  
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u3", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData3 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;


// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>   


<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u4", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData4 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>   
 

<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u5", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData5 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>   


<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdiv4_u6", am4charts.XYChart);
chart.paddingRight = 25;

/* Add data */
chart.data = <?= $chartData6 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script>   
                    
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdivVM02", am4charts.XYChart);
chart.marginRight = 400;
//chart.paddingRight = 0;

/* Add data */
chart.data = <?= $chartDataVM02 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
//valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series7 = chart.series.push(new am4charts.ColumnSeries());
series7.dataFields.valueX = "TOTAL";
series7.dataFields.categoryY = "codigovalidador";
series7.columns.template.fill = am4core.color("#3A87AD");
series7.columns.template.stroke = am4core.color("#000");
series7.columns.template.strokeWidth = 0.5;
series7.columns.template.strokeOpacity = 0.5;
series7.columns.template.height = am4core.percent(70);
series7.name = "TOTAL";
series7.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series7.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 10;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script> 

               
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdivVM03", am4charts.XYChart);
chart.marginRight = 400;
//chart.paddingRight = 0;

/* Add data */
chart.data = <?= $chartDataVM03 ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M03";
valueAxis.renderer.minGridDistance = 40;
//valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series7 = chart.series.push(new am4charts.ColumnSeries());
series7.dataFields.valueX = "TOTAL";
series7.dataFields.categoryY = "codigovalidador";
series7.columns.template.fill = am4core.color("#3A87AD");
series7.columns.template.stroke = am4core.color("#000");
series7.columns.template.strokeWidth = 0.5;
series7.columns.template.strokeOpacity = 0.5;
series7.columns.template.height = am4core.percent(70);
series7.name = "TOTAL";
series7.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series7.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 10;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script> 

               
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdivVM02Hoy", am4charts.XYChart);
chart.marginRight = 400;
//chart.paddingRight = 0;

/* Add data */
chart.data = <?= $chartDataVM02Hoy ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M02";
valueAxis.renderer.minGridDistance = 40;
//valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series7 = chart.series.push(new am4charts.ColumnSeries());
series7.dataFields.valueX = "TOTAL";
series7.dataFields.categoryY = "codigovalidador";
series7.columns.template.fill = am4core.color("#3A87AD");
series7.columns.template.stroke = am4core.color("#000");
series7.columns.template.strokeWidth = 0.5;
series7.columns.template.strokeOpacity = 0.5;
series7.columns.template.height = am4core.percent(70);
series7.name = "TOTAL";
series7.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series7.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 10;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script> 
         
      
<script>

am4core.useTheme(am4themes_animated);

/* Create chart instance */
var chart = am4core.create("chartdivVM03Hoy", am4charts.XYChart);
chart.marginRight = 400;
//chart.paddingRight = 0;

/* Add data */
chart.data = <?= $chartDataVM03Hoy ?>;

/* Create axes */
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "codigovalidador";
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.cellStartLocation = 0.3;
categoryAxis.renderer.cellEndLocation = 0.7;
categoryAxis.title.text = "Validadores";

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Formulario M03";
valueAxis.renderer.minGridDistance = 40;
//valueAxis.renderer.grid.template.disabled = true;
valueAxis.min = 0;
//valueAxis.max = 100;
valueAxis.strictMinMax = true;

/* Create series */
var series7 = chart.series.push(new am4charts.ColumnSeries());
series7.dataFields.valueX = "TOTAL";
series7.dataFields.categoryY = "codigovalidador";
series7.columns.template.fill = am4core.color("#3A87AD");
series7.columns.template.stroke = am4core.color("#000");
series7.columns.template.strokeWidth = 0.5;
series7.columns.template.strokeOpacity = 0.5;
series7.columns.template.height = am4core.percent(70);
series7.name = "TOTAL";
series7.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series7.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

/* Create series */
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueX = "VALIDADO";
series.dataFields.categoryY = "codigovalidador";
series.columns.template.fill = am4core.color("#19d228");
series.columns.template.stroke = am4core.color("#000");
series.columns.template.strokeWidth = 0.5;
series.columns.template.strokeOpacity = 0.5;
series.columns.template.height = am4core.percent(70);
series.name = "VALIDADO";
series.tooltipText = "{name}: [bold]{valueX}[/]";


// label bullet
var labelBullet = new am4charts.LabelBullet();
series.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 10;

/* Create series */
var series3 = chart.series.push(new am4charts.ColumnSeries());
series3.dataFields.valueX = "RECHAZADO";
series3.dataFields.categoryY = "codigovalidador";
series3.columns.template.fill = am4core.color("#bf0e08");
series3.columns.template.stroke = am4core.color("#000");
series3.columns.template.strokeWidth = 0.5;
series3.columns.template.strokeOpacity = 0.5;
series3.columns.template.height = am4core.percent(70);
series3.name = "RECHAZADO";
series3.tooltipText = "{name}: [bold]{valueX}[/]";

// label bullet
var labelBullet = new am4charts.LabelBullet();
series3.bullets.push(labelBullet);
labelBullet.label.text = "{valueX.value.formatNumber('#.')}";
labelBullet.strokeOpacity = 0;
labelBullet.stroke = am4core.color("#dadada");
labelBullet.dx = 15;

// Add legend
chart.legend = new am4charts.Legend();// aclaracion de 

// Add cursor
chart.cursor = new am4charts.XYCursor();

chart.scrollbarX = new am4core.Scrollbar();
chart.scrollbarY = new am4core.Scrollbar();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.align = "left";
chart.exporting.menu.verticalAlign = "top";                
                </script> 
                         
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

