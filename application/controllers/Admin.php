<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
	  	parent::__construct();
	  	$this->load->model('model_users');
	 	$this->load->database();
	 	 if($this->session->userdata('admin_session')){	  		
	   		 redirect('dashboard/AdminDashboard/success');
	    	}

	 }
	public function index()
	{
		$pages='adminLogin';
		$this->load->view('homepage/'.$pages);
	}

	public function login(){
		$data1=$this->input->post('user');
	    $data2=$this->input->post('pass');
	    $pass=bin2hex($data2);
	        
	    $this->db->select('*');
	    $this->db->from("tbl_user_acc"); 
	    $this->db->where('username',$data1);
	    $this->db->where('password',$pass);
	    $this->db->where('department','2');//department 2 admin while 1 is user  
	    $query = $this->db->get();
	        if($query->num_rows() != 0){
	            $id=0;
	            foreach ($query->result() as $value){
	                $id=$value->id;
	            }
	            	  $newdata = array(
		                    'admin_session'=> $id,
		                    'logged_in' => TRUE
              		  );
              		 
                	  	$this->session->set_userdata($newdata);
                 	 	$page="success"; 
					    $this->load->view('errors/'.$page);
	        }
	         else{
	            $page="warning"; 
	            $this->load->view('errors/'.$page);
	            
	        }
	}
}
