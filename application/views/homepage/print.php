<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/AdminLTE.min.css">

</head>

<body onload="window.print();">
<div class="wrapper">
  <section class="invoice">
     <div class="row">
        <div class="col-xs-12">
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
               <img style="border:solid 2px black; width: 150px; height: 150px;" src="<?php echo base_url(); ?>/assets/userProfile/logo.png">
            </div>
            <div class="col-sm-4 invoice-col">  
              <h2 class="page-header" style="text-align: center">
                <small>Republic of the Philippines</small>
                  DENVER'S 
                 <small style="font-size: 13px;">
                  CYCLE MOTORPARTS
                 </small>
                 <small>
                   <i class="fa fa-phone"></i>
                   <span style="font-size: 12px;">09** **** ***</span>
                 </small>
              </h2>
            </div>
          </div>
          <hr>
        </div>
        <!-- /.col -->
      </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <label>Purchase Order #: <?php echo $PO; ?>
        <h4></h4>
        </label>
      </div>
    </div>
   


    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Item</th>
            <th>Brand/Discription</th>
            <th>Qty</th>
            <th>Unit-Price</th>
            <th>Price</th>
          </tr>
          </thead>
          <tbody>
          <?php $total = 0; ?>
          <?php $no = 0; ?>
          <?php 
            if($collect_data){
              foreach ($collect_data as $values) {
                $name = $values->name;
                $brand = $values->brand;
                $qty = $values->qty;
                $unit = $values->price;
                $price = $values->total_price;
                $total = $total+$price;
                $no = $no+1;
          ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $brand; ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo $unit; ?></td>
            <td><?php echo $price; ?></td>
            
          </tr>
            <?php }} ?>
          </tbody>
        </table>
        <H4 class="btn btn-sucess pull-right"></H4>
      </div>
    </div>

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
  

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">TOTAL SALE:</th>
              <td> ₱<?php echo $total;  ?></H4></td>
            </tr>
           <!--  <tr>
              <th>TOTAL REVENUE:</th>
              <td>₱<?php echo $rev;  ?></td>
            </tr> -->
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    
  </section>
</div>

</body>
</html>
