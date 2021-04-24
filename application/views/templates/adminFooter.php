<footer class="main-footer">
   <!--  <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.18
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved. -->
  </footer>

  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- <script src="<?php echo  base_url(); ?>assets/board/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo  base_url(); ?>assets/board/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo  base_url(); ?>assets/board/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo  base_url(); ?>assets/board/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo  base_url(); ?>assets/board/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="<?php echo  base_url(); ?>assets/board/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo  base_url(); ?>assets/board/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="<?php echo  base_url(); ?>assets/board/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo  base_url(); ?>assets/board/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo  base_url(); ?>assets/board/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo  base_url(); ?>assets/board/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo  base_url(); ?>assets/board/dist/js/demo.js"></script>
<script src="<?php echo  base_url(); ?>assets/board/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
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


<script type="text/javascript">
   $(document).ready(function () {
       ajax_display_add_item();
       ajax_PO();
       ajax_process_order();
       // ajax_history_po();
       ajax_users();

        function ajax_users(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_users',
                    type: 'post',
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                            if(data[i].status == '0'){
                              html += 
                              '<tr>'+
                                '<td>'+data[i].names+'</td>'+
                                '<td>'+data[i].contact+'</td>'+
                                '<td>'+'<a><i class="fa fa-circle text-warning"></i> Require Permition</a>'+
                                '</td>'+
                                '<td>'+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'"  class="btn btn-info confirmUsers"><i class="fa fa-plus"></i> Confirm</a>'+' '+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'"  class="btn btn-danger deleteUsers"><i class="fa fa-trash"></i> Delete</a>'+
                                '</td>'+
                              '</tr>';
                            }
                            else{
                              html += 
                              '<tr>'+
                                '<td>'+data[i].names+'</td>'+
                                '<td>'+data[i].contact+'</td>'+
                                '<td>'+'<a><i class="fa fa-circle text-succcess"></i> Active</a>'+
                                '</td>'+
                                '<td>'+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'"  class="btn btn-warning refreshUser"><i class="fa fa-refresh"> De-Activate</i></a>'+
                                '</td>'+
                              '</tr>';
                            }
                         }
                      $('.users').html(html);
                    }
                  });
              }


        // function ajax_history_po(){
        //           $.ajax({
        //             url:'<?=base_url()?>index.php/pages/ajax_display_history',
        //             type: 'post',
        //             dataType : "JSON",
        //             error: function() {
        //                     alert('Something is wrongs');
        //                  },
        //             success: function (data) {
        //               var html = '';
        //                   var i;
        //                   for(i=0; i < data.length; i++){
        //                     if(i <= '9'){
        //                        html += 
        //                        '<tr>'+
        //                           '<td>'+data[i].reciept_no+'</td>'+
        //                           '<td>'+data[i].cust_name+'</td>'+
        //                           '<td>'+data[i].name+'</td>'+
        //                           '<td>'+data[i].brand+'</td>'+
        //                           '<td>'+data[i].qty+'</td>'+
        //                           '<td>₱'+data[i].net+'</td>'+
        //                           '<td>'+data[i].date+'</td>'+                                     
        //                         '</tr>'
        //                       ; 
        //                     }        
        //                   }
        //               $('.sale_history').html(html);
        //             }
        //           });
        //       }

       function ajax_PO(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_po',
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
                               
                                ' <h1><i class="fa fa-cart-arrow-down"></i> Receipt No.'+data[i].po_counter+'</h1>'+
                                 '<input type="hidden" name="po_counter" value="'+data[i].po_counter+'">'
                              ;          
                          }
                      $('.displayPO').html(html);
                    }
                  });
              }
       function ajax_button(){
              var id = $("input[name='user']").val();
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_print_button',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';

                        if(data.length == '0'){
                          html +=
                          '<label for="recipient-name" class="col-form-label pull-left">Costumer Name</label>'+
                          '<input type="text" name="name" class="form-control" required placeholder="Costumer Name:"><br>'+
                           '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
                           '<a style="font-size: 16px;" href="javascript:void(0)" class="btn btn-success purchase"><i class="fa fa-cart-arrow-down"></i> Purchase</a>'
                          ;
                        }
                        else{
                          html +='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                        }

                      $('.button_display').html(html);
                    }
                  });
              }
       function ajax_display_add_item(){
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_display_new',
                    type: 'post',
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                            if(i <= '15'){
                              if(data[i].qty == 0){
                                html += 
                                '<ul class="products-list product-list-in-box">'+
                                  '<li class="item">'+
                                    '<div class="product-img">'
                                    +'<img src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image">'+
                                    '</div>'+
                                    '<div class="product-info">'+
                                      '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="product-title view">'+data[i].name+
                                        '<span style="font-size:18px;" class="label label-info pull-right">'+'₱'+data[i].price+'</span></a>'+
                                      '<span class="product-description">'+
                                            data[i].brand+' / '+data[i].code+' / '+'<a class="btn btn-sm bg-red">'+data[i].qty+'</a>'+' Pcs'+
                                      '</span>'+
                                    '</div>'+
                                  '</li>'+
                                '</ul>'
                                  ;
                              }
                              else if(data[i].qty < 3){
                                html += 
                                '<ul class="products-list product-list-in-box">'+
                                  '<li class="item">'+
                                    '<div class="product-img">'
                                    +'<img src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image">'+
                                    '</div>'+
                                    '<div class="product-info">'+
                                      '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="product-title view">'+data[i].name+
                                        '<span style="font-size:18px;" class="label label-info pull-right">'+'₱'+data[i].price+'</span></a>'+
                                      '<span class="product-description">'+
                                            data[i].brand+' / '+data[i].code+' / '+'<a class="btn btn-sm bg-yellow">'+data[i].qty+'</a>'+' Pcs'+
                                      '</span>'+
                                    '</div>'+
                                  '</li>'+
                                '</ul>'
                                  ;
                              }
                              else{
                                html += 
                                '<ul class="products-list product-list-in-box">'+
                                  '<li class="item">'+
                                    '<div class="product-img">'
                                    +'<img src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image">'+
                                    '</div>'+
                                    '<div class="product-info">'+
                                      '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="product-title view">'+data[i].name+
                                        '<span style="font-size:18px;" class="label label-info pull-right">'+'₱'+data[i].price+'</span></a>'+
                                      '<span class="product-description">'+
                                            data[i].brand+' / '+data[i].code+' / '+'<a class="btn btn-sm bg-green">'+data[i].qty+'</a>'+' Pcs'+
                                      '</span>'+
                                    '</div>'+
                                  '</li>'+
                                '</ul>'
                                  ;
                              }
                                 
                            }
                                     
                          }
                      $('.newItems').html(html);
                    }
                  });
              }

       $('.newItems').on('click','.view',function (){
          var id = $(this).data('id');
           $('[name="id"]').val(id);
          $('#viewPic').modal('show');  
          ajax_display_pic();
        });

      function ajax_display_pic(){
                var id = $("input[name='id']").val();
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_view_image_image',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                           
                              html += 
                              '<img style="hight:350px; width:560px;" src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="No-Image">'
                              ;
                                        
                          }
                      $('.ajax_view').html(html);
                    }
                  });
              }
       function ajax_process_order(){
                var id = $("input[name='user']").val();
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_view_order',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                              
                              if(data[i].qty == 0){
                                html += 
                                '<tr>'+
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].code+'</td>'+
                                '<td>'+data[i].brand+'</td>'+
                                '<td>'+data[i].price+'</td>'+
                                '<td>₱'+data[i].price*data[i].qty+'</td>'+
                                '<td><input style="width: 80px;" type="text" name="buy_qty" class="form-control">'+
                                '<input style="width: 80px;" type="hidden" name="buy_id" class="form-control" value="'+data[i].id+'" >'+
                                '<input style="width: 80px;" type="hidden" name="buy_item" class="form-control" value="'+data[i].item_id+'" >'+
                                '</td>'+
                                '<td><a href="javascript:void(0)" class="btn btn-info buy">Buy</a>'+' '+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger delete"><i class="fa fa-trash"></i> </a>'+
                                '</td>'+
                                '</tr>'
                                ;   
                                
                              }
                              else{
                                html += 
                                '<tr>'+
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].code+'</td>'+
                                '<td>'+data[i].brand+'</td>'+
                                '<td>'+data[i].price+'</td>'+
                                '<td>₱'+data[i].price*data[i].qty+'</td>'+
                                '<td>'+data[i].qty+'</td>'+
                                '<td><a href="javascript:void(0)"data-item="'+data[i].item_id+'" data-qty="'+data[i].qty+'" data-id="'+data[i].id+'" class="btn btn-warning refresh"><i class="fa fa-refresh"></i> </a>'+
                                '</td>'+
                                '</tr>';
                              }
                                     
                          }
                      $('.order').html(html);

                    }
                  });
              }
        function ajax_view_buy(){
                var name = $("input[name='confirm_po']").val();
                var id = 'Reciept No.'+name; 
                  $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_view_print',
                    type: 'post',
                    data:{id:id},
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
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].code+'</td>'+
                                '<td>'+data[i].brand+'</td>'+
                                '<td>'+data[i].price+'</td>'+
                                '<td>'+data[i].qty+'</td>'+
                                '<td>₱'+data[i].price*data[i].qty+'</td>'+
                                '</tr>';                       
                          }
                      $('.item_buy').html(html);
                      
                    }
                  });
              }
         //delete users
        $('.users').on('click','.deleteUsers',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_delete_users',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      ajax_users();
                    }
              });
        });        

        //cancel the acceptance of user account
        
        $('.users').on('click','.refreshUser',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_refresh_users',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      ajax_users();
                    }
              });
        }); 
        //acccept Users
        $('.users').on('click','.confirmUsers',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_accept_users',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      ajax_users();
                    }
              });
        });     

        $('.order').on('click','.refresh',function (){
          var id = $(this).data('id');
          var qty = $(this).data('qty');
          var item = $(this).data('item');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_refresh_qty',
                    type: 'post',
                    data:{id:id, qty:qty, item:item},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      ajax_process_order();
                      ajax_button();
                    }
              });
        });
         $('.order').on('click','.delete',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_delete_qty',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    error: function() {
                            alert('Something is wrongs');
                         },
                    success: function (data) {
                      ajax_process_order();
                    }
              });
        });
        $('.order').on('click','.buy',function (){
         var qty = $("input[name='buy_qty']").val();
         var id = $("input[name='buy_id']").val();
         var item = $("input[name='buy_item']").val();

           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_buy',
                    type: 'post',
                    data:{id:id, qty:qty, item:item},
                    dataType : "JSON",
                    error: function() {
                            alert('Not Enough Stock');
                            $('[name="buy_qty"]').val("");
                         },
                    success: function (data) {
                      ajax_process_order();
                      ajax_button();
                    }
              });
        });
        $('.button_display').on('click','.purchase',function (){
         var name = $("input[name='name']").val();
         var po_counter = $("input[name='po_counter']").val();
         var user = $("input[name='user']").val();
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_buy_confirm',
                    type: 'post',
                    data:{name:name, po_counter:po_counter, user:user},
                    dataType : "JSON",
                    error: function() {
                         
                         },
                    success: function (data) {
                       $('[name="confirm_po"]').val(po_counter);
                       ajax_process_order();
                       $('#cart').modal('hide');
                       $('#print').modal('show');
                       ajax_view_buy();  
                    }
              });
        });

         $('.item_category').on('click','.viewItem',function (){
          var id = $(this).data('id');
          $('[name="id"]').val(id);
          $('#viewPic').modal('show');  
          ajax_display_pic();
        });

        $('.generateIndiReport').click(function(){
          var id = $("input[name='id_item']").val();
          var start = $("input[name='start']").val();
          var end = $("input[name='end']").val();
          $('[name="id_item1"]').val(id);
          $('[name="start1"]').val(start);
          $('[name="end1"]').val(end);
          $('#reportIndividual').modal('show');
          $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/individual_report_item')?>",
                dataType : "JSON",
                data : {id:id, start:start, end:end},
                error:function(){
                  alert('Error');
                  },
                success: function(data){
                    var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                                html += 
                                '<tr>'+
                                  '<td>P.O#'+data[i].reciept_no+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td>'+data[i].qty+'</td>'+
                                  '<td>₱'+data[i].net+'</td>'+
                                  '<td>'+data[i].date+'</td>'+
                                '</tr>'
                                ;                       
                          }
                      $('.item_indi_report').html(html);
                }
            });  

     });

    $('.generate_records').click(function(){
          var starts = $("input[name='date1']").val();
          var ends = $("input[name='date2']").val();
          $('[name="start2"]').val(starts);
          $('[name="end2"]').val(ends);
          $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/alldividual_report_item')?>",
                dataType : "JSON",
                data : {starts:starts, ends:ends},
                error:function(){
                  alert('Error');
                  },
                success: function(data){
                    var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                            if(data[i].reciept_no == 0){
                              html += 
                                '<tr>'+
                                  '<td>'+data[i].cust_name+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td>'+data[i].qty+'</td>'+
                                  '<td>₱'+data[i].net+'</td>'+
                                  '<td>'+data[i].date+'</td>'+
                                '</tr>'
                                ; 
                            }
                            else{
                               html += 
                                '<tr>'+
                                  '<td>'+data[i].reciept_no+'</td>'+
                                  '<td>'+data[i].name+'</td>'+
                                  '<td>'+data[i].brand+'</td>'+
                                  '<td>'+data[i].qty+'</td>'+
                                  '<td>₱'+data[i].net+'</td>'+
                                  '<td>'+data[i].date+'</td>'+
                                '</tr>'
                                ;                       
                            }
                               
                          }
                      $('.item_all_report').html(html);
                }
            });  
    });

    $('.generateAllReport').click(function(){
          $('#reportAlldividual').modal('show');    
    });

        $('.monthly').click(function(){
          $('#monthly').modal('show');  
        });
        $('.annual').click(function(){
          $('#annual').modal('show');  
        });
        $('.weekly').click(function(){
          $('#weekly').modal('show');  
        });
        
        $('.item_category').on('click','.addinventory',function (){
        //$('.addinventory').click(function(){
          var id = $(this).data('id');
          var name =$(this).data('name');
          var base =$(this).data('base');
          var price =$(this).data('price');
          $('[name="id_add"]').val(id);
          $('[name="itemname"]').val(name);
          $('[name="base_priceAdd"]').val(base);
          $('[name="priceAdd"]').val(price);
          $('#addstock').modal('show'); 
        });
        //para mag add ng new stock
        $('.addStock').click(function(){
          var id = $("input[name='id_add']").val();
          var qty = $("input[name='qtyAdd']").val();
          var inv = $("input[name='invoice']").val();
          var base = $("input[name='base_priceAdd']").val();
          var sale = $("input[name='priceAdd']").val();
          var date = $("input[name='dateAdd']").val();
          var ibuy = $("input[name='ibuy']").val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/addStock')?>",
                dataType : "JSON",
                data : {id:id, qty:qty, inv:inv, base:base, sale:sale, date:date, ibuy:ibuy},
                error:function(){
                  alert('Error Please Complete all the Input Fields');
                  },
                success: function(data){
                   
                   $('#addstock').modal('hide');
                   $('[name="id_add"]').val("");
                   $('[name="qtyAdd"]').val("");
                   $('[name="invoice"]').val("");
                   $('[name="base_priceAdd"]').val("");
                   $('[name="priceAdd"]').val("");
                   $('[name="dateAdd"]').val("");
                   $('[name="ibuy"]').val("");
                   // ajax_display_add_item();
                   display_item2();
                   swal("Process Successful!", "Add Stock", "success");
                }
            }); 
        });
        function display_item2(){
        var id = $('input[name="id_category_search"]').val();
        if(!id ){
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
               if(data[i].qty == '0'){
                     html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-danger">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                            '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger delete_id"><i class="fa fa-times"></i> Delete Item</a>'+
                        '</td>'+
                      '</tr>'; 
                  }
                else if(data[i].qty <= 10){
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-warning">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
                else if(data[i].qty <= 20){
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-info">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
                else{
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-success">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
               
              }
              $('.categ_item').html(html);
            }
        });
        }
        else{
          $.ajax({
          url:'<?=base_url()?>index.php/pages/item_view2',
          type: 'post',
          data:{id:id},
          dataType : "JSON",
          error: function() {
            alert('Something is wrongs');
          },
          success: function (data) {
            var html = '';
            var i;
              for(i=0; i < data.length; i++){ 
                if(data[i].qty == '0'){
                     html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-danger">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                            '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger delete_id"><i class="fa fa-times"></i> Delete Item</a>'+
                        '</td>'+
                      '</tr>'; 
                  }
                else if(data[i].qty <= 10){
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-warning">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
                else if(data[i].qty <= 20){
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-info">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
                else{
                    html +=
                      '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td><a class="btn btn-success">'+data[i].qty+' pcs/set</a></td>'+
                        '<td>₱'+data[i].base_price+'</td>'+
                        '<td>₱'+data[i].price+'</td>'+
                        '<td>'+
                        '<a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" target="_blank" class="btn btn-default"><i class="fa fa-folder-open" title="VIEW RECORDS"></i></a> '+
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                            '<a href="javascript:void(0)" title="Edit Item Information" data-id="'+data[i].id+'"  data-item="'+data[i].name+'" data-code="'+data[i].code+'" data-brand="'+data[i].brand+'" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" class="btn btn-danger edit_item"><i class="fa fa-edit"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  } 
              }
              $('.categ_item').html(html);
            }
        });
        }

        
      }
        //show edit
        $('.item_category').on('click','.edit_item',function (){
        //$('.edit_item').click(function(){
          var id = $(this).data('id');
          var item =$(this).data('item');
          var code =$(this).data('code');
          var brand =$(this).data('brand');
          var base =$(this).data('base'); 
          var price =$(this).data('price');
          $('[name="edit_id"]').val(id);
          $('[name="edit_name"]').val(item);
          $('[name="edit_code"]').val(code);
          $('[name="edit_brand"]').val(brand);
          $('[name="edit_base"]').val(base);
          $('[name="edit_price"]').val(price);
          $('#edit_item').modal('show'); 
        });
        //edit item
        $('.confirm_edit').click(function(){
          var id = $("input[name='edit_id']").val();
          var name = $("input[name='edit_name']").val();
          var code = $("input[name='edit_code']").val();
          var brand = $("input[name='edit_brand']").val();
          var base = $("input[name='edit_base']").val();
          var price = $("input[name='edit_price']").val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/editItem')?>",
                dataType : "JSON",
                data : {id:id, name:name, code:code, brand:brand, base:base, price:price},
                error:function(){
                  alert('Error');
                  },
                success: function(data){
                   swal("Process Successful!", "Edit Information Successful", "success");
                   $('#edit_item').modal('hide');
                   $('[name="edit_id"]').val("");
                   $('[name="edit_name"]').val("");
                   $('[name="edit_code"]').val("");
                   $('[name="edit_brand"]').val("");
                   $('[name="edit_base"]').val("");
                   $('[name="edit_price"]').val("");
                  //ajax_display_add_item();
                    display_item2();
                }
            }); 
        });
        $('.item_category').on('click','.itemPic',function (){edit_item
          var id = $(this).data('id');
          $('[name="item_profile"]').val(id);
          $('#updatePic').modal('show'); 
        });

        $('.updatePass').click(function(){
          var id = $("input[name='userIDs']").val();
          $('#usernamePass').modal('show');
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/ajax_update_show')?>",
                dataType : "JSON",
                data : {id:id},
                error:function(){
                  alert('Error');
                  },
                success: function(data){
                  var html = '';
                          var i;
                          for(i=0; i < data.length; i++){
                                html += 
                                '<label for="recipient-name" class="col-form-label pull-left">Username:</label>'+
                                '<input type="text" class="form-control" name="usernames" value="'+data[i].username+'">'+
                                '<label for="recipient-name" class="col-form-label pull-left">Password:</label>'+
                                '<input type="text" class="form-control" name="passwords" value="">'
                                ;                       
                          }
                  
                   $('.displayUserPass').html(html);
                 }
            }); 
        });
        show_replacement();
         function show_replacement(){
           $.ajax({
              url:'<?=base_url()?>index.php/pages/historyReplacement',
              type: 'POST',
              dataType : "JSON",
              error: function() {
                      alert('Records Error');
                   },
              success: function (data) {
                var html = '';
                  for(i=0; i<data.length; i++){
                      html +=
                      '<tr>'+
                        '<td>Receipt No:'+data[i].po+'</td>'+
                        '<td>'+data[i].cust_name+'</td>'+
                        '<td>'+data[i].date+'</td>'+
                        '<td>'+data[i].item+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td>'+data[i].qty+'</td>'+
                        '<td><a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-info replacementDetail">Details</a>'+' '+
                        '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-warning replacementDelete" title="Delete Records"><i class="fa fa-times"></i> Delete</a>'+
                        '</td>'+
                        
                      '</tr>';
                    }
                $('.replacment').html(html);
              }
            });
        }

        $('.replacment').on('click','.replacementDelete',function (){
          var id = $(this).data('id');
            $.ajax({
              url:'<?=base_url()?>index.php/pages/ajax_rep_delete',
              type: 'POST',
              data:{id:id},
              dataType : "JSON",
              error: function() {
                      alert('Error Delete');
                   },
              success: function (data) {
                show_replacement();
                ajax_display_add_item();
              } 
            });
        });

         $('.replacment').on('click','.replacementDetail',function (){
          var id = $(this).data('id');
          $('#replacementInfo').modal('show');
            $.ajax({
              url:'<?=base_url()?>index.php/pages/ajax_rep_detail',
              type: 'POST',
              data:{id:id},
              dataType : "JSON",
              error: function() {
                      alert('Records Error');
                   },
              success: function (data) {
                var html = '';
                  for(i=0; i<data.length; i++){
                      html +=
                      '<p style="font-size:20px;">PROCESS BY: <b>'+data[i].process+'</b> | DATE: <b>'+data[i].date+'</b>| REASON <b>'+data[i].issue+'</b>  </p>';
                    }
                $('.displayInfo').html(html);
              }
            });
        });
        function show_history(){
          var name = $("input[name='searchHistory']").val();
           $.ajax({
              url:'<?=base_url()?>index.php/pages/searchHistory',
              type: 'POST',
              data:{name:name},
              dataType : "JSON",
              error: function() {
                      alert('Display Errors');
                   },
              success: function (data) {
                var html = '';
                  for(i=0; i<data.length; i++){
                    if(data[i].status == '0'){
                      html +=
                      '<tr>'+
                        '<td>Receipt No.'+data[i].reciept_no+'</td>'+
                        '<td>'+data[i].cust_name+'</td>'+
                        '<td>'+data[i].date+'</td>'+
                        '<td>'+data[i].name+'</td>'+
                        '<td>'+data[i].code+'</td>'+
                        '<td>'+data[i].brand+'</td>'+
                        '<td>'+data[i].qty+'</td>'+
                        '<td><a href="javascript:void(0)" data-id="'+data[i].id+'" data-item="'+data[i].item_id+'" data-po="'+data[i].reciept_no+'" data-name="Receipt No:'+data[i].reciept_no+' '+data[i].name+'-'+data[i].brand+' - '+data[i].code+'(qty: '+data[i].qty+')" data-item_name="'+data[i].name+'" data-brand="'+data[i].brand+'" data-code="'+data[i].code+'" data-qty="'+data[i].qty+'" data-price="'+data[i].price+'" data-basic="'+data[i].basic_total+'" class="btn btn-danger replacement" title="Process"><i class="fa fa-warning"></i></a></td>'+
                      '</tr>';
                    }

                    }
                $('.replacment').html(html);
              }
            });
        }
        $('.replacment').on('click','.replacement',function (){
          var qty = $(this).data('qty');
          var price = $(this).data('price');
          var basic = $(this).data('basic');
          var item_id = $(this).data('item');
          var id = $(this).data('id');
          var name = $(this).data('name');
          var item = $(this).data('item_name');
          var brand = $(this).data('brand');   
          var code = $(this).data('code');
          var po = $(this).data('po');
          $('[name="rep_qty_old"]').val(qty);
          $('[name="rep_price"]').val(price);
          $('[name="rep_ttl"]').val(basic);
          $('[name="rep_po"]').val(po);
          $('[name="history_po_id"]').val(id);
          $('[name="itemnameReplace"]').val(name);
          $('[name="rep_item_id"]').val(item_id);
          $('[name="rep_item"]').val(item);
          $('[name="rep_brand"]').val(brand);
          $('[name="rep_code"]').val(code);
          $('#replacementForm').modal('show')
        });

        $('.confirm_replace').click(function(){
          var id = $("input[name='history_po_id']").val();
          var transac = $("input[name='process_by']").val();
          var item_id = $("input[name='rep_item_id']").val();
          var name = $("input[name='rep_name']").val();
          var qty = $("input[name='rep_qty']").val();
          var issue = $("textarea[name='issue']").val();
          var item = $("input[name='rep_item']").val();
          var brand = $("input[name='rep_brand']").val();
          var code = $("input[name='rep_code']").val();
          var po = $("input[name='rep_po']").val();

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/ajax_replace')?>",
                dataType : "JSON",
                data : {id:id, transac:transac, item_id:item_id, name:name, qty:qty, issue:issue, item:item, brand:brand, code:code, po:po},
                error:function(){
                  alert('Require all fuild to fill up or Wrong Qty');
                    $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  },
                success: function(data){
                  show_replacement();
                  $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  $('#replacementForm').modal('hide');
                  ajax_display_add_item();
                 }
            }); 
        });

        $('.confirm_cancel_ng').click(function(){
          var id = $("input[name='history_po_id']").val();
          var transac = $("input[name='process_by']").val();
          var item_id = $("input[name='rep_item_id']").val();
          var name = $("input[name='rep_name']").val();
          var qty = $("input[name='rep_qty']").val();
          var issue = $("textarea[name='issue']").val();
          var item = $("input[name='rep_item']").val();
          var brand = $("input[name='rep_brand']").val();
          var code = $("input[name='rep_code']").val();
          var po = $("input[name='rep_po']").val();
          var rep_qty = $("input[name='rep_qty_old']").val();
          var rep_price = $("input[name='rep_price']").val();
          var rep_tbp = $("input[name='rep_ttl']").val();
          
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/ajax_cancel_ng')?>",
                dataType : "JSON",
                data : {id:id, transac:transac, item_id:item_id, name:name, qty:qty, issue:issue, item:item, brand:brand, code:code, po:po, rep_qty:rep_qty, rep_price:rep_price, rep_tbp: rep_tbp},
                error:function(){
                  alert('Require all fuild to fill up or Wrong Qty');
                  $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  },
                success: function(data){
                  show_replacement();
                  $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  $('#replacementForm').modal('hide');
                  ajax_display_add_item();
                 }
            }); 
        });

         $('.confirm_cancel_g').click(function(){
          var id = $("input[name='history_po_id']").val();
          var transac = $("input[name='process_by']").val();
          var item_id = $("input[name='rep_item_id']").val();
          var name = $("input[name='rep_name']").val();
          var qty = $("input[name='rep_qty']").val();
          var issue = $("textarea[name='issue']").val();
          var item = $("input[name='rep_item']").val();
          var brand = $("input[name='rep_brand']").val();
          var code = $("input[name='rep_code']").val();
          var po = $("input[name='rep_po']").val();
          var rep_qty = $("input[name='rep_qty_old']").val();
          var rep_price = $("input[name='rep_price']").val();
          var rep_tbp = $("input[name='rep_ttl']").val();

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('pages/ajax_cancel_g')?>",
                dataType : "JSON",
                data : {id:id, transac:transac, item_id:item_id, name:name, qty:qty, issue:issue, item:item, brand:brand, code:code, po:po, rep_qty:rep_qty, rep_price:rep_price, rep_tbp: rep_tbp},
                error:function(){
                  alert('Require all fuild to fill up or Wrong Qty');
                  $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  },
                success: function(data){
                  show_replacement();
                  $('[name="process_by"]').val('');
                  $('[name="rep_name"]').val('');
                  $('[name="rep_qty"]').val('');
                  $('[name="issue"]').val('');
                  $('#replacementForm').modal('hide');
                  ajax_display_add_item();
                 }
            }); 
        });

       $('#searchHistory').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {
              show_history();
            }
            else
            {
              show_replacement();
            }
         });


        setInterval(function(){
          ajax_history_po();
          ajax_PO();
          ajax_display_add_item();
        }, 2000) 
 });
</script>

