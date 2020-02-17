<div class="row">
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
