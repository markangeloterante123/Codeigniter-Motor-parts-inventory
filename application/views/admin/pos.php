
  <?php
       $id = $this->session->all_userdata();
          if(isset($id['admin_session'])){
              $user=$id['admin_session'];

  ?>

    <style>
* {
  box-sizing: border-box;
}

/*body {
  margin: 0;
  font-family: Arial;
}*/

.header {
  text-align: center;
  padding: 32px;
}

.rowss {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.columnss {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;

}

.columnss img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}


/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .columnss {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .columnss {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}
</style>

  <div  class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        POINT OF SALES
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">POS</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <!-- <a data-toggle="modal" data-target="#cart" class="btn btn-danger"><h1 class="box-title"><i class="fa fa-cart-plus"></i> Cart Process</h1></a>  -->
                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                    <h3 class="box-title title_button"></h3>
                    <div class="box-tools pull-right">
                      <input type="text" name="search" id="search" class="form-control" placeholder="Search Item Category..">
                    </div>
                </div>
                  <!-- /.box-header -->
                  <div class="box-body item_category">
                    
              </div>
          </div>
        </div>
  
        <div class="col-md-4">
            <div class="box">
              <div class="table-responsive  process_table">
                
              </div>
          </div>
        </div>
      </div>
      

    </section>
  </div>

<?php } ?>
 
 <script type="text/javascript">
   $(document).ready(function () {
      category();
      display_categ();
      view_orders_display();

      function view_orders_display(){
          var table = 
                '<table class="table table-bordered table-striped">'+
                    '<thead>'+
                    '<tr>'+
                      '<th>ITEM</th>'+
                      '<th>BRAND & DESCRIPTION</th>'+
                      '<th>ACTION</th>'+
                    '</tr>'+
                   '</thead>'+
                    '<tbody class="view_order_process">'+                      
                    '</tbody>'+
                '</table>';
          $('.process_table').html(table);

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
                              html += 
                                '<tr>'+
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].code+'  '+data[i].brand+'</td>'+
                                '<td>'+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger delete" title="REMOVE"><i class="fa fa-times"></i> </a>'+
                                '</td>'+
                                '</tr>'
                                ;               
                          }
                      if(data.length >= '1'){
                        html +=
                          '<tr><td colspan="3"><a href="javascript:void(0)" class="btn btn-info process_pos"><i class="fa fa-check"></i> Process POS</a></td></tr>';
                      }   
                      $('.view_order_process').html(html);
                    }
                  });
              }

       $('.process_table').on('click','.delete',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_delete_qty',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    success: function (data) {
                      view_orders_display();
                    }
              });
        });
       $('.item_category').on('click','.delete',function (){
          var id = $(this).data('id');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_delete_qty',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    success: function (data) {
                      POS_process();
                      ajax_button();
                    }
              });
        });
       $('.item_category').on('click','.refresh',function (){
          var id = $(this).data('id');
          var qty = $(this).data('qty');
          var item = $(this).data('item');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_refresh_qty',
                    type: 'post',
                    data:{id:id, qty:qty, item:item},
                    dataType : "JSON",
                    success: function (data) {
                      POS_process();
                      POS_info();
                      ajax_button();
                    }
              });
        });

       $('.item_category').on('click','.buy',function (){
         var qty = $("input[name='buy_qtys']").val();
         var id = $(this).data('buy_id');
         var item = $(this).data('buy_item');
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_buy',
                    type: 'post',
                    data:{id:id, qty:qty, item:item},
                    dataType : "JSON",
                    error: function() {
                            swal("Process Un-Successful!", "Not Enough Stock / Complete the Process of Leading Item", "warning");
                            $('[name="buy_qty"]').val("");
                            POS_process();
                         },
                    success: function (data) {

                      POS_process();
                      POS_info();
                      ajax_button();
                    }
              });
        });

       $('.process_table').on('click','.process_pos',function (){
         table2();
         var button = 
        '<a href="javascript:void(0)"  class="btn btn-info back_category" title="Back to Category"><i class="fa fa-arrow-left"></i> BACK</a>';
        $('.title_button').html(button);
        POS_process(); 
        POS_info();
        ajax_button();
      });

        $('.process_table').on('click','.purchase',function (){
         var name = $("input[name='name_po']").val();
         var po_counter = $("input[name='po_counter']").val();
         var user = $("input[name='user']").val();
         var po = 0; 
          if(po_counter <= 9){
            po = '0000'+po_counter;
          }
          else if(po_counter <= 99){
            po = '000'+po_counter;
          }
          else if(po_counter <= 999){
            po = '00'+po_counter;
          }
          else if(po_counter <= 9999){
            po = '0'+po_counter;
          }
          else{
            po = po_counter;
          }
           $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_buy_confirm',
                    type: 'post',
                    data:{name:name, po_counter:po_counter, user:user},
                    dataType : "JSON",
                    error: function() {
                          swal("Process Un-Successful!", "Not Enough Stock / Complete the Process of Leading Item", "warning");
                         },
                    success: function (data) {
                        category();
                        display_categ();
                        view_orders_display();
                        $('.title_button').html('');
                        swal("Process Successful!", "Printed Receipt", "success");
                        window.open("<?php echo base_url(); ?>pages/print2/"+po+"","blank");
                    }
              });
        });

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
                          '<td><a style="font-size: 16px;" href="javascript:void(0)" class="btn btn-info purchase"><i class="fa fa-cart-arrow-down"></i> POS Process Confirm</a</td>';
                        }
                      $('.btn_purchase').html(html);
                    }
                  });
              }

      function POS_info(){
        var id = $("input[name='user']").val();
        var table = 
                '<table class="table table-bordered table-striped">'+
                    '<thead>'+
                    '<tr class="sub_total"></tr>'+
                    '<tr><th>VAT:  12%</th></tr>'+
                    '<tr class="vat_total"></tr>'+
                    '<tr class="total_total"></tr>'+
                    '<tr class="date_total"></tr>'+
                   '</thead>'+
                    '<tbody>'+
                      '<tr><td><input type="text" class="form-control" name="name_po" placeholder="Customer Name:"></tr>'+
                      '<tr class="btn_purchase"></tr>'+
                    '</tbody>'+
                '</table>';
               
          $('.process_table').html(table);
         $.ajax({
                    url:'<?=base_url()?>index.php/pages/ajax_view_order',
                    type: 'post',
                    data:{id:id},
                    dataType : "JSON",
                    success: function (data) {
                      var html = '';
                      var sub = 0;
                      var date = '';
                      var btn = '';
                          var i;
                          for(i=0; i < data.length; i++){
                            var num = data[i].price * data[i].qty;
                            sub += parseFloat(num);
                            date = data[i].date;
                          }
                      var sub_d = '<th> SUB-TOTAL: ₱ '+sub+'</th>';
                      var vat = 0.12 * sub;
                      var vats = Number((vat).toFixed(1));
                      var vat_d = '<th> VAT: ₱ '+vats+'</th>';
                      var total = sub + vats;
                      var total_d = '<th> TOTAL: ₱ '+total+'</th>';
                      var date_d = '<th> DATE: '+date+'</th>';
                      $('.sub_total').html(sub_d);
                      $('.vat_total').html(vat_d);
                      $('.total_total').html(total_d);
                      $('.date_total').html(date_d);
                    }
                  });
      }

      function POS_process(){

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
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+data[i].name+'</td>'+
                                '<td>'+data[i].code+'</td>'+
                                '<td>'+data[i].brand+'</td>'+
                                '<td>₱'+data[i].price+'</td>'+
                                '<td>₱'+data[i].price*data[i].qty+'</td>'+
                                '<td><input style="width: 50px;" type="text" name="buy_qtys" class="form-control">'+
                                '</td>'+
                                '<td><a href="javascript:void(0)" data-buy_id="'+data[i].id+'" data-buy_item="'+data[i].item_id+'" class="btn btn-info buy">Buy</a>'+' '+
                                '<a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger delete"><i class="fa fa-times"></i> </a>'+
                                '</td>'+
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
                                '<td>₱'+data[i].price+'</td>'+
                                '<td>₱'+data[i].price*data[i].qty+'</td>'+
                                '<td>'+data[i].qty+'</td>'+
                                '<td><a href="javascript:void(0)"data-item="'+data[i].item_id+'" data-qty="'+data[i].qty+'" data-id="'+data[i].id+'" class="btn btn-warning refresh"><i class="fa fa-refresh"></i> </a>'+
                                '</td>'+
                                '</tr>';
                              }
                                     
                          }
                      $('.item_display').html(html);

                    }
                  });
      }

      function table(){
        var table =
            '<div class="table-responsive">'+
                '<table class="table table-bordered table-striped">'+
                  '<thead>'+
                  '<tr>'+
                    '<th style="width: 8%;">IMAGE</th>'+
                    '<th>ITEMS</th>'+
                    '<th>PARTS NO.</th>'+
                    '<th>BRAND & DESCRIPTION</th>'+
                    '<th>STOCK</th>'+
                    '<th>PRICE</th>'+
                    '<th>ACTION</th>'+
                  '</tr>'+
                  '</tr>'+
                  '</thead>'+
                  '<tbody class="categ_item">'+
                  
                  '</tbody>'+
                '</table>'+
              '</div>';
        $('.item_category').html(table);
      }

      function table2(){
        var table =
            '<div class="table-responsive">'+
                '<table class="table table-bordered table-striped">'+
                  '<thead>'+
                  '<tr>'+
                    '<th>#</th>'+
                    '<th>ITEMS</th>'+
                    '<th>PARTS NO.</th>'+
                    '<th>BRAND & DESCRIPTION</th>'+
                    '<th>U-PRICE</th>'+
                    '<th style="width:15px;">TOTAL</th>'+
                    '<th style="width:15px;">QTY</th>'+
                    '<th>ACTION</th>'+
                  '</tr>'+
                  '</tr>'+
                  '</thead>'+
                  '<tbody class="item_display">'+
                  
                  '</tbody>'+
                '</table>'+
              '</div>';
        $('.item_category').html(table);
      }

      function display_categ(){
        var display = 
          ' <div class="rowss">'+ 
          '</div>';
        $('.item_category').html(display);
      }
      function category(){

        $.ajax({
          url:'<?=base_url()?>index.php/pages/view_categ',
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
                '<div class="columnss">'+
                  '<a href="javascript:void(0)" data-name="'+data[i].category_name+'" data-categ="'+data[i].category_id+'" class="list_item"><img src="<?php echo base_url(); ?>assets/category/'+data[i].images+'" style="width:100%"></a>'+
                  '<div style="background:black; color:white" class="centered">'+data[i].category_name+'</div>'+
                '</div>';     
              }
              $('.rowss').html(html);
            }
        });
      }

      function categorysearch(){
        var name = $('input[name="search"]').val();
        $.ajax({
          url:'<?=base_url()?>index.php/pages/view_categ',
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
                html +=
                '<div class="columnss">'+
                  '<a href="javascript:void(0)" data-name="'+data[i].category_name+'" data-categ="'+data[i].category_id+'" class="list_item"><img src="<?php echo base_url(); ?>assets/category/'+data[i].images+'" style="width:100%"></a>'+
                  '<div style="background:black; color:white" class="centered">'+data[i].category_name+'</div>'+
                '</div>';     
              }
              $('.rowss').html(html);
            }
        });
      }


    $('.title_button').on('click','.back_category',function (){
      category();
      display_categ();
      view_orders_display();
      $('.title_button').html('');
    });
      $('.item_category').on('click','.list_item',function (){
        var id=$(this).data('categ');
        var name=$(this).data('name');
        var user=$('input[name="user"]').val();
        table();
        var button = 
        '<a href="javascript:void(0)"  class="btn btn-info back_category" title="Back to Category"><i class="fa fa-times"></i> '+name+'</a>';
        $('.title_button').html(button);

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
                html +=
                '<tr>'+
                  '<td><img style="border:solid gray 1px; border-radius: 50%; height:7vh; width:7vh;" src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image"></td>'+
                  '<td>'+data[i].name+'</td>'+
                  '<td>'+data[i].code+'</td>'+
                  '<td>'+data[i].brand+'</td>'+
                  '<td>'+data[i].qty+'</td>'+
                  '<td>₱'+data[i].price+'</td>'+
                  '<td><a href="<?php echo base_url(); ?>pages/addcart/'+data[i].id+'/'+user+' ?>" class="btn btn-block btn-success"><i class="fa fa-plus"></i> </a></td>'+
                '</tr>';     
              }
              $('.categ_item').html(html);
            }
        });

      });

      $('#search').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {

              display_categ();
              categorysearch();
              $('.title_button').html('');
            }
            else
            {
              category();
              display_categ();
            }
         });


   });
 </script> 