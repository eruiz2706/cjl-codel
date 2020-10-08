<?php if(isset($errormsj))echo $errormsj; ?>
<div id="errormodal"></div>
<div id="precargmodal"></div>

<form action="<?php echo base_url();?>index.php/csv/uploadData" method="post" enctype="multipart/form-data" name="forma" id="forma"> 
<!-- box -->
<div class="box box-primary">
    <!-- box-header -->
    <div class="box-header">
        <h3 class="box-title">
            <a href="<?php echo base_url(); ?>assets/formatos/formato_carga.csv" download="formato_carga.csv"> CLICK AQUI PARA DESCARGAR FORMATO</a>
        </h3>
    </div>
    <div class="modal-body">
        <input type="file" class="form-control" name="userfile" id="userfile"  align="center"/>
    </div>

    <div class="box-footer">
        <button type="button" name="btn_save" id="btn_save" class="btn btn-primary">Cargar</button>
    </div>
</div> 
</form>

<script>

    $("#btn_save").click(function(){
	var form = $('forma')[0];

	var userfile = document.getElementById("userfile");
        var file = userfile.files[0];
        var data2 = new FormData(form);
        data2.append("userfile",file);

	console.log(data2);
	console.log("++");

        $.ajax({
            url : $('#forma').attr('action'),
            type : 'POST',
            data : data2,
            processData:false,
	    contentType:false,
            dataType : 'json',
            success : function(json) {
                $("#errormodal").html(json.errormsj);
                $('#forma').trigger("reset");
            },beforeSend: function(){
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $('#forma').trigger("reset");
                $("#precargmodal").html("");
                alert('hubo un inconveniente al intentar enviar la peticion');
            },complete : function(xhr, status) {
                $("#precargmodal").html("");
            }
        });
    });

</script>