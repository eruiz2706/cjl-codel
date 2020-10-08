<?php if(isset($errormsj))echo $errormsj; ?>
<div class="modal fade" id="modal-default" rol="dialog">
<form id="forma" action="#" method="post">
    <div class="modal-dialog">
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
                <div class="form-group col-md-12">
                    <label>Asunto<font color="red">*</font></label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Asunto" disabled>
                </div>
                <div class="form-group col-md-12">
                    <label>Mensaje<font color="red">*</font></label>
                    <textarea name="mensaje" id="mensaje" class="form-control" style="height: 300px" disabled>
                        
                    </textarea>
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            <button id="btn_modal" type="button" class="btn btn-primary pull-left "></button>
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



<div class="row">
<div class="col-md-2">
    <button id="btn_nuevo" type="submit" class="btn btn-primary btn-block btn-flat" onclick="cargarCapa(base_url+'index.php/msjemail/nuevo');">Redactar</button>
    <br>
</div>
</div>

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
                  <th>Asunto</th>
                  <th>Usuario creacion</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($resultado)){ ?>
                <?php foreach($resultado as $res){ ?>
                    <tr>
                        <td><?=$res->id;?></td>
                        <td><?=$res->asunto;?></td>
                        <td><?=$res->usuc;?></td>
                        <td><a href="<?=base_url()?>index.php/msjemail/edit/<?=$res->id;?>" >ver</a></td>    
                    </tr>
                <?php } ?>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Asunto</th>
                  <th>Usuario creacion</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
        </table>
    </div>
    <!-- /box-body -->
</div>
<!-- /box -->
   
          

<script>
    function openModal(id){
        $("#errormodal").html("");
        $('#modal-default').modal('show');

        $.ajax({
            url : '<?php echo base_url();?>index.php/categorias/edit/'+id,
            
            type : 'GET',
            dataType : 'json',
            success : function(json) {
                if(json != null){
                    $("#id").val(json.id);
                    $("#nombre").val(json.nombre);
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
        })
    })

</script>