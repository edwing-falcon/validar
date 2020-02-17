<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">ID M03</th>
                <th style="text-align: center">ID M02</th>
                <th style="text-align: center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($relacionadors)):?>
            <?php foreach ($relacionadors as $recep) { ?>
                <tr>
                    <td style="text-align: center"><?php  echo $recep->id;?></td>
                    <td style="text-align: center"><?php  echo $recep->idformm03;?></td>
                    <td style="text-align: center"><?php  echo $recep->idformm02;?></td>
                    <td>
                        <!--<a href="<?php echo base_url()?>C_recepcion3/eliminarFormm03/<?php echo $this->Formm03_model->encriptar($recep->id);?>" class="btn-xs btn-success">Eliminar</a>-->
                        <!--<a href="#" data-toggle="modal" data-target="#relacionadorm03m02" class="btn btn-primary btn-block" onclick="carga_tabla(<?php echo $id;?>, 'modal')">Eliminar</a>-->
                        <a href="#" class="btn-xs btn-success" onclick="carga_tabla(<?php echo $recep->id;?>)">Eliminar</a>
                    </td>    
                </tr>
            <?php } ?>
            <?php endif ?>    
        </tbody>
    </table>
</div>

<script type="text/javascript">
    function carga_tabla(id){
        $('#tabla').load('<?php echo base_url(); ?>C_recepcion3/relacionadorM03M02_1/'+id);
        //$('#tabla').load('http://192.168.242.106/validador/C_rechazado3/bitacora3/'+id);
    }
</script>