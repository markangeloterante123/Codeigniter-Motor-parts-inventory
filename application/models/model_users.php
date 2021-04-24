<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_model{
	public function __construct(){
		parent::__construct();
	}
	 function get_data(){
      $this->db->select('month,qty,gross,profit');
      $result = $this->db->get('tbl_chart');
      return $result;
  	}
  	 function get_data2(){
      $this->db->select('annual,qty,gross,profit');
      $result = $this->db->get('tbl_annual');
      return $result;
  	}
  	function weekly(){
      $this->db->select('week,qty,profit');
      $result = $this->db->get('tbl_weekly');
      return $result;
  	}
  	public function data($table,$field,$data){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field,$data);
		$query = $this->db->get();
		return $query->result();
	}
	public function data1($table){
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result();
	}
	public function data2($table){
		$this->db->select('*');
		$this->db->from($table);
		// $this->db->order_by('name');
		$this->db->order_by('qty','asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function data3($table,$field,$data){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($field,$data);
		$this->db->order_by('qty','asc');
		$query = $this->db->get();
		return $query->result();
	}
	//display list of product
	public function display(){
		$this->db->select('*');
		$this->db->from('tbl_item_inventory');
		$this->db->order_by('qty');
		$query = $this->db->get();
		return $query->result();
	}
	//display of information 
	public function display_history(){
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('status','0');
		$query = $this->db->get();
		return $query->result();
	}
	public function display_history2(){
		$rec =$this->input->post('rec');
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('reciept_no',$rec);
		$query = $this->db->get();
		return $query->result();
	}
	public function display_history3(){
		$rec =$this->input->post('rec');
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->join('tbl_user_acc','tbl_history.process_by = tbl_user_acc.id','left');
		$this->db->order_by('tbl_history.id','desc');
		$this->db->where('tbl_history.reciept_no',$rec);
		$query = $this->db->get();
		return $query->result();
	}
	public function display_history_sort(){
		$this->db->DISTINCT("reciept_no");
		$this->db->select("reciept_no,cust_name,date");
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('status','0');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->result();
	}
	public function display_history_sort2(){
		$this->db->DISTINCT("reciept_no");
		$this->db->select("reciept_no,cust_name,date");
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('status','0');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result();
	}
	public function display_history_sort3(){
		$name = $this->input->post('name');
		$this->db->DISTINCT("reciept_no");
		$this->db->select("reciept_no,cust_name,date");
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('status','0');
		$this->db->limit(100);
		if($name != ''){
			  $this->db->like('reciept_no', $name);
			  $this->db->or_like('cust_name', $name);
			  $this->db->or_like('date', $name);		  }
		$query = $this->db->get();
		return $query->result();
	}
	
	public function item_view_search(){
		$name = $this->input->post('name');
		$this->db->select("*");
		$this->db->from('tbl_item_inventory');
		$this->db->order_by('qty','desc');
		if($name != ''){
			$this->db->like('name', $name);
			$this->db->or_like('brand', $name);		
		}
		$query = $this->db->get();
		return $query->result();
	}
	public function history(){
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('status','0');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->result();
	}

	//display list of product
	public function displaySetting(){
		$this->db->select('*');
		$this->db->from('tbl_setting');
		$query = $this->db->get();
		return $query->result();
	}
	//display image
	public function display_image(){
		$id=$this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_item_inventory');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function display_order(){
		$id=$this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('process_by',$id);
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->result();
	}
	public function button(){
		$id=$this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('process_by',$id);
		$this->db->where('status','1');
		$this->db->where('qty','0');
		$query = $this->db->get();
		return $query->result();
	}
	public function refresh_qty(){
		$id=$this->input->post('id');
		$qty=$this->input->post('qty');
		$item=$this->input->post('item');

		$updateQty='';
		$this->db->select('*');
	    $this->db->from("tbl_item_inventory");
	    $this->db->where('id',$item);   
	    $query = $this->db->get();
	    if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$updateQty = $value->qty;
	      }
	  	}
	     $total = $qty+$updateQty;
	     $update = array(
	     	'qty'=>$total  
	     );
	     $this->db->where('id',$item);
	     $this->db->update('tbl_item_inventory',$update);

	     $updates = array(
	     	'qty'=>'0',
	     	'total_price'=>'0',
		    'basic_total'=>'0',
		     'net'=>'0'  
	     );
	     $this->db->where('id',$id);
	     $result=$this->db->update('tbl_history',$updates);
	     return $result;
	}
	//but items add 
	public function buy(){
		$id=$this->input->post('id');
		$qty=$this->input->post('qty');
		$item=$this->input->post('item');

		$updateQty='';
		$base='';
		$price='';
		$net='';
		$this->db->select('*');
	    $this->db->from("tbl_item_inventory");
	    $this->db->where('id',$item);   
	    $query = $this->db->get();
	    if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$updateQty = $value->qty;
	      	$base = $value->base_price;
	      	$price =$value->price;
	      }
	  	}
	  	if($qty > $updateQty){
	  		alert();
	  	}
	  	else{
	  		$total = $updateQty-$qty;
	  		$total_price = $qty * $price;
	  		$total_basic = $qty * $base;
	  		$net = $total_price - $total_basic;

		     $update = array(
		     	'qty'=>$total  
		     );
		     $this->db->where('id',$item);
		     $this->db->update('tbl_item_inventory',$update);

		     $updates = array(
		     	'qty'=>$qty,
		     	'total_price'=>$total_price,
		     	'basic_total'=>$total_basic,
		     	'net'=>$net
		     );
		     $this->db->where('id',$id);
		     $result=$this->db->update('tbl_history',$updates);
		     return $result;
	  	}
	}
	// to confrim the buy and P.O the items
	public function confirm_buy(){
		$PO=$this->input->post('po_counter');
		$costumer=$this->input->post('name');
		$user=$this->input->post('user');
		$counter = $PO + 1;

		if($PO <= 9){
			$newPur = '0000'.$PO;
		}
		else if($PO <= 99){
			$newPur = '000'.$PO;
		}
		else if($PO <= 999){
			$newPur = '00'.$PO;
		}
		else if($PO <= 9999){
			$newPur = '0'.$PO;
		}
		else{
			$newPur = $PO;
		}
		
		$updates = array(
		    'reciept_no'=>$newPur,
		    'cust_name'=>$costumer,
		    'status'=>'0'
		);
		$this->db->where('process_by',$user);
		$this->db->where('status','1');
		$this->db->update('tbl_history',$updates);

		$update = array(
		   'po_counter'=>$counter	    
		);
		$this->db->where('id','1');
		$result=$this->db->update('tbl_setting',$update);
		return $result;
	}
	public function delete_qty(){
		$id=$this->input->post('id');
	     $this->db->where('id',$id);
	     $result=$this->db->delete('tbl_history');
	     return $result;
	}
	//for desplaying my items buy
	public function display_buy(){
		$po = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('reciept_no',$po);
		$query = $this->db->get();
		return $query->result();
	}
	//para sa print
	public function display_print($po){
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('reciept_no',$po);
		$query = $this->db->get();
		return $query->result();
	}
	//for individual item display history
	public function individual_history($data){
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('item_id',$data);
		$this->db->where('status','0');
		$query = $this->db->get();
		return $query->result();
	}
	//individual item report
	public function indi_item_rep(){
		$id = $this->input->post('id');
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('item_id',$id);
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$query = $this->db->get();
		return $query->result();
	}
	public function indi_item_rep2(){
		$id = $this->input->post('id');
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('item_id',$id);
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$this->db->order_by('reciept_no','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function indi_item_rep3(){		
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$this->db->order_by('reciept_no','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	//edit item information
	public function edit_item(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$code = $this->input->post('code');
		$brand = $this->input->post('brand');
		$base = $this->input->post('base');
		$price = $this->input->post('price');

		$update = array(
			'name' => $name,
			'code' =>$code,
			'brand'=>$brand,
			'base_price'=>$base,
			'price'=>$price
		);
		$this->db->where('id',$id);
		$result = $this->db->update('tbl_item_inventory',$update);
		return $result;
	}
	//all display
	public function all_item_rep(){
		$start = $this->input->post('starts');
		$end = $this->input->post('ends');

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$query = $this->db->get();
		return $query->result();
	}
	//individual item report Prin
	public function indi_item_rep_print($data,$start,$end){

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('item_id',$data);
		$this->db->where('status','0');
		$this->db->order_by('id','desc');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$query = $this->db->get();
		return $query->result();
	}
	public function all_item_rep_print($start,$end){

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->order_by('id','desc');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$query = $this->db->get();
		return $query->result();
	}
	public function add_stock(){
		$id = $this->input->post('id');
		$qty =$this->input->post('qty');
		$inv = $this->input->post('inv');
		$sale = $this->input->post('sale');
		$base = $this->input->post('base');
		$date = $this->input->post('date');
		$buy =$this->input->post('ibuy');

		$item = '';
		$code='';
		$brand='';
		$categ='';
		$oldStock ='';

		if ($qty == ''){
			echo "No Qty";
		}
		else{
			if($inv == ''){
				echo "No Sales Invoice";
			}
			else{
				if($buy == ''){
					echo "Required";
				}
				else{
					$this->db->select('*');
				    $this->db->from("tbl_item_inventory");
				    $this->db->where('id',$id);   
				    $query = $this->db->get();
				    if($query->num_rows() != 0){
				      foreach ($query->result() as $value){
				     	$oldStock = $value->qty;
				     	$item = $value->name;
				     	$code = $value->code;
				     	$brand = $value->brand;
				     	$categ = $value->category;
				      }
				  	}
				  	$newStock = $oldStock + $qty;
				  	$company = $inv;

				  	$update = array(
				  		'qty' =>$newStock,
				  		'base_price'=>$base,
				  		'price'=>$sale 
				  	);
				  	$this->db->where('id',$id);
				  	$this->db->update('tbl_item_inventory',$update);

				  	$history = array(
				  		'status' =>'2',
				  		'type'=>$categ,
				  		'item_id'=>$id,
				  		'reciept_no'=>'0',
				  		'name'=>$item,
				  		'code'=>$code,
				  		'brand'=>$brand,
				  		'cust_name'=>$company,
				  		'price'=>$base,
				  		'date'=>$date,
				  		'qty'=>$qty,
				  		'supplier'=>$buy,
				  		'process_by'=>'1'
				  	);
				  	$result = $this->db->insert('tbl_history',$history);
				  	return $result;
				}
			}
		}

		
	}
	public function display_si(){
		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('status','2');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	public function view_users(){
		$this->db->select('*');
		$this->db->from('tbl_user_acc');
		$this->db->where('department','1');
		$query = $this->db->get();
		return $query->result();
	}
	public function accept_users(){
		$id=$this->input->post('id');
		$update = array(
			'status'=>'1'
		);
		$this->db->where('id',$id);
		$result = $this->db->update('tbl_user_acc',$update);
		return $result;
	}
	
	public function refresh_users(){
		$id=$this->input->post('id');
		$update = array(
			'status'=>'0'
		);
		$this->db->where('id',$id);
		$result = $this->db->update('tbl_user_acc',$update);
		return $result;
	}
	public function delete_users(){
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$result = $this->db->delete('tbl_user_acc');
		return $result;
	}

	public function pass_user_display(){
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_user_acc');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function show_history(){
		$name = $this->input->post('name');
    	$this->db->select("*");
    	$this->db->from('tbl_history');
    	if($name != ''){
			  $this->db->like('reciept_no', $name);
			  $this->db->or_like('name', $name);
			  $this->db->or_like('code', $name);
			  $this->db->or_like('brand', $name);
			  $this->db->or_like('cust_name', $name);
			  $this->db->or_like('date', $name);
		  }
    	$this->db->order_by('id', 'DESC');
    	
    	$query = $this->db->get();
		return $query->result();
	}
	public function replace(){
		$history_id = $this->input->post('id');
		$item_id = $this->input->post('item_id');
		$qty = $this->input->post('qty');
		$issue = $this->input->post('issue');
		$name = $this->input->post('name');
		$process = $this->input->post('transac');
		$item = $this->input->post('item');
		$brand = $this->input->post('brand');
		$code = $this->input->post('code');
		$po = $this->input->post('po');

		if($name == ''){
			echo ('Error');
		}
		elseif($qty == ''){
			echo ('Error');
		}
		elseif($issue == ''){
			echo ('Error');
		}
		elseif($process == ''){
			echo ('Error');
		}	
		else{
			  $old = '';
			  $this->db->select('*');
			  $this->db->from('tbl_item_inventory');
			  $this->db->where('id',$item_id);
			  $result = $this->db->get();
				if($result->num_rows() != 0){
			      foreach ($result->result() as $value){
			      	$old = $value->qty;
			      }
			  }

			$new = ($old - $qty);
			$update1 = array(
				'qty' =>$new
			);
			$this->db->where('id',$item_id);
			$this->db->update('tbl_item_inventory',$update1);

			$update2  = array(
				'cust_name' =>$name,
				'code' =>$code,
				'item'=>$item,
				'brand'=>$brand,
				'qty'=>$qty,
				'issue'=>'Replacement: '.$issue,
				'process'=>$process,
				'po'=>$po
			);
			$result = $this->db->insert('tbl_replacement',$update2);
			return $result;
		}
		
	}
	public function cancel_ng(){
		$history_id = $this->input->post('id');
		$item_id = $this->input->post('item_id');
		$qty = $this->input->post('qty');
		$issue = $this->input->post('issue');
		$name = $this->input->post('name');
		$process = $this->input->post('transac');
		$item = $this->input->post('item');
		$brand = $this->input->post('brand');
		$code = $this->input->post('code');
		$po = $this->input->post('po');
		$rep_qty = $this->input->post('rep_qty');
		$rep_price = $this->input->post('rep_price');
		$rep_ttl = $this->input->post('rep_tbp');

		$price = $rep_ttl / $rep_qty;
		$new = $rep_price - $price;

		$hisQty = $rep_qty - $qty;
		$newTotalPrice = $hisQty * $rep_price;
		$newBasic = $hisQty * $price;
		$newNet = $hisQty * $new;

		if($hisQty == 0){
			$status  = array(
				'status'=>'3'
			);
			$this->db->where('id',$history_id);
			$this->db->update('tbl_history',$status);
			if($name == ''){
				echo ('Error');
			}
			elseif($qty == ''){
				echo ('Error');
			}
			elseif($issue == ''){
				echo ('Error');
			}
			elseif($process == ''){
				echo ('Error');
			}	
			else{
				  $old = '';
				  $this->db->select('*');
				  $this->db->from('tbl_item_inventory');
				  $this->db->where('id',$item_id);
				  $result = $this->db->get();
					if($result->num_rows() != 0){
				      foreach ($result->result() as $value){
				      	$old = $value->qty;
				      }
				  }

				// $new = ($old + $qty);
				// $update1 = array(
				// 	'qty' =>$new
				// );
				// $this->db->where('id',$item_id);
				// $this->db->update('tbl_item_inventory',$update1);

				$history  = array(
					'total_price'=>$newTotalPrice,
					'basic_total'=>$newBasic,
					'net'=>$newNet,
					'qty'=>$hisQty
				);
				$this->db->where('id',$history_id);
				$this->db->update('tbl_history',$history);

				$update2  = array(
					'cust_name' =>$name,
					'code' =>$code,
					'item'=>$item,
					'brand'=>$brand,
					'qty'=>$qty,
					'issue'=>'Cancel Order: '.$issue,
					'process'=>$process,
					'po'=>$po
				);
				$result = $this->db->insert('tbl_replacement',$update2);
				return $result;
			}
		}
		elseif($hisQty < 0){
			echo 'error';
		}
		else{
			if($name == ''){
				echo ('Error');
			}
			elseif($qty == ''){
				echo ('Error');
			}
			elseif($issue == ''){
				echo ('Error');
			}
			elseif($process == ''){
				echo ('Error');
			}	
			else{

				  $old = '';
				  $this->db->select('*');
				  $this->db->from('tbl_item_inventory');
				  $this->db->where('id',$item_id);
				  $result = $this->db->get();
					if($result->num_rows() != 0){
				      foreach ($result->result() as $value){
				      	$old = $value->qty;
				      }
				  }

				$history  = array(
					'total_price'=>$newTotalPrice,
					'basic_total'=>$newBasic,
					'net'=>$newNet,
					'qty'=>$hisQty

				);
				$this->db->where('id',$history_id);
				$this->db->update('tbl_history',$history);

				$update2  = array(
					'cust_name' =>$name,
					'code' =>$code,
					'item'=>$item,
					'brand'=>$brand,
					'qty'=>$qty,
					'issue'=>'Cancel Item Defect:'.$issue,
					'process'=>$process,
					'po'=>$po
				);
				$result = $this->db->insert('tbl_replacement',$update2);
				return $result;
				}
			}
		
	}
	public function cancel_good(){
		$history_id = $this->input->post('id');
		$item_id = $this->input->post('item_id');
		$qty = $this->input->post('qty');
		$issue = $this->input->post('issue');
		$name = $this->input->post('name');
		$process = $this->input->post('transac');
		$item = $this->input->post('item');
		$brand = $this->input->post('brand');
		$code = $this->input->post('code');
		$po = $this->input->post('po');
		$rep_qty = $this->input->post('rep_qty');
		$rep_price = $this->input->post('rep_price');
		$rep_ttl = $this->input->post('rep_tbp');

		
		$price = $rep_ttl / $rep_qty;
		$new = $rep_price - $price;

		$hisQty = $rep_qty - $qty;
		$newTotalPrice = $hisQty * $rep_price;
		$newBasic = $hisQty * $price;
		$newNet = $new * $hisQty;

		if($hisQty == 0){
			$status  = array(
				'status'=>'3'
			);
			$this->db->where('id',$history_id);
			$this->db->update('tbl_history',$status);
			if($name == ''){
				echo ('Error');
			}
			elseif($qty == ''){
				echo ('Error');
			}
			elseif($issue == ''){
				echo ('Error');
			}
			elseif($process == ''){
				echo ('Error');
			}	
			else{
				  $old = '';
				  $this->db->select('*');
				  $this->db->from('tbl_item_inventory');
				  $this->db->where('id',$item_id);
				  $result = $this->db->get();
					if($result->num_rows() != 0){
				      foreach ($result->result() as $value){
				      	$old = $value->qty;
				      }
				  }

				$new = ($old + $qty);
				$update1 = array(
					'qty' =>$new
				);
				$this->db->where('id',$item_id);
				$this->db->update('tbl_item_inventory',$update1);

				$history  = array(
					'total_price'=>$newTotalPrice,
					'basic_total'=>$newBasic,
					'net'=>$newNet,
					'qty'=>$hisQty
				);
				$this->db->where('id',$history_id);
				$this->db->update('tbl_history',$history);

				$update2  = array(
					'cust_name' =>$name,
					'code' =>$code,
					'item'=>$item,
					'brand'=>$brand,
					'qty'=>$qty,
					'issue'=>'Cancel Order: '.$issue,
					'process'=>$process,
					'po'=>$po
				);
				$result = $this->db->insert('tbl_replacement',$update2);
				return $result;
			}
		}
		elseif($hisQty < 0){
			echo 'error';
		}
		else{
			if($name == ''){
				echo ('Error');
			}
			elseif($qty == ''){
				echo ('Error');
			}
			elseif($issue == ''){
				echo ('Error');
			}
			elseif($process == ''){
				echo ('Error');
			}	
			else{
				  $old = '';
				  $this->db->select('*');
				  $this->db->from('tbl_item_inventory');
				  $this->db->where('id',$item_id);
				  $result = $this->db->get();
					if($result->num_rows() != 0){
				      foreach ($result->result() as $value){
				      	$old = $value->qty;
				      }
				  }

				$new = ($old + $qty);
				$update1 = array(
					'qty' =>$new
				);
				$this->db->where('id',$item_id);
				$this->db->update('tbl_item_inventory',$update1);

				$history  = array(
					'total_price'=>$newTotalPrice,
					'basic_total'=>$newBasic,
					'net'=>$newNet,
					'qty'=>$hisQty
				);
				$this->db->where('id',$history_id);
				$this->db->update('tbl_history',$history);

				$update2  = array(
					'cust_name' =>$name,
					'code' =>$code,
					'item'=>$item,
					'brand'=>$brand,
					'qty'=>$qty,
					'issue'=>'Cancel Order: '.$issue,
					'process'=>$process,
					'po'=>$po
				);
				$result = $this->db->insert('tbl_replacement',$update2);
				return $result;
			}
		}
	}
	public function rep_detail(){
		$id = $this->input->post('id');
		$this->db->select('*');
		$this->db->from('tbl_replacement');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function rep_delete(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$result = $this->db->delete('tbl_replacement');
		return $result;
	}

	public function show_categ(){
		$name = $this->input->post('name');
    	$this->db->select("*");
    	$this->db->from('tbl_category');
    	if($name != ''){
			  $this->db->like('category_name', $name);
		  }
    	$this->db->order_by('id', 'RANDOM');
    	$query = $this->db->get();
		return $query->result();
	}
	public function delete_item(){
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$result = $this->db->delete('tbl_item_inventory');
		return $result;
	}
	public function delete_cat(){
		$id = $this->input->post('id');
		$this->db->where('category_id',$id);
		$result = $this->db->delete('tbl_category');
		return $result;
	}

}