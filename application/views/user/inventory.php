
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
  <div style="background-image: linear-gradient(to  right, #616B61, white);" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="color: white;">
        Inventory
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-md-8">
          <div class="box box-info">
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
   

        <div class="col-md-4">        
          <!-- PRODUCT LIST -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">list of Products</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="newItems">
              <!--new items display ajax-->
              </div>
            </div>
            <div class="box-footer text-center">
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script type="text/javascript">
   $(document).ready(function () {
      category();
      display_categ();
      function table(){
        var table =
            '<div class="table-responsive">'+
                '<table class="table table-bordered table-striped">'+
                  '<thead>'+
                  '<tr>'+
                    '<th style="width: 8%;">Image</th>'+
                    '<th>Item</th>'+
                    '<th>Code</th>'+
                    '<th>Brand</th>'+
                    '<th>Stock</th>'+
                    '<th>Price</th>'+
                    '<th>Action</th>'+
                  '</tr>'+
                  '</thead>'+
                  '<tbody class="categ_item">'+
                  
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
      $('.title_button').html('');
    });
      $('.item_category').on('click','.list_item',function (){
        var id=$(this).data('categ');
        var name=$(this).data('name');
        table();
        var button = 
        '<a href="javascript:void(0)"  class="btn btn-success back_category" title="Back to Category"><i class="fa fa-tag"></i> '+name+'</a>';
        $('.title_button').html(button);

        $.ajax({
          url:'<?=base_url()?>index.php/pages/item_view',
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
                  '<td><img style="border:solid gray 1px; border-radius: 50%; height:7vh; width:7vh;" src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image"></td>'+
                  '<td>'+data[i].name+'</td>'+
                  '<td>'+data[i].code+'</td>'+
                  '<td>'+data[i].brand+'</td>'+
                  '<td>'+data[i].qty+'</td>'+
                  '<td>'+data[i].price+'</td>'+
                  '<td><a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" class="btn btn-info"><i class="fa fa-binoculars"></i> Item Histories</a> <a href="<?php echo base_url(); ?>pages/delete_item/'+data[i].id+'" class="btn btn-danger"> Delete Item</a></td>'+
                '</tr>'; 
                }
                else{
                  html +=
                '<tr>'+
                  '<td><img style="border:solid gray 1px; border-radius: 50%; height:7vh; width:7vh;" src="<?php echo  base_url(); ?>assets/uploadPic/'+data[i].pic+'" alt="Image"></td>'+
                  '<td>'+data[i].name+'</td>'+
                  '<td>'+data[i].code+'</td>'+
                  '<td>'+data[i].brand+'</td>'+
                  '<td>'+data[i].qty+'</td>'+
                  '<td>'+data[i].price+'</td>'+
                  '<td><a href="<?php echo base_url(); ?>pages/pageAdmin_data/individual_report/'+data[i].id+'" class="btn btn-info"><i class="fa fa-binoculars"></i> Item Histories</a></td>'+
                '</tr>'; 
                }
                    
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
              $('.title_button').html('');
            }
         });


   });
 </script>