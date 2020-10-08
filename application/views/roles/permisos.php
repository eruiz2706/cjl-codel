<?php if(isset($errormsj))echo $errormsj; ?>

<!-- box -->
<form id="forma" action="<?php echo base_url();?>index.php/roles/savepermi" method="post">
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title pull-left">
            <?=$rol->alias;?>
            <input type="hidden" id="id" name="id" value="<?=$rol->id;?>"></input>
            <div id="precargmodal"></div>
        </h3>
        <div class="pull-right box-tools">
            <button id="btn_upd" type="button" class="btn btn-primary btn-sm pull-left">Actualizar</button>
        </div>
    </div>
    <!-- /box-header -->
    <!-- box-body -->
    <div class="box-body table-responsive ">
        <table id="tresultados" class="table table-bordered table-hover">
            <thead>
                <tr>
                  <th>Modulo</th>
                  <th>Pantalla</th>
                  <th>Acceso</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($permimod)){ ?>
                <?php foreach($permimod as $permi){ ?>
                    <tr class="info">
                        <td><?=$permi->nombre;?></td>
                        <td></td>
                        <td><input id="P<?=$permi->id;?>" name="P<?=$permi->id;?>" type="checkbox" value="A" <?=$permi->acceso;?>></td>
                    </tr>
                    <?php if(isset($subpermisos)){?>
                    <?php foreach($subpermisos as $superm){ ?>
                        <?php if($permi->id==$superm->padre){ ?>
                            <tr>
                            <td></td>
                            <td><?=$superm->nombre;?></td>
                            <td><input id="P<?=$superm->id;?>" name="P<?=$superm->id;?>" type="checkbox" value="A" <?=$superm->acceso;?>></td>
                            </tr>
                        <?php }?>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Modulo</th>
                    <th>Pantalla</th>
                    <th>Acceso</th>
                </tr>
                </tfoot>
        </table>
    </div>
    <!-- /box-body -->
</div>
<!-- /box -->
</form>      

<script>
    $("#btn_upd").click(function(){
        $.ajax({
            url : $('#forma').attr('action'),
            type : 'POST',
            data : $("#forma").serialize(),
            dataType : 'json',
            success : function(json) {
                alert('se actualizo correctamente');
                cargarCapa(base_url+'index.php/roles');
            },beforeSend: function(){
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                alert('hubo un inconveniente al intentar enviar la peticion');
                cargarCapa(base_url+'index.php/roles');
            },complete : function(xhr, status) {
            }
        });
    });

</script>