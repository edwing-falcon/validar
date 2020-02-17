<?php 
    $lugar = $this->session->userdata("lugar");
    $cantidad = $contas;
?>

<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    BUSQUEDA APORTE EN M-01, M-02 y M-03
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DEPATAMENTAL: <?php echo $lugar; ?>
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_buscarDeposito/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteDeposito")) {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDeposito');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDeposito", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteDeposito")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDeposito');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDeposito", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteCuenta")) {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuenta');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuenta", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteCuenta")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuenta');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuenta", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php echo form_label ('Seleccionar Entidad Financiera: ', 'buscarAporteEntidadFinanciera'); ?>
                                            <select id="buscarAporteEntidadFinanciera" name="buscarAporteEntidadFinanciera" style="width: 230px; height: 35px;" >
                                                <?php 
                                                    $entidadFinanciera = ""; 
                                                    if ($this->session->userdata("buscarAporteEntidadFinanciera")) { $entidadFinanciera = $this->session->userdata("buscarAporteEntidadFinanciera"); }
                                                ?>
                                                <option value="">TODAS LAS ENTIDADES FINANCIERAS</option>
                                                <?php foreach($entidadesfinancieras as $registro): ?>
                                                    <?php if($registro->id == $entidadFinanciera):?>
                                                        <option selected value="<?php echo $registro->id; ?>"><?php echo $registro->entidadfinanciera; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $registro->id; ?>"><?php echo $registro->entidadfinanciera; ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php echo form_label ('Seleccionar Entidad Aporte: ', 'buscarAporteEntidadAporte'); ?>
                                            <select id="buscarAporteEntidadAporte" name="buscarAporteEntidadAporte" style="width: 230px; height: 35px;" >
                                                <?php 
                                                    $entidadAporte = ""; 
                                                    if ($this->session->userdata("buscarAporteEntidadAporte")) { $entidadAporte = $this->session->userdata("buscarAporteEntidadAporte"); }
                                                ?>
                                                <option value="">TODAS LAS ENTIDADES APORTE</option>
                                                <?php foreach($aportes as $registro): ?>
                                                    <?php if($registro->id == $entidadAporte):?>
                                                        <option selected value="<?php echo $registro->id; ?>"><?php echo $registro->entidadaporte; ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo $registro->id; ?>"><?php echo $registro->entidadaporte; ?></option>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <div class="col-xs-2">
                                            <?php echo form_submit("", "Buscar", "class='btn btn-primary btn-sm'");?>
                                        </div>
                                <?php echo form_close(); ?>
                                        <div class="col-xs-2">
                                            <?php echo form_open('C_buscarDeposito/mostrar');?>
                                                <?php echo form_submit("", "Borrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                Resultados Encontrados: <?php echo $cantidad; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">No.</th>
                                            <th style="text-align: center">Formulario</th>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Estado Form.</th>
                                            <th style="text-align: center">Razon Social</th>
                                            <th style="text-align: center">Entidad Financiera</th>
                                            <th style="text-align: center">Fecha deposito</th>
                                            <th style="text-align: center">Nro. Cuenta</th>
                                            <th style="text-align: center">Nro. Deposito</th>
                                            <th style="text-align: center">Importe Bs.</th>
                                            <th style="text-align: center">Entidad Aporte</th>
                                            <th style="text-align: center">Concepto Pago</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; ?>
                                    <tbody>
                                        <?php foreach ($depositos as $recep) { ?>
                                            <tr>
                                                <?php $i = $i + 1; ?>
                                                <td style="text-align: center"><?php echo $i;?></td>
                                                <td style="text-align: center"><?php echo $recep->formulario;?></td>
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->estadoformulario;?></td>
                                                <td style="text-align: left"><?php echo $recep->operador;?></td>
                                                <td style="text-align: center"><?php echo $recep->entidadfinanciera;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechadeposito;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrocuenta;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrodeposito;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->importebs,2);?></td>
                                                <td style="text-align: left"><?php echo $recep->entidadaporte;?></td>
                                                <td style="text-align: left"><?php echo $recep->conceptopago;?></td>
                                                <td style="text-align: center">
                                                    <?php if($recep->formulario == "M-01"): ?>
                                                        <a href="<?php echo base_url()?>C_buscarDeposito/verM01/<?php echo $this->Formm01_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if($recep->formulario == "M-02"): ?>
                                                        <a href="<?php echo base_url()?>C_buscarDeposito/verM02/<?php echo $this->Formm02_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                    <?php endif; ?>
                                                        
                                                    <?php if($recep->formulario == "M-03"): ?>
                                                        <a href="<?php echo base_url()?>C_buscarDeposito/verM03/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                            <?php if( $this->session->userdata("error") ):?>
                                <div class="alert alert-danger">
                                    <p><?php  echo $this->session->userdata("error");?></p>
                                </div>
                                <?php $this->session->unset_userdata('error'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>