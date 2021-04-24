 <?php
       $id = $this->session->all_userdata();
          if(isset($id['user_session'])){
              $user=$id['user_session'];

  ?>
      
      <ul class="sidebar-menu" data-widget="tree">
       
       <li>
          <a href="<?php echo base_url(); ?>user/login"><i class="fa fa-dashboard"></i><span>LATEST POS ORDER</span></a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>pages/pageUser/pos"><i class="fa fa-shopping-cart"></i><span>POS</span></a>
        </li>
         <li>
            <a href="<?php echo base_url(); ?>pages/pageUser/rec"><i class="fa fa-list"></i><span>INVENTORY RECORDS</span></a>
        </li>  
        <li>
            <a href="<?php echo base_url(); ?>pages/pageUser/his"><i class="fa fa-archive"></i><span>HISTORY</span></a>
        </li>                     
        <li><a href="javascript:void(0)" class="updatePass" ><i class="fa fa-users "></i><span>ACCOUNT</span></a></li>
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
            <label for="recipient-name" class="col-form-label">Item Brand/Discription</label>
            <input type="text" class="form-control" name="brand" id="brand" required>
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Item Code</label>
            <input type="text" class="form-control" name="code" id="code" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="base_price" id="base_price" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Selling Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="price" id="price" >
          </div>
           <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category</label>
            <select type="text" class="form-control" name="category" id="category" required>
              <option value="Bar-End">Bar-End</option>
              <option value="Front-Basket">Front-Basket</option>
              <option value="Side-Mirror">Side-Mirror</option>
              <option value="Hand-Grip">Hand-Grip</option>
              <option value="Handle-Switch">Handle-Switch</option>
              <option value="Valve-Tapple">Valve-Tapple</option>
              <option value="Timing-Chain">Timing-Chain</option>
              <option value="Secondary-Clutch">Secondary-Clutch</option>
              <option value="Primary-Clutch">Primary-Clutch</option>
              <option value="Camshaft">Camshaft</option>
              <option value="Other..">Other..</option>
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
        <h2>Purchase Order Report</h2>
      </div>
      <div class="modal-body view">
        <input type="hidden" name="id">
          <div class="box">
            <div class="box-body">
              <form action="<?php echo base_url(); ?>pages/all_report_item" method="post">
              <input type="hidden" name="start2" value="">
              <input type="hidden" name="end2" value="">
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
                <tbody class="item_all_report">
                
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
            <input type="text" class="form-control" name="invoice" id="invoice" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="base_priceAdd" id="base_priceAdd" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Saling Price</label>
            <input type="text" class="form-control" placeholder="₱ 0.0" name="priceAdd" id="priceAdd" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Sold By</label>
            <input type="text" class="form-control" placeholder="Where I buy" name="ibuy" id="ibuy" required >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date Recieve</label>
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
            <label for="recipient-name" class="col-form-label">Code</label>
            <input type="text" class="form-control" name="edit_code" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Brand/Discription</label>
            <input type="text" class="form-control" name="edit_brand">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Based Price</label>
            <input type="text" class="form-control"  name="edit_base">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Price</label>
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
          <label for="recipient-name" class="col-form-label">From</label>
          <input type="hidden" name="start3">
          <input type="hidden" name="end3">
          <input type="text" class="form-control" name="st3" required disabled="disabled">
          <label for="recipient-name" class="col-form-label">To</label>
          <input type="text" class="form-control" name="en3" required disabled="disabled">
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
          <label for="recipient-name" class="col-form-label">From</label>
          <input type="hidden" name="start4">
          <input type="hidden" name="end4">
          <input type="text" class="form-control" name="st4" required disabled="disabled">
          <label for="recipient-name" class="col-form-label">To</label>
          <input type="text" class="form-control" name="en4" required disabled="disabled">
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