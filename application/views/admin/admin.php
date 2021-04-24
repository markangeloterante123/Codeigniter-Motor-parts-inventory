
 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        LATEST POS ORDERS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Latest POS Orders</li>
      </ol>
    </section>

    <section class="content">
      
      <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
            <div class="box-header with-border">
              
              <h5 class="back_button"></h5>
            </div>
            <input type="hidden" name="auto_updated" value="0">
            <div class="box-body show_reciept">
                <!---ajax-->  
            </div>
          </div>
        
        </div>
      

        
      </div>
    </section>
  </div>

<script type="text/javascript">
   $(document).ready(function () {
    ajax_history_po();
    function table(){
      var table = 
              '<div class="table-responsive">'+
                '<table class="table table-bordered table-striped">'+
                  '<thead>'+
                  '<tr>'+
                    '<th>#</th>'+
                    '<th>ITEM</th>'+
                    '<th>PARTS NO.</th>'+
                    '<th>BRAND & DESCRIPTION</th>'+
                    '<th>QTY</th>'+
                    '<th>UNIT PRICE</th>'+  
                    '<th>TOTAL PRICE</th>'+  
                    '<th>NET</th>'+
                  '</tr>'+
                  '</thead>'+
                  '<tbody class="sale_history">'+
                    
                  '</tbody>'+
                '</table>'+
              '</div>';
         $('.show_reciept').html(table);

      var buttons = '<a href="javascript:void(0)" class="btn btn-info back_file"><i class="fa fa-reply"></i> BACK</a>';
      $('.back_button').html(buttons);
    }
    function ajax_history_po(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_his',
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
                               '<div class="col-lg-3 col-xs-6">'+
                                  '<div class="small-box bg-aqua">'+
                                    '<div class="inner">'+
                                      '<p>'+data[i].date+'</p>'+
                                      '<h5>Receipt No: '+data[i].reciept_no+'</h5>'+
                                    '</div>'+
                                    '<div class="icon">'+
                                      '<i class="fa fa-folder-open"></i>'+
                                    '</div>'+
                                    '<a href="javascript:void(0)" data-rec="'+data[i].reciept_no+'" class="small-box-footer users-list-name">'+data[i].cust_name+' <i class="fa fa-arrow-circle-right"></i></a>'+
                                  '</div>'+
                                '</div>' 
                              ; 
                          }
                      $('.show_reciept').html(html);
                    }
                  });
              }
        $('.show_reciept').on('click','.users-list-name',function (){
          $('input[name="auto_updated"]').val('1');
          var rec = $(this).data('rec');
          table();

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
                      var net = 0;
                      var reciept_no= '';
                      var date = '';
                      var cust = '';
                          var i;
                          for(i=0; i < data.length; i++){
                               total += parseFloat(data[i].total_price);
                               net += parseFloat(data[i].net);
                               name = data[i].names;
                               reciept_no = data[i].reciept_no; 
                               date = data[i].date;
                               cust = data[i].cust_name;
                               if(data[i].qty == 0){
                                 html += 
                                 '<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].code+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td colspan="4" style="text-align:center;"><i class="fa fa-times"></i>CANCEL ITEM ORDERS</td>'+
                                  '</tr>'
                                  ; 
                               }
                               else{
                                 html += 
                                 '<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].code+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td>'+data[i].qty+'</td>'+
                                  '<td>'+data[i].price+'</td>'+
                                  '<td>₱  '+data[i].total_price+'</td>'+
                                  '<td>₱  '+data[i].net+'</td>'+
                                 '</tr>'
                                ; 
                               }
                              
                          }
                      var vat = total * 0.12;
                      var f_total = vat + total;
                      var vats = Number((vat).toFixed(1));
                      html += 
                      '<tr><td colspan="8" style="text-align:center;">NOTHING TO FOLLOW...</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">SUB-TOTAL: </td><td>₱ '+total+'</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">TAX: </td><td>₱ '+vats+'</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">NET: </td><td>₱ '+net+'</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">TOTAL: </td><td>₱ '+f_total+'</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">CUSTOMER NAME:   '+cust+'</td><td> POS#: '+reciept_no+'</td></tr>'+
                      '<tr><td colspan="5"></td><td colspan="2">POS PROCESS BY:   '+name+'</td><td> DATE: '+date+'</td></tr>'+
                       '<tr><td colspan="5"></td><td colspan="3"><a href="<?php echo base_url(); ?>pages/print2/'+reciept_no+'" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Receipt</a> </td></tr>';
                      $('.sale_history').html(html);
                    }
                  });
        });
        $('.back_button').on('click','.back_file',function (){
          $('input[name="auto_updated"]').val('0');
          $('.back_button').html('');
          ajax_history_po();
        });

          setInterval(function(){
            var ref = $('input[name="auto_updated"]').val();
              if(ref == 0){
                ajax_history_po();
              }
        }, 2000) 
   });
</script>
  