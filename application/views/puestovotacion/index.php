<?php if(isset($errormsj))echo $errormsj; ?>

<div class="modal fade" id="modal-default" rol="dialog">
<form id="forma" action="#" method="post">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 id="titlemodal" class="modal-title"></h4>
        </div>
        <div class="modal-body">
            <div id="errormodal"></div>
            <div id="precargmodal"></div>
            <div class="box-body">

                <div class="form-group col-md-6">
                    <label>Departamento<font color="red">*</font></label>
                    <select class="form-control select2" style="width: 100%;" name="iddepartamento" id="iddepartamento">
                        <option value=''> - </option>
                        <?php foreach($departamen as $resdep){ ?>
                            <option value="<?=$resdep->id?>"><?=$resdep->nombre;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Municipio<font color="red">*</font></label>
                    <select class="form-control select2"  style="width: 100%;" name="idmunicipio" id="idmunicipio">
                        <option value=''> - </option>
                        <?php foreach($municipio as $resdep){ ?>
                            <option value="<?=$resdep->id?>"><?=$resdep->nombre;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Puesto<font color="red">*</font></label>
                    <input type="text" id="puesto" name="puesto" class="form-control" placeholder="Puesto">
                </div>
                <div class="form-group col-md-6">
                    <label>Direccion<font color="red">*</font></label>
                    <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Direccion">
                </div>
                  <div class="form-group col-md-6">
                    <label>Est. Personas<font color="red">*</font></label>
                    <input type="number" id="estpersona" name="estpersona" class="form-control" placeholder="Estimado Personas">
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

<!-- box -->
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title">Busqueda</h3>
        <div class="pull-right box-tools">
            <button id="btn_nuevo" type="button" class="btn btn-primary  btn-sm pull-left"><i class="fa fa-plus"></i> Nuevo</button>
        </div>
    </div>
    <!-- /box-header -->
    <!-- box-body -->
    <div class="box-body table-responsive ">
        <table id="tresultados" class="table table-bordered table-hover">
            <thead>
                <tr>
                  <th>Id</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Puesto</th>
                  <th>Direccion</th>
                  <th>Est. Personas</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($resultado)){ ?>
                <?php foreach($resultado as $res){ ?>
                    <tr>
                        <td><?=$res->id;?></td>
                        <td><?=$res->departa;?></td>
                        <td><?=$res->municip;?></td>
                        <td><?=$res->puesto;?></td>
                        <td><?=$res->direccion;?></td>
                        <td><?=$res->estpersona;?></td>
                        <td><a class='btn btn-primary btn-xs' href="#" onclick="openModal(<?=$res->id;?>);"><i class='fa fa-pencil'></i> Editar</a></td>    
                    </tr>
                <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Puesto</th>
                  <th>Direccion</th>
                  <th>Est. Personas</th>
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

    $( "#iddepartamento" ).change(function() {
        $.ajax({
            url : '<?php echo base_url();?>index.php/puestovotacion/getdepartamentos/'+$( "#iddepartamento" ).val(),
            async:false, 
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                //console.log(json);

                $("#idmunicipio").empty();
                if(json != null){
                    $("#idmunicipio").append('<option value=""> - </option>');
                    $.each(json, function (index, value) {
                        $("#idmunicipio").append('<option value="'+value.id+'">'+value.nombre+'</option>');
                    });
                }
            },beforeSend: function(){
                $("#idmunicipio").empty();
                $("#idmunicipio").append('<option value="">cargando....</option>');
            },
            error : function(xhr, status) {
                alert('Hubo un inconveniente al intentar cargar los municipios');
            },
            complete : function(xhr, status) {
                //$("#precargmodal").html("");
            }
        });
       
    });

    $("#btn_nuevo").click(function(){
        var base_url = '<?php echo base_url();?>index.php/puestovotacion/save';

        $("#titlemodal").html("Nuevo Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $('#iddepartamento').select2().val('').trigger('change');
        $('#idmunicipio').select2().val('').trigger('change');
        $("#forma").attr('action',base_url);

       // $("#codigo").prop("disabled",false);
        $('#btn_modal').html("Guardar");
        $('#modal-default').modal('show');
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
                    if($("#id").val()==''){
                        $('#iddepartamento').select2().val('').trigger('change');
                        $('#forma').trigger("reset");
                    }
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
            cargarCapa(base_url+'index.php/puestovotacion');
        }
    });

});

    function openModal(id){
        var base_url = '<?php echo base_url();?>index.php/puestovotacion/update';
        $("#titlemodal").html("Editar Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Actualizar");
        $('#modal-default').modal('show');

        $.ajax({
            url : '<?php echo base_url();?>index.php/puestovotacion/edit/'+id,
            
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                if(json != null){
                    $("#id").val(json.id);
                    $("#puesto").val(json.puesto);
                    $("#direccion").val(json.direccion);
                    $('#iddepartamento').select2().val(json.iddepartamento).trigger('change');
                    $("#estpersona").val(json.estpersona);
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
                var json=$.parseJSON(xhr.responseText);
                if(json != null){
                    $('#idmunicipio').select2().val(json.idmunicipio).trigger('change');
                }
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