
 <?php
       $id = $this->session->all_userdata();
          if(isset($id['user_session'])){
            
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        INVENTORY RECORDS
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
            <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body">
            
                <div class="box-header with-border">
                  <h3 class="box-title title_button"></h3>
                  <div class="box-tools pull-right">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search Item Category..">
                  </div>
                </div>
                <div class="box-body item_category">
               
                </div>
            
        
            </div>
          </div>
        </div>

        <!-- <div class="col-md-4">     
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

   <script type="text/javascript">
   $(document).ready(function () {
      category();
      display_categ();
      display_btn();

      function table(){
        var table =
            '<div class="table-responsive">'+
                '<table class="table table-bordered table-striped">'+
                  '<thead>'+
                  '<tr>'+
                    '<th>#</th>'+
                    '<th>ITEMS</th>'+
                    '<th>PARTS NO.</th>'+
                    '<th>BRAND & DESCRIPTION</th>'+
                    '<th>STOCK</th>'+
                    '<th>BASED UNIT-PRICE</th>'+
                    '<th>SELLING PRICE</th>'+
                    '<th>ACTION</th>'+
                  '</tr>'+
                  '</thead>'+
                  '<tbody class="categ_item">'+
                  
                  '</tbody>'+
                '</table>'+
              '</div>';
        $('.item_category').html(table);
      }
      function display_btn(){
        var button = 
        '<a href="javascript:void(0)"  class="btn btn-success back_category" title="Back to Category"><i class="fa fa-tag"></i>View Category</a> <a href="javascript:void(0)"  class="btn btn-default show_data_list" title="Back to Category"><i class="fa fa-tag"></i> List of Items</a> <a href="<?php echo base_url(); ?>pages/print3" target="_blank" class="btn btn-default"><i class="fa fa-download"></i> Download Inventory Records</a>';
        $('.title_button').html(button);
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
    $('.title_button').on('click','.show_data_list',function (){
      var button = 
        '<a href="javascript:void(0)"  class="btn btn-default back_category" title="Back to Category"><i class="fa fa-tag"></i>View Category</a> <a href="javascript:void(0)"  class="btn btn-success show_data_list" title="Back to Category"><i class="fa fa-tag"></i> List of Items</a> <a href="<?php echo base_url(); ?>pages/print3" target="_blank" class="btn btn-default"><i class="fa fa-download"></i> Download Inventory Records</a>';
        $('.title_button').html(button);
        table();
        display_item_list();
    });

    $('.title_button').on('click','.back_category',function (){
      category();
      display_categ();
      display_btn();
    });

      $('.item_category').on('click','.list_item',function (){
        var id=$(this).data('categ');
        var name=$(this).data('name');
        table();
        var button = 
        '<a href="javascript:void(0)"  class="btn btn-success back_category" title="Back to Category"><i class="fa fa-tag"></i> '+name+'</a> <input type="hidden"  name="id_category_search" value="'+id+'">';
        $('.title_button').html(button);
        display_item();
      });

      function display_item(){
        var id = $('input[name="id_category_search"]').val();
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+                        '</td>'+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+                        '</td>'+
                      '</tr>'; 
                  }
                   
              }
                if(data.length == '0'){
                 var button = 
                    '<a href="javascript:void(0)"  class="btn btn-success back_category" title="Back to Category"><i class="fa fa-tag"></i> '+name+'</a> <input type="hidden"  name="id_category_search" value="'+id+'"> <a href="javascript:void(0)" data-id="'+id+'" class="btn btn-danger delete_category"><i class="fa fa-trash"></i> Delete Empty Category</a>';
                    $('.title_button').html(button);
                }
              $('.categ_item').html(html);
            }
        });
      }
      
      $('.title_button').on('click','.delete_category',function (){
        var id = $(this).data('id');
        $.ajax({
          url:'<?=base_url()?>index.php/pages/delete_cat',
          type: 'post',
          data:{id:id},
          dataType : "JSON",
          success: function (data) {
              category();
              display_categ();
              display_btn();
            }
        });
      });

      $('.item_category').on('click','.delete_id',function (){
        var id = $(this).data('id');
        $.ajax({
          url:'<?=base_url()?>index.php/pages/delete_item',
          type: 'post',
          data:{id:id},
          dataType : "JSON",
          success: function (data) {
              display_item_list();
            }
        });
      });

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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
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
                        '<a href="javascript:void(0)" title="Add Stock" data-base="'+data[i].base_price+'" data-price="'+data[i].price+'" data-id="'+data[i].id+'" data-name="'+data[i].name+'-'+data[i].brand+'-'+data[i].code+'" class="btn btn-success addinventory"><i class="fa fa-plus"></i></a> '+
                            '<a href="javascript:void(0)" title="View Image" data-id="'+data[i].id+'" class="btn btn-info viewItem"><i class="fa fa-binoculars"></i></a> '+
                            '<a href="javascript:void(0)" title="Upadate Picture" data-id="'+data[i].id+'" class="btn btn-warning itemPic"><i class="fa fa fa-fw fa-file-photo-o"></i></a> '+
                        '</td>'+
                      '</tr>'; 
                  }
               
              }
              $('.categ_item').html(html);
            }
        });
      }

      $('#search').keyup(function(){
            var search = $(this).val();
            if(search != '')
            {

              display_categ();
              categorysearch();
              display_btn();
            }
            else
            {
              category();
              display_categ();
              display_btn();
            }
         });


   });
 </script>