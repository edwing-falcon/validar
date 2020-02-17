<?php 
    $id = $ids;
    $cod = $codigos;
    $codigo = $this->session->userdata("codigo");
?>	
<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>VALIDAR FORMULARIO M-02</h1><br/>
                <h1>
                    ID: <?php echo $id;?>         CODIGO: <?php echo $cod;?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Formulario M-02    
                    </small>
                </h1>
            </div>
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
                                            <td style="text-align: center; background: #fbed50;"><?php echo $form->comprador;?></td>
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
                                            <th style="text-align: center">LOTE</th>
                                            <th style="text-align: center">LABORATORIO</th>
                                            <th style="text-align: center">CERTIFICADOS ANALISIS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($formm02)):?>
                                        <?php foreach($formm02 as $form): ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo $form->nimvendedor;?></td>
                                            <td style="text-align: center; background: #fbed50;"><?php echo $form->razonsocialvendedor;?></td>
                                            <td style="text-align: center"><?php echo $form->nronit;?></td>
                                            <td style="text-align: center"><?php echo $form->lote;?></td>
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
                                            <td style="text-align: center; background: #fbed50;"><?php echo $form->nombremina;?></td>
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
                                            <td style="text-align: center; background: #fbed50;"><?php echo $form->lote;?></td>
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
                                            <td style="text-align: center; background: #fbed50;"><?php echo $formrm->leymineral.' ['.$formrm->leyunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->pesofinokg,5);?></td>
                                            <td style="text-align: center"><?php echo $formrm->pesofino.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: center"><?php echo $formrm->cotizacionmineral.' ['.$formrm->cotizacionunidad.']';?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutousd,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($formrm->valorbrutobs,2);?></td>
                                            <td style="text-align: center"><?php echo $formrm->alicuotainterna;?></td>
                                            <td style="text-align: right; background: #fbed50;"><?php echo number_format($formrm->regalia,2);?></td>
                                        </tr>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center; background: #999;">TOTALES</td>
                                            <td style="text-align: right; background: #999;"><?php echo number_format($suma_pesofino,5);?></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: center"></td>
                                            <td style="text-align: right; background: #999;"><?php echo number_format($suma_vbvusb,2);?></td>
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
                                            <td style="text-align: center; background: #fbed50;"><?php echo number_format($formrm->totalvbvbs,2);?></td>
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
                                            <td style="text-align: right; background: #fbed50;"><?php echo number_format($formaportedepartamental->importermbs,2);?></td>
                                            <td style="text-align: center"><?php echo $formaportedepartamental->municipio;?></td>
                                            <td style="text-align: right"><?php echo number_format($formaportedepartamental->aportemunicipalbs,2);?></td>
                                            <td style="text-align: center"><?php echo $formaportedepartamental->departamento;?></td>
                                            <td style="text-align: right"><?php echo number_format($formaportedepartamental->aportedepartamentalbs,2);?></td>
                                            <td style="text-align: center"><?php echo $formaportedepartamental->entidadfinanciera;?></td>
                                            <td style="text-align: center; background: #fbed50;"><?php echo $formaportedepartamental->nrodeorden;?></td>
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
                                            <td style="text-align: right; background: #fbed50;"><?php echo  number_format($forma->importebs, 2);?></td>
                                            <td style="text-align: center"><?php echo $forma->entidad_financiera;?></td>
                                            <td style="text-align: center"><?php echo $forma->nrocuenta;?></td>
                                            <td style="text-align: center; background: #fbed50;"><?php echo $forma->nrodeposito;?></td>
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
                            <div class="table-header"> LOS DATOS DEL PRESENTE FORMULARIO SON CORRECTOS</div>
                            <!--<div style="background: #F2F2F2">-->
                            <div>
                                <br/>
                                <div class="row">
                                    <?php if($codigo == "REG"): ?>
                                        <div class="col-sm-5">
                                            <div class="widget-box">
                                                <div class="widget-header">
                                                    <h4 class="smaller">
                                                        Acciones
                                                    </h4>
                                                </div>
                                                <form class="form-horizontal" role="form" method="POST" name="formvalidar" action="<?php echo base_url();?>C_recepcion/guardar" >
                                                    <br/>
                                                    <input type="hidden" name="idform" value="<?php echo $id; ?>" />
                                                    <div class="row">
                                                        <div class="col-xs-1"></div>
                                                        <div class="col-xs-3">
                                                            <p>Observaci&oacuten</p>
                                                            <input type="text" name="obsval" id="otro" value="" placeholder="Observacion" maxlength="80"/>
                                                        </div>
                                                        <div class="col-xs-1"></div>
                                                        <div class="col-xs-6">
                                                            <input type="submit" value="Validado" name="btn" class="btn btn-primary btn-block"/>
                                                        </div>
                                                    </div>   
                                                    <hr />
                                                    <div class="row">
                                                        <div class="col-xs-1"></div>
                                                        <div class="col-xs-3">
                                                            <p>Motivo de Rechazo</p>
                                                            <select id="rechazos" name="rechazos[]" class="multiselect" multiple="">
                                                                <?php if(!empty($rechazos)):?>
                                                                <?php foreach($rechazos as $rechazo): ?>
                                                                    <?php if($rechazo->id == 1):?>
                                                                        <option selected value="<?php echo $rechazo->id; ?>"><?php echo $rechazo->detalle; ?>
                                                                    <?php else: ?>
                                                                        <option value="<?php echo $rechazo->id; ?>"><?php echo $rechazo->detalle; ?>
                                                                    <?php endif ?>
                                                                <?php endforeach ?>
                                                                <?php endif ?>
                                                            </select>
                                                        </div>    
                                                    </div>
                                                    <br/>
                                                    <div class="row">
                                                        <div class="col-xs-1"></div>
                                                        <div class="col-xs-3">
                                                            <p>Observaci&oacuten</p>
                                                            <input type="text" name="obsmal" id="otro" value="" placeholder="Observacion" maxlength="2500"/>
                                                        </div>   
                                                        <div class="col-xs-1"></div>
                                                        <div class="col-xs-6">
                                                            <input type="submit" value="Rechazado" name="btn" class="btn btn-danger btn-block"/>
                                                        </div>
                                                    </div>    
                                                </form>
                                                <br/>
                                            </div>
                                        </div>
                                    <?php endif; ?>
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
                                <?php if( $this->session->userdata("error") ):?>
                                    <div class="alert alert-danger">
                                        <p><?php  echo $this->session->userdata("error");?></p>
                                    </div>
                                    <?php $this->session->unset_userdata('error'); ?>
                                <?php endif; ?>
                                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    
    
    