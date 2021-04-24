
 <?php
       $id = $this->session->all_userdata();
          if(isset($id['admin_session'])){
             

  ?>
  <div  class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        HISTORY
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
            <div  class="box box-info">

            <div class="box-header with-border"> 
                      
                      <br>
                      <a style="margin-right: 2px;" href="javascript:void(0)" class="btn btn-info pull-right weekly" ><i class="fa fa-pie-chart"></i> Weekly</a>
                      <a style="margin-right: 2px;" href="javascript:void(0)" class="btn btn-info pull-right monthly" ><i class="fa fa-pie-chart"></i> Monthly</a>
                      <a style="margin-right: 2px;" href="javascript:void(0)" class="btn btn-info pull-right annual" ><i class="fa fa-pie-chart"></i> Annually</a>
                      <a style="margin-left: 2px; margin-right: 2px;" data-toggle="modal" data-target="#generates" class="btn btn-info pull-right " ><i class="fa fa-download"></i> History Reports </a>
                      <a href="javascript:void(0)" class="btn btn-default pull-right back_file"><i class="fa fa-reply"></i> </a>
                      <input style="width: 25%;" type="text" name="search" id="search" class="form-control" placeholder="Search...">            
                
            </div>

            <div  class="box-body"> 
              <div class="table-responsive">
                <div class="box-body show_reciept">
                  <!---ajax-->  
                </div>
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

      </div>
    </section>
  </div>

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
          <input type="hidden" name="id_item" >
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
       ajax_history_po();

       function ajax_history_po(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_his3',
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
                                      '<p>DATE: '+data[i].date+'</p>'+
                                      '<h5>Reciept No:'+data[i].reciept_no+'</h5>'+
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

           function ajax_history_search(){
                  var name = $('input[name="search"]').val();
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_his4',
                    type: 'post',
                    data:{name:name},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                            if(data[i].reciept_no == '0'){
                            }
                            else{
                              html += 
                               '<div class="col-lg-3 col-xs-6">'+
                                  '<div class="small-box bg-aqua">'+
                                    '<div class="inner">'+
                                      '<p>DATE: '+data[i].date+'</p>'+
                                      '<h5> Reciept No:'+data[i].reciept_no+'</h5>'+
                                    '</div>'+
                                    '<div class="icon">'+
                                      '<i class="fa fa-folder-open"></i>'+
                                    '</div>'+
                                    '<a href="javascript:void(0)" data-rec="'+data[i].reciept_no+'" class="small-box-footer users-list-name">'+data[i].cust_name+' <i class="fa fa-arrow-circle-right"></i></a>'+
                                  '</div>'+
                                '</div>' 
                              ; 
                            }
                          }
                      $('.show_reciept').html(html);
                    }
                  });
              }    

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
        $('.back_file').click(function(){
          ajax_history_po();
        });

          $('#search').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
              ajax_history_search();
            }
            else
            {
              ajax_history_po();
            }
         });

   });
 </script>