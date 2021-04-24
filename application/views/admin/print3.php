<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PDF Item History</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                     ITEM HISTORY SALES
                  </h3>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="start" value="<?php echo $start; ?>">
                  <input type="hidden" name="end" value="<?php echo $end; ?>">
                </div>
              </div>

    <!-- info row -->
     


    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>POS#</th>
          <!--<th>CUSTOMER NAME</th> -->
            <th>ITEM</th>
            <th>PARTS NO.</th>
            <th>BRAND & DESCRIPTION</th>
            <th>SOLD QTY</th>
            <th>DATE</th>
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
          var id = $('input[name="id"]').val();
          if(id >= '1'){
            display_item();
          }
          else{
            display_history();
          }
             
        }
        function display_item(){
          var id = $('input[name="id"]').val();
          var start = $('input[name="start"]').val();
          var end = $('input[name="end"]').val();
           $.ajax({
              url:'<?=base_url()?>index.php/pages/print3_rec',
              data:{id:id, start:start, end:end},
              type: 'post',
              dataType : "JSON",
              error: function() {
                alert('Something is wrongs');
              },
              success: function (data) {
                var html = '';
                var net = 0;
                var tot = 0;
                var qty = 0;
                var i;
                  for(i=0; i < data.length; i++){ 
                        net += parseFloat(data[i].net);
                        tot += parseFloat(data[i].total_price);
                        qty += parseFloat(data[i].qty);
                         html +=
                          '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>Receipt No:'+data[i].reciept_no+'</td>'+
                            // '<td>'+data[i].cust_name+'</td>'+
                            '<td>'+data[i].name+'</td>'+
                            '<td>'+data[i].code+'</td>'+
                            '<td>'+data[i].brand+'</td>'+
                            '<td>'+data[i].qty+'pcs/set</td>'+
                            '<td>'+data[i].date+'</td>'+
                          '</tr>'; 
                  }
                  
                  var vat = tot * 0.12;
                  var total = tot + vat;
                  var vats = Number((vat).toFixed(1));
                  var net2 = Number((net).toFixed(1));
                  var pri2 = Number((tot).toFixed(1));
                  
                  html += 
                  '<tr><td colspan="5"></td><td>TOTAL ITEMS SOLD:</td><td>'+qty+' pcs/set</td></tr>'+
                  '<tr><td colspan="5"></td><td>SUB-TOTAL:</td><td>₱ '+pri2+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>PAYABLE VAT:</td><td>₱ '+vats+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>TOTAL:</td><td>₱ '+total+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>NET:</td><td>₱ '+net2+'</td></tr>'+
                  '<tr><td colspan="7" style="text-align:center;">FROM  '+start+' TO '+end+'</td></tr>';
                  $('.display_table').html(html);
                  window.addEventListener("load", window.print());
                }
            });

        }

        function display_history(){
          var start = $('input[name="start"]').val();
          var end = $('input[name="end"]').val();
           $.ajax({
              url:'<?=base_url()?>index.php/pages/print4_rec',
              data:{start:start, end:end},
              type: 'post',
              dataType : "JSON",
              error: function() {
                alert('Something is wrongs');
              },
              success: function (data) {
                var html = '';
                var net = 0;
                var tot = 0;
                var qty = 0;
                var i;
                  for(i=0; i < data.length; i++){ 
                        net += parseFloat(data[i].net);
                        tot += parseFloat(data[i].total_price);
                        qty += parseFloat(data[i].qty);
                         html +=
                          '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>Receipt No:'+data[i].reciept_no+'</td>'+
                            // '<td>'+data[i].cust_name+'</td>'+
                            '<td>'+data[i].name+'</td>'+
                            '<td>'+data[i].code+'</td>'+
                            '<td>'+data[i].brand+'</td>'+
                            '<td>'+data[i].qty+'pcs/set</td>'+
                            '<td>'+data[i].date+'</td>'+
                          '</tr>'; 
                  }
                  
                  var vat = tot * 0.12;
                  var total = tot + vat;
                  var vats = Number((vat).toFixed(1));
                  var net2 = Number((net).toFixed(1));
                  var pri2 = Number((tot).toFixed(1));
                  
                  html += 
                  '<tr><td colspan="5"></td><td>TOTAL ITEMS SOLD:</td><td>'+qty+' pcs/set</td></tr>'+
                  '<tr><td colspan="5"></td><td>SUB-TOTAL:</td><td>₱ '+pri2+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>PAYABLE VAT:</td><td>₱ '+vats+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>TOTAL:</td><td>₱ '+total+'</td></tr>'+
                  '<tr><td colspan="5"></td><td>NET:</td><td>₱ '+net2+'</td></tr>'+
                  '<tr><td colspan="7" style="text-align:center;">FROM  '+start+' TO '+end+'</td></tr>';
                  $('.display_table').html(html);
                  window.addEventListener("load", window.print());
                }
            });

        }

  });
</script>