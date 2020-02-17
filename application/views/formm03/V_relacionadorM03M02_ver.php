<?php 
    $id = $ids;
    $cod = $codigos;
?>
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>FORMULARIO M-03</h1><br/>
                <h1>
                    ID: <?php echo $id;?>         CODIGO: <?php echo $cod;?> 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Formulario M-03
                    </small>
                </h1>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="clearfix">
                                <div class="pull-right tableTools-container"></div>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 1. DATOS DEL EXPLORADOR</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NRO NIM</th>
                                            <th style="text-align: center">RAZON SOCIAL</th>
                                            <th style="text-align: center">NRO NIT</th>
                                            <th style="text-align: center">NRO RUEX</th>
                                            <th style="text-align: center">FECHA EXPLORADOR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03)):?>
                                        <?php foreach($formm03 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->nim;?></td>
                                            <td style="text-align: center"><?php echo $form->exportador;?></td>
                                            <td style="text-align: center"><?php echo $form->nnit;?></td>
                                            <td style="text-align: center"><?php echo $form->ruex;?></td>
                                            <td style="text-align: center"><?php echo $form->fechaexportacion;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">LABORATORIO</th>
                                            <th style="text-align: center">CERTIFICADO DE ANALISIS</th>
                                            <th style="text-align: center">ADUANA SALIDA</th>
                                            <th style="text-align: center">CODIGO ADUANA</th>
                                            <th style="text-align: center">FACTURA COMERCIAL</th>
                                            <th style="text-align: center">COTIZACION DOLAR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03)):?>
                                        <?php foreach($formm03 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->laboratorio;?></td>
                                            <td style="text-align: center"><?php echo $form->certificadoanalisis;?></td>
                                            <td style="text-align: center"><?php echo $form->aduanasalida;?></td>
                                            <td style="text-align: center"><?php echo $form->codigoaduana;?></td>
                                            <td style="text-align: center"><?php echo $form->nrofactura;?></td>
                                            <td style="text-align: center"><?php echo $form->tipocambiobs;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 2. DATOS DEL COMPRADOR</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">PAIS DESTINO</th>
                                            <th style="text-align: center">RAZON SOCIAL</th>
                                            <th style="text-align: center">VALOR FOB FRONTERA [$us]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03)):?>
                                        <?php foreach($formm03 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->paisdestino;?></td>
                                            <td style="text-align: center"><?php echo $form->razonsocialcomprador;?></td>
                                            <td style="text-align: center"><?php echo $form->fob;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 3. VALOR OFICIAL (REGALIA MINERA)</div>
                            <div>
                                <?php if(!empty($formm03totalesregalia)):?>
                                <?php foreach($formm03totalesregalia as $formtre): ?>
                                    <?php $suma_pesofino = $formtre->suma_pesofino;?>
                                    <?php $suma_vbvusb = $formtre->suma_vbvusb;?>
                                    <?php $suma_vbvbs = $formtre->suma_vbvbs;?>
                                    <?php $suma_regalia = $formtre->suma_regalia;?>
                                <?php endforeach ?>
                                <?php endif ?>  
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">MINERAL</th>
                                            <th style="text-align: center">NANDINA</th>
                                            <th style="text-align: center">DESCRIPCION NANDINA</th>
                                            <th style="text-align: center">LEY MINERAL</th>
                                            <th style="text-align: center">PESO FINO[Kg]</th>
                                            <th style="text-align: center">PESO FINO VALOR</th>
                                            <th style="text-align: center">COTIZACION MINERAL[$us]</th>
                                            <th style="text-align: center">VALOR BRUTO VENTA[$us]</th>
                                            <th style="text-align: center">VALOR BRUTO VENTA[Bs]</th>
                                            <th style="text-align: center">ALICUOTA EXTERNA[%]</th>
                                            <th style="text-align: center">REGALIA MINERA[Bs]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03regalias)):?>
                                        <?php foreach($formm03regalias as $formrm): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $formrm->elemento;?></td>
                                            <td style="text-align: center"><?php echo $formrm->nandina;?></td>
                                            <td style="text-align: center"><?php echo $formrm->descrinandina;?></td>
                                            <td style="text-align: center"><?php echo $formrm->leymineral.' ['.$formrm->leyunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->pesofinokg,5);?></td>
                                            <td style="text-align: center"><?php echo $formrm->pesofino.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: center"><?php echo $formrm->cotizacionmineral.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutousd,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutobs,2);?></td>
                                            <td style="text-align: center"><?php echo $formrm->alicuotaexterna;?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->regaliabs,2);?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center; background: #999">TOTALES</td>
                                            <td style="text-align: right; background: #999"><?php echo number_format($suma_pesofino,5);?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right; background: #999"><?php echo number_format($suma_vbvusb,2);?></td>
                                            <td style="text-align: right; background: #999"><?php echo number_format($suma_vbvbs,2);?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right; background: #999"><?php echo number_format($suma_regalia,2);?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br/><br/>
                            <!--<div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > LOS DATOS DEL PRESENTE FORMULARIO</div>
                            <div style="background: #F2F2F2">-->
                                <br/>
                                <!--<div class="col-xs-5">
                                    <div><strong><p style="font-size: 25px">BITACORA DE FORMULARIO</p></strong></div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Fecha</th>
                                                <th style="text-align: center">Usuario</th>
                                                <th style="text-align: center">Serecom</th>
                                                <th style="text-align: center">Observacion</th>
                                                <th style="text-align: center">Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($recepciones as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: left"><?php echo $recep->razonsocialvendedor;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechatransaccion;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechavalidacion;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalkilosfinos,2);?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->totalvbvbs,2);?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_concluido/ver/<?php echo $recep->id;?>" class="btn-xs btn-primary"><span class="ace-icon fa fa-search"></span></a>
                                                </td> 
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    </table>
                                </div>-->
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    