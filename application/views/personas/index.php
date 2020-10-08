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
                <div class="form-group col-md-4">
                    <label>Cédula<font color="red">*</font></label>
                    <div class="input-group">
                        <input type="text" id="documento" name="documento" class="form-control" placeholder="Cédula">
                        <div class="input-group-btn"> 
                            <button type="button" id='bsqdoc' class="btn btn-default" aria-label="Help">
                            <span class="glyphicon glyphicon-question-sign"></span>
                            </button> 
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label>Nombre<font color="red">*</font></label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-3">
                    <label>Apellido<font color="red">*</font></label>
                    <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido">
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>Genero</label>
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

                <div class="form-group col-md-4">
                    <label>Correo</label>
                    <input type="text" id="correo" name="correo" class="form-control" placeholder="Correo">
                </div>
                
                <div class="form-group col-md-4">
                    <label>Dirección Domicilio</label>
                    <input type="text" id="dirdomicilio" name="dirdomicilio" class="form-control" placeholder="Dirección Domicilio">
                </div>

                <div class="form-group col-md-4">
                    <label>Barrio Domicilio</label>  
                    <input  type="text" id="barriodomicilio" name="barriodomicilio" class="form-control" placeholder="Barrio">
                </div>

                <div class="form-group col-md-1">
                    <label>Testigo</label>
                    <div class="form-group">
                    <input id="testigo" name="testigo" type="checkbox" value="A"></input>
                    </div>
                </div>
                
                <div class="form-group col-md-2">
                    <label>Id puesto testigo</label>
                    <input type="number" id="idpuestovot" name="idpuestovot" class="form-control" placeholder="">
                </div>

                <div class="form-group col-md-2">
                    <label># Referidos</label>
                    <input type="text" id="cuotaper" name="cuotaper" class="form-control" placeholder="# Referidos">
                </div>
                
                <div class="form-group col-md-3">
                    <label>Categoria</label>
                    <select class="form-control select2" style="width: 100%;" name="idcatego" id="idcatego">
                    <option value=''> - </option>
                    <?php if(isset($rescatego)){ ?>
                        <?php foreach($rescatego as $rescat){ ?>
                            <option value="<?=$rescat->id;?>"><?=$rescat->nombre?></option>
                        <?php } ?>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Subcategoria<font color="red">*</font></label>
                    <select class="form-control select2" style="width: 100%;" name="idsubcatego" id="idsubcatego">
                    <option value=''> - </option>
                    <?php if(isset($ressubcatego)){ ?>
                        <?php foreach($ressubcatego as $ressubcat){ ?>
                            <option value="<?=$ressubcat->id;?>"><?=$ressubcat->nombre?></option>
                        <?php } ?>
                    <?php } ?>
                    </select>
                </div>        
            </div>
            
            <!--- datos puestos de votacion -->
            <div class="box box-default">
                <!--<div class="box-header">
                    <button type="button" class="btn btn-info btn-sm" id="b_censo" name="b_censo"><i class="fa fa-download"></i></button>
                    <input type="hidden" id="docc" name="docc" class="form-control" readonly>
                    <strong>Informacion de votacion</strong>
                </div>-->

                <div class="box-body">
                    <div id="errorcenso"></div>
                    <div id="precarcenso"></div>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                        <li class="active">
                            <input type="hidden" id="docc" name="docc" class="form-control" readonly>
                            <a href="#tab1" data-toggle="tab">Informacion Votaciòn</a>
                        </li>
                        <li><a href="#tab2" data-toggle="tab">Cargue registraduria</a></li>
                        </ul>
                        <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            
                            <div class="form-group col-md-6">
                                <label>Departamento<font color="red">*</font></label>
                                <input readonly type="text" id="departamen" name="departamen" class="form-control" placeholder="Departamento">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Municipio<font color="red">*</font></label>
                                <input readonly type="text" id="municipio" name="municipio" class="form-control" placeholder="Municipio">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Direccion<font color="red">*</font></label>
                                <input readonly type="text" id="dirpuesto" name="dirpuesto" class="form-control" placeholder="Direccion">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Mesa<font color="red">*</font></label>
                                <input readonly type="text" id="mesa" name="mesa" class="form-control" placeholder="Mesa">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Puesto<font color="red">*</font></label>
                                <input readonly type="text" id="puesto" name="puesto" class="form-control" placeholder="Puesto">
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class='form-group'>
                                <textarea rows="7" id='votacion' style="width:100%">
                                </textarea>
                            </div>
                            <button type="button" id="capregistraduria" class="btn btn-primary" >Procesar</button>
                        </div>
                        </div>
                    </div>
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
                  <th>Opciones</th> 
                  <th>Id</th>
                  <th>Cedula</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Celular</th>
                  <th>Fijo</th>
                  <th>Correo</th>
                  <th>Genero</th>
                  <th># Referido</th>
                  <th>Departamento Domicilio</th>
                  <th>Municipio Domicilio</th>
                  <th>Direccon Domicilio</th>
                  <th>Departamento Puesto</th>
                  <th>Municipio Puesto</th>
                  <th>Puesto</th>
                  <th>Direccion Puesto</th>
                  <th>Mesa Puesto</th>
                  <th>Testigo</th>
                  <th>Id puesto testigo</th>
                  <th>Categoria</th>
                  <th>Subcategoria</th>
                  <th>Usuario Creacion</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($resultado)){ ?>
                <?php foreach($resultado as $res){ ?>
                    <tr>
                        <td><a class='btn btn-primary btn-xs' href="#" onclick="openModal(<?=$res->id;?>);"><i class='fa fa-pencil'></i> Editar</a></a></td>  
                        <td><?=$res->id;?></td>
                        <td><?=$res->documento;?></td>
                        <td><?=$res->nombre;?></td>
                        <td><?=$res->apellido;?></td>
                        <td><?=$res->celular;?></td>
                        <td><?=$res->fijo;?></td>
                        <td><?=$res->correo;?></td>
                        <td><?=$res->genero;?></td>
                        <td><?=$res->cuotaper;?></td>
                        <td><?=$res->nomdep;?></td>
                        <td><?=$res->nommunic;?></td>
                        <td><?=$res->dirdomicilio;?></td>
                        <td><?=$res->departamen;?></td>
                        <td><?=$res->municipio;?></td>
                        <td><?=$res->puesto;?></td>
                        <td><?=$res->dirpuesto;?></td>
                        <td><?=$res->mesa;?></td>
                        <td><?=$res->testigo;?></td>
                        <td><?=$res->idpuestovot;?></td>
                        <td><?=$res->nomsubcat;?></td>
                        <td><?=$res->nomcat;?></td>
                        <td><?=$res->usuc;?></td>
                    </tr>
                <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Opciones</th> 
                    <th>Id</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Celular</th>
                    <th>Fijo</th>
                    <th>Correo</th>
                    <th>Genero</th>
                    <th># Referido</th>
                    <th>Departamento Domicilio</th>
                    <th>Municipio Domicilio</th>
                    <th>Direccon Domicilio</th>
                    <th>Departamento Puesto</th>
                    <th>Municipio Puesto</th>
                    <th>Puesto</th>
                    <th>Direccion Puesto</th>
                    <th>Mesa Puesto</th>
                    <th>Testigo</th>
                    <th>Id puesto testigo</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Usuario Creacion</th>
                </tr>
                </tfoot>
        </table>
    </div>
    <!-- /box-body -->
</div>
<!-- /box -->
   
          

<script>


$(document).ready(function(){
    $('.select2').select2();
    
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    $("#testigo").click(function(){
        var marcado = $("#testigo").is(":checked");
				
		if(!marcado){
            $("#idpuestovot").val("");
            $("#idpuestovot").prop('disabled',true);
        }else{
            $("#idpuestovot").prop('disabled',false);
        }
    });

    $("#bsqdoc").click(function(){
        
        $.ajax({
            url : '<?php echo base_url();?>index.php/personas/findBydocumento/'+$("#documento").val(),
            async:true,
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                if(json != null){
                   alert('El documento ya se encuentra registrado');
                }else{
                    alert('El documento no existe');
                }
            },beforeSend: function(){
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $("#precargmodal").html("");
                alert('hubo un inconveniente al intentar enviar la peticion');
            },
            complete : function(xhr, status) {
                $("#precargmodal").html("");
            }
        });
    });

    $("#capregistraduria").click(function() { 
            var cadena	=$("#votacion").val();
            
            var posdoc	=cadena.indexOf("No. de documento:");
            var poscol	=cadena.indexOf('"Los Colombianos');
            var posdep	=cadena.indexOf("Departamento:");
            var posmun	=cadena.indexOf("Municipio:");
            var poszon	=cadena.indexOf("Zona:");
            var pospue	=cadena.indexOf("Puesto:");
            var posdir	=cadena.indexOf("Dirección del puesto:");
            var posfec	=cadena.indexOf("Fecha de ingreso:");
            var posmes	=cadena.indexOf("Mesa:");

            if($("#documento").val()==''){
                $("#errorcenso").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Debe agregar el documento antes de procesar el cargue</div>");
                return false;
            }

            if(posdoc != -1 && poscol != -1){
            var documento=cadena.substring((posdoc+17),poscol);
                documento 	=$.trim(documento)
                if($("#documento").val() !=documento){
                    $("#errorcenso").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>El documento no es igual al documento del cargue</div>");
                    return false;
                }

                $("#docc").val(documento);
            }

            if(posdep != -1 && posmun != -1){
                var departamento=cadena.substring((posdep+13),posmun);
                $("#departamen").val($.trim(departamento));
            }
            if(posmun != -1 && poszon != -1){
                var municipio=cadena.substring((posmun+10),poszon);
                $("#municipio").val($.trim(municipio));
            }
            if(poszon != -1 && pospue != -1){
                var zona=cadena.substring((poszon+5),pospue);
            }
            if(pospue != -1 && posdir != -1){
                var puesto=cadena.substring((pospue+7),posdir);
                $("#puesto").val($.trim(puesto));
            }
            if(posdir != -1 && posfec != -1){
                var direccion=cadena.substring((posdir+21),posfec);
                $("#dirpuesto").val($.trim(direccion));
            }
            if(posfec != -1 && posmes != -1){
                var fecha=cadena.substring((posfec+17),posmes);
            }
            if(posmes != -1){
                var mesa=cadena.substring((posmes+5),(posmes+10));
                $("#mesa").val($.trim(mesa));
            }

            $("#votacion").val("");
            $("#errorcenso").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Se cargo la informaciòn</div>");
            
    });
    

    $( "#iddepartamen" ).change(function() {
        $.ajax({
            url : '<?php echo base_url();?>index.php/personas/getdepartamentos/'+$( "#iddepartamen" ).val(),
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

    $( "#idcatego" ).change(function() {
        $.ajax({
            url : '<?php echo base_url();?>index.php/personas/getdecatego/'+$( "#idcatego" ).val(),
            async:false, 
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

    $("#b_censo").click(function() {
        
        $("#departamen").val("");
        $("#municipio").val("");
        $("#mesa").val("");
        $("#puesto").val("");
        $("#dirpuesto").val("");

        if($("#documento").val()==''){
            alert('debe agregar la cedula');
            return false;
        }

        $.ajax({
            url : '<?php echo base_url();?>index.php/personas/getCenso/'+$("#documento").val(),
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                //console.log(json);

                if(json != null){
                    var tipo='danger';
                    if(json.puesto !='')tipo='success';

                    if(json.departam !='') $("#departamen").val(json.departam);
                    if(json.municipio !='') $("#municipio").val(json.municipio);
                    if(json.mesa !='') $("#mesa").val(json.mesa);
                    if(json.puesto !='') $("#puesto").val(json.puesto);
                    if(json.direcpuest !='') $("#dirpuesto").val(json.direcpuest);
                    if(json.observacion !='') $("#errorcenso").html("<div class='alert alert-"+tipo+"'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"+json.observacion+"</div>");
                    $("#docc").val($("#documento").val());
                    $("#documento").prop("readonly",true);
                }
            },beforeSend: function(){
                $("#b_censo").attr("disabled", true);
                $("#precarcenso").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $("#documento").prop("readonly",false);
                $("#b_censo").removeAttr("disabled");
                $("#precarcenso").html("");
                alert('hubo un inconveniente al intentar enviar la peticion');
            },
            complete : function(xhr, status) {
                $("#b_censo").removeAttr("disabled");
                $("#precarcenso").html("");
            }
        });
       
    });

    $("#btn_nuevo").click(function(){
        var base_url = '<?php echo base_url();?>index.php/personas/save';

        $("#titlemodal").html("Nuevo Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Guardar");
        $('#modal-default').modal('show');
        $("#b_censo").removeAttr("disabled");
        
        
        $('#errorcenso').html('');
        $('#precarcenso').html('');
        $('#iddepartamen').select2().val('').trigger('change');
        $('#idmunicipio').select2().val('').trigger('change');
        $('#idsubcatego').select2().val('').trigger('change');
        $('#genero').select2().val('').trigger('change');
        $('#idcatego').select2().val('').trigger('change');

        $("#idpuestovot").prop('disabled',true);
        $("#documento").prop("readonly",false);
        $("#documento").prop('disabled',false);
        $("#idcatego").prop("disabled",false);
        $("#idsubcatego").prop("disabled",false);
        $("#cuotaper").prop("disabled",false);
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
                        $('#forma').trigger("reset");
                        $('#iddepartamen').select2().val('').trigger('change');
                        $('#idmunicipio').select2().val('').trigger('change');
                        $('#idsubcatego').select2().val('').trigger('change');
                        $('#idcatego').select2().val('').trigger('change');
                        $('#precarcenso').html('');
                        $('#errorcenso').html('');
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
            cargarCapa(base_url+'index.php/personas');
        }
    });

});

    function openModal(id){
        var base_url = '<?php echo base_url();?>index.php/personas/update';
        
        $("#titlemodal").html("Editar Registro <small>Los campos marcados con <font color='red'>*</font> son requeridos</small>");
        $("#errormodal").html("");
        $('#errorcenso').html('');
        $('#forma').trigger("reset");
        $("#forma").attr('action',base_url);
        $('#btn_modal').html("Actualizar");
        $('#modal-default').modal('show');

        $.ajax({
            url : '<?php echo base_url();?>index.php/personas/edit/'+id,
            async:true,
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                console.log(json);
                if(json != null){
                   $("#id").val(json.id);
                   $("#documento").val(json.documento);
                   $("#nombre").val(json.nombre);
                   $("#apellido").val(json.apellido);
                   $('#iddepartamen').select2().val(json.iddepart).trigger('change');
                   $("#celular").val(json.celular);
                   $("#fijo").val(json.fijo);
                   $("#correo").val(json.correo);
                   $("#dirdomicilio").val(json.dirdomicilio);
                   $("#barriodomicilio").val(json.barriodomicilio);
                   $('#genero').select2().val(json.genero).trigger('change');
                   $("#cuotaper").val(json.cuotaper);
                   $("#docc").val(json.documento);
                   $('#idcatego').select2().val(json.idcatego).trigger('change');
                   $("#departamen").val(json.departamen);
                   $("#municipio").val(json.municipio);
                   $("#dirpuesto").val(json.dirpuesto);
                   $("#mesa").val(json.mesa);
                   $("#puesto").val(json.puesto);
                   if(json.testigo==1){
                       $('#testigo').prop('checked',true);
                       $("#idpuestovot").prop('disabled',false);
                   }else{
                        $('#testigo').prop('checked',false);
                        $("#idpuestovot").prop('disabled',false);
                   }
                   $("#idpuestovot").val(json.idpuestovot);
                   $("#documento").prop("readonly",true);
                   //$("#idcatego").prop("disabled",true);
                   //$("#idsubcatego").prop("disabled",true);
                   $("#cuotaper").prop("disabled",false);
                   
                }
            },beforeSend: function(){
                $("#precargmodal").html("<img src='<?=base_url()?>/assets/dist/img/loader.gif' width='100'></img>");
            },
            error : function(xhr, status) {
                $("#precargmodal").html("");
                alert('hubo un inconveniente al intentar enviar la peticion');
            },
            complete : function(xhr, status) {
                var json=$.parseJSON(xhr.responseText);
                if(json != null){
                    $('#idsubcatego').select2().val(json.idsubcat).trigger('change');
                    $('#idmunicipio').select2().val(json.idmunic).trigger('change');
                }
                
                $("#precargmodal").html("");
            }
        });

      
    }

    $(function () {
        $('#tresultados').DataTable({
        'paging'      : true,
        'lengthChange': true,
        "pageLength"  : 25,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                className     : 'fa fa-file-excel-o',
                defaultContent: '',
                title         : '',
                text          : ' Export excel',
            }
        ],
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
        })
    });

    

</script>