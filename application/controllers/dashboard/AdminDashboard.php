<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  AdminDashboard extends CI_Controller{

	public function __construct(){
 		parent::__construct();
 		if(!$this->session->userdata('admin_session')){
	 		redirect('pages/index');
	 	}
	 }

	public function success(){

		$page="admin"; 
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('templates/header');
	    $this->load->view('templates/adminSide');
	    $this->load->view('admin/'.$page);
	    $this->load->view('templates/adminFooter');
	}
	
}