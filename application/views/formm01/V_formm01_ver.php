<?php 
    $id = $ids;
?>	

<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    FORMULARIO M-01
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        ID: <?php echo $id?>
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
                            <div class="table-header"> 1. DATOS DE LA PERSONA NATURAL O JURIDICA</div>
                            <div>
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NRO NIM</th>
                                            <th style="text-align: center">RAZON SOCIAL</th>
                                            <th style="text-align: center">ACTOR PRODUCTIVO</th>
                                        </tr>
                                        <tbody>
                                            <?php if(!empty($datospersonales)):?>
                                                <?php foreach($datospersonales as $dato): ?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $dato->nim?></td>
                                                    <td style="text-align: center"><?php echo $dato->razonsocial;?></td>
                                                    <td style="text-align: center"><?php echo $dato->actorproductivo;?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </thead>
                                </table>
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NRO. NIT</th>
                                            <th style="text-align: center">NRO. FUNDA EMPRESA</th>
                                            <th style="text-align: center">NRO. RUEX</th>
                                            <th style="text-align: center">NRO. D.G. COOPERATIVA</th>
                                            <th style="text-align: center">RESOLUCION ADMINISTRAIVA</th>
                                            <th style="text-align: center">FECHA DE RESOLUCION</th>
                                            <th style="text-align: center">NRO. SOCIOS</th>
                                        </tr>
                                        <tbody>
                                            <?php if(!empty($datospersonales)):?>
                                                <?php foreach($datospersonales as $dato): ?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $dato->ci_nit?></td>
                                                    <td style="text-align: center"><?php echo $dato->nro_fundempresa;?></td>
                                                    <td style="text-align: center"><?php echo $dato->nro_ruex;?></td>
                                                    <td style="text-align: center"><?php echo $dato->nrodrcooperativa;?></td>
                                                    <td style="text-align: center"><?php echo $dato->resolucionconsejo;?></td>
                                                    <td style="text-align: center"><?php echo $dato->fechaconsejo;?></td>
                                                    <td style="text-align: center"><?php echo $dato->nrosocio;?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </thead>
                                </table>
                            </div>
                            <div class="table-header"> 2. DATOS DE REFERENCIA DE OFICINA CENTRAL</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">DEPARTAMENTO</th>
                                            <th style="text-align: center">MUNICIPIO</th>
                                            <th style="text-align: center">DIRECCION</th>
                                            <th style="text-align: center">TELEFONO</th>
                                            <th style="text-align: center">FAX</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php if(!empty($datospersonales)):?>
                                                <?php foreach($datospersonales as $dato): ?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $dato->departamento;?></td>
                                                    <td style="text-align: center"><?php echo $dato->municipio;?></td>
                                                    <td style="text-align: center"><?php echo $dato->direccion;?></td>
                                                    <td style="text-align: center"><?php echo $dato->telefono;?></td>
                                                    <td style="text-align: center"><?php echo $dato->fax;?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 3. ACTIVIDADES MINERAS</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ACTIVIDAD</th>
                                            <th style="text-align: center">DEPARTAMENTO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php if(!empty($actividadesmineras)):?>
                                                <?php foreach($actividadesmineras as $dato): ?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $dato->actividad;?></td>
                                                    <td style="text-align: center"><?php echo $dato->departamento;?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 4. MINERALES</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">MINERALES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php if(!empty($minerales)):?>
                                                <?php foreach($minerales as $dato): ?>
                                                <tr>
                                                    <td style="text-align: center"><?php echo $dato->minerales;?></td>
                                                </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 5. CONCESIONES MINERAS</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NOMBRE DE CONCESION</th>
                                            <th style="text-align: center">RESOLUCION</th>
                                            <th style="text-align: center">FECHA DE CONCESION</th>
                                            <th style="text-align: center">NRO. CUADRICULAS</th>
                                            <th style="text-align: center">NRO. PERTENENCIA</th>
                                            <th style="text-align: center">CODIGO MUNICIPIO</th>
                                            <th style="text-align: center">MUNICIPIO</th>
                                            <th style="text-align: center">DEPARTAMENTO</th>
                                            <th style="text-align: center">OBS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($concesionesmineras)):?>
                                            <?php foreach($concesionesmineras as $dato): ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $dato->nombre;?></td>
                                                <td style="text-align: center"><?php echo $dato->nroresolucion;?></td>
                                                <td style="text-align: center"><?php echo $dato->fechaconcesion;?></td>
                                                <td style="text-align: center"><?php echo $dato->cuadriculas;?></td>
                                                <td style="text-align: center"><?php echo $dato->pertenencia;?></td>
                                                <td style="text-align: center"><?php echo $dato->codigo;?></td>
                                                <td style="text-align: center"><?php echo $dato->municipio;?></td>
                                                <td style="text-align: center"><?php echo $dato->departamento;?></td>
                                                <td style="text-align: center"><?php echo $dato->obs;?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 6. CONTRATOS MINEROS</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">TITULAR</th>
                                            <th style="text-align: center">NRO. TESTIMONIO</th>
                                            <th style="text-align: center">FECHA DE CONTRATO</th>
                                            <th style="text-align: center">PLAZO (A&Ntilde;OS)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($contactosmineros)):?>
                                            <?php foreach($contactosmineros as $dato): ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $dato->titular;?></td>
                                                <td style="text-align: center"><?php echo $dato->nrotestimonio;?></td>
                                                <td style="text-align: center"><?php echo $dato->fechacontrato;?></td>
                                                <td style="text-align: center"><?php echo $dato->plazo_anios;?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 7. REPRESENTANTE LEGAL</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NOMBRE</th>
                                            <th style="text-align: center">APELLIDO PATERNO</th>
                                            <th style="text-align: center">APELLIDO MATERNO</th>
                                            <th style="text-align: center">TIPO DE DOCUMENTO</th>
                                            <th style="text-align: center">DOCUMENTO</th>
                                            <th style="text-align: center">TELEFONO</th>
                                            <th style="text-align: center">CELULAR</th>
                                            <th style="text-align: center">CORREO ELECTRONICO</th>
                                            <th style="text-align: center">CARGO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($representanteslegales)):?>
                                            <?php foreach($representanteslegales as $dato): ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $dato->nombres;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidopaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidomaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->codtipodocid;?></td>
                                                <td style="text-align: center"><?php echo $dato->docu;?></td>
                                                <td style="text-align: center"><?php echo $dato->telefono;?></td>
                                                <td style="text-align: center"><?php echo $dato->celular;?></td>
                                                <td style="text-align: center"><?php echo $dato->correoelectronico;?></td>
                                                <td style="text-align: center"><?php echo $dato->cargo;?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 8. HABILITACION DE REPRESENTANTE LEGAL</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NOMBRE</th>
                                            <th style="text-align: center">APELLIDO PATERNO</th>
                                            <th style="text-align: center">APELLIDO MATERNO</th>
                                            <th style="text-align: center">TIPO DE DOCUMENTO</th>
                                            <th style="text-align: center">DOCUMENTO</th>
                                            <th style="text-align: center">TELEFONO</th>
                                            <th style="text-align: center">CELULAR</th>
                                            <th style="text-align: center">CORREO ELECTRONICO</th>
                                            <th style="text-align: center">CARGO</th>
                                            <th style="text-align: center">CODIGO USUARIO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($habilitacionusuario)):?>
                                            <?php foreach($habilitacionusuario as $dato): ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $dato->nombres;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidopaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidomaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->codtipodocid;?></td>
                                                <td style="text-align: center"><?php echo $dato->docu;?></td>
                                                <td style="text-align: center"><?php echo $dato->telefono;?></td>
                                                <td style="text-align: center"><?php echo $dato->celular;?></td>
                                                <td style="text-align: center"><?php echo $dato->correoelectronico;?></td>
                                                <td style="text-align: center"><?php echo $dato->cargo;?></td>
                                                <td style="text-align: center"><?php echo $dato->nim;?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-header"> 9. CONTACTOS (FIRMAS AUTORIZADAS)</div>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">NOMBRE</th>
                                            <th style="text-align: center">APELLIDO PATERNO</th>
                                            <th style="text-align: center">APELLIDO MATERNO</th>
                                            <th style="text-align: center">TIPO DE DOCUMENTO</th>
                                            <th style="text-align: center">DOCUMENTO</th>
                                            <th style="text-align: center">TELEFONO</th>
                                            <th style="text-align: center">CELULAR</th>
                                            <th style="text-align: center">CORREO ELECTRONICO</th>
                                            <th style="text-align: center">CARGO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($contactos)):?>
                                            <?php foreach($contactos as $dato): ?>
                                            <tr>
                                                <td style="text-align: center"><?php echo $dato->nombres;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidopaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->apellidomaterno;?></td>
                                                <td style="text-align: center"><?php echo $dato->codtipodocid;?></td>
                                                <td style="text-align: center"><?php echo $dato->nrodocid;?></td>
                                                <td style="text-align: center"><?php echo $dato->telefono;?></td>
                                                <td style="text-align: center"><?php echo $dato->celular;?></td>
                                                <td style="text-align: center"><?php echo $dato->correoelectronico;?></td>
                                                <td style="text-align: center"><?php echo $dato->cargo;?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/><br/><br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
