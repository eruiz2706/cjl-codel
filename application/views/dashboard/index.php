
<div class="col-md-6">
    <div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Ingresados vs Referidos</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div id="graf1" style=" height:200px; " align="center"></div>
        </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- ./box-body -->
    <div class="box-footer">
        <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="description-block border-right">
            <h5 class="description-header"><?=$person;?></h5>
            <span class="description-text">TOTAL PERSONAS</span>
            </div>
            <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-6 col-xs-6">
            <div class="description-block border-right">
            <h5 class="description-header"><?=$refer;?></h5>
            <span class="description-text">TOTAL REFERIDOS</span>
            </div>
            <!-- /.description-block -->
        </div>
       </div>
        <!-- /.row -->
    </div>
    <!-- /.box-footer -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->

<div class="col-md-6">
    <div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Sin datos de votacion</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div id="graf4" style=" height:200px; " align="center"></div>
        </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- ./box-body -->
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-6 col-xs-6">
                <div class="description-block border-right">
                <h5 class="description-header"><?=$condatos;?></h5>
                <span class="description-text">TOTAL CON DATOS DE VOTACION</span>
                </div>
                <!-- /.description-block -->
            </div>
            <div class="col-sm-6 col-xs-6">
                <div class="description-block border-right">
                <h5 class="description-header"><?=$sindatos;?></h5>
                <span class="description-text">TOTAL SIN DATOS DE VOTACION</span>
                </div>
                <!-- /.description-block -->
            </div>
       </div>
        <!-- /.row -->
    </div>
    <!-- /.box-footer -->
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->
  

<div class="col-md-12">
    <div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Ingresados vs Referidos(categorias)</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div id="graf3" style=" height:350px;" align="center"></div>
        </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- ./box-body -->
    
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->

<div class="col-md-12">
    <div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Ingresados por dia</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div id="graf2" style=" height:300px;" align="center"></div>
        </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- ./box-body -->
    
    </div>
    <!-- /.box -->
</div>
<!-- /.col -->

<?php
echo "<script type='text/javascript'>pie3d('graf1','',$graf1,'',false,true,false); </script>";                        
echo "<script type='text/javascript'>column_linea('graf2','','','',$cadtitgraf2,$cadgraf2,'',$toolgraf2,'true'); </script>";
echo "<script type='text/javascript'>column_basic2('graf3','','','',$cadtitgraf3,$cadgraf3,'',$toolgraf3,'true'); </script>";
echo "<script type='text/javascript'>pie3d('graf4','',$graf4,'',false,true,false); </script>";                        
?>