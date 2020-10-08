

<form id="forma" action="<?=base_url()?>index.php/clave/update" method="post">
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title"><small>Los campos marcados con <font color='red'>*</font> son requeridos</small></h3>
    </div>
    <div class="box-body">
        <div id="errormodal"></div>
        <div id="precargmodal"></div>
        
        <div class="form-group col-md-6">
            <label>Usuario</label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" disabled value="<?=$username;?>">
        </div>
        <div class="form-group col-md-6">
            <label>Nombre Usuario <font color="red">*</font></label>
            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre Usuario" value="<?=$nombre;?>">
        </div>
        <div class="form-group col-md-6">
            <label>Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group col-md-6">
            <label>Re-Password</label>
            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Password">
        </div>
    </div>

    <div class="box-footer">
        <button id="btn_modal" type="button" class="btn btn-primary pull-left">Guardar</button>
    </div>
</div>
</form>

<script>


$(document).ready(function(){

    /*guardar y actualizar*/
    $("#btn_modal").click(function(){
        $.ajax({
            url : $('#forma').attr('action'),
            type : 'POST',
            data : $("#forma").serialize(),
            dataType : 'json',
            success : function(json) {
                $('#precargmodal').html("");
                $("#errormodal").html("");

                if(json.errormsj){
                    $("#errormodal").html(json.errormsj);
                }
                if(json.successmsj){
                    $('#precargmodal').html("");
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
});
</script>