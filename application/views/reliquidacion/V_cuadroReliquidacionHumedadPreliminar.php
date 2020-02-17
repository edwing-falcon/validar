<?php 
    $idformm03 = $idformm03s;
    $lote = $lotes;
    $exportador = $exportadors;
    $tipo = strtoupper($tipos);
    $humedad_senarecom = $humedad_senarecoms;
    $humedad_declarada = $humedad_declaradas;
    $diferencia = $diferencias; 
    $estado = $estados;
?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>CUADRO DE RELIQUIDACION PRELIMINAR POR <?php echo $tipo;?><br/><br/>
                    EXPORTADOR: <?php echo $exportador;?><br/><br/>
                    ID M-03: <?php echo $idformm03;?>   LOTE: <?php echo $lote;?></h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div style="background-color:#9630B9; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > DATOS PRELIMINAR DE RELIQUIDACION</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">HUMEDAD DECLARADA</th>
                                            <th style="text-align: center">HUMEDAD SENARECOM</th>
                                            <th style="text-align: center">FACTOR (HD*100/HS) > 125</th>
                                            <th style="text-align: center">ESTADO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center"><?php echo $humedad_declarada;?></td>
                                            <td style="text-align: center"><?php echo $humedad_senarecom;?></td>
                                            <td style="text-align: center"><?php echo $diferencia;?></td>
                                            <td style="text-align: center"><?php echo $estado;?></td>
                                        </tr>
                                    </tbody>
                                </table>
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