<?php if(isset($errormsj))echo $errormsj; ?>

<div class="modal fade" id="modal-default" rol="dialog">
<form id="forma" action="#" method="post">
    <div class="modal-dialog modal-lg">
    <div class="modal-content ">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 id="titlemodal" class="modal-title"></h4>
        </div>
        <div class="modal-body ">
            <div id="errormodal"></div>
            <div id="precargmodal"></div>
            <div class="box-body">
                <div class="form-group col-md-6">
                    <label>Usuario <font color="red">*</font></label>
                    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                </div>
                
                
                
                <div class="form-group col-md-6">
                    <label>Nombre Usuario <font color="red">*</font></label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Usuario">
                </div>
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group col-md-6">
                    <label>Re-Password</label>
                    <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Password">
                </div>
               
                <div class="form-group col-md-6">
                    <label>Rol <font color="red">*</font></label>
                    <select class="form-control select2" style="width: 100%;" id="idrol" name="idrol" <?=$disabled?>>
                        <option selected="selected" value=''> - </option>
                        <?php foreach($resultado2 as $res){ ?>
                            <option value="<?=$res->id;?>"><?=$res->nombre;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Estado</label>
                    <select class="form-control" id="estado" name="estado" <?=$disabled?>>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

            </div>
            
        </div>
        <div class="modal-footer">
            <button id="btn_modal" type="button" class="btn btn-primary pull-left"></button>
            <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
            <input type="hidden" id="id" name="id" class="form-control">
            <div id="mrefresh" style="display:none"></div>
        </div>
    </div>
    <!-- /modal-content -->
    </div>
    <!-- /modal-dialog -->
</form>
</div>
<!-- /modal -->



<!--<div class="row">
<div class="col-md-2">
    <button id="btn_nuevo" type="submit" class="btn btn-primary btn-block btn-flat">Nuevo Registro</button>
    <br>
</div>
</div>-->

<!-- box -->
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title">Busqueda</h3>
    </div>
    <!-- /box-header -->
<!-- box-body -->
    <div class="box-body table-responsive ">
        <table id="tresultados" class="table table-bordered table-hover">
            <thead>
                <tr>
                  <th>Id</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Password</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($resultado)){ ?>
                <?php foreach($resultado as $res){ ?>
                    <tr>
                        <td><?=$res->id;?></td>
                        <td><?=$res->usuario;?></td>
                        <td><?=$res->nombre;?></td>
                        <td>**********</td>
                        <td><?=$res->namerol;?></td>
                        <?php if ($res->estado == 1){?>
                            <td>Activo</td>
                        <?php }else{ ?>
                             <td>Inactivo</td>
                        <?php } ?>
                        <td><a class='btn btn-primary btn-xs' href="#" onclick="openModal(<?=$res->id;?>);"><i class='fa fa-pencil'></i> Editar</a></a></td>    
                    </tr>
                <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Password</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
                </tfoot>
        </table>
    </div>
    <!-- /box-body -->
</div>
<!-- /box -->
   
          

<script>


$(document).ready(function(){
    
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $("#btn_nuevo").click(function(){
        var base_url = '<?php echo base_url();?>index.php/usuarios/save';

        $("#titlemodal").html("Nuevo Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Guardar");
        $('#modal-default').modal('show');

        $("#usuario").prop('disabled',false);
        $("#documento").prop('disabled',false);
    });

    /*guardar y actualizar*/
    $("#btn_modal").click(function(){
        $.ajax({
            url : $('#forma').attr('action'),
            type : 'POST',
            data : $("#forma").serialize(),
            dataType : 'json',
            success : function(json) {
                if(json.errormsj){
                    $("#errormodal").html(json.errormsj);
                }
                if(json.successmsj){
                    if($("#id").val()=='')$('#forma').trigger("reset");
                    $('#mrefresh').html("1");
                    $("#errormodal").html(json.successmsj);
                }
            },beforeSend: function(){
                $("#btn_modal").attr("disabled", true);
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $("#btn_modal").removeAttr("disabled");
                $("#precargmodal").html("");
                 alert('hubo un inconveniente al intentar enviar la peticion');
            },complete : function(xhr, status) {
                $("#btn_modal").removeAttr("disabled");
                $("#precargmodal").html("");
            }
        });
    });

    /*evento al  cerrar modal*/
    $("#modal-default").on("hidden.bs.modal", function () {
        if($('#mrefresh').html()=='1'){
            cargarCapa(base_url+'index.php/usuarios');
        }
    });

});

    function openModal(id){
        var base_url = '<?php echo base_url();?>index.php/usuarios/update';
        $("#titlemodal").html("Editar Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Actualizar");
        $('#modal-default').modal('show');

        $.ajax({
            url : '<?php echo base_url();?>index.php/usuarios/edit/'+id,
            
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                if(json != null){
                    $("#id").val(json.id);
                    $("#usuario").val(json.usuario);
                    $("#nombre").val(json.nombre);
                    $('#idrol').select2().val(json.idrol).trigger('change');
                    $("#estado").val(json.estado);
                    $("#usuario").prop('disabled',true);
                }
            },beforeSend: function(){
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $("#precargmodal").html("");
                $('#modal-default').modal('hide');
                alert('hubo un inconveniente al intentar enviar la peticion');
            },
            complete : function(xhr, status) {
                $("#precargmodal").html("");
            }
        });

      
    }

    $(function () {
        $('.select2').select2();

        $('#tresultados').DataTable({
        'paging'      : true,
        'lengthChange': true,
        "pageLength"  : 25,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar: ",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });
    });

    

</script>