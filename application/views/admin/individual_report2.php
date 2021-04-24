<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Item History</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
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
              $user=$id['admin_session'];

  ?>

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black-light sidebar-collapse sidebar-mini">
<div class="wrapper">

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HISTORY ITEM RECORDS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">History</a></li>
      </ol>
    </section>

    <!-- Main content -->

    <section class="content">
      
      <a style="margin-bottom: 5px;" href="javascript:void(0)" class="btn btn-info pull-right generateIndiReport" ><i class="fa fa-download"></i> Generates Report</a>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>POS#</th>
                    <th>CUSTOMER NAME</th>
                    <th>ITEM</th>
                    <th>PARTS NO.</th>
                    <th>BRAND & DESCRIPTION</th>
                    <th>SOLD QTY</th>
                    <th>DATE</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                  if(isset($id['admin_session'])){

                    foreach ($collect_data as $values){
                      $po  = $values->reciept_no;
                      $item = $values->name;
                      $code = $values->code;
                      $brand = $values->brand;
                      $stock = $values->qty;
                      $date = $values->date;
                      $cos = $values->cust_name;
                      
                  ?> 
                  <tr>
                    <td>Receipt No: <?php echo $po; ?></td>
                    <td><?php echo $cos; ?></td>
                    <td><?php echo $item; ?></td>
                    <td><?php echo $code; ?></td>
                    <td><?php echo $brand; ?></td>
                    <td><?php echo $stock; ?></td>
                    <td><?php echo $date; ?></td>
                  </tr>
                <?php }} ?>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>  </div>
  <footer class="main-footer">
   
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
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
<?php } ?>


<div class="modal fade" id="generates" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>pages/generatesRec" target="_blank" method="post">
      <div class="modal-body">
          <label for="recipient-name" class="col-form-label">Date Start</label>
          <input type="date" class="form-control " name="start3" required>
          <label for="recipient-name" class="col-form-label">Date End</label>
          <input type="date" class="form-control" name="end3" required>
          <input type="hidden" name="id_item" value="<?php echo $item_id; ?>">
          <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info" value="Generates Reports">
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {

        $('.generateIndiReport').click(function(){
          $('#generates').modal('show');
        });


  });
</script>