<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    BUSQUEDA APORTE EN M-01
                    <!--<small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        DEPATAMENTAL: <?php echo $lugar; ?>
                    </small>-->
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_buscarDepositoM01/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteDepositoM01")) {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDepositoM01');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDepositoM01", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteDepositoM01")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDepositoM01');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDepositoM01", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteCuentaM01")) {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuentaM01');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuentaM01", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteCuentaM01")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuentaM01');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuentaM01", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteConceptoPagoM01")) {
                                                echo form_label ('Concepto de Pago: ', 'buscarAporteConceptoPagoM01');
                                                echo form_input(["type" => "text", "name" => "buscarAporteConceptoPagoM01", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteConceptoPagoM01")]);
                                            } else {
                                                echo form_label ('Concepto de Pago: ', 'buscarEntidadFinanciera');
                                                echo form_input(["type" => "text", "name" => "buscarAporteConceptoPagoM01", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
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
                                            <?php echo form_open('C_buscarDepositoM01/mostrar');?>
                                                <?php echo form_submit("", "Borrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                <?php
                                    $canM01 = $contaM01s;
                                ?>
                                M-01            Resultados Encontrados: <?php echo $canM01; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <!--<th style="text-align: center">No.</th>-->
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">NIM</th>
                                            <th style="text-align: center">Operador</th>
                                            <th style="text-align: center">Entidad Financiera</th>
                                            <th style="text-align: center">Nro. Cuenta</th>
                                            <th style="text-align: center">Nro. Deposito</th>
                                            <th style="text-align: center">Fecha Deposito</th>
                                            <th style="text-align: center">Importe Bs.</th>
                                            <th style="text-align: center">Concepto</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php $iM01 = 0; ?>
                                    <tbody>
                                        <?php foreach ($depositoM01s as $recep) { ?>
                                            <tr>
                                                <!--<?php $iM01 = $iM01 + 1; ?>
                                                <td style="text-align: center"><?php echo $iM01;?></td>-->
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->nim;?></td>
                                                <td style="text-align: left"><?php echo $recep->nombre;?></td>
                                                <td style="text-align: left"><?php echo $recep->entidadfinanciera;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrocuenta;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrodeposito;?></td>
                                                <td style="text-align: center"><?php echo $recep->fechadeposito;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->montobs,2);?></td>
                                                <td style="text-align: left"><?php echo $recep->conceptopago;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_buscarDepositoM01/verM01/<?php echo $this->Formm01_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>