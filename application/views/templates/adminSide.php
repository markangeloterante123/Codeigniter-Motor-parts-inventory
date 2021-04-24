 <?php
       $id = $this->session->all_userdata();
          if(isset($id['admin_session'])){
              $user=$id['admin_session'];

  ?>
      
      <ul class="sidebar-menu" data-widget="tree">
       
       <li>
          <a href="<?php echo base_url(); ?>pages/pageAdmin/admin"><i class="fa fa-dashboard"></i><span>LATEST POS ORDER</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/pos"><i class="fa fa-shopping-cart"></i><span>POS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/rec"><i class="fa fa-list"></i><span>INVENTORY RECORDS</span></a>
        </li>  
       <!--  <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/inventory"><i class="fa fa- fa-cubes"></i><span>Items</span></a>
        </li> -->
        <li>
            <a data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i><span>NEW ITEM</span></a>
        </li>
        <li>
            <a data-toggle="modal" data-target="#add_category"><i class="fa fa-tag"></i><span>NEW CATEGORY</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/rep"><i class="fa fa-warning"></i><span>REPLACEMENT RECORDS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin/his"><i class="fa fa-archive"></i><span>HISTORY</span></a>
        </li>
      
        <li>
            <a href="<?php echo base_url(); ?>pages/pageAdmin2/si"><i class="fa fa-calendar"></i><span>SALES INVOICE RECORDS</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageGrap/grap"><i class="fa fa-pie-chart"></i><span>STATISTICS</span></a>
        </li>
      
        
                    
        <li class="treeview">
          <a href="#">
            <i class="fa fa-reorder "></i>
            <span>ACCOUNTS</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">2</span>
            </span>
          </a>
          <ul class="treeview-menu">
             <li><a href="<?php echo base_url(); ?>pages/pageAdmin/us"><i class="fa fa-user-plus"></i>ADD USERS</a></li>
             <li><a href="javascript:void(0)" class="updatePass" ><i class="fa fa-users "></i>PASSWORD & USERNAME</a></li>
          </ul>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/logout"><i class="fa fa-sign-out"></i><span>SIGN OUT</span></a>
        </li>


      </ul>
    </section>
  </aside>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New Items </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url(); ?>pages/addnewitems" method="post" enctype="multipart/form-data" id="upload_form">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Item Name</label>
            <input type="text" class="form-control" name="item" id="item" required>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Item Brand & Description</label>
            <input type="text" class="form-control" name="brand" id="brand" required>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Item Parts No.</label>
            <input type="text" class="form-control" name="code" id="code" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Unit-Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="base_price" id="base_price" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Selling Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="price" id="price" >
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category</label>
            <select type="text" class="form-control" name="category" id="category" required>
              <?php
                $table="tbl_category";
                foreach ($this->load->model_users->data1($table) as  $value) {
                  $id = $value->category_id;
                  $name = $value->category_name;
              ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">QTY</label>
            <input type="text" class="form-control" name="qty" id="qty" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image</label>
            <input  type="file" id="image_file" class="form-control" name="image_file"/>
          </div>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Submit">
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="viewPic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Items</h5>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
        <div class="ajax_view">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <div class="displayPO">
           
         </div>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
          <div class="box">
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Item</th>
                  <th>Code</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Qty Order</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody class="order">
                
                </tbody>
              </table>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        
        <div class="button_display">
        
        </div>
        
      </div>
    </div>
  </div>
</div>
<!--for print-->
<div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Print</h2>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url(); ?>pages/print" method="post">
              <input type="hidden" name="confirm_po" value="">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Item</th>
                  <th>Code</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody class="item_buy">
                
                </tbody>
              </table>
            </div>
            <div>
              <input type="submit" class="btn btn-warning pull-right" value="Print Official Reciept">
            </div>
            </form>
          </div>
      </div>
      <div class="modal-footer">
        
        <div class="">
        
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportIndividual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Individual Item Report</h2>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url(); ?>pages/indi_report_item" method="post">
              <input type="hidden" name="id_item1" value="">
              <input type="hidden" name="start1" value="">
              <input type="hidden" name="end1" value="">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>P.O#</th>
                  <th>Item</th>
                  <th>Brand</th>
                  <th>Qty Sell</th>
                  <th>Revenue</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody class="item_indi_report">
                
                </tbody>
              </table>
            </div>
            <div>
              <input type="submit" class="btn btn-warning pull-right" value="Generates Report">
            </div>
            </form>
          </div>
      </div>
      <div class="modal-footer">
        
        <div class="">
        
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reportAlldividual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2>History Records</h2>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url(); ?>pages/all_report_item" method="post">
              <input type="hidden" name="start2" value="">
              <input type="hidden" name="end2" value="">
              <label for="recipient-name" class="col-form-label">Date Start</label>
              <input type="date" class="form-control " name="date1" required>
              <label for="recipient-name" class="col-form-label">Date End</label>
              <input type="date" class="form-control" name="date2" required>
              <br>
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Item</th>
                  <th>Brand</th>
                  <th>Qty Sell</th>
                  <th>Revenue</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody class="item_all_report">
                
                </tbody>
              </table>
            </div>
            <div>
              <a href="javascript:void(0)" class="btn btn-info generate_records" >Reports</a>
              <input type="submit" class="btn btn-warning pull-right" value="Generates Report">
            </div>
            </form>
          </div>
      </div>
      <div class="modal-footer">
        
        <div class="">
        
        </div>
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addstock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title " id="exampleModalLabel"><input style="font-size: 18px; border: none;" type="text" name="itemname" disabled="disabled"></h5>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id_add">

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">QTY:</label>
            <input type="text" class="form-control" name="qtyAdd" id="qtyAdd" required>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sales Invoice:</label>
            <input type="text" class="form-control" name="invoice" id="invoice" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="base_priceAdd" id="base_priceAdd" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Selling Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="priceAdd" id="priceAdd" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sold By</label>
            <input type="text" class="form-control" placeholder="Where I buy" name="ibuy" id="ibuy" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date Received</label>
            <input type="Date" class="form-control" name="dateAdd" id="dateAdd" required >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:void(0)" class="btn btn-warning addStock"><i class="fa fa-folder-open"></i>Save</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title " id="exampleModalLabel"><input style="font-size: 18px; border: none;" type="text" name="itemname" disabled="disabled"></h5>
      </div>
      <div class="modal-body">
          <input type="hidden" name="edit_id">

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Item</label>
            <input type="text" class="form-control" name="edit_name" required>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Parts No.</label>
            <input type="text" class="form-control" name="edit_code" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Brand & Description</label>
            <input type="text" class="form-control" name="edit_brand">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Unit-Price</label>
            <input type="text" class="form-control"  name="edit_base">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Selling Unit-Price</label>
            <input type="text" class="form-control" name="edit_price" >
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:void(0)" class="btn btn-warning confirm_edit"><i class="fa fa-folder-open"></i>Save</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-sm" id="updatePic" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">            
            <h5>UPDATE ITEM PROFILE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
      <form class="profile-username text-center" method="post" action="<?php echo base_url(); ?>pages/uploadItemPic" enctype="multipart/form-data" id="upload_form">  
          <div class="modal-body">
                <input type="hidden" name="item_profile">
                <input style="font-size: 11px" type="file" id="image_file" class="profile-username text-center" name="image_file"/>
          </div>
          <div class="modal-footer">
            </a>
            <input type="submit" class="btn btn-block btn-info" id="upload" name="upload" value="Update">
          </div> 
        </form>   
    </div>
  </div>
</div>

<div class="modal fade" id="monthly" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>pages/generateMonthly" method="post">
      <div class="modal-body">
           <label for="recipient-name" class="col-form-label">Date Start</label>
          <input type="date" class="form-control " name="start3" required>
          <label for="recipient-name" class="col-form-label">Date End</label>
          <input type="date" class="form-control" name="end3" required>
          <br>
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Graph Label</label>
            <input type="text" class="form-control" name="monthly_title"  placeholder="Ex: Jan2020"required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info" value="Generate Graph">
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="annual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>pages/generateAnnually" method="post">
      <div class="modal-body">
           <label for="recipient-name" class="col-form-label">Date Start</label>
          <input type="date" class="form-control " name="start3" required>
          <label for="recipient-name" class="col-form-label">Date End</label>
          <input type="date" class="form-control" name="end3" required>
          <br>
       
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Graph Label</label>
            <input type="text" class="form-control" name="monthly_title"  placeholder="Ex: Jan-July 2020"required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info" value="Generate Graph">
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="weekly" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url(); ?>pages/generateWeekly" method="post">
      <div class="modal-body">
     
          <label for="recipient-name" class="col-form-label">Date Start</label>
          <input type="date" class="form-control " name="start4" required>
          <label for="recipient-name" class="col-form-label">Date End</label>
          <input type="date" class="form-control" name="end4" required>
          <br>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Graph Label</label>
            <input type="text" class="form-control" name="monthly_title"  placeholder="Ex: Jan.2020"required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-info" value="Generate Graph">
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="usernamePass" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">            
            <h5>Change Username/Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
      <form class="profile-username text-center" method="post" action="<?php echo base_url(); ?>pages/update_pass_user">  
        <input type="hidden" name="userIDs" value="<?php echo $user; ?>">
          <div class="modal-body displayUserPass">
          </div>
          <div class="modal-footer">      
          <input type="submit" class="btn btn-block btn-info" id="upload" name="upload" value="Update">
          </div> 
        </form>   
    </div>
  </div>
</div>
<?php } ?>


<div class="modal fade" id="replacementForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <input type="hidden" name="history_po_id">
        <input type="hidden" name="rep_item_id">
        <input type="hidden" name="rep_item">
        <input type="hidden" name="rep_brand">
        <input type="hidden" name="rep_code">
        <input type="hidden" name="rep_po">
        <input type="hidden" name="rep_qty_old">
        <input type="hidden" name="rep_price">
        <input type="hidden" name="rep_ttl">

        <h5 class="modal-title " id="exampleModalLabel"><input style="font-size: 18px; border: none;" type="text" class="form-control" name="itemnameReplace" disabled="disabled"></h5>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Customer Name:</label>
            <input type="text" class="form-control" name="rep_name" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Qty:</label>
            <input type="text" class="form-control" name="rep_qty" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Issue</label>
            <textarea  class="form-control" name="issue" required>
            </textarea>  
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Process by:</label>
            <input type="text" class="form-control" name="process_by" required >
          </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-success confirm_replace" title="Replace Item Defect with same Product under Waranty"><i class="fa  fa-exchange"></i> Replaced Item Defect</a>
        <a href="javascript:void(0)" class="btn btn-warning confirm_cancel_g" title="Cancel POS transaction and the return item must in Good Condition and will be added in Inventory"><i class="fa  fa-close"></i> Cancel POS Good Item</a>
        <a href="javascript:void(0)" class="btn btn-danger confirm_cancel_ng" title="Cancel POS transaction and the return item must in Defective Condition won't be added in Inventory"><i class="fa fa-warning"></i> Cancel POS Defective Item</a>
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="replacementInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body displayInfo">
         
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-sm" id="add_category" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">            
            <h5>New Item Categories</h5>
        </div>
      <form class="profile-username text-center" method="post" action="<?php echo base_url(); ?>pages/new_category" enctype="multipart/form-data" id="upload_form">  
          <div class="modal-body">
                <input type="text" class="form-control" name="category_name" placeholder="Enter New Categories">
                <input style="margin-top:25px; font-size: 11px" type="file" id="image_file" class="profile-username text-center" name="image_file"/>
          </div>
          <div class="modal-footer">
            </a>
            <input type="submit" class="btn btn-block btn-info" id="upload" name="upload" value="Confirm">
          </div> 
        </form>   
    </div>
  </div>
</div>