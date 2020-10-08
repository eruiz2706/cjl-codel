<?php if(isset($errormsj))echo $errormsj; ?>


<form id="forma" action="<?=base_url()?>index.php/msjemail/save" method="post">
<!-- box -->
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title">Nuevo Mensaje</h3>
    </div>
    <!-- /box-header -->
    <!-- box-body -->
    <div class="box-body">
        <div id="errormodal"></div>
        <div id="precargmodal"></div>
        <div class="box-body">
            <div class="form-group col-md-6">
                <label>Para Categoria</label>
                <select class="form-control select2" style="width: 100%;" name="idcatego" id="idcatego">
                <option value=''> - </option>
                <?php if(isset($rescatego)){ ?>
                    <?php foreach($rescatego as $rescat){ ?>
                        <option value="<?=$rescat->id;?>"><?=$rescat->nombre?></option>
                    <?php } ?>
                <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Para Subcategoria<font color="red">*</font></label>
                <select class="form-control select2" style="width: 100%;" name="idsubcatego" id="idsubcatego">
                    <option value=''> - </option>
                    <?php if(isset($ressubcatego)){ ?>
                        <?php foreach($ressubcatego as $ressubcat){ ?>
                            <option value="<?=$ressubcat->id;?>"><?=$ressubcat->nombre?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>    

            <div class="form-group col-md-12">
                <label>Asunto<font color="red">*</font></label>
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group col-md-12">
                <label>Mensaje<font color="red">*</font></label>
                <textarea name="mensaje" id="mensaje" class="form-control" style="height: 300px" form="forma">
                    
                </textarea>
            </div>
        </div>
    </div>
    <!-- /box-body -->

    <div class="modal-footer">
        <button id="btn_modal" type="submit" class="btn btn-primary pull-left ">Enviar</button>
    </div>

</div>
<!-- /box -->
</form>
          

<script>
$(document).ready(function(){
    $('.select2').select2();

    $( "#idcatego" ).change(function() {
        $.ajax({
            url : '<?php echo base_url();?>index.php/subcategorias/getdecatego/'+$( "#idcatego" ).val(),
            async:true, 
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                //console.log(json);

                $("#idsubcatego").empty();
                if(json != null){
                    $("#idsubcatego").append('<option value=""> - </option>');
                    $.each(json, function (index, value) {
                        $("#idsubcatego").append('<option value="'+value.id+'">'+value.nombre+'</option>');
                    });
                }
            },beforeSend: function(){
                $("#idsubcatego").empty();
                $("#idsubcatego").append('<option value="">cargando....</option>');
            },
            error : function(xhr, status) {
                alert('Hubo un inconveniente al intentar cargar los municipios');
            },
            complete : function(xhr, status) {
            }
        });
       
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
    
});

    

    $(function () {
        $("#mensaje").wysihtml5();
    });

</script>