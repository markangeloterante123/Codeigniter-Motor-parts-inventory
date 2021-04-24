<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>REPORT</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/AdminLTE.min.css">

</head>

<body>
<div class="wrapper">
  <section class="invoice">
     <div class="row">
        <div class="col-xs-12">
          <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">  
              <h2 class="page-header" style="text-align: center">
      
              </h2>
            </div>
          </div>
          <hr>
        </div>
        <!-- /.col -->
      </div>

     
                
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Type</th>
            <th>Item</th>
            <th>Date</th>
            <th>Brand/Discription</th>
            <th>Qty</th>
            <th>Selling-Price</th>
            <th>Total-Price</th>
            <th>Revenue</th>
          </tr>
          </thead>
          <tbody>
          <?php $total = 0; ?>
          <?php $rev = 0; ?>
          <?php $no = 0; ?>
          <?php 
            if($collect_data){
              foreach ($collect_data as $values) {
                $name = $values->name;
                $brand = $values->brand;
                $qty = $values->qty;
                $unit = $values->price;
                $price = $values->total_price;
                $net = $values->net;
                $recp = $values->reciept_no;
                $si = $values->cust_name;
                $date = $values->date;

                $total = $total+$price;
                $rev = $rev+$net;
                $no = $no+1;
          ?>
          <tr>

            <td><?php echo $no; ?></td>
            <td><?php 
              if($recp == '0'){
                echo $si;
              }
              else{
                echo $recp;
              }
            ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $brand; ?></td>
            <td><?php echo $qty; ?></td>
            <td><?php echo $unit; ?></td>
            <td><?php echo $price; ?></td>
            <td><?php echo $net; ?></td>
            
          </tr>

            <?php }} ?>
          </tbody>
        </table>
        
      </div>
    </div>


    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead"> Report From <?php echo $start; ?>  To <?php echo $end; ?></p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">TOTAL SALE:</th>
              <td>₱<?php echo $total;  ?></H4></td>
            </tr>
            <tr>
              <th>TOTAL REVENUE:</th>
              <td>₱<?php echo $rev;  ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>

    
  </section>
</div>

</body>
</html>
