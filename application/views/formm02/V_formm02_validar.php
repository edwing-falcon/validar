<?php if(!empty($formm02)):?>
    <?php foreach($formm02 as $form): ?>
    <?php $id = (int) $form->id;?>
    <?php $cod = $form->codigoformm02;?>
<?php endforeach ?>
<?php endif ?>	

<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    ID: <?php echo $id;?>         CODIGO: <?php echo $cod;?> 
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Formulario M-02    
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
                            <div class="table-header"> 1. DATOS DEL COMPRADOR</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NRO NIM</th>
                                            <th style="text-align: center">RAZON SOCIAL</th>
                                            <th style="text-align: center">NRO NIT</th>
                                            <th style="text-align: center">FECHA TRANSACCION</th>
                                            <th style="text-align: center">COTIZACION DOLAR[Bs./$us]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->codigooperador?></td>
                                            <td style="text-align: center"><?php echo $form->comprador;?></td>
                                            <td style="text-align: center"><?php echo $form->onronit;?></td>
                                            <td style="text-align: center"><?php echo $form->fechatransaccion;?></td>
                                            <td style="text-align: center"><?php echo $form->tipocambiobs;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 2. DATOS DEL VENDEDOR</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NRO NIM</th>
                                            <th style="text-align: center">RAZON SOCIAL / NOMBRE</th>
                                            <th style="text-align: center">NRO NIT / CI</th>
                                            <th style="text-align: center">LABORATORIO</th>
                                            <th style="text-align: center">CERTIFICADOS ANALISIS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->nimvendedor;?></td>
                                            <td style="text-align: center"><?php echo $form->razonsocialvendedor;?></td>
                                            <td style="text-align: center"><?php echo $form->nronit;?></td>
                                            <td style="text-align: center"><?php echo $form->descripcion;?></td>
                                            <td style="text-align: center"><?php echo $form->certificadoanalisis;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 3. PROCEDENCIA DEL MINERAL</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NOMBRE DE CONCESION MINERA</th>
                                            <th style="text-align: center">DEPARTAMENTO</th>
                                            <th style="text-align: center">PROVINCIA</th>
                                            <th style="text-align: center">MUNICIPIO</th>
                                            <th style="text-align: center">LOCALIDAD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->nombremina;?></td>
                                            <td style="text-align: center"><?php echo $form->departamento;?></td>
                                            <td style="text-align: center"><?php echo $form->provincia;?></td>
                                            <td style="text-align: center"><?php echo $form->municipio;?></td>
                                            <td style="text-align: center"><?php echo $form->localidad;?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 4. CARACTERISTICAS DEL MINERAL COMERCIALIZADO</div>
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
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $form): ?>
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
                            <div class="table-header"> 5. VALOR OFICIAL (REGALIA MINERA)</div>
                            <div>
                                <?php if(!empty($formm02totalesregalia)):?>
                                <?php foreach($formm02totalesregalia as $formtre): ?>
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
                                            <th style="text-align: center">ALICUOTA INTERNA[%]</th>
                                            <th style="text-align: center">REGALIA MINERA[Bs]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm02regalias)):?>
                                        <?php foreach($formm02regalias as $formrm): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $formrm->elemento;?></td>
                                            <td style="text-align: center"><?php echo $formrm->codigonandina;?></td>
                                            <td style="text-align: center"><?php echo $formrm->descripcion;?></td>
                                            <td style="text-align: center"><?php echo $formrm->leymineral.' ['.$formrm->leyunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->pesofinokg,5);?></td>
                                            <td style="text-align: center"><?php echo $formrm->pesofino.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: center"><?php echo $formrm->cotizacionmineral.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutousd,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutobs,2);?></td>
                                            <td style="text-align: center"><?php echo $formrm->alicuotainterna;?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->regalia,2);?></td>
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
                            <div class="table-header"> 6. TRANSACCION INTERNA</div>
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
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $formrm): ?>
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
                            <div class="table-header"> 7. APORTE DEPARTAMENTAL Y MUNICIPAL</div>
                            <div>
                                <?php if(!empty($formm02totalaportedepartamental)):?>
                                <?php foreach($formm02totalaportedepartamental as $formtaportedepa): ?>
                                    <?php $suma_importermbs = $formtaportedepa->suma_importermbs;?>
                                    <?php $suma_aportemunicipalbs = $formtaportedepa->suma_aportemunicipalbs;?>
                                    <?php $suma_aportedepartamentalbs = $formtaportedepa->suma_aportedepartamentalbs;?>
                                <?php endforeach ?>
                                <?php endif ?>
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
                                        <?php if(!empty($formm02aportedepartamental)):?>
                                        <?php foreach($formm02aportedepartamental as $formaportedepartamental): ?>
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
                            </div>
                            <div class="table-header"> 8. APORTES INSTITUCIONALES</div>
                            <div>
                                <?php if(!empty($formm02totalimporte)):?>
                                <?php foreach($formm02totalimporte as $timporte): ?>
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
                                        <?php if(!empty($formm02aporte)):?>
                                        <?php foreach($formm02aporte as $forma): ?>
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
                            <div class="table-header"> LOS DATOS DEL PRESENTE FORMULARIO SON CORRECTOS</div>
                            <div style="background: #F2F2F2">
                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_recepcion/guardar" >
                                <br/>
                                    <div class="col-xs-4">
                                        <input type="hidden" name="idform" value="<?php echo $id; ?>" />
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="verificar" value="si" id="si" onclick="validar()" class="ace input-lg" />
                                                <span class="lbl bigger-120"><strong> Verificado</strong></span>
                                                <!--<strong><p style="font-size: 15px;"><span class="lbl bigger-120"> Verificado</span></p></strong>-->
                                            </label>  
                                        </div>
                                        <br/> 
                                        <input type="text" name="obsval" id="otro" value="" placeholder="Observacion" maxlength="2500"/>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="radio">    
                                            <label>
                                                <input type="radio" name="verificar" value="no" id="no" onclick="validar()" class="ace input-lg" />
