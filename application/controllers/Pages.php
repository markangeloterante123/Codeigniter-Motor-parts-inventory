<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct(){
      parent::__construct();
      //load chart_model from model
      $this->load->model('model_users');
    }
	public function logout(){	
		$id = $this->session->all_userdata();
     	$this->session->unset_userdata($id);
      	$this->session->sess_destroy();
      	redirect('pages/index');
	}
	public function logout_user(){	
		$id = $this->session->all_userdata();
     	$this->session->unset_userdata($id);
      	$this->session->sess_destroy();
      	redirect('pages/index');
	}
	public function index()
	{
		$pages='homepage';
		$this->load->view('homepage/'.$pages);
	}
	public function pageAdmin(){
		$page=$this->uri->segment(3);
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('templates/header');
	    $this->load->view('templates/adminSide');
	    $this->load->view('admin/'.$page);
	    $this->load->view('templates/adminFooter');
	}
	public function pageUser(){
		$page=$this->uri->segment(3);
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('templates/userHeader');
	    $this->load->view('templates/userSide');
	    $this->load->view('user/'.$page);
	    $this->load->view('templates/adminFooter');
	}
	public function pageGrap(){
		$data = $this->model_users->get_data()->result();
      	$datas['data'] = json_encode($data);
      	$data1 = $this->model_users->weekly()->result();
      	$datas['datas'] = json_encode($data1);
      	$data2 = $this->model_users->get_data2()->result();
      	$datas['data2'] = json_encode($data2);
      	
		$page=$this->uri->segment(3);
		if(!file_exists(APPPATH.'views/templates/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('templates/header');
	    $this->load->view('templates/adminSide');
	    $this->load->view('templates/'.$page,$datas);
	}

	public function pageAdmin_data(){
		$page=$this->uri->segment(3);
		$data=$this->uri->segment(4);
		$datas['collect_data'] = $this->model_users->individual_history($data);
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
        $datas['item_id']=$this->uri->segment(4);
	    $this->load->view('templates/header');
	    $this->load->view('templates/adminSide');
	    $this->load->view('admin/'.$page,$datas);
	    $this->load->view('templates/adminFooter');
	}
	public function pageAdmin_data2(){
		$page=$this->uri->segment(3);
		$data=$this->uri->segment(4);
		$datas['collect_data'] = $this->model_users->individual_history($data);
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
        $datas['item_id']=$this->uri->segment(4);
	   	$this->load->view('admin/'.$page,$datas);
	}
	public function pageAdmin2(){
		$page=$this->uri->segment(3);
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('admin/'.$page);
	}
	public function print2(){
		$pos['pos'] = $this->uri->segment(3);
		$pages = 'print';
		$this->load->view('admin/'.$pages,$pos);
	}
	public function print3(){
		$pages = 'print2';
		$this->load->view('admin/'.$pages);
	}
	public function generatesRec(){
		$datas['id'] = $this->input->post('id_item');
		$datas['start'] = $this->input->post('start3');
		$datas['end'] = $this->input->post('end3');
		$pages = 'print3';
		$this->load->view('admin/'.$pages,$datas);
	}

	// public function POS(){
	// 	$pages = 'pos2';
	// 	$this->load->view('templates/header');
	// 	$this->load->view('admin/'.$pages);
	// 	$this->load->view('templates/adminFooter');
	// }
		//insert new product
	public function addnewitems(){
		$item = $this->input->post('item');
		$brand = $this->input->post('brand');
		$code = $this->input->post('code');
		$category = $this->input->post('category');
		$qty = $this->input->post('qty');
		$price = $this->input->post('price');
		$base = $this->input->post('base_price');
		$image_file = $this->input->post('image_file');

		if(isset($_FILES["image_file"]["name"])){
			
			$uploadPath = './assets/uploadPic/'; 
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image_file')){
				$insertNew = array(
					'name' => $item,
					'brand' => $brand,
					'code'=>$code,
					'qty'=>$qty,
					'price'=>$price,
					'base_price'=>$base,
					'category'=>$category
				);
				$this->db->insert('tbl_item_inventory',$insertNew);
			}
			//else condition pag success
			else{
				$data = $this->upload->data();
				$name_file2 = $data["file_name"];
				$insertNew = array(
					'name' => $item,
					'brand' => $brand,
					'code'=>$code,
					'qty'=>$qty,
					'pic'=>$name_file2,
					'price'=>$price,
					'base_price'=>$base,
					'category'=>$category
				);
				$this->db->insert('tbl_item_inventory',$insertNew);			
			  }
			}

		$this->load->view('errors/success_warning');
	}
	//update profile of items
	public function uploadItemPic(){
		$id = $this->input->post('item_profile');
		$image_file = $this->input->post('image_file');

		if(isset($_FILES["image_file"]["name"])){
			
			$uploadPath = './assets/uploadPic/'; 
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image_file')){
				$this->load->view('errors/warning');
			}
			//else condition pag success
			else{
				$data = $this->upload->data();
				$name_file2 = $data["file_name"];

				$insertNew = array(
					'pic'=>$name_file2
				);
				$this->db->where('id',$id);
				$this->db->update('tbl_item_inventory',$insertNew);
				$this->load->view('errors/success_warning');
				
			  }
			}
	}
	public function new_category(){
		$name = $this->input->post('category_name');
		$image_file = $this->input->post('image_file');

			$n = 10;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    	$categ_id = ''; 
		    for ($i = 0; $i < $n; $i++) { 
		        $index = rand(0, strlen($characters) - 1); 
		        $categ_id .= $characters[$index]; 
		    } 
			

		if(isset($_FILES["image_file"]["name"])){
			
			$uploadPath = './assets/category/'; 
            $config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if(!$this->upload->do_upload('image_file')){
				echo "No Picture";
			}
			//else condition pag success
			else{
				$data = $this->upload->data();
				$name_file2 = $data["file_name"];

				$insertNew = array(
					'category_name'=>$name,
					'category_id'=>$categ_id,
					'images'=>$name_file2
				);
				$this->db->insert('tbl_category',$insertNew);
				$this->load->view('errors/success_warning');
				
			  }
			}
	}
	public function addCart(){
		//$id = md5($this->uri->segment(3));
		$id = $this->uri->segment(3);
		$user = $this->uri->segment(4);

		$this->db->select('*');
	    $this->db->from("tbl_item_inventory");
	    $this->db->where('id',$id);   
	    $query = $this->db->get();

	    if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$type = $value->category;
	      	$name = $value->name;
	      	$code = $value->code;
	      	$brand = $value->brand;
	      	$price =$value->price;

	      	$insert = array(
	      		'type'=> $type,
	      		'name'=>$name,
	      		'item_id'=>$id,
	      		'code'=>$code,
	      		'brand'=>$brand,
	      		'process_by'=>$user,
	      		'price'=>$price,
	      		'status'=>'1' 
	      	);
	      	$this->db->insert('tbl_history',$insert);
	      	$this->load->view('errors/success_warning');
	      }
	  	}

	}
	//for printing reciept
	public function print(){
		$pos = $this->input->post('confirm_po');
		$po = 'Reciept No.'.$pos; 
		$this->load->model('model_users','',TRUE);
		$page = 'print';
		$datas['collect_data'] = $this->model_users->display_print($po);
		if(!file_exists(APPPATH.'views/homepage/'.$page.'.php')){
             show_404();
         }
         $datas['PO'] = $this->input->post('confirm_po');
         $this->load->view('homepage/'.$page,$datas);

	}
	//Indivdual reporting
	public function indi_report_item(){
		$data = $this->input->post('id_item1');
		$start = $this->input->post('start1');
		$end = $this->input->post('end1');
		
		$page = 'reportsPrint';
		$this->load->model('model_users','',TRUE);
		$datas['collect_data'] = $this->model_users->indi_item_rep_print($data,$start,$end);
		if(!file_exists(APPPATH.'views/homepage/'.$page.'.php')){
             show_404();
         }
         $datas['start'] =  $this->input->post('start1');
         $datas['end'] =  $this->input->post('end1'); 
         $this->load->view('homepage/'.$page,$datas);

	}
	public function all_report_item(){
		$start = $this->input->post('start2');
		$end = $this->input->post('end2');
		
		$page = 'reportsPrint';
		$this->load->model('model_users','',TRUE);
		$datas['collect_data'] = $this->model_users->all_item_rep_print($start,$end);
		if(!file_exists(APPPATH.'views/homepage/'.$page.'.php')){
             show_404();
         }
         $datas['start'] =  $this->input->post('start2');
         $datas['end'] =  $this->input->post('end2'); 
         $this->load->view('homepage/'.$page,$datas);
	}
	//weekly
	public function generateWeekly(){
		$start = $this->input->post('start4');
		$end = $this->input->post('end4');
		$label = $this->input->post('monthly_title');
		$qty = 0;
		$gross = 0;
		$profit=0;
		$week=0;

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$query = $this->db->get();

		if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$num1 = $value->qty;
	      	$num2 = $value->total_price;
	      	$num3 = $value->net;

	      	$qty = $qty+$num1;
	      	$gross = $gross+$num2;
	      	$profit = $profit+$num3;
	      }
	  }
	  $this->db->select('*');
	  $this->db->from('tbl_setting');
	  $this->db->where('id','1');
	  $result = $this->db->get();
		if($result->num_rows() != 0){
	      foreach ($result->result() as $value){
	      	$week = $value->week;
	      }
	  }
	  $add = $week + 1;
	  if($week <= 8){
	  	 $insertReport = array(
		  	'week' => $label,
		  	'qty'=> $qty,
		  	'profit'=> $profit 
		  );
	  	 $update = array(
	  	 	'week'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_weekly',$insertReport);
	  }
	  else{
	  	$id = $week - 8;
	  	$this->db->where('id',$id);
	  	$this->db->delete('tbl_weekly');

	  	$insertReport = array(
		  	'week' => $label,
		  	'qty'=> $qty,
		  	'profit'=> $profit 
		  );
	  	 $update = array(
	  	 	'week'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_weekly',$insertReport);
	  }
	  $this->load->view('errors/success_warning');
	}
	//save monthly reports 
	public function generateMonthly(){
		$start = $this->input->post('start3');
		$end = $this->input->post('end3');
		$label = $this->input->post('monthly_title');
		$qty = 0;
		$gross = 0;
		$profit=0;
		$month=0;

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$query = $this->db->get();

		if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$num1 = $value->qty;
	      	$num2 = $value->total_price;
	      	$num3 = $value->net;

	      	$qty = $qty+$num1;
	      	$gross = $gross+$num2;
	      	$profit = $profit+$num3;
	      }
	  }
	  $this->db->select('*');
	  $this->db->from('tbl_setting');
	  $this->db->where('id','1');
	  $result = $this->db->get();
		if($result->num_rows() != 0){
	      foreach ($result->result() as $value){
	      	$month = $value->month;
	      }
	  }

	  $add = $month + 1;
	  if($month <= 12){
	  	 $insertReport = array(
		  	'month' => $label,
		  	'qty'=> $qty,
		  	'gross'=> $gross,
		  	'profit'=> $profit 
	  	);
	  	 $update = array(
	  	 	'month'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_chart',$insertReport);
	  }
	  else{
	  	$id = $month - 12;
	  	$this->db->where('id',$id);
	  	$this->db->delete('tbl_chart');
	  	$insertReport = array(
		  	'month' => $label,
		  	'qty'=> $qty,
		  	'gross'=> $gross,
		  	'profit'=> $profit 
	  	);
	  	 $update = array(
	  	 	'month'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_chart',$insertReport);
	  }
	 
	  $this->load->view('errors/success_warning');
	}
	//save for annually records
	public function generateAnnually(){
		$start = $this->input->post('start3');
		$end = $this->input->post('end3');
		$label = $this->input->post('monthly_title');
		$qty = 0;
		$gross = 0;
		$profit=0;
		$annual=0;

		$this->db->select('*');
		$this->db->from('tbl_history');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->where('status','0');
		$query = $this->db->get();

		if($query->num_rows() != 0){
	      foreach ($query->result() as $value){
	      	$num1 = $value->qty;
	      	$num2 = $value->total_price;
	      	$num3 = $value->net;

	      	$qty = $qty+$num1;
	      	$gross = $gross+$num2;
	      	$profit = $profit+$num3;
	      }
	  }
	  $this->db->select('*');
	  $this->db->from('tbl_setting');
	  $this->db->where('id','1');
	  $result = $this->db->get();
		if($result->num_rows() != 0){
	      foreach ($result->result() as $value){
	      	$annual = $value->annual;
	      }
	  }

	  $add = $annual + 1;
	  if($annual <= 12){
	  	 $insertReport = array(
		  	'annual' => $label,
		  	'qty'=> $qty,
		  	'gross'=> $gross,
		  	'profit'=> $profit 
	  	);
	  	 $update = array(
	  	 	'annual'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_annual',$insertReport);
	  }
	  else{
	  	$id = $annual - 12;
	  	$this->db->where('id',$id);
	  	$this->db->delete('tbl_annual');
	  	$insertReport = array(
		  	'annual' => $label,
		  	'qty'=> $qty,
		  	'gross'=> $gross,
		  	'profit'=> $profit 
	  	);
	  	 $update = array(
	  	 	'annual'=>$add 
	  	 );
	  	 $this->db->where('id','1');
	  	 $this->db->update('tbl_setting',$update);
		 $this->db->insert('tbl_annual',$insertReport);
	  }
	 
	  $this->load->view('errors/success_warning');
	}
	//create account 
	public function create_users(){
		$user=$this->input->post('users');
		$data =$this->input->post('pass');
		$name=$this->input->post('name');
		$contact =$this->input->post('contact');
		$pass=bin2hex($data);

		$insert = array(
			'names'=>$name,
			'contact'=>$contact,
			'username' =>$user, 
			'password'=>$pass,
			'department'=>'1'
		);
		$this->db->insert('tbl_user_acc',$insert);
	  	$this->load->view('errors/success_warning');
	}
	//update the passsword in the database
	public function update_pass_user(){
		$id=$this->input->post('userIDs');
		$user=$this->input->post('usernames');
		$data=$this->input->post('passwords');
		$pass=bin2hex($data);

		$update  = array(
			'username' => $user,
			'password' => $pass 
		);
		$this->db->where('id',$id);
		$this->db->update('tbl_user_acc',$update);
		$this->load->view('errors/success_warning');
	}
	
	public function delete_item(){
		$data=$this->model_users->delete_item();
	 	echo json_encode($data);
	}
	public function delete_cat(){
		$data=$this->model_users->delete_cat();
	 	echo json_encode($data);
	}

	//update password
	public function ajax_update_show(){
		$data=$this->model_users->pass_user_display();
	 	echo json_encode($data);
	}
	//delete users
	public function ajax_delete_users(){
		$data=$this->model_users->delete_users();
	 	echo json_encode($data);
	}
	//refresh users
	public function ajax_refresh_users(){
		$data=$this->model_users->refresh_users();
	 	echo json_encode($data);
	}
	//accept users
	public function ajax_accept_users(){
		$data=$this->model_users->accept_users();
	 	echo json_encode($data);
	}
	//view all users
	public function ajax_display_users(){
		$data=$this->model_users->view_users();
	 	echo json_encode($data);
	}
	//insert new stock
	public function addStock(){
		$data=$this->model_users->add_stock();
	 	echo json_encode($data);
	}
	//generate all report
	public function alldividual_report_item(){
		$data=$this->model_users->all_item_rep();
	 	echo json_encode($data);
	} 
	//view individual item history date report
	public function individual_report_item(){
		$data=$this->model_users->indi_item_rep();
	 	echo json_encode($data);
	} 
	//view all history of PO
	public function ajax_display_history(){
		$data=$this->model_users->display_history();
	 	echo json_encode($data);
	}public function ajax_display_his2(){
		$data=$this->model_users->display_history3();
	 	echo json_encode($data);
	}
	public function ajax_display_his(){
		$data=$this->model_users->display_history_sort();
	 	echo json_encode($data);
	}
	public function ajax_display_his3(){
		$data=$this->model_users->display_history_sort2();
	 	echo json_encode($data);
	}
	public function ajax_display_his4(){
		$data=$this->model_users->display_history_sort3();
	 	echo json_encode($data);
	}
	//view item to be printed
	public function ajax_view_print(){
		$data=$this->model_users->display_buy();
	 	echo json_encode($data);
	}
	//confirm the buy the items
	public function ajax_buy_confirm(){
		$data=$this->model_users->confirm_buy();
	 	echo json_encode($data);
	}	
	//button will display if there are all have qty in buy
	public function ajax_print_button(){
		$data=$this->model_users->button();
	 	echo json_encode($data);
	}
	//ajax buy
	public function ajax_buy(){
		$data=$this->model_users->buy();
	 	echo json_encode($data);
	}
	//delete order
	public function ajax_delete_qty(){
		$data=$this->model_users->delete_qty();
	 	echo json_encode($data);
	}
	//refresh qty of buy items
	public function ajax_refresh_qty(){
		$data=$this->model_users->refresh_qty();
	 	echo json_encode($data);
	}
	//para sa counter po check
	public function ajax_po(){
		$data=$this->model_users->displaySetting();
	 	echo json_encode($data);
	}
	//para sa lahat ng  mga ajax code
	public function ajax_display_new(){
		$data=$this->model_users->display();
	 	echo json_encode($data);
	}
	//display image 
	public function ajax_view_image_image(){
		$data=$this->model_users->display_image();
	 	echo json_encode($data);
	}
	public function ajax_view_order(){
		$data=$this->model_users->display_order();
	 	echo json_encode($data);
	}
	//edit item information
	public function editItem(){
		$data=$this->model_users->edit_item();
	 	echo json_encode($data);
	}
	public function searchHistory(){
		$data=$this->model_users->show_history();
	 	echo json_encode($data);	
	}
	public function historyReplacement(){
		$table="tbl_replacement";
		$data=$this->model_users->data1($table);
	 	echo json_encode($data);	
	}
	public function ajax_replace(){
		$data=$this->model_users->replace();
	 	echo json_encode($data);		
	}
	public function ajax_cancel_ng(){
		$data=$this->model_users->cancel_ng();
	 	echo json_encode($data);
	}
	public function ajax_cancel_g(){
		$data=$this->model_users->cancel_good();
	 	echo json_encode($data);
	}
	public function ajax_rep_detail(){
		$data=$this->model_users->rep_detail();
	 	echo json_encode($data);
	}
	public function ajax_rep_delete(){
		$data=$this->model_users->rep_delete();
	 	echo json_encode($data);
	}
	public function view_categ(){
		$table='tbl_category';
		$data=$this->model_users->show_categ($table);
	 	echo json_encode($data);
	}
	public function item_view(){
		$table='tbl_item_inventory';
		$data=$this->model_users->data1($table);
	 	echo json_encode($data);
	}
	public function item_view2(){
		$data =$this->input->post('id');
		$field='category';
		$table='tbl_item_inventory';
		$data=$this->model_users->data3($table,$field,$data);
	 	echo json_encode($data);
	}
	public function item_view3(){
		$table='tbl_item_inventory';
		$data=$this->model_users->data2($table);
	 	echo json_encode($data);
	}
	public function item_view_search(){
		$data=$this->model_users->item_view_search();
	 	echo json_encode($data);
	}
	public function history(){
		$data=$this->model_users->history();
	 	echo json_encode($data);
	}
	public function history_search(){
		$data=$this->model_users->show_history();
	 	echo json_encode($data);
	}
	public function print3_rec(){
		$data=$this->model_users->indi_item_rep2();
	 	echo json_encode($data);
	}
	public function print4_rec(){
		$data=$this->model_users->indi_item_rep3();
	 	echo json_encode($data);
	}

}
