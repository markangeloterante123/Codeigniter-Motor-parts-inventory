
 <?php
       $id = $this->session->all_userdata();
          if(isset($id['admin_session'])){
              $user=$id['admin_session'];

  ?>
  <div  class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        HISTORY ITEM RECORDS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">History</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <section class="content">
      
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            
            <div class="box-header with-border">
                <input type="hidden" name="id_item" value="<?php echo $item_id; ?>">
                <label for="recipient-name" class="col-form-label">Date Start</label>
                <input type="date" class="form-control" name="start" required>
                <label for="recipient-name" class="col-form-label">Date End</label>
                <input type="date" class="form-control" name="end" required>
                <br>
                <a href="javascript:void(0)" class="btn btn-info pull-right generateIndiReport" >Generates Report</a>
           
            </div>
            <!-- /.box-header -->
            <div class="box box-info">
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>P.O#</th>
                    <th>Costumer</th>
                    <th>Item</th>
                    <th>Code</th>
                    <th>Brand</th>
                    <th>Sold Qty</th>
                    <th>Date</th>
                    
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
                    <td>P.O# <?php echo $po; ?></td>
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
              <!-- /.table-responsive -->
            </div>
          </div>
          <!-- /.box -->

        </div>
      

      </div>
    </section>
  </div>

<?php } ?>
  