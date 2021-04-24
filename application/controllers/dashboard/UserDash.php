<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  UserDash extends CI_Controller{

	public function __construct(){
 		parent::__construct();
 		if(!$this->session->userdata('user_session')){
	 		redirect('pages/index');
	 	}
	 }

	public function success(){

		$page="user"; 
		if(!file_exists(APPPATH.'views/user/'.$page.'.php')){
             show_404();
         }
	    $this->load->view('templates/userHeader');
	    $this->load->view('templates/userSide');
	    $this->load->view('user/'.$page);
	    $this->load->view('templates/adminFooter');
	}
	
}