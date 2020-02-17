<div class="main-content">
    <div class="main-content-inner">
        <div class="page-content">
            <div class="page-header">
                <h1>
                    BUSQUEDA APORTE EN M-03
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
                                <?php echo form_open('C_buscarDepositoM03/busqueda'); ?>
                                    <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteDepositoM03")) {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDepositoM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDepositoM03", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteDepositoM03")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Deposito: ', 'buscarAporteDepositoM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteDepositoM03", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteCuentaM03")) {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuentaM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuentaM03", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteCuentaM03")]);
                                            } else {
                                                echo form_label ('Ingrese un Nro. Cuenta: ', 'buscarAporteCuentaM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteCuentaM03", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteEntidadFinancieraM03")) {
                                                echo form_label ('Ingrese una Entidad Financiera: ', 'buscarAporteEntidadFinancieraM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteEntidadFinancieraM03", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteEntidadFinancieraM03")]);
                                            } else {
                                                echo form_label ('Ingrese una Entidad Financiera: ', 'buscarAporteEntidadFinancieraM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteEntidadFinancieraM03", "class" => "form-control", "placeholder" => ""]);
                                            } ?>	
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("buscarAporteEntidadAporteM03")) {
                                                echo form_label ('Ingrese una Entidad Aporte: ', 'buscarAporteEntidadAporteM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteEntidadAporteM03", "class" => "form-control", "placeholder" => "", "value" => $this->session->userdata("buscarAporteEntidadAporteM03")]);
                                            } else {
                                                echo form_label ('Ingrese una Entidad Aporte: ', 'buscarAporteEntidadAporteM03');
                                                echo form_input(["type" => "text", "name" => "buscarAporteEntidadAporteM03", "class" => "form-control", "placeholder" => ""]);
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
                                            <?php echo form_open('C_buscarDepositoM03/mostrar');?>
                                                <?php echo form_submit("", "Borrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                <?php
                                    $canM03 = $contaM03s;
                                ?>
                                M-03            Resultados Encontrados: <?php echo $canM03; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <!--<th style="text-align: center">No.</th>-->
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Estado Form.</th>
                                            <th style="text-align: center">Senarecom</th>
                                            <th style="text-align: center">Exportador</th>
                                            <th style="text-align: center">Comprador</th>
                                            <th style="text-align: center">Entidad Financiera</th>
                                            <th style="text-align: center">Entidad Aporte</th>
                                            <th style="text-align: center">Nro. Cuenta</th>
                                            <th style="text-align: center">Nro. Deposito</th>
                                            <th style="text-align: center">Importe Bs.</th>
                                            <th style="text-align: center">Fecha Deposito</th>
                                            <th style="text-align: center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <?php $iM03 = 0; ?>
                                    <tbody>
                                        <?php foreach ($depositoM03s as $recep) { ?>
                                            <tr>
                                                <!--<?php $iM03 = $iM03 + 1; ?>-->
                                                <!--<td style="text-align: center"><?php echo $iM03;?></td>-->
                                                <td style="text-align: center"><?php echo $recep->id;?></td>
                                                <td style="text-align: center"><?php echo $recep->estadoformulario;?></td>
                                                <td style="text-align: center"><?php echo $recep->oficinavalidacion;?></td>
                                                <td style="text-align: center"><?php echo $recep->exportador;?></td>
                                                <td style="text-align: center"><?php echo $recep->comprador;?></td>
                                                <td style="text-align: center"><?php echo $recep->entidadfinanciera;?></td>
                                                <td style="text-align: center"><?php echo $recep->entidadaporte;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrocuenta;?></td>
                                                <td style="text-align: center"><?php echo $recep->nrodeposito;?></td>
                                                <td style="text-align: right"><?php echo number_format($recep->importebs,2);?></td>
                                                <td style="text-align: center"><?php echo $recep->fechadeposito;?></td>
                                                <td style="text-align: center">
                                                    <a href="<?php echo base_url()?>C_buscarDeposito/verM03/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-primary">ver</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>