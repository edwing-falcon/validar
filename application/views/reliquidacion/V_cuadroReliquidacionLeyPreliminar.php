<?php 
    $idformm03 = $idformm03s;
    $lote = $lotes;
    $exportador = $exportadors;
    $tipo = strtoupper($tipos);
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
                                            <th style="text-align: center">ELEMENTO</th>
                                            <th style="text-align: center">SIMBOLO</th>
                                            <th style="text-align: center">LEY DECLARADO</th>
                                            <th style="text-align: center">LEY SENARECOM</th>
                                            <th style="text-align: center">FACTOR (LS*99.5)/100 > LD</th>
                                            <th style="text-align: center">ESTADO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($minerals as $recep) { ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $recep->elemento;?></td>
                                            <td style="text-align: center"><?php echo $recep->simbolo;?></td>
                                            <td style="text-align: center"><?php echo $recep->leyvalor_declarado;?> [<?php echo $recep->leyunidad_declarado;?>]</td>
                                            <td style="text-align: center"><?php echo $recep->leyvalor_senarecom;?> [<?php echo $recep->leyunidad_senarecom;?>]</td>
                                            <td style="text-align: center"><?php echo $recep->diferencia;?></td>
                                            <td style="text-align: center"><?php echo $recep->estado;?></td>
                                        </tr>
                                        <?php } ?>
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