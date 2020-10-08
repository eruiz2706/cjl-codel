<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>COLOMBIA JUSTA LIBRES</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body   oncontextmenu="return false"  class="hold-transition login-page" style="background-size: cover;background-image: url(<?=base_url();?>assets/dist/img/fondo2.jpg);">

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
                <div class="form-group col-md-3">
                    <label>Cédula<font color="red">*</font></label>
                    <input type="text" id="documento" name="documento" class="form-control" placeholder="Cédula">
                </div>
                <div class="form-group col-md-3">
                    <label>Nombre<font color="red">*</font></label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-3">
                    <label>Apellido<font color="red">*</font></label>
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido">
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Genero<font color="red">*</font></label>
                        <select class="form-control" name="genero" id="genero">
                            <option value=''> - </option>
                            <option value='M'>Hombre</option>
                            <option value='F'>Mujer</option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-3">
                    <label>Departamento Domicilio</label>
                    <select class="form-control select2" style="width: 100%;" name="iddepartamen" id="iddepartamen">
                        <option value=''> - </option>
                        <?php if(isset($resdepart)){ ?>
                                <?php foreach($resdepart as $resdep){ ?>
                                    <option value="<?=$resdep->id;?>"><?=$resdep->nombre?></option>
                                <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Municipio Domicilio<font color="red">*</font></label>
                    <select class="form-control select2" style="width: 100%;" name="idmunicipio" id="idmunicipio">
                    <option value=''> - </option>
                    <?php if(isset($resmunicip)){ ?>
                        <?php foreach($resmunicip as $resmun){ ?>
                            <option value="<?=$resmun->id;?>"><?=$resmun->nombre?></option>
                        <?php } ?>
                    <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label>Celular<font color="red">*</font></label>
                    <input type="number" id="celular" name="celular" class="form-control" placeholder="Celular">
                </div>

                <div class="form-group col-md-3">
                    <label>Fijo</label>
                    <input type="number" id="fijo" name="fijo" class="form-control" placeholder="Fijo">
                </div>

                <div class="form-group col-md-3">
                    <label>Correo<font color="red">*</font></label>
                    <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo">
                </div>
                
                <div class="form-group col-md-3">
                    <label>Dirección Domicilio</label>
                    <input type="text" id="dirdomicilio" name="dirdomicilio" class="form-control" placeholder="Dirección Domicilio">
                </div>

                <div class="form-group col-md-3">
                    <label>Barrio Domicilio<font color="red">*</font></label>
                    <input  type="text" id="barriodomicilio" name="barriodomicilio" class="form-control" placeholder="Barrio">
                </div>
 
                <div class="form-group col-md-3">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group col-md-3">
                    <label>Re-Password</label>
                    <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-Password">
                </div>
                <div class="form-group col-md-3">
                    <div class="g-recaptcha" data-sitekey="6LfIjkcUAAAAAGk5l_uj6wgq8wiFKbei1WCs1nmP" style="margin-bottom:15px;"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button id="btn_modal" type="button" class="btn btn-primary pull-left"></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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


<?php if(isset($errormsj))echo $errormsj; ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body" style="background-color:transparent">
    <div class="login-logo">
    </div>
    <!--<p class="login-box-msg"></p>-->
    <form action="<?=base_url()?>index.php/login/in" method="post" id='login'>
      <div class="form-group has-feedback">
        <input type="text" id="cta" name="cta" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="ctacl" name="ctacl" class="form-control" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="g-recaptcha" data-sitekey="6LfIjkcUAAAAAGk5l_uj6wgq8wiFKbei1WCs1nmP" style="margin-bottom:15px;"></div>
      
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesiòn <i class='fa fa-sign-in'></i></button>
        </div>
        <!-- /.col -->
      </div>

      <a id='btn_nuevo'  href="#" ><strong>REGISTRATE CLICK AQUI</strong></a>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?=base_url();?>assets/components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url();?>assets/components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="https://www.google.com/recaptcha/api.js?hl=es"></script>
<script>
    $("#btn_nuevo").click(function(){
        var base_url = '<?php echo base_url();?>index.php/login/user';

        grecaptcha.reset();
        $("#titlemodal").html("Nuevo Usuario<small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Registrar");
        $('#modal-default').modal('show');
        $("#b_censo").removeAttr("disabled");
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
                $('#forma').trigger("reset");
                $('#iddepartamen').val('');
                $('#idmunicipio').val('');
                $('#precargmodal').html('');
                $("#errormodal").html(json.successmsj);
                grecaptcha.reset();
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

    $( "#iddepartamen" ).change(function() { 
    $.ajax({
        url : '<?php echo base_url();?>index.php/login/getdepart/'+$( "#iddepartamen" ).val(),
        async:false, 
        type : 'GET',
        dataType : 'json',
        success : function(json) {
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

</script>



</body>
</html>