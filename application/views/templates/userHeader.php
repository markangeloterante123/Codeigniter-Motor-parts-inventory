<!DOCTYPE html>
<html>
<head>

<?php
  $id = $this->session->all_userdata();
  if(isset($id['user_session'])){
?>

 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Side</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/morris.js/morris.css">
  <link rel="icon" href="<?php echo base_url(); ?>assets/userProfile/logo.png">
  <script src="<?php echo  base_url(); ?>assets/board/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body class="hold-transition skin-black-light sidebar-collapse sidebar-mini">
<div class="wrapper" >
  <header  class="main-header" >
  
    <a href="#" class="logo" >
      <span class="logo-mini" ><img src="<?php echo base_url(); ?>assets/userProfile/logo.png"></span>
      <span class="logo-lg">User Side</span>
    </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  $table="tbl_user_acc";
                  $field="id";
                  if(isset($id['user_session'])){
                    $data=$id['user_session'];
                    foreach ($this->load->model_users->data($table,$field,$data) as $values) { 
                         $name = $values->names;
                ?>
              <span class="hidden-xs">Account LogIn: <?php echo $name;?>
                
              </span>
            </a>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

   <aside  class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        
        
      </div>
      <?php } }?>
  <?php
  }
  ?>

