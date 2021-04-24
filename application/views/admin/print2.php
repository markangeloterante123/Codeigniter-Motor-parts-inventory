<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PDF Download</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!--  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/board/dist/css/AdminLTE.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/script/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/script/css/adminlte.min.css">
  <script src="<?php echo  base_url(); ?>assets/board/bower_components/jquery/dist/jquery.min.js"></script>

</head>

<!-- <body onload="window.print();"> -->
<body>
<div class="wrapper">
  <section class="invoice">
     <div class="row">
    
      </div>

             <div class="row">
                <div class="col-12">
                  <h3 class="page-header">
                     INVENTORY RECORDS
                  </h3>
                 
                </div>
              </div>

    <!-- info row -->
     


    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>ITEM</th>
            <th>PARTS NO.</th>
            <th>BRAND & DESCRIPTION</th>
            <th>STOCK</th>
            <th>SELLING UNIT-PRICE</th>
            
          </tr>
          </thead>
          <tbody class="display_table">
           
          </tbody>
        </table>
      </div>
    </div>
   
   
  </section>
</div>

</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
      
      display_item_list();
    
       function display_item_list(){
        $.ajax({
          url:'<?=base_url()?>index.php/pages/item_view3',
          type: 'post',
          dataType : "JSON",
          error: function() {
            alert('Something is wrongs');
          },
          success: function (data) {
            var html = '';
            var i;
              for(i=0; i < data.length; i++){ 
                     html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td>'+data[i].qty+' pcs/set</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                      '</tr>'; 
              }
              var x = new Date();
              html += 
              '<tr><td colspan="4"></td><td>TOTAL ITEMS:</td><td>'+data.length+'</td></tr>'+
              '<tr><td colspan="6" style="text-align:center;">INVENTORY RECORDS AS OF '+x+'</td></tr>';
              $('.display_table').html(html);
              window.addEventListener("load", window.print());
            }
        });
      }
      
  });
</script>