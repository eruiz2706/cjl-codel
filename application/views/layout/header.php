
<!DOCTYPE html>
<html>

<!-- HEADER -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Colombia Justa Libres</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/bootstrap/dist/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/Ionicons/css/ionicons.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/components/datatables.net-bs/css/buttons.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/iCheck/all.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url();?>assets/components/select2/dist/css/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- styles -->
  <link rel="stylesheet" href="<?=base_url();?>assets/dist/css/style.css">
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?=base_url();?>assets/components/jquery/dist/jquery.min.js"></script>
  
  <!-- higchart -->
  <script src="<?=base_url();?>assets/components/higchart/highcharts.js"></script>
  <script src="<?=base_url();?>assets/components/higchart/highcharts-3d.js"></script>
  <script src="<?=base_url();?>assets/components/higchart/Clase.js"></script>
  </head>
  <!-- /HEADER-->

<body class="hold-transition skin-blue-light sidebar-mini fixed">
<div class='wrapper'>
    <!-- MAIN HEADER -->

<header class="main-header">
<!-- Logo -->
<a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CJL</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Colombia Justa</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">  
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <i class='fa fa-chevron-down'></i>
              <span class="hidden-xs">
                <?php if(trim($this->session->userdata('nombreusu') !='')){echo $this->session->userdata('nombreusu');}else{echo $this->session->userdata('username');} ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url();?>assets/dist/img/logo_white.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php if(trim($this->session->userdata('nombreusu') !='')){echo $this->session->userdata('nombreusu');}else{echo $this->session->userdata('username');} ?>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
               
                   <a href="javascript:openUrl('<?=base_url();?>index.php/clave','','Cambio Clave','');" class="btn btn-primary btn-flat"><i class='fa fa-sync'></i> Cambio Clave</a>
                  <a href="<?=base_url();?>index.php/login" class="btn btn-primary btn-flat"><i class='fa fa-sign-out'></i> Cerrar Sesiòn</a>
                </div>
              </li>
            </ul>
          </li>
          <li></li>
        </ul>
      </div>
    </nav>
    </header>
    <!-- /MAIN HEADER -->

    <!-- MAIN SIDEBAR -->
    <aside class="main-sidebar">
    <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=base_url();?>assets/dist/img/logo.png" class="img-circle" alt="User Image">
            </div>
          </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">
        <strong>
        <?php if(trim($this->session->userdata('nombreusu') !='')){echo $this->session->userdata('nombreusu');}else{echo $this->session->userdata('username');} ?>
        </strong>
        </li>
        <li><a href="javascript:openUrl('<?=base_url();?>index.php/','dashboard','Dashboard','');"><i class="fa  fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?= $menu; ?>
        <li><a href="<?=base_url();?>index.php/login"><i class="fa fa-sign-out"></i> <span>Cerrar Sesiòn</span></a></li>
    </ul>   

    </section>
    </aside>
    <!-- /MAIN SIDEBAR -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        
      
