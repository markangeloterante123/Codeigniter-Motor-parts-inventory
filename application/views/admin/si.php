
  <!-- Left side column. contains the logo and sidebar -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/skins/_all-skins.min.css">


  <?php
       $id = $this->session->all_userdata();
          if(isset($id['admin_session'])){
  

  ?>

  <body class="hold-transition skin-black-light sidebar-collapse sidebar-mini">
<div class="wrapper" >
  <header  class="main-header" >
  
    <a href="#" class="logo" >
      <span class="logo-mini" ><img src="<?php echo base_url(); ?>assets/userProfile/logo.png"></span>
      <span class="logo-lg">ADMIN</span>
    </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div  class="navbar-custom-menu" >
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php
                  $table="tbl_user_acc";
                  $field="id";
                  if(isset($id['admin_session'])){
                    $data=$id['admin_session'];
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

   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div  class="user-panel">
        
        
      </div>
      <ul class="sidebar-menu" data-widget="tree">
       
       <li>
          <a href="<?php echo base_url(); ?>pages/pageAdmin/admin"><i class="fa fa-dashboard"></i><span>LATEST POS ORDER</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/pos"><i class="fa fa-shopping-cart"></i><span>POS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/rec"><i class="fa fa-list"></i><span>INVENTORY RECORDS</span></a>
        </li>  
       <!--  <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/inventory"><i class="fa fa- fa-cubes"></i><span>Items</span></a>
        </li> -->
        <li>
            <a data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i><span>NEW ITEM</span></a>
        </li>
        <li>
            <a data-toggle="modal" data-target="#add_category"><i class="fa fa-tag"></i><span>NEW CATEGORY</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/rep"><i class="fa fa-warning"></i><span>REPLACEMENT RECORDS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/his"><i class="fa fa-archive"></i><span>HISTORY</span></a>
        </li>
      
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin2/si"><i class="fa fa-calendar"></i><span>SALES INVOICE RECORDS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageGrap/grap"><i class="fa fa-pie-chart"></i><span>STATISTICS</span></a>
        </li>
      
        
                    
        <li class="treeview">
          <a href="#">
            <i class="fa fa-reorder "></i>
            <span>ACCOUNTS</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="<?php echo base_url(); ?>pages/pageAdmin/us"><i class="fa fa-user-plus"></i>ADD USERS</a></li>
             <li><a href="javascript:void(0)" class="updatePass" ><i class="fa fa-users "></i>PASSWORD & USERNAME</a></li>
          </ul>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/logout"><i class="fa fa-sign-out"></i><span>SIGN OUT</span></a>
        </li>


      </ul>
    </section>
  </aside>
      <?php } }?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SALES INVOICE RECORDS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales Invoice</li>
      </ol>
    </section>

    <section class="content">
      
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="box box-info">
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1"class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SALES INVOICE #</th>
                    <th>ITEMS</th>
                    <th>PARTS NO.</th>
                    <th>BRAND & DESCRIPTION</th>
                    <th>SUPPLIER</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>DATE</th>
                  </tr>
                  </thead>
                  <tbody >
                      <?php 
                        if(isset($id['admin_session'])){
                          foreach ($this->load->model_users->display_si() as $values){

                            $si = $values->cust_name;
                            $item = $values->type;
                            $name = $values->name;
                            $brand = $values->brand;
                            $qty = $values->qty;
                            $price = $values->price;
                            $date = $values->date;
                            $code = $values->code;
                            $sup = $values->supplier;
                      ?>
                    
                    <tr>
                      <td><?php echo $si; ?></td>
                      <td><?php echo $name; ?></td>
                      <td><?php echo $code; ?></td>
                      <td><?php echo $brand; ?></td>
                      <td><?php echo $sup; ?></td>
                      <td><?php echo $qty; ?></td>
                      <td><?php echo $price; ?></td>
                      <td><?php echo $date; ?></td>
                    </tr>
                    <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

       <!--  <div class="col-md-4">   
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Item Stock</h3>
            </div>
            <div class="box-body ">
              <div class="newItems">
              </div>
            </div>
            <div class="box-footer text-center">
              <a href="<?php echo base_url(); ?>pages/pageAdmin/inventory" class="uppercase">View All Products</a>
            </div>
          </div>
        </div> -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php } ?>

<script src="<?php echo base_url(); ?>assets/board/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/board/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/board/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/board/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/board/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>