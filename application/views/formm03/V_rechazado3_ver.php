<?php 
    $id = $ids;
    $cod = $codigos;
?>

<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>FORMULARIO M-03 RECHAZADO</h1><br/>
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
                                            <th style="text-align: center">LOTE</th>
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
                                            <td style="text-align: center"><?php echo $form->lote;?></td>
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
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 3. CARACTERISTICAS DEL MINERAL COMERCIALIZADO</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">PRESENTACION DEL PRODUCTO</th>
                                            <th style="text-align: center">PESO BRUTO HUMEDO[Kg]</th>
                                            <th style="text-align: center">TARA[kg]</th>
                                            <th style="text-align: center">PESO NETO HUMEDO[kg]</th>
                                            <th style="text-align: center">HUMEDAD[%]</th>
                                            <th style="text-align: center">MERNA[%]</th>
                                            <th style="text-align: center">MERNA[kg]</th>
                                            <th style="text-align: center">PESO NETO SECO[kg]</th>
                                            <th style="text-align: center">NUMERO(S) DE LOTE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03)):?>
                                        <?php foreach($formm03 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->presentacion;?></td>
                                            <td style="text-align: center"><?php echo number_format($form->pbh,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->tara,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->pnh, 2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->humedad, 2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->mermaporcentaje, 2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->mermakg,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($form->pns,5);?></td>
                                            <td style="text-align: center"><?php echo $form->lote;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 4. VALOR OFICIAL (REGALIA MINERA)</div>
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
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 5. TRANSACCION INTERNA (SI CORRESPONDE)</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">TOTAL VALOR BRUTO VENTA [$us]</th>
                                            <th style="text-align: center">TOTAL VALOR BRUTO VENTA [Bs]</th>
                                            <th style="text-align: center">VALOR NETO VENTA [Bs]</th>
                                            <th style="text-align: center">COSTO COMERCIALIZACION [%]</th>
                                            <th style="text-align: center">TOTAL DEDUCCIONES INSTITUCIONALES [Bs]</th>
                                            <th style="text-align: center">LIQUIDO PAGABLE[Bs]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03)):?>
                                        <?php foreach($formm03 as $formrm): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo number_format($formrm->totalvbvusd,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($formrm->totalvbvbs,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($formrm->vnv,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($formrm->gastosacordado,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($formrm->totaldeducciones,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($formrm->liquido,2);?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 6. APORTE DEPARTAMENTAL Y MUNICIPAL</div>
                            <div>
                                <?php if(!empty($formm03totalaportedepartamental)):?>
                                <?php foreach($formm03totalaportedepartamental as $formtaportedepa): ?>
                                    <?php $suma_importermbs = $formtaportedepa->suma_importermbs;?>
                                    <?php $suma_aportemunicipalbs = $formtaportedepa->suma_aportemunicipalbs;?>
                                    <?php $suma_aportedepartamentalbs = $formtaportedepa->suma_aportedepartamentalbs;?>
                                <?php endforeach ?>
                                <?php endif ?>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">CODIGO MUNICIPIO</th>
                                        <th style="text-align: center">IMPORTE RM</th>
                                        <th style="text-align: center">MUNICIPIO</th>
                                        <th style="text-align: center">APORTE MUNICIPAL[15%]</th>
                                        <th style="text-align: center">DEPARTAMENTO</th>
                                        <th style="text-align: center">APORTE DEPARTAMENTAL[85%]</th>
                                        <th style="text-align: center">ENTIDAD FINANCIERA</th>
                                        <th style="text-align: center">NRO. ORDEN</th>
                                        <th style="text-align: center">FECHA DE DEPOSITO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($formm03aportedepartamental)):?>
                                    <?php foreach($formm03aportedepartamental as $formaportedepartamental): ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->codigo;?></td>
                                        <td style="text-align: right"><?php echo number_format($formaportedepartamental->importermbs,2);?></td>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->municipio;?></td>
                                        <td style="text-align: right"><?php echo number_format($formaportedepartamental->aportemunicipalbs,2);?></td>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->departamento;?></td>
                                        <td style="text-align: right"><?php echo number_format($formaportedepartamental->aportedepartamentalbs,2);?></td>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->entidadfinanciera;?></td>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->nrodeorden;?></td>
                                        <td style="text-align: center"><?php echo $formaportedepartamental->fechadeposito;?></td>
                                    </tr>
                                    <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="text-align: center; background: #999">TOTALES</td>
                                        <td style="text-align: right; background: #999"><?php echo number_format($suma_importermbs,2);?></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right; background: #999"><?php echo number_format($suma_aportemunicipalbs,2);?></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: right; background: #999"><?php echo number_format($suma_aportedepartamentalbs,2);?></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center"></td>
                                        <td style="text-align: center"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > 7. APORTES INSTITUCIONALES</div>
                            <div>
                                <?php if(!empty($formm03totalimporte)):?>
                                <?php foreach($formm03totalimporte as $timporte): ?>
                                    <?php $suma_importe = $timporte->suma_importe;?>
                                <?php endforeach ?>
                                <?php endif ?>  
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ENTIDAD APORTE</th>
                                            <th style="text-align: center">TIPO BASE APORTE</th>
                                            <th style="text-align: center">BASE APORTE [Bs]</th>
                                            <th style="text-align: center">APORTE [%]</th>
                                            <th style="text-align: center">IMPORTE [Bs]</th>
                                            <th style="text-align: center">ENTIDAD FINANCIERA</th>
                                            <th style="text-align: center">NRO CUENTA</th>
                                            <th style="text-align: center">NRO DEPOSITO</th>
                                            <th style="text-align: center">FECHA DEPOSITO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm03aporte)):?>
                                        <?php foreach($formm03aporte as $forma): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $forma->entidad_aporte;?></td>
                                            <td style="text-align: center"><?php echo $forma->tipobaseaporte;?></td>
                                            <td style="text-align: center"><?php echo number_format($forma->valorbaseaportebs,2);?></td>
                                            <td style="text-align: center"><?php echo number_format($forma->porcentajeaporte,2);?></td>
                                            <td style="text-align: right"><?php echo  number_format($forma->importebs, 2);?></td>
                                            <td style="text-align: center"><?php echo $forma->entidad_financiera;?></td>
                                            <td style="text-align: center"><?php echo $forma->nrocuenta;?></td>
                                            <td style="text-align: center"><?php echo $forma->nrodeposito;?></td>
                                            <td style="text-align: center"><?php echo $forma->fechadeposito;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right; background: #999">TOTALES</td>
                                            <td style="text-align: right; background: #999"><?php echo  number_format($suma_importe, 2);?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br/>
                            <br/>
                            <div style="background-color:#D67E31; color:#FFF; font-size:14px; line-height:20px; padding-left:12px; margin-bottom:1px;" > DATOS DEL PRESENTE FORMULARIO</div>
                            <div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="widget-box">
                                            <div class="widget-header">
                                                <h4 class="smaller">Bitacora de Formulario</h4>
                                            </div>
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
                                                    <?php $aux=""; $aux1=""; $aux2=""; $aux3=""; ?>
                                                    <?php if(!empty($bitacoras)):?>
                                                    <?php foreach ($bitacoras as $recep) { ?>
                                                        <tr>
                                                            <td style="text-align: center">
                                                            <?php if ($aux != $recep->fecha) {
                                                                 $aux=$recep->fecha; 
                                                                 echo $recep->fecha;
                                                            }
                                                            ?></td>

                                                            <td style="text-align: center">
                                                            <?php if($aux1 != $recep->usuario){
                                                                $aux1=$recep->usuario; 
                                                                echo $recep->usuario;
                                                            } 
                                                            ?></td>

                                                            <td style="text-align: center">
                                                            <?php if($aux2 != $recep->lugar){
                                                                $aux2=$recep->lugar;
                                                                echo $recep->lugar;
                                                            }        
                                                            ?></td>

                                                            <td style="text-align: left">
                                                            <?php if($aux3 != $recep->obsmal){
                                                                $aux3=$recep->obsmal;
                                                                echo $recep->obsmal;
                                                            }
                                                            ?></td>
                                                            <td style="text-align: left"><?php echo $recep->detalle;?> </td>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php endif ?>    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    