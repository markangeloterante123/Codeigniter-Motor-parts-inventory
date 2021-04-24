<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Print</title>
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
                     DENVER'S CYCLE MOTORPARTS
                  </h3>
                  <h6>Blk 12 Lot 11 Barangay Ge De Jesus San Jose, General Mariano Alvarez, Cavite</h6>
                  <h6>09**-***-****</h6>
                </div>
              </div>

    <!-- info row -->
   <input type="hidden" name="pos_no" value="<?php echo $pos; ?>">
   


    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>ITEMS</th>
            <th>BRAND & DESCRIPTION</th>
            <th>QTY</th>
            <th>UNIT-PRICE</th>
            <th>TOTAL</th>
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
      
      display();
      function display(){
        var rec = $('input[name="pos_no"]').val();
         $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_his2',
                    type: 'post',
                    data:{rec:rec},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                      var total = 0;
                      var name = '';
                      var reciept_no= '';
                      var date = '';
                      var cust = '';
                          var i;
                          for(i=0; i < data.length; i++){
                               total += parseFloat(data[i].total_price);
                               name = data[i].names;
                               reciept_no = data[i].reciept_no; 
                               date = data[i].date;
                               cust = data[i].cust_name;
                               if(data[i].qty == '0'){
                                 html += 
                                 '<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td colspan="3" style="text-align:center;">*** CANCEL ORDERS ***</td>'+
                                 '</tr>'
                                ; 
                               }
                               else{
                                 html += 
                                 '<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td>'+data[i].qty+'</td>'+
                                  '<td>₱  '+data[i].price+'</td>'+
                                  '<td>₱  '+data[i].total_price+'</td>'+
                                 '</tr>'
                                ; 
                               }
                              
                          }
                      var vat = total * 0.12;
                      var f_total = vat + total;
                      var vats = Number((vat).toFixed(1));
                      html += 
                      '<tr><td colspan="3"></td><td colspan="2">SUB-TOTAL: </td><td>₱ '+total+'</td></tr>'+
                      '<tr><td colspan="3"></td><td colspan="2">TAX: </td><td>₱ '+vats+'</td></tr>'+
                      '<tr><td colspan="3"></td><td colspan="2">TOTAL: </td><td>₱ '+f_total+'</td></tr>'+
                      '<tr><td colspan="3"></td><td colspan="2">CUSTOMER NAME:   '+cust+'</td><td> POS#: '+reciept_no+'</td></tr>'+
                      '<tr><td colspan="3"></td><td colspan="2">SOLD BY:   '+name+'</td><td> DATE: '+date+'</td></tr>'+
                      '<tr><td colspan="3"></td><td colspan="3" style="text-align:center;">1 WEEK ITEMS REPLACEMENTS AND WARRANTY</td></tr>';
                      $('.display_table').html(html);
                      window.addEventListener("load", window.print());
                    }
                  });
      }

    });
</script>