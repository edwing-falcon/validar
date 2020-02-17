<div class="main-content"> 
    <div class="main-content-inner">
        <div class="page-content">
           <div class="page-header">
                <h1>
                    LISTADO
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Municipio
                    </small>
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5 class="header green">B&uacutesqueda:</h5>
                            <div class="row">
                                <?php echo form_open('C_municipio/busqueda'); ?>
                                <div class="col-xs-1"></div>
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("idMunicipio")) {
                                                echo form_label ('ID: ', 'idMunicipio');
                                                echo form_input(["type" => "text", "name" => "idMunicipio", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("idMunicipio")]);
                                            } else {
                                                echo form_label ('ID: ', 'idMunicipio');
                                                echo form_input(["type" => "text", "name" => "idMunicipio", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("codigoMunicipio")) {
                                                echo form_label ('Codigo: ', 'codigoMunicipio');
                                                echo form_input(["type" => "text", "name" => "codigoMunicipio", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("codigoMunicipio")]);
                                            } else {
                                                echo form_label ('Codigo: ', 'codigoMunicipio');
                                                echo form_input(["type" => "text", "name" => "codigoMunicipio", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("municipioMunicipio")) {
                                                echo form_label ('Municipio: ', 'municipioMunicipio');
                                                echo form_input(["type" => "text", "name" => "municipioMunicipio", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("municipioMunicipio")]);
                                            } else {
                                                echo form_label ('Municipio: ', 'municipioMunicipio');
                                                echo form_input(["type" => "text", "name" => "municipioMunicipio", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("provinciaMunicipio")) {
                                                echo form_label ('Provincia: ', 'provinciaMunicipio');
                                                echo form_input(["type" => "text", "name" => "provinciaMunicipio", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("provinciaMunicipio")]);
                                            } else {
                                                echo form_label ('Provincia: ', 'provinciaMunicipio');
                                                echo form_input(["type" => "text", "name" => "provinciaMunicipio", "class" => "form-control search-query", "placeholder" => ""]); 
                                            } ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <div class="input-group">
                                            <?php if ($this->session->userdata("departamentoMunicipio")) {
                                                echo form_label ('Departamento: ', 'departamentoMunicipio');
                                                echo form_input(["type" => "text", "name" => "departamentoMunicipio", "class" => "form-control search-query", "placeholder" => "", "value" => $this->session->userdata("departamentoMunicipio")]);
                                            } else {
                                                echo form_label ('Departamento: ', 'departamentoMunicipio');
                                                echo form_input(["type" => "text", "name" => "departamentoMunicipio", "class" => "form-control search-query", "placeholder" => ""]); 
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
                                            <?php echo form_open('C_municipio/mostrar');?>
                                                <?php echo form_submit("", "Mostrar Todo", "class= 'btn btn-danger btn-sm'");?>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-header">
                                <?php
                                    $can1 = $cants;
                                ?>
                                Resultados Encontrados: <?php echo $can1; ?> 
                            </div>
                            <br/>
                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">ID</th>
                                            <th style="text-align: center">Codigo</th>
                                            <th style="text-align: center">Municipio</th>
                                            <th style="text-align: center">Provincia</th>
                                            <th style="text-align: center">Departamento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($municipios as $recep) { ?>
                                            <tr>
                                                <td style="text-align: left"><?php echo $recep->id;?></td>
                                                <td style="text-align: left"><?php echo $recep->codigo;?></td>
                                                <td style="text-align: left"><?php echo $recep->municipio;?></td>
                                                <td style="text-align: left"><?php echo $recep->provincia;?></td>
                                                <td style="text-align: left"><?php echo $recep->departamento;?></td>
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
