<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Declaracion del Formulario de compra y venta de minerales y metales
        <small>Formulario - M02</small>
        </h1>
    </section>
    <?php if(!empty($formm02)):?>
        <?php foreach($formm02 as $form): ?>
            <?php $id = (int) $form->id;?>
            <?php $cod = $form->codigoformm02;?>
    <?php endforeach ?>
    <?php endif ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <h3>ID: <?php echo $id?></h3>
            </div>
            <div class="col-xs-3">
                <h3>CODIGO: <?php echo $cod?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <!--<a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a>-->
                        <h3 class="box-title" style="color: white">  &nbsp; 1. DATOS DE TRANSACCION</h3>
                    </div>
                    <div id="transaccion" class="box-body table-responsive no-padding">
                        <table name="transaccion" id="transaccion" class="table table-bordered table-hover">
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 2. DATOS DEL VENDEDOR</h3>
                    </div>
                    <div id="vendedor" class="box-body table-responsive no-padding">
                        <table name="vendedor" id="vendedor" class="table table-bordered table-hover">
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 3. PROCEDENCIA DEL MINERAL</h3>
                    </div>
                    <div id="procedencia" class="box-body table-responsive no-padding">
                        <table name="procedencia" id="procedencia" class="table table-bordered table-hover">
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 4. CARACTERISTICAS DEL MINERAL COMERCIALIZADO</h3>
                    </div>
                    
                    <div id="caracteristicas" class="box-body table-responsive no-padding">
                        <table name="caracteristicas" id="caracteristicas" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">PRESENTACION DEL PRODUCTO</th>
                                    <th style="text-align: center">PESO BRUTO HUMEDO</th>
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 5. VALOR OFICIAL (Regalia Minera)</h3>
                    </div>
                    
                    <div id="valorregalia" class="box-body table-responsive no-padding">
                        <?php if(!empty($formm02totalesregalia)):?>
                            <?php foreach($formm02totalesregalia as $formtre): ?>
                                <?php $suma_pesofino = $formtre->suma_pesofino;?>
                                <?php $suma_vbvusb = $formtre->suma_vbvusb;?>
                                <?php $suma_vbvbs = $formtre->suma_vbvbs;?>
                                <?php $suma_regalia = $formtre->suma_regalia;?>
                            <?php endforeach ?>
                        <?php endif ?>    
                        <table name="valorregalia" id="valorregalia" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th style="text-align: center">MINERAL</th>
                                    <th style="text-align: center">NANDINA</th>
                                    <th style="text-align: center">DESCRIPCION NANDINA</th>
                                    <th style="text-align: center">LEY MINERAL</th>
                                    <th style="text-align: center">PESO FINO[Kg]</th>
                                    <th style="text-align: center">PESO FINO</th>
                                    <th style="text-align: center">COTIZACION MINERAL[$us]</th>
                                    <th style="text-align: center">VALOR BRUTO VENTA[$us]</th>
                                    <th style="text-align: center">VALOR BRUTO VENTA[Bs]</th>
                                    <th style="text-align: center">ALICUOTA INTERNA[%]</th>
                                    <th style="text-align: center">REGALIA MINERA[Bs]</th>
                                    <th style="text-align: center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($formm02calculorm)):?>
                                <?php foreach($formm02calculorm as $formrm): ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $formrm->id;?></td>
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
                                    <td style="text-align: center">
                                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $formrm->id;?>" class="btn-xs btn-warning"><span class="fa fa-pencil"></span></a>
                                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $formrm->id;?>" class="btn-xs btn-danger"><span class="fa fa-close"></span></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align: center"></td>
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 6. TRANSACCION INTERNA</h3>
                    </div>
                    
                    <div id="transaccioninterna" class="box-body table-responsive no-padding">
                        <table name="transaccioninterna" id="transaccioninterna" class="table table-bordered table-hover">
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 7. APORTE DEPARTAMENTAL Y MUNICIPAL</h3>
                    </div>
                    
                    <div id="aportedepartamental" class="box-body table-responsive no-padding">
                        <?php if(!empty($formm02totalaportedepartamental)):?>
                            <?php foreach($formm02totalaportedepartamental as $formtaportedepartamental): ?>
                                <?php $suma_importermbs = $formtaportedepartamental->suma_importermbs;?>
                                <?php $suma_aportemunicipalbs = $formtaportedepartamental->suma_aportemunicipalbs;?>
                                <?php $suma_aportedepartamentalbs = $formtaportedepartamental->suma_aportedepartamentalbs;?>
                            <?php endforeach ?>
                        <?php endif ?>
                        <table name="aportedepartamental" id="aportedepartamental" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
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
                                    <td style="text-align: center"><?php echo $formaportedepartamental->id;?></td>
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
                                    <td style="text-align: center"></td>
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
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="background:#007bb6">
                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $form->id;?>" class="btn-xs btn-success"><span class="fa fa-plus-square"></span></a><h3 class="box-title" style="color: white">  &nbsp; 8. APORTE INSTITUCIONALES</h3>
                    </div>
                    <div id="aporteinstitucional" class="box-body table-responsive no-padding">
                        <?php if(!empty($formm02totalimporte)):?>
                            <?php foreach($formm02totalimporte as $timporte): ?>
                                <?php $suma_importe = $timporte->suma_importe;?>
                            <?php endforeach ?>
                        <?php endif ?>   
                        <table name="aporteinstitucional" id="aporteinstitucional" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center">ID</th>
                                    <th style="text-align: center">ENTIDAD APORTE</th>
                                    <th style="text-align: center">TIPO BASE APORTE</th>
                                    <th style="text-align: center">BASE APORTE [Bs]</th>
                                    <th style="text-align: center">APORTE [%]</th>
                                    <th style="text-align: center">IMPORTE [Bs]</th>
                                    <th style="text-align: center">ENTIDAD FINANCIERA</th>
                                    <th style="text-align: center">NRO CUENTA</th>
                                    <th style="text-align: center">NRO DEPOSITO</th>
                                    <th style="text-align: center">FECHA DEPOSITO</th>
                                    <th style="text-align: center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($formm02aporte)):?>
                                <?php foreach($formm02aporte as $forma): ?>
                                <tr>
                                    <td style="text-align: center"><?php echo $forma->id;?></td>
                                    <td style="text-align: center"><?php echo $forma->entidad_aporte;?></td>
                                    <td style="text-align: center"><?php echo $forma->tipobaseaporte;?></td>
                                    <td style="text-align: center"><?php echo number_format($forma->valorbaseaportebs,2);?></td>
                                    <td style="text-align: center"><?php echo number_format($forma->porcentajeaporte,2);?></td>
                                    <td style="text-align: right"><?php echo  number_format($forma->importebs, 2);?></td>
                                    <td style="text-align: center"><?php echo $forma->entidad_financiera;?></td>
                                    <td style="text-align: center"><?php echo $forma->nrocuenta;?></td>
                                    <td style="text-align: center"><?php echo $forma->nrodeposito;?></td>
                                    <td style="text-align: center"><?php echo $forma->fechadeposito;?></td>
                                    <td style="text-align: center">
                                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $forma->id;?>" class="btn-xs btn-warning"><span class="fa fa-pencil"></span></a>
                                        <a href="<?php echo base_url()?>formulario_m02/C_formm02_declarados/edit/<?php echo $forma->id;?>" class="btn-xs btn-danger"><span class="fa fa-close"></span></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: right; background: #999">TOTALES</td>
                                    <td style="text-align: right; background: #999"><?php echo  number_format($suma_importe, 2);?></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                    <td style="text-align: center"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-2">
                <a href="<?php echo base_url()?>" class="btn btn-block btn-danger btn-lg"><span class="fa fa-close"></span> Salir</a>
            </div>
        </div>
    </section>
</div>