<!--                                                <strong><p style="font-size: 15px;"><span class="lbl bigger-120"> Rechazado</span></p></strong>-->
                                                    <span class="lbl bigger-120"> <strong>Rechazado</strong></span>
                                            </label>
                                            <br/>    
                                            <br/> 
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right"> Motivo Rechazo </label>
                                            <select multiple="multiple" id="state" name="motivos" class="select2" data-placeholder="Click to Choose...">
                                                
                                            <?php if(!empty($motivos)):?>
                                            <?php foreach($motivos as $motivo): ?>    
                                                <option value="<?php echo $motivo->id; ?>"><?php echo $motivo->motivo; ?></option>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                            </select>
                                            <br/><br/><br/>
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right"> Observacion </label>
                                            <input type="text" name="obs" id="otro" value="" placeholder="Observacion" maxlength="2500"/>
                                        </div>
                                    </div>    
                                    <div class="col-xs-4">
                                        <label class=""><strong><p style="font-size: 20px;"> Bitacora de Formulario</p></strong></label>
                                        <p>Fecha: 01/05/2018 - REGISTRO EN SISITEMA</p>
                                        <p>Fecha: 13/05/2018 - Origen de mineral / 15 Dias</p>
                                        <p>Fecha: 25/07/2018 - 15 Dias</p>
                                        <p>Fecha: 18/01/2018 - 15 Dias</p>
                                    </div>    
                                    <div class="row">
                                        <input type="submit" value="Guardar"/><div class="col-xs-2"></div><!--<input type="button" value="cancelar"/>-->
                                    </div>    
                                </form>
                            </div>
                            <div style="background: #F2F2F2">
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
    
    

<script>
    /*function validar(){
    if(document.formvalidar.verificar[1].checked == true){
        document.getElementById('recojanme').style.display='block';
    
    }else{
        document.getElementById('recojanme').style.display='none';
   
//        var ele = document.getElementsByName("metodo");
//        for(var i=0;i<ele.length;i++){
//          ele[i].checked = false;
//        }
    }
}*/
</script>